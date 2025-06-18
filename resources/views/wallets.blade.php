<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Wallets</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>

@include('nav')
<body class="text-white flex justify-center items-center min-h-screen">
<main class="w-full p-6">
    <div class="mb-10 shadow-lg rounded-lg mt-10">
        <h2 class="text-4xl text-[#C4FFCE] text-left mb-2 font-bold">Your Personal Wallet Dashboard.</h2>

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

        <h3 class="text-md text-gray-400 mb-4 text-left">Welcome, <span class="text-[#C4FFCE]">{{ $user->username }}</span></h3>
        <form action="{{ route('wallets.create') }}" method="POST" class="space-y-4  bg-[#8DB295] p-4 rounded-md shadow-md">
            @csrf
            <div>
                <label for="wallet-name" class="block text-[#040604] mb-1">Wallet Name</label>
                <input type="text" id="wallet-name" name="name"
                       class="w-full p-3 rounded-lg bg-[#040604] focus:ring-2 focus:ring-[#C4FFCE] focus:outline-none text-[#C4FFCE]"
                       placeholder="Enter wallet name" required>
                <select name="type" class="w-full p-3 rounded-lg bg-[#040604] focus:ring-2 focus:ring-[#C4FFCE] focus:outline-none text-[#C4FFCE] mt-4">
                    <option>BTC</option>
                    <option>ETH</option>
                    <option>SOL</option>
                    <option>XRP</option>
                    <option>ADA</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-[#C4FFCE] text-[#040604] font-semibold py-3 rounded-lg transition">
                Create Wallet
            </button>
        </form>
    </div>

    @if($wallets->isEmpty())
        <p class="text-[#C4FFCE] text-center">You don't have any wallets yet. Create one in the form.</p>
    @else
        <ul class="space-y-4 mb-6 grid grid-cols-5 gap-16 max-h-96 overflow-y-scroll">
            @foreach ($wallets as $wallet)
                <li class="bg-[#8DB295] min-w-fit p-4 flex flex-col gap-2 rounded-lg shadow-md">
                    <strong class="block text-[#040604] font-extrabold text-lg">{{ $wallet->name }}</strong>
                    <span class="text-[#040604] text-sm">Address:</span>
                    <code class="block text-gray-900">{{ $wallet->address }}</code>
                    <span class="text-[#040604] text-sm">Balance:</span>
                    <strong class="text-[#040604]">{{ number_format($wallet->pivot->balance, 6) }} {{ $wallet->type }}</strong>
                    <form action="{{ route('wallets.deposit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                        <input type="number" name="amount" class="p-2 text-sm rounded-lg text-[#C4FFCE] bg-[#040604]" placeholder="Amount in $...">
                        <button class="text-[#C4FFCE] bg-[#040604] p-2 text-sm rounded-lg">Deposit</button>
                    </form>
                    <form action="{{ route('wallets.withdraw') }}" method="POST">
                        @csrf
                        <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                        <input type="number" name="amount" class="p-2 text-sm rounded-lg text-[#C4FFCE] bg-[#040604]" placeholder="Amount in $...">
                        <button class="text-[#C4FFCE] bg-[#040604] p-2 text-sm rounded-lg">Withdraw</button>
                    </form>
                    <h1 class="text-[#040604] text-lg font-bold">Transaction Automatization</h1>
                    <form action="{{ route('wallets.withdraw') }}" method="POST" class="flex flex-col gap-2">
                        @csrf
                        <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                        <label for="low" name="low" class="text-[#040604]">Sell all currency when portfolio reaches:</label>
                        <input type="number" name="low" class="p-2 text-sm rounded-lg text-[#C4FFCE] bg-[#040604]" placeholder="Value in USD">
                        <button class="text-[#C4FFCE] bg-[#040604] p-2 text-sm rounded-lg">Automatize</button>
                    </form>
                    <form action="{{ route('wallets.withdraw') }}" method="POST" class="flex flex-col gap-2">
                        <label for="high" name="high" class="text-[#040604]">Buy certain amount when portfolio reaches:</label>
                        <input type="number" name="low" class="p-2 text-sm rounded-lg text-[#C4FFCE] bg-[#040604]" placeholder="Value in USD">
                        <input type="number" name="buyinamount" class="p-2 text-sm rounded-lg text-[#C4FFCE] bg-[#040604]" placeholder="Value in USD">
                        <button class="text-[#C4FFCE] bg-[#040604] p-2 text-sm rounded-lg">Automatize</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
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
</html>
