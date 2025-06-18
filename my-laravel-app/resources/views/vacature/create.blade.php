@extends('layouts.app') {{-- als je layout gebruikt, anders weglaten --}}

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Vacature Aanmaken - CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --bg: #f8fafc;
      --white: #ffffff;
      --accent: #0f172a;
      --primary: #3b82f6;
      --radius: 16px;
      --muted: #64748b;
      --shadow: 0 12px 24px rgba(0,0,0,0.05);
    }

    body {
      background-color: var(--bg);
      font-family: 'Segoe UI', sans-serif;
      padding: 2rem;
    }

    .form-card {
      background: var(--white);
      padding: 2rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      max-width: 600px;
      margin: 0 auto 4rem auto;
    }

    label {
      display: block;
      margin-top: 1rem;
      font-weight: 600;
    }

    input, textarea, select {
      width: 100%;
      padding: 0.75rem;
      margin-top: 0.3rem;
      border-radius: var(--radius);
      border: 1px solid #e5e7eb;
    }

    button {
      background: var(--primary);
      color: white;
      padding: 0.9rem;
      width: 100%;
      border: none;
      margin-top: 1.5rem;
      font-weight: 600;
      border-radius: var(--radius);
      cursor: pointer;
    }

    /* ✅ Vacature Cards */
    .card-list {
      max-width: 1000px;
      margin: 0 auto;
    }

    .vacature-card {
      background: white;
      padding: 1.5rem;
      margin-bottom: 1rem;
      border-left: 5px solid var(--primary);
      border-radius: 12px;
      box-shadow: var(--shadow);
    }

    .vacature-card h3 {
      margin-bottom: 0.5rem;
    }

    .vacature-footer {
      font-size: 0.85rem;
      color: var(--muted);
      margin-top: 0.5rem;
    }

    .vacature-footer span {
      margin-right: 1rem;
    }
  </style>
</head>
<body>

  <div class="form-card">
    <h1>Vacature Aanmaken</h1>

    <form method="POST" action="{{ route('vacature.store') }}">
      @csrf

      <label for="title">Vacaturetitel</label>
      <input type="text" name="title" required>

      <label for="desc">Beschrijving</label>
      <textarea name="desc" rows="5" required></textarea>

      <label for="type">Contracttype</label>
      <select name="type" required>
        <option value="Stage">Stage</option>
        <option value="Werknemer">Werknemer</option>
      </select>

      <label for="color">Kaartkleur</label>
      <select name="color" required>
        <option value="#3b82f6">🔵 Blauw</option>
        <option value="#ef4444">🔴 Rood</option>
        <option value="#10b981">🟢 Groen</option>
        <option value="#facc15">🟡 Geel</option>
      </select>

      <button type="submit">Vacature Toevoegen</button>
    </form>
  </div>

  @if(isset($vacatures) && $vacatures->count())
  <div class="card-list">
    <h2>Nieuwste vacatures</h2>
    @foreach($vacatures as $vacature)
      <div class="vacature-card" style="border-left-color: {{ $vacature->color }}">
        <h3>{{ $vacature->title }}</h3>
        <p>{{ Str::limit($vacature->desc, 100) }}</p>
        <div class="vacature-footer">
          <span>{{ $vacature->type }}</span>
          <span>{{ $vacature->created_at->diffForHumans() }}</span>
        </div>
      </div>
    @endforeach
  </div>
  @endif

</body>
</html>
