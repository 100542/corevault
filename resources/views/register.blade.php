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
<body class="bg-[#040604]">
<div class="flex min-h-screen flex-row-reverse">

    <div class="w-1/2 h-screen bg-cover bg-center">
        <img src="/formbg.svg" alt="Background image" class="h-full w-full object-cover">
    </div>

    <div class="w-1/2 h-screen flex justify-center items-center bg-[#040604]">
        <div class="w-full max-w-3xl">
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4 p-6 backdrop-blur-md rounded-lg shadow-lg h-full justify-center">
                @csrf
                <h1 class="text-4xl text-[#C4FFCE] font-bold text-center">Corevault</h1>
                <h2 class="text-2xl text-[#C4FFCE] font-light text-center mb-6">Crypto. Organized. Simplified.</h2>

                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    required
                    class="p-3 border w-full border-[#C4FFCE] rounded-md focus:outline-none focus:bg-[#C4FFCE] focus:text-[#040604] text-[#C4FFCE] bg-[#040604] duration-300"
                />
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    class="p-3 border w-full border-[#C4FFCE] rounded-md focus:outline-none focus:bg-[#C4FFCE] focus:text-[#040604] text-[#C4FFCE] bg-[#040604] duration-300"
                />
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required
                    class="p-3 border w-full border-[#C4FFCE] rounded-md focus:outline-none focus:bg-[#C4FFCE] focus:text-[#040604] text-[#C4FFCE] bg-[#040604] duration-300"
                />

                <button
                    type="submit"
                    class="px-6 py-3 bg-[#C4FFCE] text-[#040604] hover:scale-105 rounded-md duration-300"
                >
                    Register
                </button>

                @if ($errors->any())
                    <p class="text-red-500 font-semibold text-lg text-center mt-2">{{ $errors->first() }}</p>
                @endif

                <p class="text-lg text-center hover:cursor-pointer underline underline-offset-8 font-light text-white/90 tracking-widest mt-4">
                    <a href="{{ route('login.page') }}">Already have an account? Log in here!</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
