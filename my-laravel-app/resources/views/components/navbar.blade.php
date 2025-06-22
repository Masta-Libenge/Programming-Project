@php
    $homeRoute = url('/');
    $profileRoute = '#'; // Valeur par défaut

    if(auth()->check()) {
        if(auth()->user()->type === 'student') {
            $homeRoute = route('student.dashboard');
            $profileRoute = route('student.profile.show');
        } elseif(auth()->user()->type === 'bedrijf') {
            $homeRoute = route('bedrijf.dashboard');
            $profileRoute = '#'; // À remplacer si un profil entreprise existe
        }
    }
@endphp

<nav class="navbar" style="position: sticky; top: 0; width: 100%; background-color: #1E40AF; padding: 1rem 6%; z-index: 999;">
  <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto;">
    <a href="{{ $homeRoute }}" class="logo" style="font-size: 1.4rem; font-weight: 800; color: white; text-decoration: none;">
      CareerLaunch
    </a>

    <div class="nav-links" style="display: flex; align-items: center;">
      <a href="{{ route('planning') }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">Planning</a>
      <a href="{{ route('about') }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">About Us</a>
      <a href="{{ route('faq') }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">FAQ</a>
      <a href="#" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">Contact</a>
      @auth
        <a href="{{ $profileRoute }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">Profiel</a>
      @endauth
    </div>
  </div>
</nav>
