<nav class="navbar" style="position: sticky; top: 0; width: 100%; background-color: #1E40AF; padding: 1rem 6%; z-index: 999;">
  <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto;">
    
    <a href="
      @auth
        @if(auth()->user()->type === 'student')
          {{ route('student.dashboard') }}
        @elseif(auth()->user()->type === 'bedrijf')
          {{ route('bedrijf.dashboard') }}
        @else
          {{ url('/') }}
        @endif
      @else
        {{ url('/') }}
      @endauth
    " class="logo" style="font-size: 1.4rem; font-weight: 800; color: white; text-decoration: none;">
      CareerLaunch
    </a>

    <div class="nav-links" style="display: flex; align-items: center;">
      <a href="{{ route('planning') }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">Planning</a>
      <a href="{{ route('about') }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">About Us</a>
      <a href="{{ route('faq') }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">FAQ</a>
      <a href="#" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">Contact</a>
      @auth
        <a href="{{ route('student.profile.show') }}" style="margin-left: 2rem; text-decoration: none; color: white; font-weight: 600;">Profiel</a>
      @endauth
    </div>

  </div>
</nav>
