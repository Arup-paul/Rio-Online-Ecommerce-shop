<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Section;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Session;

class CategoryController extends Controller
{
    public function Categories()
    {
        Session::put('page', 'categories');
        $data['categories'] = Category::with('section', 'parentCategory')->get();
        // $data['categories'] = json_decode(json_encode($data['categories']));

        return view('admin.categories.categories', $data);
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id = null)
    {
        $data = [];
        if ($id == "") {
            //Add Category Functionality
            $title = "Add Category";
            $category = new Category;
            $categoryData = array();
            $getCategories = array();
            $msg = "Category Added Succesfully";
        } else {
            //Edit Category Functionality
            $title = "Edit Category";
            $categoryData = Category::where('id', $id)->first();
            $getCategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $categoryData['section_id']])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
            //  echo "<pre>";print_r($getCategories);die;
            $category = Category::find($id);
            $msg = "Category Updated Succesfully";

        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            //validation
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\_\-]+$/u',
                'category_image' => 'required|image',
                'parent_id' => 'required',
                'section_id' => 'required',
                'url' => 'required',
            ];

            //custom message
            $customMessage = [
                'category_name.required' => 'Category Name Is Required',
                'category_name.alpha' => 'Valid Category Name Is Required',
                'parent_id.required' => 'Category Level Is Required',
                'section_id.required' => 'Section Is Required',
                'category_image.required' => 'Category Image is Required',
                'category_image.image' => 'Valid Category Image is Required',
                'url.required' => ' Category Url is Required',
            ];
            $this->validate($request, $rules, $customMessage);

            //upload Category  image
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate new Image Name
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $imagePath = 'images/categories_images/' . $imageName;
                    Image::make($image_tmp)->resize(820, 600)->save($imagePath);
                    $category->category_image = $imageName;
                }
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->meta_description = $data['meta_description'];
            $category->status = 1;
            $category->save();
            Session::flash('success', $msg);
            return redirect('admin/categories');

        }

        //Get All Sections
        $getsections = Section::all();

        return view('admin.categories.add_edit_category', compact('title', 'getsections', 'categoryData', 'getCategories'));
    }

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            $getCategories = Category::with('subcategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
            return view('admin.categories.append_categories_level')->with(compact('getCategories'));

        }
    }

    public function deleteCategoryImage($id)
    {
        //Get Category Image
        $categoryImage = Category::select('category_image')->where('id', $id)->first();

        //Get Category Image Path
        $catgeory_image_path = 'images/categories_images/';

        //Delete Category Image from category image folder if exists
        if (file_exists($catgeory_image_path . $categoryImage->category_image)) {
            @unlink($catgeory_image_path . $categoryImage->category_image);
        }

        //Delete Category Image From categories table
        Category::where('id', $id)->update(['category_image' => '']);

        $msg = "Category Image Has Been Deleted Succefully";
        Session::flash('success', $msg);
        return redirect()->back();
    }

    public function DeleteCategory($id)
    {
        //Get Category Image
        $categoryImage = Category::where('id', $id)->first();

        //Get Category Image Path
        $catgeory_image_path = 'images/categories_images/';

        //Delete Category Image from category image folder if exists
        if (file_exists($catgeory_image_path . $categoryImage->category_image)) {
            @unlink($catgeory_image_path . $categoryImage->category_image);
        }

        $categoryImage->delete();
        $msg = "Category  Has Been Deleted Succefully";
        Session::flash('success', $msg);
        return redirect()->back();

    }
}
