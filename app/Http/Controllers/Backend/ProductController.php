<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\ProductsAttribute;
use App\Model\ProductsImage;
use App\Model\Section;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Session;

class ProductController extends Controller
{
    //product index page
    public function products()
    {
        Session::put('page', 'products');
        $data['products'] = Product::with(['category' => function ($query) {
            $query->select(['id', 'category_name']);
        }, 'section' => function ($query) {
            $query->select(['id', 'name']);
        },
        ])->orderby('id', 'desc')->get();

        return view('admin.products.products', $data);
    }

    //update product status active and inactive
    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }

    }

    //add edit product
    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add product";
            $product = new Product();
            $productData = array();
            $message = "Product added Succesfuly";
        } else {
            $title = "Edit Product";
            $productData = Product::find($id);
            $productData = json_decode(json_encode($productData), true);
            $product = Product::find($id);
            $message = "Product Updated Succesfuly";

        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            //validation
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\_\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\_\-]+$/u',
            ];

            //custom message
            $customMessage = [
                'category_id.required' => 'Category Name Is Required',
                'brand_id.required' => 'Brand Name Is Required',
                'product_name.required' => ' Product Name Is Required',
                'product_name.regex' => 'Valid Product Name Is Required',
                'product_code.required' => 'Product Code Is Required',
                'product_code.regex' => 'Valid Product Code Is Required',
                'product_price.required' => ' Product Price Is Required',
                'product_code.numeric' => 'Numeric Product Price Is Required',
                'product_color.required' => 'Product Color Is Required',
                'product_color.regex' => 'Valid Product Color Is Required',
                'main_image.required' => 'Image Field Is Required',
                'main_image.image' => 'Valid Image  Is Required',

            ];
            $this->validate($request, $rules, $customMessage);

            //upload Product  image
            if ($request->hasFile('main_image')) {
                $image_tmp = $request->file('main_image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate new Image Name
                    $imageName = $image_name . '-' . rand(111, 9999) . '.' . $extension;

                    //image folder path
                    $smallimagePath = 'images/products_images/small/' . $imageName;
                    $mediumimagePath = 'images/products_images/medium/' . $imageName;
                    $largeimagePath = 'images/products_images/large/' . $imageName;
                    //image resize
                    Image::make($image_tmp)->save($largeimagePath); //->resize(1040, 1200);
                    Image::make($image_tmp)->resize(520, 600)->save($mediumimagePath);
                    Image::make($image_tmp)->resize(260, 300)->save($smallimagePath);
                    //save main image in product table
                    $product->main_image = $imageName;
                }
            }

            //upload product video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    //Get video Extension
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    //Generate new video Name
                    $videoName = $video_name . '-' . rand(111, 9999) . '.' . $extension;
                    $videoPath = 'videos/product_videos/'; //video path
                    $video_tmp->move($videoPath, $videoName); //move video
                    //save Video in product table
                    $product->product_video = $videoName;
                }
            }

            //Save Product Details in Products Table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_weight = $data['product_weight'];
            $product->product_discount = $data['product_discount'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            $product->status = 1;
            $product->save();
            Session::flash('success', $message);
            return redirect('admin/products');

        }

     //product filters
     $productFilters = Product::productFilters();
      $fabricArray  = $productFilters['fabricArray'];
      $sleeveArray = $productFilters['sleeveArray'];
      $patternArray = $productFilters['patternArray'];
      $fitArray = $productFilters['fitArray'];
      $occasionArray = $productFilters['occasionArray'];

        //Sections with Categories and sub Categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);

        //Get all Brands
        $brands = Brand::where('status',1)->get();
        $brands = json_decode(json_encode($brands),true);



        return view('admin.products.add_edit_product', compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories', 'productData','brands'));
    }

    //deleted prdouct with image from server
    public function DeleteProduct($id)
    {
        //Get product
        $product = Product::where('id', $id)->first();

        //Get product Image Path
        $product_small_image_path = 'images/products_images/small/';
        $product_medium_image_path = 'images/products_images/medium/';
        $product_large_image_path = 'images/products_images/large/';
        //get product videos path
        $product_video_path = 'videos/product_videos/';

        //Delete product Image from product image folder if exists
        if (file_exists($product_small_image_path . $product->main_image)) {
            @unlink($product_small_image_path . $product->main_image);
        }
        if (file_exists($product_medium_image_path . $product->main_image)) {
            @unlink($product_medium_image_path . $product->main_image);
        }

        if (file_exists($product_large_image_path . $product->main_image)) {
            @unlink($product_large_image_path . $product->main_image);
        }

        //Delete product video from product video folder if exists

        if (file_exists($product_video_path . $product->product_video)) {
            @unlink($product_video_path . $product->product_video);
        }

        $product->delete();
        $msg = "Product  Has Been Deleted Succefully";
        Session::flash('success', $msg);
        return redirect()->back();

    }

    public function deleteProductImage($id)
    {
        //Get Category Image
        $product = Product::select('main_image')->where('id', $id)->first();

        //Get product Image Path
        $product_small_image_path = 'images/products_images/small/';
        $product_medium_image_path = 'images/products_images/medium/';
        $product_large_image_path = 'images/products_images/large/';

        //Delete product Image from product image folder if exists
        if (file_exists($product_small_image_path . $product->main_image)) {
            @unlink($product_small_image_path . $product->main_image);
        }
        if (file_exists($product_medium_image_path . $product->main_image)) {
            @unlink($product_medium_image_path . $product->main_image);
        }

        if (file_exists($product_large_image_path . $product->main_image)) {
            @unlink($product_large_image_path . $product->main_image);
        }

        //Delete Category Image From categories table
        Product::where('id', $id)->update(['main_image' => '']);

        $message = "Product Image Has Been Deleted Succefully";
        Session::flash('success', $message);
        return redirect()->back();
    }

    public function deleteProductVideo($id)
    {
        //Get product Image
        $product = Product::select('product_video')->where('id', $id)->first();
        $product_video_path = 'videos/product_videos/';

        //Delete product Image from product image folder if exists
        if (file_exists($product_video_path . $product->product_video)) {
            @unlink($product_video_path . $product->product_video);
        }

        //Delete product Image From products table
        Product::where('id', $id)->update(['product_video' => '']);

        $message = "Product Video Has Been Deleted Succefully";
        Session::flash('success', $message);
        return redirect()->back();

    }

    //add attributes

    public function addAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //validation
            $rules = [
                'sku' => 'required',
                'size' => 'required',
                'price' => 'required',
                'stock' => 'required',
            ];

            //custom message
            $customMessage = [
                'sku.required' => 'Sku Field Is Required',
                'size.required' => 'Size Field Is Required',
                'price.required' => 'Price Field Is Required',
                'stock.required' => 'Stock Field Is Required',

            ];
            $this->validate($request, $rules, $customMessage);
            // return $data;
            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {

                    $attrCountSKU = ProductsAttribute::where(['sku' => $val])->count();
                    if ($attrCountSKU > 0) {
                        return redirect()->back()->with('error_message', 'SKU already exists. Please add another SKU');
                    }

                    $attrCountSIZE = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSIZE > 0) {
                        return redirect()->back()->with('error_message', 'Size already exists. Please add another Size');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            $message = "Product Attribute has been added Succefully";
            Session::flash('success', $message);
            return redirect()->back();
        }
        $productData = Product::select('id', 'product_name', 'product_code', 'product_color', 'main_image')->with('attributes')->find($id);
        //return $productData;
        $productData = json_decode(json_encode($productData), true);
        return view('admin.products.add_attributes', compact('productData'));
    }

    public function editAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //return $data;
            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    ProductsAttribute::where(['id' => $data['attrId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            $message = "Product Attribute has been Updated Succefully";
            Session::flash('success', $message);
            return redirect()->back();
        }

    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }
    //deleted prdouct attribute
    public function DeleteAttribute($id)
    {
        //Get product
        $productAttribute = ProductsAttribute::where('id', $id);
        $productAttribute->delete();
        $message = "Product Attribute has been Deleted Succefully!";
        Session::flash('success', $message);
        return redirect()->back();
    }

    //add Images
    public function addImages(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                //echo "<pre>"; print_r($images);die;
                foreach ($images as $key => $image) {
                    $productImage = new ProductsImage;
                    $image_tmp = Image::make($image);
                    // echo  $originalName = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . time() . "." . $extension;
                    //image folder path
                    $smallimagePath = 'images/products_images/small/' . $imageName;
                    $mediumimagePath = 'images/products_images/medium/' . $imageName;
                    $largeimagePath = 'images/products_images/large/' . $imageName;
                    //image resize
                    Image::make($image_tmp)->save($largeimagePath); //->resize(1040, 1200);
                    Image::make($image_tmp)->resize(520, 600)->save($mediumimagePath);
                    Image::make($image_tmp)->resize(260, 300)->save($smallimagePath);
                    //save main image in product table
                    $productImage->image = $imageName;
                    $productImage->product_id = $id;
                    $productImage->status = 1;
                    $productImage->save();
                }
                $message = "Product Images has been Added Succefully!";
                Session::flash('success', $message);
                return redirect()->back();
            }
        }
        $productData = Product::select('id', 'product_name', 'product_code', 'product_color', 'main_image')->with('images')->find($id);
        $productData = json_decode(json_encode($productData), true);
        return view('admin.products.add_images', compact('productData'));

    }

    //image status
    public function updateImageStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }


    //delete Image with server
    public function DeleteImage($id)
    {
        //Get product Image
        $product = ProductsImage::select('image')->where('id', $id)->first();

        //Get product Image Path
        $product_small_image_path = 'images/products_images/small/';
        $product_medium_image_path = 'images/products_images/medium/';
        $product_large_image_path = 'images/products_images/large/';

        //Delete product Image from product image folder if exists
        if (file_exists($product_small_image_path . $product->image)) {
            @unlink($product_small_image_path . $product->image);
        }
        if (file_exists($product_medium_image_path . $product->image)) {
            @unlink($product_medium_image_path . $product->image);
        }

        if (file_exists($product_large_image_path . $product->image)) {
            @unlink($product_large_image_path . $product->image);
        }


        $product->delete();
        $msg = "Product Image  Has Been Deleted Succefully";
        Session::flash('success', $msg);
        return redirect()->back();

    }

}
