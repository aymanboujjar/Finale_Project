<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-black-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <h1 class="text-3xl font-bold mb-6 text-center text-black">
                            Pending User Approvals
                        </h1>
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full border-collapse border border-gray-700">
                                <thead class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 text-black">
                                    <tr>
                                        <th class="border border-gray-700">
                                            Name
                                        </th>
                                        <th class="border border-gray-700">
                                            Email
                                        </th>
                                        <th class="border border-gray-700">
                                            Actions
                                        </th>
                                        <th class="border border-gray-700">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr >
                                            <td class="border border-gray-700  px-4 py-2 text-gray-800 dark:text-black">
                                                {{ $user->name }}
                                            </td>
                                            <td class="border border-gray-700  px-4 py-2 text-gray-800 dark:text-black">
                                                {{ $user->email }}
                                            </td>
                                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                                                <form action="{{ route('admin.approve-user', $user->id) }}" method="POST">
                                                    @csrf
                                                    @if ($user->is_approved == true)
                                                        <button type="button" 
                                                                class="px-4 py-2 bg-green-500 text-white rounded-lg cursor-not-allowed">
                                                            Approved
                                                        </button>
                                                    @else
                                                        <button type="submit" 
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg">
                                                            Approve
                                                        </button>
                                                    @endif
                                                </form>
                                              
                                            </td>
                                            <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">
                                                <form action="{{ route('switch', $user->id) }}" method="POST">
                                                    @csrf
                                            
                                                        <button type="submit" 
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg">
                                                            make it a coach
                                                        </button>
                                                </form>
                                              
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($users->isEmpty())
                            <div class="mt-6 text-center text-gray-600 dark:text-gray-400">
                                No pending approvals at the moment.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
