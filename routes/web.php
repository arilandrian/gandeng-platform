<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController; // Akan digunakan untuk rute register

// Rute Landing Page (pastikan sudah ada)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// --- Rute untuk Otentikasi (Login dan Logout) ---

// Menampilkan formulir login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Memproses data login yang dikirimkan
Route::post('/login', [LoginController::class, 'login']);

// Logout pengguna
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- Rute untuk Registrasi (akan dibuat di langkah selanjutnya) ---

// Menampilkan formulir registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

