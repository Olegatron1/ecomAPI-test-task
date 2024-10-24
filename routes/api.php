<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::apiResource('carts', CartController::class);
Route::post('/carts/{cart}/products', [CartController::class, 'addProducts']);
Route::delete('carts/{cart}/products/{product}', [CartController::class, 'destroyProduct']);

Route::apiResource('paymentMethods', PaymentMethodController::class);

Route::apiResource('products', ProductController::class);

Route::apiResource('orders', OrderController::class);
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus']);
