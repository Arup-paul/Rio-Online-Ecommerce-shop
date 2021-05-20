<?php

namespace App\Http\Controllers\Backend;

use App\Model\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function coupons(){
      $coupons = Coupon::get()->toArray();  
      return view('admin.coupons.coupons',compact('coupons'));

    }
}
