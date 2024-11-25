<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Learnova') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 via-white to-blue-50 min-h-screen font-sans">
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success fixed top-5 z-[1111111111] right-5 bg-green-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger fixed top-5 z-50 right-5 bg-red-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('error') }}
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning fixed top-5 z-50 right-5 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('warning') }}
    </div>
    @endif

    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="fixed top-4 right-4 z-50 lg:hidden bg-white p-2 rounded-lg shadow-md">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-16 6h16"></path>
        </svg>
    </button>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-40 bg-white transform translate-x-full transition-transform duration-300 lg:hidden">
        <div class="flex flex-col h-full">
            <div class="p-4 border-b">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-extrabold text-indigo-600">Learnova</h1>
                    <button id="close-menu" class="p-2">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex flex-col p-4 space-y-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/profile') }}" class="text-gray-600 hover:text-indigo-600 text-lg">Profile</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 text-lg">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors text-center text-lg">Join us for free</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-30 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-extrabold text-indigo-600">Learnova</h1>
                </div>
                <div class="hidden lg:flex items-center space-x-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/profile') }}" class="text-gray-600 hover:text-indigo-600">Profile</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">Join us for free</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen pt-20 lg:pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Side - Animation -->
            <div class="flex flex-col items-center justify-center order-2 lg:order-1">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6 text-center">Welcome to Learnova</h2>
                <p class="text-base lg:text-lg text-gray-600 mb-8 text-center max-w-md">Your journey to knowledge and growth starts here. Join our community of learners today.</p>
                <div class="relative w-full max-w-lg">
                    <div class="absolute top-0 -left-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                    <lottie-player
                        src="https://lottie.host/c9b8e94c-6bf1-4f48-b7d3-b3a0d1e87d5b/Aq5Qc0Jm0B.json"
                        background="transparent"
                        speed="1"
                        style="width: 100%; height: 300px;"
                        loop
                        autoplay>
                    </lottie-player>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden p-4 lg:p-8 order-1 lg:order-2">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-extrabold text-indigo-600">Welcome Back</h1>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-green-600">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                        <input 
                            id="email" 
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username" />
                        @error('email')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                        <input 
                            id="password" 
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password" />
                        @error('password')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div>
                        <label for="remember_me" class="inline-flex items-center">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                name="remember" />
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Forgot Password and Login Button -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="text-center">
                <h1 class="text-xl lg:text-2xl font-bold text-indigo-600 mb-4">Learnova</h1>
                <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Flash Messages
            const flashMessages = document.querySelectorAll('.alert');
            flashMessages.forEach(function (message) {
                setTimeout(() => {
                    message.classList.remove('opacity-0', 'translate-x-full');
                    message.classList.add('opacity-100', 'translate-x-0');
                }, 100);

                setTimeout(() => {
                    message.classList.add('opacity-0', 'translate-x-full');
                    message.classList.remove('opacity-100', 'translate-x-0');
                }, 5000);
            });

            // Mobile Menu
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const closeMenuButton = document.getElementById('close-menu');
            const mobileMenu = document.getElementById('mobile-menu');

            function toggleMenu() {
                const isOpen = mobileMenu.classList.contains('translate-x-0');
                mobileMenu.classList.toggle('translate-x-full', isOpen);
                mobileMenu.classList.toggle('translate-x-0', !isOpen);
            }

            mobileMenuButton.addEventListener('click', toggleMenu);
            closeMenuButton.addEventListener('click', toggleMenu);
        });
    </script>
