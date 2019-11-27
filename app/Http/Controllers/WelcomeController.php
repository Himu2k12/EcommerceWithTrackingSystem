<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $allProducts=Product::where('status',1)->get();
        $allCategories= DB::table('categories')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();
        $allBrands=Brand::all();
        return view('frontEnd.home.home-page',[
            'allProducts'=>$allProducts,
            'allCategories'=>$allCategories,
            'allBrands'=>$allBrands,

        ]);
    }
}
