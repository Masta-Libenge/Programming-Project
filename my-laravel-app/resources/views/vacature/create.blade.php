@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Vacature Aanmaken – CareerLaunch</title>
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
      padding: 2.5rem 2rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      max-width: 720px;
      margin: 0 auto;
    }

    h1 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 1.5rem;
      color: var(--accent);
    }

    label {
      display: block;
      margin-top: 1.2rem;
      font-weight: 600;
    }

    input, textarea, select {
      width: 100%;
      padding: 0.8rem;
      margin-top: 0.4rem;
      border-radius: var(--radius);
      border: 1px solid #e5e7eb;
      background: #f9fafb;
      font-size: 1rem;
    }

    textarea {
      resize: vertical;
    }

    button {
      background: var(--primary);
      color: white;
      padding: 0.9rem;
      width: 100%;
      border: none;
      margin-top: 2rem;
      font-weight: 600;
      border-radius: var(--radius);
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #2563eb;
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
      <textarea name="desc" rows="6" required></textarea>

      <label for="sector">Sector</label>
      <select name="sector" required>
        <option value="">-- Kies sector --</option>
        <option value="Tech">Tech</option>
        <option value="Medicine">Geneeskunde</option>
        <option value="Finance">Financiën</option>
        <option value="Onderwijs">Onderwijs</option>
        <option value="Overheid">Overheid</option>
        <option value="Retail">Retail</option>
      </select>

      <label for="location">Locatie</label>
      <input type="text" name="location" placeholder="bv. Brussel, Gent, Remote" required>

      <label for="contract_duur">Contractduur</label>
      <input type="text" name="contract_duur" placeholder="bv. Tijdelijk (3 maanden)">

      <label for="contract_type">Contractvorm</label>
      <select name="contract_type">
        <option value="">-- Kies type --</option>
        <option value="Voltijds">Voltijds</option>
        <option value="Deeltijds">Deeltijds</option>
        <option value="Freelance">Freelance</option>
        <option value="Stage">Stage</option>
      </select>

      <label for="werkrooster">Werkrooster</label>
      <select name="werkrooster">
        <option value="">-- Kies rooster --</option>
        <option value="Dagwerk">Dagwerk</option>
        <option value="Weekend">Weekend</option>
        <option value="Flexibel">Flexibel</option>
        <option value="Avond">Avond</option>
      </select>

      <label for="studies">Vereiste studies</label>
      <select name="studies">
        <option value="">-- Geen specifieke studievereiste --</option>
        <option value="Secundair">Secundair onderwijs</option>
        <option value="Professionele bachelor">Professionele bachelor</option>
        <option value="Academische bachelor">Academische bachelor</option>
        <option value="Master">Masteropleiding</option>
      </select>

      <label for="talenkennis">Talenkennis</label>
      <input type="text" name="talenkennis" placeholder="bv. Nederlands (Zeer goed), Frans (Basis)">

      <label for="color">Kaartkleur</label>
      <select name="color" required>
        <option value="">-- Kies kleur --</option>
        <option value="#3b82f6">🔵 Blauw</option>
        <option value="#ef4444">🔴 Rood</option>
        <option value="#10b981">🟢 Groen</option>
        <option value="#facc15">🟡 Geel</option>
      </select>

      <button type="submit">Vacature Toevoegen</button>
    </form>
  </div>
</body>
</html>
@endsection
