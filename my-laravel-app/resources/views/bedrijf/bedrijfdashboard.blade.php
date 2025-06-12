<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard – Bedrijf</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --accent: #1e3a8a;
            --light: #f8fafc;
            --white: #ffffff;
            --muted: #64748b;
            --radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--light);
            font-family: 'Segoe UI', sans-serif;
            color: #0f172a;
            padding: 3rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 1000px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        header h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        .logout {
            text-decoration: none;
            color: var(--accent);
            font-weight: 500;
            font-size: 1rem;
        }

        .logout:hover {
            text-decoration: underline;
        }

        .success {
            padding: 1rem;
            background-color: #d1fae5;
            color: #065f46;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
        }

        .action-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.5rem;
        }

        .create-button {
            background-color: var(--accent);
            color: white;
            padding: 0.8rem 1.4rem;
            border: none;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .create-button:hover {
            background-color: #1d4ed8;
            transform: scale(1.03);
        }

        .students {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: 0 6px 20px rgba(0,0,0,0.04);
            padding: 2rem;
        }

        .students h2 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .student {
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 1rem;
        }

        .student:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>

<div class="container">

    <header>
        <h1>Welkom {{ auth()->user()->name }}</h1>
        <a href="{{ route('logout') }}" class="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a>
    </header>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="action-bar">
        <a href="{{ route('vacature.create') }}">
            <button class="create-button">+ Vacature aanmaken</button>
        </a>
    </div>

    <div class="students">
        <h2>Ingeschreven studenten</h2>

        @forelse($students as $student)
            <div class="student">
                👤 {{ $student->name }} – {{ $student->email }}
            </div>
        @empty
            <p style="color: var(--muted);">Er zijn nog geen studenten beschikbaar.</p>
        @endforelse
    </div>

</div>

</body>
</html>
