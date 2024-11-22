<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova - Class View</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
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

    <!-- Navbar -->
    @if (Route::has('login'))
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-extrabold text-indigo-600">Learnova</h1>
                </div>
                <div class="flex items-center">
                    <div class="relative inline-block text-left">
                        <button class="inline-flex items-center justify-center rounded-full px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500" onclick="toggleDropdown()" id="menu-button" aria-expanded="false" aria-haspopup="true">
                            <span>{{ Auth::user()->name }}</span>
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="w-8 h-8 rounded-full ml-2 border-2 border-indigo-200">
                        </button>
                        <div id="dropdown-menu" class="hidden absolute right-0 z-10 mt-2 w-48 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Profile</a>
                                <a href="{{ url('/calendar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Courses</a>
                                @if (Auth::user() && Auth::user()->hasRole(['coach']))
                                <a href="{{ url('/coaching') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Coaching</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endif

    <!-- Class Courses Section -->
    <section class="pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Class Courses</h1>
                <p class="text-xl text-gray-600">Explore and manage your class's available courses</p>
            </div>

            @if (count($courses) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses as $course)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                    <img src="{{ asset('storage/' . $course['image']) }}" alt="{{ $course['name'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-indigo-600">{{ $course['name'] }}</h4>
                        <p class="mt-2 text-gray-600">{{ Str::limit($course['description'], 100) }}</p>
                        <p class="mt-2 text-gray-600">Course type: {{ $course['type'] }}</p>
                        <div class="mt-6 flex justify-center">
                            <form action="/calendar/update/{{ $course->id }}" method="POST">
                                @method("PUT")
                                @csrf
                            
                                <input class="hidden" type="datetime-local" id="start_{{ $course['id'] }}" name="start" min="{{ date('Y-m-d\TH:i') }}" required>
                            
                                <input class="hidden" type="datetime-local" id="end_{{ $course['id'] }}" name="end" min="{{ date('Y-m-d\TH:i') }}" required>
                            
                                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                    Enroll Now
                                </button>
                            </form>

                            <!-- JavaScript to set start and end times dynamically -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    // Get current date and time
                                    const now = new Date();

                                    // Get the course-specific start and end inputs
                                    const startInput = document.getElementById('start_{{ $course["id"] }}');
                                    const endInput = document.getElementById('end_{{ $course["id"] }}');

                                    // Format current time in YYYY-MM-DDTHH:MM format
                                    const formattedNow = now.toISOString().slice(0, 16); // Get the first 16 characters (YYYY-MM-DDTHH:MM)

                                    // Set the 'start' input value to 1 hour from now
                                    now.setHours(now.getHours() + 1);
                                    const formattedStart = now.toISOString().slice(0, 16);
                                    startInput.value = formattedStart;

                                    // Calculate 2 hours later for the 'end' input
                                    now.setHours(now.getHours() + 1);
                                    const formattedEnd = now.toISOString().slice(0, 16);

                                    // Set the 'end' input value to 2 hours from the start time
                                    endInput.value = formattedEnd;
                                });
                            </script>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold text-gray-700">No Courses Available</h2>
                <p class="mt-2 text-gray-600">Check back later for new courses</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-indigo-600 mb-4">Learnova</h1>
                <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Flash Messages
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.alert');
            flashMessages.forEach(function(message) {
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

        // Dropdown Toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>
</html>
