<div class="container mx-auto px-6 py-5" x-data="{ selectedDay: 'today' }">
    <strong style="font-size: 30px">Dashboard</strong><br>
    <div class="inline-flex rounded-md shadow-sm ">
        <a href="#" @click.prevent="selectedDay = 'today'"
            :class="selectedDay === 'today' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'"
            class="px-4 py-2 text-sm font-medium rounded-l-lg border-t border-b border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            Today
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisWeek'"
            :class="selectedDay === 'thisWeek' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'"
            class="px-4 py-2 text-sm font-medium border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            This Week
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisMonth'"
            :class="selectedDay === 'thisMonth' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'"
            class="px-4 py-2 text-sm font-medium border border-gray-200  hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            This Month
        </a>
        <a href="#" @click.prevent="selectedDay = 'thisYear'"
            :class="selectedDay === 'thisYear' ? 'text-blue-700 bg-gray-100' : 'text-gray-900 bg-white'"
            class="px-4 py-2 text-sm font-medium border border-gray-200 rounded-r-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
            This Year
        </a>
    </div>
    <div class="group-card flex justify-center gap-4">

        <!--  data of today -->
        <template x-if="selectedDay === 'today'">
            <div class="w-full flex flex-wrap gap-2 mt-8">
                <div style="width: 24%;"
                    class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">5+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking</p>
                    </div>
                </div>
                <div style="width: 24%;"
                    class="flex gap-5 p-6 bg-green-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">5+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Client</p>
                    </div>
                </div>
                <div style="width: 24%;"
                    class="flex gap-5 p-6 bg-teal-200 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">5+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking</p>
                    </div>
                </div>
                <div style="width: 24%;"
                    class="flex gap-5 p-6 border bg-blue-200 border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{$todayUsers}}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total User</p>
                    </div>
                </div>
            </div>
        </template>

        <!--  data of thisWeek -->
        <template x-if="selectedDay === 'thisWeek'">
            <div class="w-full flex flex-wrap gap-2 mt-8">
                <div style="width: 24%;"
                    class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">10+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking</p>
                    </div>
                </div>
            </div>
        </template>

        <!--  data of thisMonth -->
        <template x-if="selectedDay === 'thisMonth'">
            <div class="w-full flex flex-wrap gap-2 mt-8">
                <div style="width: 24%;"
                    class="flex gap-5 p-6 bg-yellow-100 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-calendar-check text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">20+</strong>
                        <p class="mb-3 font-normal text-black-500">Total Booking</p>
                    </div>
                </div>
                <div style="width: 24%;"
                    class="flex gap-5 p-6 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ array_sum($monthlyData['users']) }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total User</p>
                    </div>
                </div>
            </div>
        </template>

        <!--  data of Years -->
        <template x-if="selectedDay === 'thisYear'">
            <div class="w-full flex flex-wrap gap-2 mt-8">
                <div style="width: 24%;"
                    class="flex gap-5 p-6 border border-gray-200 rounded-lg shadow transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105 hover:bg-blue-900 hover:text-white">
                    <i class='bx bx-user text-3xl'></i>
                    <div class="content">
                        <strong style="font-size: 25px">{{ $yearlyData['users'] }}+</strong>
                        <p class="mb-3 font-normal text-black-500">Total User</p>
                    </div>
                </div>
            </div>
        </template>

    </div>
</div>