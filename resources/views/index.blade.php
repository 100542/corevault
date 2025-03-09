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
<div class="flex flex-col justify-center min-h-screen bg-gray-800 text-white">
    <div class="relative z-10 flex flex-col justify-center items-center space-y-8 text-center">

        <h1 class="text-9xl font-bold">Corevault</h1>
        <h2 class="text-3xl font-light tracking-widest text-white/90">
            Crypto. Organised. Simplified.
        </h2>

        <p class="text-lg max-w-2xl text-white/80">
            Securely store, manage, and trade your digital assets with ease.
            Join thousands of users protecting their crypto investments with Corevault.
        </p>
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-3 w-52 bg-[#C9C7BA] text-[#29292B] rounded-md text-lg font-semibold hover:bg-[#29292B] hover:text-[#C9C7BA] duration-300">
                Log In
            </a>
            <a href="{{ route('register.page') }}" class="px-6 w-52 py-3 border border-[#C9C7BA] text-[#C9C7BA] rounded-md text-lg font-semibold hover:bg-[#C9C7BA] hover:text-[#29292B] duration-300">
                Get Started
            </a>
        </div>
        <div class="mt-12 max-w-lg text-white/80 text-sm">
            <p>This is a fake application to practise the Laravel framework.</p>
            <p>Do not enter real information.</p>
        </div>
    </div>
</div>
</body>
</html>
