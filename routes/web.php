<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountPermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\WalletController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

// Transaction Routes
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index')->middleware('auth');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store')->middleware('auth');
Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update')->middleware('auth');
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy')->middleware('auth');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create')->middleware('auth');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');

// Account Permission Route
Route::get('/account-permission', [AccountPermissionController::class, 'index'])->name('account-permission.index')->middleware('auth');
Route::post('/account-permission', [AccountPermissionController::class, 'store'])->name('account-permission.store')->middleware('auth');
Route::put('/account-permission/{id}', [AccountPermissionController::class, 'update'])->name('account-permission.update')->middleware('auth');
Route::delete('/account-permission/{id}', [AccountPermissionController::class, 'destroy'])->name('account-permission.destroy')->middleware('auth');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('throttle:3,1');


// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Registrasi Route
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Wallet Routes
Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index')->middleware('auth');
Route::post('/wallet/update', [WalletController::class, 'update'])->name('wallet.update')->middleware('auth');
Route::get('/wallet/deposit-withdrawal', [WalletController::class, 'depositWithdrawal'])->name('wallet.deposit_withdrawal')->middleware('auth');
Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit')->middleware('auth');
Route::post('/wallet/withdrawal', [WalletController::class, 'withdrawal'])->name('wallet.withdrawal')->middleware('auth');
