<?php

use Illuminate\Database\Seeder;
use App\Model\ProductsImage;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $productImageRecords = [
          ['id'=>1,'product_id'=>1,'image'=>'353.jpg','status'=>1],
          ['id'=>2,'product_id'=>2,'image'=>'353.jpg','status'=>1],
      ];

      ProductsImage::insert($productImageRecords);
    }
}
