<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $wallets = $user->wallets;

        return view('wallets', compact('wallets', ));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:wallets,name',
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

    private function generateWalletAddress()
    {
        return '0x' . substr(md5(uniqid(mt_rand(), true)), 0, 32);
    }
}
