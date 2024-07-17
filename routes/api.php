<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->middleware('api.guest');
    Route::post('/login', 'login')->middleware('api.guest');
    Route::post('/logout', 'logout')->middleware('api.auth');
});

Route::middleware('api.auth')->controller(ProductController::class)->prefix('products')->group(function () {
    Route::post('/create', 'store');
    Route::put('/update', 'update');
    Route::get('/show', 'show');
    Route::delete('/delete', 'destroy');
    Route::get('/search', 'search');
});

Route::middleware('api.auth')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'index')->middleware('api.auth');
    Route::get('/category_products', 'products')->middleware('api.auth');
});

Route::middleware('api.auth')->controller(BasketController::class)->prefix('basket')->group(function () {
    Route::post('/add', 'add');
    Route::get('/products', 'products');
    Route::get('/get', 'get');
    Route::post('/delete', 'delete');
    Route::post('/clear', 'clear');
});

Route::middleware('api.auth')->controller(UserController::class)->group(function () {
    Route::get('/buy', 'buyProduct');
    Route::get('/basket/buy', 'buyProductsFromBasket');
});
