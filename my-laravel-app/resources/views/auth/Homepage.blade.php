<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #e0f0ff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #2c3e50;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            padding: 2rem;
            width: 100%;
            max-width: 1000px;
        }

        h2 {
            text-align: center;
            color: #004080;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .filters input[type="text"], .filters select {
            padding: 0.6rem;
            border-radius: 10px;
            border: none;
            box-shadow: inset 4px 4px 8px #c0d6e4, inset -4px -4px 8px #ffffff;
        }

        .company-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .card {
            background: #f0f8ff;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 8px 8px 16px #c0d6e4, -8px -8px 16px #ffffff;
        }

        .card h3 {
            margin: 0 0 0.5rem 0;
            color: #004080;
        }

        .card p {
            margin: 0;
            color: #2c3e50;
        }

        .apply-button {
            margin-top: 1rem;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 4px 4px 8px #bdd0e0, -4px -4px 8px #ffffff;
            color: #004080;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .apply-button:hover {
            background: #d0e7ff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Vacatures beschikbaar</h2>
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
        <div class="card" data-category="Gezondheid" data-name="Oscorp">
            <h3>Oscorp</h3>
            <p>Ontwikkelt vaccins en geneesmiddelen om ziekten te voorkomen.</p>
            <button class="apply-button">Apply</button>
        </div>
        <div class="card" data-category="IT" data-name="TechNova">
            <h3>TechNova</h3>
            <p>IT-bedrijf voor maatwerksoftware en digitale oplossingen.</p>
            <button class="apply-button">Apply</button>
        </div>
        <div class="card" data-category="IT" data-name="Stark Industries">
            <h3>Stark Industries</h3>
            <p>High-tech oplossingen voor de defensie- en energiesector.</p>
            <button class="apply-button">Apply</button>
        </div>
        <div class="card" data-category="Gezondheid" data-name="NeuroSoft">
            <h3>NeuroSoft</h3>
            <p>AI-gedreven oplossingen voor de gezondheidszorgsector.</p>
            <button class="apply-button">Apply</button>
        </div>
        <div class="card" data-category="Energie" data-name="GreenPulse">
            <h3>GreenPulse</h3>
            <p>Start-up die slimme energiesystemen ontwikkelt.</p>
            <button class="apply-button">Apply</button>
        </div>
        <div class="card" data-category="Design" data-name="PixelCore">
            <h3>PixelCore</h3>
            <p>Design studio gespecialiseerd in UX/UI en branding.</p>
            <button class="apply-button">Apply</button>
        </div>
        <div class="card" data-category="Educatie" data-name="EduLink">
            <h3>EduLink</h3>
            <p>Onderwijsplatform voor interactieve online leerervaringen.</p>
            <button class="apply-button">Apply</button>
        </div>
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

            const matchesSearch = name.includes(search);
            const matchesCategory = category === 'all' || cat === category;

            card.style.display = (matchesSearch && matchesCategory) ? 'block' : 'none';
        });
    }

    searchInput.addEventListener('input', filterCards);
    categoryFilter.addEventListener('change', filterCards);
</script>
@endverbatim
</body>
</html>