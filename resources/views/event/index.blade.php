<x-layouts.app>
    <form class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
        <x-form.section
            title="Calendrier des événements"
            description="Consulter les événements programmés ci-dessous."
        >
            @can('viewAny', \App\Models\Event::class)
                <x-form.type-list
                    name="patient"
                    label="Patient"
                    :options="$patients->pluck('name', 'id')"
                    :value="request('patient')"
                    onchange="window.location.href='?patient=' + this.value"

                />
            @endcan
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
        function renderCalendar() {
            const calendarEl = document.getElementById('calendar');
            if (!calendarEl) return;

            const urlParams = new URLSearchParams(window.location.search);
            const selectedPatientId = urlParams.get('patient');

            // Inject PHP auth user id and role into JS variables
            const currentUserId = @json(auth()->user()->id);
            const currentUserRole = @json(auth()->user()->role->key);

            // Détermine l'ID patient à utiliser pour filtrer les événements
            const patientIdForEvents = (currentUserRole === 'patient') ? currentUserId : selectedPatientId;

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                timeZone: 'local',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                events: '/events/fetch?patient=' + (patientIdForEvents ?? ''),

                eventDataTransform: function(eventData) {
                    return {
                        ...eventData,
                        color: '#3788d8'
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
        }

        document.addEventListener('DOMContentLoaded', renderCalendar);
        document.addEventListener('livewire:navigated', renderCalendar);
    </script>

</x-layouts.app>
