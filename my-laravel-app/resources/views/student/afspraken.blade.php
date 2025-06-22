@extends('layouts.base')

@section('title', 'Jouw Speeddate Planning')

@section('content')
<x-navbar />

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    :root {
        --primary: #1E40AF;
        --bg: #1E40AF;
        --card-bg: #ffffff;
        --text: #0f172a;
        --gray: #94a3b8;
        --radius: 12px;
    }

    body {
        background-color: var(--bg);
        font-family: 'Inter', sans-serif;
        color: var(--text);
        margin: 0;
        padding: 0;
    }

    .planning-container {
        max-width: 900px;
        margin: 3rem auto;
        background-color: var(--card-bg);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .planning-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .bedrijf-subtitle {
        text-align: center;
        font-size: 1rem;
        color: #475569;
        margin-bottom: 2rem;
    }

    .planning-row {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.2rem;
    }

    .planning-hour {
        width: 80px;
        font-weight: bold;
        color: var(--primary);
        padding-top: 0.3rem;
    }

    .minute-blocks {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        flex-grow: 1;
    }

    .minute-block {
        background-color: var(--gray);
        padding: 0.5rem 0.8rem;
        border-radius: var(--radius);
        color: white;
        font-size: 0.9rem;
        transition: background-color 0.2s;
        position: relative;
        cursor: pointer;
    }

    .reserved {
        background-color: #16a34a !important;
    }

    .cancel-btn {
        position: absolute;
        top: -6px;
        right: -6px;
        background: #ef4444;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        color: white;
        cursor: pointer;
    }

    .pause-row {
        text-align: center;
        font-style: italic;
        color: #64748b;
        margin: 2rem 0 1rem;
    }
</style>

<div class="planning-container">
    <div class="planning-title">Jouw Planning Vandaag</div>
    <div class="bedrijf-subtitle">{{ auth()->user()->name }}</div>

    @php
        use App\Models\Reservation;
        $start = \Carbon\Carbon::createFromTime(9, 0);
        $end = \Carbon\Carbon::createFromTime(17, 0);
        $date = now()->toDateString();
        $bedrijfId = request()->route('bedrijfId') ?? 1;
    @endphp

    @while ($start < $end)
        @php $hourLabel = $start->format('H:i'); @endphp

        @if ($hourLabel === '12:30')
            <div class="pause-row">⏸️ Pauze van 12:30 tot 13:30</div>
            @php $start->addHour(); continue; @endphp
        @endif

        <div class="planning-row">
            <div class="planning-hour">{{ $hourLabel }}</div>
            <div class="minute-blocks">
                @for ($i = 0; $i < 60; $i += 5)
                    @php
                        $minuteBlock = $start->copy()->addMinutes($i);
                        if ($minuteBlock->between(\Carbon\Carbon::createFromTime(12, 30), \Carbon\Carbon::createFromTime(13, 30))) continue;

                        $reservation = Reservation::where('student_id', auth()->id())
                            ->where('date', $date)
                            ->where('start_time', $minuteBlock->format('H:i'))
                            ->first();

                        $class = 'minute-block';
                        $hasReservation = false;
                        if ($reservation) {
                            $class .= ' reserved';
                            $hasReservation = true;
                        }
                    @endphp

                    <div class="{{ $class }}" id="block-{{ $minuteBlock->format('Hi') }}">
                        {{ $minuteBlock->format('H:i') }}
                        @if ($hasReservation)
                            <button class="cancel-btn"
                                onclick="cancelReservation('{{ $reservation->id }}', 'block-{{ $minuteBlock->format('Hi') }}')">×</button>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        @php $start->addHour(); @endphp
    @endwhile
</div>

<script>
    function cancelReservation(reservationId, blockId) {
        fetch(`/student/afspraak/${reservationId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => {
            if (!res.ok) throw new Error("Fout bij annuleren");
            return res.json();
        })
        .then(data => {
            const block = document.getElementById(blockId);
            if (block) {
                block.classList.remove('reserved');
                const btn = block.querySelector('.cancel-btn');
                if (btn) btn.remove();
            }
        })
        .catch((err) => {
            alert(err.message || 'Fout bij verbinding met de server.');
        });
    }

    document.querySelectorAll('.minute-block:not(.reserved)').forEach(block => {
        block.addEventListener('click', function () {
            const tijd = this.textContent.trim();
            const bedrijfId = {{ $bedrijfId }};
            const date = "{{ now()->toDateString() }}";
            const [h, m] = tijd.split(":");
            const end = new Date();
            end.setHours(h);
            end.setMinutes(parseInt(m) + 5);
            const endTime = end.toTimeString().substring(0, 5);

            fetch("{{ route('reservation.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    bedrijf_id: bedrijfId,
                    date: date,
                    start_time: tijd,
                    end_time: endTime
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.message) {
                    this.classList.add('reserved');
                    location.reload();
                } else {
                    alert(data.error || 'Er is een fout opgetreden.');
                }
            })
            .catch(err => alert(err.message || 'Fout bij reserveren.'));
        });
    });
</script>
@endsection
