@extends('layouts.base')

@section('title', 'Jouw Speeddate Afspraken')

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
        align-items: center;
        justify-content: flex-start;
        color: white;
        font-size: 0.9rem;
        padding: 0 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .free {
        background-color: #94a3b8;
    }

    .reserved {
        background-color: #16a34a;
    }
</style>

@php
    use Carbon\Carbon;

    $tijdstippen = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
@endphp

<div class="planning-container">
    <div class="planning-title">Jouw Speeddate Afspraken Vandaag</div>
    <div class="planning-grid">
        @foreach ($tijdstippen as $time)
            <div class="planning-time">{{ $time }}</div>
            @php
                $match = $reservations->first(function($r) use ($time) {
                    return Carbon::parse($r->start_time)->format('H:00') === $time;
                });
            @endphp
            <div class="planning-block {{ $match ? 'reserved' : 'free' }}">
                @if ($match && $match->student)
                    Gesprek met {{ $match->student->name }} om {{ Carbon::parse($match->start_time)->format('H:i') }}
                @else
                    Geen afspraak
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
