<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Dashboard – Bedrijf</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
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
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background-color: var(--bg);
      font-family: 'Inter', sans-serif;
      color: var(--text);
    }
    .navbar {
      position: sticky; top: 0; width: 100%;
      background-color: var(--primary);
      padding: 1rem 6%; z-index: 999;
    }
    .nav-container {
      display: flex; justify-content: space-between; align-items: center;
      max-width: 1200px; margin: 0 auto;
    }
    .logo { font-size: 1.4rem; font-weight: 800; color: white; }
    .nav-links a {
      margin-left: 2rem; text-decoration: none; color: white;
      font-weight: 600; transition: color 0.3s ease;
    }
    .nav-links a:hover { color: #000000; }
    @media (max-width: 768px) {
      .nav-container { flex-direction: column; align-items: flex-start; }
      .nav-links {
        margin-top: 1rem; display: flex;
        flex-direction: column; width: 100%; gap: 1rem;
      }
      .nav-links a { margin-left: 0; }
    }
    .dashboard-content {
      max-width: 960px; margin: 3rem auto;
      padding: 0 1.5rem; display: flex; flex-direction: column; gap: 2rem;
    }
    .topbar h1 {
      font-size: 2.2rem; font-weight: 800; color: white;
    }
    .topbar h1 span {
      background-color: white; color: var(--primary);
      padding: 0.2rem 0.6rem; border-radius: 10px;
    }
    .logout {
      text-decoration: none; color: white; font-weight: 600;
      border: 1px solid white; padding: 0.5rem 1rem;
      border-radius: var(--radius); transition: background-color 0.2s ease;
    }
    .logout:hover { background-color: white; color: var(--primary); }
    .success {
      display: flex; align-items: center; gap: 0.75rem;
      background-color: var(--success-bg); color: var(--success-text);
      border-left: 4px solid var(--primary);
      padding: 1rem 1.2rem; border-radius: var(--radius);
      font-size: 0.95rem;
    }
    .action-bar {
      display: flex; justify-content: flex-end;
    }
    .create-button {
      background-color: white; color: var(--primary);
      padding: 0.8rem 1.4rem; border: none;
      border-radius: var(--radius); font-weight: 600;
      cursor: pointer; transition: background-color 0.3s ease;
    }
    .create-button:hover { background-color: #000; color: white; }
    .vacature-card {
      background-color: var(--card-bg); border-radius: var(--radius);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08); padding: 2rem;
    }
    .vacature-card h2 {
      font-size: 1.3rem; font-weight: 700;
      margin-bottom: 1rem; color: var(--primary);
    }
    .student {
      padding: 1rem 0; border-bottom: 1px solid #e2e8f0; font-size: 0.95rem;
    }
    .student:last-child { border-bottom: none; }
    .student-muted { color: var(--muted); }
  </style>
</head>
<body>

  <header class="navbar">
    <div class="nav-container">
      <div class="logo">CareerLaunch</div>
      <nav class="nav-links">
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('faq') }}">FAQ</a>
        <a href="#contact">Contact</a>
      </nav>
    </div>
  </header>

  <div class="dashboard-content">
    <div class="topbar">
      <h1>Welkom terug, <span>{{ auth()->user()->name }}</span> 👋</h1>
      <a href="{{ route('logout') }}" class="logout"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Uitloggen
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>

    @if (session('success'))
      <div class="success">✔️ {{ session('success') }}</div>
    @endif

    <div class="action-bar">
      <a href="{{ route('vacature.create') }}">
        <button class="create-button">+ Vacature aanmaken</button>
      </a>
    </div>

    @forelse($vacatures as $vacature)
      <div class="vacature-card">
        <h2>{{ $vacature->title }}</h2>
        <p style="margin-bottom: 1rem;">{{ $vacature->desc }}</p>

        @if($vacature->applicants->count())
          <h3 style="margin-bottom: 0.5rem;">Sollicitanten:</h3>
          @foreach($vacature->applicants as $student)
            <div class="student">
              👤 {{ $student->name }} – {{ $student->email }}
              @if($student->profile)
                <br><span class="student-muted">Opleiding: {{ $student->profile->opleiding ?? 'n.v.t.' }}</span>
              @endif
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

</body>
</html>
