<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden border-t-4 border-orange-400">
            <div class="p-8">
                <div class="uppercase tracking-wide text-2xl text-indigo-500 font-semibold mb-5 text-center">Booking
                    Details</div>
                <h2 class="block text-xl leading-tight font-bold text-gray-900 mb-5 text-center">Field Name: {{
                    $booking->field->name }}</h2>

                <div class="flex items-center mb-4 justify-center text-gray-600">
                    <i class='bx bx-map text-2xl mr-2'></i>
                    <p>Location: {{ $booking->field->location }}</p>
                </div>

                <div class="flex justify-center">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="flex items-center">
                            <span class="text-gray-600 font-medium">Customer Name:</span>
                            <span class="ml-2">{{ $booking->customer->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600 font-medium">Booking Date:</span>
                            <span class="ml-2">{{ $booking->booking_date }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600 font-medium">Start Time:</span>
                            <span class="ml-2">{{ $booking->start_time }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600 font-medium">End Time:</span>
                            <span class="ml-2">{{ $booking->end_time }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600 font-medium">Status:</span>
                            <span class="ml-2 inline-block px-3 py-1 text-xs font-semibold rounded-full
                                {{ $booking->status === 'comfirmed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $booking->status === 'pending' ? 'bg-blue-100 text-blue-800' : '' }}">
                                {{ $booking->status }}
                            </span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600 font-medium">Payment Status:</span>
                            <span class="ml-2 inline-block px-3 py-1 text-xs font-semibold rounded-full
                                {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $booking->payment_status === 'unpaid' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $booking->payment_status }}
                            </span>
                        </div>
                        <div class="col-span-1 sm:col-span-2">
                            <div class="flex items-center">
                                <span class="text-gray-600 font-medium">Option:</span>
                                @if(count($booking->options)>0)
                                <div class="ml-2 flex flex-wrap gap-2">
                                    @foreach($booking->options as $index => $option)
                                    @if($option->name == 'Water')
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $option->name }}: {{ $option->pivot->qty }}
                                    </span>
                                    @else
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $option->name }}
                                    </span>
                                    @endif
                                    @endforeach
                                </div>
                                @else 
                                <div class="ml-2 flex flex-wrap gap-2 text-red-500"> No option chosen</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('admin.bookings.index') }}"
                        class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-2 px-6 border-b-4 border-indigo-700 hover:border-indigo-500 rounded-lg transition duration-300">
                        Back to Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>