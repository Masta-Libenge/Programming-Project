<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Profiel Bewerken</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleEdit() {
            document.querySelectorAll('.view-mode').forEach(e => e.classList.add('hidden'));
            document.querySelectorAll('.edit-mode').forEach(e => e.classList.remove('hidden'));
            document.getElementById('editBtn').classList.add('hidden');
            document.getElementById('saveBtn').classList.remove('hidden');
        }
    </script>
</head>
<body class="bg-[#1E40AF] min-h-screen pt-20">

    @include('components.navbar')

    <!-- FORMULAIRE -->
    <div class="flex items-center justify-center px-4">
        <div class="bg-[#e0e5ec] rounded-3xl shadow-xl w-full max-w-2xl p-8 sm:p-10 mt-6">

            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <button type="button" id="editBtn" onclick="toggleEdit()" class="bg-[#1E40AF] text-white text-sm px-4 py-2 rounded-full shadow">
                        Bewerken
                    </button>
                    <button type="submit" id="saveBtn" class="hidden bg-green-600 text-white text-sm px-4 py-2 rounded-full shadow">
                        Opslaan
                    </button>
                    <div class="text-gray-600 text-xl cursor-pointer">≡</div>
                </div>

                <!-- Photo -->
                <div class="flex flex-col items-center mb-6">
                    <label class="cursor-pointer">
                        <div class="w-24 h-24 rounded-full border-4 border-[#1E40AF] flex items-center justify-center text-sm text-[#1E40AF] bg-white">
                            <span class="view-mode">Profielfoto</span>
                            <input name="profile_picture" type="file" accept="image/*" class="hidden edit-mode" />
                        </div>
                    </label>
                    <h1 class="text-2xl font-bold text-[#1E40AF] mt-2">Student</h1>
                </div>

                <!-- Personal Info -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Persoonlijke Informatie</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                            <span class="view-mode">{{ Auth::user()->voornaam ?? 'Voornaam' }}</span>
                            <input type="text" name="voornaam" value="{{ Auth::user()->voornaam }}" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                        </div>
                        <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                            <span class="view-mode">{{ Auth::user()->achternaam ?? 'Achternaam' }}</span>
                            <input type="text" name="achternaam" value="{{ Auth::user()->achternaam }}" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                        </div>
                        <div class="col-span-1 sm:col-span-2 bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                            <span class="view-mode">{{ Auth::user()->email }}</span>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                        </div>
                    </div>
                </div>

                <!-- School Info -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-[#1E40AF] text-center mb-3">Hogeschool</h2>
                    <div class="space-y-4">
                        <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                            <span class="view-mode">{{ Auth::user()->opleiding ?? 'Opleiding' }}</span>
                            <input type="text" name="opleiding" value="{{ Auth::user()->opleiding }}" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                        </div>
                        <div class="bg-white rounded-xl shadow-inner px-4 py-2 text-center text-gray-700">
                            <span class="view-mode">{{ Auth::user()->jaar ?? 'Jaar 1' }}</span>
                            <input type="text" name="jaar" value="{{ Auth::user()->jaar }}" class="hidden edit-mode w-full text-center bg-transparent outline-none" />
                        </div>
                    </div>
                </div>

                <!-- Skills -->
                <div>
                    <h2 class="text-lg font-semibold text-[#1E40AF] mb-3">Vaardigheden</h2>
                    <div class="flex flex-wrap gap-2">
                        @forelse($skills ?? [] as $skill)
                            <span class="bg-[#1E40AF] text-white px-4 py-2 rounded-full text-sm shadow">{{ $skill }}</span>
                        @empty
                            <p class="text-gray-500">Geen vaardigheden toegevoegd.</p>
                        @endforelse
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
