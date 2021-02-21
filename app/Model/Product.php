<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Model\Category','category_id');
    }

    public function section(){
        return $this->belongsTo('App\Model\Section','section_id')->select('id','name');
    }

    public function brand(){
        return $this->belongsTo('App\Model\Brand','brand_id')->select('id','name');
    }

    public function attributes(){
        return $this->hasMany('App\Model\ProductsAttribute');
    }
    public function images(){
        return $this->hasMany('App\Model\ProductsImage');
    }

    public static function productFilters(){
        $productFilters['fabricArray'] = array('Cotton', 'Polyester', 'Wool');
        $productFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleevless');
        $productFilters['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $productFilters['fitArray'] = array('Regualr', 'Slim');
        $productFilters['occasionArray'] = array('Casual', 'Formal');
        return $productFilters;
    }


    public static function getDiscountPrice($product_id){
        $proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
        if($proDetails['product_discount'] > 0){
              $discounted_price = $proDetails['product_price'] - ($proDetails['product_discount'] * $proDetails['product_discount']/100);
        }else if($proDetails['category_discount'] > 0){
           $discounted_price =   $proDetails['product_price'] - ($proDetails['product_price']*$catDetails['category_discount']/100);
        }else{
            $discounted_price = 0;
        }
        return $discounted_price;
    }
}
