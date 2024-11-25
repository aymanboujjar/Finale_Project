<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova - Admin Dashboard</title>
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
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-extrabold text-indigo-600">Learnova Admin</h1>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Users</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Courses</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600">Settings</a>
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

    <!-- Main Content -->
    <div class="pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Pending User Approvals</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 text-left">
                                    <th class="px-6 py-3 text-sm font-semibold text-gray-900">Name</th>
                                    <th class="px-6 py-3 text-sm font-semibold text-gray-900">Email</th>
                                    <th class="px-6 py-3 text-sm font-semibold text-gray-900">Approval</th>
                                    <th class="px-6 py-3 text-sm font-semibold text-gray-900">Role</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('admin.approve-user', $user->id) }}" method="POST">
                                                @csrf
                                                @if ($user->is_approved == true)
                                                    <button type="button" 
                                                            class="px-4 py-2 bg-green-500 text-white rounded-lg cursor-not-allowed">
                                                        Approved
                                                    </button>
                                                @else
                                                    <button type="submit" 
                                                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                                                        Approve
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('switch', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                                                    Make Coach
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($users->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No pending approvals at the moment.</p>
                        </div>
                    @endif
                </div>
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

    <script>
        // Dropdown Toggle
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }

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

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdown-menu');
            const button = document.getElementById('menu-button');
            
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>