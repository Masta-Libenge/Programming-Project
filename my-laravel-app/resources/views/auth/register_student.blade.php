@extends('layouts.app')

@section('title', 'Registreren als student')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-white px-4">
    <div class="w-full max-w-md p-8 rounded-md shadow-md border border-gray-200">
        <h2 class="text-3xl font-semibold text-blue-600 mb-8 text-center">Student Registratie</h2>

        <form method="POST" action="{{ route('registerStudent.submit') }}" class="space-y-6">
            @csrf

            <input 
                type="text" 
                name="name" 
                placeholder="Naam" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >
            <input 
                type="email" 
                name="email" 
                placeholder="E-mail" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >
            <input 
                type="password" 
                name="password" 
                placeholder="Wachtwoord" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >
            <input 
                type="password" 
                name="password_confirmation" 
                placeholder="Herhaal wachtwoord" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 transition"
            >
                Registreren
            </button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-gray-600">Al een account? <a href="{{ route('login.student') }}" class="text-blue-600 hover:underline">Inloggen</a></p>
        </div>
    </div>
</div>
@endsection
