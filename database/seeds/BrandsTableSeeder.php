<?php

use App\Model\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecordes = [
             ["id"=>1,"name"=>"Arrow","status"=>1],
             ["id"=>2,"name"=>"Gap","status"=>1],
             ["id"=>3,"name"=>"Lee","status"=>1],
        ];

        Brand::insert($brandRecordes);
    }
}
