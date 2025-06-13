@extends('layouts.app')

@section('title', 'Dashboard – Bedrijf')

@section('content')

<div class="container mx-auto px-4 py-8">

    <header class="flex justify-between items-center mb-10">
        <h1 class="text-2xl font-bold">Welkom {{ auth()->user()->name }}</h1>
        <a href="{{ route('logout') }}" class="text-blue-600 hover:underline font-medium text-lg"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Uitloggen
        </a>
    </header>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-6">
        <a href="{{ route('vacature.create') }}">
            <button class="bg-blue-600 text-white py-2 px-6 rounded-lg font-semibold transition-transform duration-200 hover:bg-blue-700 transform hover:scale-105">
                + Vacature aanmaken
            </button>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Ingeschreven studenten</h2>

        @forelse($students as $student)
            <div class="py-4 border-b border-gray-200 text-sm">
                👤 {{ $student->name }} – {{ $student->email }}
            </div>
        @empty
            <p class="text-gray-500">Er zijn nog geen studenten beschikbaar.</p>
        @endforelse
    </div>

</div>

@endsection

@push('scripts')
    <!-- Optional: Include any additional scripts you need here -->
@endpush
