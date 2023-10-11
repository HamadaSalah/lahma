<?php

use App\Http\Controllers\Api\CategoryController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/cat-with-products', [CategoryController::class, 'index'])->name('index');
Route::get('/product/{id}', [CategoryController::class, 'product'])->name('product');
Route::get('/aboutus', [CategoryController::class, 'aboutUs'])->name('aboutUs');
Route::post('/register', [CategoryController::class, 'register'])->name('register');
Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
Route::get('/category/{id}', [CategoryController::class, 'category'])->name('category');
Route::get('/slider', [CategoryController::class, 'slider'])->name('slider');
Route::post('/search', [CategoryController::class, 'search'])->name('search');
Route::post('/rate/{id}', [CategoryController::class, 'rate'])->name('rate');
Route::post('/contacts', [CategoryController::class, 'contactsForm'])->name('contactsForm');



Route::group([

    'middleware' => 'auth:api',

], function ($router) {
    Route::get('/orders', [CategoryController::class, 'orders'])->name('orders');
    Route::post('/checkout', [CategoryController::class, 'checkout'])->name('checkout');

});
















//for web
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