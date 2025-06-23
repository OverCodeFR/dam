<x-layouts.app>
    <form class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
        <x-form.section
            title="Calendrier des événements"
            description="Consulter les événements programmés ci-dessous.">

            <div id="calendar" class="bg-white rounded-md p-4 shadow-sm"></div>

        </x-form.section>
    </form>

    {{-- FullCalendar CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <style>
        #calendar {
            min-height: 600px;
        }

        .fc-col-header-cell-cushion,
        .fc-daygrid-day-number,
        .fc-event-title,
        .fc-toolbar-title,
        .fc-button,
        .fc-button-primary,
        .fc-timegrid-slot-label,
        .fc-timegrid-axis-cushion {
            color: black !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                timeZone: 'local',
                events: '{{ route('events.fetch') }}',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                eventDataTransform: function(eventData) {
                    return {
                        ...eventData,
                        color: eventData.end ? '#61ff00' : '#3788d8'
                    };
                },

                eventClick: function(info) {
                    info.jsEvent.preventDefault();

                    alert(
                        "Titre : " + info.event.title + "\n" +
                        "Description : " + info.event.extendedProps.description + "\n" +
                        "Heure de préférence : " + info.event.start.toLocaleString() + "\n" +
                        "Heure de prise : " + (info.event.end ? info.event.end.toLocaleString() : "Non défini")
                    );
                }
            });

            calendar.render();
        });
    </script>


</x-layouts.app>
