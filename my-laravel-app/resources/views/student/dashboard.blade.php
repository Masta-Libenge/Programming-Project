@extends('layouts.base')

@section('title', 'Student Dashboard – CareerLaunch')

@section('content')
<x-navbar />

<style>
    :root {
        --primary: #1E40AF;
        --bg: #1E40AF;
        --card-bg: #ffffff;
        --text: #0f172a;
        --muted: #64748b;
        --radius: 16px;
        --badge-bg: #f1f5f9;
        --badge-text: #1e293b;
    }

    body {
        background-color: var(--bg);
        font-family: 'Inter', sans-serif;
        color: var(--text);
        margin: 0;
        padding: 0;
    }

    .dashboard-wrapper {
        max-width: 960px;
        margin: 2rem auto;
        padding: 0 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .dashboard-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: white;
    }

    .dashboard-header h1 span {
        background-color: white;
        color: var(--primary);
        padding: 0.2rem 0.6rem;
        border-radius: 10px;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-start;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
    }

    .action-buttons button {
        background-color: white;
        color: var(--primary);
        border-radius: 16px;
        border: none;
        padding: 0.5rem 1rem;
        font-weight: 700;
        cursor: pointer;
    }

    .action-divider {
        display: flex;
        align-items: center;
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .card {
        background-color: var(--card-bg);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .card h2 {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .bedrijf-link {
        text-decoration: none;
        background: #f8fafc;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    .bedrijf-link:hover {
        transform: scale(1.02);
    }

    .bedrijf-name {
        font-size: 1.1rem;
        color: #1E40AF;
        font-weight: 700;
    }

    .bedrijf-email {
        color: #475569;
        font-size: 0.9rem;
    }

    .arrow {
        color: #1E40AF;
        font-size: 1.4rem;
        font-weight: bold;
    }

    .vacature-card {
        background-color: var(--card-bg);
        border-left: 5px solid var(--primary);
        border-radius: var(--radius);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        padding: 1.5rem;
        margin-bottom: 2rem;
        transition: transform 0.2s ease;
    }

    .vacature-card:hover {
        transform: scale(1.01);
    }

    .vacature-title {
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 0.3rem;
        color: var(--primary);
    }

    .vacature-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: var(--muted);
    }

    .badge {
        background-color: var(--badge-bg);
        color: var(--badge-text);
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        font-weight: 500;
    }

    .vacature-desc {
        font-size: 0.95rem;
        margin-top: 1rem;
    }

    .apply-button {
        margin-top: 1rem;
        background-color: var(--primary);
        color: white;
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .apply-button[disabled] {
        background-color: #9ca3af;
        cursor: not-allowed;
    }

    .no-vacatures {
        color: var(--muted);
        font-style: italic;
    }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <h1>Welkom terug, <span>{{ auth()->user()->name }}</span></h1>
    </div>

    <div class="action-buttons">
        <button type="button" id="showSpeedDateBtn">Speed Date</button>
        <div class="action-divider">/</div>
        <button type="button" id="showVacatureBtn">Vacature</button>
    </div>

    <div id="speedDateCard" class="card" style="display: none;">
        <h2>Bedrijven voor Speed Date</h2>
        @if($bedrijven->count())
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($bedrijven as $bedrijf)
                    <a href="{{ route('bedrijf.planning') }}" class="bedrijf-link">
                        <div>
                            <div class="bedrijf-name">{{ $bedrijf->name }}</div>
                            <div class="bedrijf-email">{{ $bedrijf->email }}</div>
                        </div>
                        <div class="arrow">&rarr;</div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="no-vacatures">Er zijn nog geen bedrijven ingeschreven voor de speed date.</p>
        @endif
    </div>

    <div id="vacatureCard" class="card" style="display: none;">
        <h2>Nieuwste vacatures</h2>
        @if($vacatures->count())
            @foreach($vacatures as $vacature)
                <a href="{{ route('vacature.show', $vacature->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="vacature-card" style="border-left-color: {{ $vacature->color ?? '#1E40AF' }}">
                        <div class="vacature-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div class="vacature-title">{{ $vacature->title }}</div>
                                <p class="vacature-bedrijf">
                                    <strong>{{ $vacature->user->name ?? 'Onbekend bedrijf' }}</strong>
                                </p>
                                <span class="vacature-datum">Gepubliceerd op {{ $vacature->created_at->format('d-m-Y') }}</span>
                            </div>
                            <div style="margin-left: auto;">
                                @if(auth()->user()->appliedVacatures->contains($vacature->id))
                                    <form method="POST" action="{{ route('vacature.unapply', $vacature->id) }}">
                                        @csrf
                                        <button type="submit" class="apply-button" style="background-color: #dc2626;">Uitschrijven</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('vacature.apply', $vacature->id) }}">
                                        @csrf
                                        <button type="submit" class="apply-button">Solliciteer</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="vacature-meta">
                            <span class="badge">{{ $vacature->location ?? 'Geen locatie' }}</span>
                            <span class="badge">{{ $vacature->sector ?? 'Geen sector' }}</span>
                            <span class="badge">{{ $vacature->type }}</span>
                            <span class="badge">{{ $vacature->experience ?? 'Geen ervaring vereist' }}</span>
                            <span class="badge">{{ $vacature->salary ?? 'Geen verloning vermeld' }}</span>
                            <span class="badge">
                                {{ $vacature->deadline ? \Carbon\Carbon::parse($vacature->deadline)->format('d-m-Y') : 'Geen deadline' }}
                            </span>
                        </div>
                        <div class="vacature-desc">
                            {{ \Illuminate\Support\Str::limit($vacature->desc, 180) }}
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p class="no-vacatures">Er zijn momenteel geen vacatures beschikbaar.</p>
        @endif
    </div>
</div>

<script>
    document.getElementById('showVacatureBtn').addEventListener('click', () => {
        document.getElementById('vacatureCard').style.display = 'block';
        document.getElementById('speedDateCard').style.display = 'none';
    });

    document.getElementById('showSpeedDateBtn').addEventListener('click', () => {
        document.getElementById('speedDateCard').style.display = 'block';
        document.getElementById('vacatureCard').style.display = 'none';
    });
</script>
@endsection
