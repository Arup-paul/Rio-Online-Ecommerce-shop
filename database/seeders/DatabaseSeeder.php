<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CouponTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(AdminsTableSeeder::class);
//         $this->call(SectionTableSeeder::class);
//        $this->call(CategoryTableSeeder::class);
//        $this->call(ProductTableSeeder ::class);
//         $this->call(ProductAttributesSeeder ::class);
//         $this->call(ProductsImagesTableSeeder ::class);
        //  $this->call(BrandsTableSeeder ::class);
        //   $this->call(BannerTableSeeder ::class);
          $this->call(CouponTableSeeder ::class);

    }
}
