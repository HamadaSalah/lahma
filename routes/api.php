<?php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('order/{id}', function($id) {
    $order = Order::with('products','products.product', 'user')->findOrFail($id);
    return response()->json($order);
});
Route::get('removeElement/{id}', function($id) {
    dd(Session::get('mycart'));
    if(Session::get('mycart')) {
        $myarr = Session::get('mycart');
        unset($myarr[$id]);
        Session::put('mycart', $myarr);
    }

});