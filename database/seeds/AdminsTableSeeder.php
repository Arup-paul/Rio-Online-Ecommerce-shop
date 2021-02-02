<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
           [
               'id' => 1, 
               'name' => 'admin',
               'type' => 'admin',
               'mobile' => '01866702189',
               'email' => 'admin@admin.com',
               'password' => bcrypt('12345678'),
               'image' => '',
               'status' => 1
           ],
           [
            'id' => 2, 
            'name' => 'john',
            'type' => 'subadmin',
            'mobile' => '01866702189',
            'email' => 'john@admin.com',
            'password' => bcrypt('12345678'),
            'image' => '',
            'status' => 1
        ],
        [
            'id' => 3, 
            'name' => 'steve',
            'type' => 'subadmin',
            'mobile' => '01866702189',
            'email' => 'steve@admin.com',
            'password' => bcrypt('12345678'),
            'image' => '',
            'status' => 1
        ],
        [
            'id' => 4, 
            'name' => 'Arup',
            'type' => 'admin',
            'mobile' => '01866702189',
            'email' => 'arup@admin.com',
            'password' => bcrypt('12345678'),
            'image' => '',
            'status' => 1
        ],
        ];

        foreach($adminRecords as $key => $record){
            \App\Model\Admin::create($record);
        }
    }
}
