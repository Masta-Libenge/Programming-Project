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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// ✅ Public home page — NOW WITH NAME!
Route::get('/', fn () => view('auth.home'))->name('home');

Route::get('/login', fn () => redirect('/login/student'))->name('login');

Route::get('/about', fn () => view('about'))->name('about');

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
*/

Route::get('/login/student', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::get('/login/bedrijf', [LoginController::class, 'showBedrijfLoginForm'])->name('login.bedrijf');
Route::post('/login/student', [LoginController::class, 'studentLogin']);
Route::post('/login/bedrijf', [LoginController::class, 'bedrijfLogin']);

/*
|--------------------------------------------------------------------------
| Register Routes
|--------------------------------------------------------------------------
*/

Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::get('/register/bedrijf', [RegisterController::class, 'showBedrijfRegisterForm'])->name('register.bedrijf');
Route::post('/register/student', [RegisterController::class, 'studentRegister']);
Route::post('/register/bedrijf', [RegisterController::class, 'bedrijfRegister']);

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/

// ✅ Correct logout: clears session + redirects to named home page
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Student
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [ProfileController::class, 'show'])->name('student.profile.show');
    Route::get('/student/profile/edit', [ProfileController::class, 'edit'])->name('student.profile');
    Route::post('/student/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    Route::post('/student/profile/upload-picture', [ProfileController::class, 'uploadProfilePicture'])->name('student.profile.upload-picture');

    // Bedrijf
    Route::get('/bedrijf/dashboard', [BedrijfController::class, 'dashboard'])->name('bedrijf.dashboard');

    // Vacatures
    Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');
    Route::get('/vacatures/create', [VacatureController::class, 'create'])->name('vacatures.create');
    Route::get('/vacature/aanmaken', [VacatureController::class, 'create'])->name('vacature.create');
    Route::post('/vacature/opslaan', [VacatureController::class, 'store'])->name('vacature.store');
    Route::post('/vacature/{id}/apply', [VacatureController::class, 'apply'])->name('vacature.apply');

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    Route::delete('/admin/vacature/{id}', [AdminController::class, 'destroyVacature'])->name('admin.vacature.destroy');

    // Planning
    Route::get('/planning', fn () => view('student.planning'))->name('planning');

    // FAQ
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::post('/admin/faq/{id}/answer', [AdminController::class, 'answerFaq'])->name('admin.faq.answer');
    Route::post('/admin/faq/{id}/toggle', [AdminController::class, 'toggleFaq'])->name('admin.faq.toggle');
});
