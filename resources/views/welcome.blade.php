<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
    <style>
        /* Custom styles */
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #1E3A8A;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem;
        }

        .cta-button {
            background-color: #1E3A8A;
            color: white;
            padding: 12px 36px;
            font-weight: 600;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .cta-button:hover {
            background-color: #2563EB;
            transform: translateY(-4px);
        }

        .feature-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px);
        }

        .course-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .course-card img {
            object-fit: cover;
            height: 200px;
            width: 100%;
        }

        .course-card-content {
            padding: 20px;
        }

        .testimonials-card {
            background: #f9f9f9;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .testimonials-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.5rem;
            }
            .cta-button {
                padding: 10px 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 font-sans">

    <!-- Success, Error, and Warning Messages -->
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
    <nav class="w-full py-6 px-8 flex justify-between items-center bg-white shadow-lg fixed top-0 left-0 right-0 z-10">
        <div class="text-3xl font-extrabold text-blue-600">
            <a href="{{ url('/') }}">Learnova</a>
        </div>
        <div class="space-x-6">
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Log In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-800 transition duration-300">Join Now</a>
            @endif
        </div>
    </nav>
    @endif

    <!-- Hero Section -->
    <section class="text-center mt-32 px-4 sm:px-0">
        <h2 class="text-5xl font-extrabold text-white section-title">Unlock Your Potential with Learnova</h2>
        <p class="mt-6 text-lg sm:text-xl text-gray-100 max-w-3xl mx-auto">Transform your life with high-quality online courses and expert-led training. Learn at your own pace, anytime, anywhere.</p>
        <div class="mt-8">
            <a href="/home" class="cta-button">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="mt-32 max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-center px-4">
        <div class="feature-card">
            <h3 class="text-xl font-semibold text-blue-600">Expert-Led Courses</h3>
            <p class="mt-4 text-gray-600">Learn from industry professionals with years of experience in their field.</p>
        </div>
        <div class="feature-card">
            <h3 class="text-xl font-semibold text-blue-600">Flexible Learning</h3>
            <p class="mt-4 text-gray-600">Take courses at your own pace, anytime, anywhere, on any device.</p>
        </div>
        <div class="feature-card">
            <h3 class="text-xl font-semibold text-blue-600">Global Community</h3>
            <p class="mt-4 text-gray-600">Connect with learners from all around the world and grow together.</p>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="mt-32 text-center px-4">
        <h2 class="text-3xl font-extrabold text-blue-600 section-title">Popular Courses</h2>
        <div class="mt-8 max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course 1 -->
            <div class="course-card">
                <img src="{{ asset('storage/images/1.png') }}" alt="Media and Marketing Courses">
                <div class="course-card-content">
                    <h3 class="text-2xl font-semibold text-blue-600 mb-2">Media and Marketing</h3>
                    <p class="text-gray-600 mb-4">Master the art of media production, video editing, and content marketing to boost your brand.</p>
                    <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300">Start Learning</a>
                </div>
            </div>
            <!-- Course 2 -->
            <div class="course-card">
                <img src="{{ asset('storage/images/2.png') }}" alt="Web Development Courses">
                <div class="course-card-content">
                    <h3 class="text-2xl font-semibold text-blue-600 mb-2">Web Development</h3>
                    <p class="text-gray-600 mb-4">Learn to build responsive, dynamic websites with the latest web technologies including HTML, CSS, JavaScript, and more.</p>
                    <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300">Start Learning</a>
                </div>
            </div>
            <!-- Course 3 -->
            <div class="course-card">
                <img src="{{ asset('storage/images/1.webp') }}" alt="UX/UI Design Courses">
                <div class="course-card-content">
                    <h3 class="text-2xl font-semibold text-blue-600 mb-2">UX/UI Design</h3>
                    <p class="text-gray-600 mb-4">Learn how to create user-friendly designs for websites and mobile apps, focusing on usability and user experience.</p>
                    <a href="#" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-300">Start Learning</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="mt-32 text-center px-4">
        <h2 class="text-3xl font-extrabold text-blue-600 section-title">What Our Students Say</h2>
        <div class="mt-8 max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="testimonials-card">
                <p class="text-gray-600">"Learnova helped me land my dream job in marketing! The courses are so informative and easy to follow. I love how flexible the platform is." – Sarah T.</p>
            </div>
            <!-- Testimonial 2 -->
            <div class="testimonials-card">
                <p class="text-gray-600">"As a beginner in web development, Learnova's courses made it so easy to understand complex concepts. Highly recommend it!" – John D.</p>
            </div>
            <!-- Testimonial 3 -->
            <div class="testimonials-card">
                <p class="text-gray-600">"The UX/UI Design course was a game changer. I've applied everything I learned to improve my freelance projects!" – Emma R.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 w-full bg-white text-center shadow-t-md mt-20">
        <p class="text-gray-600">© 2024 Learnova. All rights reserved. | 
            <a href="#" class="mx-2 text-blue-600 hover:text-blue-800">Privacy Policy</a> | 
            <a href="#" class="mx-2 text-blue-600 hover:text-blue-800">Terms of Service</a>
        </p>
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
