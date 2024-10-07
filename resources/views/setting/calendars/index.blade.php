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
                            <input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eventTitle" required>
                        </div>
                        <div class="mb-4">
                            <label for="eventDate" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eventDate" required>
                        </div>
                        <div class="mb-4">
                            <label for="eventStart" class="block text-sm font-medium text-gray-700">Start Time</label>
                            <input type="time" name="start" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eventStart" required>
                        </div>
                        <div class="mb-4">
                            <label for="eventEnd" class="block text-sm font-medium text-gray-700">End Time</label>
                            <input type="time" name="end" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eventEnd" required>
                        </div>
                        <input type="hidden" name="user_id" id="eventUser" value="{{ auth()->user()->id }}" required>
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        let currentEvent = null;

        // Initialize the calendar
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridWeek',

            // Fetch events from Laravel endpoint
            events: @json($events), // Correctly use the JSON data

            editable: true,

            // When a date is clicked, show the modal to add a new event
            dateClick: function(info) {
                document.getElementById('eventTitle').value = '';
                document.getElementById('eventDate').value = info.date.toISOString().split('T')[0]; // Set date based on click
                document.getElementById('eventStart').value = ''; // Clear the time input
                document.getElementById('eventEnd').value = '';
                currentEvent = null;
                document.getElementById('eventModal').classList.remove('hidden');
            },

            eventClick: function(info) {
                document.getElementById('eventModal').classList.remove('hidden');

                // Set the event title
                document.getElementById('eventTitle').value = info.event.title;

                // Set the event date (using ISO format)
                document.getElementById('eventDate').value = info.event.start.toISOString().split('T')[0];

                // Set the start time in HH:mm format
                document.getElementById('eventStart').value = info.event.start.toTimeString().slice(0, 5);

                // Set the end time in HH:mm format (check if end is defined)
                if (info.event.end) {
                    document.getElementById('eventEnd').value = info.event.end.toTimeString().slice(0, 5);
                } else {
                    document.getElementById('eventEnd').value = '';
                }

                currentEvent = info.event;
            },

            // Update the event when it is dragged or resized
            eventDrop: function(info) {
                updateEvent(info.event);
            },

            eventResize: function(info) {
                updateEvent(info.event);
            }
        });

        calendar.render();

        // Create or Update Event
        document.getElementById('saveEventButton').addEventListener('click', function() {
            // Helper function to format time as HH:mm
            function formatTime(inputTime) {
                const timeParts = inputTime.split(':');
                if (timeParts.length === 2) {
                    const hours = String(timeParts[0]).padStart(2, '0'); // Ensure 2-digit hour
                    const minutes = String(timeParts[1]).padStart(2, '0'); // Ensure 2-digit minutes
                    return `${hours}:${minutes}`; // Return formatted time
                }
                return inputTime; // Return original if not in expected format
            }

            // Create eventData with formatted start and end times
            var eventData = {
                title: document.getElementById('eventTitle').value.trim(), // Trim whitespace from the title
                date: document.getElementById('eventDate').value, // Event date in YYYY-MM-DD format
                start: formatTime(document.getElementById('eventStart').value), // Format start time
                end: formatTime(document.getElementById('eventEnd').value), // Format end time
                user_id: document.getElementById('eventUser').value.trim() // Trim whitespace from the user ID
            };

            // Validate input
            if (!eventData.title || !eventData.start || !eventData.end) {
                alert('Please fill in the title, date, and time.');
                return;
            }

            if (currentEvent) {
                // Prepare event data for update
                const eventData = {
                    title: document.getElementById('eventTitle').value,
                    date: document.getElementById('eventDate').value, // Assuming date is selected separately
                    start: document.getElementById('eventStart').value, // Assuming time is selected separately
                    end: document.getElementById('eventEnd').value, // Assuming time is selected separately
                    user_id: document.getElementById('eventUserId')
                };

                // Update existing event
                axios.put(`/admin/schedules/${currentEvent.id}`, eventData)
                    .then(response => {
                        const updatedEvent = response.data.event;

                        // Combine the date with the start and end times
                        const updatedStart = new Date(`${updatedEvent.date}T${updatedEvent.start}`);
                        const updatedEnd = new Date(`${updatedEvent.date}T${updatedEvent.end}`);

                        // Update the event in FullCalendar
                        currentEvent.setProp('title', updatedEvent.title);
                        currentEvent.setStart(updatedStart);
                        currentEvent.setEnd(updatedEnd);
                    })
                    .catch(error => {
                        console.error('Error updating event:', error);
                    });
            } else {
                // Create new event
                axios.post('/admin/schedules', eventData)
                    .then(response => {
                        const newEvent = response.data.event;

                        // Combine the date with the start and end times
                        const newStart = new Date(`${newEvent.date}T${newEvent.start}`);
                        const newEnd = new Date(`${newEvent.date}T${newEvent.end}`);

                        // Add the new event to FullCalendar
                        calendar.addEvent({
                            id: newEvent.id,
                            title: newEvent.title,
                            start: newStart,
                            end: newEnd,
                            allDay: false // Set to true if the event is all-day
                        });
                    })
                    .catch(error => {
                        console.error('Error creating event:', error);
                        alert('Failed to create the event. Please try again.');
                    });
            }

            // Close the modal
            document.getElementById('eventModal').classList.add('hidden');
        });

        // Close modal
        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('eventModal').classList.add('hidden');
        });

        // Delete Event
        document.getElementById('deleteEventButton').addEventListener('click', function() {

            if (currentEvent) {
                if (confirm('Are you sure you want to delete this event?')) {
                    axios.delete(`/admin/schedules/${currentEvent.id}`, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(() => {
                            currentEvent.remove(); // Remove the event from FullCalendar
                            alert('Event deleted successfully.');
                        })
                        .catch(error => {
                            console.error('Error deleting event:', error);
                            currentEvent.remove();
                        });
                }
            } else {
                alert('No event selected to delete.');
            }
            document.getElementById('eventModal').classList.add('hidden');
        });

        function updateEvent(event) {
            // Define event data for update
            const eventData = {
                title: event.title,
                start: event.start.toISOString(),
                end: event.end ? event.end.toISOString() : null // Handle potential null end
            };

            axios.put(`/admin/schedules/${event.id}`, eventData)
                .then(() => {
                    alert('Event updated successfully.');
                })
                .catch(error => {
                    console.error('Error updating event:', error);
                    alert('Failed to update the event. Please try again.');
                });
        }
    </script>
</x-app-layout>