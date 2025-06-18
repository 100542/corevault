<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Trade</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-[#040604] overflow-y-hidden overflow-x-hidden">

@include("nav");

<main class="p-10">
    <div class="mb-12">
        <h1 class="text-4xl text-[#C4FFCE] font-bold">Trading Dashboard</h1>
        <p class="text-gray-400 mt-2">Welcome to trading, <span class="text-[#C4FFCE] font-semibold">{{ $userName->username }}</span>!</p>

        <section class="flex min-h-[75dvh] flex-row justify-between">
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

            <div class="flex flex-col gap-6 mt-4 w-[30%] overflow-y-scroll">
                <aside class="flex flex-col gap-4 h-24">
                    <form method="GET" action="{{ route('trade.page') }}">
                        <input
                            type="text"
                            name="search"
                            class="bg-[#C4FFCE] min-w-full p-6 rounded-xl text-[#040604] placeholder-[#040604]/40 font-bold"
                            placeholder="Search for users..."
                            value="{{ request('search') }}"
                        >
                    </form>

                    @foreach($users as $user)
                        <div class="bg-[#8DB295] flex flex-row justify-between p-6 rounded-xl hover:bg-[#8DB295] transition-all items-center text-center">
                            <h3 class="text-lg text-[#040604] font-semibold">{{ $user->username }}</h3>
                            <a
                                href="{{ route('trade.page', ['to' => $user->id]) }}"
                                class="text-2xl text-[#040604] font-black text-center"
                            >
                                +
                            </a>
                        </div>
                    @endforeach
                </aside>

            </div>

            <div class="w-[65%] rounded-lg min-h-full bg-[#8DB295]">
                <div id="comms" class="flex flex-col h-full justify-between p-4">
                    @if($recipient)
                        <div class="flex flex-col h-full overflow-y-auto space-y-4 pr-2 max-h-[60dvh]">
                                <h2 class="font-bold">You are talking with {{ ucfirst($recipient->username) }}</h2>
                            @foreach($messages as $msg)
                                <div class="flex {{ $msg->sender_id === $userName->id ? 'justify-end' : 'justify-start' }}">
                                    <div class="px-4 py-2 rounded-lg max-w-[60%]
                        {{ $msg->sender_id === $userName->id ? 'bg-[#C4FFCE] min-w-24 text-[#040604] text-right' : 'bg-[#040604] min-w-24 text-[#C4FFCE] text-left' }}">
                                        {{ $msg->body }}
                                        <div class="text-xs text-gray-600 mt-1 text-right">
                                            {{ $msg->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div x-data="{ modalOpen: false }"
                             @keydown.escape.window="modalOpen = false"
                             class="relative z-50 w-auto h-auto">
                            <button @click="modalOpen=true" class="flex-1 mt-6 bg-[#040604] text-[#C4FFCE] rounded-lg px-4 py-2">✉ Transfer From Wallet...</button>
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
                                            <h3 class="text-lg font-semibold">Transfer Money</h3>
                                            <button @click="modalOpen=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                        <div class="relative w-auto">
                                            <form action="{{ route('trade.wiretransfer') }}" method="POST" class="flex flex-col gap-2">
                                                @csrf
                                                <label for="targetname">Trade To</label>
                                                <input type="text" name="targetname" class="p-2 rounded-md bg-[#C4FFCE] text-[#040604] placeholder-[#040604]/70" placeholder="Enter the name of the user you wish to transfer money to...">
                                                <label for="waddress">Wallet Adress</label>
                                                <input type="text" name="waddress" class="p-2 rounded-md bg-[#C4FFCE] text-[#040604] placeholder-[#040604]/70" placeholder="Enter the wallet adress of the other user... (Starts with 0x)">
                                                <label for="mywallet">Wallet You Wish To Trade From</label>
                                                <select name="mywallet" id="selectPersonalWallet" class="bg-[#C4FFCE] text-[#040604] p-2 rounded-md">
                                                    @foreach($wallets as $wallet)
                                                        <option value="{{ $wallet->id }}">{{ $wallet->name }} -> {{ $wallet->type }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="amount">Amount ($)</label>
                                                <input type="text" name="amount" class="p-2 rounded-md bg-[#C4FFCE] text-[#040604] placeholder-[#040604]/70" placeholder="Enter the amount in USD you wish to transfer...">
                                                <button type="submit" class="p-2 rounded-md bg-[#C4FFCE] mt-2 text-[#040604] hover:border hover:bg-[#040604] hover:border-[#C4FFCE] hover:text-[#C4FFCE] duration-300 font-bold">Send Transfer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <form action="{{ route('trade.send') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">
                            <input
                                type="text"
                                name="body"
                                class="flex-1 bg-[#C4FFCE] border border-[#040604]/60 text-[#040604] placeholder-[#040604]/50 rounded-lg px-4 py-2"
                                placeholder="Type your message..."
                                required
                            >
                            <button class="bg-[#040604] text-[#C4FFCE] font-bold px-4 py-2 rounded-lg hover:bg-[#1b1f1b] transition-all">
                                Send
                            </button>
                        </form>
                    @else
                        <p class="text-gray-600">Select a person to message/trade.</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
</main>
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
</body>
<script src="/js/searchSmoothening.js"></script>
</html>
