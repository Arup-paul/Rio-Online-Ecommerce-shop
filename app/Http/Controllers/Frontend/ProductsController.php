<?php

namespace App\Http\Controllers\Frontend;

use Session;
use App\Model\Cart;
use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Model\ProductsAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        Paginator::useBootstrap();

        if($request->ajax()){
            $data = $request->all();
            $url = $data['url'];
            // echo "<pre>";print_r($data);die;
            $categoryCount = Category::where(['url'=> $url,'status'=>1])->count();
            if($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);

                //if fabric filter is selected
                if(isset($data['fabric']) && !empty($data['fabric'])){
                    $categoryProducts->whereIn('products.fabric',$data['fabric']);
                }
                //if sort filter is selected
                if(isset($data['fit']) && !empty($data['fit'])){
                    $categoryProducts->whereIn('products.fit',$data['fit']);
                }

                //if sleeve filter is selected
                if(isset($data['sleeve']) && !empty($data['sleeve'])){
                    $categoryProducts->whereIn('products.sleeve',$data['sleeve']);
                }

                 //if occasion filter is selected
                 if(isset($data['occasion']) && !empty($data['occasion'])){
                    $categoryProducts->whereIn('products.occasion',$data['occasion']);
                }

                  //if pattern filter is selected
                  if(isset($data['pattern']) && !empty($data['pattern'])){
                    $categoryProducts->whereIn('products.pattern',$data['pattern']);
                }

                //if sort option select by user
                if(isset($data['sort'])  && !empty($data['sort'])){
                    if($data['sort']=="product_latest"){
                        $categoryProducts->orderBy('id','Desc');
                    }else if($data['sort']=="product_name_a_z"){
                        $categoryProducts->orderBy('product_name','ASC');
                    }else if($data['sort']=="product_name_z_a"){
                        $categoryProducts->orderBy('product_name','Desc');
                    }else if($data['sort']=="price_lowest"){
                        $categoryProducts->orderBy('product_price','ASC');
                    }else if($data['sort']=="price_highest"){
                        $categoryProducts->orderBy('product_price','Desc');
                    }
                }

                $categoryProducts = $categoryProducts->paginate(3);

            $page_name = "listing";
            $productFilters = Product::productFilters();
            $fabricArray  = $productFilters['fabricArray'];
            $sleeveArray = $productFilters['sleeveArray'];
            $patternArray = $productFilters['patternArray'];
            $fitArray = $productFilters['fitArray'];
            $occasionArray = $productFilters['occasionArray'];
                // echo "<pr e>"; print_r($categoryProducts); die;
            return view('Frontend.products.ajax_products_listing',compact('categoryDetails','categoryProducts','url','page_name'));

            }else{
                abort(404);
            }

        }else{
            $url =  Route::getFacadeRoot()->current()->uri();
        $categoryCount = Category::where(['url'=> $url,'status'=>1])->count();
        if($categoryCount > 0) {
            $categoryDetails = Category::categoryDetails($url);
            $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);


            $categoryProducts = $categoryProducts->paginate(3);
            //product filters
            $productFilters = Product::productFilters();
            $fabricArray  = $productFilters['fabricArray'];
            $sleeveArray = $productFilters['sleeveArray'];
            $patternArray = $productFilters['patternArray'];
            $fitArray = $productFilters['fitArray'];
            $occasionArray = $productFilters['occasionArray'];


            $page_name = "listing";

//             echo "<pre>"; print_r($categoryProducts); die;
        return view('Frontend.products.listing',compact('categoryDetails','categoryProducts','url','page_name','fabricArray','sleeveArray','patternArray','fitArray','occasionArray'));

        }else{
            abort(404);
        }
    }
    }


    public function productDetails($code,$id){
        $productDetails = Product::with(['brand','category','section','images']
        )->with(['attributes'=>function($query){
            $query->where('status',1);
            }])->find($id)->toArray();
        $relatedProducts =  Product::with('brand')->where('category_id',$productDetails['category']['id'])->where('id','!=',$id)->limit(3)->inRandomOrder()->get()->toArray();
        $productStock = ProductsAttribute::where('product_id',$id)->sum('stock');
        return view("Frontend.products.product_details",compact('productDetails','productStock','relatedProducts'));
    }

    public function getProductPrice(Request $request){
         if($request->ajax()){
             $data = $request->all();
             $getProductPrice  = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first();

             return $getProductPrice->price;
         }
    }

    public function addToCart(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();


            $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();

            if($getProductStock['stock'] < $data['quantity']){
                $error_message = "Required Quantity is Not Available" ;
                session()->flash('error_message', $error_message);
                return redirect()->back();
            }

            //generate session id
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $sessionID = Session::getId();
                Session::put('session_id', $sessionID);
            }

            //Check product if already exists in user carts

            if(Auth::check()){
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->count();
            }else{
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();
            }

            $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->count();

            if($countProducts > 0){
                $error_message = "Product already exists in cart" ;
                session()->flash('error_message', $error_message);
                return redirect()->back();
            }

            //save product in cart

            Cart::insert([
                'session_id' => $session_id,
                'product_id'=>$data['product_id'],
                'size'=>$data['size'],
                'quantity'=>$data['quantity']
                ]);
            $message = "Product Has Been Added Cart";
            Session::flash('success_message',$message);
            return redirect()->back();
        }
    }

    //cart
    public function cart(Request $request){
        $userCartItems = Cart::userCartItems();
        //  return $userCartItems; die;
        return view('Frontend.products.cart')->with(compact('userCartItems'));
    }
}
