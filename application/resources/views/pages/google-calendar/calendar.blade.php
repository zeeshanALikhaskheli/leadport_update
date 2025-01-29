@extends('layout.wrapper') 
@section('content')
<!-- main content -->
<div class="container-fluid">
    <!-- page content -->
    <div class="row">
        <h1>Calendar Events</h1>
        <div class="col-12">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#eventModal">
                Create Event
            </button>
            <a href="{{ url('auth/logout') }}" class="btn btn-success float-right" target="_blank">Logout</a>           
            <!-- The Create Event Modal -->
            <div class="modal" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('events/create') }}" method="POST" id="eventForm">
                                @csrf
                                <input type="hidden" name="event_id" id="eventId" value="">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" class="form-control" id="eventTitle" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea name="description" class="form-control" id="eventDescription"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date & Time:</label>
                                    <input type="datetime-local" class="form-control" name="start_date" id="eventStart" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date & Time:</label>
                                    <input type="datetime-local" class="form-control" name="end_date" id="eventEnd" required>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="deleteButton" style="display:none;">Delete Event</button>
                                <button type="submit" class="btn btn-success" id="submitButton">Create Event</button>
                                </div>                            
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12">
            <div id='calendar'></div>
        </div>
    </div>
</div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let appUrl = '{{  url("/") }}';
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        views: {
            dayGridMonth: { buttonText: 'Month' },
            timeGridWeek: { buttonText: 'Week' },
            timeGridDay: { buttonText: 'Day' }
        },
        events: @json($events),
        eventClick: function(info) {
            document.getElementById('eventId').value = info.event.id;
            document.getElementById('eventTitle').value = info.event.title;
            document.getElementById('eventDescription').value = info.event.extendedProps.description || '';
            document.getElementById('eventStart').value = info.event.start.toISOString().slice(0, 16);
            document.getElementById('eventEnd').value = info.event.end.toISOString().slice(0, 16);
            document.getElementById('submitButton').textContent = 'Update Event';
            document.getElementById('eventForm').action = '{{ url("events/update") }}';
            document.getElementById('deleteButton').style.display = 'inline-block'; // Show delete button

            document.getElementById('eventForm').action = `{{ url('events/update') }}`;
            // Show the modal
            $('#eventModal').modal('show');
        },
        dateClick: function(info) {
            document.getElementById('eventId').value = ''; // Clear event ID for new event
            document.getElementById('eventTitle').value = '';
            document.getElementById('eventDescription').value = '';
            const clickedDate = info.dateStr; // Get the clicked date in YYYY-MM-DD format
            document.getElementById('eventStart').value = clickedDate + "T00:00"; // Set to midnight
            document.getElementById('eventEnd').value = clickedDate + "T00:00"; // Set to midnight
            document.getElementById('submitButton').textContent = 'Create Event';
            document.getElementById('deleteButton').style.display = 'none'; // Show delete button
            $('#eventModal').modal('show');
        },
    });
    
    calendar.render();

    document.getElementById('deleteButton').onclick = function() {
    const eventId = document.getElementById('eventId').value;
    if (confirm('Are you sure you want to delete this event?')) {
        fetch(`${appUrl}/events/${eventId}/delete`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar.getEventById(eventId).remove(); // Remove the event from the calendar
                $('#eventModal').modal('hide'); // Close the modal
            } else {
                alert('Error deleting event: ' + (data.message || 'Unknown error'));
            }
        });
    }
};
});

</script>

<!--main content -->
@endsection
