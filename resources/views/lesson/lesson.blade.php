<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learnova</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href={{ asset("storage/images/logo.png") }} type="image/x-icon">
</head>
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">
    
    <!-- Navbar -->
    <nav class="w-full py-4 px-8 flex justify-between items-center bg-white shadow-md rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600">Learnova</h1>
    </nav>

    <!-- Course Lessons Section -->
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Available Lessons</h2>
        <div class="space-y-6">
            @foreach ($courses->lessons as $item)
            <div class="border rounded-lg p-4 shadow-sm bg-gradient-to-r from-gray-50 to-gray-100">
                <h3 class="text-xl font-bold text-blue-600">{{ $item->name }}</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $item->description }}</p>
                <div class="mt-4">
                    @php
                        $fileExtension = pathinfo($item->image, PATHINFO_EXTENSION);
                    @endphp
            
                    @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif',"webp"]))
                    <!-- Display image -->
                    <img 
                        src="{{ asset('storage/' . $item->image) }}" 
                        alt="Lesson Image" 
                        class="w-full h-48 object-cover rounded-lg shadow-md">
                    @elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg']))
                    <!-- Display video -->
                    <video 
                        controls 
                        class="w-full object-contain h-48 rounded-lg shadow-md">
                        <source  src="{{ asset('storage/' . $item->image) }}" type="video/{{ $fileExtension }}">
                        Your browser does not support the video tag.
                    </video>
                    @elseif (in_array($fileExtension, ['pdf']))
                    <!-- Display PDF as link -->
                    <img class="w-[10%]" src={{ asset('storage/images/pdf.png') }} alt="">
                    <a 
                        href="{{ asset('storage/' . $item->image) }}" 
                        target="_blank" 
                        class="text-blue-600 underline ps-2">
                        View PDF
                    </a>
                    @else
                    <!-- Fallback for unknown file types -->
                    <p class="text-red-600">Unsupported file type: {{ $fileExtension }}</p>
                    @endif
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
