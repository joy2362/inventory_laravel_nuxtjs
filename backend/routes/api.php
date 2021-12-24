<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//auth
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('register', [UserAuthController::class,'register']);
    Route::post('login', [UserAuthController::class,'login']);
    Route::post('logout', [UserAuthController::class,'logout']);
    Route::post('refresh', [UserAuthController::class,'refresh']);
    Route::post('user', [UserAuthController::class,'me']);


});

//category
Route::group([

    'middleware' => 'api',
    'prefix' => 'category'

], function () {

    Route::get('index', [CategoryController::class,'index']);
    Route::get('delete/{id}', [CategoryController::class,'destroy']);
    Route::post('store', [CategoryController::class,'store']);
    Route::post('update/{id}', [CategoryController::class,'update']);

});

//unit
Route::group([

    'middleware' => 'api',
    'prefix' => 'unit'

], function () {

    Route::get('index', [UnitController::class,'index']);
    Route::get('delete/{id}', [UnitController::class,'destroy']);
    Route::post('store', [UnitController::class,'store']);
    Route::post('update/{id}', [UnitController::class,'update']);
});

//product
Route::group([

    'middleware' => 'api',
    'prefix' => 'product'

], function () {

    Route::get('index', [ProductController::class,'index']);
    Route::get('delete/{id}', [ProductController::class,'destroy']);
    Route::post('store', [ProductController::class,'store']);
    Route::post('update/{id}', [ProductController::class,'update']);
    Route::post('update-image/{id}', [ProductController::class,'update_image']);
});

//invoice
Route::post('sale/store', [InvoiceController::class,'store']);
