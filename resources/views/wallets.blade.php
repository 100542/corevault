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
            <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
                {{ session('success') }}
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
        <ul class="space-y-4 mb-6 grid grid-cols-5 gap-16 ">
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
                </li>
            @endforeach
        </ul>
    @endif
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
</body>
</html>
