<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\WalletController;use App\Http\Controllers\DashboardController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/crypto-data', [ApiController::class, 'getCryptoData'])->name('crypto.data');

Route::get('/register', function () {
    return view('register');
})->name('register.page');

Route::get('/wallets', function() {
    return view('wallets', ['user' => Auth::user()]);
})->middleware('auth')->name('wallets.page');

Route::get('/login', function () {
    return view('login');
})->name('login.page');

Route::get('trade', function () {
    return view('trade');
})->name('trade.page');

Route::get('/market', function () {
    return view('market', ['user' => Auth::user()]);
})->middleware('auth')->name('market.page');

Route::get('/', function() {
    return view('index');
})->name('index.page');

Route::get('/dashboard', function () {
    return view('dashboard', ['user' => Auth::user()]);
})->middleware('auth')->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'wallets'])->name('dashboard')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.page');
    Route::post('/wallets/create', [WalletController::class, 'create'])->name('wallets.create');
});
