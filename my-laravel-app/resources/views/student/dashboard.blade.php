<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --bg: #f9fafb;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --card-bg: #ffffff;
            --border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            line-height: 1.6;
        }

        header.hero-header {
            background: linear-gradient(to right, var(--primary-light), var(--primary));
            color: white;
            text-align: center;
            padding: 3rem 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .avatar-circle {
            width: 64px;
            height: 64px;
            background: #1e3a8a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            font-weight: bold;
            color: white;
            margin: 0 auto 1rem;
        }

        .header-content h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .header-content .subtitle {
            font-size: 1rem;
            color: #dbeafe;
            margin-bottom: 1.2rem;
        }

        .logout-btn {
            background: white;
            color: var(--primary);
            border: none;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .logout-btn:hover {
            background: #f0f9ff;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 2rem 1rem;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .filters input, .filters select {
            padding: 0.7rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            flex: 1;
            min-width: 200px;
        }

        .company-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .card {
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--border);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            color: var(--text-dark);
        }

        .card p {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .apply-button, .favorite-button {
            margin-top: 1rem;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s ease;
            border: none;
        }

        .apply-button {
            background: var(--primary);
            color: white;
        }

        .apply-button:hover {
            background: #1d4ed8;
        }

        .favorite-button {
            background: #fff;
            color: red;
            border: 1px solid red;
            margin-left: 0.5rem;
        }

        .favorite-button:hover {
            background: #ffe4e6;
        }

        @media (max-width: 600px) {
            .filters {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

<header class="hero-header">
    <div class="header-content">
        <div class="avatar-circle">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <h1>Welkom, {{ auth()->user()->name }}</h1>
        <p class="subtitle">Je bent ingelogd als student</p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Uitloggen
        </button>
    </div>
</header>

<div class="container">
    <div class="filters">
        <input type="text" id="searchInput" placeholder="Zoek vacature...">
        <select id="categoryFilter">
            <option value="all">Alle types</option>
            <option value="Stage">Stage</option>
            <option value="Werknemer">Werknemer</option>
        </select>
    </div>

    <div class="company-list" id="companyList">
        @forelse($vacatures as $vacature)
            <div class="card"
                 style="background-color: {{ $vacature->color }};"
                 data-category="{{ $vacature->type }}"
                 data-name="{{ $vacature->title }}">
                <h3>{{ $vacature->title }}</h3>
                <p>{{ $vacature->desc }}</p>
                <p><strong>Contracttype:</strong> {{ $vacature->type }}</p>
                <button class="apply-button">Apply</button>
                <button class="favorite-button">❤️ Favoriet</button>
            </div>
        @empty
            <p>Er zijn momenteel geen vacatures beschikbaar.</p>
        @endforelse
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');

    function filterCards() {
        const search = searchInput.value.toLowerCase();
        const category = categoryFilter.value;
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const name = card.getAttribute('data-name').toLowerCase();
            const cat = card.getAttribute('data-category');
            card.style.display = (name.includes(search) && (category === 'all' || cat === category)) ? 'block' : 'none';
        });
    }

    searchInput.addEventListener('input', filterCards);
    categoryFilter.addEventListener('change', filterCards);
</script>

</body>
</html>
