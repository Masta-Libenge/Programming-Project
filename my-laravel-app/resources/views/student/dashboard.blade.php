<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard – CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #1E40AF;
      --bg: #1E40AF;
      --card-bg: #ffffff;
      --text: #0f172a;
      --muted: #64748b;
      --radius: 16px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background-color: var(--bg);
      font-family: 'Inter', sans-serif;
      color: var(--text);
    }

    .navbar {
      position: sticky;
      top: 0;
      width: 100%;
      background-color: var(--primary);
      padding: 1rem 6%;
      z-index: 999;
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    .logo {
      font-size: 1.4rem;
      font-weight: 800;
      color: white;
      text-decoration: none;
    }

    .nav-links a {
      margin-left: 2rem;
      text-decoration: none;
      color: white;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #000000;
    }

    @media (max-width: 768px) {
      .nav-container {
        flex-direction: column;
        align-items: flex-start;
      }

      .nav-links {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 1rem;
      }

      .nav-links a {
        margin-left: 0;
      }
    }

    .dashboard-wrapper {
      max-width: 960px;
      margin: 4rem auto;
      padding: 0 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 2rem;
      color: white;
    }

    .dashboard-header h1 {
      font-size: 2.2rem;
      font-weight: 800;
    }

    .dashboard-header h1 span {
      background-color: white;
      color: var(--primary);
      padding: 0.2rem 0.6rem;
      border-radius: 10px;
    }

    .card {
      background-color: var(--card-bg);
      border-radius: var(--radius);
      padding: 2rem;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      color: var(--text);
    }

    .card h2 {
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 1rem;
    }

    .vacature-card {
      background-color: var(--card-bg);
      border-left: 6px solid var(--primary);
      border-radius: var(--radius);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      transition: transform 0.2s ease;
    }

    .vacature-card:hover {
      transform: scale(1.02);
    }

    .vacature-title {
      font-weight: 700;
      font-size: 1.2rem;
      color: var(--primary);
      margin-bottom: 0.5rem;
    }

    .vacature-meta {
      color: var(--muted);
      font-size: 0.9rem;
      margin-bottom: 0.75rem;
    }

    .vacature-desc {
      color: var(--text);
      font-size: 1rem;
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

    .no-vacatures {
      color: var(--muted);
    }
  </style>
</head>
<body>

  <!-- ✅ Navbar -->
  <header class="navbar">
    <div class="nav-container">
      @auth
        @if (auth()->user()->type === 'student')
          <a href="{{ route('student.dashboard') }}" class="logo">CareerLaunch</a>
        @elseif (auth()->user()->type === 'bedrijf')
          <a href="{{ route('bedrijf.dashboard') }}" class="logo">CareerLaunch</a>
        @else
          <a href="{{ url('/') }}" class="logo">CareerLaunch</a>
        @endif
      @else
        <a href="{{ url('/') }}" class="logo">CareerLaunch</a>
      @endauth

      <nav class="nav-links">
        <a href="#">Planning</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('faq') }}">FAQ</a>
        <a href="#">Contact</a>
        <a href="{{ route('student.profile.show') }}">Profiel</a>
      </nav>
    </div>
  </header>

  <!-- ✅ Dashboard content -->
  <div class="dashboard-wrapper">
    <div class="dashboard-header">
      <h1>Welkom terug, <span>{{ Auth::user()->name }}</span> 👋</h1>
    </div>

    <div class="card">
      <h2>Nieuwste vacatures</h2>

      @if($vacatures->count())
        @foreach($vacatures as $vacature)
          <div class="vacature-card" style="border-left-color: {{ $vacature->color }}">
            <div class="vacature-title">{{ $vacature->title }}</div>
            <div class="vacature-meta">
              {{ $vacature->user->name ?? 'Onbekend bedrijf' }} – {{ $vacature->created_at->diffForHumans() }}
            </div>
            <div class="vacature-desc">{{ $vacature->desc }}</div>

            <!-- ✅ Apply-knop -->
            <form method="POST" action="{{ route('vacature.apply', $vacature->id) }}">
              @csrf
              <button type="submit" class="apply-button">Apply</button>
            </form>
          </div>
        @endforeach
      @else
        <p class="no-vacatures">Er zijn momenteel geen vacatures beschikbaar.</p>
      @endif
    </div>
  </div>

</body>
</html>
