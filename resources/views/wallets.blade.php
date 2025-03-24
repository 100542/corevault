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

<body class="bg-gray-900 text-white flex justify-center items-center min-h-screen">
<main class="w-full max-w-3xl p-6">
    <div class="bg-gray-800 shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-center mb-6">Your Wallets</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($wallets->isEmpty())
            <p class="text-gray-400 text-center">You don't have any wallets yet. Create one below.</p>
        @else
            <ul class="space-y-4 mb-6">
                @foreach ($wallets as $wallet)
                    <li class="bg-gray-700 p-4 rounded-lg shadow-md">
                        <strong class="block text-lg">{{ $wallet->name }}</strong>
                        <span class="text-gray-400 text-sm">Address:</span>
                        <code class="block text-gray-300">{{ $wallet->address }}</code>
                        <span class="text-gray-400 text-sm">Balance:</span>
                        <strong class="text-white">{{ number_format($wallet->pivot->balance, 2) }}</strong>
                    </li>
                @endforeach
            </ul>
        @endif

        <h3 class="text-xl font-semibold mb-4 text-center">Create a New Wallet</h3>
        <form action="{{ route('wallets.create') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="wallet-name" class="block text-gray-300 mb-1">Wallet Name</label>
                <input type="text" id="wallet-name" name="name"
                       class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none text-white"
                       placeholder="Enter wallet name" required>
                <select class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:outline-none mt-4 text-white">
                    <option>BTC</option>
                    <option>ETH</option>
                    <option>SOL</option>
                    <option>XRP</option>
                    <option>ADA</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition">
                Create Wallet
            </button>
        </form>
    </div>
</main>
</body>
</html>
