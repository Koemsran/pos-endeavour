<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Feedback
        </h2>
    </x-slot>

    <div class=" py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-4" role="alert">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.feedbacks.store') }}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="user" class="block text-lg font-medium text-gray-800 mb-1">User Id</label>
                <input type="number" id="user" name="user" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="field" class="block text-lg font-medium text-gray-800 mb-1">Field Id</label>
                <input type="number" id="field" name="field" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="feedback_text" class="block text-lg font-medium text-gray-800 mb-1">Feedback Text</label>
                <input type="text" id="feedback_text" name="feedback_text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2 px-3">
            </div>
            <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                Submit
            </button>
        </form>
    </div>
</x-app-layout>