<header>
    <h1>Welkom, {{ auth()->user()->name }}</h1>
    <p class="subtitle">Je bent ingelogd als student</p>

    {{-- 🔒 Logout form (hidden, triggered by button below) --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- 🔘 Logout button --}}
    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Uitloggen
    </button>

    {{-- 👤 Profile button – sends the student to their editable profile --}}
    <a href="{{ route('student.profile') }}" class="logout-btn" style="display: inline-block; margin-top: 0.5rem; text-align: center;">
        Bekijk je profiel
    </a>
</header>
