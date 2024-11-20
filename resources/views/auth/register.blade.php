<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Learnova') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen flex flex-col items-center justify-between">

    <nav class="w-full py-6 px-8 flex justify-between items-center bg-white shadow-lg rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600">Learnova</h1>
        <div class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/profile') }}" class="text-blue-600 hover:text-blue-800 font-medium">Profile</a>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300">Join us for free</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <div class="w-full max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg  mt-16 mb-8">
        <div class="text-center mb-8">
            <a href="/" class="text-4xl font-bold text-blue-600">Learnova</a>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input 
                    id="name" 
                    class="block mt-1 w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    autocomplete="name" />
                @error('name')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
         

            <!-- Email Address -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input 
                    id="email" 
                    class="block mt-1 w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="username" />
                @error('email')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700">{{ __('profile image') }}</label>
                <input 
                    id="image" 
                    class="block mt-1 w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    type="file" 
                    name="image" 
                    value="{{ old('image') }}" 
                    required 
                    />
         
            </div>
            <!-- Register Button -->
            <div class="mt-4 flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition duration-300">
                    {{ __('Register') }}
                </button>
            </div>

            <!-- Already registered link -->
            <div class="mt-4 text-center">
                <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="py-6 w-full text-center bg-white shadow-t-md mt-auto">
        <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
    </footer>

</body>
</html>
