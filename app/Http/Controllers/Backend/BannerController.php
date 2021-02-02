<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Session;

class BannerController extends Controller
{
    public function banners(){
        Session::put('page', 'banners');
         $banners = Banner::get()->toArray();
        return view('admin.banners.banners',compact('banners'));
    }

    public function addEditBanner(Request $request,$id=null){
        $data = [];
        if ($id == "") {
            //Add Banner Functionality
             $title = "Add Banner";
            $banner = new Banner;
            $bannerData = array();
            $msg = "Banner Added Succesfully";
        } else {
            //Edit Banner Functionality
             $title = "Update Banner";
             $bannerData = Banner::where('id', $id)->first();
             $banner = Banner::find($id);
             $msg = "Banner Updated Succesfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            //validation
            $rules = [
                'title' => 'required',
                'image' => 'required|image',
                'link' => 'required',
            ];

            // //custom message
            $customMessage = [
                'title.required' => 'Banner Title Is Required',
                'image.required' => ' BannerImage is Required',
                'image.image' => 'Valid Banner Image is Required',
                'link.required' => ' Banner Link is Required',
            ];
            $this->validate($request, $rules, $customMessage);

            //upload Banner  image
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate new Image Name
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $imagePath = 'images/banner_images/' . $imageName;
                    Image::make($image_tmp)->resize(1000, 800)->save($imagePath);
                    $banner->image = $imageName;
                }
            }


            $banner->title = $data['title'];
            $banner->alt = $data['title'];
            $banner->link = $data['link'];
            $banner->status = 1;
             $banner->save();
             Session::flash('success', $msg);
            return redirect('admin/banners');
    }
    return view('admin.banners.add_edit_banner', compact('title','bannerData'));
}


    public function updateBannerStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    public function DeleteBanner($id){
       //Get Category Image
       $bannerImage = Banner::where('id', $id)->first();

       //Get Category Image Path
       $banner_image_path = 'images/banner_images/';

       //Delete Category Image from category image folder if exists
       if (file_exists($banner_image_path . $bannerImage->image)) {
           @unlink($banner_image_path . $bannerImage->image);
       }

       $bannerImage->delete();
       $msg = "Banner  Has Been Deleted Succefully";
       Session::flash('success', $msg);
       return redirect()->back();
    }
}
