<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Over Ons - CareerLaunch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg: #f8fafc;
            --white: #ffffff;
            --accent: #1e3a8a;
            --muted: #64748b;
            --radius: 16px;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            color: var(--accent);
            padding-top: 80px;
        }

        nav {
            background-color: var(--white);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .nav-left a {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent);
            text-decoration: none;
        }

        nav .nav-right a {
            margin-left: 1.5rem;
            color: var(--muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
        }

        nav .nav-right a:hover {
            color: var(--accent);
            text-decoration: underline;
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
            color: var(--muted);
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .feature {
            flex: 1 1 280px;
            background: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        }

        .feature h3 {
            margin-bottom: 0.5rem;
            color: var(--accent);
        }

        .feature p {
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

<!-- ✅ NAVBAR -->
<nav>
    <div class="nav-left">
        <a href="{{ route('bedrijf.dashboard') }}">CareerLaunch</a>
    </div>
    <div class="nav-right">
        <a href="#">Planning</a>
        <a href="{{ route('about') }}">About&nbsp;Us</a>
<a href="{{ route('faq') }}">FAQ</a>
        <a href="#">Contact</a>
        <a href="{{ route('bedrijf.dashboard') }}">Dashboard</a>
    </div>
</nav>

<!-- ✅ INHOUD -->
<div class="container">
    <h1>Over CareerLaunch</h1>
    <p>
        CareerLaunch is een platform dat studenten en bedrijven met elkaar verbindt op een innovatieve en toegankelijke manier.
        Via stages, vacatures en directe communicatie helpen we jong talent om hun professionele pad te vinden.
    </p>

    <div class="features">
        <div class="feature">
            <h3>🎯 Missie</h3>
            <p>Onze missie is om drempels tussen onderwijs en arbeidsmarkt te verlagen door slimme tools, transparantie en gebruiksvriendelijke matching.</p>
        </div>
        <div class="feature">
            <h3>🤝 Visie</h3>
            <p>We willen een digitale brug zijn tussen studenten, scholen en bedrijven, en zo bijdragen aan duurzame loopbanen en talentontwikkeling.</p>
        </div>
        <div class="feature">
            <h3>🔒 Betrouwbaarheid</h3>
            <p>Alle gegevens worden veilig beheerd en elk profiel wordt zorgvuldig gecontroleerd op echtheid en relevantie.</p>
        </div>
    </div>
</div>

</body>
</html>
