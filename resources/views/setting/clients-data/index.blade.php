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
          <h3 class="text-lg font-bold text-gray-800">List of Clients</h3>
        </div>
        {{-- Filter by clients --}}
        <div class="flex justify-between items-center mb-4 ml-5">
          <div class="flex items-center space-x-2 w-2/5">
            <div>
              <form action="{{ route('admin.categories.index') }}" method="GET" class="flex items-center" id="search-form">
                <input type="text" name="search" placeholder="Search Client..." class="px-4 py-2 border rounded focus:outline-none focus:border-blue-500" id="search-input">
              </form>
            </div>
          </div>
          <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New</a>
        </div>
        <hr>


        @if ($clients->isEmpty())
        <p class="text-center mt-3">No Client found.</p>

        @else
        <table class="min-w-full divide-y divide-gray-200 mt-5">
          <thead class="bg-gray-50">
            <tr>
              <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">ID</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Name</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Phone Number</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Age</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Progress</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-sm text-gray-800 border-b border-gray-200">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200 ">

            @foreach ($client as $index => $client)
            <tr class="hover:bg-gray-100">
              <td class="px-6 py-4 whitespace-nowrap">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded">
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $client->phone_number }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $client->age }}</td>
              <td class="px-6 py-4 whitespace-nowrap">Paid</td>
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
</x-app-layout>