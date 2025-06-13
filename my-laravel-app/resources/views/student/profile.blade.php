@extends('layouts.app')

@section('title', 'Profiel')

@section('content')
<div class="px-6 pt-32 pb-20 bg-white min-h-screen text-gray-800">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-800 mb-10">Mijn Profiel</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12 text-base">
            <div>
                <p class="text-sm text-gray-500 uppercase">Naam</p>
                <p class="mt-1 font-medium">{{ Auth::user()->name }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase">E-mail</p>
                <p class="mt-1 font-medium">{{ Auth::user()->email }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase">Rol</p>
                <p class="mt-1 font-medium">
                    {{ Auth::user()->type ?? 'Niet gespecificeerd' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 uppercase">Lid sinds</p>
                <p class="mt-1 font-medium">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="mt-12 flex items-center gap-4 buttons">
            <a>
                Profiel Bewerken
            </a>
        </div>
    </div>
</div>
@endsection
