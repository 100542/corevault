<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'username' => 'test1',
            'password' => Hash::make('coolpasswordd')
        ]);
        User::create([
            'username' => 'test2',
            'password' => Hash::make('coolpasswordd')
        ]);
        User::create([
            'username' => 'test3',
            'password' => Hash::make('coolpasswordd')
        ]);
    }
}
