@extends('layouts.app')

@section('title', 'Homepage')

@push('styles')
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
@endpush

@section('content')
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
@endsection

@push('scripts')
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
@endpush
