<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Manager\ManagerProductController;
use App\Http\Controllers\Manager\ManagerTransactionController;
use App\Http\Controllers\Manager\ManagerSupplierController;

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

// Admin Routes
// Route::prefix('admin')->middleware(['auth', 'role:Admin'])->group(function () {
//     Route::view('/customers', 'backend.admin.customers.index')->name('admin.customers.index');
//     Route::view('/products', 'backend.admin.products.index')->name('admin.products.index');
//     Route::view('/reports', 'backend.admin.reports.index')->name('admin.reports.index');
//     Route::view('/suppliers', 'backend.admin.suppliers.index')->name('admin.suppliers.index');
//     Route::view('/transactions', 'backend.admin.transactions.index')->name('admin.transactions.index');
//     Route::view('/users', 'backend.admin.users.index')->name('admin.users.index');
//     Route::view('/settings', 'backend.admin.settings.index')->name('admin.settings.index');
// });

Route::prefix('admin')->name('backend.admin.')->middleware(['auth','role:Admin'])->group(function(){
        Route::resource('/customers', App\Http\Controllers\Admin\AdminCustomerController::class);
        Route::resource('/products', App\Http\Controllers\Admin\AdminProductController::class);
        Route::resource('/reports', App\Http\Controllers\Admin\AdminReportController::class);
        Route::resource('/suppliers', App\Http\Controllers\Admin\AdminSupplierController::class);
        Route::resource('/transactions', App\Http\Controllers\Admin\AdminTransactionController::class);
        Route::resource('/users', App\Http\Controllers\Admin\AdminUserController::class);
        Route::patch('users/{user}/status', [App\Http\Controllers\Admin\AdminUserController::class, 'updateStatus'])->name('users.updateStatus');
        Route::resource('/settings', App\Http\Controllers\Admin\AdminSettingController::class);
    });

Route::prefix('manager')->name('backend.manager.')->middleware(['auth','role:manager'])->group(function () {
    Route::resource('/customers', App\Http\Controllers\Manager\ManagerCustomerController::class);
        Route::post('/customers/{customer}/approve', [App\Http\Controllers\Manager\ManagerCustomerController::class, 'approve'])
        ->name('customers.approve');

    // Products
    Route::resource('/products', App\Http\Controllers\Manager\ManagerProductController::class);
    Route::post('/products/{product}/approve', [App\Http\Controllers\Manager\ManagerProductController::class, 'approve'])
        ->name('products.approve');

    // Reports
    Route::resource('/reports', App\Http\Controllers\Manager\ManagerReportController::class);

    // Suppliers
    Route::resource('/suppliers', App\Http\Controllers\Manager\ManagerSupplierController::class);
    Route::post('/suppliers/{supplier}/approve', [App\Http\Controllers\Manager\ManagerSupplierController::class, 'approve'])
        ->name('suppliers.approve');

    // Transactions
    Route::resource('/transactions', App\Http\Controllers\Manager\ManagerTransactionController::class);
    Route::post('/transactions/{transaction}/approve', [App\Http\Controllers\Manager\ManagerTransactionController::class, 'approve'])
        ->name('transactions.approve');
});



Route::prefix('operator')->name('backend.operator.')->middleware(['auth','role:operator'])->group(function(){
        Route::resource('/products', App\Http\Controllers\Operator\OperatorProductController::class);
        Route::resource('/transactions', App\Http\Controllers\Operator\OperatorTransactionController::class);
    });

 Route::prefix('supplier')->name('backend.supplier.')->middleware(['auth','role:supplier'])->group(function(){
        Route::resource('/products', App\Http\Controllers\Supplier\SupplierProductController::class);
        Route::resource('/transactions', App\Http\Controllers\Supplier\SupplierTransactionController::class);
    });

 Route::prefix('viewer')->name('backend.viewer.')->middleware(['auth','role:viewer'])->group(function(){
        Route::resource('/reports', App\Http\Controllers\Viewer\ViewerReportController::class);
    });














// // manager Routes
// Route::prefix('manager')->middleware(['auth', 'role:manager'])->group(function () {
//     Route::view('/customers', 'backend.manager.customers.index')->name('manager.customers.index');
//     Route::view('/products', 'backend.manager.products.index')->name('manager.products.index');
//     Route::view('/reports', 'backend.manager.reports.index')->name('manager.reports.index');
//     Route::view('/suppliers', 'backend.manager.suppliers.index')->name('manager.suppliers.index');
//     Route::view('/transactions', 'backend.manager.transactions.index')->name('manager.transactions.index');
//     Route::view('/users', 'backend.manager.users.index')->name('manager.users.index');
// });

// // sales Routes
// Route::prefix('sales')->middleware(['auth', 'role:sales'])->group(function () {
//     Route::view('/customers', 'backend.sales.customers.index')->name('sales.customers.index');
//     Route::view('/products', 'backend.sales.products.index')->name('sales.products.index');
//     Route::view('/reports', 'backend.sales.reports.index')->name('sales.reports.index');
//     Route::view('/suppliers', 'backend.sales.suppliers.index')->name('sales.suppliers.index');
//     Route::view('/transactions', 'backend.sales.transactions.index')->name('sales.transactions.index');
//     Route::view('/users', 'backend.sales.users.index')->name('sales.users.index');
// });

// // operator Routes
// Route::prefix('operator')->middleware(['auth', 'role:operator'])->group(function () {
//     Route::view('/customers', 'backend.operator.customers.index')->name('operator.customers.index');
//     Route::view('/products', 'backend.operator.products.index')->name('operator.products.index');
//     Route::view('/reports', 'backend.operator.reports.index')->name('operator.reports.index');
//     Route::view('/suppliers', 'backend.operator.suppliers.index')->name('operator.suppliers.index');
//     Route::view('/transactions', 'backend.operator.transactions.index')->name('operator.transactions.index');
//     Route::view('/users', 'backend.operator.users.index')->name('operator.users.index');
// });

// // viewer Routes
// Route::prefix('viewer')->middleware(['auth', 'role:viewer'])->group(function () {
//     Route::view('/customers', 'backend.viewer.customers.index')->name('viewer.customers.index');
//     Route::view('/products', 'backend.viewer.products.index')->name('viewer.products.index');
//     Route::view('/reports', 'backend.viewer.reports.index')->name('viewer.reports.index');
//     Route::view('/suppliers', 'backend.viewer.suppliers.index')->name('viewer.suppliers.index');
//     Route::view('/transactions', 'backend.viewer.transactions.index')->name('viewer.transactions.index');
//     Route::view('/users', 'backend.viewer.users.index')->name('viewer.users.index');
// });







// Remove default auth scaffolding route
// require __DIR__.'/auth.php';