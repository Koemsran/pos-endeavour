<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <div class="flex justify-between items-center mb-4 ml-5">
                    <h3 class="text-lg font-bold text-gray-800">List of Products</h3>
                    <button class="create-new-product bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New Product</button>
                </div>

                <div class="flex justify-between items-center mb-4 ml-5">
                    <div class="flex items-center space-x-2 w-2/5">
                        <label for="category_filter" class="block text-sm font-medium text-gray-700">Filter by Category:</label>
                        <select id="category_filter" name="category_filter" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>

                @if ($products->isEmpty())
                    <p class="text-center mt-3">No products found.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-5">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-64 w-full object-cover">
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800">Name: {{ $product->name }}</h4>
                                    <p class="text-gray-600 mt-1">It's a type of <strong>{{ $product->category ? $product->category->name : 'Uncategorized' }}</strong></p>
                                    <p class="text-gray-800 font-semibold text-green-700 text-2xl mt-3">Price: ${{ number_format($product->price, 2) }}</p>
                                    <div class="flex justify-end mt-2">
                                        <button class="text-blue-500 hover:text-blue-700 mr-2" onclick="openModal(@json($product))">
                                            <i class='bx bx-edit text-2xl'></i>
                                        </button>
                                        <button class="text-red-500 hover:text-red-700" onclick="openDeleteModal({{ $product->id }})">
                                            <i class='bx bx-trash text-2xl'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for Create Product -->
    <div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-xl">
                <div class="p-6">
                    <h3 class="text-lg font-medium">Create Product</h3>
                    <form id="createForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="create_name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" name="name" id="create_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="create_description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            <textarea name="description" id="create_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="create_price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                            <input type="text" name="price" id="create_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="create_category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                            <select name="category_id" id="create_category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="create_image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                            <input type="file" name="image" id="create_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Product
                            </button>
                            <button type="button" id="closeCreateModal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Update Product -->
    <div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-xl">
                <div class="p-6">
                    <h3 class="text-lg font-medium">Edit Product</h3>
                    <form id="updateForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Image Preview -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Current Image:</label>
                            <img id="currentImage" src="" alt="" class="h-32 w-32 object-cover rounded">
                        </div>

                        <!-- Upload New Image -->
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Update Image:</label>
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

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                            <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Product
                            </button>
                            <button type="button" id="closeModal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-md">
                <div class="p-6">
                    <h3 class="text-lg font-medium">Confirm Delete</h3>
                    <p class="mt-2">Are you sure you want to delete this product?</p>
                    <div class="flex justify-between mt-4">
                        <button id="confirmDelete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Delete
                        </button>
                        <button id="cancelDelete" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('category_filter').addEventListener('change', function() {
            let categoryId = this.value;
            window.location.href = categoryId ? '{{ route('admin.products.index') }}?category=' + categoryId : '{{ route('admin.products.index') }}';
        });

        function openModal(product) {
            document.getElementById('updateForm').action = '/admin/products/' + product.id;
            document.getElementById('currentImage').src = '/storage/' + product.image;
            document.getElementById('name').value = product.name;
            document.getElementById('description').value = product.description;
            document.getElementById('price').value = product.price;
            document.getElementById('category_id').value = product.category_id;
            document.getElementById('updateModal').classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('updateModal').classList.add('hidden');
        });

        document.querySelector('.create-new-product').addEventListener('click', function() {
            document.getElementById('createModal').classList.remove('hidden');
        });

        document.getElementById('closeCreateModal').addEventListener('click', function() {
            document.getElementById('createModal').classList.add('hidden');
        });

        function openDeleteModal(productId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDelete').onclick = function() {
                document.getElementById('deleteForm').action = '/admin/products/' + productId;
                document.getElementById('deleteForm').submit();
            };
        }

        document.getElementById('cancelDelete').addEventListener('click', function() {
            document.getElementById('deleteModal').classList.add('hidden');
        });
    </script>
</x-app-layout>
