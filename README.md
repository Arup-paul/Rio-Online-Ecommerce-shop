

## RIO online Shopping Cart


## pacakages  Used

## Installation Instruction

- Clone the repo
- web.php  comment for this code
```
  $catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();

  foreach($catUrls as $url){
    Route::get('/'.$url,'ProductsController@listing');
  }
  ```
- Run 'composer install'
- Run  ' .env.example Replace .env'
- Run 'php artisan migrate --seed'


 


