<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\BedrijfController;
use App\Http\Controllers\MailboxController;


Route::get('/', function () {
    return view('auth.keuze');
})->name('keuze');

// Login Student
Route::get('/student/login', [LoginController::class, 'showStudentLoginForm'])->name('login.student');
Route::post('/student/login/submit', [LoginController::class, 'login'])->name('loginStudent.submit');

// Register Student
Route::get('/student/register', [RegisterController::class, 'showStudentRegisterForm'])->name('register.student');
Route::post('/student/register/submit', [RegisterController::class, 'studentRegister'])->name('registerStudent.submit');


// Login Bedrijf
Route::get('/bedrijf/login', [LoginController::class, 'showBedrijfLoginForm'])->name('login.bedrijf');
Route::post('/bedrijf/login/submit', [LoginController::class, 'login'])->name('loginBedrijf.submit');

// Register Bedrijf
Route::get('/bedrijf/register', [BedrijfController::class, 'showBedrijfRegisterForm'])->name('register.bedrijf');
Route::post('/bedrijf/register/submit', [BedrijfController::class, 'bedrijfRegister'])->name('registerBedrijf.submit');

// Profile
Route::get('/profile', function () {
    return view('student.profile');
})->name('profil.student');

// Planning 
Route::get('/planning', function () {
    return view('student.planning');
})->name('planning.student');

// MailBox
Route::get('/mailbox', [MailboxController::class, 'index'])->name('mailbox');

Route::get('/homepage', function () {
    return view('auth.Homepage');
})->name('homepage');