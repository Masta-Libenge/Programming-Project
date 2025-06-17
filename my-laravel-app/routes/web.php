<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VacatureController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Models\User;

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
| Public Routes
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
| Logout Route
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Debug Route
|--------------------------------------------------------------------------
*/
Route::get('/debug', function () {
    return 'Middleware is bypassed';
});

/*
|--------------------------------------------------------------------------
| Routes for authenticated users only
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

    Route::get('/bedrijf/dashboard', function () {
        $students = User::where('type', 'student')->get();
        return view('bedrijf.bedrijfdashboard', compact('students'));
    })->name('bedrijf.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Vacature Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/vacatures', [VacatureController::class, 'index'])->name('vacatures.index');
    Route::get('/vacatures/create', [VacatureController::class, 'create'])->name('vacatures.create');

    Route::get('/vacature/aanmaken', [VacatureController::class, 'create'])->name('vacature.create');
    Route::post('/vacature/opslaan', [VacatureController::class, 'store'])->name('vacature.store');

    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/student/profile/edit', [ProfileController::class, 'edit'])->name('student.profile');
    Route::get('/student/profile', [ProfileController::class, 'show'])->name('student.profile.show');

    Route::post('/student/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    Route::post('/student/profile/upload-picture', [ProfileController::class, 'uploadProfilePicture'])->name('student.profile.upload-picture');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    Route::delete('/admin/vacature/{id}', [AdminController::class, 'destroyVacature'])->name('admin.vacature.destroy');

    /*
    |--------------------------------------------------------------------------
    | Student Profiel Update Extra
    |--------------------------------------------------------------------------
    */
    Route::post('/student/profile/update', [ProfileController::class, 'update'])
        ->name('student.profile.update');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

use App\Http\Controllers\FaqController;

Route::middleware('auth')->group(function () {
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
});
