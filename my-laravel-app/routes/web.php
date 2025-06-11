<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('auth.keuze');
})->name('keuze');

// Login Student
Route::get('/student/login', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::post('/student/login/submit', [LoginController::class, 'studentlogin'])->name('loginStudent.submit');

// Register Student
Route::get('/student/register', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::post('/student/register/submit', [RegisterController::class, 'studentRegister'])->name('registerStudent.submit');


Route::get('/bedrijf/login', function () {
    return view('auth.login_bedrijf');
})->name('login.bedrijf');

Route::post('/bedrijf/login/submit', function () {
    return redirect()->route('homepage');
})->name('login.submit');

Route::get('/homepage', function () {
    return view('auth.Homepage');
})->name('homepage');