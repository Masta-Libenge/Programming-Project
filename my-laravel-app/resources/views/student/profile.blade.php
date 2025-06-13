<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren als student – CareerLaunch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- 🎨 Basic styling for layout, form, and card preview --}}
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

        input, textarea, select {
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

        .preview-card {
            margin-top: 2rem;
            border-radius: var(--radius);
            padding: 1rem;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Student Profiel</h1>
    <p>Pas je profiel aan en sla je wijzigingen op</p>

    {{-- ✅ Toon validatiefouten als die er zijn --}}
    @if ($errors->any())
        <div class="error-message">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 🧾 Profiel bewerkingsformulier --}}
    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- 📷 Profielfoto uploadveld --}}
        <label for="photo">Profielfoto</label>
        <input type="file" name="photo" id="photo">

        {{-- 📝 Beschrijvingstekst --}}
        <label for="description">Beschrijving</label>
        <textarea name="description" id="description" rows="3" placeholder="Vertel iets over jezelf...">{{ old('description') }}</textarea>

        {{-- 🎨 Kleurkeuze voor de kaart --}}
        <label for="color">Kaartkleur</label>
        <select name="color" id="color">
            <option value="#1e40af" @selected(old('color') == '#1e40af')>Blauw</option>
            <option value="#16a34a" @selected(old('color') == '#16a34a')>Groen</option>
            <option value="#dc2626" @selected(old('color') == '#dc2626')>Rood</option>
            <option value="#7c3aed" @selected(old('color') == '#7c3aed')>Paars</option>
            <option value="#f97316" @selected(old('color') == '#f97316')>Oranje</option>
        </select>

        {{-- 💾 Opslaan knop --}}
        <button type="submit">Opslaan</button>
    </form>

    {{-- 🧩 Live preview van de profielkaart --}}
    <div class="preview-card" style="background-color: {{ old('color', '#1e40af') }}">
        <p><strong>Jouw beschrijving:</strong></p>
        <p>{{ old('description', 'Nog niets ingevuld.') }}</p>
    </div>
</div>

</body>
</html>
