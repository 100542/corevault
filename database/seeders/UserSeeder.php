<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            'Gerald',
            'Cryptomaster33',
            'Johan7',
            'TradingPro42',
            'CryptoQueen',
            'BlockchainBob',
            'FinanceGuru99',
            'CoinCollector',
            'WalletWizard',
            'InvestorPro',
            'CryptoKing88',
            'TokenTrader',
            'BitMaster',
            'HashHunter',
            'DigitalDragon',
            'CoinKeeper',
            'MarketMaster',
            'TradeExpert',
            'ChainChampion',
            'CryptoNinja'
        ];

        foreach ($users as $username) {
            User::create([
                'username' => $username,
                'password' => Hash::make('coolpasswordd')
            ]);
        }
    }
}
