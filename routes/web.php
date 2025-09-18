<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Manager\ManagerProductController;
use App\Http\Controllers\Manager\ManagerTransactionController;
use App\Http\Controllers\Manager\ManagerSupplierController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Manager\ManagerReportController;
use App\Http\Controllers\Operator\OperatorReportController;
use App\Http\Controllers\Operator\OperatorTransactionController;
use App\Http\Controllers\Supplier\SupplierReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\Operator\OperatorInboundController;
use App\Http\Controllers\Operator\OperatorOutboundController; 
use App\Http\Controllers\Report\ReportController;


// Landing page (guest)
Route::get('/', function () {
    return view('welcome');
});

// Auth routes (hanya untuk guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Logout hanya untuk user login
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard redirect sesuai role
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile umum
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// // Contoh route berdasarkan role
// Route::middleware(['auth', 'role:Admin'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
// });

// Route::middleware(['auth', 'role:Manager'])->group(function () {
//     Route::get('/reports', fn() => view('manager.reports'))->name('reports.index');
//     Route::get('/products', fn() => view('manager.products'))->name('products.index');
//     Route::get('/suppliers', fn() => view('manager.suppliers'))->name('suppliers.index');
//     Route::get('/customers', fn() => view('manager.customers'))->name('customers.index');
//     Route::get('/users', fn() => view('manager.users'))->name('reports.users');
//     Route::get('/transactions', fn() => view('manager.transactions'))->name('transactions.index');
// });

// Route::middleware(['auth', 'role:Staff'])->group(function () {
//     Route::get('/transactions', fn() => view('transactions.index'))->name('transactions.index');
// });



///route fitur sidebar 

