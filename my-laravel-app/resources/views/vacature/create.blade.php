@extends('layouts.app')

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
      padding: 2rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      max-width: 700px;
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
        <option value="Tech">Tech</option>
        <option value="Medicine">Medicine</option>
        <option value="Finance">Finance</option>
        <option value="Onderwijs">Onderwijs</option>
        <option value="Overheid">Overheid</option>
        <option value="Retail">Retail</option>
      </select>

      <label for="location">Locatie</label>
      <input type="text" name="location" placeholder="bv. Brussel, Gent, Remote" required>

      <label for="contract_duur">Contractduur</label>
      <input type="text" name="contract_duur" placeholder="bv. Tijdelijk job (optie vast)">

      <label for="contract_type">Contractvorm</label>
      <input type="text" name="contract_type" placeholder="bv. Voltijds of Deeltijds">

      <label for="werkrooster">Werkrooster</label>
      <input type="text" name="werkrooster" placeholder="bv. Dagwerk, Weekend">

      <label for="studies">Vereiste studies</label>
      <input type="text" name="studies" placeholder="bv. Geen specifieke studiereis">

      <label for="talenkennis">Talenkennis</label>
      <input type="text" name="talenkennis" placeholder="bv. Nederlands (Zeer goed), Frans (Basis)">

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

</body>
</html>