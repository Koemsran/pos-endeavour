<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Feedback
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form id="edit-feedback-form" action="{{ route('admin.feedbacks.update', $feedback->id) }}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="user" class="block text-gray-700 font-bold mb-2">User Id</label>
                    <input type="number" id="user" name="user" value="{{ old('user', $feedback->user_id) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="field" class="block text-gray-700 font-bold mb-2">Field Id</label>
                    <input type="number" id="field" name="field" value="{{ old('field', $feedback->field_id) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="feedback_text" class="block text-gray-700 font-bold mb-2">Feedback Text</label>
                    <input type="text" id="feedback_text" name="feedback_text" value="{{ old('feedback_text', $feedback->feedback_text) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Add event listener to the form
        document.getElementById('edit-feedback-form').addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the form from submitting normally
    
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            customClass: {
              icon: 'colored-toast',
              popup: 'colored-toast',
              title: 'colored-toast',
            },
            iconColor: '#a5dc86', // Green background for success
          });
    
          Toast.fire({
            icon: 'success',
            title: 'Feedback updated successfully!',
          }).then(() => {
            this.submit(); // Submit the form programmatically after the alert
          });
        });
      </script>
    
      <style>
        .colored-toast.swal2-icon-success {
          background-color: #58cf13 !important;
        }
    
        .colored-toast.swal2-icon-error {
          background-color: #f27474 !important;
        }
    
        .colored-toast.swal2-icon-warning {
          background-color: #f8bb86 !important;
        }
    
        .colored-toast.swal2-icon-info {
          background-color: #3fc3ee !important;
        }
    
        .colored-toast.swal2-icon-question {
          background-color: #87adbd !important;
        }
    
        .colored-toast .swal2-title {
          color: white;
        }
    
        .colored-toast .swal2-close {
          color: white;
        }
    
        .colored-toast .swal2-html-container {
          color: white;
        }
      </style>
</x-app-layout>