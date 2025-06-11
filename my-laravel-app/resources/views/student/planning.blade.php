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

    /* Bouton fixe en haut à droite */
    #addEventBtn {
        position: fixed;
        top: 5rem;
        right: 1rem;
        z-index: 1000;
        padding: 0.5rem 1rem;
        background-color: #2563eb; /* bleu */
        color: white;
        border-radius: 0.375rem; /* arrondi */
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        transition: background-color 0.2s ease-in-out;
    }
    #addEventBtn:hover {
        background-color: #1e40af;
    }
</style>
@endpush

@section('content')
<div class="pt-20 px-4 bg-white min-h-screen">
    <div id="calendar" class="bg-white shadow rounded-lg p-4"></div>

    <!-- Bouton Ajouter un événement -->
    <button id="addEventBtn">Ajouter un événement</button>

    <!-- Modal pour ajouter un événement -->
    <div id="eventModal" class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-white/30 hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un événement</h2>

            <form id="eventForm" class="space-y-4">
                <div>
                    <label for="eventTitle" class="block font-medium text-gray-700">Titre</label>
                    <input type="text" id="eventTitle" name="title" placeholder="Nom de l'événement" required
                        class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div class="flex space-x-2">
                    <div class="flex-1">
                        <label for="startDate" class="block font-medium text-gray-700">Date début</label>
                        <input type="date" id="startDate" name="startDate" required
                            class="w-full border border-gray-300 rounded px-4 py-2">
                    </div>
                    <div class="flex-1">
                        <label for="startTime" class="block font-medium text-gray-700">Heure début</label>
                        <input type="time" id="startTime" name="startTime" required
                            class="w-full border border-gray-300 rounded px-4 py-2">
                    </div>
                </div>

                <div class="flex space-x-2">
                    <div class="flex-1">
                        <label for="endDate" class="block font-medium text-gray-700">Date fin</label>
                        <input type="date" id="endDate" name="endDate" required
                            class="w-full border border-gray-300 rounded px-4 py-2">
                    </div>
                    <div class="flex-1">
                        <label for="endTime" class="block font-medium text-gray-700">Heure fin</label>
                        <input type="time" id="endTime" name="endTime" required
                            class="w-full border border-gray-300 rounded px-4 py-2">
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="allDay" name="allDay">
                    <label for="allDay" class="font-medium text-gray-700">Toute la journée</label>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelBtn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Annuler</button>
                    <button type="submit" id="saveEventBtn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ajouter</button>
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
    const eventForm = document.getElementById('eventForm');

    const eventTitleInput = document.getElementById('eventTitle');
    const startDateInput = document.getElementById('startDate');
    const startTimeInput = document.getElementById('startTime');
    const endDateInput = document.getElementById('endDate');
    const endTimeInput = document.getElementById('endTime');
    const allDayCheckbox = document.getElementById('allDay');

    // Création bouton supprimer (qu’on ajoute dynamiquement dans le modal)
    let deleteBtn = null;

    let currentEvent = null; // Pour savoir si on édite un événement existant

    // Init FullCalendar
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
                id: '1',
                title: 'Réunion',
                start: '2025-06-14T10:00:00',
                end: '2025-06-14T12:00:00'
            },
            {
                id: '2',
                title: 'Projet à rendre',
                start: '2025-06-20'
            }
        ],
        dateClick: function(info) {
            openModal(info.dateStr);
        },
        eventClick: function(info) {
            openModal(null, info.event);
        }
    });

    // Ouvrir modal (date pour ajout, event pour édition)
    function openModal(date = null, event = null) {
        resetForm();

        currentEvent = event;

        if (event) {
            // Edition : pré-remplir avec les données de l'événement
            eventTitleInput.value = event.title;

            const start = event.start;
            const end = event.end || event.start; // si pas de end

            allDayCheckbox.checked = event.allDay;

            startDateInput.value = start.toISOString().slice(0,10);
            endDateInput.value = end.toISOString().slice(0,10);

            if (!event.allDay) {
                startTimeInput.value = start.toTimeString().slice(0,5);
                endTimeInput.value = end.toTimeString().slice(0,5);
                startTimeInput.disabled = false;
                endTimeInput.disabled = false;
            } else {
                startTimeInput.value = '';
                endTimeInput.value = '';
                startTimeInput.disabled = true;
                endTimeInput.disabled = true;
            }

            addDeleteButton();
        } else {
            // Ajout : on met date si présent
            if (date) {
                startDateInput.value = date;
                endDateInput.value = date;
            }
            allDayCheckbox.checked = false;
            startTimeInput.disabled = false;
            endTimeInput.disabled = false;

            removeDeleteButton();
        }

        modal.classList.remove('hidden');
    }

    // Reset formulaire et état
    function resetForm() {
        eventForm.reset();
        startTimeInput.disabled = false;
        endTimeInput.disabled = false;
        currentEvent = null;
    }

    // Gestion checkbox allDay
    allDayCheckbox.addEventListener('change', function() {
        if (this.checked) {
            startTimeInput.disabled = true;
            endTimeInput.disabled = true;
            startTimeInput.value = '';
            endTimeInput.value = '';
        } else {
            startTimeInput.disabled = false;
            endTimeInput.disabled = false;
        }
    });

    // Ouvrir modal via bouton "Ajouter un événement"
    addEventBtn.addEventListener('click', function() {
        openModal();
    });

    // Fermer modal sans rien faire
    cancelBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    // Soumettre formulaire (ajout ou édition)
    eventForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const title = eventTitleInput.value.trim();
        if (!title) {
            alert('Le titre est obligatoire.');
            return;
        }

        let startDate = startDateInput.value;
        let endDate = endDateInput.value;
        if (!startDate || !endDate) {
            alert('Les dates de début et fin sont obligatoires.');
            return;
        }

        let startDateTime = startDate;
        let endDateTime = endDate;

        if (!allDayCheckbox.checked) {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;

            if (!startTime || !endTime) {
                alert('Les heures de début et fin sont obligatoires pour un événement horaire.');
                return;
            }

            startDateTime += 'T' + startTime;
            endDateTime += 'T' + endTime;

            if (endDateTime <= startDateTime) {
                alert('La date/heure de fin doit être postérieure à la date/heure de début.');
                return;
            }
        }

        if (currentEvent) {
            // Edition : modifier event existant
            currentEvent.setProp('title', title);
            currentEvent.setStart(startDateTime);
            currentEvent.setEnd(endDateTime);
            currentEvent.setAllDay(allDayCheckbox.checked);
        } else {
            // Ajout
            calendar.addEvent({
                id: String(Date.now()), // id unique simple
                title: title,
                start: startDateTime,
                end: endDateTime,
                allDay: allDayCheckbox.checked
            });
        }

        modal.classList.add('hidden');
    });

    // Ajouter bouton supprimer dans le modal
    function addDeleteButton() {
        if (!deleteBtn) {
            deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'Supprimer';
            deleteBtn.type = 'button';
            deleteBtn.className = 'px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 mr-2';
            deleteBtn.style.marginRight = 'auto';
            deleteBtn.addEventListener('click', function() {
                if (currentEvent && confirm('Voulez-vous vraiment supprimer cet événement ?')) {
                    currentEvent.remove();
                    modal.classList.add('hidden');
                }
            });

            // Insérer avant les boutons annuler / sauvegarder
            const btnContainer = eventForm.querySelector('div.flex.justify-end');
            btnContainer.insertBefore(deleteBtn, btnContainer.firstChild);
        }
    }

    // Enlever bouton supprimer
    function removeDeleteButton() {
        if (deleteBtn && deleteBtn.parentNode) {
            deleteBtn.parentNode.removeChild(deleteBtn);
            deleteBtn = null;
        }
    }

    calendar.render();
});
</script>
@endpush
