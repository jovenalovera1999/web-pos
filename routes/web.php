<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
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

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/product/add', 'create');

    Route::post('/product/store', 'store');
});

Route::controller(CashierController::class)->group(function () {
    Route::get('/cashier', 'index');

    Route::post('/cashier/store', 'store');
});

Route::controller(DiscountController::class)->group(function () {
    Route::get('/discounts', 'index');
    Route::get('/discount/add', 'create');

    Route::post('/discount/store', 'store');
});

Route::controller(TransactionController::class)->group(function () {
    Route::get('/transactions', 'index');
    Route::get('/transaction/view/cart/{transaction_id}', 'showCart');
});
