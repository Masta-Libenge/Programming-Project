<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8"> <!-- Character encoding -->
  <title>Inloggen als bedrijf – CareerLaunch</title> <!-- Page title -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet"> <!-- Google Inter font -->

  <style>
    :root {
      --bg-blue: #1E40AF;  /* Main blue color */
      --text-white: #ffffff; /* White text */
      --text-dark: #0f172a;  /* Dark text */
      --muted: #64748b;      /* Muted grey text */
      --radius: 16px;        /* Rounded corners */
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--bg-blue); /* Blue page background */
      font-family: 'Inter', sans-serif; /* Inter font */
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh; /* Full viewport height */
      padding: 2rem;     /* Padding for small screens */
      color: var(--text-dark); /* Dark text inside card */
    }

    .login-container {
      background: white;   /* White card background */
      border-radius: var(--radius); /* Rounded corners */
      padding: 3rem 2rem;  /* Inner spacing */
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1); /* Subtle shadow */
      width: 100%;
      max-width: 460px;    /* Max card width */
    }

    h1 {
      font-size: 2.2rem;   /* Large heading */
      font-weight: 800;    /* Bold */
      text-align: center;
      color: var(--bg-blue); /* Blue text */
      margin-bottom: 0.5rem; /* Space below */
    }

    p {
      font-size: 1rem;     /* Normal text size */
      text-align: center;
      color: var(--muted); /* Muted grey text */
      margin-bottom: 2rem; /* Space below */
    }

    label {
      font-weight: 600;    /* Semi-bold label */
      display: block;
      margin-bottom: 0.4rem;
      margin-top: 1.2rem;  /* Space above each label */
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.85rem;
      font-size: 1rem;
      border: 1px solid #e2e8f0;  /* Light grey border */
      border-radius: var(--radius);
      background-color: #f9fafb;  /* Light input background */
    }

    button {
      width: 100%;
      margin-top: 2rem;
      padding: 0.9rem;
      font-size: 1rem;
      font-weight: 600;
      border: none;
      border-radius: var(--radius);
      background-color: var(--bg-blue); /* Blue button */
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #172B87; /* Darker blue on hover */
    }

    .register-link {
      display: block;
      text-align: center;
      margin-top: 1.6rem;
      color: var(--bg-blue); /* Blue link */
      font-size: 0.95rem;
      text-decoration: none;
      font-weight: 600;
    }

    .register-link:hover {
      text-decoration: underline;
    }

    /* ✅ Back button styling */
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
      background-color: #fee2e2; /* Light red background */
      color: #991b1b;            /* Dark red text */
      padding: 1rem;
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- ✅ Back button: now goes to previous page dynamically -->
    <a href="{{ url()->previous() }}" class="back-button">← Terug</a>

    <h1>Login voor bedrijven</h1>
    <p>Beheer je vacatures en bereik studenten snel</p>

    <!-- ✅ Show validation errors if any -->
    @if ($errors->any())
      <div class="error-box">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <!-- ✅ Login form -->
    <form method="POST" action="{{ url('/login/bedrijf') }}">
      @csrf <!-- CSRF protection -->

      <label for="email">E-mailadres</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Wachtwoord</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Inloggen</button>
    </form>

    <!-- ✅ Link to bedrijf register page -->
    <a href="{{ route('register.bedrijf') }}" class="register-link">
      Nog geen account? Registreer hier
    </a>
  </div>

</body>
</html>
