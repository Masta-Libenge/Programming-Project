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
        margin: 0 auto;
        padding: 1rem;
    }
</style>
@endpush

@section('content')
<div class="pt-20 px-4 bg-white min-h-screen">
    <div id="calendar" class="bg-white shadow rounded-lg p-4"></div>

        <!-- Modal pour ajouter un événement -->
    <div id="eventModal" class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-white/30 hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un événement</h2>
            <input type="text" id="eventTitle" placeholder="Nom de l'événement" class="w-full border border-gray-300 rounded px-4 py-2 mb-4">
            <div class="flex justify-end space-x-2">
                <button id="cancelBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Annuler</button>
                <button id="saveEventBtn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ajouter</button>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Ton code JS -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const modal = document.getElementById('eventModal');
        const eventTitleInput = document.getElementById('eventTitle');
        const saveBtn = document.getElementById('saveEventBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        let clickedDate = null;

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
            events: [
                {
                    title: 'Réunion',
                    start: '2025-06-14T10:00:00',
                    end: '2025-06-14T12:00:00'
                },
                {
                    title: 'Projet à rendre',
                    start: '2025-06-20'
                }
            ],
            dateClick: function(info) {
                clickedDate = info.dateStr;
                eventTitleInput.value = '';
                modal.classList.remove('hidden');
            }
        });

        // Ajoute un événement au calendrier
        saveBtn.addEventListener('click', function () {
            const title = eventTitleInput.value.trim();
            if (title && clickedDate) {
                calendar.addEvent({
                    title: title,
                    start: clickedDate,
                    allDay: true
                });
                modal.classList.add('hidden');
            }
        });

        // Ferme le modal sans rien faire
        cancelBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        calendar.render();
    });
</script>
@endpush

