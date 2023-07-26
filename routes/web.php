<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();

// Start Admin part

Route::middleware("admin")->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    //Category
    Route::get('/category/create',[CategoryController::class,'create']);
    Route::post('/category/store',[CategoryController::class,'store']);
    Route::get('/category',[CategoryController::class,'index']);
    Route::delete('/category/delete/{id}',[CategoryController::class,'delete']);
    Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
    Route::put('/category/update/{id}',[CategoryController::class,'update']);
    //Product
    Route::resource('product',ProductController::class);

    //Order
    Route::get('/order',[ProductController::class,'order']);
    Route::delete('/order/{id}',[ProductController::class,'delete_order']);
    Route::get('/order/edit/{id}',[ProductController::class,'edit_order']);
    Route::post('/delivered/{id}',[ProductController::class,'delivered']);

    //Brand Category
    Route::get('/brand/create',[BrandController::class,'create']);
    Route::post('/brand/store',[BrandController::class,'store']);
    Route::get('/brand',[BrandController::class,'index']);
    Route::delete('/brand/delete/{id}',[BrandController::class,'delete']);
    Route::get('/brand/edit/{id}',[BrandController::class,'edit']);
    Route::put('/brand/update/{id}',[BrandController::class,'update']);
});

//End Admin Part

// Start Customer part

Route::get('/',[HomeController::class,'index']);
Route::get('/products',[CustomerController::class,'products']);

Route::middleware('auth')->group(function(){
    Route::post('/add_to_cart/{id}',[CustomerController::class,'add_to_cart']);
    Route::get('/carts',[CustomerController::class,'show_carts']);
    Route::delete('/destroy_cart/{id}',[CustomerController::class,'destroy_cart']);
    Route::post('/cash_delivery',[CustomerController::class,'cash_delivery']);
    //order part
    Route::get('/orders',[CustomerController::class,'show_orders']);
    Route::delete('/destroy_order/{id}',[CustomerController::class,'destroy_order']);
    Route::post('/order_confirmed/{id}',[ProductController::class,'order_confirmed']);
});
//End Customer part
