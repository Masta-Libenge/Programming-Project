<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VacatureController;
use App\Http\Controllers\StudentController;

// ✅ Homepage met keuze: Student of Bedrijf (je hebt gekozen voor home.blade.php)
Route::get('/', function () {
    return view('home'); // --> resources/views/home.blade.php
})->name('home');

// ✅ Login routes 
Route::get('/login/student', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::get('/login/bedrijf', [LoginController::class, 'showBedrijfLoginForm'])->name('login.bedrijf');
Route::post('/login/student', [LoginController::class, 'studentLogin']);
Route::post('/login/bedrijf', [LoginController::class, 'bedrijfLogin']);

// ✅ Register routes (link onderaan loginpagina)
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::get('/register/bedrijf', [RegisterController::class, 'showBedrijfRegisterForm'])->name('register.bedrijf');
Route::post('/register/student', [RegisterController::class, 'studentRegister']);
Route::post('/register/bedrijf', [RegisterController::class, 'bedrijfRegister']);

// ✅ Beschermde routes (alle ingelogde gebruikers)
Route::middleware(['auth'])->group(function () {
    Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');
    Route::get('/vacatures/create', [VacatureController::class, 'create'])->name('vacatures.create');
});

// ✅ Student-dashboard (alleen voor studenten)
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::get('/register_bedrijf', function () {
    return view('auth.register_bedrijf');
});
