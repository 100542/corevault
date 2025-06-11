<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class ApiController extends Controller
{
    /**
     * @return JsonResponse
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function getCryptoData(): JsonResponse
    {
        $symbols = ['BTCUSDT', 'ETHUSDT', 'SOLUSDT', 'XRPUSDT', 'ADAUSDT'];
        $interval = '1h';

        $cryptoData = [];
        foreach ($symbols as $symbol) {
            $response = Http::withoutVerifying()->get("https://api.binance.com/api/v3/klines", [ // in production, withoutVerifying weg. Dat is slecht.
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

    public function convertUsdToCrypto($usdAmount, $crypto)
    {
        $symbol = strtoupper($crypto) . 'USDT';

        $response = Http::withoutVerifying()->get('https://api.binance.com/api/v3/ticker/price', [
            'symbol' => $symbol
        ]);

        if (!$response->successful()) {
            throw new \Exception("Failed to fetch conversion rate for $symbol.");
        }

        $price = $response->json()['price'];

        return $usdAmount / (float) $price;
    }

}
