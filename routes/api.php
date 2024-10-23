<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('carts', CartController::class);
Route::post('/carts/{cart}/products', [CartController::class, 'addProducts']);
Route::delete('carts/{cart}/products/{product}', [CartController::class, 'destroyProduct']);

Route::apiResource('paymentMethods', PaymentMethodController::class);

Route::apiResource('products', ProductController::class);

Route::apiResource('orders', OrderController::class);
