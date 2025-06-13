@extends('layouts.app')

@section('title', 'Planning')

@push('styles')
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #calendar {
        max-width: 100%;
        margin: auto;
    }

    /* Supprimer focus par défaut de FullCalendar */
    .fc .fc-button:focus {
        box-shadow: none !important;
    }

    /* Tailwind-friendly reset */
    .fc {
        font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #1c1c1e;
        background-color: white;
    }

    /* En-tête propre */
    .fc-toolbar-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1c1c1e;
    }

    .fc-button {
        background-color: #f2f2f7 !important;
        border: none !important;
        color: #1c1c1e !important;
        border-radius: 8px !important;
        padding: 0.4rem 0.8rem !important;
        transition: background 0.2s ease-in-out;
    }

    .fc-button:hover {
        background-color: #e5e5ea !important;
    }

    /* Grille propre */
    .fc-daygrid-day {
        border-color: #e5e5ea !important;
    }

    /* Événements minimalistes */
    .fc-event {
        background-color: #007aff !important;
        color: white !important;
        border-radius: 8px;
        padding: 2px 6px;
        font-weight: 500;
        font-size: 0.875rem;
        border: none;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

</style>
@endpush

@section('content')
<div class="h-screen bg-gray-100 pt-20 px-4">

    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Mon planning</h1>

        <div id="calendar" class="mt-6"></div>

        <!-- Bouton flottant pour ajouter -->
        <button id="addEventBtn" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-5 rounded-full shadow-lg transition">
            + Ajouter un événement
        </button>
    </div>

    <!-- Modal -->
    <div id="eventModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ajouter / Modifier un événement</h2>

            <form id="eventForm" class="space-y-4">
                <div>
                    <label for="eventTitle" class="block font-medium text-gray-700">Titre</label>
                    <input type="text" id="eventTitle" name="title" required placeholder="Titre de l'événement"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="startDate" class="block font-medium text-gray-700">Date début</label>
                        <input type="date" id="startDate" name="startDate" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="flex-1">
                        <label for="startTime" class="block font-medium text-gray-700">Heure début</label>
                        <input type="time" id="startTime" name="startTime"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="endDate" class="block font-medium text-gray-700">Date fin</label>
                        <input type="date" id="endDate" name="endDate" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="flex-1">
                        <label for="endTime" class="block font-medium text-gray-700">Heure fin</label>
                        <input type="time" id="endTime" name="endTime"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="allDay" name="allDay" class="h-4 w-4 text-blue-600">
                    <label for="allDay" class="text-sm text-gray-700">Toute la journée</label>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" id="cancelBtn" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md">
                        Annuler
                    </button>
                    <div class="flex space-x-2">
                        <button type="button" id="deleteBtn" class="hidden px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
                            Supprimer
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('eventModal');
    const addEventBtn = document.getElementById('addEventBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const eventForm = document.getElementById('eventForm');

    const eventTitleInput = document.getElementById('eventTitle');
    const startDateInput = document.getElementById('startDate');
    const startTimeInput = document.getElementById('startTime');
    const endDateInput = document.getElementById('endDate');
    const endTimeInput = document.getElementById('endTime');
    const allDayCheckbox = document.getElementById('allDay');

    let currentEvent = null;

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        selectable: true,
        editable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [],
        dateClick(info) {
            openModal(info.dateStr);
        },
        eventClick(info) {
            openModal(null, info.event);
        }
    });

    function openModal(date = null, event = null) {
        resetForm();
        currentEvent = event;

        if (event) {
            eventTitleInput.value = event.title;
            startDateInput.value = event.start.toISOString().slice(0, 10);
            endDateInput.value = (event.end || event.start).toISOString().slice(0, 10);

            allDayCheckbox.checked = event.allDay;
            deleteBtn.classList.remove('hidden');

            if (!event.allDay) {
                startTimeInput.value = event.start.toTimeString().slice(0, 5);
                endTimeInput.value = (event.end || event.start).toTimeString().slice(0, 5);
            } else {
                startTimeInput.value = '';
                endTimeInput.value = '';
            }

            toggleTimeInputs(event.allDay);
        } else {
            deleteBtn.classList.add('hidden');
            if (date) {
                startDateInput.value = date;
                endDateInput.value = date;
            }
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function resetForm() {
        eventForm.reset();
        currentEvent = null;
    }

    function toggleTimeInputs(disabled) {
        startTimeInput.disabled = disabled;
        endTimeInput.disabled = disabled;
    }

    allDayCheckbox.addEventListener('change', function () {
        toggleTimeInputs(this.checked);
    });

    addEventBtn.addEventListener('click', () => openModal());

    cancelBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    deleteBtn.addEventListener('click', () => {
        if (currentEvent && confirm('Supprimer cet événement ?')) {
            currentEvent.remove();
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    eventForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const title = eventTitleInput.value.trim();
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;
        const isAllDay = allDayCheckbox.checked;

        if (!title || !startDate || !endDate) {
            alert('Remplis tous les champs obligatoires.');
            return;
        }

        let start = startDate;
        let end = endDate;

        if (!isAllDay) {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;
            if (!startTime || !endTime) {
                alert('Heures requises pour événement horaire.');
                return;
            }

            start += 'T' + startTime;
            end += 'T' + endTime;
        }

        if (currentEvent) {
            currentEvent.setProp('title', title);
            currentEvent.setStart(start);
            currentEvent.setEnd(end);
            currentEvent.setAllDay(isAllDay);
        } else {
            calendar.addEvent({
                id: String(Date.now()),
                title,
                start,
                end,
                allDay: isAllDay,
            });
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    calendar.render();
});
</script>
@endpush
