<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'CAKE2021',
            'type' => 'fixed',
            'value' => 30,
            'expires' => Carbon::now('Asia/Kathmandu')->addDay()->format('Y-m-d H:i:s')
        ]);

        Coupon::create([
            'code' => 'STREET50',
            'type' => 'percent',
            'percent_off' => 50,
            'expires' => Carbon::now('Asia/Kathmandu')->addDay()->format('Y-m-d H:i:s')
        ]);

        Coupon::create([
            'code' => 'Expired',
            'type' => 'percent',
            'percent_off' => 50,
            'expires' => Carbon::now('Asia/Kathmandu')->format('Y-m-d H:i:s')
        ]);
    }
}
