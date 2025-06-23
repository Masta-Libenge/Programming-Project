<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Over Ons – CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: linear-gradient(to bottom right, #1E3A8A, #1E40AF);
      --white: #ffffff;
      --text-dark: #0f172a;
      --muted: #64748b;
      --radius: 24px;
      --gold: #FEF3C7;
      --silver: #E5E7EB;
      --bronze: #FDE68A;
      --startup: #DBEAFE;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--white);
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
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

    .logo { font-size: 1.6rem; font-weight: 800; color: var(--white); }

    .nav-links a {
      margin-left: 2rem;
      text-decoration: none;
      color: var(--white);
      font-weight: 600;
      transition: opacity 0.3s ease;
    }

    .nav-links a:hover { opacity: 0.8; }

    .back-button {
      margin-top: 90px;
      margin-left: 6%;
      display: inline-block;
      color: white;
      font-size: 1rem;
      font-weight: 600;
      text-decoration: none;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }

    .hero {
      text-align: center;
      padding: 3rem 1.5rem 5rem 1.5rem;
      max-width: 900px;
      margin: 0 auto;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.25rem;
      line-height: 1.7;
      color: #dbeafe;
    }

    .grid-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      padding: 4rem 6%;
      max-width: 1400px;
      margin: 0 auto;
    }

    .card {
      background-color: var(--white);
      color: var(--text-dark);
      border-radius: var(--radius);
      padding: 2rem;
    }

    .card h3 {
      font-size: 1.3rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .card p {
      font-size: 1rem;
      color: var(--muted);
    }

    .zaalplan-wrapper {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      margin: 4rem auto;
      padding: 0 1.5rem;
      max-width: 1400px;
    }

    .aula {
      background: #f1f5f9;
      padding: 1.5rem;
      border-radius: var(--radius);
      width: 280px;
      text-align: center;
    }

    .aula h3 {
      font-size: 1.2rem;
      margin-bottom: 1rem;
      color: #1E40AF;
    }

    .stand-grid {
      display: grid;
      grid-template-columns: repeat(3, 40px);
      grid-gap: 10px;
      justify-content: center;
    }

    .stand {
      width: 40px;
      height: 40px;
      border-radius: 8px;
    }

    .blue { background-color: #60A5FA; }
    .gray { background-color: #6B7280; }
    .amber { background-color: #F59E0B; }
    .brown { background-color: #B45309; }

    .pricing-section {
      background-color: var(--white);
      color: var(--text-dark);
      border-radius: var(--radius);
      padding: 2rem;
      max-width: 500px;
      margin: 4rem auto;
    }

    .pricing-section h2 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
      color: #1E40AF;
    }

    .pricing-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    .pricing-table th, .pricing-table td {
      text-align: left;
      padding: 0.75rem;
      border-bottom: 1px solid #e2e8f0;
    }

    .gold td    { background-color: var(--gold); }
    .silver td  { background-color: var(--silver); }
    .bronze td  { background-color: var(--bronze); }
    .startup td { background-color: var(--startup); }

    .included {
      font-size: 0.9rem;
      color: var(--muted);
      margin-top: 1rem;
      font-style: italic;
    }

    .footer {
      text-align: center;
      padding: 2rem;
      font-size: 0.9rem;
      color: #cbd5e1;
    }
  </style>
</head>
<body>
  <header class="navbar">
    <div class="nav-container">
      <div class="logo">CareerLaunch</div>
      <nav class="nav-links">
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('contact') }}">Contact</a>
      </nav>
    </div>
  </header>

  <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

  <section class="hero">
    <h1>Over CareerLaunch</h1>
    <p>Wij verbinden studenten en bedrijven via slimme technologie, directe communicatie en waardevolle kansen. Onze missie is om talent en werkgelegenheid samen te brengen.</p>
  </section>

  <section class="grid-section">
    <div class="card">
      <h3>Missie</h3>
      <p>Een brug bouwen tussen onderwijs en werkveld met transparantie, snelheid en gebruiksvriendelijke tools.</p>
    </div>
    <div class="card">
      <h3>Visie</h3>
      <p>Wij geloven in een inclusieve arbeidsmarkt waar elke student de kans krijgt om zich professioneel te ontplooien.</p>
    </div>
    <div class="card">
      <h3>Veiligheid</h3>
      <p>Jouw gegevens zijn veilig bij ons: we controleren profielen en gebruiken versleutelde opslag.</p>
    </div>
  </section>

  <section class="zaalplan-wrapper">
    <div class="aula">
      <h3>AULA1</h3>
      <div class="stand-grid">
        <div class="stand blue"></div><div class="stand blue"></div><div class="stand blue"></div>
        <div class="stand blue"></div><div class="stand blue"></div><div class="stand blue"></div>
        <div class="stand blue"></div><div class="stand blue"></div><div class="stand blue"></div>
      </div>
    </div>
    <div class="aula">
      <h3>AULA2</h3>
      <div class="stand-grid">
        <div class="stand gray"></div><div class="stand gray"></div><div class="stand gray"></div>
        <div class="stand gray"></div><div class="stand gray"></div><div class="stand gray"></div>
        <div class="stand gray"></div><div class="stand gray"></div><div class="stand gray"></div>
      </div>
    </div>
    <div class="aula">
      <h3>AULA3</h3>
      <div class="stand-grid">
        <div class="stand amber"></div><div class="stand amber"></div><div class="stand amber"></div>
        <div class="stand amber"></div><div class="stand amber"></div><div class="stand amber"></div>
        <div class="stand amber"></div><div class="stand amber"></div><div class="stand amber"></div>
      </div>
    </div>
    <div class="aula">
      <h3>AULA4</h3>
      <div class="stand-grid">
        <div class="stand brown"></div><div class="stand brown"></div><div class="stand brown"></div>
        <div class="stand brown"></div><div class="stand brown"></div><div class="stand brown"></div>
        <div class="stand brown"></div><div class="stand brown"></div><div class="stand brown"></div>
      </div>
    </div>
  </section>

  <section class="pricing-section">
    <h2>Standen & Prijzen <span>(excl. btw)</span></h2>
    <table class="pricing-table">
      <thead>
        <tr><th>Formule</th><th>Tickets</th><th>Prijs</th></tr>
      </thead>
      <tbody>
        <tr class="gold"><td>🟧 Golden</td><td>3m x 2m</td><td>€750</td></tr>
        <tr class="silver"><td>⬜ Silver</td><td>2m x 2m</td><td>€500</td></tr>
        <tr class="bronze"><td>🟫 Bronze</td><td>1.5m x 1.5m</td><td>€200</td></tr>
        <tr class="startup"><td>🟦 Start-up</td><td>2m x 2m</td><td>€150</td></tr>
      </tbody>
    </table>
    <p class="included">Inbegrepen: stroom, wifi, lunch & drank voor 2 personen</p>
  </section>

  <footer class="footer">
    &copy; 2025 CareerLaunch – Alle rechten voorbehouden.
  </footer>
</body>
</html>
