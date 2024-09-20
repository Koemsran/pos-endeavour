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
                

                @if ($products->isEmpty())
                    <p>No products found.</p>
                   
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Image</th>
                                <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Name</th>
                                <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Category</th>
                                <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Price</th>
                                <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Colors</th>
                                <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Sizes</th>
                                <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Discounts</th>
                                <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 ">
                            
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->category ? $product->category->name : 'Uncategorized' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($product->colors as $color)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ strtolower($color->name) }}-200 text-{{ strtolower($color->name) }}-800">
                                                {{ $color->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($product->sizes as $size)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                                {{ $size->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $product->discounted_price }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
