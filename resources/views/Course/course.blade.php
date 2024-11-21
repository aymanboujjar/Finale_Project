<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova - Courses</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href={{ asset("storage/images/logo.png") }} type="image/x-icon">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
</head>
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans text-gray-800">

    <!-- Navbar -->
    @if (Route::has('login'))
    <nav class="w-full py-4 px-8 flex justify-between items-center bg-white shadow-lg rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600">Learnova</h1>
        <div class="relative inline-block text-left">
            <button 
                class="inline-flex items-center justify-center w-full rounded-md px-4 py-2 bg-white text-sm font-medium text-gray-700"
                onclick="toggleDropdown()"
                id="menu-button"
                aria-expanded="false"
                aria-haspopup="true">
                <span>{{ Auth::user()->name }}</span>
                <img src={{ asset('storage/' . Auth::user()->image) }} alt="Profile Picture" class="w-8 h-8 rounded-full ml-2">
            </button>
            <div 
                id="dropdown-menu" 
                class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1">
                    <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Courses</a>
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

    <!-- Welcome Section -->
    <div class="text-center mt-20 px-4">
        <h2 class="text-4xl font-extrabold text-white mb-8">Welcome! Here are your Courses</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6">
            @foreach ($user->courses as $item)
            <div class="w-full bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <div class="relative h-48 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $item->image) }}')">
                    <div class="absolute inset-0 bg-black opacity-30"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-blue-600 mb-2">{{ $item->name }}</h3>
                    <p class="text-gray-700 mt-4 text-sm mb-4">{{ Str::limit($item->description, 80) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Available Places: {{ $item->places }}</span>
                        <button 
                            class="px-6 py-2 text-white font-semibold rounded-lg shadow-md bg-blue-600 hover:bg-blue-700 transition-all"
                            onclick="window.location.href='/lesson/show/{{ $item->id }}'">
                            Show Lessons
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-20 py-6 w-full text-center bg-white shadow-t-md">
        <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
    </footer>

</body>
</html>
