<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Login – CareerLaunch</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-blue: #1E40AF;
      --white: #ffffff;
      --dark: #0f172a;
      --muted: #94a3b8;
      --accent: #3b82f6;
      --radius: 16px;
    }

    body {
      background-color: var(--bg-blue);
      font-family: 'Inter', sans-serif;
      color: var(--white);
    }

    .login-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 2rem;
    }

    .login-card {
      background-color: var(--white);
      color: var(--dark);
      border-radius: var(--radius);
      padding: 2.5rem 2rem;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 15px 40px rgba(0,0,0,0.15);
      text-align: center;
      position: relative;
    }

    .back-button {
      display: inline-block;
      margin-bottom: 1.2rem;
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

    h1 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--accent);
    }

    p {
      color: var(--muted);
      margin-bottom: 1.5rem;
    }

    .error-message {
      color: red;
      margin-bottom: 1rem;
      font-size: 0.95rem;
      background: #fee2e2;
      padding: 0.75rem;
      border-radius: 10px;
      text-align: left;
    }

    form {
      text-align: left;
    }

    label {
      font-weight: 600;
      display: block;
      margin-top: 1.2rem;
    }

    input {
      width: 100%;
      padding: 0.8rem;
      margin-top: 0.3rem;
      border: 1px solid #e2e8f0;
      border-radius: var(--radius);
      font-size: 1rem;
      background: #f9fafb;
    }

    button[type="submit"] {
      margin-top: 1.5rem;
      width: 100%;
      background: var(--accent);
      color: var(--white);
      border: none;
      padding: 0.9rem;
      font-size: 1rem;
      font-weight: 600;
      border-radius: var(--radius);
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button[type="submit"]:hover {
      background: #2563eb;
    }

    .register-toggle {
      background: none;
      color: var(--accent);
      font-weight: 600;
      border: none;
      margin-top: 1.5rem;
      margin-bottom: 0.5rem;
      font-size: 0.95rem;
      cursor: pointer;
      text-decoration: underline;
      transition: color 0.3s ease;
    }

    .register-toggle:hover {
      color: #2563eb;
    }

    .register-options {
      display: none;
      flex-direction: column;
      background-color: #f1f5f9;
      padding: 1rem;
      border-radius: var(--radius);
      margin-bottom: 1.2rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      text-align: left;
      animation: fadeIn 0.3s ease-out forwards;
    }

    .register-options a {
      color: var(--accent);
      font-weight: 600;
      text-decoration: none;
      margin-bottom: 0.5rem;
      display: block;
      transition: color 0.3s ease;
    }

    .register-options a:hover {
      color: #2563eb;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body>

  <div class="login-wrapper">
    <div class="login-card">
      <!-- ✅ Terug button à l’intérieur du cadre -->
      <div style="text-align: left;">
        <a href="{{ url()->previous() }}" class="back-button">← Terug</a>
      </div>

      <h1>Login</h1>
      <p>Log in om toegang te krijgen tot je dashboard</p>

      @if ($errors->any())
        <div class="error-message">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">E-mailadres</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" required>

        <button type="button" class="register-toggle" onclick="toggleDropdown()">Nieuw? Maak een account aan</button>

        <div class="register-options" id="registerOptions">
          <a href="{{ url('/register/student') }}">Registreer als student</a>
          <a href="{{ url('/register/bedrijf') }}">Registreer als bedrijf</a>
        </div>

        <button type="submit">Inloggen</button>
      </form>
    </div>
  </div>

  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('registerOptions');
      dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
    }
  </script>

</body>
</html>
