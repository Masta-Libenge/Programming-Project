@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    <div id="welcomeModal" class="modal">
        <div class="modal-content">
            <h2>Welkom, {{ Auth::user()->name }}</h2>
            <p>Je bent ingelogd als student</p>
            <button class="close-btn-bottom" onclick="document.getElementById('welcomeModal').style.display='none'">
                Doorgaan
            </button>
        </div>
    </div>
@endsection
