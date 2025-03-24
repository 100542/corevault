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

<!--
Placeholder front-end (verbeterd)
-->
<body class="bg-gray-900 text-white flex flex-col justify-center items-center min-h-screen">
    <main>
        <div class="bg-gray-800 w-full p-16 flex flex-col gap-4 text-white">
            <h1 class="text-7xl font-semibold text-center">Welcome back, <span class="text-yellow-300">{{ $user->username }}</span>!</h1>
            <h2 class="text-3xl font-light text-center">What would you like to do today?</h2>
        </div>
        <div class="flex flex-row mt-16 justify-center gap-16 items-center">
            <div class="bg-gray-800 gap-6 text-white flex w-[27dvw] h-52 flex-col p-4 justify-center rounded-lg shadow-md">
                <h2 class="font-bold text-3xl text-center">Your Portfolio</h2>
                <div class="bg-gray-700 flex flex-col justify-center items-center p-4 rounded-lg shadow-md">
                    @foreach($wallets as $wallet)
                        <h2>{{ number_format($wallet->pivot->balance, 2) }}</h2>
                    @endforeach
                    <a href="{{ route('dashboard') }}" class="font-bold text-xl underline">View investments</a>
                </div>
            </div>
            <div class="bg-gray-800 text-white flex w-[27dvw] h-52 flex-col justify-center items-center rounded-lg shadow-md">
                <div class="bg-gray-800 gap-6 text-white flex w-[27dvw] h-52 flex-col p-4 justify-center rounded-lg shadow-md">
                    <h2 class="font-bold text-3xl text-center">Inbox</h2>
                    <div class="bg-gray-700 flex flex-col justify-center items-center p-4 rounded-lg shadow-md">
                        <h2 class="font-bold text-3xl">You are all up-to-date!</h2>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 text-white flex w-[27dvw] h-52 flex-col justify-center items-center rounded-lg shadow-md">
                <div class="bg-gray-800 gap-6 text-white flex w-[27dvw] h-52 flex-col p-4 justify-center rounded-lg shadow-md">
                    <h2 class="font-bold text-3xl text-center">Recent transactions</h2>
                    <div class="bg-gray-700 flex flex-col justify-center gap-4 items-center p-4 rounded-lg shadow-md overflow-y-scroll">
                        <h2 class="font-bold text-green-300 text-3xl">Received:<span class="text-white"> $567.00 from Test1</span></h2>
                        <h2 class="font-bold text-green-300 text-3xl">Received:<span class="text-white"> $567.00 from Test1</span></h2>
                        <h2 class="font-bold text-red-300 text-3xl">Sent:<span class="text-white"> $567.00 to Test1</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
