@extends('layouts.base')

@section('title', 'Student Profiel Bewerken')

@section('content')
<script>
    function toggleEdit() {
        document.querySelectorAll('.view-mode').forEach(e => e.classList.add('hidden'));
        document.querySelectorAll('.edit-mode').forEach(e => e.classList.remove('hidden'));
        document.getElementById('editBtn').classList.add('hidden');
        document.getElementById('saveBtn').classList.remove('hidden');
    }
</script>

<div class="flex items-center justify-center px-4">
    <div class="bg-[#e0e5ec] rounded-3xl shadow-xl w-full max-w-2xl p-8 sm:p-10 mt-6">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex justify-between items-center mb-6">
                <button type="button" id="editBtn" onclick="toggleEdit()" class="bg-[#1E40AF] text-white text-sm px-4 py-2 rounded-full shadow">
                    Bewerken
                </button>
                <button type="submit" id="saveBtn" class="hidden bg-green-600 text-white text-sm px-4 py-2 rounded-full shadow">
                    Opslaan
                </button>
            </div>

            <div class="flex flex-col items-center mb-6">
                <label class="cursor-pointer">
                    <div class="w-24 h-24 rounded-full border-4 border-[#1E40AF] flex items-center justify-center text-sm text-[#1E40AF] bg-white">
                        <span class="view-mode">Profielfoto</span>
                        <input name="profile_picture" type="file" accept="image/*" class="hidden edit-mode" />
                    </div>
                </label>
                <h1 class="text-2xl font-bold text-[#1E40AF] mt-2">Student</h1>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Persoonlijke Informatie</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <span class="view-mode">Voornaam</span>
                        <input type="text" name="voornaam" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                    </div>
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <span class="view-mode">Achternaam</span>
                        <input type="text" name="achternaam" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                    </div>
                    <div class="col-span-1 sm:col-span-2 bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <span class="view-mode">email@example.com</span>
                        <input type="email" name="email" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Hogeschool</h2>
                <div class="space-y-4">
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <span class="view-mode">Opleiding</span>
                        <input type="text" name="opleiding" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                    </div>
                    <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                        <span class="view-mode">Jaar 1</span>
                        <input type="text" name="jaar" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                    </div>
                </div>
            </div>

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
