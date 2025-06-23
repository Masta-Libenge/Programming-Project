@extends('layouts.base')

@section('title', 'Dashboard – Bedrijf')

@section('content')
<x-navbarbedrijf />

<style>
  :root {
    --primary: #1E40AF;
    --bg: #1E40AF;
    --card-bg: #ffffff;
    --success-bg: #e0f2fe;
    --success-text: #1e3a8a;
    --text: #0f172a;
    --muted: #64748b;
    --radius: 16px;
  }
  body {
    background-color: var(--bg);
    font-family: 'Inter', sans-serif;
    color: var(--text);
  }
  .dashboard-content {
    max-width: 960px;
    margin: 3rem auto;
    padding: 0 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 2rem;
  }
  .topbar h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: white;
  }
  .topbar h1 span {
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
  }
  .action-buttons button {
    background-color: white;
    color: var(--primary);
    border-radius: var(--radius);
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
  .action-bar {
    display: none;
    justify-content: flex-end;
  }
  .create-button {
    background-color: white;
    color: var(--primary);
    padding: 0.8rem 1.4rem;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .create-button:hover {
    background-color: #000;
    color: white;
  }
  .vacature-card {
    background-color: var(--card-bg);
    border-radius: var(--radius);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    padding: 2rem;
  }
  .vacature-card h2 {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--primary);
  }
  .student {
    padding: 1rem 0;
    border-bottom: 1px solid #e2e8f0;
    font-size: 0.95rem;
  }
  .student:last-child {
    border-bottom: none;
  }
  .student-muted {
    color: var(--muted);
  }
</style>

<div class="dashboard-content">
  <div class="topbar">
    <h1>Welkom terug, <span>{{ auth()->user()->name }}</span> 👋</h1>
  </div>

  <div class="action-buttons">
    <button type="button" id="bedrijfSpeedDateBtn">Speed Date</button>
    <div class="action-divider">/</div>
    <button type="button" id="bedrijfVacatureBtn">Vacature</button>
  </div>

  <div id="bedrijfVacatureActionBar" class="action-bar">
    <a href="{{ route('vacature.create') }}">
      <button class="create-button">+ Vacature aanmaken</button>
    </a>
  </div>

  <div id="bedrijfVacatureList" style="display: none;">
    @forelse($vacatures as $vacature)
      <div class="vacature-card">
        <h2>{{ $vacature->title }}</h2>
        <p style="margin-bottom: 1rem;">{{ $vacature->desc }}</p>

        @if($vacature->applicants->where('pivot.status', 'pending')->count())
          <h3 style="margin-bottom: 0.5rem;">Sollicitanten:</h3>
          @foreach($vacature->applicants->where('pivot.status', 'pending') as $student)
            <div class="student">
              👤 {{ $student->name }} – {{ $student->email }}
              @if($student->profile)
                <br><span class="student-muted">Opleiding: {{ $student->profile->opleiding ?? 'n.v.t.' }}</span>
              @endif

              <a href="{{ route('bedrijf.student.profile', $student->id) }}" 
                 style="background: #2563eb; color: white; border: none; padding: 0.3rem 0.7rem; border-radius: 8px; margin-left: 1rem; text-decoration: none; font-weight: 600; cursor: pointer;">
                📄 Bekijk Profiel
              </a>

              <form action="{{ route('vacature.accept', [$vacature->id, $student->id]) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background: #22c55e; color: white; border: none; padding: 0.3rem 0.7rem; border-radius: 8px; margin-left: 0.5rem; cursor: pointer;">
                  ✔️ Accepteer
                </button>
              </form>

              <form action="{{ route('vacature.decline', [$vacature->id, $student->id]) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="background: #ef4444; color: white; border: none; padding: 0.3rem 0.7rem; border-radius: 8px; margin-left: 0.5rem; cursor: pointer;">
                  ❌ Weiger
                </button>
              </form>
            </div>
          @endforeach
        @else
          <p class="student-muted">Nog geen sollicitanten.</p>
        @endif
      </div>
    @empty
      <div class="vacature-card">
        <p class="student-muted">Je hebt nog geen vacatures aangemaakt.</p>
      </div>
    @endforelse
  </div>

  <div id="bedrijfSpeedDateSection" style="display: block;">
    <div class="vacature-card">
      <h2>Speed Date overzicht</h2>
      <p class="student-muted">Nog geen speed date sessies beschikbaar.</p>
    </div>
  </div>
</div>

<script>
  const vacatureBtn = document.getElementById('bedrijfVacatureBtn');
  const speedDateBtn = document.getElementById('bedrijfSpeedDateBtn');
  const vacatureList = document.getElementById('bedrijfVacatureList');
  const speedDateSection = document.getElementById('bedrijfSpeedDateSection');
  const vacatureActionBar = document.getElementById('bedrijfVacatureActionBar');

  vacatureBtn.addEventListener('click', function () {
    vacatureList.style.display = 'block';
    vacatureActionBar.style.display = 'flex';
    speedDateSection.style.display = 'none';
  });

  speedDateBtn.addEventListener('click', function () {
    speedDateSection.style.display = 'block';
    vacatureList.style.display = 'none';
    vacatureActionBar.style.display = 'none';
  });
</script>
@endsection
