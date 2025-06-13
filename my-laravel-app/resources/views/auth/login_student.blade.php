<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen als student – CareerLaunch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --accent: #1e40af;
            --bg: #f1f5f9;
            --text: #0f172a;
            --muted: #64748b;
            --radius: 18px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
            color: var(--text);
        }

        .login-container {
            background: white;
            border-radius: var(--radius);
            padding: 3rem 2rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 460px;
        }

        .login-container h1 {
            font-size: 2.4rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.6rem;
        }

        .login-container p {
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
            background-color: var(--accent);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 1.6rem;
            color: var(--accent);
            font-size: 0.95rem;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
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
            color: var(--accent);
            font-size: 0.95rem;
            text-decoration: none;
            border: 1px solid var(--accent);
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .back-button:hover {
            background-color: var(--accent);
            color: white;
        }
    </style>
</head>
<body>

<div class="login-container">

    {{-- 🔙 Back to home button --}}
    <a href="{{ url('/') }}" class="back-button">← Terug</a>

    <h1>Student login</h1>
    <p>Log in om toegang te krijgen tot jouw persoonlijke dashboard</p>

    {{-- ✅ Show login-specific error (e.g. wrong credentials) --}}
    @if ($errors->has('login'))
        <div class="error-message" style="text-align: center;">
            {{ $errors->first('login') }}
        </div>
    @endif

    {{-- ✅ Show all other validation errors, if any --}}
    @php
        $allErrors = $errors->all();
        $loginError = $errors->first('login');
        $otherErrors = array_filter($allErrors, fn($e) => $e !== $loginError);
    @endphp

    @if (count($otherErrors) > 0)
        <div class="error-message" style="text-align: left;">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach ($otherErrors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 🧾 Login form --}}
    <form method="POST" action="{{ url('/login/student') }}">
        @csrf

        <label for="email">E-mailadres</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Inloggen</button>
    </form>

    {{-- 🧭 Link to registration page --}}
    <a href="{{ url('/register_student') }}" class="register-link">
        Nog geen account? Registreer hier
    </a>
</div>

</body>
</html>
