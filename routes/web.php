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

Auth::routes();

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
});

Route::prefix('/admin')->namespace('Backend')->group(function(){
  // All the admin routes here
  Route::match(['get','post'],'/','AdminController@Login');
  Route::group(['middleware'=>['admin']],function(){
    Route::get('/dashboard','AdminController@Dashboard');//dashboard
    Route::get('/settings','AdminController@Settings');//settings
    Route::get('/logout','AdminController@logout');//logout
    Route::post('/check-current-pwd','AdminController@checkCurrentPassword');//check old password with ajax
    Route::post('/update-current-pwd','AdminController@updateCurrentPassword');//update current password

    //admin details
    Route::match(['get','post'],'updateAdminDetails','AdminController@UpdateAdminDetails');

    //section Route
    Route::get('/sections','SectionController@sections');
    Route::post('/update_section_status','SectionController@updateSectionStatus');

    //Banner route
    Route::get('/banners','BannerController@banners');
    Route::post('/update_banner_status', 'BannerController@updateBannerStatus');
    Route::get('/delete_banner/{id}','BannerController@DeleteBanner');
    Route::match(['get','post'],'add_edit_banner/{id?}','BannerController@addEditBanner');

     //Categories Route
    Route::get('/categories','CategoryController@Categories');
    Route::post('/update_category_status', 'CategoryController@updateCategoryStatus');
    Route::match(['get','post'],'add_edit_category/{id?}','CategoryController@addEditCategory');
    Route::post('/append_categories_level','CategoryController@appendCategoryLevel');
    Route::get('/delete_category_image/{id}','CategoryController@deleteCategoryImage');
    Route::get('/delete_category/{id}','CategoryController@DeleteCategory');


    //product route
    Route::get('/products', 'ProductController@products');
    Route::post('/update_product_status', 'ProductController@updateProductStatus');
    Route::get('/delete_product_image/{id}', 'ProductController@deleteProductImage');
    Route::get('/delete_product_video/{id}', 'ProductController@deleteProductVideo');
    Route::get('/delete_product/{id}', 'ProductController@DeleteProduct');
    Route::match(['get', 'post'], '/add_edit_product/{id?}', 'ProductController@addEditProduct');

    //product Attributes
    Route::match(['get', 'post'], '/add_attributes/{id}', 'ProductController@addAttributes');
    Route::post('/edit_attributes/{id}', 'ProductController@editAttributes');
    Route::post('/update_attribute_status', 'ProductController@updateAttributeStatus');
    Route::get('/delete_attribute/{id}', 'ProductController@DeleteAttribute');

    //Product Images
    Route::match(['get', 'post'], '/add_images/{id}', 'ProductController@addImages');
    Route::post('/update_image_status', 'ProductController@updateImageStatus');
    Route::get('/delete_image/{id}', 'ProductController@DeleteImage');

   //Brand Route

   Route::get('/brands','BrandController@Brands');
   Route::post('/update_brand_status', 'BrandController@updateBrandStatus');
   Route::match(['get', 'post'], '/add_edit_brand/{id?}', 'BrandController@addEditBrand');
   Route::get('/delete_brand/{id}', 'BrandController@DeleteBrand');







  });



});

