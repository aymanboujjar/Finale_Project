<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova - Online Learning Platform</title>
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
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Home</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">About Us</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Courses</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Blog</a>
                </div>
                <div class="flex items-center">
                    <div class="relative inline-block text-left">
                        <button 
                            class="inline-flex items-center justify-center rounded-full px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            onclick="toggleDropdown()"
                            id="menu-button"
                            aria-expanded="false"
                            aria-haspopup="true">
                            <span>{{ Auth::user()->name }}</span>
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="w-8 h-8 rounded-full ml-2 border-2 border-indigo-200">
                        </button>
                        <div 
                            id="dropdown-menu" 
                            class="hidden absolute right-0 z-10 mt-2 w-48 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ url('/profile_show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Profile</a>
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

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold text-gray-900 leading-tight mb-6">
                        Welcome to the Best online platform for
                        <span class="bg-indigo-600 text-white px-4 py-1 rounded-lg inline-block mt-2">learning</span>
                    </h1>
                    <p class="text-gray-600 text-lg mb-8">
                        Enhance your skills with our expert-led courses. Join our community of learners and achieve your goals with personalized learning paths.
                    </p>
                    {{-- <div class="flex gap-4">
                        <button class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            Join for free
                        </button>
                        <button class="text-indigo-600 px-8 py-3 rounded-lg font-medium hover:bg-indigo-50 transition-colors flex items-center">
                            Learn how
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div> --}}
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-200 to-blue-200 rounded-3xl transform rotate-6"></div>
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<dotlottie-player src="https://lottie.host/95bddfca-2c64-4a61-8fe0-b8922fa0fe00/X699MnNCIJ.lottie" background="transparent" speed="1" style="width: 600px; height: 300px" loop autoplay></dotlottie-player>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Featured Courses</h2>
                <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                    View all
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses as $course)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-900">{{ $course->name }}</h4>
                        <p class="mt-2 text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                        <p class="mt-2 text-gray-600">Course type: {{ ($course->type) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-500">Available Places: {{ $course->places }}</span>
                            <form action="{{ route('course_user.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="calendar_id" value={{ $course->id }}>
                                <button 
                                    id="take-now-{{ $course->id }}" 
                                    class="px-6 py-2 text-white font-medium rounded-lg bg-indigo-600 hover:bg-indigo-700 transition-colors">
                                    Take it now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Calendar Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h3 class="text-3xl font-bold text-gray-900">Your Learning Schedule</h3>
                <p class="mt-4 text-gray-600">Stay organized with your personalized course calendar</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6" id="calendar"></div>
        </div>
    </section>

    <!-- Modal -->
    <div id="showcourse" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-20 mx-auto shadow-xl rounded-xl bg-white max-w-lg">
            <div class="flex justify-end p-2">
                <button onclick="closeModal('showcourse')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <h1 id="name" class="text-2xl font-bold text-gray-900 mb-4"></h1>
                <p id="description" class="text-gray-600 mb-4"></p>
                <p id="place" class="text-lg text-gray-700 mb-2"></p>
                <p id="time" class="text-indigo-600 mb-1"></p>
                <p id="time2" class="text-indigo-600 mb-6"></p>
                <form action="{{ route('course_user.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="calendar_id" name="calendar_id">
                    <button id="tranzabadan" class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                        Take it now
                    </button>
                </form>
            </div>
        </div>
    </div>

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
        // Your existing JavaScript code remains the same
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }

        window.openModal = function(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-y-hidden');
        };

        window.closeModal = function(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-y-hidden');
        };

        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.key === 'Escape') {
                document.body.classList.remove('overflow-y-hidden');
                let modals = document.querySelectorAll('.fixed');
                modals.forEach(modal => {
                    modal.classList.add('hidden');
                });
            }
        };

        document.addEventListener('DOMContentLoaded', async function() {
            let response = await axios.get("/calendar/create");
            let events = response.data.events;

            var myCalendar = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(myCalendar, {
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: ''
                },
                initialView: "timeGridWeek",
                slotMinTime: "04:00:00",
                slotMaxTime: "23:00:00",
                nowIndicator: true,
                selectable: true,
                events: events,
                eventClick: (info) => {
                    const a = info.event.extendedProps;
                    const eventStartTime = new Date(a.start_time);
                    const eventEndTime = new Date(a.end_time);
                    const nowDate = new Date();
                    const tranzabadan = document.getElementById('tranzabadan');

                    document.getElementById('name').textContent = "Course Name: " + a.name;
                    document.getElementById('description').textContent = "About the course: " + a.description;
                    document.getElementById('place').textContent = "Places left: " + a.places;
                    document.getElementById('time').textContent = "Start At: " + a.start_time;
                    document.getElementById('time2').textContent = "End At: " + a.end_time;
                    document.getElementById('calendar_id').value = info.event.id;

                    if (eventStartTime <= nowDate && eventEndTime >= nowDate) {
                        tranzabadan.textContent = "Take the course";
                        tranzabadan.classList.remove('cursor-not-allowed', 'bg-green-500');
                        tranzabadan.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                        tranzabadan.type = "submit";
                    } else {
                        tranzabadan.textContent = "The course is not available";
                        tranzabadan.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                        tranzabadan.classList.add('bg-gray-500', 'cursor-not-allowed');
                        tranzabadan.type = "button";
                    }

                    openModal('showcourse');
                },
            });

            calendar.render();
        });

        function handleTakeCourse(courseId, startTime, endTime, availablePlaces) {
            const button = document.getElementById(`take-now-${courseId}`);
            const nowDate = new Date();
            const courseStartTime = new Date(startTime);
            const courseEndTime = new Date(endTime);

            if (courseStartTime <= nowDate && courseEndTime >= nowDate && availablePlaces > 0) {
                button.textContent = "Take the course";
                button.classList.remove('cursor-not-allowed', 'bg-gray-500');
                button.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                button.setAttribute('type', 'submit');
            } else {
                button.textContent = "Not available";
                button.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                button.classList.add('bg-gray-500', 'cursor-not-allowed');
                button.setAttribute('type', 'button');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            @foreach ($courses as $course)
                handleTakeCourse({{ $course->id }}, '{{ $course->start }}', '{{ $course->end }}', {{ $course->places }});
            @endforeach
        });
    </script>
</body>
</html>