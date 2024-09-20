<x-app-layout>
    <!-- resources/views/setting/slideshow/index.blade.php -->

    <div class="container mx-auto px-4 py-8">
        <!-- Add New Image Button -->
        <div class="mb-4">
            <button id="openAddModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add New Image
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="text-start px-4">Image</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slideshows as $slideshow)
                    <tr class="border-t">
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $slideshow->image) }}" alt="Image" class="w-20 h-20 object-cover">
                        </td>
                        <td class="px-4 py-2 text-center">
                            <!-- Edit Button -->
                            <button data-id="{{ $slideshow->id }}" class="openEditModal text-blue-700 hover:text-blue-500 ">
                                <i class='bx bx-edit text-xl'></i>
                            </button>

                            <!-- Delete Form -->
                            <button onclick="deleteSlideshow('{{ $slideshow->id }}')" class="text-red-600 hover:text-red-900">
                                <i class='bx bx-trash text-xl'></i>
                            </button>
                            <form id="delete-slideshow-{{ $slideshow->id }}" action="{{ route('admin.slideshow.destroy', $slideshow->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
        <div class="p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Add New Slide Show Image
                    </h3>
                    <button id="closeAddModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="container mx-auto px-4 py-8">
                    <form id="create-slideShow-form" action="{{ route('admin.slideshow.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="image" class="block  text-sm font-bold mb-2">Image:</label>
                            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Add Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
        <div class="p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Edit Slide Show Image
                    </h3>
                    <button id="closeEditModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="container mx-auto px-4 py-8">
                    <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="edit_image" class="block text-sm font-bold mb-2">Image:</label>
                            <input type="file" name="image" id="edit_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //============ create new image =================
        document.getElementById('openAddModal').addEventListener('click', function() {
            document.getElementById('addModal').classList.remove('hidden');
        });

        document.getElementById('closeAddModal').addEventListener('click', function() {
            document.getElementById('addModal').classList.add('hidden');
        });

        //================ edit image slideshow==========
        document.querySelectorAll('.openEditModal').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const editForm = document.getElementById('editForm');
                editForm.action = `/admin/slideshow/${id}`;
                document.getElementById('editModal').classList.remove('hidden');
            });
        });

        document.getElementById('closeEditModal').addEventListener('click', function() {
            document.getElementById('editModal').classList.add('hidden');
        });
         // Add event listener to the form
         document.getElementById('edit-slideShow-form').addEventListener('submit', function(event) {
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
            title: 'Slide show updated successfully!',
          }).then(() => {
            this.submit(); // Submit the form programmatically after the alert
          });
        });
        //=============Delete slideshow============
        function deleteSlideshow(slideshowId) {
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
                    document.getElementById('delete-slideshow-' + slideshowId).submit();
                }
            });
        }
        // =================== alert ===================
        document.getElementById('editForm').addEventListener('submit', function(event) {
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
            title: 'Slide show updated successfully!',
          }).then(() => {
            this.submit(); // Submit the form programmatically after the alert
          });
        });
    </script>

<style>
    .colored-toast.swal2-icon-success {
      background-color: #58cd15 !important;
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
