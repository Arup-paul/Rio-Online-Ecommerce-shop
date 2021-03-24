<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\SMS;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function loginRegister(){
       return view('Frontend.users.login_register');
     }

     public function register(Request $request){
       if($request->isMethod('post')){
           Session::forget('error_message');
           Session::forget('success_message');
           $data  = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if($userCount > 0 ){
                $message = 'Email   already exist';
                session::flash('error_message',$message);
                return redirect()->back();
            }else{
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();

                //send confirmation email user
                $email = $data['email'];
                $messageData = [
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'code' => base64_encode($data['email']),
                ];

//                Mail::send('emails.confirmation',$messageData,function($message) use($email){
//                    $message->to($email)->subject('Confirm Your Account');
//                });

                //Redirect
                $message = "Please confirm your email to activate your account";
                Session::put('success_message',$message);
                return redirect()->back();



                //
//                if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
//                    //update User cart with user id
//                    if(!empty(Session::get('session_id'))){
//                        $user_id = Auth::user()->id;
//                        $session_id = Session::get('session_id');
//                        Cart::where('session_id',$session_id)->update(['user_id' => $user_id]);
//                    }
//
////                    //send register message
////                    $message = "Succesfully Register";
////                    $mobile = $data['mobile'];
////                    SMS::sendSms($message,$mobile);
////
////                    //send register email
////                    $email = $data['email'];
////                    $messageData = [
////                        'name' => $data['name'],
////                        'mobile' => $data['mobile'],
////                        'email' => $data['email']
////                    ];
////                    Mail::send('emails.register',$messageData,function($message) use($email){
////                        $message->to($email)->subject('Welcome to Ecommerce Website');
////                    });
//                   return redirect('cart');
//                }
            }
       }
     }

     public function confirmAccount($email){
        $email = base64_decode($email);

        //check user email address
         $userCount = User::where('email',$email)->count();
         if($userCount > 0){
             //User account activate or not
             $userDetails = User::where('email',$email)->first();
             if($userDetails->status ==1){
                 $message = "User Email Account is already activated ..Please Login";
                 Session::put('error_message',$message);
                 return redirect('login-register');
             }else{
                 //update user status to 1 to activate account
                 User::where('email',$email)->update(['status' => 1]);
                 ////                    //send register message
////                    $message = "Succesfully Register";
////                    $mobile = $userDetails['mobile'];
////                    SMS::sendSms($message,$mobile);
////
////                    //send register email
////                    $messageData = [
////                        'name' => $userDetails['name'],
////                        'mobile' => $userDetails['mobile'],
////                        'email' => $userDetails['email']
////                    ];
////                    Mail::send('emails.register',$messageData,function($message) use($email){
////                        $message->to($email)->subject('Welcome to Ecommerce Website');
////                    });
                  $message = "Your Email account is activated.You Can login  now";
                  Session::put('success_message',$message);
                  return redirect('login-register');
//                }
             }
         }else{
             abort(404);
         }
     }


     public function login(Request $request){
        if($request->isMethod('post')){

            $data = $request->all();

            if(Auth::attempt(['email'  => $data['email'], 'password' => $data['password']])){
                //Check email is activated
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    Auth::logout();
                    $message = "Your Account is Not Activated! Please confirm to your email address";
                    Session::put('error_message',$message);
                    return redirect()->back();
                }
                //update User cart with user id
                if(!empty(Session::get('session_id'))){
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id',$session_id)->update(['user_id' => $user_id]);
                }




                return redirect('/cart');
            }else{
                $message = 'Invalid Email or Password';
                session::flash('error_message',$message);
                return redirect()->back();
            }


        }
     }

     public function checkEmail(Request $request){
        //chek if email already exists
         $data = $request->all();
         $emailCount = User::where('email',$data['email'])->count();
         if($emailCount > 0 ){
             echo "false";
         }else{
             echo  "true";
         }

     }



     public function logout(){
        Auth::logout();
        return redirect('/');
     }




}
