<x-app-layout>
    <div class="mt-5">
        <div class="flex flex-wrap">
            <div class="w-full xl:w-8/12 xl:mb-0 px-4">
                @include('chart.price')
            </div>
            <div class="w-full xl:w-4/12 px-4">
                @include('chart.product')
            </div>
        </div>
        <div class="flex flex-wrap mt-4">
            <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
                @include('chart.booking-field')
            </div>
            <div class="w-full xl:w-4/12 px-4">
                @include('chart.users')
            </div>
        </div>
    </div>
</x-app-layout>