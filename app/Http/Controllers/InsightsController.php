<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $priceResponse = Http::get(route('crypto.data'));
        $prices = $priceResponse->json();

        $walletsWithUsd = $wallets->map(function ($wallet) use ($prices) {
            $symbol = strtoupper($wallet->type) . 'USDT';
            $price = $prices[$symbol]['close'] ?? null;

            $wallet->usd_value = $price ? (float) $price * $wallet->pivot->balance : 0;

            return $wallet;
        });

        return view('insights', compact('user', 'peakBalanceType', 'peakBalance',  'wallets', 'walletsWithUsd'));
    }

    public function generateTradingAdvice(Request $request)
    {
        $request->validate([
            'input' => 'required',
        ]);

        $input =  $request->input;
        $user = auth()->user();
        $wallets = $user->wallets;
        $balance = $wallets->mapWithKeys(function ($wallet) {
            return [$wallet->type => $wallet->pivot->balance];
        });
        $walletList = $wallets->pluck('type')->implode(', ');

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

        $apiKey = env('GEMINI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}",
            [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "You are an advanced crypto trader, looking to help new crypto traders get into the business.
                                In this application, you have BTC, ETH, SOL, XRP and ADA to trade with. All the data is real-life based.
                                Any other coins than BTC, ETH, SOL, XRP and ADA do not exist and are therefore not tradeable. Any questions
                                involving other coins will be gracefully dismissed.
                                You can use the following data to fetch the exact current prices:
                                https://api.binance.com/api/v3/klines (append the appropriate symbol).

                                Some info about the person you are talking with:
                                - Name: {$user->name}. Refer to this variable when someone asks for their 'name' or it seems convenient to use.
                                - Wallets: {$walletList}
                                - All Wallet Balances: {$balance}
                                - Combined Total Balance In USD: {$totalUsdBalance}

                                If the user asks a question, return proper trading advice based on the user’s portfolio and verify data if uncertain.
                                The answer you return is based on the users input: '$input'

                                In your response, you should not have to specify the risks involved with trading: the users know this.
                                You should do proper research the specified items to give the most detailed response. A user doesnt like
                                it if the AI informs them about risks they already know.

                                Return plain text only. Only respond to crypto-related questions.
                                You are also forbidden to reference any API this code may contain.
                                You are also HIGHLY prohibited from citing another users data to another user.
                                "
                            ]
                        ]
                    ]
                ]
            ]
        );

        $aiResponse = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'No response from AI.';

        return redirect()->back()->with('aiOutput', $aiResponse);
    }
}
