<?php

namespace Database\Seeders;

use App\Model\Coupon;
use Illuminate\Database\Seeder;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $couponRecords = [ 
           'coupon_option' =>'Manual',
           'coupon_code' => 'test1',
           'categories' => '1,2',
           'users' => 'arup12@gmail.com',
           'coupon_type' => 'Single',
           'amount_type' => 'Perchantage',
           'amount' => '10',
           'expiry_date' =>'2021-06-06',
           'status' => 1
       ];
       Coupon::insert($couponRecords); 
    }
}
