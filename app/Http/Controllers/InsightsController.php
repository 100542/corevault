<?php

namespace App\Http\Controllers;

class InsightsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $wallets = $user->wallets;
        $returnBalance = $user->wallets()->withPivot('balance')->get();
        $peakBalanceType = $returnBalance->max(function ($wallet) {
            return $wallet->type;
        });
        $peakBalance = $returnBalance->max(function ($wallet) {
            return $wallet->pivot->balance;
        });

        return view('insights', compact('user', 'peakBalanceType', 'peakBalance'));
    }
}
