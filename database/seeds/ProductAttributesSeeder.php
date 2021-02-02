<?php

use Illuminate\Database\Seeder;
use App\Model\ProductsAttribute;

class ProductAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productttributeARecords = [
            ['id'=>1,'product_id'=>1,'size'=>'small','price'=>120,'stock'=>10,'sku'=>'BT001-S','status'=>1],
            ['id'=>2,'product_id'=>2,'size'=>'Medium','price'=>220,'stock'=>20,'sku'=>'BT001-M','status'=>1],
            ['id'=>3,'product_id'=>3,'size'=>'Large','price'=>220,'stock'=>30,'sku'=>'BT001-L','status'=>1],
        ];

        ProductsAttribute::insert($productttributeARecords);
    }
}
