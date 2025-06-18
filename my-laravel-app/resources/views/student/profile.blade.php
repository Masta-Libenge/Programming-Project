@extends('layouts.base')

@section('title', 'Student Profiel')

@section('content')
<x-navbar />

<script>
    function toggleEdit() {
        // Toggle to edit mode
        document.querySelectorAll('.view-mode').forEach(e => e.classList.add('hidden'));
        document.querySelectorAll('.edit-mode').forEach(e => e.classList.remove('hidden'));
        document.getElementById('editBtn').classList.add('hidden');
        document.getElementById('editActions').classList.remove('hidden');
    }

    function cancelEdit() {
        // Cancel edit mode
        document.querySelectorAll('.view-mode').forEach(e => e.classList.remove('hidden'));
        document.querySelectorAll('.edit-mode').forEach(e => e.classList.add('hidden'));
        document.getElementById('editBtn').classList.remove('hidden');
        document.getElementById('editActions').classList.add('hidden');
    }
</script>

<div class="flex items-center justify-center px-4">
    <div class="bg-[#e0e5ec] rounded-3xl shadow-xl w-full max-w-2xl p-8 sm:p-10 mt-6">

        <!-- ✅ PROFILE UPDATE FORM -->
        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ✅ Top buttons: Edit, Save/Cancel -->
            <div class="flex justify-between items-center mb-6 flex-wrap gap-2">
                <div class="flex gap-2">
                    <!-- Edit button -->
                    <button type="button" id="editBtn"
                        onclick="toggleEdit()"
                        class="bg-[#1E40AF] text-white text-sm px-4 py-2 rounded-full shadow">
                        Bewerken
                    </button>

                    <!-- Save + Cancel buttons -->
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

            <!-- ✅ Profile photo + name -->
            <div class="flex flex-col items-center mb-6">
                <label class="cursor-pointer">
                    <div class="w-24 h-24 rounded-full border-4 border-[#1E40AF] flex items-center justify-center text-sm text-[#1E40AF] bg-white overflow-hidden">
                        @if ($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profielfoto" class="w-full h-full object-cover">
                        @else
                            <span class="view-mode">Profielfoto</span>
                        @endif
                        <input name="profile_picture" type="file" accept="image/*" class="hidden edit-mode" />
                    </div>
                </label>
                <h1 class="text-2xl font-bold text-[#1E40AF] mt-2">{{ $user->voornaam }} {{ $user->achternaam }}</h1>
            </div>

            <!-- ✅ Personal Info -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Persoonlijke Informatie</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Voornaam -->
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Voornaam</label>
                        <span class="view-mode">{{ $user->voornaam ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="voornaam" placeholder="Voornaam"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->voornaam }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Achternaam</label>
                        <span class="view-mode">{{ $user->achternaam ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="achternaam" placeholder="Achternaam"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->achternaam }}">
                    </div>

                    <div class="col-span-1 sm:col-span-2 bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">E-mailadres</label>
                        <span class="view-mode">{{ $user->email }}</span>
                        <input type="email" name="email" placeholder="E-mailadres"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->email }}">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Hogeschool</h2>
                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Opleiding</label>
                        <span class="view-mode">{{ $user->opleiding ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="opleiding" placeholder="Opleiding"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->opleiding }}">
                    </div>

                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Jaar</label>
                        <span class="view-mode">{{ $user->jaar ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="jaar" placeholder="Jaar"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->jaar }}">
                    </div>
                </div>
            </div>

            <!-- ✅ Skills section -->
            <div>
                <h2 class="text-lg font-semibold text-[#1E40AF] mb-3">Vaardigheden</h2>
                <div class="flex flex-wrap gap-2">
                    <p class="text-gray-500">Geen vaardigheden toegevoegd.</p>
                </div>
            </div>
        </form>

        <!-- ✅ LOGOUT FORM OUTSIDE PROFILE FORM -->
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
