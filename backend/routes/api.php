<?php

use App\Http\Controllers\CategoryController;
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

//auth
Route::group([

    'middleware' => 'api',
    'prefix' => 'category'

], function () {

    Route::get('index', [CategoryController::class,'index']);
    Route::get('delete/{id}', [CategoryController::class,'destroy']);
    Route::post('store', [CategoryController::class,'store']);

});
