<?php

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

function presentPrice($price)
{
    return "NPR " . number_format($price);
}

function setActiveCategory($category, $output = 'font-bold')
{
    return request()->category == $category ? $output : '';
}
function productImage($path)
{
    return $path && file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('img/not-found.jpg');
}

function presentDate($date)
{
    return Carbon::parse($date)->format('M d, Y');
}

function getNumbers()
    {
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;
        $deliveryCharge = 150;
        $subTotal = Cart::subtotal();
        if($subTotal < 0) {
            $subTotal = 0;
        }
        $newTotal = (($subTotal + $deliveryCharge) - $discount);
        return collect([
            'discount' => $discount,
            'newTotal' => $newTotal,
            'subTotal' => $subTotal,
            'code' => $code,
            'deliveryCharge' => $deliveryCharge
        ]);
    }
