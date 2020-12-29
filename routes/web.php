<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Orders\BillController;
use App\Http\Controllers\Orders\LedgerController;
use App\Http\Controllers\Orders\PaymentCustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Suppliers\InvoiceController;
use App\Http\Controllers\Suppliers\SupplierController;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('auth')->namespace('auth')->name('auth.')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('loginIndex');
    Route::post('/login', [LoginController::class, 'login'])->name('doLogin');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('auth.loginIndex');
    })->name('logout');

    Route::get('/password-reset', [PasswordResetController::class, 'index'])->name('passwordResetIndex');
    Route::post('/password-reset', [PasswordResetController::class, 'sendToken'])->name('doPasswordReset');
    Route::get('/change-password/token={token}', [PasswordResetController::class, 'indexChangePassword'])->name('getChangePassword');
    Route::put('/change-password', [PasswordResetController::class, 'doChangePasswordReset'])->name('doChangePasswordReset');
});

Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('commons.index');
    })->name('index');

    Route::prefix('suppliers')->namespace('suppliers')->name('supplier.')->group(function () {
        Route::get('/invoice', [InvoiceController::class, 'list'])->name('invoice');

        Route::get('/invoice/{Invoice}', [InvoiceController::class, 'show'])->name('showInvoice');

        Route::post('/invoice', [InvoiceController::class, 'create'])->name('postInvoice');

        Route::post('/invoice-detail', [InvoiceController::class, 'createDetail'])->name('postInvoiceDetail');


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
        Route::prefix('bills')->name('bills.')->group(function () {
            Route::get('/', [BillController::class, 'indexAll'])->name('indexALl');
            Route::get('/delete/{codeorder}', [BillController::class, 'deleteCodeorderInBill'])->name('deleteCodeorderInBill');
            Route::get('/by-uname/{uname}', [BillController::class, 'indexAllByUname'])->name('indexAllByUname');
            Route::get('/log/{codeorder}', [BillController::class, 'loadLog'])->name('loadLog');
            Route::get('/{billcode}', [BillController::class, 'getBillById'])->name('getBillById');
            Route::get('/detail/{codeorder}', [BillController::class, 'getBilLDetailById'])->name('getBillDetailById');
            Route::put('/detail/{codeorder}', [BillController::class, 'UpdateBillDetailById'])->name('UpdateBillDetailById');
            Route::post('/', [BillController::class, 'create'])->name('create');
            Route::put('/update-fee/{codeorder}', [BillController::class, 'updateFee'])->name('updateFee');
            Route::put('/update-tracking/{codeorder}', [BillController::class, 'updateShipId'])->name('updateShipId');
            Route::post('/comment/{codeorder}', [BillController::class, 'comment'])->name('comment');
        });

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
        })->name('indexAll');

        Route::prefix('payment-customers')->name('payment-customers.')->group(function () {
            Route::get('/', [PaymentCustomerController::class, 'index'])->name('index');
            Route::put('/{Id}', [PaymentCustomerController::class, 'update'])->name('update');
        });

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

        Route::get('/search-code-order', [InvoiceController::class, 'searchCodeOrder'])->name('searchCodeOrder');

        Route::get('/search-code-jan', [InvoiceController::class, 'searchCodeJan'])->name('searchCodeJan');

        Route::get('/search-ma-hoa-don', [BillController::class, 'searchBillCode'])->name('searchBillCode');
    });
});
