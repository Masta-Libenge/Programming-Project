@extends('layouts.base')

@section('title', 'Student Profiel (Bedrijf)')

@section('content')
<x-navbar />

<div class="max-w-3xl mx-auto bg-white shadow rounded-xl p-8 mt-6">
    <h1 class="text-2xl font-bold text-[#1E40AF] mb-4">Profiel van {{ $student->name }}</h1>

    <div class="flex flex-col items-center mb-6">
        @if ($student->profile_picture)
            <img src="{{ asset($student->profile_picture) }}" alt="Profielfoto"
                class="w-32 h-32 rounded-full object-cover border-4 border-[#1E40AF] mb-4">
        @else
            <div class="w-32 h-32 rounded-full border-4 border-[#1E40AF] flex items-center justify-center text-[#1E40AF] bg-gray-100 mb-4">
                Geen foto
            </div>
        @endif
        <p class="text-lg font-semibold">{{ $student->email }}</p>
    </div>

    <div class="space-y-4">
        <div>
            <h2 class="text-[#1E40AF] font-semibold">Opleiding</h2>
            <p>{{ $student->opleiding ?? 'Niet ingevuld' }}</p>
        </div>

        <div>
            <h2 class="text-[#1E40AF] font-semibold">Jaar</h2>
            <p>{{ $student->jaar ?? 'Niet ingevuld' }}</p>
        </div>

        <div>
            <h2 class="text-[#1E40AF] font-semibold">Vaardigheden</h2>
            <p>{{ $student->vaardigheden ?? 'Niet ingevuld' }}</p>
        </div>

        <div>
            <h2 class="text-[#1E40AF] font-semibold">Beschrijving</h2>
            <p>{{ $student->profile->description ?? 'Niet ingevuld' }}</p>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="inline-block mt-6 text-white bg-[#1E40AF] px-4 py-2 rounded-full shadow">
        ← Terug
    </a>
</div>
@endsection
