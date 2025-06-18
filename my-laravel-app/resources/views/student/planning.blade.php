@extends('layouts.base')

@section('title', 'Planning')

@section('content')
<style>
    .planning-container {
        max-width: 900px;
        margin: 3rem auto;
        padding: 2rem;
        background: #e0e5ec;
        border-radius: 20px;
        box-shadow: inset 8px 8px 16px #babecc, inset -8px -8px 16px #ffffff;
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
        grid-template-columns: 100px 1fr;
        row-gap: 1rem;
        column-gap: 1rem;
        align-items: center;
    }

    .planning-time {
        text-align: right;
        font-weight: 500;
        color: #1E40AF;
    }

    .planning-block {
        height: 32px;
        border-radius: 8px;
        padding-left: 1rem;
        display: flex;
        align-items: center;
        color: white;
        font-size: 0.9rem;
    }

    .none { background-color: #94a3b8; }
    .interview { background-color: #22c55e; }
    .workshop { background-color: #3b82f6; }
</style>

<div class="planning-container">
    <div class="planning-title">Maandagplanning</div>
    <div class="planning-grid">
        @foreach([
            ['09:00', 'none', 'Geen activiteit'],
            ['10:00', 'interview', 'Sollicitatiegesprek met bedrijf'],
            ['11:00', 'workshop', 'CV-workshop'],
            ['12:00', 'none', 'Geen activiteit'],
            ['13:00', 'workshop', 'Infosessie Erasmus'],
            ['14:00', 'interview', 'HR-gesprek'],
            ['15:00', 'none', 'Geen activiteit'],
            ['16:00', 'interview', 'Gesprek met CEO'],
            ['17:00', 'none', 'Geen activiteit']
        ] as [$time, $type, $label])
            <div class="planning-time">{{ $time }}</div>
            <div class="planning-block {{ $type }}">{{ $label }}</div>
        @endforeach
    </div>
</div>
@endsection
