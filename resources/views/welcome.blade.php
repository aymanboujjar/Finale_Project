<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href={{ asset("storage/images/logo.png") }} type="image/x-icon">

</head>
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">

    <!-- Navbar -->
    @if (Route::has('login'))
    <nav class="w-full py-4 px-8 flex justify-between items-center bg-white shadow-md rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600">Learnova</h1>
        <div class="space-x-4">
           
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300">Join us for free</a>
                @endif
        </div>
    </nav>
    @endif

    <!-- Welcome Section -->
    <div class="text-center mt-20">
        <h2 class="text-5xl font-extrabold text-white">Welcome to Learnova</h2>
        <p class="mt-4 text-lg sm:text-xl text-gray-100 max-w-2xl mx-auto">Discover your potential with our interactive online courses and community support.</p>
        <div class="mt-6">
            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg shadow-md hover:bg-gray-200 transition duration-300 font-medium">Get Started</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mt-16 max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
            <h3 class="text-xl font-bold text-blue-600">Expert-Led Courses</h3>
            <p class="mt-2 text-gray-600">Learn from industry experts and advance your skills with ease.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
            <h3 class="text-xl font-bold text-blue-600">Flexible Learning</h3>
            <p class="mt-2 text-gray-600">Study at your own pace with our on-demand courses.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
            <h3 class="text-xl font-bold text-blue-600">Global Community</h3>
            <p class="mt-2 text-gray-600">Join a community of learners and grow together.</p>
        </div>
    </div>

    <!-- Courses Section with Pro Cards -->
    <div class="mt-10 text-center">
        <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-lg shadow-md hover:bg-gray-200 font-medium">Our Main Courses</a>
    </div>
    <div class="mt-16 max-w-6xl mx-auto flex flex-wrap justify-center gap-8 text-center">
        <!-- First Card -->
        <div class="bg-white p-6 rounded-lg shadow-xl transform hover:scale-105 hover:shadow-2xl transition duration-300 w-full md:w-1/2 lg:w-1/3">
            <img src="{{ asset('storage/images/1.png') }}" alt="Media and Marketing Courses" class="w-full h-48 object-cover rounded-lg shadow-lg mb-4">
            <h3 class="text-2xl font-semibold text-blue-600 mb-2">Media and Marketing Courses</h3>
            <p class="text-gray-600 mb-4">Master audiovisual production, from camera work to lighting and video editing. Learn podcasting and build engaging multimedia content for your marketing strategy.</p>
            <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300">Start Learning</a>
        </div>

        <!-- Second Card -->
        <div class="bg-white p-6 rounded-lg shadow-xl transform hover:scale-105 hover:shadow-2xl transition duration-300 w-full md:w-1/2 lg:w-1/3">
            <img src="{{ asset('storage/images/2.png') }}" alt="Coding Learning" class="w-full h-48 object-cover rounded-lg shadow-lg mb-4">
            <h3 class="text-2xl font-semibold text-blue-600 mb-2">Coding Learning</h3>
            <p class="text-gray-600 mb-4">Learn modern web development with Laravel, React, HTML, CSS, JavaScript, Tailwind CSS, and more. Build dynamic, responsive websites and applications.</p>
            <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300">Start Learning</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-20 py-6 w-full text-center bg-white shadow-t-md">
        <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
    </footer>
</body>
</html>
