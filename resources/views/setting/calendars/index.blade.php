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

    <!-- Modal for adding/updating events -->
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
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eventTitle" required>
                        </div>
                        <div class="mb-4">
                            <label for="eventStart" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eventStart" required>
                        </div>
                        <div class="mb-4">
                            <label for="eventEnd" class="block text-sm font-medium text-gray-700">End Time</label>
                            <input type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eventEnd" required>
                        </div>
                        <input type="hidden" name="user_id" id="eventUser" value="{{ auth()->user()->id }}" required>
                        <input type="hidden" name="client_id" id="eventClient" value="1" required>
                    </form>
                </div>
                <div class="mt-4">
                    <button type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="saveEventButton">Save Event</button>
                    <button type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" id="deleteEventButton">Delete Event</button>
                    <button type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-400 border border-transparent rounded-md shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400" id="closeModalButton">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let currentEvent = null;

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            events: {
                url: '/admin/schedules', // Fetch events from Laravel controller
                method: 'GET',
                failure: function() {
                    alert('there was an error while fetching events!');
                }
            },
            editable: true,

            dateClick: function(info) {
                $('#eventTitle').val('');
                $('#eventStart').val(info.dateStr);
                $('#eventEnd').val('');
                currentEvent = null;
                $('#eventModal').removeClass('hidden');
            },

            eventClick: function(info) {
                $('#eventModal').removeClass('hidden');
                $('#eventTitle').val(info.event.title);
                $('#eventStart').val(info.event.start.toISOString().slice(0, 16));
                $('#eventEnd').val(info.event.end ? info.event.end.toISOString().slice(0, 16) : '');
                $('#eventUser').val(info.event.extendedProps.user_id);
                $('#eventClient').val(info.event.extendedProps.client_id);
                currentEvent = info.event;
            },

            eventDrop: function(info) {
                updateEvent(info.event);
            },

            eventResize: function(info) {
                updateEvent(info.event);
            }
        });

        calendar.render();

        $('#saveEventButton').on('click', function() {
            var eventData = {
                title: $('#eventTitle').val(),
                start: $('#eventStart').val(),
                end: $('#eventEnd').val(),
                user_id: $('#eventUser').val(),
                client_id: $('#eventClient').val()
            };

            if (currentEvent) {
                $.ajax({
                    url: '/admin/schedules/' + currentEvent.id,
                    method: 'PUT',
                    data: eventData,
                    success: function(response) {
                        currentEvent.setProp('title', response.event.title);
                        currentEvent.setDates(response.event.start, response.event.end);
                        $('#eventModal').addClass('hidden');
                    },
                    error: function(xhr, status, error) {
                        alert('Error updating event: ' + error);
                    }
                });
            } else {
                if (new Date(eventData.start) > new Date(eventData.end)) {
                    console.error("The end date must be after the start date.");
                } else {
                    $.ajax({
                        url: '/admin/schedules',
                        method: 'POST',
                        data: eventData,
                        success: function(response) {
                            calendar.addEvent({
                                id: response.event.id,
                                title: response.event.title,
                                start: response.event.start,
                                end: response.event.end,
                                extendedProps: {
                                    user_id: response.event.user_id,
                                    client_id: response.event.client_id
                                }
                            });
                            $('#eventModal').addClass('hidden');
                        },
                        error: function(xhr, status, error) {
                            alert('Error creating event: ' + error);
                        }
                    });
                }
            }
        });

        $('#deleteEventButton').on('click', function() {
            if (currentEvent) {
                $.ajax({
                    url: '/admin/schedules/' + currentEvent.id,
                    method: 'DELETE',
                    success: function() {
                        currentEvent.remove(); // Remove the event from the calendar
                        $('#eventModal').addClass('hidden');
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting event: ' + error);
                    }
                });
            }
        });

        $('#closeModalButton').on('click', function() {
            $('#eventModal').addClass('hidden');
        });

        function updateEvent(event) {
            var eventData = {
                title: event.title,
                start: event.start.toISOString(),
                end: event.end ? event.end.toISOString() : null,
                user_id: event.extendedProps.user_id,
                client_id: event.extendedProps.client_id
            };

            $.ajax({
                url: '/admin/schedules/' + event.id,
                method: 'PUT',
                data: eventData,
                success: function(response) {
                    event.setProp('title', response.event.title);
                },
                error: function(xhr, status, error) {
                    alert('Error updating event: ' + error);
                }
            });
        }
    </script>
</x-app-layout>
