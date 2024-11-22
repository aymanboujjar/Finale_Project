<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">

<!-- Success Message -->
@if(session('success'))
<div class="alert alert-success fixed top-5 z-50 right-5 bg-green-600 text-white py-2 px-6 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
    {{ session('success') }}
</div>
@endif

<!-- Error Message -->
@if(session('error'))
<div class="alert alert-danger fixed top-5 z-50 right-5 bg-red-600 text-white py-2 px-6 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
    {{ session('error') }}
</div>
@endif

<!-- Warning Message -->
@if(session('warning'))
<div class="alert alert-warning fixed top-5 z-50 right-5 bg-yellow-500 text-white py-2 px-6 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
    {{ session('warning') }}
</div>
@endif

<!-- Navbar -->
@if (Route::has('login'))
<nav class="w-full py-4 px-8 flex justify-between items-center bg-white shadow-lg rounded-b-lg">
    <h1 class="text-3xl font-extrabold text-blue-600">Learnova</h1>
    <div class="relative inline-block text-left">
        <!-- Dropdown Button -->
        <button class="inline-flex items-center justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-700"
                onclick="toggleDropdown()" id="menu-button" aria-expanded="false" aria-haspopup="true">
            <span>{{ Auth::user()->name }}</span>
            <!-- Profile Image -->
            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="w-8 h-8 rounded-full ml-2">
        </button>

        <!-- Dropdown Menu -->
        <div id="dropdown-menu" class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-1">
                <!-- Profile Link -->
                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="{{ url('/calendar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Courses</a>

                @if (Auth::user() && Auth::user()->hasRole(['coach']))
                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Coaching</a>
                @endif

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
@endif

<div class="mt-6 container mx-auto px-4">
    <h3 class="text-3xl font-bold text-center text-blue-700 mb-8">This Class's Courses</h3>

    <!-- Bootstrap Carousel -->
    <div id="courseCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
        <div class="carousel-inner">
            @if (count($courses) > 1)
                <!-- Split the courses into groups of 4 -->
                @foreach(array_chunk($courses->toArray(), 4) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-start"> <!-- Changed from 'justify-content-center' to 'justify-content-start' -->
                            @foreach ($chunk as $course)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-500 ease-in-out transform mx-2" style="width: 22rem;">
                                    <img src="{{ asset('storage/' . $course['image']) }}" alt="{{ $course['name'] }}" class="w-full h-48 object-cover rounded-t-md">
                                    <div class="p-4">
                                        <h4 class="text-xl font-semibold text-blue-600">{{ $course['name'] }}</h4>
                                        <p class="mt-2 text-gray-600">{{ Str::limit($course['description'], 100) }}</p>
                                        <p class="mt-2 text-gray-600">Course Type: <span class="font-medium text-gray-800">{{ $course['type'] }}</span></p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <form action="">
                                                <button  type="submit" class="px-4 py-2 text-white font-medium rounded-lg bg-blue-600 hover:bg-blue-700 transition-all duration-300">
                                                    Enroll Now
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
            <h1 class="text-3xl text-gray-800 text-center">No Courses Available</h1>
            @endif
        </div>

        <!-- Carousel Controls -->
        {{-- <button class="carousel-control-prev" type="button" data-bs-target="#courseCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#courseCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button> --}}
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- JavaScript for flash messages -->
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

<!-- JavaScript for dropdown -->
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown-menu');
        dropdown.classList.toggle('hidden');
    }
</script>

</body>
</html>
