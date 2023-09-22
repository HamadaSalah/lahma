<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes([
    ['register' => false, 'reset' => false]
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/mycard', [App\Http\Controllers\HomeController::class, 'mycard'])->name('mycard');
Route::post('/addToCard', [App\Http\Controllers\HomeController::class, 'addToCard'])->name('addToCard');
Route::post('/mylogin', [App\Http\Controllers\HomeController::class, 'mylogin'])->name('mylogin');
Route::get('/products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('/categories', [App\Http\Controllers\HomeController::class, 'categories'])->name('categories');
Route::get('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->middleware('auth')->name('orders');
Route::get('/contactus', [App\Http\Controllers\HomeController::class, 'contactus'])->name('contactus');


Route::get('removeElement/{id}', function($id) {


    if(Session::get('mycart')) {
        $myarr = Session::get('mycart');
        unset($myarr[$id]);
        Session::put('mycart', $myarr);
    }

});
 