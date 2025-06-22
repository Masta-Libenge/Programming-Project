<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VacatureController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BedrijfController;
use App\Http\Middleware\TypeMiddleware;

use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('auth.home'))->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/about', fn () => view('about'))->name('about');

/*
|--------------------------------------------------------------------------
| Login + Register Routes
|--------------------------------------------------------------------------
*/

// Login (één formulier voor student en bedrijf)
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Registratie (aparte formulieren)
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::get('/register/bedrijf', [RegisterController::class, 'showBedrijfRegisterForm'])->name('register.bedrijf');
Route::post('/register/student', [RegisterController::class, 'studentRegister']);
Route::post('/register/bedrijf', [RegisterController::class, 'bedrijfRegister']);

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Algemene Ingelogde Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // 📚 Vacatures
    Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');
    Route::get('/vacature/aanmaken', [VacatureController::class, 'create'])->name('vacature.create');
    Route::post('/vacature/opslaan', [VacatureController::class, 'store'])->name('vacature.store');
    Route::get('/vacature/{id}', [VacatureController::class, 'show'])->name('vacature.show');
    Route::post('/vacature/{id}/apply', [VacatureController::class, 'apply'])->name('vacature.apply');
    Route::post('/vacature/{id}/unapply', [VacatureController::class, 'unapply'])->name('vacature.unapply');

    // 📅 Planning
    Route::get('/planning', [StudentController::class, 'planning'])->name('planning');

    // ❓ FAQ
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
});

/*
|--------------------------------------------------------------------------
| Public vacature routes (non-auth)
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Role-Based Routes
|--------------------------------------------------------------------------
*/

// 👨‍🎓 Alleen studenten
Route::middleware(['auth', TypeMiddleware::class . ':student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [ProfileController::class, 'show'])->name('student.profile.show');
    Route::get('/student/profile/edit', [ProfileController::class, 'edit'])->name('student.profile');
    Route::post('/student/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    Route::post('/student/profile/upload-picture', [ProfileController::class, 'uploadProfilePicture'])->name('student.profile.upload-picture');
});

// 🏢 Alleen bedrijven
Route::middleware(['auth', TypeMiddleware::class . ':bedrijf'])->group(function () {
    Route::get('/bedrijf/dashboard', [BedrijfController::class, 'dashboard'])->name('bedrijf.dashboard');
    Route::post('/vacature/{vacatureId}/accept/{studentId}', [VacatureController::class, 'accept'])->name('vacature.accept');
Route::post('/vacature/{vacatureId}/decline/{studentId}', [VacatureController::class, 'decline'])->name('vacature.decline');
Route::get('/bedrijf/student/{id}', [ProfileController::class, 'showForBedrijf'])
    ->name('bedrijf.student.profile');
    Route::get('/bedrijf/student/{id}', [ProfileController::class, 'showForBedrijf'])
    ->name('bedrijf.student.profile')
    ->middleware(['auth', TypeMiddleware::class . ':bedrijf']);



});

// 🛡️ Alleen admin
Route::middleware(['auth', TypeMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    Route::delete('/admin/vacature/{id}', [AdminController::class, 'destroyVacature'])->name('admin.vacature.destroy');
});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
