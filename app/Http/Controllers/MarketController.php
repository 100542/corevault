<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wallets = $user->wallets;

        return view('market', compact('user', 'wallets'));
    }

    public function marketDeposit(Request $request)
    {
        $request->validate([
            'currency' => 'required|exists:wallets,type',
            'amount' => 'required|numeric|min:0.01',
            'wallet' => 'required|exists:wallets,id'
        ]);

        $user = auth()->user();
        $walletId = $request->wallet;
        $usdAmount = $request->amount;

        $wallet = $user->wallets()->where('wallet_id', $walletId)->first();

        if (!$wallet) {
            return redirect()->back()->with('error', 'Unauthorized access to this wallet.');
        }

        $walletType = strtoupper($wallet->type);
        $symbol = $walletType . 'USDT';

        $response = Http::withoutVerifying()->get("https://api.binance.com/api/v3/klines", [
            'symbol' => $symbol,
            'interval' => '1h',
            'limit' => 1
        ]);

        if (!$response->successful()) {
            return redirect()->back()->with('error', 'Failed to fetch exchange rate.');
        }

        $data = $response->json();
        $rate = (float) $data[0][4];

        $cryptoAmount = $usdAmount / $rate;

        $currentBalance = $wallet->pivot->balance;

        $user->wallets()->updateExistingPivot($walletId, [
            'balance' => $currentBalance + $cryptoAmount
        ]);

        return redirect()->route('market.page')->with('success', "Deposit successful! Converted {$usdAmount} USD to {$cryptoAmount} {$walletType}.");
    }
}
