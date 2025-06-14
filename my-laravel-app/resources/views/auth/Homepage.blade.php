@extends('layouts.app')

@section('title', 'Vacatures')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-blue-600">Vacatures beschikbaar</h2>
    </div>

    <div class="flex justify-center gap-4 mb-8">
        <input type="text" id="searchInput" placeholder="Zoek bedrijf..." class="py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-80">
        <select id="categoryFilter" class="py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-80">
            @foreach($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($vacatures as $vacature)
            <div class="vacature-card w-[350px] h-[350px] bg-white rounded-lg shadow-md border border-gray-200 flex flex-col justify-between p-4" data-category="{{ $vacature['type'] }}" data-name="{{ $vacature['title'] }}">
                <div class="flex justify-between items-start mb-3">
                    <h2 class="text-2xl font-semibold text-blue-600">{{ $vacature['title'] }}</h2>
                    <p class="text-2xl font-semibold italic text-gray-700 text-sm">{{ $vacature->bedrijf->name }}</p>
                </div>
                <p class="text-gray-700 text-sm flex-grow mb-4">{{ \Illuminate\Support\Str::limit($vacature['desc'], 450, '...') }}</p>
                <div class="mt-auto flex items-center buttons">
                    @php
                        $alreadyApplied = auth()->user()->sollicitaties->contains($vacature->id);
                    @endphp

                    <form action="{{ route('vacature.solliciteer', $vacature->id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full cursor-pointer {{ $alreadyApplied ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }} text-white font-semibold py-2 px-4 rounded"
                            {{ $alreadyApplied ? 'disabled' : '' }}>
                            {{ $alreadyApplied ? 'Al gesolliciteerd' : 'Solliciteer' }}
                        </button>
                    </form>
                </div>
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
            const matchesCategory = category === 'Alle vacatures' || cat === category;

            card.style.display = (matchesSearch && matchesCategory) ? 'block' : 'none';
        });
    }

    searchInput.addEventListener('input', filterCards);
    categoryFilter.addEventListener('change', filterCards);
</script>
@endpush
