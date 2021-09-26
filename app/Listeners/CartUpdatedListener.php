<?php

namespace App\Listeners;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if(isset(session()->get('coupon')['name']))
        {
            $couponName = session()->get('coupon')['name'];
            $coupon = Coupon::where('code', $couponName)->first();
            UpdateCoupon::dispatchSync($coupon);
        }

    }
}
