<?php

use App\Models\Product;
use App\Models\SubProduct;

if (! function_exists('getPrice')) {
    function getPrice($id) {
        $product = SubProduct::find($id);
        if($product) {
            return $product->price;
        }
        else {
            $product2 = SubProduct::find($id);
            if($product2) {

                return $product->price;
            }
            else {
                return 0;
            }
        }
        // ...
    }
}
