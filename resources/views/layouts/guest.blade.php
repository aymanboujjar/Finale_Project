<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Learnova</title>
        <link rel="icon" href={{ asset("storage/images/logo.png") }} type="image/x-icon">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen flex flex-col items-center justify-between">
<!-- Success Message -->
    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success fixed top-5 z-50 right-5 bg-green-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('success') }}
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="alert alert-danger fixed top-5 z-50 right-5 bg-red-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('error') }}
    </div>
    @endif

    <!-- Warning Message -->
    @if(session('warning'))
    <div class="alert alert-warning fixed top-5 z-50 right-5 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('warning') }}
    </div>
    @endif

  

    <!-- Your Navbar and other content here -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all flash messages
            const flashMessages = document.querySelectorAll('.alert');

            flashMessages.forEach(function (message) {
                // Make the message visible by removing classes after a delay
                setTimeout(() => {
                    message.classList.remove('opacity-0', 'translate-x-full');
                    message.classList.add('opacity-100', 'translate-x-0');
                }, 100); // Slight delay before showing the message

                // After 5 seconds, hide the message by adding opacity and translate classes
                setTimeout(() => {
                    message.classList.add('opacity-0', 'translate-x-full');
                    message.classList.remove('opacity-100', 'translate-x-0');
                }, 5000); // 5000 ms = 5 seconds
            });
        });
    </script>
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

        <div class="w-full max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg transform  mt-16 mb-8">
            <div class="mb-8 text-center">
                <a href="/" class="text-4xl font-bold text-blue-600">Learnova</a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <footer class="py-6 w-full text-center bg-white shadow-t-md mt-auto">
            <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
        </footer>

    </body>
</html>
