@extends('layouts.base')

@section('title', 'Bedrijf Profiel')

@section('content')
<x-navbarbedrijf />

<script>
    function toggleEdit() {
        document.querySelectorAll('.view-mode').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.edit-mode').forEach(el => el.classList.remove('hidden'));
        document.getElementById('editBtn').classList.add('hidden');
        document.getElementById('editActions').classList.remove('hidden');
    }

    function cancelEdit() {
        document.querySelectorAll('.view-mode').forEach(el => el.classList.remove('hidden'));
        document.querySelectorAll('.edit-mode').forEach(el => el.classList.add('hidden'));
        document.getElementById('editBtn').classList.remove('hidden');
        document.getElementById('editActions').classList.add('hidden');
    }
</script>

<div class="flex items-center justify-center px-4">
    <div class="bg-[#e0e5ec] rounded-3xl shadow-xl w-full max-w-3xl p-8 sm:p-10 mt-6">

        <form action="{{ route('bedrijf.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

           
            <div class="flex justify-between items-center mb-6 flex-wrap gap-2">
                <button type="button" id="editBtn"
                    onclick="toggleEdit()"
                    class="bg-[#1E40AF] text-white text-sm px-4 py-2 rounded-full shadow">
                    Bewerken
                </button>

                <div id="editActions" class="hidden flex gap-2">
                    <button type="submit"
                        class="bg-green-600 text-white text-sm px-4 py-2 rounded-full shadow">
                        Opslaan
                    </button>
                    <button type="button"
                        onclick="cancelEdit()"
                        class="bg-red-500 text-white text-sm px-4 py-2 rounded-full shadow">
                        Annuleren
                    </button>
                </div>
            </div>

            <!-- Logo + Bedrijfsnaam -->
            <div class="flex flex-col items-center mb-6">
                <label class="cursor-pointer">
                    <div class="w-24 h-24 rounded-full border-4 border-[#1E40AF] flex items-center justify-center text-sm text-[#1E40AF] bg-white overflow-hidden">
                        @if ($user->profile_picture)
                            <img src="{{ asset($user->profile_picture) }}" alt="Logo" class="w-full h-full object-cover">
                        @else
                            <span class="view-mode">Upload logo</span>
                        @endif
                        <input name="profile_picture" type="file" accept="image/*" class="hidden edit-mode" />
                    </div>
                </label>
                <h1 class="text-2xl font-bold text-[#1E40AF] mt-2">{{ $user->name }}</h1>
            </div>

            <!-- Bedrijfsinformatie -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Bedrijfsinformatie</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Omschrijving</label>
                        <span class="view-mode">{{ $user->omschrijving ?? 'Nog niet ingevuld' }}</span>
                        <textarea name="omschrijving" class="hidden edit-mode w-full text-center bg-transparent outline-none resize-none" rows="3">{{ $user->omschrijving }}</textarea>
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Website</label>
                        <span class="view-mode">{{ $user->website ?? 'Nog niet ingevuld' }}</span>
                        <input type="url" name="website" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->website }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Sociale media links</label>
                        <span class="view-mode">{{ $user->sociale_media ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="sociale_media" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->sociale_media }}">
                    </div>
                </div>
            </div>

          
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Contactgegevens</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Straat</label>
                        <span class="view-mode">{{ $user->straat ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="straat" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->straat }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Nummer</label>
                        <span class="view-mode">{{ $user->nummer ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="nummer" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->nummer }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Postcode</label>
                        <span class="view-mode">{{ $user->postcode ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="postcode" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->postcode }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Stad</label>
                        <span class="view-mode">{{ $user->stad ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="stad" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->stad }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Telefoon</label>
                        <span class="view-mode">{{ $user->telefoon ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="telefoon" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->telefoon }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">E-mailadres</label>
                        <span class="view-mode">{{ $user->email }}</span>
                        <input type="email" name="email" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ $user->email }}">
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" 
                class="bg-gray-600 text-white text-sm px-4 py-2 rounded-full shadow">
                Uitloggen
            </button>
        </form>
    </div>
</div>

@endsection
