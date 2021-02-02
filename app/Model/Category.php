<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories(){
        return $this->hasMany('App\Model\Category','parent_id')->where('status',1);
    }

    public function section(){
        return $this->belongsTo('App\Model\Section','section_id')->select('id','name');
    }



    public function parentCategory(){
        return $this->belongsTo('App\Model\Category','parent_id')->select('id','category_name');
    }

    public static function  categoryDetails($url){
        $categoryDetails = Category::select('id','parent_id','category_name','url','description')->with(['subcategories' => function($query){
            $query->select('id','parent_id','category_name','url','description')->where('status',1);
        }])->where('url',$url)->first()->toArray();
        if($categoryDetails['parent_id'] == 0){
             $bredcrumbs = '<a href="'.url($categoryDetails['url']).'">'.$categoryDetails['category_name'].'</a>';
        }else{
            $parentCategory = Category::select('category_name','url')->where('id',$categoryDetails['parent_id'])->first()->toArray();
            $bredcrumbs = '<a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a> &nbsp;&nbsp;  <span class="divider">/</span>  <a href="'.url($categoryDetails['url']).'">'.$categoryDetails['category_name'].'</a>';
        }
       $catIds = array();
       $catIds[] =  $categoryDetails['id'];

       foreach($categoryDetails['subcategories'] as $key => $subcat){
          $catIds[] = $subcat['id'];
       }

       return array('catIds'=> $catIds,'categoryDetails'=>$categoryDetails,'bredcrumbs'=>$bredcrumbs);
    }
}
