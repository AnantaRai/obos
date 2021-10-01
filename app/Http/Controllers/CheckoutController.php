<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Payment;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $order = auth()->user()->orders->last();
        // ddd($order->address);
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }
        return view('checkout', with([
            'discount' => getNumbers()->get('discount'),
            'newTotal' => getNUmbers()->get('newTotal'),
            'deliveryCharge' => getNUmbers()->get('deliveryCharge'),
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {

        if($request->payment_method == 'card') {
            $contents = Cart::content()->map(function($item) {
                return $item->model->slug.', '.$item->qty;
            })->values()->toJson();

            try {
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $charge = $stripe->charges->create([
                    'amount' => getNumbers()->get('newTotal') * 100,
                    'currency' => 'npr',
                    'source' => 'tok_mastercard',
                    'description' => 'Order',
                    'metadata' => [
                        'contents' => $contents,
                        'quantity' => Cart::instance('default')->count(),
                        'discount' => collect(session()->get('coupon'))->toJson(),
                    ],
                  ]);
                //   dd($charge->payment_method_details->card->brand);
                $order = $this->addToOrdersTables($request, null, 'Confirmed');
                $this->addToPaymentsTable($request, $charge->payment_method_details->card->brand, $charge->id, $order->id);
                if (session()->has('coupon')){
                    $this->addToCouponUsedTable($this->getUsedCouponId());
                }
                Mail::send(new OrderPlaced($order));
                // SUCCESSFUL
                Cart::instance('default')->destroy();
                session()->forget('coupon');
                return redirect()->route('landing-page')->with('success', 'Thank you! Your order has been successfully placed');
            }
            catch(\Stripe\Exception\CardException $e) {
                $this->addToOrdersTables($request, $e->getMessage(), null);
                return back()->withErrors('Error! ', $e->getMessage());
            }
        }
        else {
            $order = $this->addToOrdersTables($request, null, 'Awaiting Payment');
            // $this->addToPaymentsTable($request, 'Cash on Delivery', null, $order->id);
            if (session()->has('coupon')){
                $this->addToCouponUsedTable($this->getUsedCouponId());
            }
                Mail::send(new OrderPlaced($order));
                // SUCCESSFUL
                Cart::instance('default')->destroy();
                session()->forget('coupon');
                return redirect()->route('landing-page')->with('success', 'Thank you! Your order has been successfully placed');
        }

    }

    protected function addToOrdersTables($request, $error, $status)
    {
        //Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'street_name' => $request->street_name,
            'phone' => $request->phone,
            'discount' => getNumbers()->get('discount'),
            'discount_code' => getNumbers()->get('code'),
            'subtotal' => getNumbers()->get('subTotal'),
            'total' => getNumbers()->get('newTotal'),
            'status' => $status,
            'error' => $error,
        ]);
        //Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'weight_in_pound' => $item->options->weight,
                'choice' => $item->options->choice,
                'message' => $item->options->message,
            ]);
        }



        return $order;
    }

    protected function addToPaymentsTable($request, $paymentMethod, $chargeId, $orderId)
    {
        $payment = Payment::create([
            'order_id' => $orderId,
            'transaction_id' => $chargeId,
            'payment_method' => $paymentMethod,
            'cardholder_name' =>$request->name_on_card,
            'amount' => getNumbers()->get('newTotal'),
        ]);

        return $payment;
    }
    protected function addToCouponUsedTable($couponId)
    {
        CouponUser::create([
            'user_id' => auth()->user()->id,
            'coupon_id' => $couponId,
        ]);
    }

    protected function getUsedCouponId()
    {
        $usedCoupon = session()->get('coupon');
        $coupon = Coupon::where('code', $usedCoupon['name'])->first();
        return $coupon->id;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
