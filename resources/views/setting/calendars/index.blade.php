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
            timeZone: 'local', // Ensure correct timezone handling

            // Fetch events from Laravel endpoint
            events: @json($events),

            editable: true,

            // When a date or time is clicked, show the modal to add a new event
            dateClick: function(info) {
                const clickedDate = info.date; // Get the clicked date
                document.getElementById('eventTitle').value = '';
                document.getElementById('eventDate').value = clickedDate.toISOString().split('T')[0]; // Set the date
                document.getElementById('eventStart').value = ''; // Clear start time
                document.getElementById('eventEnd').value = ''; // Clear end time
                currentEvent = null; // Reset current event
                document.getElementById('eventModal').classList.remove('hidden'); // Show modal
            },

            eventClick: function(info) {
                document.getElementById('eventModal').classList.remove('hidden');

                // Set the event title
                document.getElementById('eventTitle').value = info.event.title;

                // Set the event date
                document.getElementById('eventDate').value = info.event.start.toISOString().split('T')[0];

                // Set the start time in HH:mm format
                document.getElementById('eventStart').value = info.event.start.toTimeString().slice(0, 5);

                // Set the end time in HH:mm format (check if end is defined)
                document.getElementById('eventEnd').value = info.event.end ? info.event.end.toTimeString().slice(0, 5) : '';

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

        // Create or Update Event
        document.getElementById('saveEventButton').addEventListener('click', function() {
            function formatTime(inputTime) {
                const timeParts = inputTime.split(':');
                if (timeParts.length === 2) {
                    const hours = String(timeParts[0]).padStart(2, '0');
                    const minutes = String(timeParts[1]).padStart(2, '0');
                    return `${hours}:${minutes}`;
                }
                return inputTime;
            }

            var eventData = {
                title: document.getElementById('eventTitle').value.trim(),
                date: document.getElementById('eventDate').value,
                start: formatTime(document.getElementById('eventStart').value),
                end: formatTime(document.getElementById('eventEnd').value),
                user_id: document.getElementById('eventUser').value.trim()
            };

            if (!eventData.title || !eventData.start || !eventData.end) {
                alert('Please fill in the title, date, and time.');
                return;
            }

            if (currentEvent) {
                const updatedEventData = {
                    title: document.getElementById('eventTitle').value,
                    date: document.getElementById('eventDate').value,
                    start: document.getElementById('eventStart').value,
                    end: document.getElementById('eventEnd').value,
                    user_id: document.getElementById('eventUser').value.trim()
                };
                axios.put(`/admin/schedules/${currentEvent.id}`, updatedEventData)
                    .then(response => {
                        const updatedEvent = response.data.event;

                        const updatedStart = new Date(`${updatedEvent.date}T${updatedEvent.start}`);
                        const updatedEnd = new Date(`${updatedEvent.date}T${updatedEvent.end}`);

                        currentEvent.setProp('title', updatedEvent.title);
                        currentEvent.setStart(updatedStart);
                        currentEvent.setEnd(updatedEnd);
                    })
                    .catch(error => {
                        console.error('Error updating event:', error);
                    });
            } else {
                axios.post('/admin/schedules', eventData)
                    .then(response => {
                        const newEvent = response.data.event;

                        const newStart = new Date(`${newEvent.date}T${newEvent.start}`);
                        const newEnd = new Date(`${newEvent.date}T${newEvent.end}`);

                        calendar.addEvent({
                            id: newEvent.id,
                            title: newEvent.title,
                            start: newStart,
                            end: newEnd,
                            allDay: false
                        });
                    })
                    .catch(error => {
                        console.error('Error creating event:', error);
                        alert('Failed to create the event. Please try again.');
                    });
            }

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
                            currentEvent.remove();
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
            const eventData = {
                title: event.title,
                start: event.start.toISOString(),
                end: event.end ? event.end.toISOString() : null
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

        // Function to search events by date
        document.getElementById('search-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const searchDate = document.getElementById('search-input').value;
            if (!searchDate) {
                alert('Please select a date to search.');
                return;
            }

            const matchingEvents = calendar.getEvents().filter(event => {
                const eventDate = event.start.toISOString().split('T')[0];
                return eventDate === searchDate;
            });

            if (matchingEvents.length > 0) {
                const eventDetails = matchingEvents.map(event => `Title: ${event.title}\nDate: ${event.start.toISOString().split('T')[0]}\nStart: ${event.start.toTimeString().slice(0, 5)}\nEnd: ${event.end ? event.end.toTimeString().slice(0, 5) : 'N/A'}`).join('\n\n');

                Swal.fire({
                    title: 'You have a schedule with client',
                    text: eventDetails,
                    icon: 'success',
                    confirmButtonText: 'Okay',
                    customClass: {
                        confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'
                    }
                });
            } else {
                Swal.fire({
                    title: 'No Events Found',
                    text: `No events found for the date: ${searchDate}`,
                    icon: 'warning',
                    confirmButtonText: 'Okay',
                    customClass: {
                        confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'
                    }
                });
            }
        });
    </script>
</x-app-layout>
