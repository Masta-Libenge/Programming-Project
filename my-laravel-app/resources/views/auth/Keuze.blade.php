@extends('layouts.app')

@section('title', 'Keuze')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-white px-4">
    <div class="w-full max-w-md p-8 rounded-lg border border-gray-200 shadow-md text-center">
        <h2 class="text-2xl font-semibold text-blue-700 mb-8">Log in als:</h2>

        <div class="flex justify-center gap-6">
            <a href="{{ route('login.student') }}" class="inline-block px-6 py-3 rounded-md bg-white border border-blue-600 text-blue-600 font-medium hover:bg-blue-50 hover:scale-105 transition-transform shadow-sm">
                Student
            </a>
            <a href="{{ route('login.bedrijf') }}" class="inline-block px-6 py-3 rounded-md bg-white border border-blue-600 text-blue-600 font-medium hover:bg-blue-50 hover:scale-105 transition-transform shadow-sm">
                Bedrijf
            </a>
        </div>
    </div>
</div>
@endsection
