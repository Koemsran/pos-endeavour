<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Clients') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-full mx-auto sm:px-6">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

        {{-- Client List --}}
        <div class="flex justify-between items-center mb-4 ml-5">
          <h3 class="text-lg font-bold text-gray-800">List of Clients</h3>
          <div class="flex justify-between items-center mb-4 gap-10">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex items-center" id="search-form">
              <input type="text" name="search" placeholder="Search client..." class="px-4 py-2 border rounded focus:outline-none focus:border-blue-500" id="search-input">
            </form>
            <a href="#" id="open-modal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New</a>
          </div>
        </div>
        <hr>

        @if ($clients->isEmpty())
        <p class="text-center mt-3">No Client found.</p>
        @else
        <table class="min-w-full divide-y divide-gray-200 mt-5">
          <thead class="bg-gray-50">
            <tr>
              <th class="py-4 px-6 bg-gray-100 font-bold text-start text-sm text-gray-800 border-b border-gray-200">ID</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Name</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Phone Number</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Age</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Progress</th>
              <th class="py-4 px-1 bg-gray-100 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($clients as $index => $client)
            <tr class="hover:bg-gray-100">
              <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $client->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $client->phone_number }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $client->age }}</td>
              <td class="px-6 py-4 whitespace-nowrap">Paid</td>
              <td class="px-4 py-2 whitespace-nowrap">
                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 edit-client" data-id="{{ $client->id }}" data-name="{{ $client->name }}" data-phone="{{ $client->phone_number }}" data-age="{{ $client->age }}">
                  <i class='bx bx-edit text-2xl'></i>
                </a>
                <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="inline-block">
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

  <!-- Modal for Adding New Client -->
  <div id="client-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
      <h2 class="text-lg font-bold mb-4">Add New Client</h2>
      <form action="{{ route('admin.clients.store') }}" method="POST" id="client-form">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Client's Name:</label>
          <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter name" required>
        </div>
        <div class="mb-4">
          <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Client's Age:</label>
          <input type="number" id="age" name="age" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter age" required>
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Client's Phone Number:</label>
          <input type="text" id="phone" name="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter phone number" required>
        </div>
        <div class="flex justify-end gap-4">
          <button type="button" id="close-modal" class="mr-2 bg-red-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</button>
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal for Editing Client -->
  <div id="edit-client-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
      <h2 class="text-lg font-bold mb-4">Edit Client</h2>
      <form id="edit-client-form" method="POST" action="">
        @csrf
        @method('PUT') <!-- Add this to indicate the request method -->
        <input type="hidden" id="edit-client-id" name="id">
        <div class="mb-4">
          <label for="edit-name" class="block text-gray-700 text-sm font-bold mb-2">Client's Name:</label>
          <input type="text" id="edit-name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter name" required>
        </div>
        <div class="mb-4">
          <label for="edit-age" class="block text-gray-700 text-sm font-bold mb-2">Client's Age:</label>
          <input type="number" id="edit-age" name="age" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter age" required>
        </div>
        <div class="mb-4">
          <label for="edit-phone" class="block text-gray-700 text-sm font-bold mb-2">Client's Phone Number:</label>
          <input type="text" id="edit-phone" name="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter phone number" required>
        </div>
        <div class="flex justify-end gap-4">
          <button type="button" id="close-edit-modal" class="mr-2 bg-red-500 hover:bg-gray-400 text-white font-bold py-2 px-4 rounded">Cancel</button>
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const clientModal = document.getElementById('client-modal');
      const editClientModal = document.getElementById('edit-client-modal');

      document.getElementById('open-modal').addEventListener('click', () => {
        clientModal.classList.remove('hidden');
      });

      document.getElementById('close-modal').addEventListener('click', () => {
        clientModal.classList.add('hidden');
      });

      document.querySelectorAll('.edit-client').forEach(button => {
        button.addEventListener('click', () => {
          const id = button.getAttribute('data-id');
          const name = button.getAttribute('data-name');
          const phone = button.getAttribute('data-phone');
          const age = button.getAttribute('data-age');

          // Populate the edit modal with client data
          document.getElementById('edit-client-id').value = id;
          document.getElementById('edit-name').value = name;
          document.getElementById('edit-age').value = age;
          document.getElementById('edit-phone').value = phone;

          editClientModal.classList.remove('hidden');
        });
      });

      document.getElementById('close-edit-modal').addEventListener('click', () => {
        editClientModal.classList.add('hidden');
      });
    });

    function openEditModal(client) {
      document.getElementById('edit-client-id').value = client.id;
      document.getElementById('edit-name').value = client.name;
      document.getElementById('edit-age').value = client.age;
      document.getElementById('edit-phone').value = client.phone_number;

      // Set the action to the update route with the client ID
      const form = document.getElementById('edit-client-form');
      form.action = `{{ route('admin.clients.update', '') }}/${client.id}`;

      // Show the modal
      document.getElementById('edit-client-modal').classList.remove('hidden');
    }
  </script>
</x-app-layout>