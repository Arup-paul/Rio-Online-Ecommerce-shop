<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Model\Admin;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{


    public function Dashboard(){
        //admin dashboard
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }

    public function Login(Request $request){
        if($request->isMethod('post')){ //check method
            $data = $request->all();

            //validation
            $rules = [
                'email' => 'required|email|max:255',
               'password' => 'required'
            ];

            //custom message
             $customMessage = [
                 'email.required' => 'Email Is Required',
                 'email.email' => 'Valid Email Required',
                 'password.required' => 'Password Is Required'
             ];
             $this->validate($request,$rules,$customMessage);
             //auth gurad
            if(Auth::guard('admin')->attempt(['email'=> $data['email'],'password' => $data['password']])){
               return redirect('admin/dashboard');
            }else{
                Session::flash('error_message','Invalid Email Or Password');
                return redirect('/admin');


            }

        }
        //request failed redirect login page
        return view('admin.admin_login');



    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function Settings(){
        //setting with indivadiual admin/subadmin
        Session::put('page', 'settings');
       $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
       return view('admin.admin_settings',compact('adminDetails'));
    }

    public function checkCurrentPassword(Request $request){
      //check old password with ajax request
      $data = $request->all();
      //password check function
      if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
          echo "true";
      }else{
          echo "false";
      }
    }

    public function updateCurrentPassword(Request $request){
      if($request->isMethod('post')){
          $data = $request->all();
          //validation
          $rules = [
           'current_pwd' => 'required',
           'password' => 'required|confirmed|min:8'
        ];

        //custom message
         $customMessage = [
             'current_pwd.required' => 'Current Password Is Required',
             'password.required' => 'Password Required',
             'password.confirmed' => 'New password is not match with  confirm password',
             'password.min' => 'Password Must be at least Minimum 8 character'
         ];
         $this->validate($request,$rules,$customMessage);

          //firstly check old pasword
          if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
             //check if new and confirm  password is matching
             if($data['password'] == $data['password_confirmation']){

                //check admin id
               $update = Admin::where('id',Auth::guard('admin')->user()->id);
               //then update password
               $update->update([
                 'password' => bcrypt($data['password'])
               ]);
               Session::flash('success','Password has been updated Succesfully!');
             }else{
                 //not match
                Session::flash('error_message','New password is not match with  confirm password');
             }
        }else{
           Session::flash('error_message','Your Current Password is Incorrect');
        }
      }
      return redirect()->back();
    }

    //update admin details
    public function UpdateAdminDetails(Request $request){
        Session::put('page', 'updateAdminDetails');
        if($request->isMethod('post')){
            $data = $request->except('_token');

            //validation
          $rules = [
            'name' => 'required|regex:/^[\pL\s\_]+$/u',
            'mobile' => 'required|min:10|numeric',
            'image' => 'image'
         ];

         //custom message
          $customMessage = [
              'name.required' => 'Current Password Is Required',
              'name.regex' => 'Valid Name Is Required',
              'mobile.required' => 'Mobile Number Is Required',
              'mobile.min' => 'Mobile Number at least 10 Number',
              'mobile.numeric' => 'Mobile Number Must Be a Numeric',
              'image.image' => 'Valid Image is Required',
          ];
          $this->validate($request,$rules,$customMessage);

          //upload admin image
          if($request->hasFile('image')){
              $image_tmp = $request->file('image');
              if($image_tmp->isValid()){
                  //Get Image Extension
                  $extension = $image_tmp->getClientOriginalExtension();
                  //Generate new Image Name
                  $imageName = rand(111,9999).'.'.$extension;
                  $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                    //Upload the Image
                  @unlink(public_path('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image));
                  Image::make($image_tmp)->resize(300,400)->save($imagePath);
              }else if(!empty($data['current_admin_image'])){
                  $imageName = $data['current_admin_image'];
              }else{
                  $imageName = "";
              }
          }
          //update admin Details
          $adminData = Admin::where('email',Auth::guard('admin')->user()->email);
          $adminData->update([
               'name' => $data['name'],
               'mobile' => $data['mobile'],
               'image' => $imageName,
          ]);
          Session::flash('success','Admin Details Updated Succefully!');
          return redirect()->back();


        }
        $adminDetails = Admin::where('id',Auth::guard('admin')->user()->id)->first();
       return view('admin.update_admin_details',compact('adminDetails'));
    }
}

    // echo "<pre>";
    // print_r($data);
    // die;
    // echo "</pre>";
