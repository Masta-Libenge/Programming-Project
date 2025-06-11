@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="pt-18 h-screen bg-white px-4 py-10">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl font-semibold text-blue-700 text-center mb-10">Vacatures beschikbaar</h2>

        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <input type="text" id="searchInput" placeholder="Zoek bedrijf..." class="w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            <select id="categoryFilter" class="w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="all">Alle categorieën</option>
                <option value="IT">IT</option>
                <option value="Gezondheid">Gezondheid</option>
                <option value="Design">Design</option>
                <option value="Educatie">Educatie</option>
                <option value="Energie">Energie</option>
            </select>
        </div>

        <div class="space-y-6 max-h-[70vh] overflow-y-auto" id="companyList">
            @foreach([
                ['name' => 'Oscorp', 'desc' => 'Ontwikkelt vaccins en geneesmiddelen om ziekten te voorkomen.', 'cat' => 'Gezondheid'],
                ['name' => 'TechNova', 'desc' => 'IT-bedrijf voor maatwerksoftware en digitale oplossingen.', 'cat' => 'IT'],
                ['name' => 'Stark Industries', 'desc' => 'High-tech oplossingen voor de defensie- en energiesector.', 'cat' => 'IT'],
                ['name' => 'NeuroSoft', 'desc' => 'AI-gedreven oplossingen voor de gezondheidszorgsector.', 'cat' => 'Gezondheid'],
                ['name' => 'GreenPulse', 'desc' => 'Start-up die slimme energiesystemen ontwikkelt.', 'cat' => 'Energie'],
                ['name' => 'PixelCore', 'desc' => 'Design studio gespecialiseerd in UX/UI en branding.', 'cat' => 'Design'],
                ['name' => 'EduLink', 'desc' => 'Onderwijsplatform voor interactieve online leerervaringen.', 'cat' => 'Educatie'],
            ] as $company)
                <div class="bg-gray-50 p-6 rounded-xl shadow-md border border-gray-100" data-category="{{ $company['cat'] }}" data-name="{{ $company['name'] }}">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">{{ $company['name'] }}</h3>
                    <p class="text-gray-700">{{ $company['desc'] }}</p>
                    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">Apply</button>
                </div>
            @endforeach
        </div>
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
