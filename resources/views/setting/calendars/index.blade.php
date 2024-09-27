<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-5">
        <div class="container mx-auto px-6 py-2">
            <div class="bg-white shadow-md rounded my-6 p-5">
                <form action="" method="GET" class="flex items-center mb-4 w-full" id="search-form">
                    <input type="date" name="search" placeholder="Search event by date..."
                        class="px-4 py-2 border rounded-l-lg focus:outline-none focus:border-blue-500"
                        id="search-input" style="width: auto; max-width: 20%; flex: 1;">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">
                        Search
                    </button>
                </form>
                <div id="calendar" style="width: 100%;"></div>
            </div>
        </div>
    </main>
    <!-- Modal for adding events -->
    <div id="eventModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="inline-block h-screen align-middle" aria-hidden="true">&#8203;</span>
            <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Add Event</h3>
                <div class="mt-2">
                    <form id="eventForm">
                        <div class="mb-4">
                            <label for="eventTitle" class="block text-sm font-medium text-gray-700">Event Title</label>
                            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="eventTitle" required>
                        </div>
                        <div class="mb-4">
                            <label for="eventStart" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="datetime-local" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="eventStart" required>
                        </div>
                        <div class="mb-4">
                            <label for="eventEnd" class="block text-sm font-medium text-gray-700">End Time</label>
                            <input type="datetime-local" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="eventEnd" required>
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                    <button type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="saveEventButton">Save Event</button>
                    <button type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" id="closeModalButton">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        var calendarEl = document.getElementById('calendar');
        var events = []; // Your static or dynamic events array

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            timeZone: 'UTC',
            events: events,
            editable: true,
            eventDidMount: function(info) {
                info.el.style.backgroundColor = info.event.extendedProps.backgroundColor;
                info.el.style.borderColor = info.event.extendedProps.borderColor;
                info.el.style.color = info.event.extendedProps.textColor;
            },
            dateClick: function(info) {
                // Show modal when a date is clicked
                $('#eventModal').removeClass('hidden');
                $('#eventStart').val(info.dateStr);
                let endDate = new Date(info.dateStr);
                endDate.setHours(endDate.getHours() + 1);
                $('#eventEnd').val(endDate.toISOString().slice(0, 16));
            }
        });

        // Save event on button click
        $('#saveEventButton').on('click', function() {
            var title = $('#eventTitle').val();
            var start = $('#eventStart').val();
            var end = $('#eventEnd').val();

            // Add new event to the calendar
            calendar.addEvent({
                title: title,
                start: start,
                end: end,
                backgroundColor: '#3a87ad', // Example background color
                borderColor: '#3a87ad', // Example border color
                textColor: '#ffffff' // Example text color
            });

            // Hide modal
            $('#eventModal').addClass('hidden');

            // Reset the form
            $('#eventForm')[0].reset();
        });

        // Close modal on cancel button click
        $('#closeModalButton').on('click', function() {
            $('#eventModal').addClass('hidden');
            $('#eventForm')[0].reset();
        });

        calendar.render();
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</x-app-layout>