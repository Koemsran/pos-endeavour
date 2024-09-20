<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4 text-sm font-medium">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-sm font-medium">
                <div class="flex items-center justify-between">
                    <div class="ml-5">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2 border-b-2 border-gray-500 inline-block">
                            Orders
                        </h2>
                    </div>
                    {{-- <form class="flex items-center my-1 mr-5 mt-2 shadow-sm" method="GET"
                        action="{{ route('admin.orders.index') }}">
                        <div class="relative flex items-center border border-gray-300 rounded-md shadow-sm">
                            <input
                                class="block w-full px-4 py-2 rounded-md text-gray-700 placeholder-gray-400 bg-white border-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                type="date" name="date" placeholder="Search by day" aria-label="Search">
                            <button
                                class="inline-flex items-center px-4 py-2 text-white bg-blue-500 border border-blue-500 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                type="submit">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>
                        </div>
                    </form> --}}
                    <div class="inline-flex rounded-md shadow-sm space-x-2 justify-end mr-3">
                        <button onclick="filterOrders('last-month')" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            Last Month
                        </button>
                        <button onclick="filterOrders('last-week')" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            Last Week
                        </button>
                        <button onclick="filterOrders('today')" class="px-4 py-2 ml-5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                            Today
                        </button>
                    </div>
        
                </div>

                <div class="p-3 bg-white border-b border-gray-200">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Customer</th>
                                <th class="px-4 py-2 text-left">Product Name</th>
                                <th class="px-4 py-2 text-left">Quantity</th>
                                <th class="px-4 py-2 text-left">Total</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Payment Status</th>
                                <th class="px-4 py-2 text-left">Order Date</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="p-2">
                            @foreach($orders as $index => $order)
                            @foreach($order->products as $productIndex => $product)
                            @if($productIndex == 0)
                            <tr class="border-b">
                                <td class="px-2 py-2">{{ $index+1 }}</td>
                                <td class="px-2 py-2">{{ $order->user->name }}</td>
                                <td class="px-2 py-2">{{ $product->name }}</td>
                                <td class="px-2 py-2">{{ $product->pivot->qty }}</td>
                                <td class="px-2 py-2">${{ number_format($product->pivot->qty * $product->price, 2) }}</td>
                                <td class="py-2 px-1 border-b border-gray-300">
                                    <span class="inline-block px-2 py-1 text-white text-xs font-semibold rounded-full
                                        {{ $order->order_status === 'confirmed' ? 'bg-green-500 text-gray-700' : '' }}
                                        {{ $order->order_status === 'cancelled' ? 'bg-red-500 text-gray-700' : '' }}
                                        {{ $order->order_status === 'pending' ? 'bg-blue-500 text-white-300' : '' }}">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="px-2 py-2">
                                    @if ($order->payment_status === 'unpaid')
                                    <span class="text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Unpaid
                                    </span>
                                    @else
                                    <span class="text-green-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Paid
                                    </span>
                                    @endif
                                </td>
                                <td class="px-2 py-2">{{ \Carbon\Carbon::parse($order->order_date)->isoFormat('dddd, D MMMM, YYYY') }}</td>
                                <td class="py-3 px-3 border-b border-gray-300">
                                    <!-- Alpine.js to handle modal -->
                                    <div x-data="{ showModal: false }">
                                        <!-- Modal -->
                                        <button @click="showModal = true"
                                            class="bg-blue-500 text-xs hover:bg-blue-400 text-white font-bold py-1 px-3 border-blue-700 hover:border-blue-500 rounded">View</button>
                                        {{-- Check order_status to determine button visibility and behavior --}}
                                        @if ($order->order_status === 'pending')
                                        <a href="{{ route('admin.orders.confirm', $order->id) }}"
                                            class="bg-green-500 text-xs hover:bg-green-400 text-white font-bold py-1 px-3 rounded ml-1">Confirm</a>
                                        <a href="{{ route('admin.orders.cancel', $order->id) }}"
                                            class="bg-red-500 text-xs hover:bg-red-400 text-white font-bold py-1 px-3 rounded ml-1">Cancel</a>
                                        @elseif($order->order_status === 'cancelled')
                                        <button class="bg-yellow-500 text-xs hover:bg-blue-400 text-white font-bold py-1 px-3 border-blue-700 hover:border-blue-500 rounded">Restore</button>
                                        @endif
                                        <div x-show="showModal"
                                            class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                                            <div class="bg-white rounded-lg p-6 w-1/2">
                                                <div class="flex justify-between items-center border-b pb-2">
                                                    <h3 class="text-lg font-semibold">Order Details</h3>
                                                    <button @click="showModal = false"
                                                        class="text-gray-400 hover:text-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="mt-4">
                                                    <!-- Modal Content -->
                                                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                                                    <p><strong>Product Name:</strong> {{ $product->name }}</p>
                                                    <p><strong>Quantity:</strong> {{ $product->pivot->qty }}</p>
                                                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                                    <p><strong>Total:</strong> ${{ number_format($product->pivot->qty * $product->price, 2) }}</p>
                                                    <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
                                                    <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                                                    <p><strong>Order Date:</strong> {{
                                                        \Carbon\Carbon::parse($order->order_date)->isoFormat('dddd, D MMMM, YYYY') }}</p>
                                                </div>
                                                <div class="flex justify-end mt-4">
                                                    <button @click="showModal = false"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterOrders(period) {
            let url = new URL(window.location.href);
            url.searchParams.set('filter', period);
            window.location.href = url.href;
        }
    </script>
</x-app-layout>