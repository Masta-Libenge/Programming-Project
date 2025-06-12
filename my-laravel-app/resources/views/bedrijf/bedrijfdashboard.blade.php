<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bedrijf Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 2rem;
            color: #1e293b;
        }

        h1 {
            font-size: 1.8rem;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logout-link {
            color: #2563eb;
            text-decoration: none;
        }

        .student-list {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .student-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .create-button {
            background: #2563eb;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }

        .create-button:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <h1>Welkom, {{ auth()->user()->name }} (bedrijf)</h1>
    <a href="{{ route('logout') }}"
       class="logout-link"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Uitloggen
    </a>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Plus knop voor vacature aanmaken -->
<div style="margin-bottom: 2rem;">
    <a href="{{ route('vacature.create') }}">
        <button class="create-button">+ Vacature aanmaken</button>
    </a>
</div>

<!-- Studentenlijst -->
<div class="student-list">
    <h2>Ingeschreven studenten</h2>

    @forelse($students as $student)
        <div class="student-item">
            👤 {{ $student->name }} – {{ $student->email }}
        </div>
    @empty
        <p>Er zijn nog geen studenten gevonden.</p>
    @endforelse
</div>

@if (session('success'))
    <div style="padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif


</body>
</html>
