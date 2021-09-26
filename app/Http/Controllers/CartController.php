<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightAlsoLike = Product::inRandomOrder()->take(4)->get();
        return view('cart', with([
            'mightAlsoLike' => $mightAlsoLike,
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
    public function store(Request $request)
    {
        $duplicates = Cart::search(function($cartItem, $rowId) use($request) {
            return $cartItem->id === $request->id;
        });
        if($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('cart_success', 'Item is already in your cart!');
        }
        if($request->category == "cakes") {
            Cart::add($request->id, $request->name, 1, $request->price, ['weight' => $request->weight, 'choice' => $request->choice, 'message' => $request->message])->associate('App\Models\Product');
        return redirect()->route('cart.index')->with('cart_success', 'Item was added to your cart.');
        } else {
            Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Models\Product');
            return redirect()->route('cart.index')->with('cart_success', 'Item was added to your cart.');
        }


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
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);
        if($validator->fails()) {
            session()->flash('errors',  collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400);

        }

        Cart::update($id, $request->quantity);
        session()->flash('cart_success',  'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('cart_success', 'Item has been removed!');
    }
}
