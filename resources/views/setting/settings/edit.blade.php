<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Other content of your edit page -->

        @if(session('password_change_modal'))
        <!-- Modal HTML -->
        <div id="defaultModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold mb-4">Change Password</h2>
                    <form method="POST" action="{{ route('admin.profile.updatePassword') }}">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-4">
                            <div>
                                <label for="new_password" class="text-gray-700 select-none font-medium">New Password</label>
                                <div class="relative">
                                    <input id="new_password" type="password" name="new_password" placeholder="Enter new password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full pr-10">
                                    <i id="newPasswordEyeIcon" class='bx bx-low-vision text-gray-500 absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer'></i>
                                </div>
                            </div>
                            <div>
                                <label for="new_password_confirmation" class="text-gray-700 select-none font-medium">Confirm New Password</label>
                                <div class="relative">
                                    <input id="new_password_confirmation" type="password" name="new_password_confirmation" placeholder="Confirm new password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 w-full pr-10">
                                    <i id="confirmPasswordEyeIcon" class='bx bx-low-vision text-gray-500 absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer'></i>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-6">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-blue-600 transition-colors">Update Password</button>
                            <button type="button" id="closeModal" class="bg-gray-500 text-white font-bold px-5 py-2 rounded-lg shadow hover:bg-gray-600 transition-colors ml-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <!-- Other content of your edit page -->

    </div>
</x-app-layout>

<!-- Include Alpine.js for modal functionality -->
<script src="//unpkg.com/alpinejs" defer></script>
<script>
    document.getElementById('closeModal').addEventListener('click', function() {
        // Optionally clear the session if needed via an Ajax request
        window.location.href = "{{ route('admin.settings.index') }}";
    });

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

    // Initialize the toggle for new password and confirm password
    togglePasswordVisibility('new_password', 'newPasswordEyeIcon');
    togglePasswordVisibility('new_password_confirmation', 'confirmPasswordEyeIcon');
</script>