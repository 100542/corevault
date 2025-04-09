<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corevault</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="overflow-y-hidden overflow-x-hidden bg-[#040604] montserrat">
    @include('nav')

    <main>
        <section>
            <div class="flex flex-row w-screen h-[65dvh] justify-center items-center">
                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-[#C4FFCE] text-center text-8xl font-black">Crypto, Organized.</h1>
                    <h1 class="text-[#8FB996] text-5xl font-black text-center mt-4">Corevault</h1>
                    @if (Auth::check())
                        <a href={{ route('dashboard') }}><button type="submit" class="mt-8 border-2 border-[#C4FFCE] p-4 rounded-md shadow-md min-w-32 text-xl font-black text-[#C4FFCE] hover:text-black hover:bg-[#C4FFCE] hover:scale-105 duration-300">Go to dashboard</button></a>
                        @else
                    <a href={{ route('login') }}><button type="submit" class="mt-8 border-2 border-[#C4FFCE] p-4 rounded-md shadow-md min-w-32 text-xl font-black text-[#C4FFCE] hover:text-black hover:bg-[#C4FFCE] hover:scale-105 duration-300">Get Started</button></a>
                        @endif
                </div>
            </div>
            <div class="ml-20 3xl:ml-40 rotate-12 hover:rotate-[20deg] duration-1000 flex flex-col h-52 rounded-3xl shadow-md bg-[#8DB295] w-fit p-4 min-w-96 absolute top-[40%]">
                <div class="flex flex-row items-center gap-2">
                    <img src="/logoblack.svg" alt="Logo" class="w-6 h-6 ml-4"> <h2 class="font-black text-black text-3xl">Corevault</h2>
                </div>
                <h3 class="ml-4 font-black text-black text-xl text-black/80">Elite Pass</h3>
                <div class="flex flex-row justify-between">
                    <div>
                        <p class="ml-4 font-light text-black text-md">CV 1234 5678 91</p>
                        <p class="ml-4 font-light text-black text-md">1234</p>
                    </div>
                    <div class="w-10 mt-2 h-6 bg-black rounded-md">

                    </div>
                </div>
                <p class="ml-4 font-light text-black mt-2 text-md">Expiration date: <span class="font-black text-black/80">01/01/2030</span></p>
                <p class="ml-4 font-black text-black mt-2 text-xl">J.D Doe</p>
            </div>

            <div class="right-0 mr-20 3xl:mr-40 -rotate-12 hover:-rotate-[20deg] duration-1000 flex flex-col h-52 rounded-3xl shadow-md bg-[#8DB295] w-fit p-4 min-w-96 absolute top-[40%]">
                <h2 class="text-black font-black text-center text-2xl">Investing, Revolutionized.</h2>
                <div>
                    <img src="/monitor.svg" alt="Monitor" class="w-full h-32 mt-4">
                </div>
            </div>

            <div class="hidden lg:flex flex-row justify-center">
                <div class="rounded-tl-[50%] rounded-tr-[50%] rounded-bl-[50%] rounded-br-[50%] w-[2000px] h-[1000px] border-[30px] border-[#C4FFCE] shadow-[0px_0px_200px_50px_rgba(196,255,206.99)] flex flex-row justify-center items-center">
                    <div class="-mt-96 flex flex-row justify-center gap-4 w-[80%] items-end">
                        <div class="h-40 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-80 hover:h-80 duration-200 w-14 bg-[#8DB295]"></div>
                        <div class="h-60 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-72 hover:h-80 duration-200 w-14 bg-[#8DB295]"></div>
                        <div class="h-52 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-60 hover:h-80 duration-200 w-14 bg-[#8DB295]"></div>
                        <div class="h-72 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-52 hover:h-80 duration-200 w-14 bg-[#8DB295]"></div>
                        <div class="h-80 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-40 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-80 hover:h-80 duration-200 w-14 bg-[#8DB295]"></div>
                        <div class="h-60 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-72 hover:h-80 duration-200 w-14 bg-[#8DB295]"></div>
                        <div class="h-52 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                        <div class="h-60 hover:h-80 duration-200 w-14 bg-[#8DB295]"></div>
                        <div class="h-72 hover:h-80 duration-200 w-14 bg-[#7CD789]"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
