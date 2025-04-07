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
<body>
    @include('nav')

    <main>
        <section>
            <div class="flex flex-row w-screen h-[100dvh] justify-center items-center">
                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-[#C4FFCE] text-center text-8xl font-black">Crypto, Simplified</h1>
                    <h1 class="text-[#8FB996] text-5xl font-black text-center mt-4">Corevault</h1>
                    <a href={{ route('login') }}><button type="submit" class="mt-8 border-2 border-[#C4FFCE] p-4 rounded-md shadow-md min-w-32 text-xl font-black text-[#C4FFCE]">Get Started</button></a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
