<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OptionsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubProductController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->middleware('guest:admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('doLogin');
    Route::post('/login', [LoginController::class, 'doLogin'])->name('login');
});
Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::get('/index', [LoginController::class, 'index'])->name('index');
    //begin of resources
    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('subproducts', SubProductController::class);
    Route::resource('options', OptionsController::class);
    Route::resource('orders', OrdersController::class);
    Route::get('categories/{id}', [CategoryController::class, 'categories'])->name('categories');
    Route::resource('sliders', SliderController::class);
    Route::get('notification', [CategoryController::class, 'notification'])->name('notification');
    Route::post('notification', [CategoryController::class, 'SendNotification'])->name('SendNotification');
    Route::resource('settings', SettingsController::class);

    // Route::get('subproducts/{id}', [ProductController::class, 'subproducts'])->name('subproducts');
    // Route::put('subproducts/{id}', [ProductController::class, 'subproducts'])->name('subproducts');
    // Route::delete('subproducts/{id}', [ProductController::class, 'subproducts'])->name('subproducts');
});
