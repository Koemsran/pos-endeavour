<header class="flex justify-between items-center py-5 px-6 border-b-4 border-indigo-600" style="background-color: #006ca5;">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>

    <div class="flex items-center">
        <!-- Dropdown for user profile -->
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen"
                class="relative block h-10 w-10 rounded-full overflow-hidden shadow focus:outline-none">
                <img class="h-full w-full object-cover rounded-full border-2 border-white"
                    src="{{ auth()->check() && auth()->user()->profile ? asset('images/' . auth()->user()->profile) : asset('images/default-profile.jpg') }}"
                    alt="Your avatar">
            </button>

            <!-- Overlay to close dropdown when clicked outside -->
            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10" style="display: none;"></div>

            <!-- Dropdown menu -->
            <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10" style="display: none;">
                @if (auth()->check())
                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white flex items-center">
                    <i class='bx bx-user-circle text-xl mr-3'></i> Profile
                </a>

                <form method="POST" action="{{ route('admin.logout') }}" class="block">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white flex items-center">
                        <i class='bx bx-log-out mr-3 text-xl'></i> Logout
                    </button>
                </form>
                @else
                <a href="{{ url('/') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white flex items-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
                @endif
            </div>
        </div>
    </div>
</header>