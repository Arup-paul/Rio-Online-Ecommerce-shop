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
                $user->status = 0;
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
