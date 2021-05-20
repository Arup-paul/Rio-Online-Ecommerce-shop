<?php

use App\Model\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::namespace('Frontend')->group(function(){
  //home page Route
   Route::get('/','IndexController@index');

  $catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();

  foreach($catUrls as $url){
    Route::get('/'.$url,'ProductsController@listing');
  }

  //product detail page
  Route::get('/product/{code}/{id}','ProductsController@productDetails');

  Route::post('/get-product-price','ProductsController@getProductPrice');

  //Add to carts
  Route::post('add-to-cart','ProductsController@addToCart');
  Route::get('/cart','ProductsController@cart')->name('cart');

  //update Cart
    Route::post('/update-cart-item-qty','ProductsController@updateCartQuantity');
    Route::post('/delete-cart-item','ProductsController@deleteCartItem');


    //chek if email exist
    Route::match(['get','post'],'/check-email','UserController@checkEmail');
    //login register
    Route::get('login-register',['as' => 'login','uses'=>'UserController@loginRegister']);
    Route::post('login','UserController@login');
    Route::post('register','UserController@register');
    Route::get('logout','UserController@logout');
    //Forget Password
    Route::match(['get','post'],'forget-password','UserController@forgetPassword');

    //confirm user account
    Route::match(['get','post'],'confirm/{code}','UserController@confirmAccount');

    Route::group(['middleware' => ['auth']],function(){
    //user account
    Route::match(['get','post'],'account','UserController@account'); 
    Route::post('/check-current-user-password','UserController@checkUserPassword');
    Route::post('/update-user-password','UserController@updateUserPassword');
   });
});

 

