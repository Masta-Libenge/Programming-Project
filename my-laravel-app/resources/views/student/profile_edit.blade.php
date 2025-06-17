<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profiel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#e0e5ec] flex items-center justify-center min-h-screen px-4">

    <div class="w-full max-w-md bg-[#e0e5ec] rounded-3xl shadow-inner p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <button class="bg-[#1E40AF] text-white px-3 py-1 rounded-full shadow text-sm">Bewerken</button>
            <div class="w-6 h-6 flex items-center justify-center rounded-md shadow-inner">
                <span class="text-xl font-bold">≡</span>
            </div>
        </div>

        <!-- Photo -->
        <div class="flex flex-col items-center">
            <img class="w-24 h-24 rounded-full border-4 border-[#1E40AF] object-cover mb-2"
                 src="{{ Auth::user()->profile_picture ?? 'https://via.placeholder.com/150' }}" alt="Profielfoto">
            <h1 class="text-2xl font-bold text-[#1E40AF]">Student</h1>
        </div>

        <!-- Personal Info -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-center text-[#1E40AF] mb-3">Persoonlijke Informatie</h2>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white rounded-xl shadow-inner px-3 py-2 text-center text-gray-700">
                    {{ Auth::user()->voornaam ?? 'Voornaam' }}
                </div>
                <div class="bg-white rounded-xl shadow-inner px-3 py-2 text-center text-gray-700">
                    {{ Auth::user()->achternaam ?? 'Achternaam' }}
                </div>
                <div class="col-span-2 bg-white rounded-xl shadow-inner px-3 py-2 text-center text-gray-700">
                    {{ Auth::user()->email ?? 'Email' }}
                </div>
            </div>
        </div>

        <!-- School Info -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-center text-[#1E40AF] mb-3">Hogeschool</h2>
            <div class="space-y-3">
                <div class="bg-white rounded-xl shadow-inner px-3 py-2 text-center text-gray-700">
                    {{ Auth::user()->opleiding ?? 'Opleiding' }}
                </div>
                <div class="bg-white rounded-xl shadow-inner px-3 py-2 text-center text-gray-700">
                    {{ Auth::user()->jaar ?? 'Jaar 1' }}
                </div>
            </div>
        </div>

        <!-- Skills -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold text-[#1E40AF] mb-3">Vaardigheden</h2>
            <div class="flex flex-wrap gap-2 justify-center">
                @forelse($skills ?? [] as $skill)
                    <span class="bg-[#1E40AF] text-white px-4 py-2 rounded-full shadow text-sm">{{ $skill }}</span>
                @empty
                    <span class="text-gray-500">Geen vaardigheden toegevoegd.</span>
                @endforelse
            </div>
        </div>

    </div>

</body>
</html>
