<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Dashboard</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>

@include('nav')


<!-- Dashboard is een placeholder, even snel gemaakt met GPT. dit moet nog vervangen worden, maar dat is voor nu nog niet belangrijk -->
<body class="bg-gray-900 text-white flex flex-col items-center min-h-screen">

<div class="flex flex-col items-center w-full max-w-5xl px-6 pt-10 space-y-10">

    <div class="w-full bg-gray-800 p-8 border border-white/30 backdrop-blur-md rounded-lg shadow-lg text-center">
        <h1 class="text-4xl font-bold">Welcome to Corevault</h1>
        <h2 class="text-2xl font-light mt-4">
            Hello, <span class="font-semibold text-[#C9C7BA]">{{ $user->username }}</span>! Your crypto journey starts here.
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">

        <div class="flex flex-col items-center bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <h3 class="text-xl font-semibold">Your Portfolio</h3>
            <p class="text-3xl font-bold text-green-400 mt-2">$12,345.67</p>
            <p class="text-sm text-gray-400">Total Balance</p>
        </div>

        <div class="flex flex-col items-center bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <h3 class="text-xl font-semibold">Market Overview</h3>
            <div class="mt-4 space-y-2 text-center">
                <p><span class="font-semibold">Bitcoin:</span> $43,250 <span class="text-green-400">+2.5%</span></p>
                <p><span class="font-semibold">Ethereum:</span> $3,220 <span class="text-red-400">-1.2%</span></p>
                <p><span class="font-semibold">Solana:</span> $125.50 <span class="text-green-400">+4.1%</span></p>
            </div>
        </div>

        <div class="flex flex-col items-center bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
            <h3 class="text-xl font-semibold">Recent Transactions</h3>
            <ul class="mt-4 space-y-2 text-sm text-center">
                <li>✅ Bought 0.05 BTC - <span class="text-green-400">+$2,160</span></li>
                <li>❌ Sold 2.5 ETH - <span class="text-red-400">-$8,050</span></li>
                <li>✅ Deposited $500 - <span class="text-green-400">+$500</span></li>
            </ul>
        </div>

    </div>

    <div class="flex flex-wrap justify-center gap-4 w-full">
        <a href="#" class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-700 text-lg">Trade Now</a>
        <a href="#" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-700 text-lg">Deposit</a>
        <a href="#" class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-700 text-lg">Withdraw</a>
    </div>

    <a href="{{ route('logout') }}" class="px-6 py-3 bg-red-500 text-white rounded-md hover:bg-red-700 text-lg">
        Logout
    </a>

</div>

</body>
</html>
