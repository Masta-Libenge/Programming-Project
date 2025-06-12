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

        /* ==== HEADER ==== */
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

        /* ==== CONTAINER ==== */
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
            background: var(--card-bg);
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

        .apply-button {
            margin-top: 1rem;
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .apply-button:hover {
            background: #1d4ed8;
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
        <input type="text" id="searchInput" placeholder="Zoek bedrijf...">
        <select id="categoryFilter">
            <option value="all">Alle categorieën</option>
            <option value="IT">IT</option>
            <option value="Gezondheid">Gezondheid</option>
            <option value="Design">Design</option>
            <option value="Educatie">Educatie</option>
            <option value="Energie">Energie</option>
        </select>
    </div>

    <div class="company-list" id="companyList">
        @foreach([
            ['name' => 'Oscorp', 'desc' => 'Ontwikkelt vaccins en geneesmiddelen om ziekten te voorkomen.', 'cat' => 'Gezondheid'],
            ['name' => 'TechNova', 'desc' => 'IT-bedrijf voor maatwerksoftware en digitale oplossingen.', 'cat' => 'IT'],
            ['name' => 'Stark Industries', 'desc' => 'High-tech oplossingen voor de defensie- en energiesector.', 'cat' => 'IT'],
            ['name' => 'NeuroSoft', 'desc' => 'AI-gedreven oplossingen voor de gezondheidszorgsector.', 'cat' => 'Gezondheid'],
            ['name' => 'GreenPulse', 'desc' => 'Start-up die slimme energiesystemen ontwikkelt.', 'cat' => 'Energie'],
            ['name' => 'PixelCore', 'desc' => 'Design studio gespecialiseerd in UX/UI en branding.', 'cat' => 'Design'],
            ['name' => 'EduLink', 'desc' => 'Onderwijsplatform voor interactieve online leerervaringen.', 'cat' => 'Educatie'],
        ] as $company)
            <div class="card" data-category="{{ $company['cat'] }}" data-name="{{ $company['name'] }}">
                <h3>{{ $company['name'] }}</h3>
                <p>{{ $company['desc'] }}</p>
                <button class="apply-button">Apply</button>
            </div>
        @endforeach
    </div>
</div>

@verbatim
<script>
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const cards = document.querySelectorAll('.card');

    function filterCards() {
        const search = searchInput.value.toLowerCase();
        const category = categoryFilter.value;

        cards.forEach(card => {
            const name = card.getAttribute('data-name').toLowerCase();
            const cat = card.getAttribute('data-category');
            card.style.display = (name.includes(search) && (category === 'all' || cat === category)) ? 'block' : 'none';
        });
    }

    searchInput.addEventListener('input', filterCards);
    categoryFilter.addEventListener('change', filterCards);
</script>
@endverbatim

</body>
</html>
