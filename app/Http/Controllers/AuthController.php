<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|object
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['message' => 'It looks like either the user does not exist or your password is incorrect. Please verify.']);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|object
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
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

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $user = User::where('username', $request->username)->first();
        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Account Created! Welcome to Corevault!');
    }

    /**
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|object
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/dashboard');
    }
}
