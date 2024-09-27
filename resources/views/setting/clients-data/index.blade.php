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
          <div class="flex items-center gap-4">
            <form action="{{ route('admin.clients.index') }}" method="GET" class="flex items-center" id="search-form">
              <input type="text" name="search" placeholder="Search client..." value="{{ request('search') }}" class="px-4 py-2 border rounded focus:outline-none focus:border-blue-500" id="search-input">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>
            <a href="#" id="open-modal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New</a>
          </div>
        </div>

        <hr class="my-4">

        @if ($clients->isEmpty())
        <p class="text-center mt-3">No Client found.</p>
        @else
        <table class="min-w-full divide-y divide-gray-200 mt-5">
          <thead class="bg-gray-50">
            <tr>
              <th class="py-4 px-6 font-bold text-start text-sm text-gray-800 border-b border-gray-200">ID</th>
              <th class="py-4 px-1 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Name</th>
              <th class="py-4 px-1 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Phone Number</th>
              <th class="py-4 px-1 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Age</th>
              <th class="py-4 px-1 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Progress</th>
              <th class="py-4 px-1 font-bold text-start text-sm text-gray-800 border-b border-gray-200">Action</th>
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
              <td class="px-4 py-2 whitespace-nowrap flex gap-2">
                <a href="#" class="text-green-500 hover:text-green-700 edit-client" title="progress" data-id="{{ $client->id }}" data-name="{{ $client->name }}" data-phone="{{ $client->phone_number }}" data-age="{{ $client->age }}">
                  <i class='bx bx-line-chart text-2xl'></i>
                </a>
                <a href="#" class="text-blue-500 hover:text-blue-700 edit-client" title="edit" data-id="{{ $client->id }}" data-name="{{ $client->name }}" data-phone="{{ $client->phone_number }}" data-age="{{ $client->age }}">
                  <i class='bx bx-edit text-2xl'></i>
                </a>
                <button type="button" class="text-red-500 hover:text-red-700 delete-client" data-id="{{ $client->id }}" title="delete">
                  <i class='bx bx-trash text-2xl'></i>
                </button>
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
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Create New Client</h3>
        <button id="close-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <form action="{{ route('admin.clients.store') }}" method="POST" id="client-form">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2 mt-3">Client's Name:</label>
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
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal for Editing Client -->
  <div id="edit-client-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Create New Client</h3>
        <button id="close-edit-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <form id="edit-client-form" method="POST" action="">
        @csrf
        @method('PUT')

        <input type="hidden" id="edit-client-id" name="id">

        <div class="mb-4">
          <label for="edit-name" class="block text-gray-700 text-sm font-bold mb-2 mt-3">Client's Name:</label>
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
          <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const clientModal = document.getElementById('client-modal');
      const editClientModal = document.getElementById('edit-client-modal');
      let deleteClientId = null;

      // Open add client modal
      document.getElementById('open-modal').addEventListener('click', () => {
        clientModal.classList.remove('hidden');
      });

      // Close add client modal
      document.getElementById('close-modal').addEventListener('click', () => {
        clientModal.classList.add('hidden');
        document.getElementById('client-form').reset(); // Reset form fields
      });

      // Open edit client modal
      document.querySelectorAll('.edit-client').forEach(button => {
        button.addEventListener('click', () => {
          const id = button.getAttribute('data-id');
          const name = button.getAttribute('data-name');
          const phone = button.getAttribute('data-phone');
          const age = button.getAttribute('data-age');

          document.getElementById('edit-client-id').value = id;
          document.getElementById('edit-name').value = name;
          document.getElementById('edit-age').value = age;
          document.getElementById('edit-phone').value = phone;

          // Update form action dynamically
          document.getElementById('edit-client-form').action = `/admin/clients/${id}`;

          editClientModal.classList.remove('hidden');
        });
      });

      // Close edit client modal
      document.getElementById('close-edit-modal').addEventListener('click', () => {
        editClientModal.classList.add('hidden');
        document.getElementById('edit-client-form').reset(); // Reset form fields
      });

      // Open delete confirmation
      document.querySelectorAll('.delete-client').forEach(button => {
        button.addEventListener('click', () => {
          deleteClientId = button.getAttribute('data-id');

          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.isConfirmed) {
              const form = document.createElement('form');
              form.method = 'POST';
              form.action = `/admin/clients/${deleteClientId}`;

              // CSRF token
              const csrfField = document.createElement('input');
              csrfField.type = 'hidden';
              csrfField.name = '_token';
              csrfField.value = '{{ csrf_token() }}';
              form.appendChild(csrfField);

              // Method field for DELETE
              const methodField = document.createElement('input');
              methodField.type = 'hidden';
              methodField.name = '_method';
              methodField.value = 'DELETE';
              form.appendChild(methodField);

              document.body.appendChild(form);
              form.submit();
            }
          });
        });
      });

      // Handle successful update feedback
      @if(session('success'))
      Swal.fire({
        icon: 'success',
        title: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 1500
      });
      @endif
    });
  </script>
</x-app-layout>