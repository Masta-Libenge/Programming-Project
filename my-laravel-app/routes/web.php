<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('auth.keuze');
})->name('keuze');

// Login Student
Route::get('/login/student', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::post('/login/submit', [LoginController::class, 'studentlogin'])->name('loginStudent.submit');

// Register Student
Route::get('/register/student', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::post('/register/submit', [RegisterController::class, 'studentRegister'])->name('registerStudent.submit');


Route::get('/login/bedrijf', function () {
    return view('auth.login_bedrijf');
})->name('login.bedrijf');

Route::get('/homepage', function () {
    return view('auth.Homepage');
})->name('homepage');