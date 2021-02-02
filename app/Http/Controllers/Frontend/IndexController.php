<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $page_name = "index";

        //Get Featured Item
        $featuredItemsCount = Product::where('is_featured','Yes')->where('status',1)->count();
        $featuresItems = Product::where('is_featured','Yes')->where('status',1)->get()->toArray();
        $featuresItemsChunk = array_chunk($featuresItems,4);

         //Get New Products
         $newProducts = Product::orderBy('id','desc')->where('status',1)->limit(6)->get();
         $newProducts = json_decode(json_encode($newProducts),true);
        // echo "<pre>"; print_r($newProducts);die;


 

        return view('Frontend.index',compact('page_name','featuresItemsChunk','featuredItemsCount','newProducts'));
    }
}
