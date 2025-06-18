<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class WalletController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function index()
    {
        $user = Auth::user();

        $wallets = $user->wallets;

        return view('wallets', compact('wallets', 'user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:wallets,name',
        ]);

        $user = Auth::user();

        $wallet = Wallet::create([
            'name' => $request->name,
            'address' => $this->generateWalletAddress(),
            'type' => $request->type,
        ]);

        $user->wallets()->attach($wallet->id, ['balance' => 0.0]);

        return redirect()->route('wallets.page')->with('success', 'Wallet created successfully!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function deposit(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $walletId = $request->wallet_id;
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

        return redirect()->route('wallets.page')->with('success', "Deposit successful! Converted {$usdAmount} USD to {$cryptoAmount} {$walletType}.");
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $walletId = $request->wallet_id;
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
            'balance' => $currentBalance - $cryptoAmount
        ]);

        return redirect()->route('wallets.page')->with('success', "Withdraw successful! Converted {$usdAmount} USD to {$cryptoAmount} {$walletType} and removed from your wallet.");
    }

    public function lowAutomatization(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'low' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $walletId = $request->wallet_id;
        $lowThreshold = $request->low;

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

        $currentBalance = $wallet->pivot->balance;
        $currentUsdValue = $currentBalance * $rate;

        if ($currentUsdValue <= $lowThreshold) {
            $user->wallets()->updateExistingPivot($walletId, [
                'balance' => 0
            ]);

            return redirect()->route('wallets.page')->with('success', "Wallet balance sold automatically as its USD value hit the low threshold.");
        }
    }

    /**
     * @return string
     */
    private function generateWalletAddress()
    {
        return '0x' . substr(md5(uniqid(mt_rand(), true)), 0, 40);
    }
}
