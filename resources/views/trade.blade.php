<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault - Register</title>
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

        <section class="flex max-h-[75dvh] flex-row justify-between">
            <div class="flex flex-col gap-6 mt-4 w-[30%] overflow-y-scroll">
                @foreach($users as $user)
                    <aside class="flex flex-col h-24">
                        <div class="bg-[#C4FFCE] flex flex-row justify-between p-6 rounded-xl hover:bg-[#8DB295] transition-all items-center text-center">
                            <h3 class="text-lg text-[#040604] font-semibold">{{ $user->username }}</h3>
                            <a
                                href="{{ route('trade.page', ['to' => $user->id]) }}"
                                class="text-2xl text-[#040604] font-black text-center"
                            >
                                +
                            </a>
                        </div>
                    </aside>
                @endforeach
            </div>

            <div class="w-[65%] rounded-lg min-h-full bg-[#C4FFCE]">
                <div id="comms" class="flex flex-col h-full justify-between p-4">
                    @if($recipient)
                        <div class="flex flex-col h-full overflow-y-auto space-y-4 pr-2 max-h-[60dvh]">
                            @foreach($messages as $msg)
                                <div class="flex {{ $msg->sender_id === $userName->id ? 'justify-end' : 'justify-start' }}">
                                    <div class="px-4 py-2 rounded-lg max-w-[60%]
                        {{ $msg->sender_id === $userName->id ? 'bg-[#8DB295] text-[#040604]' : 'bg-[#040604] text-[#C4FFCE]' }}">
                                        {{ $msg->body }}
                                        <div class="text-xs text-gray-600 mt-1 text-right">
                                            {{ $msg->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('trade.send') }}" method="POST" class="mt-4 flex gap-2">
                            @csrf
                            <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">
                            <input
                                type="text"
                                name="body"
                                class="flex-1 border border-gray-400 rounded-lg px-4 py-2"
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
</body>
</html>
