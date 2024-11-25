<div id="masterclasse" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
    <div class="relative top-20 mx-auto shadow-xl rounded-md bg-white max-w-md">

        <div class="flex justify-end p-2">
            <button onclick="closeModal('masterclasse')" type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="px-6 py-4">
            <h1 class="text-center text-2xl font-bold mb-6">Create Your Course</h1>
            <form method="post" action="{{ route('masterclasse.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="start" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                    <input name="start" id="start" type="datetime-local"
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="end" class="block text-sm font-medium text-gray-700">End Date & Time</label>
                    <input name="end" id="end" type="datetime-local"
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                    <input id="name" name="name" type="text" placeholder="Enter the class name"
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Course Description</label>
                    <textarea id="description" name="description" placeholder="Enter the class description" rows="4"
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required></textarea>
                </div>
                <div class="mb-6">
                    <label for="places" class="block text-sm font-medium text-gray-700">Course Members</label>
                    <input id="places" name="places" type="number" placeholder="Number of members allowed"
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700">lesson file</label>
                    <input id="image" name="image" type="file"
                        class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="mb-6">
                    <label for="class" class="block text-sm font-medium text-gray-700">in wish Classe you wanna add this course</label>
                    <select class="w-full mt-2" name="class_id" id="">
                        @foreach ($classes as $item)
                            <option  value="{{ $item->id }}">{{ $item->name }}</option>
                            
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label for="type" class="block text-sm font-medium text-gray-700">in wish Classe you wanna add this course</label>
                    <select class="w-full mt-2" name="type" id="">
                            <option  value="free">Free</option>
                            <option  value="payement">Payement</option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 focus:ring-4 focus:ring-blue-300">
                    Save Class
                </button>
            </form>
        </div>
    </div>
</div>
