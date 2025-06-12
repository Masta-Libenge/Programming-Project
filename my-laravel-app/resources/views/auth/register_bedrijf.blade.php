<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren als bedrijf – CareerLaunch</title>
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

        .form-container {
            background: white;
            border-radius: var(--radius);
            padding: 3rem 2rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 480px;
        }

        .form-container h1 {
            font-size: 2.4rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
        }

        .form-container p {
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
            background-color: var(--accent);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Registreer je bedrijf</h1>
    <p>Vul de onderstaande gegevens in om te starten</p>

    <form method="POST" action="{{ url('/register/bedrijf') }}">
        @csrf

        <label for="company_name">Bedrijfsnaam</label>
        <input type="text" name="company_name" id="company_name" required>

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
