<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function wallets()
    {
        $user = auth()->user();
        $wallets = $user->wallets()->withPivot('balance')->get();
        $totalBalance = $this->getTotalBalance();

        return view('dashboard', compact('user', 'wallets', 'totalBalance'));
    }

    public function getTotalBalance()
    {
        $user = Auth::user();

        $totalBalance = $user->wallets->sum(function ($wallet) {
            return $wallet->pivot->balance;
        });

        return $totalBalance;
    }
}
