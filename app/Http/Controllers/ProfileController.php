<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wallets = $user->wallets;

        return view('profile', compact('user', 'wallets'));
    }

    public function editUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users'
        ]);

        $user = auth()->user();

        $user->username = $request->input('username');
        $user->save();

        return redirect('/profile')->with('success', 'Username Updated');
    }

    public function editPassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[\W_]).+$/',
                'confirmed'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter and one special character.',
            'password.confirmed' => 'Passwords do not match. Please verify.'
        ]);

        $user = auth()->user();

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/profile')->with('success', 'Password Updated');
    }
}
