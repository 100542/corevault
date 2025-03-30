<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function wallets()
    {
        $user = auth()->user();
        $wallets = $user->wallets()->withPivot('balance')->get();

        return view('dashboard', compact('user', 'wallets'));
    }
}
