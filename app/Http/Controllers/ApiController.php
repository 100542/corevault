<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function getCryptoData(): JsonResponse
    {
        $symbols = ['BTCUSDT', 'ETHUSDT', 'SOLUSDT', 'XRPUSDT', 'ADAUSDT'];
        $interval = '1h';

        $cryptoData = [];
        foreach ($symbols as $symbol) {
            $response = Http::get("https://api.binance.com/api/v3/klines", [
                'symbol'   => $symbol,
                'interval' => $interval,
                'limit'    => 1
            ]);

            if ($response->successful()) {
                $data = $response->json();

                $cryptoData[$symbol] = [
                    'symbol'     => $symbol,
                    'open_time'  => $data[0][0],
                    'open'       => $data[0][1],
                    'high'       => $data[0][2],
                    'low'        => $data[0][3],
                    'close'      => $data[0][4],
                    'volume'     => $data[0][5],
                    'close_time' => $data[0][6],
                ];
            } else {
                $cryptoData[$symbol] = ['error' => 'Failed to fetch data'];
            }
        }

        return response()->json($cryptoData);
    }
}
