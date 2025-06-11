<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('auth.keuze');
})->name('keuze');

Route::get('/login/student', function () {
    return view('auth.login_student');
})->name('login.student');

Route::get('/login/bedrijf', function () {
    return view('auth.login_bedrijf');
})->name('login.bedrijf');

Route::post('/login/submit', function () {
    return redirect()->route('homepage');
})->name('login.submit');

Route::get('/homepage', function () {
    return view('auth.Homepage');
})->name('homepage');