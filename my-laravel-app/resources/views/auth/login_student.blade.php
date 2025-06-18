<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Inloggen als student – CareerLaunch</title>
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
    .login-container {
      background: white;
      border-radius: var(--radius);
      padding: 3rem 2rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
      width: 100%;
      max-width: 460px;
      margin: 0 auto;
      margin-top: 1rem; /* réduit la marge haute */
    }
    h1 {
      font-size: 2.2rem;
      font-weight: 800;
      text-align: center;
      color: var(--bg-blue);
      margin-bottom: 0.5rem;
    }
    p {
      font-size: 1rem;
      text-align: center;
      color: var(--muted);
      margin-bottom: 2rem;
    }
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 0.4rem;
      margin-top: 1.2rem;
    }
    input[type="email"],
    input[type="password"] {
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
      background-color: #172B87;
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
    .register-link {
      display: block;
      text-align: center;
      margin-top: 1.6rem;
      color: var(--bg-blue);
      font-size: 0.95rem;
      text-decoration: none;
      font-weight: 600;
    }
    .register-link:hover {
      text-decoration: underline;
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

<div class="login-container">
  <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

  <h1>Student login</h1>
  <p>Log in om toegang te krijgen tot jouw persoonlijke dashboard</p>

  <form method="POST" action="{{ url('/login/student') }}">
    @csrf
    <label for="email">E-mailadres</label>
    <input type="email" name="email" id="email" required>
    <label for="password">Wachtwoord</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Inloggen</button>
  </form>

  <a href="{{ url('/register_student') }}" class="register-link">Nog geen account? Registreer hier</a>
</div>

</body>
</html>
