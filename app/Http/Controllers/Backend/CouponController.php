<?php

namespace App\Http\Controllers\Backend;

use App\Model\Coupon;
use App\Model\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function coupons(){
        Session::put('page', 'coupons');
      $coupons = Coupon::get()->toArray();  
      return view('admin.coupons.coupons',compact('coupons'));

    }

    public function updateCouponStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'coupon_id' => $data['coupon_id']]);
        }
    }

    public function addEditCoupon($id=null){
        if($id== ""){
            //Add Coupon
            $coupon = new Coupon;
            $title = "Add Coupon";
        }else{
            $coupon = Coupon::find($id);
            $title = "Edit Coupon";
        }

         //Sections with Categories and sub Categories
         $categories = Section::with('categories')->get();
         $categories = json_decode(json_encode($categories), true);



        return view('admin.coupons.add_edit_coupon',compact('coupon','title','categories'));
    }
}
