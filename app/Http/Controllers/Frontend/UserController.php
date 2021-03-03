<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function loginRegister(){
       return view('Frontend.users.login_register');
     }

     public function register(Request $request){
       if($request->isMethod('post')){
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


                //
                if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                    //update User cart with user id
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id' => $user_id]);
                    }
                   return redirect('cart');
                }
            }
       }
     }

     public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email'  => $data['email'], 'password' => $data['password']])){

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
