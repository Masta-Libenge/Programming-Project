<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VacatureController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Auth: Login Routes
|--------------------------------------------------------------------------
| Routes voor het inloggen van studenten en bedrijven.
*/
Route::get('/login/student', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::get('/login/bedrijf', [LoginController::class, 'showBedrijfLoginForm'])->name('login.bedrijf');
Route::post('/login/student', [LoginController::class, 'studentLogin']);
Route::post('/login/bedrijf', [LoginController::class, 'bedrijfLogin']);

/*
|--------------------------------------------------------------------------
| Auth: Register Routes
|--------------------------------------------------------------------------
| Routes voor het registreren van studenten en bedrijven.
*/
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::get('/register/bedrijf', [RegisterController::class, 'showBedrijfRegisterForm'])->name('register.bedrijf');
Route::post('/register/student', [RegisterController::class, 'studentRegister']);
Route::post('/register/bedrijf', [RegisterController::class, 'bedrijfRegister']);

/*
|--------------------------------------------------------------------------
| Testroute (tijdelijk gebruik)
|--------------------------------------------------------------------------
| Gebruik dit voor directe toegang tot het registratieformulier van studenten.
| Enkel bedoeld voor testdoeleinden.
*/
Route::get('/register_student', function () {
    return view('auth.register_student');
});

/*
|--------------------------------------------------------------------------
| Dashboard & Vacature Functionaliteiten
|--------------------------------------------------------------------------
| Routes die enkel toegankelijk zijn voor ingelogde gebruikers.
*/
Route::middleware(['auth'])->group(function () {
    // Vacature overzicht en creatie
    Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');
    Route::get('/vacatures/create', [VacatureController::class, 'create'])->name('vacatures.create');

    // Student dashboard
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

/*
|--------------------------------------------------------------------------
| Algemene Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.home');
});

Route::get('/login', function () {
    return redirect('/login/student');
})->name('login');

/*
|--------------------------------------------------------------------------
| Debug Route (voor tests, geen middleware)
|--------------------------------------------------------------------------
*/
Route::get('/debug', function () {
    return 'Middleware is bypassed';
});

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
| Logt de gebruiker uit, maakt de sessie ongeldig en stuurt terug naar home.
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
