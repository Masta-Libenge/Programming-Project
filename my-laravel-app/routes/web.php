<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VacatureController;
use App\Http\Controllers\StudentController;

// ✅ Publieke homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// ✅ Login routes
Route::get('/login/student', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::get('/login/bedrijf', [LoginController::class, 'showBedrijfLoginForm'])->name('login.bedrijf');
Route::post('/login/student', [LoginController::class, 'studentlogin']);
Route::post('/login/bedrijf', [LoginController::class, 'bedrijfLogin']);

// ✅ Register routes
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::get('/register/bedrijf', [RegisterController::class, 'showBedrijfRegisterForm'])->name('register.bedrijf');
Route::post('/register/student', [RegisterController::class, 'studentRegister']);
Route::post('/register/bedrijf', [RegisterController::class, 'bedrijfRegister']);

// ✅ Beschermde routes voor ingelogde gebruikers
Route::middleware(['auth'])->group(function () {
    Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');
    Route::get('/vacatures/create', [VacatureController::class, 'create'])->name('vacatures.create');
    // ➕ Voeg hier eventueel meer routes toe, zoals favorieten, sollicitaties, enz.
});

// ✅ Specifieke student-dashboard route
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});
