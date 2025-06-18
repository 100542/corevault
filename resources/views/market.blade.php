<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Market</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-[#040604] text-white overflow-x-hidden">
@include('nav')

<main class="p-10">
<div class="mb-12">
    <h1 class="text-4xl text-[#C4FFCE] font-bold">Market Overview</h1>
    <p class="text-gray-400 mt-2">Welcome back, <span class="text-[#C4FFCE] font-semibold">{{ $user->username }}</span>!</p>
</div>

    @if(session('success'))
        <div class="absolute top-6 items-center">
            <div class="bg-[#C4FFCE] text-[#040604] font-bold p-4 rounded-md shadow-md">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="absolute top-6 items-center">
            <div class="bg-red-500 text-[#040604] font-bold p-4 rounded-md shadow-md">
                <ul class="pl-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

<div class="container mt-24">
    <h1 class="text-4xl font-bold text-left mb-6 text-[#C4FFCE]">Follow your favorite cryptocurrencies.</h1>

    <div x-data="{ modalOpen: false }"
         @keydown.escape.window="modalOpen = false"
         class="relative z-50 w-auto h-auto">
        <button @click="modalOpen=true" class="flex-1 mt-4 bg-[#8DB295] mb-4 text-[#040604] rounded-lg px-4 py-2">✉ Buy currency...</button>
        <template x-teleport="body">
            <div x-show="modalOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
                <div x-show="modalOpen"
                     x-trap.inert.noscroll="modalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative w-full py-6 bg-[#040604] text-[#C4FFCE] border-2 border-[#C4FFCE] px-7 sm:max-w-lg sm:rounded-lg">
                    <div class="flex items-center justify-between pb-2">
                        <h3 class="text-lg font-semibold">Buy Currency</h3>
                        <button @click="modalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="relative w-auto">
                        <form action="{{ route('market.deposit') }}" method="POST" class="flex flex-col gap-2">
                            @csrf
                            <label for="currency">Buy currency</label>
                            <select name="currency" id="currencies" class="p-2 rounded-md bg-[#C4FFCE] text-[#040604] placeholder-[#040604]/70">
                                <option disabled selected>You musts have the same currency as the one in your wallet!</option>
                                <option>BTC</option>
                                <option>ETH</option>
                                <option>SOL</option>
                                <option>XRP</option>
                                <option>ADA</option>
                            </select>
                            <label for="amount">Amount in USD</label>
                            <input type="number" name="amount" class="p-2 rounded-md bg-[#C4FFCE] text-[#040604] placeholder-[#040604]/70" placeholder="Enter the amount in USD you wish to order">
                            <label for="wallet">Your prefered wallet</label>
                            <select name="wallet" id="selectPersonalWallet" class="bg-[#C4FFCE] text-[#040604] p-2 rounded-md">
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}">{{ $wallet->name }} -> {{ $wallet->type }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="p-2 rounded-md bg-[#C4FFCE] mt-2 text-[#040604] hover:border hover:bg-[#040604] hover:border-[#C4FFCE] hover:text-[#C4FFCE] duration-300 font-bold">Send Transfer</button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <div class="w-screen">
        <table class="w-[95dvw] border-collapse border border-[#040604] text-center rounded-lg overflow-hidden shadow-md">
            <thead class="bg-[#8DB295] text-[#040604]">
            <tr>
                <th class="border border-[#040604]/30 px-4 py-3">Symbol</th>
                <th class="border border-[#040604]/30 px-4 py-3">Open Price</th>
                <th class="border border-[#040604]/30 px-4 py-3">High</th>
                <th class="border border-[#040604]/30 px-4 py-3">Low</th>
                <th class="border border-[#040604]/30 px-4 py-3">Close Price</th>
                <th class="border border-[#040604]/30 px-4 py-3">Volume</th>
                <th class="border border-[#040604]/30 px-4 py-3">Graph</th>
            </tr>
            </thead>
            <tbody id="crypto-table-body" class="bg-[#040604]">
            </tbody>
        </table>
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

<script src="{{ asset('js/market.js') }}" defer></script>
</main>
</body>
</html>
