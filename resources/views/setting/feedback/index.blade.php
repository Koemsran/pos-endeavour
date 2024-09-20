<x-app-layout>
    <!-- resources/views/feedbacks/index.blade.php -->

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-5">
            <div class="container mx-auto px-6 py-2">
                <strong class="text-2xl font-semibold mt-5">Feedbacks List</strong>
                <div class="bg-white shadow-md rounded my-6">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">ID</th>
                                <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">User Name</th>
                                <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Field Name</th>
                                <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Feedback Text</th>
                                <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                            <tr class="hover:bg-gray-100">
                                <td class="py-4 px-6 border-b border-gray-200">{{ $feedback->id }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    {{ optional($feedback->user)->name }}
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    {{ optional($feedback->field)->name }}
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $feedback->feedback_text }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.feedbacks.edit', $feedback->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-block">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="delete-feedback-{{ $feedback->id }}" action="{{ route('admin.feedbacks.destroy', $feedback->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="deleteFeedback('{{ $feedback->id }}')" type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded inline-block">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function deleteFeedback(feedbackId) {
            Swal.fire({
                title: '<span style="color: #d33; font-weight: bold;">Are you sure?</span>',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<span style="font-weight: bold;">Yes, delete it!</span>',
                cancelButtonText: '<span style="font-weight: bold;">Cancel</span>',
                background: '#f7f7f7',
                customClass: {
                    popup: 'border-2 border-gray-300',
                    confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                    cancelButton: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-feedback-' + feedbackId).submit();
                }
            });
        }
    </script>
</x-app-layout>
