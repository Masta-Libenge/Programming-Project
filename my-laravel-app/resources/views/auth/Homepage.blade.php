@extends('layouts.app')

@section('title', 'Vacatures')

@section('content')
<style>
    :root {
        --accent: #1e40af;
        --bg: #f1f5f9;
        --text: #0f172a;
        --muted: #64748b;
        --radius: 18px;
    }

    body {
        margin-top: 3rem;
        background-color: var(--bg);
        color: var(--text);
        font-family: 'Segoe UI', sans-serif;
    }

    .vacatures-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }

    .vacatures-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .vacatures-header h2 {
        font-size: 2.4rem;
        font-weight: 700;
        color: var(--accent);
    }

    .filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .filters input,
    .filters select {
        padding: 0.85rem 1rem;
        font-size: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: var(--radius);
        background-color: #f9fafb;
        min-width: 250px;
    }

    .vacature-card {
        background: white;
        padding: 1.5rem;
        border-radius: var(--radius);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 1.5rem;
    }

    .vacature-card h3 {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--accent);
        margin-bottom: 0.5rem;
    }

    .vacature-card p {
        color: var(--text);
    }

    .vacature-card button {
        margin-top: 1rem;
        padding: 0.75rem 1.4rem;
        background-color: var(--accent);
        color: white;
        border: none;
        border-radius: var(--radius);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .vacature-card button:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
    }
</style>

<div class="vacatures-container">
    <div class="vacatures-header">
        <h2>Vacatures beschikbaar</h2>
    </div>

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

    <div id="companyList">
        @foreach([
            ['name' => 'Oscorp', 'desc' => 'Ontwikkelt vaccins en geneesmiddelen om ziekten te voorkomen.', 'cat' => 'Gezondheid'],
            ['name' => 'TechNova', 'desc' => 'IT-bedrijf voor maatwerksoftware en digitale oplossingen.', 'cat' => 'IT'],
            ['name' => 'Stark Industries', 'desc' => 'High-tech oplossingen voor de defensie- en energiesector.', 'cat' => 'IT'],
            ['name' => 'NeuroSoft', 'desc' => 'AI-gedreven oplossingen voor de gezondheidszorgsector.', 'cat' => 'Gezondheid'],
            ['name' => 'GreenPulse', 'desc' => 'Start-up die slimme energiesystemen ontwikkelt.', 'cat' => 'Energie'],
            ['name' => 'PixelCore', 'desc' => 'Design studio gespecialiseerd in UX/UI en branding.', 'cat' => 'Design'],
            ['name' => 'EduLink', 'desc' => 'Onderwijsplatform voor interactieve online leerervaringen.', 'cat' => 'Educatie'],
        ] as $company)
            <div class="vacature-card" data-category="{{ $company['cat'] }}" data-name="{{ $company['name'] }}">
                <h3>{{ $company['name'] }}</h3>
                <p>{{ $company['desc'] }}</p>
                <button>Solliciteer</button>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const cards = document.querySelectorAll('[data-category]');

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
@endpush
