<div class="container mx-auto px-6 py-5" x-data="{ selectedDay: 'all' }">
    <strong style="font-size: 30px">Dashboard</strong><br>
    <div class="inline-flex rounded-lg shadow-sm overflow-hidden border border-gray-200">
        <a href="#" @click.prevent="selectedDay = 'all'" 
            :class="selectedDay === 'all' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" 
            class="px-4 py-2 text-sm font-medium hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 transition-colors">
            All
        </a>
        <a href="#" @click.prevent="selectedDay = 'today'" 
            :class="selectedDay === 'today' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" 
            class="px-4 py-2 text-sm font-medium border-l border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 transition-colors">
            Today
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisWeek'" 
            :class="selectedDay === 'thisWeek' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" 
            class="px-4 py-2 text-sm font-medium border-l border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 transition-colors">
            This Week
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisMonth'" 
            :class="selectedDay === 'thisMonth' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" 
            class="px-4 py-2 text-sm font-medium border-l border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 transition-colors">
            This Month
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisYear'" 
            :class="selectedDay === 'thisYear' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'" 
            class="px-4 py-2 text-sm font-medium border-l border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 transition-colors">
            This Year
        </a>
    </div>

    <div class="group-card flex justify-center gap-4 mt-8">
        <!-- Data for "All" -->
        <template x-if="selectedDay === 'all'">
            <div class="w-full flex flex-wrap gap-2">
                <div class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-money text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ number_format($allPaid, 2) }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Paid</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-green-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-group text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $allClients }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Clients</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-teal-200 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ $allBookings }}.00</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking Amount</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 border bg-blue-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $allUsers }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Users</p>
                    </div>
                </div>
            </div>
        </template>

        <!-- Data for Today -->
        <template x-if="selectedDay === 'today'">
            <div class="w-full flex flex-wrap gap-2">
                <div class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-money text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ number_format($todayPaid, 2) }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Paid</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-green-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-group text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $todayClients }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Clients</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-teal-200 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ $todayBookings }}.00</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking Amount</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 border bg-blue-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $todayUsers }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Users</p>
                    </div>
                </div>
            </div>
        </template>

        <!-- Data for This Week -->
        <template x-if="selectedDay === 'thisWeek'">
            <div class="w-full flex flex-wrap gap-2">
                <div class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-money text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ number_format($weeklyPaid, 2) }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Paid</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-green-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-group text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $totalClientsThisWeek }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Clients</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-teal-200 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ $totalBookingsThisWeek }}.00</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking Amount</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 border bg-blue-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $totalUsersThisWeek }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Users</p>
                    </div>
                </div>
            </div>
        </template>

        <!-- Data for This Month -->
        <template x-if="selectedDay === 'thisMonth'">
            <div class="w-full flex flex-wrap gap-2">
                <div class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-money text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ number_format($monthlyPaid, 2) }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Paid</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-green-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-group text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $totalClientsThisMonth }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Clients</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-teal-200 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ $totalBookingsThisMonth }}.00</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking Amount</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 border bg-blue-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $totalUsersThisMonth }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Users</p>
                    </div>
                </div>
            </div>
        </template>

        <!-- Data for This Year -->
        <template x-if="selectedDay === 'thisYear'">
            <div class="w-full flex flex-wrap gap-2">
                <div class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-money text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ number_format($yearlyPaid, 2) }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Paid</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-green-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-group text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $totalClientsThisYear }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Clients</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 bg-teal-200 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">${{ $totalBookingsThisYear }}.00</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking Amount</p>
                    </div>
                </div>

                <div class="flex gap-5 p-6 border bg-blue-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white flex-grow w-auto">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $totalUsersThisYear }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Users</p>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
