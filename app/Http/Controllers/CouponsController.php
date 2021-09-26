<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;
use App\Models\CouponUser;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $currentCoupon = Coupon::where('code', $request->coupon_code)->first();
        $currentDateTime = Carbon::now('Asia/Kathmandu');
        if (!$currentCoupon) {
            return back()->with('coupon_error','Invalid coupon code. Please try again.');
        }
        if($currentCoupon->expires <= $currentDateTime->toDateTimeString()) {
            return back()->with('coupon_error','Coupon expired.');
        }
        else {
            $usedCoupons = CouponUser::where('user_id', auth()->user()->id)->pluck('coupon_id');
           $result = $usedCoupons->search($currentCoupon->id, $strict = true);
           if(is_int($result)) {
               return back()->with('coupon_error','Coupon already redeemed.');
            }
            else {
                UpdateCoupon::dispatchSync($currentCoupon);
            }

        }

        return back()->with('coupon_success', 'Coupon has been applied!');
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
    public function destroy()
    {
        session()->forget('coupon');
        return back()->with('coupon_success', 'Coupon has been removed.');

    }
}
