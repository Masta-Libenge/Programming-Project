@extends('layouts.base')

@section('title', 'Bedrijf Profiel')

@section('content')
<x-navbarbedrijf />

<script>
    function toggleEdit() {
        document.querySelectorAll('.view-mode').forEach(e => e.classList.add('hidden'));
        document.querySelectorAll('.edit-mode').forEach(e => e.classList.remove('hidden'));
        document.getElementById('editBtn').classList.add('hidden');
        document.getElementById('editActions').classList.remove('hidden');
    }

    function cancelEdit() {
        document.querySelectorAll('.view-mode').forEach(e => e.classList.remove('hidden'));
        document.querySelectorAll('.edit-mode').forEach(e => e.classList.add('hidden'));
        document.getElementById('editBtn').classList.remove('hidden');
        document.getElementById('editActions').classList.add('hidden');
    }
</script>

<div class="flex items-center justify-center px-4">
    <div class="bg-[#e0e5ec] rounded-3xl shadow-xl w-full max-w-2xl p-8 sm:p-10 mt-6">
        <form action="{{ route('bedrijf.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex justify-between items-center mb-6 flex-wrap gap-2">
                <div class="flex gap-2">
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
            </div>

            <!-- Bedrijfsnaam -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-[#1E40AF]">{{ $user->name }}</h1>
                <p class="text-gray-700 mt-1">E-mailadres:
                    <span class="view-mode">{{ $user->email }}</span>
                    <input type="email" name="email" class="hidden edit-mode w-full text-center bg-transparent outline-none" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </p>
            </div>

            <!-- Contactgegevens -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Contactgegevens</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Telefoon</label>
                        <span class="view-mode">{{ $user->telefoon ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="telefoon"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ old('telefoon', $user->telefoon) }}">
                        @error('telefoon')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Adres</label>
                        <span class="view-mode">{{ $user->adres ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="adres"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ old('adres', $user->adres) }}">
                        @error('adres')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </form>

        <!-- Logout -->
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
