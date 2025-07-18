<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\InsightsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/crypto-data', [ApiController::class, 'getCryptoData'])->name('crypto.data');

Route::get('/register', function () {
    return view('register');
})->name('register.page');

Route::get('/login', function () {
    return view('login');
})->name('login.page');

Route::get('/', function () {
    return view('index');
})->name('index.page');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/editUsername', [ProfileController::class, 'editUsername'])->name('profile.editUsername');
    Route::post('/editPassword', [ProfileController::class, 'editPassword'])->name('profile.editPassword');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.page');
    Route::get('/insights', [InsightsController::class, 'index'])->name('insights.page');
    Route::post('/wallets/create', [WalletController::class, 'create'])->name('wallets.create');
    Route::post('/wallets/deposit', [WalletController::class, 'deposit'])->name('wallets.deposit');
    Route::post('wallets/withdraw', [WalletController::class, 'withdraw'])->name('wallets.withdraw');
    Route::get('/trade', [TradeController::class, 'index'])->name('trade.page');
    Route::post('/trade/send', [TradeController::class, 'sendMessage'])->middleware('auth')->name('trade.send');
    Route::post('/trade/wiretransfer', [TradeController::class, 'wireTransfer'])->middleware('auth')->name('trade.wiretransfer');
    Route::get('/market', [MarketController::class, 'index'])->name('market.page');
    Route::post('/market/deposit', [MarketController::class, 'marketDeposit'])->name('market.deposit');
    Route::post('/insights/chat', [InsightsController::class, 'generateTradingAdvice'])->name('insights.chat');
});
