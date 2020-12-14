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

Route::prefix('supplier')->namespace('supplier')->name('supplier.')->group(function () {
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

Route::prefix('order')->namespace('order')->name('order.')->group(function () {
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
