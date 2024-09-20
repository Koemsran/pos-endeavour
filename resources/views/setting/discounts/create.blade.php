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
                    title: 'Your work has been saved',
                });
            </script>
        @endif
        <div class="max-w-xl mx-auto sm:px-4 lg:px-4 text-sm font-medium">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-sm font-medium">
                <div class="flex items-center justify-between">
                    <div class="ml-5">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2 border-b-2 border-gray-500 inline-block">
                            Create Discount
                        </h2>
                    </div>
                </div>
                <div class="p-3 bg-white border-b border-gray-200">
                    <form id="discount-form" action="{{ route('admin.discounts.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" name="title" id="title"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Select
                                Product:</label>
                            <select name="product_id[]" id="product_id" multiple
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="border rounded border-gray-300 flex p-2 max-h-40 overflow-y-auto"
                            id="selected-products">
                            <!-- Selected products will be displayed here -->
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block text-gray-700 text-sm font-bold mb-2">Discount
                                Percentage:</label>
                            <input type="number" name="discount" id="discount"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create
                            Discount</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Listen for changes in the select box
        document.getElementById('product_id').addEventListener('change', function() {
            // Get the selected options
            let selectedOptions = Array.from(this.selectedOptions).map(option => option.textContent);
            
            // Update the display of selected products
            let selectedProductsDiv = document.getElementById('selected-products');
            selectedProductsDiv.innerHTML = '';
            selectedOptions.forEach(option => {
                let productElement = document.createElement('div');
                productElement.textContent = option;
                productElement.classList.add('border', 'rounded', 'border-gray-300', 'm-1', 'p-1');
                selectedProductsDiv.appendChild(productElement);
            });
        });

        // Add event listener to the form
        document.getElementById('discount-form').addEventListener('submit', function(event) {
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
                title: 'Discount created successfully!',
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
