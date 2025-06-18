<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Registreren als student – CareerLaunch</title>
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

    .form-container {
      background: var(--card-bg);
      border-radius: var(--radius);
      padding: 3rem 2rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
      width: 100%;
      max-width: 480px;
    }

    h1 {
      font-size: 2.4rem;
      font-weight: 800;
      text-align: center;
      color: var(--primary);
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
      background-color: var(--primary);
      color: white;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #1d4ed8;
      transform: translateY(-1px);
    }

    .error-message {
      background-color: #fee2e2;
      color: #b91c1c;
      padding: 0.75rem 1rem;
      border-radius: var(--radius);
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }

    .back-button {
      display: inline-block;
      margin-bottom: 1.2rem;
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
  </style>
</head>
<body>

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

    <label for="name">Naam</label>
    <input type="text" name="name" id="name" required>

    <label for="email">E-mailadres</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Wachtwoord</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirmation">Herhaal wachtwoord</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <button type="submit">Registreren</button>
  </form>
</div>

</body>
</html>
