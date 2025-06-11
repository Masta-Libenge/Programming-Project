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
</div>
@endsection

@push('scripts')
<!-- Charger la librairie -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<!-- Ton code JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            selectable: true,
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
            ]
        });

        calendar.render();
    });
</script>

@endpush
