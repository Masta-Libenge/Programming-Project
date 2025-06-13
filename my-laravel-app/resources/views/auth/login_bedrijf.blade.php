<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen als bedrijf – CareerLaunch</title>
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
        <h1>Bedrijf login</h1>
        <p>Log in om vacatures te beheren en studenten te bereiken</p>

        {{-- 🛑 Error messages will show up here if something goes wrong --}}
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
