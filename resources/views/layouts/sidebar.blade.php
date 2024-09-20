<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="pb-5 fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <svg class="h-12 w-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                    fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                    d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                    fill="white"></path>
            </svg>

            <a href="{{ route('admin.dashboard') }}">
                <span class="text-white text-2xl mx-2 font-semibold">SVAHAB</span>
            </a>
        </div>
    </div>
    <nav class="mt-10">
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }} "
            href="{{ route('admin.dashboard')}}">
            <i class='bx bxs-dashboard text-2xl'></i>
            <span class="mx-3">Dashboard</span>
        </a>

        {{-- @canany('User access','User add','User edit','User delete') --}}
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('chatify') ? 'active' : '' }}"
            href="{{ route('chatify')}}">
            <i class='bx bxs-message-rounded-dots text-2xl'></i>
            <span class="mx-3">Chat</span>
        </a>
        {{-- @endcanany --}}

        @canany('User access','User add','User edit','User delete')
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.users.index') ? 'active' : '' }}"
            href="{{ route('admin.users.index')}}">
            <i class='bx bx-user text-2xl'></i>
            <span class="mx-3">User</span>
        </a>
        @endcanany

        @canany(['Booking access','Booking add','Booking edit','Booking delete'])
        <a 
            class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.bookings.index') ? 'active' : '' }}"
            href="{{ route('admin.bookings.index') }}">
            <i class='bx bx-calendar-check text-2xl'></i>
            <span class="mx-3">Booking</span>
        </a>
        @endcanany
        @canany(['Field access','Field add','Field edit','Field delete'])
        <a
            class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.fields.index') ? 'active' : '' }}"
            href="{{ route('admin.fields.index') }}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6H3V5a2 2 0 012-2h14a2 2 0 012 2v1h-1M4 6h16m0 0v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6m16 0H4">
                </path>
            </svg>
            <span class="mx-3">Fields</span>
        </a>
        @endcanany
         @canany(['Category access','Category add','Category edit','Category delete'])
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.categories.index') ? 'active' : '' }}"
            href="{{route('admin.categories.index')}}">
            <i class='bx bx-category text-2xl'></i>
            <span class="mx-3">Categories</span>
            </a>
       @endcanany
         @canany(['Product access','Product add','Product edit','Product delete'])
         <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.products.index') ? 'active' : '' }}"
         href="{{route('admin.products.index')}}">
         <i class='bx bxl-product-hunt text-2xl'></i>
         <span class="mx-3">Products</span>
        </a>
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.orders.index') ? 'active' : '' }}"
            href="{{ route('admin.orders.index') }}">
            <i class='bx bx-cart-add text-2xl'></i>
            <span class="mx-3">Orders</span>
        </a>
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.discounts.index') ? 'active' : '' }}"
            href="{{ route('admin.discounts.index') }}">
            <i class='bx bxs-discount text-2xl' ></i>
            <span class="mx-3">Discounts</span>
        </a>
     @endcanany
        @canany(['Payment access','Payment add','Payment edit','Payment delete'])
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.payments.index') ? 'active' : '' }}"
            href="{{route('admin.payments.index')}}">
            <i class='bx bxl-paypal text-3xl'></i>
            <span class="mx-3">Payment</span>
        </a>
        @endcanany
        @canany(['Feedback access','Feedback add','Feedback edit','Feedback delete'])
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.feedbacks.index') ? 'active' : '' }}"
            href="{{route('admin.feedbacks.index')}}">
            <i class='bx bx-comment-detail text-2xl' ></i>
            <span class="mx-3">Feedback</span>
        </a>
        @endcanany
        
        @canany('Role access','Role add','Role edit','Role delete')
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.roles.index') ? 'active' : '' }}"
            href="{{ route('admin.roles.index') }}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                </path>
            </svg>
            <span class="mx-3">Role</span>
        </a>
        @endcanany
        @canany('Permission access','Permission add','Permission edit','Permission delete')
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.permissions.index') ? 'active' : '' }}"
            href="{{ route('admin.permissions.index') }}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                </path>
            </svg>

            <span class="mx-3">Permission</span>
        </a>
        @endcanany
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.slideshows.index') ? 'active' : '' }}"
            href="{{route('admin.slideshow.index')}}">
            <i class='bx bx-slideshow text-2xl'></i>
            <span class="mx-3">Slideshow</span>
        </a>
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.settings.index') ? 'active' : '' }}"
            href="{{route('admin.settings.index')}}">
            <i class='bx bx-cog text-2xl'></i>
            <span class="mx-3">Settings</span>
        </a>


    </nav>
</div>
<style>
    .active{
        background: rgb(230, 226, 226);
        border-radius: 0 10px 10px 0;
    }
</style>