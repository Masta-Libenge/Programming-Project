@extends('layouts.app')

@section('title', 'Login Bedrijf')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-white px-4">
    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg text-center">
        <h2 class="text-2xl font-semibold text-blue-700 mb-8">Bedrijf Login</h2>
        <form method="POST" action="{{ route('loginBedrijf.submit') }}" class="space-y-6">
            @csrf
            <input
                type="text"
                name="email"
                placeholder="E-mail"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                required
            >
            <input
                type="password"
                name="password"
                placeholder="Wachtwoord"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition"
                required
            >
            <button
                type="submit"
                class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition"
            >
                Inloggen
            </button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-gray-600">Nog geen account? <a href="{{ route('register.bedrijf') }}" class="text-blue-600 hover:underline">Registreren</a></p>
        </div>
    </div>
</div>
@endsection
