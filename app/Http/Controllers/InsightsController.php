<?php

namespace App\Http\Controllers;

class InsightsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('insights', compact('user'));
    }
}
