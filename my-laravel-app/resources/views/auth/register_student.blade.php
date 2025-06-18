<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Student registratie – CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg-blue: #1E40AF;
      --text-white: #ffffff;
      --text-dark: #0f172a;
      --muted: #64748b;
      --radius: 16px;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body {
      height: 100%;
      font-family: 'Inter', sans-serif;
      background-color: var(--bg-blue);
      color: var(--text-dark);
      scroll-behavior: smooth;
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
    .form-container {
      background: white;
      border-radius: var(--radius);
      padding: 3rem 2rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 480px;
      margin: 0 auto;
      margin-top: 1rem;
    }
    h1 {
      font-size: 2.4rem;
      font-weight: 800;
      text-align: center;
      color: var(--bg-blue);
      margin-bottom: 1rem;
    }
    p {
      text-align: center;
      font-size: 1rem;
      color: var(--muted);
      margin-bottom: 2rem;
    }
    label {
      font-weight: 600;
      font-size: 0.95rem;
      margin-bottom: 0.4rem;
      display: block;
      margin-top: 1.2rem;
    }
    input {
      width: 100%;
      padding: 0.85rem;
      font-size: 1rem;
      border: 1px solid #e2e8f0;
      border-radius: var(--radius);
      background-color: #f9fafb;
    }
    button {
      width: 100%;
      margin-top: 2rem;
      padding: 0.9rem;
      font-size: 1rem;
      font-weight: 600;
      border: none;
      border-radius: var(--radius);
      background-color: var(--bg-blue);
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #1d4ed8;
    }
    .back-button {
      display: inline-block;
      margin-bottom: 1rem;
      color: var(--bg-blue);
      font-size: 0.95rem;
      text-decoration: none;
      border: 1px solid var(--bg-blue);
      padding: 0.5rem 1rem;
      border-radius: var(--radius);
      transition: background-color 0.2s ease, color 0.2s ease;
    }
    .back-button:hover {
      background-color: var(--bg-blue);
      color: white;
    }
    .error-message {
      background-color: #fee2e2;
      color: #b91c1c;
      padding: 0.75rem 1rem;
      border-radius: var(--radius);
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }
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

<div class="form-container">
  <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

  <h1>Student registratie</h1>
  <p>Maak een studentenaccount aan om te starten</p>

  @php $allErrors = $errors->all(); @endphp
  @if (count($allErrors) > 0)
    <div class="error-message">
      <ul style="margin: 0; padding-left: 1rem;">
        @foreach ($allErrors as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ url('/register/student') }}">
    @csrf

    <!-- ✅ Changed: Voornaam -->
    <label for="voornaam">Voornaam</label>
    <input type="text" name="voornaam" id="voornaam" required>

    <!-- ✅ Changed: Achternaam -->
    <label for="achternaam">Achternaam</label>
    <input type="text" name="achternaam" id="achternaam" required>

    <!-- ✅ Email remains the same -->
    <label for="email">E-mailadres</label>
    <input type="email" name="email" id="email" required>

    <!-- ✅ Password -->
    <label for="password">Wachtwoord</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirmation">Herhaal wachtwoord</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <button type="submit">Registreren</button>
  </form>
</div>

</body>
</html>
