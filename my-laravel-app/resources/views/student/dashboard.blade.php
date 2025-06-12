<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard – CareerLaunch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #1e3a8a;
            --secondary: #3b82f6;
            --light-bg: #f8fafc;
            --dark-text: #0f172a;
            --muted: #64748b;
            --white: #ffffff;
            --radius: 14px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }

        header {
            background: linear-gradient(to right, var(--secondary), var(--primary));
            color: white;
            padding: 3rem 1rem 2rem;
            text-align: center;
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        header .subtitle {
            font-size: 1.1rem;
            margin-top: 0.5rem;
            color: #dbeafe;
        }

        .logout-btn {
            margin-top: 1rem;
            padding: 0.6rem 1.4rem;
            font-size: 0.9rem;
            font-weight: 600;
            background: white;
            color: var(--primary);
            border-radius: var(--radius);
            border: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .logout-btn:hover {
            background: #f1f5f9;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 2rem 1.5rem;
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .filters input, .filters select {
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius);
            font-size: 1rem;
        }

        .company-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .card {
            background: var(--white);
            padding: 1.8rem;
            border-radius: var(--radius);
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.03);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .card p {
            font-size: 0.95rem;
            color: var(--muted);
        }

        .card .meta {
            margin-top: 0.8rem;
            font-size: 0.85rem;
            color: var(--dark-text);
        }

        .actions {
            margin-top: 1rem;
            display: flex;
            gap: 0.5rem;
        }

        .apply-button, .favorite-button {
            flex: 1;
            padding: 0.6rem 1rem;
            font-weight: 600;
            border-radius: var(--radius);
            font-size: 0.9rem;
            cursor: pointer;
            border: none;
        }

        .apply-button {
            background: var(--primary);
            color: white;
        }

        .apply-button:hover {
            background: #1e40af;
        }

        .favorite-button {
            background: transparent;
            border: 1px solid red;
            color: red;
        }

        .favorite-button:hover {
            background: #ffe4e6;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 2rem;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Welkom, {{ auth()->user()->name }}</h1>
    <p class="subtitle">Je bent ingelogd als student</p>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</button>
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
                <div class="meta"><strong>Contracttype:</strong> {{ $vacature->type }}</div>
                <div class="actions">
                    <button class="apply-button">Apply</button>
                    <button class="favorite-button">❤️ Favoriet</button>
                </div>
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
