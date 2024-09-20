<x-app-layout>
    <div class="container mx-auto p-6">

        <head>
            <!-- Tailwind CSS -->
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>

        <!-- Flash Messages -->
        @if (session('status'))
        <div id="statusMessage" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('status') }}
        </div>
        @elseif ($errors->any())
        <div id="errorMessages" class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="main-body">
            <div class="flex flex-wrap -mx-4">
                <!-- User Info Card -->
                <div class="w-full md:w-1/3 px-4 mb-4">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="flex flex-col items-center text-center">
                            <img src="{{ $user->profile ? asset('images/' . $user->profile) : 'https://bootdey.com/img/Content/avatar/avatar6.png' }}" alt="User Avatar" class="rounded-full p-2 bg-primary w-28 h-28">
                            <div class="mt-4">
                                <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                                <p class="text-gray-600 mb-1">Full Stack Developer</p>
                                <p class="text-gray-500 text-sm">Bay Area, San Francisco, CA</p>
                                <div class="mt-3">
                                    <button class="bg-blue-500 text-white font-bold px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition-colors">Follow</button>
                                    <button class="bg-white text-blue-500 border border-blue-500 font-bold px-4 py-2 rounded-lg shadow hover:bg-blue-100 transition-colors ml-2">Message</button>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-none p-0">
                            <!-- Social Media Links or Other Details -->
                        </ul>
                    </div>
                </div>
                <!-- User Profile Form -->
                <div class="w-full md:w-2/3 px-4 mb-4">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <form method="POST" action="{{ route('admin.profile.checkPassword') }}">
                                @csrf
                                @method('put')
                                <!-- Personal Information -->
                                <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                                <div class="flex flex-col space-y-4">
                                    <div>
                                        <label for="name" class="text-gray-700 select-none font-medium">Username</label>
                                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full">
                                    </div>
                                    <div>
                                        <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                                        <input id="email" type="text" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full">
                                    </div>
                                </div>
                                <hr class="my-6">
                                <!-- Account Settings -->
                                <h2 class="text-xl font-semibold mb-4">Account Settings</h2>
                                <div class="flex flex-col space-y-4">
                                    <div>
                                        <label for="phone_number" class="text-gray-700 select-none font-medium">Phone Number</label>
                                        <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Enter new phone number" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full">
                                    </div>
                                </div>
                                <hr class="my-6">
                                <!-- Change Password -->
                                <h2 class="text-xl font-semibold mb-4">Change Password</h2>
                                <div class="flex flex-col space-y-4">
                                    <div>
                                        <label for="old_password" class="text-gray-700 select-none font-medium">Old Password</label>
                                        <div class="relative">
                                            <input id="old_password" type="password" name="old_password" required placeholder="Enter old password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full pr-10">
                                            <i id="eyeIcon" class='bx bx-low-vision text-gray-500 absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer'></i>
                                        </div>
                                        @if(Cache::get('failed'))
                                        <div id="errorAlert" class="alert alert-danger text-red-500" role="alert">
                                            {{ Cache::get('failed') }}
                                            @php
                                            // Clear the cache message after displaying it
                                            Cache::forget('failed');
                                            @endphp
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center mt-6">
                                    <button type="submit" class="bg-red-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-red-600 transition-colors">Update Password</button>
                                </div>
                            </form>
                            <hr class="my-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Function to toggle password visibility
        const togglePasswordVisibility = (inputId, iconId) => {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            icon.addEventListener('click', () => {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bx-low-vision');
                    icon.classList.add('bx-show');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bx-show');
                    icon.classList.add('bx-low-vision');
                }
            });
        };

        // Initialize the toggle for old password
        togglePasswordVisibility('old_password', 'eyeIcon');

        // Initialize the toggle for new password and confirm password in the modal
        togglePasswordVisibility('new_password', 'newPasswordEyeIcon');
        togglePasswordVisibility('new_password_confirmation', 'confirmPasswordEyeIcon');

        // Function to hide the error alert after 5 seconds
        const hideErrorAlert = () => {
            const errorAlert = document.getElementById('errorAlert');
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 5000);
            }
        };

        // Call the function to start the timer
        hideErrorAlert();

        // Modal toggle logic
        const toggleModalButton = document.getElementById('toggleModal');
        const modal = document.getElementById('defaultModal');
        const closeModalButton = document.querySelector('#defaultModal button[aria-label="Close"]');

        const toggleModal = () => {
            modal.classList.toggle('hidden');
        };

        if (toggleModalButton) {
            toggleModalButton.addEventListener('click', toggleModal);
        }
        if (closeModalButton) {
            closeModalButton.addEventListener('click', toggleModal);
        }
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>