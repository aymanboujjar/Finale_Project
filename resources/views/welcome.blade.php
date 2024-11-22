<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova - Transform Your Future</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
</head>
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans antialiased">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success fixed top-5 right-5 z-50 bg-green-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 transform translate-x-full transition-all duration-500">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger fixed top-5 right-5 z-50 bg-red-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 transform translate-x-full transition-all duration-500">
            {{ session('error') }}
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning fixed top-5 right-5 z-50 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-lg opacity-0 transform translate-x-full transition-all duration-500">
            {{ session('warning') }}
        </div>
    @endif

    <!-- Navbar -->
    @if (Route::has('login'))
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-3xl font-extrabold text-blue-600 tracking-tight">Learnova</h1>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transform hover:-translate-y-1 transition-all duration-200">Join Now</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    @endif

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold text-gray-900 leading-tight mb-6">
                        Best online platform for
                        <span class="bg-indigo-600 text-white px-4 py-1 rounded-lg inline-block mt-2">learning</span>
                    </h1>
                    <p class="text-gray-600 text-lg mb-8">
                        Enhance your skills with our expert-led courses. Join our community of learners and achieve your goals with personalized learning paths.
                    </p>
                    <div class="flex gap-4">
                        <button class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            Join for free
                        </button>
                        <button class="text-indigo-600 px-8 py-3 rounded-lg font-medium hover:bg-indigo-50 transition-colors flex items-center">
                            Learn how
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-200 to-blue-200 rounded-3xl transform rotate-6"></div>
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<dotlottie-player src="https://lottie.host/95bddfca-2c64-4a61-8fe0-b8922fa0fe00/X699MnNCIJ.lottie" background="transparent" speed="1" style="width: 600px; height: 300px" loop autoplay></dotlottie-player>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-white text-center mb-12 uppercase tracking-wide">Why Choose Learnova</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Expert-Led Courses</h3>
                    <p class="text-gray-600">Learn from industry professionals with years of experience in their field.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Flexible Learning</h3>
                    <p class="text-gray-600">Study at your own pace with 24/7 access to course materials and expert support.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Global Community</h3>
                    <p class="text-gray-600">Connect with learners from all around the world and grow together.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Courses Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12 uppercase tracking-wide">Popular Courses</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <img src="{{ asset('storage/images/1.png') }}" alt="Media and Marketing" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">Media and Marketing</h3>
                        <p class="text-gray-600 mb-4">Master the art of media production and content marketing to boost your brand.</p>
                        <a href="#" class="inline-block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-full hover:bg-blue-700 transform hover:-translate-y-1 transition-all duration-200">
                            Start Learning
                        </a>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <img src="{{ asset('storage/images/2.png') }}" alt="Web Development" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">Web Development</h3>
                        <p class="text-gray-600 mb-4">Learn to build responsive, dynamic websites with modern web technologies.</p>
                        <a href="#" class="inline-block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-full hover:bg-blue-700 transform hover:-translate-y-1 transition-all duration-200">
                            Start Learning
                        </a>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <img src="{{ asset('storage/images/1.webp') }}" alt="UX/UI Design" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">UX/UI Design</h3>
                        <p class="text-gray-600 mb-4">Create user-friendly designs for websites and mobile applications.</p>
                        <a href="#" class="inline-block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-full hover:bg-blue-700 transform hover:-translate-y-1 transition-all duration-200">
                            Start Learning
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-white mb-12 uppercase tracking-wide">What Our Students Say</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <p class="text-gray-600 mb-6">"Learnova helped me land my dream job in marketing! The courses are so informative and easy to follow."</p>
                    <p class="font-semibold text-blue-600">– Sarah T.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <p class="text-gray-600 mb-6">"As a beginner in web development, Learnova's courses made it so easy to understand complex concepts."</p>
                    <p class="font-semibold text-blue-600">– John D.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-2">
                    <p class="text-gray-600 mb-6">"The UX/UI Design course was a game changer. I've applied everything I learned to my projects!"</p>
                    <p class="font-semibold text-blue-600">– Emma R.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold text-blue-600 mb-4">Learnova</h2>
            <p class="text-gray-600 mb-6">© 2024 Learnova. All rights reserved.</p>
            <div class="flex justify-center space-x-6">
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-200">Privacy Policy</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-200">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Flash Message Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
        });
    </script>
</body>
</html>