<?php

use App\Model\Banner;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords = [
            ['id'=>1,'image'=>'1.png','link'=>'','title'=>'Black Jacket','alt'=>'Black Jacket','status'=>1],
            ['id'=>2,'image'=>'2.png','link'=>'','title'=>'Navy Blue T-Shirt','alt'=>'Black JackeNavy Blue T-Shirt','status'=>1],
            ['id'=>3,'image'=>'3.png','link'=>'','title'=>'Blue T-Shirt','alt'=>'Blue T-Shirt','status'=>1],
        ];
        Banner::insert($bannerRecords);
    }
}
