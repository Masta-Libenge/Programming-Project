<nav class="fixed top-0 left-0 right-0 bg-blue-900 shadow-md z-50 h-16">
    <div class="max-w-7xl mx-auto px-4 h-full flex items-center justify-between">
        <a href="{{ route('keuze') }}" class="text-white font-bold text-lg">MijnPlatform</a>
        <ul class="flex space-x-6">
            <li><a href="{{ route('profil.student') }}" class="text-white hover:text-blue-300 font-medium">Profil</a></li>
            <li><a href="{{ route('register.student') }}" class="text-white hover:text-blue-300 font-medium">Registreren</a></li>
            <li><a href="{{ route('login.bedrijf') }}" class="text-white hover:text-blue-300 font-medium">Login Bedrijf</a></li>
        </ul>
    </div>
</nav>

