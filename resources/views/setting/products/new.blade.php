<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session("success") }}',
                });
            </script>
        @endif
        <div class="max-w-xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="create-product-form">
                    @csrf

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                        <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                        <input type="text" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Category Selection -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                        <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Colors Selection -->
                    <div class="mb-4">
                        <label for="colors" class="block text-sm font-medium text-gray-700">Colors</label>
                        <div class="mt-1 grid grid-cols-3 gap-4">
                            @foreach ($colors as $color)
                                <label class="flex items-center">
                                    <input type="checkbox" name="colors[]" value="{{ $color->id }}" class="rounded text-blue-500">
                                    <span class="ml-2 text-sm text-gray-600">{{ $color->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sizes Selection -->
                    <div class="mb-4">
                        <label for="sizes" class="block text-sm font-medium text-gray-700">Sizes</label>
                        <div class="mt-1 grid grid-cols-3 gap-4">
                            @foreach ($sizes as $size)
                                <label class="flex items-center">
                                    <input type="checkbox" name="sizes[]" value="{{ $size->id }}" class="rounded text-blue-500">
                                    <span class="ml-2 text-sm text-gray-600">{{ $size->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add event listener to the form
        document.getElementById('create-product-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'success',
                title: 'Product created successfully!',
            }).then(() => {
                this.submit(); // Submit the form programmatically after the alert
            });
        });
    </script>
</x-app-layout>

<style>
.colored-toast.swal2-icon-success {
    background-color: #a5dc86 !important;
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
