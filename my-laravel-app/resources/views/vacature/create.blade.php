@extends('layouts.app')

@section('content')
<style>
  :root {
    --bg-blue: #1E40AF;
    --white: #ffffff;
    --dark: #0f172a;
    --muted: #94a3b8;
    --accent: #3b82f6;
    --radius: 16px;
  }

  .form-wrapper {
    background-color: var(--bg-blue);
    color: var(--white);
    font-family: 'Inter', sans-serif;
    padding: 3rem 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .form-card {
    background: var(--white);
    color: var(--dark);
    padding: 2.5rem;
    border-radius: var(--radius);
    width: 100%;
    max-width: 720px;
    box-shadow: 0 12px 24px rgba(0,0,0,0.1);
  }

  .form-card h1 {
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 2rem;
    color: var(--dark);
  }

  label {
    font-weight: 600;
    display: block;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
  }

  input, select, textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: var(--radius);
    font-size: 1rem;
    background-color: #f9fafb;
    margin-bottom: 1rem;
  }

  button {
    margin-top: 1.5rem;
    padding: 0.9rem;
    width: 100%;
    background-color: var(--accent);
    color: white;
    border: none;
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
  }

  button:hover {
    background-color: #2563eb;
  }
</style>

<div class="form-wrapper">
  <div class="form-card">
    <h1>Vacature Aanmaken</h1>

    <form method="POST" action="{{ route('vacature.store') }}">
      @csrf

      <label for="title">Vacaturetitel</label>
      <input type="text" name="title" placeholder="bv. Frontend developer" required>

      <label for="desc">Beschrijving</label>
      <textarea name="desc" rows="5" placeholder="Geef een duidelijke omschrijving van de job..." required></textarea>

      <label for="type">Type</label>
      <select name="type" required>
        <option value="">-- Kies type --</option>
        <option value="Stage">Stage</option>
        <option value="Werknemer">Werknemer</option>
        <option value="Freelance">Freelance</option>
      </select>

      <label for="sector">Sector</label>
      <select name="sector" required>
        <option value="">-- Kies sector --</option>
        <option value="Tech">Tech</option>
        <option value="Geneeskunde">Geneeskunde</option>
        <option value="Financiën">Financiën</option>
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
</div>
@endsection
