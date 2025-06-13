@extends('layouts.app')

@section('content')
    <div class="form-container" style="margin-top: 3rem;">
        <h1 style="font-size: 2rem; color: var(--text); font-weight: 700; text-align: center; margin-bottom: 0.5rem;">
            Welkom, {{ auth()->user()->name }}
        </h1>

        <p style="text-align: center; font-size: 1rem; color: var(--muted); margin-bottom: 2rem;">
            Je bent ingelogd als student
        </p>

        {{-- 🔒 Logout form (hidden) --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        {{-- 🔘 Logout button --}}
        <button
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            style="width: 100%; margin-bottom: 1rem; padding: 0.9rem; font-size: 1rem; font-weight: 600;
                   border: none; border-radius: var(--radius); background-color: var(--accent); color: white;
                   cursor: pointer; transition: background 0.3s ease, transform 0.2s ease;">
            Uitloggen
        </button>

        {{-- 👤 Profile link --}}
        <a href="{{ route('student.profile') }}"
           style="display: block; text-align: center; font-weight: 500; color: var(--accent); text-decoration: none;
                  border: 1px solid var(--accent); padding: 0.75rem 1.25rem; border-radius: var(--radius);
                  transition: background-color 0.3s ease, color 0.3s ease;">
            Bekijk je profiel
        </a>
    </div>
@endsection
