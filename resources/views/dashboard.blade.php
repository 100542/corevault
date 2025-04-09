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

<body class="bg-[#040604] text-white min-h-screen font-sans">
@include('nav')

<main class="p-10">
    <div class="mb-12">
        <h1 class="text-4xl text-[#C4FFCE] font-bold">Dashboard Overview</h1>
        <p class="text-gray-400 mt-2">Welcome back, <span class="text-[#C4FFCE] font-semibold">{{ $user->username }}</span>!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-12">
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-sm text-[#040604]">Wallet Overview</p>
            @foreach ($wallets as $wallet)
            <h2 class="text-2xl text-[#040604] font-bold mt-2">{{ $wallet->name }}: <span class="font-black">{{ $wallet->type }}</span></h2>
            @endforeach
        </div>
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-sm text-[#040604]">Current Highest Return Rate</p>
            <h2 id="highestReturn" class="text-[#040604] font-black text-lg my-4">Loading...</h2>
        </div>
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-sm text-[#040604]">Current Lowest Return Rate</p>
            <h2 id="lowestReturn" class="text-[#040604] font-black text-lg my-4">Loading...</h2>
        </div>
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-sm text-[#040604]">Time And Date (European Format)</p>
            <h2 id="timeTracker" class="text-[#040604] text-3xl font-black mt-2">Loading...</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-[#040604] mb-1">Your Total Account Value</p>
            <h2 class="text-4xl text-[#040604] font-black">${{ number_format($totalBalance, 2) }}</h2>
        </div>
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-[#040604] mb-1">Most Relevant Connection</p>
            <h2 class="text-2xl text-[#040604] font-black">Testuser</h2>
            <p class="text-[#040604] text-sm mt-1">9 gazillion dollars sent (Nog niet ontwikkeld)</p>
        </div>
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-[#040604] mb-1">Most Recent Transfer</p>
            <h2 class="text-2xl text-[#040604] font-black">$127,456.49</h2>
            <p class="text-[#040604] text-sm mt-1">to Testuser</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <h2 class="text-2xl text-[#040604] font-bold mb-4">Your Portfolio</h2>
            <div class="space-y-4 max-h-72 overflow-y-auto">
                @foreach($wallets as $wallet)
                    <div class="bg-[#040604] p-4 rounded-xl hover:bg-[#475569] transition-all">
                        <h3 class="text-lg text-[#C4FFCE] font-semibold">{{ $wallet->name }}</h3>
                        <p class="text-sm text-[#8DB295]">{{ ucfirst($wallet->type) }} Wallet</p>
                        <p class="text-white/80 text-lg font-medium mt-1">
                            Balance: ${{ number_format($wallet->pivot->balance, 2) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <h2 class="text-2xl text-[#040604] font-bold mb-4">Inbox</h2>
            <div class="bg-[#040604] p-4 rounded-xl text-center">
                <p class="text-lg text-[#C4FFCE] font-semibold">No new messages. (Nog niet ontwikkeld, oeps)</p>
            </div>
        </div>

        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <h2 class="text-2xl text-[#040604] font-bold mb-4">Recent Transactions</h2>
            <div class="space-y-4 max-h-72 overflow-y-auto">
                <div class="bg-[#040604] p-4 rounded-xl text-center">
                    <p class="text-lg text-[#C4FFCE] font-semibold">No recent transactions. (Ook nog niet ontwikkeld)</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 -z-10 opacity-10 overflow-x-hidden flex flex-row justify-center gap-4 max-w-[97dvw] items-end">
        <div class="h-[320px] w-14 bg-[#7CD789]"></div>
        <div class="h-[600px] w-14 bg-[#8DB295]"></div>
        <div class="h-[450px] w-14 bg-[#7CD789]"></div>
        <div class="h-[510px] w-14 bg-[#8DB295]"></div>
        <div class="h-[390px] w-14 bg-[#7CD789]"></div>
        <div class="h-[470px] w-14 bg-[#8DB295]"></div>
        <div class="h-[520px] w-14 bg-[#7CD789]"></div>
        <div class="h-[360px] w-14 bg-[#8DB295]"></div>
        <div class="h-[590px] w-14 bg-[#7CD789]"></div>
        <div class="h-[300px] w-14 bg-[#7CD789]"></div>
        <div class="h-[580px] w-14 bg-[#8DB295]"></div>
        <div class="h-[460px] w-14 bg-[#7CD789]"></div>
        <div class="h-[500px] w-14 bg-[#8DB295]"></div>
        <div class="h-[340px] w-14 bg-[#7CD789]"></div>
        <div class="h-[480px] w-14 bg-[#8DB295]"></div>
        <div class="h-[530px] w-14 bg-[#7CD789]"></div>
        <div class="h-[310px] w-14 bg-[#7CD789]"></div>
        <div class="h-[560px] w-14 bg-[#8DB295]"></div>
        <div class="h-[440px] w-14 bg-[#7CD789]"></div>
        <div class="h-[490px] w-14 bg-[#8DB295]"></div>
        <div class="h-[370px] w-14 bg-[#7CD789]"></div>
        <div class="h-[455px] w-14 bg-[#8DB295]"></div>
        <div class="h-[540px] w-14 bg-[#7CD789]"></div>
        <div class="h-[350px] w-14 bg-[#8DB295]"></div>
        <div class="h-[570px] w-14 bg-[#7CD789]"></div>
        <div class="h-[330px] w-14 bg-[#7CD789]"></div>
        <div class="h-[585px] w-14 bg-[#8DB295]"></div>
        <div class="h-[430px] w-14 bg-[#7CD789]"></div>
        <div class="h-[510px] w-14 bg-[#8DB295]"></div>
        <div class="h-[390px] w-14 bg-[#7CD789]"></div>
        <div class="h-[460px] w-14 bg-[#8DB295]"></div>
        <div class="h-[520px] w-14 bg-[#7CD789]"></div>
        <div class="h-[315px] w-14 bg-[#7CD789]"></div>
        <div class="h-[595px] w-14 bg-[#8DB295]"></div>
        <div class="h-[445px] w-14 bg-[#7CD789]"></div>
        <div class="h-[505px] w-14 bg-[#8DB295]"></div>
        <div class="h-[375px] w-14 bg-[#7CD789]"></div>
        <div class="h-[455px] w-14 bg-[#8DB295]"></div>
    </div>
</main>
<script src="/js/dashboardMarket.js"></script>
<script src="/js/timeTracker.js"></script>
</body>
</html>