// ================== ADMIN ==================
Route::prefix('admin')->name('backend.admin.')->middleware(['auth','role:Admin'])->group(function () {
    Route::resource('/customers', App\Http\Controllers\Admin\AdminCustomerController::class);
    Route::resource('/products', App\Http\Controllers\Admin\AdminProductController::class);
    Route::post('/products/{id}/validate', [App\Http\Controllers\Admin\AdminProductController::class, 'validateProduct'])->name('products.validate');

    Route::resource('/transactions', App\Http\Controllers\Admin\AdminTransactionController::class);
    Route::post('/transactions/{id}/validate', [App\Http\Controllers\Admin\AdminTransactionController::class, 'validateTransaction'])->name('transactions.validate');

    Route::resource('/suppliers', App\Http\Controllers\Admin\AdminSupplierController::class);

    Route::resource('/reports', App\Http\Controllers\Admin\AdminReportController::class);
    Route::post('/reports/generate', [AdminReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/{report}/download', [AdminReportController::class, 'download'])->name('reports.download');

    Route::resource('/users', App\Http\Controllers\Admin\AdminUserController::class);
    Route::patch('users/{user}/status', [App\Http\Controllers\Admin\AdminUserController::class, 'updateStatus'])->name('users.updateStatus');

    Route::resource('/settings', App\Http\Controllers\Admin\AdminSettingController::class);

    Route::resource('/landings', App\Http\Controllers\Admin\AdminLandingController::class);

    Route::post('/admin/generate-reset-link/{email}', [AdminResetPasswordController::class, 'generate'])
        ->name('generateResetLink');

        
//  // Tambahan route untuk compare dan approve
//     Route::get('transactions/{id}/compare', [App\Http\Controllers\Admin\AdminTransactionController::class, 'compare'])
//         ->name('transactions.compare');

//     Route::post('transactions/{id}/approve', [App\Http\Controllers\Admin\AdminTransactionController::class, 'approve'])
//         ->name('transactions.approve');

Route::get('/transactions/{id}/compare', [App\Http\Controllers\Admin\AdminTransactionController::class, 'compare'])->name('transactions.compare');
Route::post('/transactions/{id}/approve', [App\Http\Controllers\Admin\AdminTransactionController::class, 'approve'])->name('transactions.approve');
// routes/web.php
Route::get('/admin/transactions/compare/{invoice}', [App\Http\Controllers\Admin\AdminTransactionController::class, 'compare'])
    ->name('backend.admin.transactions.compare');


});

// Route::prefix('admin')->name('backend.admin.')->middleware(['auth','role:Admin'])->group(function(){
//         Route::resource('/customers', App\Http\Controllers\Admin\AdminCustomerController::class);
//         Route::resource('/products', App\Http\Controllers\Admin\AdminProductController::class);
//         Route::resource('/reports', App\Http\Controllers\Admin\AdminReportController::class);
//         Route::resource('/suppliers', App\Http\Controllers\Admin\AdminSupplierController::class);
//         Route::resource('/transactions', App\Http\Controllers\Admin\AdminTransactionController::class);
//         Route::resource('/users', App\Http\Controllers\Admin\AdminUserController::class);
//         Route::patch('users/{user}/status', [App\Http\Controllers\Admin\AdminUserController::class, 'updateStatus'])->name('users.updateStatus');
//         Route::resource('/settings', App\Http\Controllers\Admin\AdminSettingController::class);
//     });

// ================== MANAGER ==================
Route::prefix('manager')->name('backend.manager.')->middleware(['auth','role:Manager'])->group(function () {
    Route::resource('/customers', App\Http\Controllers\Manager\ManagerCustomerController::class);

    Route::resource('/products', App\Http\Controllers\Manager\ManagerProductController::class);
    Route::post('/products/{id}/approve', [App\Http\Controllers\Manager\ManagerProductController::class, 'approve'])->name('products.approve');
    Route::post('/products/{id}/reject', [App\Http\Controllers\Manager\ManagerProductController::class, 'reject'])->name('products.reject');

    Route::resource('/transactions', App\Http\Controllers\Manager\ManagerTransactionController::class);
    Route::post('/transactions/{id}/approve', [App\Http\Controllers\Manager\ManagerTransactionController::class, 'approve'])->name('transactions.approve');
    Route::post('/transactions/{id}/reject', [App\Http\Controllers\Manager\ManagerTransactionController::class, 'reject'])->name('transactions.reject');

    Route::resource('/suppliers', App\Http\Controllers\Manager\ManagerSupplierController::class);
    Route::resource('/reports', App\Http\Controllers\Manager\ManagerReportController::class);

    
     // Tampilkan daftar report dengan filter
    Route::get('/reports', [ManagerReportController::class, 'index'])->name('reports.index');

    // Generate report baru
    Route::post('/reports/generate', [ManagerReportController::class, 'generate'])->name('reports.generate');

    // Download report
    Route::get('/reports/download/{report}', [ManagerReportController::class, 'download'])->name('reports.download');

});

// Route::prefix('manager')->name('backend.manager.')->middleware(['auth','role:manager'])->group(function () {
//     Route::resource('/customers', App\Http\Controllers\Manager\ManagerCustomerController::class);
//         Route::post('/customers/{customer}/approve', [App\Http\Controllers\Manager\ManagerCustomerController::class, 'approve'])
//         ->name('customers.approve');

//     // Products
//     Route::resource('/products', App\Http\Controllers\Manager\ManagerProductController::class);
//     Route::post('/products/{product}/approve', [App\Http\Controllers\Manager\ManagerProductController::class, 'approve'])
//         ->name('products.approve');

//     // Reports
//     Route::resource('/reports', App\Http\Controllers\Manager\ManagerReportController::class);

//     // Suppliers
//     Route::resource('/suppliers', App\Http\Controllers\Manager\ManagerSupplierController::class);
//     Route::post('/suppliers/{supplier}/approve', [App\Http\Controllers\Manager\ManagerSupplierController::class, 'approve'])
//         ->name('suppliers.approve');

//     // Transactions
//     Route::resource('/transactions', App\Http\Controllers\Manager\ManagerTransactionController::class);
//     Route::post('/transactions/{transaction}/approve', [App\Http\Controllers\Manager\ManagerTransactionController::class, 'approve'])
//         ->name('transactions.approve');
// });

// ================== SUPPLIER ==================
Route::prefix('supplier')->name('backend.supplier.')->middleware(['auth','role:Supplier'])->group(function () {
    Route::resource('/products', App\Http\Controllers\Supplier\SupplierProductController::class);
    Route::resource('/transactions', App\Http\Controllers\Supplier\SupplierTransactionController::class);
    Route::resource('/profile', App\Http\Controllers\Supplier\SupplierProfileController::class)->only(['edit','update']);
        Route::resource('/reports', App\Http\Controllers\Supplier\SupplierReportController::class);
    // Generate report baru
    Route::post('/reports/generate', [SupplierReportController::class, 'generate'])->name('reports.generate');
    // Download report
    Route::get('/reports/download/{report}', [SupplierReportController::class, 'download'])->name('reports.download');

});

//  Route::prefix('supplier')->name('backend.supplier.')->middleware(['auth','role:supplier'])->group(function(){
//         Route::resource('/products', App\Http\Controllers\Supplier\SupplierProductController::class);
//         Route::resource('/transactions', App\Http\Controllers\Supplier\SupplierTransactionController::class);
//     });

// ================== OPERATOR ==================
Route::prefix('operator')->name('backend.operator.')->middleware(['auth','role:Operator'])->group(function () {

    // Product CRUD
    Route::resource('/products', App\Http\Controllers\Operator\OperatorProductController::class);

    // Transactions CRUD
    Route::resource('/transactions', App\Http\Controllers\Operator\OperatorTransactionController::class);

    // Inbound
    Route::get('/transactions/inbound/create', [App\Http\Controllers\Operator\OperatorTransactionController::class, 'createInbound'])
        ->name('transactions.inbound.create');
    Route::post('/transactions/inbound/store', [App\Http\Controllers\Operator\OperatorTransactionController::class, 'storeInbound'])
        ->name('transactions.inbound.store');

    // Outbound
    Route::get('/transactions/outbound/create', [App\Http\Controllers\Operator\OperatorTransactionController::class, 'createOutbound'])
        ->name('transactions.outbound.create');
    Route::post('/transactions/outbound/store', [App\Http\Controllers\Operator\OperatorTransactionController::class, 'storeOutbound'])
        ->name('transactions.outbound.store');

    // Reports
    Route::resource('/reports', App\Http\Controllers\Operator\OperatorReportController::class);
    Route::post('/reports/generate', [App\Http\Controllers\Operator\OperatorReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/download/{report}', [App\Http\Controllers\Operator\OperatorReportController::class, 'download'])->name('reports.download');

    // Scan
    Route::get('/scan', [App\Http\Controllers\Operator\ScanController::class, 'index'])->name('scan');
    Route::post('/scan', [App\Http\Controllers\Operator\ScanController::class, 'process'])->name('scan.process');
});




// ================== VIEWER ==================
Route::prefix('viewer')->name('backend.viewer.')->middleware(['auth','role:Viewer'])->group(function () {
    Route::resource('/reports', App\Http\Controllers\Viewer\ViewerReportController::class)->only(['index','show']);
});

//================= REPORT ADMIN & MANAGER & OPERATOR & SUPPLIER ==================
route::middleware(['auth','role:Admin,Manager,Operator,Supplier'])->group(function(){
Route::get('/reports/transactions',[App\Http\Controllers\Report\ReportController::class,'index'])->name('reports.transactions');
Route::get('/reports/transactions/export',[App\Http\Controllers\Report\ReportController::class,'export'])->name('reports.transactions.export');
Route::get('/reports/transactions/export-pdf', [App\Http\Controllers\Report\ReportController::class, 'exportTransactionsPdf'])->name('reports.transactions.export.pdf');

});


//================= admin report data ==================//

// Halaman pilih report
Route::middleware(['auth', 'role:admin,manager,supplier,operator'])->group(function () {
    
    // Form pilih jenis report
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Proses export PDF
    Route::post('/report/export', [ReportController::class, 'export'])->name('report.export');
});
