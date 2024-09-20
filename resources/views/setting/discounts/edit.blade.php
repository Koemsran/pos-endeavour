<x-app-layout>
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
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2 border-b-2 border-gray-500 inline-block">
                        Update Discount
                    </h2>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="update-discount-form" action="{{ route('admin.discounts.update', $discount->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $discount->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Select Product:</label>
                            <select name="product_id[]" id="product_id" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" 
                                        {{ in_array($product->id, old('product_id', $discount->products->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="discount" class="block text-gray-700 text-sm font-bold mb-2">Discount Percentage:</label>
                            <input type="number" name="discount" id="discount" value="{{ old('discount', $discount->discount) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Discount
                            </button>
                            <a href="{{ route('admin.discounts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add event listener to the form
        document.getElementById('update-discount-form').addEventListener('submit', function(event) {
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
                title: 'Discount updated successfully!',
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
