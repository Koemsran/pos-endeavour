<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                {{-- Product List --}}
                <div class="flex justify-between items-center mb-4 ml-5">
                    <h3 class="text-lg font-bold text-gray-800">List of Products</h3>
                </div>
                {{-- Filter by Category --}}
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
                    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New</a>
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
                                    <p class="text-gray-600 mt-1">It's a type of <strong>{{ $product->category ? $product->category->name : 'Uncategorized' }}</strong> </p>
                                    <p class="text-gray-800 font-semibold text-green-700 text-2xl mt-3">Price: ${{ number_format($product->price, 2) }}</p>
                                    <div class="flex justify-end mt-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                            <i class='bx bx-edit text-2xl'></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class='bx bx-trash text-2xl'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.getElementById('category_filter').addEventListener('change', function() {
            let categoryId = this.value;
            window.location.href = categoryId ? '{{ route('admin.products.index') }}?category=' + categoryId : '{{ route('admin.products.index') }}';
        });
    </script>
</x-app-layout>
