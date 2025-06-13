<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VacatureController;
use App\Models\User;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Auth: Login Routes
|--------------------------------------------------------------------------
*/
Route::get('/login/student', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::get('/login/bedrijf', [LoginController::class, 'showBedrijfLoginForm'])->name('login.bedrijf');
Route::post('/login/student', [LoginController::class, 'studentLogin']);
Route::post('/login/bedrijf', [LoginController::class, 'bedrijfLogin']);

/*
|--------------------------------------------------------------------------
| Auth: Register Routes
|--------------------------------------------------------------------------
*/
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::get('/register/bedrijf', [RegisterController::class, 'showBedrijfRegisterForm'])->name('register.bedrijf');
Route::post('/register/student', [RegisterController::class, 'studentRegister']);
Route::post('/register/bedrijf', [RegisterController::class, 'bedrijfRegister']);

/*
|--------------------------------------------------------------------------
| Testroute
|--------------------------------------------------------------------------
*/
Route::get('/register_student', function () {
    return view('auth.register_student');
});

/*
|--------------------------------------------------------------------------
| Dashboard & Vacature Routes (alleen na login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');
    Route::get('/vacatures/create', [VacatureController::class, 'create'])->name('vacatures.create');
    
    Route::get('/vacature/aanmaken', [VacatureController::class, 'create'])->name('vacature.create');
    Route::post('/vacature/opslaan', [VacatureController::class, 'store'])->name('vacature.store');

    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

    Route::get('/bedrijf/dashboard', function () {
        $students = User::where('type', 'student')->get();
        return view('bedrijf.bedrijfdashboard', compact('students'));
    })->name('bedrijf.dashboard');
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
| Debug
|--------------------------------------------------------------------------
*/
Route::get('/debug', function () {
    return 'Middleware is bypassed';
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/vacature/aanmaken', [VacatureController::class, 'create'])->name('vacature.create');
Route::post('/vacature/opslaan', [VacatureController::class, 'store'])->name('vacature.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    Route::delete('/admin/vacature/{id}', [AdminController::class, 'destroyVacature'])->name('admin.vacature.destroy');
});
