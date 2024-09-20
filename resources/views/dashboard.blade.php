<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            @include('card.card-data')
            <div class="group-chart flex gap-5 justify-center px-5 mx-2">
                @include('chart.price')
                @include('chart.product')
            </div>
            <div class="group-chart flex gap-5 justify-center px-5 mx-2">
                @include('chart.booking-field')
                @include('chart.users')
            </div>
        </main>
    </div>
</x-app-layout>
