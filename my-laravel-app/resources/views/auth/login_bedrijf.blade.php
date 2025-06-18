<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Inloggen als bedrijf – CareerLaunch</title>
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

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--bg-blue);
      font-family: 'Inter', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 2rem;
      color: var(--text-dark);
    }

    .login-container {
      background: white;
      border-radius: var(--radius);
      padding: 3rem 2rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 460px;
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

    .error-box {
      background-color: #fee2e2;
      color: #991b1b;
      padding: 1rem;
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <a href="{{ url('/') }}" class="back-button">← Terug</a>

    <h1>Login voor bedrijven</h1>
    <p>Beheer je vacatures en bereik studenten snel</p>

    @if ($errors->any())
      <div class="error-box">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ url('/login/bedrijf') }}">
      @csrf

      <label for="email">E-mailadres</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Wachtwoord</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Inloggen</button>
    </form>

    <a href="{{ route('register.bedrijf') }}" class="register-link">
      Nog geen account? Registreer hier
    </a>
  </div>

</body>
</html>
