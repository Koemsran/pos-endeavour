<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form id="edite-role-form" method="POST" action="{{ route('admin.roles.update',$role->id)}}">
                  @csrf
                  @method('put')
                <div class="flex flex-col space-y-2">
                  <label for="role_name" class="text-gray-700 select-none font-medium">Role Name</label>
                  <input
                    id="role_name"
                    type="text"
                    name="name"
                    value="{{ old('name',$role->name) }}"
                    placeholder="Placeholder"
                    class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                  />
                </div>

                <h3 class="text-xl my-4 text-gray-600">Permissions</h3>
                <div class="grid grid-cols-3 gap-4">
                  @foreach($permissions as $permission)
                      <div class="flex flex-col justify-cente">
                          <div class="flex flex-col">
                              <label class="inline-flex items-center mt-3">
                                  <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="permissions[]" value="{{$permission->id}}"  @if(count($role->permissions->where('id',$permission->id)))
                                      checked 
                                    @endif
                                  ><span class="ml-2 text-gray-700">{{ $permission->name }}</span>
                              </label>
                          </div>
                      </div>
                  @endforeach
                </div>
                <div class="text-center mt-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Update</button>
                </div>
              </div>

             
            </div>
        </main>
    </div>
    <script>
      // Add event listener to the form
      document.getElementById('edite-role-form').addEventListener('submit', function(event) {
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
            width: '800px', // Set width for the alert
          },
          iconColor: '#a5dc86', // Green background for success
        });
  
        Toast.fire({
          icon: 'success',
          title: 'Role update successfully!',
        }).then(() => {
          this.submit(); // Submit the form programmatically after the alert
        });
      });
    </script>
  
    <style>
      .colored-toast.swal2-icon-success {
        background-color: #58cd15 !important;
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
