<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('admin.category.add-category');
    }
    public function newCategory(Request $request){
        $this->validate($request, [
            'category_name'=>'required',
            'category_description'=>'required',

        ]);
        $CategoryImage=$request->file('category_image');


        if($CategoryImage) {


            $directory = 'brand-images/';
            $imageName = $CategoryImage->getClientOriginalName();
            $imageUrl = $directory . $imageName;
            Image::make($CategoryImage)->save($imageUrl);

            $category = new Category();
            $category->category_name = $request->category_name;
            $category->category_image = $imageUrl;
            $category->category_description = $request->category_description;
            $category->status = $request->status;
            $category->save();

            return redirect('/add-category');
        }else{
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->category_description = $request->category_description;
            $category->status = $request->status;
            $category->save();

            return redirect('/add-category')->with('message','Category Info saved Successfully!');
        }

    }
    public function manageCategoryInfo() {
        $allCategories = Category::all();
        return view('admin.category.manage-category', ['allCategories'=>$allCategories]);
    }

    public function disabledCategoryInfo($id) {
        $categoryById = Category::find($id);
        $categoryById->status = 0;
        $categoryById->save();
        return redirect('manage-category')->with('message', 'Category info Disabled successfully');
    }
    public function activeCategoryInfo($id) {
        $categoryById = Category::find($id);
        $categoryById->status = 1;
        $categoryById->save();
        return redirect('manage-category')->with('message', 'Category info activated successfully');
    }
    public function editCategoryInfo($id) {
        //$categoryById = Category::where('id', $id)->first();

        $categoryById = Category::find($id);
        return view('admin.category.edit-category', ['categoryById'=>$categoryById]);
    }

    public function updateCategoryInfo(Request $request) {
        $CategoryImage=$request->file('category_image');


        if($CategoryImage) {

            $categoryById = Category::find($request->t);

            $directory = 'brand-images/';
            $imageName = $CategoryImage->getClientOriginalName();
            $imageUrl = $directory . $imageName;
            Image::make($CategoryImage)->save($imageUrl);


            $categoryById->category_name = $request->category_name;
            $categoryById->category_image = $imageUrl;
            $categoryById->category_description = $request->category_description;
            $categoryById->status = $request->status;
            $categoryById->save();

            return redirect('/manage-category')->with('message', 'Category info update successfully');
        }else{
            $categoryById = Category::find($request->t);
            $categoryById->category_name = $request->category_name;
            $categoryById->category_description = $request->category_description;
            $categoryById->status = $request->status;
            $categoryById->save();
            return redirect('/manage-category')->with('message', 'Category info update successfully');
        }
    }

}
