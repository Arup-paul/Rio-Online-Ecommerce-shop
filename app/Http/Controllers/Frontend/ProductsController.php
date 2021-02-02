<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
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
            return view('frontend.products.ajax_products_listing',compact('categoryDetails','categoryProducts','url','page_name'));

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

            // echo "<pr e>"; print_r($categoryProducts); die;
        return view('frontend.products.listing',compact('categoryDetails','categoryProducts','url','page_name','fabricArray','sleeveArray','patternArray','fitArray','occasionArray'));

        }else{
            abort(404);
        }
    }
    }
}
