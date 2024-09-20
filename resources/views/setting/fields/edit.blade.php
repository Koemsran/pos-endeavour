<x-app-layout>
    <div class="container mt-4">
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="edit-field-form" action="{{ route('admin.fields.update', $field->id) }}" method="POST" enctype="multipart/form-data" class="mt-4 bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
            @csrf
            @method('PUT')
            <div class="flex flex-col space-y-4">
                <div class="flex flex-col space-y-2">
                    <label for="image" class="text-gray-700 select-none font-medium">Image</label>
                    <input type="file" id="image" name="image" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    @if ($field->image)
                    <img src="{{ asset('storage/' . $field->image) }}" alt="Field Image" class="mt-2 h-32">
                    @endif
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="name" class="text-gray-700 select-none font-medium">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $field->name) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="location" class="text-gray-700 select-none font-medium">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $field->location) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="price" class="text-gray-700 select-none font-medium">Price</label>
                    <input type="text" id="price" name="price" value="{{ old('price', $field->price) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label for="field_type" class="text-gray-700 select-none font-medium">Field Type</label>
                    <input type="text" id="field_type" name="field_type" value="{{ old('field_type', $field->field_type) }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <label class="text-gray-700 select-none font-medium">Select province</label>
                    <select name="province" id="province"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <option value="{{ old('province', $field->province) }}" selected>{{ old('province', $field->province) }}</option>
                    </select>
                </div>
                <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
        </form>
    </div>
    <script>
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

        // Add event listener to the form
        document.getElementById('edit-field-form').addEventListener('submit', function(event) {
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
            title: 'Field updated successfully!',
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
    </script>
</x-app-layout>