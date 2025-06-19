@extends('layouts.base')

@section('title', 'Vacature – ' . $vacature->title)

@section('content')
<x-navbar />

<style>
    :root {
        --primary: #1E40AF;
        --text: #0f172a;
        --muted: #64748b;
        --bg-light: #f8fafc;
    }

    .vacature-detail {
        max-width: 900px;
        margin: 4rem auto;
        padding: 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        font-family: 'Inter', sans-serif;
    }

    .vacature-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .vacature-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
    }

    .vacature-meta {
        margin-top: 1rem;
        color: var(--muted);
        font-size: 0.9rem;
    }

    .info-box {
        background-color: var(--bg-light);
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 2rem;
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .info-column {
        flex: 1 1 250px;
    }

    .info-column h3 {
        color: #1e293b;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .vacature-desc {
        margin-top: 2rem;
        font-size: 1rem;
        color: var(--text);
        line-height: 1.6;
    }

    .apply-button {
        margin-top: 2rem;
        background-color: var(--primary);
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
    }

    .apply-button[disabled] {
        background-color: #9ca3af;
        cursor: not-allowed;
    }
</style>

<div class="vacature-detail">
    <div class="vacature-header">
        <h1>{{ $vacature->title }}</h1>
    </div>

    <div class="vacature-meta">
        <p><strong>Bedrijf:</strong> {{ $vacature->user->name ?? 'Onbekend' }}</p>
        <p><strong>Locatie:</strong> {{ $vacature->location ?? 'Niet gespecificeerd' }}</p>
        <p><strong>Sector:</strong> {{ $vacature->sector ?? 'Geen sector' }}</p>
        <p><strong>Contracttype:</strong> {{ $vacature->type }}</p>
        <p><strong>Ervaring:</strong> {{ $vacature->experience ?? 'Geen ervaring vereist' }}</p>
        <p><strong>Verloning:</strong> {{ $vacature->salary ?? 'Niet vermeld' }}</p>
        <p><strong>Deadline:</strong> {{ $vacature->deadline ? \Carbon\Carbon::parse($vacature->deadline)->format('d-m-Y') : 'Geen deadline' }}</p>
    </div>

    <section class="info-box">
        <div class="info-column">
            <h3>Contract</h3>
            <p>{{ $vacature->contract_duur ?? 'Geen info' }}</p>
            <p>{{ $vacature->contract_type ?? '-' }}</p>
            <p>{{ $vacature->werkrooster ?? '-' }}</p>
        </div>

        <div class="info-column">
            <h3>Vereiste studies</h3>
            <p>{{ $vacature->studies ?? 'Geen specifieke studiereis' }}</p>
        </div>

        <div class="info-column">
            <h3>Talenkennis</h3>
            <p>{{ $vacature->talenkennis ?? 'Niet opgegeven' }}</p>
        </div>

        <div class="info-column">
            <h3>Werkervaring</h3>
            <p>{{ $vacature->experience ?? 'Niet vermeld' }}</p>
        </div>
    </section>

    <div class="vacature-desc">
        {!! nl2br(e($vacature->desc)) !!}
    </div>

    @if(auth()->check() && auth()->user()->type === 'student')
        @if(auth()->user()->appliedVacatures->contains($vacature->id))
            <button class="apply-button" disabled>Geapplyd</button>
        @else
            <form method="POST" action="{{ route('vacature.apply', $vacature->id) }}">
                @csrf
                <button type="submit" class="apply-button">Apply</button>
            </form>
        @endif
    @endif
</div>
@endsection