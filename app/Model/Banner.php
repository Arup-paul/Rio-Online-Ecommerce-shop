<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function getBaners(){
        $getBanners = Banner::where('status','1')->get()->toArray();
        dd($getBanners) ; die;
     }
}
