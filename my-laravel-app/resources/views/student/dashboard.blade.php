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

    <div id="speedDateCard" class="card">
        <h2>Bedrijven voor Speed Date</h2>
        @if($bedrijven->count())
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($bedrijven as $bedrijf)
                    <a href="{{ route('student.afspraken', $bedrijf->id) }}" class="bedrijf-link">
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
        <h2>Vacatures binnenkort beschikbaar</h2>
        <p class="no-vacatures">Nog geen vacatures geplaatst.</p>
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

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('showSpeedDateBtn').click();
    });
</script>
@endsection
