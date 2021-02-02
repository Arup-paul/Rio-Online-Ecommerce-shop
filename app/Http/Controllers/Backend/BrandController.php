<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Session;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //get al brands
    public function Brands(){
        Session::put('page', 'brands');
       $brands = Brand::all();
       return view('admin.brands.brands',compact('brands'));
    }

    //update status
    public function updateBrandStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
    public function addEditBrand(Request $request,$id=null){
        if($id==""){
            $title = "Add Brand";
            $brand = new Brand;
            $brandData = array();
            $message = "Brand Added Succesfully";
        }else{
            $title = "Update Brand";
            $brandData = Brand::where('id', $id)->first();
            $brand = Brand::find($id);
            $message = "Brand Updated Succesfully";

        }

        if($request->isMethod('post')){
            $data = $request->all();
            //validation
            $rules = [
                'name' => 'required|unique:brands|regex:/^[\pL\s\_\-]+$/u',
            ];

            //custom message
            $customMessage = [
                'name.required' => 'Brand Name Is Required',
                'name.unique' => 'The Brand Name has already Been Taken',
                'name.regex' => 'Valid Brand Name Is Required',
            ];
            $this->validate($request, $rules, $customMessage);
            $brand->name = $request->name;
            $brand->status = 1;
            $brand->save();
            Session::flash('success', $message);
            return redirect('admin/brands');
        }
        return view('admin.brands.add_edit_brand',compact('title','brand','brandData'));


    }

    public function DeleteBrand($id){
          //Get Brand
          $brand = Brand::where('id', $id)->first();
          //delete
          $brand->delete();

          //msg and redirect
          $msg = "Brand  Has Been Deleted Succefully";
          Session::flash('success', $msg);
          return redirect()->back();
    }
}
