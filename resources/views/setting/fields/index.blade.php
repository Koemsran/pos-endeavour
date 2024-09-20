<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Fields
      </h2>
  </x-slot>
  <div class="container mt-4">
    @if(session())
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3">
      <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
      <path
        d="M14.354 5.646a.5.5 0 0 0-.708 0L10 9.293 6.354 5.646a.5.5 0 0 0-.708.708L9.293 10l-3.647 3.646a.5.5 0 0 0 .708.708L10 10.707l3.646 3.647a.5.5 0 0 0 .708-.708L10.707 10l3.647-3.646a.5.5 0 0 0 0-.708z" />
      </svg>
    </button>
  @endif

    <a id="openAddModal"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-3 ml-2 rounded inline-block">Add
      Field</a>

    <div class="overflow-x-auto">
      <table class="min-w-full w-full bg-white shadow-md border border-gray-200">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Location</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Image</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Price</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">field_type
            </th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Province</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($fields as $index => $field)
        <tr>
        <td class="px-4 py-4 whitespace-nowrap">{{ $index+1 }}</td>
        <td class="px-4 py-4 whitespace-nowrap">{{ $field->name }}</td>
        <td class="px-4 py-4 whitespace-nowrap">{{ $field->location }}</td>
        <td class="px-6 py-4 whitespace-nowrap">
          <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->name }}"
          class="h-16 w-16 object-cover rounded">
        </td>
        <td class="px-4 py-4 whitespace-nowrap">${{ $field->price }}.00</td>
        <td class="px-4 py-4 whitespace-nowrap">{{ $field->field_type }}</td>
        <td class="px-4 py-4 whitespace-nowrap">{{ $field->province}}</td><td class="px-4 py-4 whitespace-nowrap">
          <a href="{{ route('admin.fields.edit', $field->id) }}"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-block">
          <i class='bx bx-edit text-sm'></i>
          </a>
          <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" class="inline-block">
          @csrf
          @method('DELETE')
          <button type="submit" onclick="deleteField('{{ $field->id }}')"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded inline-block"> <i
            class='bx bx-trash text-sm'></i></button>
          </form>
        </td>
        </tr>
      @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- Add failed Modal -->
  <div id="addModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50 overflow-y-auto">
    <div class="p-4 w-full max-w-xl max-h-full ">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow ">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
            Add New Field
          </h3>
          <button id="closeAddModal" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="container mx-auto px-4 ">
          <form action="{{ route('admin.fields.store') }}" method="POST" enctype="multipart/form-data"
            class="mt-4 bg-white px-6 rounded-lg shadow-lg max-w-2xl mx-auto">
            @csrf
            <div class="flex flex-col ">
              <div class="flex flex-col space-y-3">
                <label for="image" class="text-gray-700 select-none font-medium">Image</label>
                <input type="file" id="image" name="image"
                  class="px-4 py-1 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
              </div>

              <div class="flex flex-col space-y-3">
                <label for="name" class="text-gray-700 select-none font-medium">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                  class="px-4 py-1 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
              </div>

              <div class="flex flex-col space-y-3">
                <label for="location" class="text-gray-700 select-none font-medium">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}"
                  class="px-4 py-1 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
              </div>

              <div class="flex flex-col space-y-3">
                <label for="price" class="text-gray-700 select-none font-medium">Price</label>
                <input type="text" id="price" name="price" value="{{ old('price') }}"
                  class="px-4 py-1 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
              </div>

              <div class="flex flex-col space-y-3">
                <label for="field_type" class="text-gray-700 select-none font-medium">Field Type</label>
                <input type="text" id="field_type" name="field_type" value="{{ old('field_type') }}"
                  class="px-4 py-1 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
              </div>

              <div class="flex flex-col space-y-3">
                <label class="text-gray-700 select-none font-medium">Select province</label>
                <select name="province" id="province"
                  class="px-4 py-1 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                  <option value=""></option>
                </select>
              </div>
              <button type="submit"
                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3 mb-3">
                Submit
              </button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <script>
      //========= create fields ================
      document.getElementById('openAddModal').addEventListener('click', function () {
        document.getElementById('addModal').classList.remove('hidden');
      });

      document.getElementById('closeAddModal').addEventListener('click', function () {
        document.getElementById('addModal').classList.add('hidden');
      });
      //============select province ================
      document.addEventListener('DOMContentLoaded', function () {
        const provinces = [
          'Banteay Meanchey',
          'Battambang',
          'Kampong Cham',
          'Kampong Chhnang',
          'Kampong Speu',
          'Kampong Thom',
          'Kampot',
          'Kandal',
          'Koh Kong',
          'Kratie',
          'Mondulkiri',
          'Phnom Penh',
          'Preah Vihear',
          'Prey Veng',
          'Pursat',
          'Ratanakiri',
          'Siem Reap',
          'Preah Sihanouk',
          'Stung Treng',
          'Svay Rieng',
          'Takeo',
          'Oddar Meanchey',
          'Kep',
          'Pailin',
          'Tbong Khmum'
        ];

        const provinceSelect = document.getElementById('province');

        provinces.forEach(province => {
          const option = document.createElement('option');
          option.value = province;
          option.textContent = province;
          provinceSelect.appendChild(option);
        });
      });
      //========= delete fields ================
      function deleteField(fieldId) {
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
                  document.getElementById('delete-field-' + fieldId).submit();
              }
          });
      }
      // Add event listener to the form
      document.getElementById('create-field-form').addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the form from submitting normally
    
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            customClass: {
              icon: 'colored-toast',
              popup: 'colored-toast',
              title: 'colored-toast',
            },
            iconColor: '#a5dc86', // Green background for success
          });
    
          Toast.fire({
            icon: 'success',
            title: 'Field created successfully!',
          }).then(() => {
            this.submit(); // Submit the form programmatically after the alert
          });
        });
      
    </script>
    <style>
      .colored-toast.swal2-icon-success {
        background-color: #58cf13 !important;
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
</x-app-layout>
