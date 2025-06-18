<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Inloggen als student – CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #1E40AF;
      --bg: #1E40AF;
      --card-bg: #ffffff;
      --text: #0f172a;
      --muted: #64748b;
      --radius: 16px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--bg);
      font-family: 'Inter', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 2rem;
      color: var(--text);
    }

    .login-container {
      background: var(--card-bg);
      border-radius: var(--radius);
      padding: 3rem 2rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
      width: 100%;
      max-width: 460px;
    }

    h1 {
      font-size: 2.2rem;
      font-weight: 800;
      text-align: center;
      color: var(--primary);
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
      background-color: var(--primary);
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
      color: var(--primary);
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
      color: var(--primary);
      font-size: 0.95rem;
      text-decoration: none;
      border: 1px solid var(--primary);
      padding: 0.5rem 1rem;
      border-radius: var(--radius);
      transition: background-color 0.2s ease, color 0.2s ease;
    }

    .back-button:hover {
      background-color: var(--primary);
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

    .error-message ul {
      margin: 0;
      padding-left: 1rem;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

    <h1>Student login</h1>
    <p>Log in om toegang te krijgen tot jouw persoonlijke dashboard</p>

    @if ($errors->has('login'))
      <div class="error-message" style="text-align: center;">
        {{ $errors->first('login') }}
      </div>
    @endif

    @php
      $allErrors = $errors->all();
      $loginError = $errors->first('login');
      $otherErrors = array_filter($allErrors, fn($e) => $e !== $loginError);
    @endphp

    @if (count($otherErrors) > 0)
      <div class="error-message">
        <ul>
          @foreach ($otherErrors as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ url('/login/student') }}">
      @csrf

      <label for="email">E-mailadres</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Wachtwoord</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Inloggen</button>
    </form>

    <a href="{{ url('/register_student') }}" class="register-link">
      Nog geen account? Registreer hier
    </a>
  </div>

</body>
</html>
