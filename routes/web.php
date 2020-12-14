<?php

use Illuminate\Support\Facades\Route;
    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('commons.index');
})->name('index');

Route::prefix('suppliers')->namespace('suppliers')->name('supplier.')->group(function () {
    Route::get('/invoice', function () {
        return view('suppliers.invoice');
    })->name('invoice');

    Route::get('/payments', function () {
        return view('suppliers.payments');
    })->name('payments');

    Route::get('/management', function () {
        return view('suppliers.management');
    })->name('management');

    Route::get('/payback', function () {
        return view('suppliers.payback');
    })->name('payback');

    Route::get('/supplier-debt', function () {
        return view('suppliers.debt');
    })->name('debt');
});

Route::prefix('orders')->namespace('orders')->name('order.')->group(function () {
    Route::get('/bill', function () {
        return view('orders.bill');
    })->name('bill');

    Route::get('/order', function () {
        return view('orders.order');
    })->name('order');

    Route::get('/order-detail', function () {
        return view('orders.order_detail');
    })->name('order-detail');

    Route::get('/ledger', function () {
        return view('orders.ledger');
    })->name('ledger');

    Route::get('/web-order', function () {
        return view('orders.web_order');
    })->name('web-order');

    Route::get('/payment-customers', function () {
        return view('orders.payment_customers');
    })->name('payment-customers');

    Route::get('/customer-debt', function () {
        return view('orders.customer_debt');
    })->name('customer-debt');
});

Route::prefix('warehouses')->namespace('warehouses')->name('warehouses.')->group(function () {
    Route::get('/imported', function () {
        return view('warehouses.imported');
    })->name('imported');

    Route::get('/exported', function () {
        return view('warehouses.exported');
    })->name('exported');

    Route::get('/inventory', function () {
        return view('warehouses.inventory');
    })->name('inventory');
});
