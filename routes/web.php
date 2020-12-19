<?php

use App\Http\Controllers\Orders\LedgerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Suppliers\InvoiceController;
use App\Http\Controllers\Suppliers\SupplierController;

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
    Route::get('/invoice', [InvoiceController::class, 'list'])->name('invoice');

    Route::get('/invoice/{Invoice}', [InvoiceController::class, 'show'])->name('showInvoice');

    Route::post('/invoice', [InvoiceController::class, 'create'])->name('postInvoice');

    Route::post('/invoice-detail', [InvoiceController::class, 'createDetail'])->name('postInvoiceDetail');

    Route::get('/list-code-order', [InvoiceController::class, 'searchCodeOrder'])->name('listCodeOrder');

    Route::get('/list-code-jan', [InvoiceController::class, 'searchCodeJan'])->name('listCodeJan');

    Route::post('/invoice/{Invoice}', [InvoiceController::class, 'updateInvoice'])->name('updateInvoice');

    Route::get('/payments', function () {
        return view('suppliers.payments');
    })->name('payments');

    Route::get('/management', [SupplierController::class, 'list'])->name('management');
    Route::post('/management', [SupplierController::class, 'create'])->name('create-management');
    Route::get('/management/{code_name}', [SupplierController::class, 'show'])->name('show-management');
    Route::put('/management/{code_name}', [SupplierController::class, 'update'])->name('update-management');

    Route::get('/payback', function () {
        return view('suppliers.payback');
    })->name('payback');

    Route::get('/supplier-debt', function () {
        return view('suppliers.debt');
    })->name('debt');
});

Route::prefix('orders')->namespace('orders')->name('orders.')->group(function () {
    Route::get('/bill', function () {
        return view('orders.bill');
    })->name('bill');

    Route::get('/order', function () {
        return view('orders.order');
    })->name('order');

    Route::get('/order-detail', function () {
        return view('orders.order_detail');
    })->name('order-detail');


    Route::prefix('ledgers')->name('ledgers.')->group(function () {
        Route::get('/', [LedgerController::class, 'index'])->name('index');
        Route::post('/', [LedgerController::class, 'create'])->name('create');
        Route::get('/{Id}', [LedgerController::class, 'get'])->name('get');
        Route::put('/{Id}', [LedgerController::class, 'update'])->name('update');
        Route::get('/delete/{Id}', [LedgerController::class, 'delete'])->name('delete');
    });

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

Route::prefix('commons')->name('commons.')->group(function () {
    Route::get('/search-user', [LedgerController::class, 'searchUser'])->name('search-user');
});
