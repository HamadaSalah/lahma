<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

if (! function_exists('getPrice')) {
    function getPrice($id) {
        $product = SubProduct::find($id);
        if($product) {
            return $product->price;
        }
        else {
            $product2 = Product::find($id);
            if($product2) {
                return $product2->price;
            }
            else {
                return 0;
            }
        }
    }
}

if(!function_exists('cartCount')) {
    function cartCount(){
        if(Session::get('mycart')) {
            return count(Session::get('mycart'));
        }
    }
}
if(!function_exists('allCats')) {
    function allCats(){
        return Category::where('category_id', NULL)->get();
    }
}