

<div id="classmodal" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-20 mx-auto shadow-xl rounded-md bg-white max-w-md">

        <div class="flex justify-end p-2">
            <button onclick="closeModal('classmodal')" type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

            <div>
                <h1 class="text-center text-3xl font-semibold">Create your Class</h1>
                <form action="{{ route('class.store') }}" method="post" class="max-w-4xl mx-auto  bg-white p-8 rounded-lg shadow-md" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Class Name</label>
                        <input 
                            id="name" 
                            class="block mt-2 p-4 w-full rounded-lg border border-gray-300 bg-transparent focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            type="text" 
                            name="name"
                            placeholder="Enter the class name"
                            required
                        />
                    </div>
                    
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Class Description</label>
                        <textarea 
                            id="description" 
                            class="block mt-2 p-4 w-full rounded-lg border border-gray-300 bg-transparent focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            name="description" 
                            placeholder="Enter the class description" 
                            rows="4"
                            required
                        ></textarea>
                    </div>
            
                    <div class="mb-6">
                        <label for="places" class="block text-sm font-medium text-gray-700">Class Members</label>
                        <input 
                            id="places" 
                            class="block mt-2 p-4 w-full rounded-lg border border-gray-300 bg-transparent focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            type="number" 
                            name="places"
                            placeholder="Number of members allowed"
                            required
                        />
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Classe Image') }}</label>
                        <div class="mt-1">
                            <input 
                                id="image" 
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
                                type="file" 
                                name="image" 
                                required />
                        </div>
                        @error('image')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <button 
                            type="submit" 
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 focus:ring-4 focus:ring-blue-300"
                        >
                            Save Class
                        </button>
                    </div>
                </form>
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
