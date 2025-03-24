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
<body class="bg-gray-900 text-white">

<nav class="sticky top-0 w-full h-20 bg-gray-800 shadow-md flex justify-between items-center px-8">
    <div class="flex flex-row gap-4">
        <h1 class="font-bold text-3xl">Corevault</h1>
    </div>

    <div class="flex gap-16 tracking-wide text-lg">
        <a href="{{ route('dashboard') }}" class="hover:text-gray-400 transition {{ request()->routeIs('dashboard') ?
'text-yellow-300' : '' }}">Dashboard</a>
        <a href="{{ route('market.page') }}" class="hover:text-gray-400 transition {{ request()->routeIs('market.page') ?
'text-yellow-300' : '' }}">Markets</a>
        <a href="{{ route('dashboard') }} {{ request()->routeIs('dashboard') ?
'text-yellow-300' : '' }}" class="hover:text-gray-400 transition">Trade</a>
        <a href="{{ route('wallets.page') }} {{ request()->routeIs('wallets.page') ?
'text-yellow-300' : '' }}" class="hover:text-gray-400 transition">Wallets</a>
        <a href="{{ route('dashboard') }} {{ request()->routeIs('dashboard') ?
'text-yellow-300' : '' }}" class="hover:text-gray-400 transition">History</a>
    </div>

    <div class="relative group">
        <button class="focus:outline-none flex items-center space-x-2">
            <span class="text-2xl">{{ Auth::user()->username }}</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div class="absolute right-0 mt-2 w-40 bg-gray-700 rounded-md shadow-lg hidden group-hover:block">
            <a href="{{ route('dashboard') }}" class="text-3xl px-4 py-2 hover:bg-gray-600">Profile</a>
            <a href="{{ route('logout') }}" class="text-3xl px-4 py-2 hover:bg-gray-600">Logout</a>
        </div>
    </div>
</nav>

</body>
</html>
