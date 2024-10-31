<x-app-layout>
  @if (session('phone-error'))
  <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
    <p> <strong>Error:</strong> {{ session('phone-error')}}</p>
  </div>
  {{ session()->forget('phone-error') }}
  @endif
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
          <div class="grou-paid flex gap-3">
            <h3 class="text-lg font-bold text-gray-800">List of Clients</h3>
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Paid</button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Unpaid</button>
          </div>
          <div class="flex items-center gap-4">
            <input type="text" id="search-input" placeholder="Search client..." class="px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            <a href="#" id="open-modal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New</a>
          </div>
        </div>

        <hr class="my-4">

        @if ($clients->isEmpty())
        <p class="text-center mt-3">No Client found.</p>
        @else
        <table class="min-w-full divide-y divide-gray-200 mt-5" id="clients-table">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">ID</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Name</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Phone Number</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Age</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Gender</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Consultant</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Register Date</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Paid Status</th>
              <th class="py-3 px-4 font-bold text-sm text-grey-dark border-b border-gray-300">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200 text-center">
            @foreach ($clients as $index => $client)
            <tr class="client-row hover:bg-blue-50 transition duration-300 ease-in-out">
              <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $index + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $client->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $client->phone_number }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $client->age }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $client->gender }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $client->consultant }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $client->register_date }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($client->paid == 'paid')
                <span class="px-2 py-1 rounded-full text-white bg-green-500 text-sm">Paid</span>
                @else
                <span class="px-2 py-1 rounded-full text-white bg-red-500 text-sm">Unpaid</span>
                @endif
              </td>
              <td class="px-4 py-2 whitespace-nowrap flex justify-center gap-2">
                <a href="{{ route('client.progress.index', ['client_id' => $client->id]) }}" class="text-green-500 hover:text-green-700 transition duration-200" title="progress">
                  <i class='bx bx-line-chart text-2xl'></i>
                </a>
                <a href="#" class="text-blue-500 hover:text-blue-700 transition duration-200 edit-client" title="edit"
                  data-id="{{ $client->id }}"
                  data-name="{{ $client->name }}"
                  data-phone="{{ $client->phone_number }}"
                  data-age="{{ $client->age }}"
                  data-gender="{{ $client->gender }}"
                  data-consultant="{{ $client->consultant }}"
                  data-register_date="{{ $client->register_date }}"
                  data-status="{{ $client->status }}"
                  data-paid="{{ $client->paid }}">
                  <i class='bx bx-edit text-2xl'></i>
                </a>
                <!-- Delete Icon -->
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
          <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Client's Gender:</label>
          <select id="gender" name="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Client's Phone Number:</label>
          <input type="text" id="phone" name="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter phone number" required>
        </div>
        <div class="mb-4 hidden">
          <label for="consultant" class="block text-gray-700 text-sm font-bold mb-2">Consultant:</label>
          <input type="text" id="consultant" name="consultant" value="{{ auth()->user()->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter consultant's name" required>
        </div>
        <div class="mb-4">
          <label for="register_date" class="block text-gray-700 text-sm font-bold mb-2">Registration Date:</label>
          <input type="date" id="register_date" name="register_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4" hidden>
          <input type="text" id="status" name="status" value="pending" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4" hidden>
          <input type="text" id="paid" name="paid" value="unpaid" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal for Editing Client -->
  <div id="edit-client-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Client</h3>
        <button id="close-edit-modal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <form id="edit-client-form" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit-client-id" name="id">
        <div class="mb-4">
          <label for="edit-name" class="block text-gray-700 text-sm font-bold mb-2 mt-3">Client's Name:</label>
          <input type="text" id="edit-name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="edit-age" class="block text-gray-700 text-sm font-bold mb-2">Client's Age:</label>
          <input type="number" id="edit-age" name="age" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="edit-gender" class="block text-gray-700 text-sm font-bold mb-2">Client's Gender:</label>
          <select id="edit-gender" name="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="edit-phone" class="block text-gray-700 text-sm font-bold mb-2">Client's Phone Number:</label>
          <input type="text" id="edit-phone" name="phone_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4" hidden>
          <label for="edit-consultant" class="block text-gray-700 text-sm font-bold mb-2">Consultant:</label>
          <input type="text" id="edit-consultant" name="consultant" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
          <label for="edit-register_date" class="block text-gray-700 text-sm font-bold mb-2">Registration Date:</label>
          <input type="date" id="edit-register_date" name="register_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4" hidden>
          <input type="text" id="edit-status" name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4" hidden>
          <input type="text" id="edit-paid" name="paid" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="flex items-center justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Open modal for adding new client
      const openModalButton = document.getElementById('open-modal');
      const clientModal = document.getElementById('client-modal');
      const closeModalButton = document.getElementById('close-modal');

      openModalButton.addEventListener('click', () => {
        clientModal.classList.remove('hidden');
      });

      closeModalButton.addEventListener('click', () => {
        clientModal.classList.add('hidden');
      });

      // Open modal for editing client
      const editClientButtons = document.querySelectorAll('.edit-client');
      const editClientModal = document.getElementById('edit-client-modal');
      const closeEditModalButton = document.getElementById('close-edit-modal');
      const editClientForm = document.getElementById('edit-client-form');

      editClientButtons.forEach(button => {
        button.addEventListener('click', function() {
          const id = this.dataset.id;
          const name = this.dataset.name;
          const phone = this.dataset.phone;
          const age = this.dataset.age;
          const gender = this.dataset.gender;
          const consultant = this.dataset.consultant;
          const register_date = this.dataset.register_date;
          const status = this.dataset.status;
          const paid = this.dataset.paid;
          document.getElementById('edit-client-id').value = id;
          document.getElementById('edit-name').value = name;
          document.getElementById('edit-phone').value = phone;
          document.getElementById('edit-age').value = age;
          document.getElementById('edit-gender').value = gender;
          document.getElementById('edit-consultant').value = consultant;
          document.getElementById('edit-register_date').value = register_date;
          document.getElementById('edit-status').value = status;
          document.getElementById('edit-paid').value = paid;

          editClientForm.action = `/admin/clients/${id}`; // Update the form action
          editClientModal.classList.remove('hidden');
        });
      });

      closeEditModalButton.addEventListener('click', () => {
        editClientModal.classList.add('hidden');
      });

      // Live search functionality
      const searchInput = document.getElementById('search-input');
      const clientRows = document.querySelectorAll('.client-row');

      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        clientRows.forEach(row => {
          const nameCell = row.children[1].textContent.toLowerCase();
          if (nameCell.includes(searchTerm)) {
            row.style.display = ''; // Show row
          } else {
            row.style.display = 'none'; // Hide row
          }
        });
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
    });
  </script>
</x-app-layout>