<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>React TypeScript in Laravel</title>
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
</head>
<body>
<div class="flex flex-col justify-center min-h-screen bg-gray-800">
                <div class="relative z-10 flex flex-col justify-center items-center space-y-4">
                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        class="flex flex-col gap-2 justify-center items-center space-y-4 border-2 border-white/30 backdrop-blur-md p-24 rounded-lg shadow-lg"
                    >
                        @csrf
                        <h1 class="text-9xl text-white font-bold text-center">Corevault</h1>
                        <h2 class="text-3xl text-white/90 font-light tracking-widest">Crypto. Organised. Simplified.</h2>

                        <input
                            type="text"
                            name="username"
                            placeholder="Username"
                            required
                            class="p-2 border w-full border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#C9C7BA] text-[#29292B]"
                        />
                        <input
                            type="password"
                            name="password"
                            placeholder="Password"
                            required
                            class="p-2 border w-full border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#c9c7ba] text-[#29292B]"
                        />
                        <button
                            type="submit"
                            class="px-4 w-full py-2 bg-[#C9C7BA] text-[#29292B] rounded-md hover:bg-[#29292B] hover:text-[#C9C7BA] hover:gradientborder duration-300"
                        >
                            Log In
                        </button>

                        @if ($errors->any())
                            <p class="text-red-500 text-sm">{{ $errors->first() }}</p>
                        @endif

                        <p class="text-lg hover:cursor-pointer underline underline-offset-8 font-light text-white/90 tracking-widest">
                            Not registered yet? <a href="{{ route('register') }}">Join now!</a>
                        </p>
                    </form>
                </div>
            </div>
</body>
</html>
