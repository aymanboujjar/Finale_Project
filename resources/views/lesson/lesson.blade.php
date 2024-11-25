<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Learnova - Course Lessons</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
</head>
<body class="bg-gradient-to-br from-purple-50 via-white to-blue-50 min-h-screen font-sans">
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success fixed top-5 z-[1111111111] right-5 bg-green-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger fixed top-5 z-[1111111111] right-5 bg-red-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('error') }}
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning fixed top-5 z-[1111111111] right-5 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
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

    <!-- Course Lessons Section -->
    <div class="pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Course Lessons</h2>
            <div id="lessons-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($calendar->lessons as $index => $item)
                @php
                    $isCompleted = $item->completed === 'true';
                @endphp
                <div class="lesson bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 {{ !$isCompleted && $index !== 0 ? 'opacity-50 pointer-events-none' : '' }}" data-index="{{ $index }}">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-indigo-600 mb-3">{{ $item->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item->description }}</p>

                        <!-- Media Content -->
                        <div class="mb-4">
                            @php
                                $fileExtension = pathinfo($item->image, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Lesson Image" class="w-full h-48 object-cover rounded-lg">
                            @elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg']))
                                <video controls class="w-full h-48 rounded-lg">
                                    <source src="{{ asset('storage/' . $item->image) }}" type="video/{{ $fileExtension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif ($fileExtension === 'pdf')
                                <div class="flex items-center">
                                    <img class="w-12 h-12" src="{{ asset('storage/images/pdf.png') }}" alt="PDF Icon">
                                    <a href="{{ asset('storage/' . $item->image) }}" target="_blank" class="ml-3 text-indigo-600 hover:text-indigo-700 font-medium">View PDF</a>
                                </div>
                            @endif
                        </div>

                        <!-- Complete Button -->
                        <button class="complete-btn w-full px-6 py-3 rounded-lg font-medium transition-colors bg-indigo-600 text-white hover:bg-indigo-700">
                            Mark as Completed
                        </button>
                    </div>
                </div>
                   <!-- Final Project Modal -->
    <div id="final-project-modal" class="fixed justify-center inset-0 z-50 hidden bg-gray-900/60 backdrop-blur-sm">
        <div class="min-h-screen px-4 text-center">
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Final Project / Exam</h3>
                    <p class="text-gray-600 mb-6">Answer the following questions to complete your course.</p>

                    <form action="{{ route('final.store') }}" method="POST">
                        @csrf
                        @foreach($finalproject as $index => $question)
                        <div class="mb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $index + 1 }}. {{ $question->question }}</h4>
                            <textarea 
                                name="reponse{{ $index + 1 }}" 
                                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                                rows="3" 
                                placeholder="Your answer here..."
                                required></textarea>
                        </div>
                        @endforeach

                        <input type="hidden" name="calendar_id" value="{{ $calendar->id }}">

                        <div class="flex justify-center space-x-4">
                            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                Submit
                            </button>
                            <button type="button" onclick="closeFinalProjectModal()" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                @endforeach
            </div>

            <!-- Final Project Button -->
            <div id="final-project-button-container" class="text-center mt-10" style="display: none;">
                <button onclick="openFinalProjectModal()" class="px-8 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                    Start Final Project
                </button>
            </div>
        </div>
    </div>

 

    <script>
        // Show and hide the final project modal
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }
        function openFinalProjectModal() {
            document.getElementById("final-project-modal").style.display = "flex";
        }
        function closeFinalProjectModal() {
            document.getElementById("final-project-modal").style.display = "none";
        }

        // Lesson Completion without using database (only using JavaScript)
        document.addEventListener("DOMContentLoaded", function() {
            const lessons = document.querySelectorAll(".lesson");
            const completeButtons = document.querySelectorAll(".complete-btn");
            const finalProjectButton = document.getElementById('final-project-button-container');

            completeButtons.forEach((button, index) => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();

                    // Simulating the completion of the lesson in JavaScript
                    button.textContent = 'Completed';
                    button.disabled = true; // Disable the button

                    // Change button styles
                    button.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                    button.classList.add('bg-green-600', 'cursor-not-allowed');

                    // Make the next lesson visible (if it exists)
                    if (index + 1 < lessons.length) {
                        lessons[index + 1].classList.remove("opacity-50", "pointer-events-none");
                    }

                    // If this is the last lesson, show the final project button
                    if (index + 1 === lessons.length) {
                        finalProjectButton.style.display = 'block';
                    }
                });
            });
        });
        function showFlashMessage(message, type) {
            const flashMessage = document.createElement('div');
            flashMessage.classList.add(
                'alert', 'fixed', 'top-5', 'z-50', 'right-5', 'py-2', 'px-4',
                'rounded-md', 'shadow-lg', 'transition-all', 'duration-500',
                'opacity-0', 'translate-x-full', 'text-white'
            );
            
            if (type === 'success') flashMessage.classList.add('bg-green-600');
            else if (type === 'error') flashMessage.classList.add('bg-red-600');
            
            flashMessage.textContent = message;
            document.body.appendChild(flashMessage);
            
            setTimeout(() => {
                flashMessage.classList.remove('opacity-0', 'translate-x-full');
                flashMessage.classList.add('opacity-100', 'translate-x-0');
            }, 100);

            setTimeout(() => {
                flashMessage.classList.add('opacity-0', 'translate-x-full');
                flashMessage.classList.remove('opacity-100', 'translate-x-0');
                setTimeout(() => flashMessage.remove(), 500);
            }, 5000);
        }
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
    </script>
</body>
</html>
