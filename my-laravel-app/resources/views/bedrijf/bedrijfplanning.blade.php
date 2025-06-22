@extends('layouts.base')

@section('title', 'Planning van bedrijf')

@section('content')
<x-navbar />

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
        cursor: pointer;
        font-size: 0.9rem;
        transition: background-color 0.2s;
    }

    .minute-block:hover {
        background-color: var(--primary);
    }

    .reserved-me {
        background-color: #16a34a !important;
    }

    .reserved-other {
        background-color: #dc2626 !important;
        cursor: not-allowed;
        pointer-events: none;
    }

    .pause-row {
        text-align: center;
        font-style: italic;
        color: #64748b;
        margin: 2rem 0 1rem;
    }
</style>

<div class="planning-container">
    <div class="planning-title">Planning</div>
    <div class="bedrijf-subtitle">{{ $bedrijf->name }}</div>

    @php
        use App\Models\Reservation;

        $start = \Carbon\Carbon::createFromTime(9, 0);
        $end = \Carbon\Carbon::createFromTime(17, 0);
        $date = now()->toDateString();
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

                        $existingReservation = Reservation::where('bedrijf_id', $bedrijf->id)
                            ->where('date', $date)
                            ->where('start_time', $minuteBlock->format('H:i'))
                            ->first();

                        $class = 'minute-block';

                        if ($existingReservation && $existingReservation->status === 'reserved') {
                            $class .= ' reserved-other';
                        }
                    @endphp

                    <div class="{{ $class }}"
                         data-time="{{ $minuteBlock->format('H:i') }}"
                         data-date="{{ $date }}"
                         data-bedrijf="{{ $bedrijf->id }}">
                        {{ $minuteBlock->format('H:i') }}
                    </div>
                @endfor
            </div>
        </div>

        @php $start->addHour(); @endphp
    @endwhile
</div>

<script>
    document.querySelectorAll('.minute-block').forEach(block => {
        block.addEventListener('click', function () {
            if (this.classList.contains('reserved-other')) return;

            const tijd = this.dataset.time;
            const bedrijfId = this.dataset.bedrijf;
            const date = this.dataset.date;

            const [hours, minutes] = tijd.split(':');
            const start = new Date();
            start.setHours(hours, minutes, 0, 0);
            const end = new Date(start.getTime() + 5 * 60000);

            const pad = (n) => String(n).padStart(2, '0');
            const formatTime = (d) => `${pad(d.getHours())}:${pad(d.getMinutes())}`;

            fetch("{{ route('reservation.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    bedrijf_id: bedrijfId,
                    date: date,
                    start_time: formatTime(start),
                    end_time: formatTime(end)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    this.classList.add('reserved-me');
                    this.innerText = tijd + ' ✔';
                } else if (data.error) {
                    alert(data.error);
                } else {
                    alert('Reservatie mislukt.');
                }
            })
            .catch(() => {
                alert('Er is een fout opgetreden.');
            });
        });
    });
</script>
@endsection
