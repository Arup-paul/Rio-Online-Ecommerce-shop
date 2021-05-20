<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $productRecord = [
            [
                'id'=>4,'category_id'=>2,'section_id'=>1,'brand_id'=>1,'product_name'=>'Blue T-shirt','product_code'=>'bt11','product_color'=>'Blue','product_price'=>'1200','product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image' =>'','description'=>'Test Product','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occasion'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'No','status'=>1
             ],
              [
                'id'=>5,'category_id'=>1,'section_id'=>2,'brand_id'=>3,'product_name'=>'Black T-shirt','product_code'=>'bt12','product_color'=>'Blue','product_price'=>'1200','product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image' =>'','description'=>'Test Product','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occasion'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'No','status'=>1
             ],
              [
                'id'=>3,'category_id'=>3,'section_id'=>1,'brand_id'=>2,'product_name'=>'White T-shirt','product_code'=>'bt90','product_color'=>'Blue','product_price'=>'1200','product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image' =>'','description'=>'Test Product','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occasion'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'No','status'=>1
             ],
            ];

             Product::insert($productRecord);


    }
}
