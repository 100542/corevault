<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Insights</title>
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
        <h1 class="text-4xl text-[#C4FFCE] font-bold">Insights & Analysis</h1>
        <p class="text-gray-400 mt-2">Welcome back, <span class="text-[#C4FFCE] font-semibold">{{ $user->username }}</span>!</p>
    </div>
    <div class="grid grid-cols-2 gap-8 mb-12">
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <p class="text-sm text-[#040604] mb-2">Your most enjoyed currency</p>
            <h2 class="text-[#040604] font-black text-lg">{{ strtoupper($peakBalanceType) }}</h2>
            <h2 class="text-[#040604] font-black text-lg">Holding: {{ number_format($peakBalance, 6) }}</h2>
        </div>
        <div class="bg-[#8DB295] p-6 rounded-2xl shadow-md">
            <h2 class="text-[#040604] font-black text-lg mb-2">Fact-Based Trading Advice</h2>
            <p class="text-sm text-[#040604]">Currencies to be holding:</p>
            <p class="text-sm text-[#040604]">Currencies to be selling:</p>
            <p class="text-sm text-[#040604]">Diversity advices:</p>
        </div>
    </div>

    <div class="absolute bottom-0 -z-10 opacity-10 overflow-x-hidden flex flex-row justify-center gap-4 max-w-[97dvw] items-end">
        @php
            $colors = ['#7CD789', '#8DB295'];
        @endphp

        @for ($i = 0; $i < 40; $i++)
            @php
                $height = rand(300, 600);
                $color = $colors[$i % 2];
            @endphp
            <div class="h-[{{ $height }}px] w-14" style="background-color: {{ $color }}"></div>
        @endfor
    </div>
</main>
</body>
<script src="/js/cryptoNewsApi.js"></script>
</html>
