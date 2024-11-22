<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Learnova</title>
        <link rel="icon" href={{ asset("storage/images/logo.png") }} type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">
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
        <div class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 text-gray-800  shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
