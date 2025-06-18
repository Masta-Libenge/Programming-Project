<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Over Ons – CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-blue: #1E40AF;
      --text-white: #ffffff;
      --btn-white: #ffffff;
      --btn-text: #1C1C1C;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-blue);
      color: var(--text-white);
      padding-top: 80px;
    }

    .navbar {
      position: sticky;
      top: 0;
      width: 100%;
      background-color: var(--bg-blue);
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
      color: #ffffff;
    }

    .nav-links a {
      margin-left: 2rem;
      text-decoration: none;
      color: #ffffff;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #000000;
    }

    .container {
      max-width: 1000px;
      margin: 2rem auto;
      padding: 0 1.5rem;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    p {
      font-size: 1.1rem;
      line-height: 1.7;
      color:  #0f172a;;
    }

    .features {
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
      margin-top: 3rem;
    }

    .feature {
      flex: 1 1 280px;
      background: #ffffff;
      border-radius: 20px;
      padding: 1.5rem;
      color: #1e3a8a;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .feature h3 {
      margin-bottom: 0.5rem;
    }

    .feature p {
      font-size: 0.95rem;
    }

    /* ✅ Nieuwe layout voor zaalplan + prijzen */
    .zaalplan-pricing-wrapper {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      margin: 4rem auto;
      padding: 0 1.5rem;
      max-width: 1400px;
    }

    /* ✅ Zaalplan */
    .zaalplan-wrapper {
      flex: 1 1 600px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
      background: white;
      padding: 2rem;
      border-radius: 20px;
    }

    .aula {
      background: #e5e7eb;
      padding: 1rem;
      border-radius: 12px;
      position: relative;
    }

    .aula h3 {
      position: absolute;
      top: -2rem;
      left: 0;
      font-size: 1rem;
      color: #1E40AF;
      background: white;
      padding: 0.25rem 0.75rem;
      border-radius: 6px;
      font-weight: 600;
    }

    .stand-grid {
      display: grid;
      grid-template-columns: repeat(3, 40px);
      grid-gap: 12px;
      justify-content: center;
      align-items: center;
      margin-top: 1rem;
    }

    .stand {
      width: 40px;
      height: 40px;
      border-radius: 6px;
    }

    .aula1 .stand { background-color: #60A5FA; }
    .aula2 .stand { background-color: #6B7280; }
    .aula3 .stand { background-color: #F59E0B; }
    .aula4 .stand { background-color: #B45309; }

    /* ✅ Prijzen */
    .pricing-section {
      flex: 1 1 400px;
      background-color: #ffffff;
      color: #1e3a8a;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .pricing-section h2 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
      color: #1E40AF;
    }

    .pricing-section h2 span {
      font-size: 1rem;
      font-weight: 400;
      color: #475569;
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

    .pricing-table thead {
      background-color: #f1f5f9;
      color: #1E40AF;
    }

    .gold td    { background-color: #FEF3C7; }
    .silver td  { background-color: #E5E7EB; }
    .bronze td  { background-color: #FDE68A; }
    .startup td { background-color: #DBEAFE; }

    .included {
      font-size: 0.9rem;
      color: #334155;
      margin-top: 1rem;
      font-style: italic;
    }
  </style>
</head>
<body>

<!-- ✅ Navbar -->
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

<!-- ✅ Inhoud -->
<div class="container">
  <h1>Over CareerLaunch</h1>
  <p>
    CareerLaunch is een platform dat studenten en bedrijven met elkaar verbindt op een innovatieve en toegankelijke manier.
    Via stages, vacatures en directe communicatie helpen we jong talent om hun professionele pad te vinden.
  </p>

  <!-- ✅ Missie/Visie -->
  <div class="features">
    <div class="feature">
      <h3> Missie</h3>
      <p>Onze missie is om drempels tussen onderwijs en arbeidsmarkt te verlagen door slimme tools, transparantie en gebruiksvriendelijke matching.</p>
    </div>
    <div class="feature">
      <h3> Visie</h3>
      <p>We willen een digitale brug zijn tussen studenten, scholen en bedrijven, en zo bijdragen aan duurzame loopbanen en talentontwikkeling.</p>
    </div>
    <div class="feature">
      <h3> Betrouwbaarheid</h3>
      <p>Alle gegevens worden veilig beheerd en elk profiel wordt zorgvuldig gecontroleerd op echtheid en relevantie.</p>
    </div>
  </div>
</div>

<!-- ✅ Zaalplan + Prijzen naast elkaar -->
<section class="zaalplan-pricing-wrapper">
  <!-- Zaalplan -->
  <div class="zaalplan-wrapper">
    <div class="aula aula2">
      <h3>AULA2</h3>
      <div class="stand-grid">
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
      </div>
    </div>
    <div class="aula aula3">
      <h3>AULA3</h3>
      <div class="stand-grid">
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
      </div>
    </div>
    <div class="aula aula1">
      <h3>AULA1</h3>
      <div class="stand-grid">
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
      </div>
    </div>
    <div class="aula aula4">
      <h3>AULA4</h3>
      <div class="stand-grid">
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
        <div class="stand"></div><div class="stand"></div><div class="stand"></div>
      </div>
    </div>
  </div>

  <!-- Prijzen -->
  <div class="pricing-section">
    <h2> Standen & Prijzen <span>(excl. btw)</span></h2>
    <table class="pricing-table">
      <thead>
        <tr>
          <th>Formule</th>
          <th>Standgrootte</th>
          <th>Tickets</th>
          <th>Prijs</th>
        </tr>
      </thead>
      <tbody>
        <tr class="gold">
          <td>🟧 Golden</td>
          <td>3m x 2m</td>
          <td>4</td>
          <td>€750</td>
        </tr>
        <tr class="silver">
          <td>🩶 Silver</td>
          <td>2m x 2m</td>
          <td>2</td>
          <td>€500</td>
        </tr>
        <tr class="bronze">
          <td>🟫 Bronze</td>
          <td>1.5m x 1.5m</td>
          <td>2</td>
          <td>€200</td>
        </tr>
        <tr class="startup">
          <td>🟦 Start-up</td>
          <td>2m x 2m</td>
          <td>2</td>
          <td>€150</td>
        </tr>
      </tbody>
    </table>
    <p class="included">Inbegrepen: stroom , wifi , lunch & drank  voor 2 personen</p>
  </div>
</section>

</body>
</html>
