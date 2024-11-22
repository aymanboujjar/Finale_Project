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
<!-- Success Message -->
    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success fixed top-5 z-[1111111111] right-5 bg-green-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
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

   

  <!-- Courses Section -->
<section class="py-12 bg-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h3 class="text-3xl font-extrabold text-gray-800">My Courses</h3>
            
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($courses as $course)
           
            <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h4 class="text-xl font-semibold text-blue-600">{{ $course->name }}</h4>
                    <p class="mt-2 text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                    <p class="mt-2 text-gray-600">Course type : {{ ($course->type) }}</p>
                    @if ($course->is_complete)
                    <button 
                        type="button"
                        id="take-now-{{ $course->id }}" 
                        class="px-4 py-2 text-white font-medium rounded-lg bg-green-500 cursor-default w-full flex justify-center items-center"
                    >
                        Course Completed
                    </button>
                @else
                    <button 
                        type="button"
                        id="take-now-{{ $course->id }}" 
                        class="px-4 py-2 text-white font-medium rounded-lg bg-red-500 cursor-default w-full flex justify-center items-center"
                    >
                        Course Incompleted
                    </button>
                @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    

    <div id="showcourse" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-20 mx-auto shadow-2xl rounded-md bg-white max-w-4xl p-6">
            <!-- Close Button -->
            <div class="flex justify-end p-2">
                <button onclick="closeModal('showcourse')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
    
            <!-- Modal Content -->
            <div class="mt-4">
                <h3 class="text-2xl font-bold text-center text-blue-600 mb-6">this Class  Courses</h3>
    
                <!-- Courses Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($courses as $course)
                        <div class="bg-gray-100 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover rounded-t-md">
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-blue-600">{{ $course->name }}</h4>
                                <p class="mt-2 text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                                <p class="mt-2 text-gray-600">Course Type: <span class="font-medium text-gray-800">{{ $course->type }}</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    

<script type="text/javascript">

    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>

</section>














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

     

     
    </script>
</body>
</html>
