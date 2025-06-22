@extends('layouts.base')

@section('title', 'Planning')

@section('content')
<x-navbar />

<style>
    .planning-container {
        max-width: 815px;
        margin: 3rem auto;
        padding: 2rem 1.5rem;
        background: #ffffff;
        border-radius: 20px;
        box-sizing: border-box;
    }

    .planning-title {
        font-size: 2rem;
        font-weight: bold;
        color: #1E40AF;
        text-align: center;
        margin-bottom: 2rem;
    }

    .planning-grid {
        display: grid;
        grid-template-columns: max-content 1fr;
        row-gap: 1rem;
        column-gap: 1rem;
        align-items: center;
    }

    .planning-time {
        text-align: right;
        font-weight: 500;
        color: #1E40AF;
        padding-right: 0.5rem;
    }

    .planning-block {
        min-height: 32px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: default;
    }

    .none {
        background-color: #94a3b8;
    }

    .reserved {
        background-color: #16a34a !important;
    }

    .cancel-btn {
        background-color: #ef4444;
        border: none;
        color: white;
        font-size: 0.8rem;
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        margin-top: 4px;
        cursor: pointer;
    }

    .cancel-btn:hover {
        background-color: #dc2626;
    }
</style>

@php
    use Carbon\Carbon;
    $tijdstippen = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
@endphp

<div class="planning-container">
    <div class="planning-title">Planning</div>
    <div class="planning-grid">
        @foreach ($tijdstippen as $time)
            <div class="planning-time">{{ $time }}</div>
            @php
                $group = $reservations[$time] ?? collect();
            @endphp

            <div class="planning-block {{ $group->isNotEmpty() ? 'reserved' : 'none' }}">
                @if ($group->isNotEmpty())
                    @foreach ($group as $r)
                        <div style="margin-bottom: 6px;">
                            Gesprek met {{ $r->bedrijf->name ?? 'onbekend' }} om {{ Carbon::parse($r->start_time)->format('H:i') }}.
                            <button class="cancel-btn" onclick="cancelReservation('{{ $r->bedrijf_id }}', '{{ $r->date }}', '{{ $r->start_time }}', this)">Annuleer</button>
                        </div>
                    @endforeach
                @else
                    Geen activiteit
                @endif
            </div>
        @endforeach
    </div>
</div>

<script>
    function cancelReservation(bedrijfId, date, startTime, button) {
        if (!confirm('Weet je zeker dat je deze afspraak wilt annuleren?')) return;

        fetch('{{ route('reservation.destroy') }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                bedrijf_id: bedrijfId,
                date: date,
                start_time: startTime
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                button.closest('div').innerHTML = '<em>Afspraak geannuleerd</em>';
            } else {
                alert(data.error || 'Er is een fout opgetreden.');
            }
        })
        .catch(() => alert('Er is een fout opgetreden bij het annuleren.'));
    }
</script>
@endsection
