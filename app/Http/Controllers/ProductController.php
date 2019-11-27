<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Auth;
use Gate;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function addProduct() {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.product.add-product', [
            'categories'=>$categories,
            'brands'=>$brands
        ]);

    }
    public function saveProductInfo(Request $request) {
        $request->flush();
        $this->validate($request, [
            'category_id'=>'required',
            'brand_id'=>'required',
            'product_name' => 'required|max:50',
            'product_code' => 'required|max:30',
            'product_price' => 'required|numeric|digits_between:1,10',
            'product_discount' => 'required|numeric|max:99|min:0',
            'product_quantity' => 'required|numeric|min:1|max:100',
            'short_description' => 'required|max:100',
            'long_description' => 'required|MAX:550',
            'product_image' => 'required',
        ]);

        $productImage = $request->file('product_image');
        $imageName = $productImage->getClientOriginalName();
        $directory = 'product-images/';
        $temp = explode(".", $imageName);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $imgUrl = $directory.$newfilename;
        Image::make($productImage)->save($imgUrl);

        if ($request->product_image2){
            $productImage2 = $request->file('product_image2');
            $imageName2 = $productImage2->getClientOriginalName();
            $directory = 'product-images/';
            $temp2 = explode(".", $imageName2);
            $newfilename2 = round(microtime(true)) . '.' . end($temp2);
            $imgUrl2 = $directory.$newfilename2;
            Image::make($productImage2)->save($imgUrl2);
        }else{
            $imgUrl2="";
        }
        if ($request->product_image3){
            $productImage3 = $request->file('product_image3');
            $imageName3 = $productImage3->getClientOriginalName();
            $directory = 'product-images/';
            $temp3 = explode(".", $imageName3);
            $newfilename3 = round(microtime(true)) . '.' . end($temp3);
            $imgUrl3 = $directory.$newfilename3;
            Image::make($productImage3)->save($imgUrl3);
        }else{
            $imgUrl3="";
        }


        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->product_discount = $request->product_discount;
        $product->product_image = $imgUrl;
        $product->product_image2 = $imgUrl2;
        $product->product_image3 = $imgUrl3;
        $product->status = $request->status;
        $product->save();


        return redirect('/add-product')->with('message', 'Product info saved successfully');
    }
    public function manageProductInfo() {

        //$products = Product::all();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->orderBy('updated_at','desc')
            ->get();

        //return $products;

        return view('admin.product.manage-product', ['products'=>$products]);
    }
    public function viewProductInfo($id) {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->where('products.id', $id)
            ->first();


        return view('admin.product.view-product', ['product'=>$product]);
    }
    public function disabledProductInfo($id) {
        $productById = Product::find($id);
        $productById->status = 0;
        $productById->save();
        return redirect('manage-product')->with('message', 'product info unpublished successfully');
    }
    public function activeProductInfo($id) {
        $productById = Product::find($id);
        $productById->status = 1;
        $productById->save();
        return redirect('manage-product')->with('message', 'product info published successfully');
    }
    public function editProductInfo($id) {
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $product = Product::find($id);
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();


        return view('admin.product.edit-product', [
            'product'=>$product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    public function updateProductInfo(Request $request) {
        $product_image = $request->file('product_image');
        if($product_image) {
            $product = Product::find($request->product_id);
            // unlink($product->product_image);

            $productImage = $request->file('product_image');
            $imageName = $productImage->getClientOriginalName();
            $directory = 'product-images/';
            $temp = explode(".", $imageName);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $imgUrl = $directory.$newfilename;
            Image::make($productImage)->resize(200, 200)->save($imgUrl);


            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->product_price = $request->product_price;
            $product->product_quantity = $request->product_quantity;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->product_discount = $request->product_discount;
            $product->product_image = $imgUrl;
            $product->status = $request->status;
            $product->save();

        } else {
            $product = Product::find($request->product_id);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->product_price = $request->product_price;
            $product->product_quantity = $request->product_quantity;
            $product->short_description = $request->short_description;
            $product->long_description = $request->long_description;
            $product->product_discount = $request->product_discount;
            $product->status = $request->status;
            $product->save();
        }

        return redirect('manage-product');
    }
    public function productDetails($id){

        $productDetails=DB::table('products')
            ->join('categories','products.category_id','=','categories.id')
            ->join('users','users.id','=','products.customer_id')
            ->select('products.*','categories.category_name','users.name','users.id as uid')
            ->where('products.id','=',$id)
            ->first();

        if (isset($productDetails->uid) && $productDetails->uid!=Auth::user()->id){
            $updateView=Product::find($id);
            $updateView->view=$updateView->view+1;
            $updateView->save();
        }
        $relatedProducts=new Product();

        return view('font.home.home-product-details',['productDetails'=>$productDetails,'relatedProducts'=>$relatedProducts]);
    }
    public function viewProductDetails($id){
        $productDetails=DB::table('products')
            ->join('brands','products.brand_id','=','brands.id')
            ->join('categories','categories.id','=','products.category_id')
            ->select('products.*','brands.brand_name','categories.category_name')
            ->where('products.status','=',1)
            ->where('products.id','=',$id)
            ->first();

        $relatedProducts=new Product();
       //dd($productDetails);
        return view('frontEnd.home.product-details',['productDetails'=>$productDetails,'relatedProducts'=>$relatedProducts]);
    }

}
