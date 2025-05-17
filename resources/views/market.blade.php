<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Market</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <h1 class="text-4xl text-[#C4FFCE] font-bold">Dashboard Overview</h1>
    <p class="text-gray-400 mt-2">Welcome back, <span class="text-[#C4FFCE] font-semibold">{{ $user->username }}</span>!</p>
</div>

<div class="container mt-24">
    <h1 class="text-4xl font-bold text-left mb-6 text-[#C4FFCE]">Follow your favorite cryptocurrencies.</h1>

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
