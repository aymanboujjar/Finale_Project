<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Learnova</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href={{ asset("storage/images/logo.png") }} type="image/x-icon">
</head>

<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">

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

    <!-- Navbar and other content here -->

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
    <nav class="w-full py-4 px-8 flex justify-between items-center bg-white shadow-md rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600">Learnova</h1>
        <div class="relative inline-block text-left">
            <button 
                class="inline-flex items-center justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-700"
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
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Coaching</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function toggleDropdown() {
                const dropdown = document.getElementById('dropdown-menu');
                dropdown.classList.toggle('hidden');
            }
        </script>
    </nav>
    @endif

    <!-- Course Lessons Section -->
    <div class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Available Lessons</h2>
        <div id="lessons-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($courses->lessons as $index => $item)
            @php
                $isCompleted = $item->completed === 'true'; // Check if the lesson is marked as completed
            @endphp
            <div 
                class="lesson bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:scale-105 {{ !$isCompleted && $index !== 0 ? 'opacity-50 pointer-events-none' : '' }}" 
                data-index="{{ $index }}">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-600">{{ $item->name }}</h3>
                    <p class="text-sm text-gray-600 mt-2">{{ $item->description }}</p>

                    <!-- Media (Image, Video, or PDF) -->
                    <div class="mt-4">
                        @php
                            $fileExtension = pathinfo($item->image, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <img 
                            src="{{ asset('storage/' . $item->image) }}" 
                            alt="Lesson Image" 
                            class="w-full h-48 object-cover rounded-lg shadow-md">
                        @elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg']))
                        <video 
                            controls 
                            class="w-full object-contain h-48 rounded-lg shadow-md">
                            <source  src="{{ asset('storage/' . $item->image) }}" type="video/{{ $fileExtension }}">
                            Your browser does not support the video tag.
                        </video>
                        @elseif (in_array($fileExtension, ['pdf']))
                        <img class="w-[10%]" src={{ asset('storage/images/pdf.png') }} alt="PDF Icon">
                        <a 
                            href="{{ asset('storage/' . $item->image) }}" 
                            target="_blank" 
                            class="text-blue-600 underline ps-2">
                            View PDF
                        </a>
                        @else
                        <p class="text-red-600">Unsupported file type: {{ $fileExtension }}</p>
                        @endif
                    </div>

                    <!-- Mark as Completed Button -->
                    <form id="form" action="/lesson/update/{{ $item->id }}" method="post" class="mt-4">
                        @method("PUT")
                        @csrf
                        <button 
                            class="complete-btn px-4 py-2 w-full text-white font-semibold  {{ $isCompleted ? 'bg-green-700 '  : 'bg-blue-600 ' }} rounded-lg disabled:opacity-50 disabled:pointer-events-none" 
                            {{ $isCompleted ? 'disabled' : '' }}>
                            {{ $isCompleted ? 'Completed'  : 'Mark as Completed' }}
                        </button>
                    </form>
                </div>
            </div>
            <div id="final-project-modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white rounded-lg p-6 w-96">
                    <h3 class="text-2xl font-bold text-blue-600">Final Project / Exam</h3>
                    <p class="text-sm text-gray-600 mt-2">Answer the following questions to complete your course.</p>
        
                    <!-- Final Project Question 1 -->
                    <form action="{{ route('final.store') }}" method="POST">
                        @csrf
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-800">1. {{ $finalproject[0]->question }}</h4>
                            <textarea  name="reponse1" 
                                class="w-full p-3 mt-2 border border-gray-300 rounded-lg" 
                                rows="5" 
                                placeholder="Your answer here..."></textarea>
                        </div>
        
                        <!-- Final Project Question 2 -->
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-800">2. {{ $finalproject[1]->question }}</h4>
                            <textarea name="reponse2" 
                                class="w-full p-3 mt-2 border border-gray-300 rounded-lg" 
                                rows="5" 
                                placeholder="Your answer here..."></textarea>
                        </div>
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-800">3. {{ $finalproject[2]->question }}</h4>
                            <textarea  name="reponse3"
                                class="w-full p-3 mt-2 border border-gray-300 rounded-lg" 
                                rows="5" 
                                placeholder="Your answer here..."></textarea>
                        </div>
                        <input type="hidden" name="calendar_id" value="{{ $courses->id }}">
                        <button type="submit">Done</button>
                    </form>
        
                    <!-- Close Button -->
                    <div class="mt-6 text-right">
                        <button 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg" 
                            onclick="closeFinalProjectModal()">
                            Close
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
            <div id="final-project-button-container" class="text-center mt-10" style="display: none;">
                <button 
                    id="open-final-project-modal-btn" 
                    class="px-6 py-3 w-full max-w-xs text-white font-semibold bg-green-700 rounded-lg"
                    onclick="openFinalProjectModal()">
                    Open Final Project
                </button>
            </div>
        </div>
    </div>

    <!-- Final Project Modal (Initially Hidden) -->
   

    <!-- Footer -->
    <footer class="bg-white shadow-md py-6 mt-12">
        <div class="text-center text-gray-600">
            <p>&copy; 2024 Learnova. All rights reserved.</p>
        </div>
    </footer>

    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const lessons = document.querySelectorAll(".lesson");
    const completeButtons = document.querySelectorAll(".complete-btn");
    const finalProjectButton = document.getElementById('final-project-button-container');
    
    completeButtons.forEach((button, index) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const form = button.closest('form'); 
            const url = form.action; 
            const formData = new FormData(form);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show success message dynamically
                    showFlashMessage(data.message, 'success');

                    // Mark the lesson as completed visually
                    lessons[index].classList.remove("opacity-50", "pointer-events-none");
                    button.disabled = true;

                    // Show final project button if this was the last lesson
                    if (index + 1 === lessons.length) {
                        finalProjectButton.style.display = 'block'; // Unlock the final project button
                    } else {
                        // Enable the next lesson
                        if (index + 1 < lessons.length) {
                            lessons[index + 1].classList.remove("opacity-50", "pointer-events-none");
                            const nextButton = lessons[index + 1].querySelector(".complete-btn");
                            if (nextButton) {
                                nextButton.disabled = false;
                            }
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("There was an error marking the lesson as completed.");
            });
        });
    });

    function showFlashMessage(message, type) {
        const flashMessage = document.createElement('div');
        flashMessage.classList.add('alert', 'fixed', 'top-5', 'z-50', 'right-5', 'py-2', 'px-4', 'rounded-md', 'shadow-lg', 'transition-all', 'duration-500', 'opacity-0', 'translate-x-full', 'bg-green-600', 'text-white');
        
        flashMessage.textContent = message;
        
        document.body.appendChild(flashMessage);
        
        setTimeout(() => {
            flashMessage.classList.remove('opacity-0', 'translate-x-full');
            flashMessage.classList.add('opacity-100', 'translate-x-0');
        }, 100);

        setTimeout(() => {
            flashMessage.classList.add('opacity-0', 'translate-x-full');
            flashMessage.classList.remove('opacity-100', 'translate-x-0');
        }, 5000); 
    }
});

        function openFinalProjectModal() {
            document.getElementById('final-project-modal').classList.remove('hidden');
        }

        function closeFinalProjectModal() {
            document.getElementById('final-project-modal').classList.add('hidden');
        }
    </script>

</body>

</html>
