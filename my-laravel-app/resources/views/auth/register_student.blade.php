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

    .form-container {
      background: white;
      border-radius: var(--radius);
      padding: 3rem 2rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 480px;
      margin: 2rem auto;
    }

    h1 {
      font-size: 2.4rem;
      font-weight: 800;
      text-align: center;
      color: var(--bg-blue);
      margin-bottom: 1rem;
    }

    label {
      font-weight: 600;
      font-size: 0.95rem;
      margin-top: 1.2rem;
      display: block;
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
  </style>
</head>
<body>

<div class="form-container">
  <!-- ✅ Terug button ajouté ici -->
  <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

  <h1>Student registratie</h1>

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

    <label for="voornaam">Voornaam</label>
    <input type="text" name="voornaam" id="voornaam" required>

    <label for="achternaam">Achternaam</label>
    <input type="text" name="achternaam" id="achternaam" required>

    <label for="opleiding">Opleiding</label>
    <input type="text" name="opleiding" id="opleiding">

    <label for="jaar">Jaar</label>
    <input type="text" name="jaar" id="jaar">

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
