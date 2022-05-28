<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Merchants\StoreController;
use App\Http\Controllers\Merchants\ProductController;
use App\Http\Controllers\Consumers\CartController;

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
Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth')->group(function () {
    Route::post('store', [StoreController::class, 'store']);
    Route::put('store/{store}', [StoreController::class, 'update']);
    Route::post('product', [ProductController::class, 'store']);
    Route::post('cart/add', [CartController::class, 'add']);
});
