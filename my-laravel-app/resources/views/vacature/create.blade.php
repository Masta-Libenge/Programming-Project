<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vacature Aanmaken - CareerLaunch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg: #f8fafc;
            --white: #ffffff;
            --accent: #0f172a;
            --primary: #3b82f6;
            --radius: 16px;
            --muted: #64748b;
            --shadow: 0 12px 24px rgba(0,0,0,0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            color: var(--accent);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .form-card {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 600px;
        }

        h1 {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--accent);
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            margin-top: 0.5rem;
            font-size: 1rem;
            background-color: #fff;
            transition: border-color 0.2s ease;
        }

        textarea {
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--primary);
            outline: none;
        }

        button {
            margin-top: 2rem;
            width: 100%;
            padding: 0.9rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2563eb;
        }

        .hint {
            font-size: 0.9rem;
            color: var(--muted);
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>

<div class="form-card">
    <h1>Vacature Aanmaken</h1>

    <form method="POST" action="{{ route('vacature.store') }}">
        @csrf

        <label for="title">Vacaturetitel</label>
        <input type="text" name="title" id="title" required>

        <label for="desc">Beschrijving</label>
        <textarea name="desc" id="desc" rows="5" required></textarea>

        <label for="type">Contracttype</label>
        <select name="type" id="type" required>
            <option value="Stage">Stage</option>
            <option value="Werknemer">Werknemer</option>
        </select>

        <label for="color">Kleur van kaart</label>
        <select name="color" id="color" required>
            <option value="#3b82f6">🔵 Blauw</option>
            <option value="#ef4444">🔴 Rood</option>
            <option value="#10b981">🟢 Groen</option>
            <option value="#facc15">🟡 Geel</option>
        </select>

        <button type="submit">Vacature Toevoegen</button>
    </form>
</div>

</body>
</html>
