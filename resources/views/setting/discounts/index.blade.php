<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4 text-sm font-medium">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-sm font-medium">
                <div class="flex items-center justify-between m-3">
                    <div class="ml-5">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2 border-b-2 border-gray-500 inline-block">
                            Discounts
                        </h2>
                    </div>
                    <div class="mr-5 mt-2">
                        <a href="{{ route('admin.discounts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Discount
                        </a>
                    </div>
                </div>
                <div class="p-3 bg-white border-b border-gray-200">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Title</th>
                                <th class="px-4 py-2 text-left">Product Name</th>
                                <th class="px-4 py-2 text-left">Discount (%)</th>
                                <th class="px-4 py-2 text-left">Original</th>
                                <th class="px-4 py-2 text-left">Discounted</th>
                                <th class="px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td class="px-6 py-4">{{ $discount->id }}</td>
                                    <td class="px-6 py-4">{{ $discount->title }}</td>
                                    <td class="px-6 py-4">
                                        @foreach ($discount->products as $product)
                                            <div>
                                                {{ $product->name }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">{{ number_format($discount->discount, 2) }}</td>
                                    <td class="px-6 py-4">
                                        @foreach ($discount->products as $product)
                                            <div>
                                                {{ number_format($product->price, 2) }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        @foreach ($discount->products as $product)
                                            <div>
                                                @if ($product->discountedPrice !== null)
                                                    ${{ number_format($product->discountedPrice, 2) }}
                                                @else
                                                    No discount applied
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-block">
                                            <i class='bx bx-edit text-2xl'></i>
                                        </a>
                                        <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded inline-block delete-button">
                                                <i class='bx bx-trash text-xl'></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('.delete-form');

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
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
