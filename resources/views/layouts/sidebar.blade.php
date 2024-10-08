<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="pb-5 fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8 mb-5">
        <img width="150" height="150" src="/images/logo1.png" alt="Logo">

    </div><hr>
    <nav class="mt-10">
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }} "
            href="{{ route('admin.dashboard')}}">
            <i class='bx bxs-dashboard text-2xl'></i>
            <span class="mx-3">Dashboard</span>
        </a>
        @canany('User access','User add','User edit','User delete')
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.users.index') ? 'active' : '' }}"
            href="{{ route('admin.users.index')}}">
            <i class='bx bx-user text-2xl'></i>
            <span class="mx-3">Users</span>
        </a>
        @endcanany
        @canany('Client access','Client add','Client create', 'Client edit','Client delete')
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.clients.index') ? 'active' : '' }}"
            href="{{ route('admin.clients.index')}}">
            <i class='bx bx-user-plus text-3xl' ></i>
            <span class="mx-3">Clients</span>
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
            <i class='bx bx-store-alt text-2xl'></i>
            <span class="mx-3">Products</span>
        </a>
        @endcanany
        @canany(['Product access','Product add','Product edit','Product delete'])
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.schedules.index') ? 'active' : '' }}"
            href="{{route('admin.schedules.index')}}">
            <i class='bx bx-calendar text-2xl' ></i>
            <span class="mx-3">Schedule</span>
        </a>
        @endcanany

        @canany('Role access','Role add','Role edit','Role delete')
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.roles.index') ? 'active' : '' }}"
            href="{{ route('admin.roles.index') }}">
            <i class='bx bx-shape-circle ' style="font-size: 27px;"></i>
            <span class="mx-3">Role</span>
        </a>
        @endcanany
        @canany('Permission access','Permission add','Permission edit','Permission delete')
        <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ Route::currentRouteNamed('admin.permissions.index') ? 'active' : '' }}"
            href="{{ route('admin.permissions.index') }}">
            <i class='bx bx-lock-open-alt' style="font-size: 25px;"></i>
            <span class="mx-3">Permission</span>
        </a>
        @endcanany
    </nav>
</div>
<style>
    .active {
        background: rgb(230, 226, 226);
        border-radius: 0 10px 10px 0;
    }
</style>