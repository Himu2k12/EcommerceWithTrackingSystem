<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function RelatedProduct($id){
        return DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->select('products.*','categories.category_name')
            ->where('products.category_id','=',$id)
            ->orderBy('products.id','desc')
            ->get();
    }
}
