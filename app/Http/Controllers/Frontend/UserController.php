<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginRegister(){
       return view('Frontend.users.login_register');
     }

     public function register(Request $request){
       if($request->isMethod('post')){
           $data  = $request->all();
           return $data;
       }
     }


}
