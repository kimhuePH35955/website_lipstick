<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\Order_UserController;
use App\Http\Controllers\Client\ShopController;



// API Routes for Products
Route::apiResource('products', ProductController::class);

// API Routes for Categories
Route::apiResource('categories', CategoryController::class);
Route::prefix('api')->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories/{id}', [CategoryController::class, 'edit']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
});
// API Routes for Users
Route::apiResource('users', UserController::class);

// API Routes for Orders
Route::apiResource('orders', OrderController::class);

// API Routes for Feedback
Route::apiResource('feedback', FeedbackController::class);

Route::prefix('api')->group(function () {
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart', [CartController::class, 'store']);
    Route::put('cart/{id}', [CartController::class, 'update']);
    Route::delete('cart/{id}', [CartController::class, 'destroy']);
});

// API Routes for Shop
Route::get('shop', [ShopController::class, 'index']);
Route::get('shop/{id}', [ShopController::class, 'show']);

// API Routes for User Orders
Route::get('user_order/{id}', [Order_UserController::class, 'index']);

                                                                                                                                                                                                           