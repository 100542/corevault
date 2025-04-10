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
                <div class="relative w-full">
                    <input
                        id="pwInput"
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="p-3 pr-10 border w-full border-[#C4FFCE] rounded-md focus:outline-none focus:bg-[#C4FFCE] focus:text-[#040604] text-[#C4FFCE] bg-[#040604] duration-300"
                    />
                    <div class="absolute inset-y-0 right-3 flex items-center group">
                        <div class="w-5 h-5 flex items-center justify-center text-xs font-bold text-[#040604] bg-[#8DB295] rounded-full cursor-pointer">
                            i
                        </div>
                        <div class="absolute right-0 top-full -mt-28 w-64 p-2 text-sm text-[#040604] bg-[#8DB295] rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                            Password must be at least 8 characters,
                            include an uppercase letter,
                            and a special character.
                        </div>
                    </div>
                    <button onclick="TogglePassword()" class="absolute inset-y-0 right-10 flex items-center group">
                        <div class="w-5 h-5 flex items-center justify-center text-xs font-bold text-[#C4FFCE] rounded-full cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                    </button>
                </div>

                <div class="relative w-full">
                    <input
                        id="pwInput"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        required
                        class="p-3 border w-full border-[#C4FFCE] rounded-md focus:outline-none focus:bg-[#C4FFCE] focus:text-[#040604] text-[#C4FFCE] bg-[#040604] duration-300"
                    />
                    <button onclick="TogglePassword()" class="absolute inset-y-0 right-3 flex items-center group">
                        <div class="w-5 h-5 flex items-center justify-center text-xs font-bold text-[#C4FFCE] rounded-full cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                    </button>
                </div>


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

<script>
    function TogglePassword() {
        const pwInput = document.getElementById("pwInput");
        pwInput.type = pwInput.type === 'password' ? 'text' : 'password'
    }
</script>

</body>
</html>
