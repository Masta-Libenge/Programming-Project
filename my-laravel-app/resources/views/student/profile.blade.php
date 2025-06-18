@extends('layouts.base')

@section('title', 'Student Profiel')

@section('content')
<script>
    function toggleEdit() {
        // Hide all view-mode elements
        document.querySelectorAll('.view-mode').forEach(e => e.classList.add('hidden'));
        // Show all edit-mode elements
        document.querySelectorAll('.edit-mode').forEach(e => e.classList.remove('hidden'));
        // Hide the main edit button
        document.getElementById('editBtn').classList.add('hidden');
        // ✅ Show the whole editActions (Save + Cancel)
        document.getElementById('editActions').classList.remove('hidden');
    }

    function cancelEdit() {
        // Show all view-mode elements again
        document.querySelectorAll('.view-mode').forEach(e => e.classList.remove('hidden'));
        // Hide all edit-mode inputs again
        document.querySelectorAll('.edit-mode').forEach(e => e.classList.add('hidden'));
        // Show the main edit button again
        document.getElementById('editBtn').classList.remove('hidden');
        // Hide Save + Cancel actions
        document.getElementById('editActions').classList.add('hidden');
    }
</script>


<div class="flex items-center justify-center px-4">
    <div class="bg-[#e0e5ec] rounded-3xl shadow-xl w-full max-w-2xl p-8 sm:p-10 mt-6">
        <!-- ✅ USE CORRECT ACTION -->
        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

<!-- ✅ Buttons -->
<div class="flex justify-between items-center mb-6 gap-2">
    <button type="button" id="editBtn" onclick="toggleEdit()" class="bg-[#1E40AF] text-white text-sm px-4 py-2 rounded-full shadow">
        Bewerken
    </button>

    <div id="editActions" class="hidden flex gap-2">
        <button type="submit" id="saveBtn" class="bg-green-600 text-white text-sm px-4 py-2 rounded-full shadow">
            Opslaan
        </button>
        <button type="button" onclick="cancelEdit()" class="bg-red-500 text-white text-sm px-4 py-2 rounded-full shadow">
            Annuleren
        </button>
    </div>
</div>

            <!-- ✅ Profielfoto + naam -->
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

            <!-- ✅ Persoonlijke Informatie -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Persoonlijke Informatie</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Voornaam -->
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Voornaam</label>
                        <span class="view-mode">{{ $user->voornaam ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="voornaam"
                            placeholder="Voornaam"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->voornaam }}">
                    </div>

                    <!-- Achternaam -->
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Achternaam</label>
                        <span class="view-mode">{{ $user->achternaam ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="achternaam"
                            placeholder="Achternaam"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->achternaam }}">
                    </div>

                    <!-- E-mailadres -->
                    <div class="col-span-1 sm:col-span-2 bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">E-mailadres</label>
                        <span class="view-mode">{{ $user->email }}</span>
                        <input type="email" name="email"
                            placeholder="E-mailadres"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->email }}">
                    </div>
                </div>
            </div>

            <!-- ✅ Hogeschool -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Hogeschool</h2>
                <div class="space-y-4">
                    <!-- Opleiding -->
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Opleiding</label>
                        <span class="view-mode">{{ $user->opleiding ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="opleiding"
                            placeholder="Opleiding"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->opleiding }}">
                    </div>

                    <!-- Jaar -->
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <label class="block text-sm text-[#1E40AF] mb-1">Jaar</label>
                        <span class="view-mode">{{ $user->jaar ?? 'Nog niet ingevuld' }}</span>
                        <input type="text" name="jaar"
                            placeholder="Jaar"
                            class="hidden edit-mode w-full text-center bg-transparent outline-none"
                            value="{{ $user->jaar }}">
                    </div>
                </div>
            </div>

            <!-- ✅ Vaardigheden -->
            <div>
                <h2 class="text-lg font-semibold text-[#1E40AF] mb-3">Vaardigheden</h2>
                <div class="flex flex-wrap gap-2">
                    <p class="text-gray-500">Geen vaardigheden toegevoegd.</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
