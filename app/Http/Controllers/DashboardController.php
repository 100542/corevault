<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function wallets()
    {
        $user = auth()->user();
        $wallets = $user->wallets()->withPivot('balance')->get();
        $totalBalance = $this->getTotalBalance();

        return view('dashboard', compact('user', 'wallets', 'totalBalance'));
    }

    /**
     * @return float|int
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function getTotalBalance()
    {
        $user = Auth::user();

        $totalUsdBalance = 0;

        foreach ($user->wallets as $wallet) {
            $balance = $wallet->pivot->balance;
            $walletType = strtoupper($wallet->type);
            $symbol = $walletType . 'USDT';

            $response = Http::withoutVerifying()->get("https://api.binance.com/api/v3/klines", [
                'symbol' => $symbol,
                'interval' => '1h',
                'limit' => 1
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $rate = (float) $data[0][4];
                $usdValue = $balance * $rate;
                $totalUsdBalance += $usdValue;
            }
        }

        return $totalUsdBalance;
    }
}
