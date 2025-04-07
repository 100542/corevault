<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Secure Your Crypto</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-[#040604] text-white">

<nav class="backdrop-blur-2xl absolute top-0 w-full h-20 shadow-md flex justify-between items-center px-8">
    <div class="flex flex-row gap-4">
        <img src="/logo.svg" alt="Logo" class="w-14 h-14 hover:rotate-[360deg] duration-300">
    </div>

    <div class="flex gap-16 tracking-wide text-lg">
        <a href="{{ route('dashboard') }}" class="hover:scale-105 border-2 border-[#C4FFCE] text-[#C4FFCE] p-3 font-black rounded-lg shadow-md transition {{ request()->routeIs('dashboard') ?
'text-yellow-300 border-yellow-300' : '' }}">Dashboard</a>
        <a href="{{ route('market.page') }}" class="hover:scale-105 border-2 border-[#C4FFCE] text-[#C4FFCE] p-3 font-black rounded-lg shadow-md transition {{ request()->routeIs('market.page') ?
'text-yellow-300 border-yellow-300' : '' }}">Markets</a>
        <a href="{{ route('dashboard') }} {{ request()->routeIs('dashboard') ?
'text-yellow-300 border-yellow-300' : '' }}" class="hover:scale-105 border-2 border-[#C4FFCE] text-[#C4FFCE] p-3 font-black rounded-lg shadow-md transition ">Trade</a>
        <a href="{{ route('wallets.page') }} {{ request()->routeIs('wallets.page') ?
'text-yellow-300 border-yellow-300' : '' }}" class="hover:scale-105 border-2 border-[#C4FFCE] text-[#C4FFCE] p-3 font-black rounded-lg shadow-md transition ">Wallets</a>
        <a href="{{ route('dashboard') }} {{ request()->routeIs('dashboard') ?
'text-yellow-300 border-yellow-300' : '' }}" class="hover:scale-105 border-2 border-[#C4FFCE] text-[#C4FFCE] p-3 font-black rounded-lg shadow-md transition ">History</a>
    </div>

    <div class="relative group">
        <button class="focus:outline-none flex items-center space-x-2">
            <span class="text-[#C4FFCE] text-4xl p-3 font-black rounded-lg shadow-md transition ">{{ Auth::user()->username }}</span>
            <svg class="w-5 h-5" fill="none" stroke="#C4FFCE" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div class="absolute right-0 rounded-md p-4 min-w-96 border-[#C4FFCE] border-2 shadow-lg hidden group-hover:flex flex-col ">
            <p class="text-2xl font-black text-[#C4FFCE]">Hello, <span class="text-2xl text-[#C4FFCE]">{{ Auth::user() ->username }}.</span></p>
            <a href="{{ route('dashboard') }}" class="mt-4 text-[#C4FFCE]">Manage profile</a>
            <a href="{{ route('logout') }}" class="text-[#C4FFCE]">Logout</a>
        </div>
    </div>
</nav>

</body>
</html>
