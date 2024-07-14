<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// User detail
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Products
Route::apiResource('/api-products', ProductController::class)->middleware('auth:sanctum');

// Categories
Route::apiResource('/api-categories', CategoryController::class)->middleware('auth:sanctum');

// Orders
Route::post('/api-orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
