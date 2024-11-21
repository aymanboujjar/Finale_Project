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
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">

    <!-- Navbar -->
    @if (Route::has('login'))
    <nav class="fixed top-0 w-full z-50 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-extrabold text-blue-600">Learnova</h1>
                </div>
            
                <div class="flex items-center">
                    <div class="relative inline-block text-left">
                        <button 
                            class="inline-flex items-center justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-700 focus:outline-none"
                            onclick="toggleDropdown()"
                            id="menu-button"
                            aria-expanded="false"
                            aria-haspopup="true">
                            <span>{{ Auth::user()->name }}</span>
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="w-8 h-8 rounded-full ml-2">
                        </button>
                        <div 
                            id="dropdown-menu" 
                            class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="{{ url('/calendar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Courses</a>
                                @if (Auth::user() && Auth::user()->hasRole(['coach']))
                                <a href="{{ url('/coaching') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Coaching</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
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
    {{-- <section class="pt-24 bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl font-extrabold text-white mb-4">Unlock Your Potential</h2>
            <p class="text-xl text-gray-200 mb-6">Join thousands of learners from around the world in online courses.</p>
            <a href="{{ url('/courses') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-700">Explore Courses</a>
        </div>
    </section> --}}
    <!-- Calendar Section -->
    <section class="py-12 bg-blue-50 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h3 class="text-3xl font-extrabold text-gray-800">Courses Calendar</h3>
                <p class="mt-4 text-gray-600">Stay on top of your course schedules.</p>
            </div>
            <div class="w-full h-[90vh] bg-white rounded-3xl border-none p-3 shadow-md" id="calendar"></div>
        </div>
    </section>
    <!-- Courses Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h3 class="text-3xl font-extrabold text-gray-800">Featured Courses</h3>
                <p class="mt-4 text-gray-600">Enhance your skills with our expert-led courses.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses as $course)
                <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-blue-600">{{ $course->name }}</h4>
                        <p class="mt-2 text-gray-600">{{ Str::limit($course->description, 20) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-500">Available Places: {{ $course->places }}</span>
                            <a href="#" 
                               onclick="openCourseModal({{ $course->id }})" 
                               class="px-4 py-2 bg-blue-500 text-white text-sm rounded-md hover:bg-blue-600">Take It Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h3 class="text-3xl font-extrabold text-gray-800">Featured Classes</h3>
                <p class="mt-4 text-gray-600">Enhance your skills with our expert-led courses.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($classes as $class)
                <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-blue-600">{{ $class->name }}</h4>
                        <p class="mt-2 text-gray-600">{{ Str::limit($class->description, 20) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-500">Available Places: {{ $class->places }}</span>
                            <a href="#" 
                               onclick="openclassModal({{ $class->id }})" 
                               class="px-4 py-2 bg-blue-500 text-white text-sm rounded-md hover:bg-blue-600">Take It Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section> --}}



    <!-- Modal for Course Details -->
    <div id="showcourse" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-20 mx-auto shadow-xl rounded-md bg-white max-w-lg">
            <div class="flex justify-end p-2">
                <button onclick="closeModal('showcourse')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 max-w-lg mx-auto bg-white rounded-lg shadow-md space-y-4">
                <h1 id="name" class="text-2xl font-bold text-gray-800"></h1>
                <p id="description" class="text-sm text-gray-600"></p>
                <p id="place" class="text-lg text-gray-700"></p>
                <p id="time" class="text-md text-blue-600"></p>
                <p id="time2" class="text-md text-blue-600"></p>
                <form action="{{ route('course_user.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="calendar_id" name="calendar_id" >
                    <button id="tranzabadan" class="px-4 flex w-full justify-center items-center py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg">Take it now</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-20 py-6 w-full text-center bg-white shadow-t-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
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

        // Close all modals when pressing ESC
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

        function openCourseModal(courseId) {
            // Fetch course details via AJAX and populate the modal
            axios.get(`/courses/${courseId}`)
                .then(response => {
                    const course = response.data;
                    document.getElementById('name').textContent = "Course Name: " + course.name;
                    document.getElementById('description').textContent = "About the course: " + course.description;
                    document.getElementById('place').textContent = "Places left: " + course.places;
                    document.getElementById('time').textContent = "Start At: " + course.start;
                    document.getElementById('time2').textContent = "End At: " + course.end;
                    document.getElementById('calendar_id').value = course.id;

                    const eventStartTime = new Date(course.start);
                    const eventEndTime = new Date(course.end);
                    const nowDate = new Date();
                    const tranzabadan = document.getElementById('tranzabadan');

                    if (eventStartTime <= nowDate && eventEndTime >= nowDate) {
                        tranzabadan.textContent = "Take the course";
                        tranzabadan.classList.remove('cursor-not-allowed', 'bg-green-500');
                        tranzabadan.classList.add('bg-blue-500', 'hover:bg-blue-600');
                        tranzabadan.type = "submit";
                    } else {
                        tranzabadan.textContent = "The course is not available";
                        tranzabadan.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                        tranzabadan.classList.add('bg-green-500', 'cursor-not-allowed');
                        tranzabadan.type = "button";
                    }

                    openModal('showcourse');
                })
                .catch(error => {
                    console.error('Error fetching course details:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', async function() {
            let response = await axios.get("/calendar/create");
            let events = response.data.events;

            var myCalendar = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(myCalendar, {
                headerToolbar: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay',
                    center: 'title',
                    right: 'listMonth,listWeek,listDay'
                },
                views: {
                    listDay: { buttonText: 'Day Events' },
                    listWeek: { buttonText: 'Week Events' },
                    listMonth: { buttonText: 'Month Events' },
                    timeGridWeek: { buttonText: 'Week' },
                    timeGridDay: { buttonText: "Day" },
                    dayGridMonth: { buttonText: "Month" }
                },
                initialView: "timeGridWeek",
                slotMinTime: "04:00:00",
                slotMaxTime: "19:00:00",
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
                        tranzabadan.classList.add('bg-blue-500', 'hover:bg-blue-600'); 
                        tranzabadan.type = "submit";
                    } else {
                        tranzabadan.textContent = "The course is not available";
                        tranzabadan.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                        tranzabadan.classList.add('bg-green-500', 'cursor-not-allowed');
                        tranzabadan.type = "button";
                    }

                    openModal('showcourse');
                },
            });

            calendar.render();
        });
    </script>
</body>
</html>
