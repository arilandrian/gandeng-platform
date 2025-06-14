<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController; // Pastikan ini diimpor!

// Rute Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// --- Rute untuk Otentikasi (Login dan Logout) ---

// Menampilkan formulir login
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->middleware('guest') // Menambahkan middleware 'guest'
    ->name('login');

// Memproses data login yang dikirimkan
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest'); // Menambahkan middleware 'guest'

// Logout pengguna (biasanya memerlukan middleware 'auth' agar hanya user yang login bisa logout)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth') // Menambahkan middleware 'auth'
    ->name('logout');

// --- Rute untuk Registrasi ---

// Halaman Registrasi Donatur (GET - untuk menampilkan form)
Route::get('/register/donatur', function () {
    return view('auth.register-donatur');
})->middleware('guest')->name('register.donatur.form');

// Memproses pendaftaran donatur (POST - untuk submit form)
Route::post('/register/donatur', [RegisterController::class, 'registerDonatur'])
    ->middleware('guest')
    ->name('register.donatur'); // Ini adalah nama rute yang dicari oleh form HTML Anda

// Halaman Registrasi Organisasi (GET - untuk menampilkan form)
Route::get('/register/organisasi', function () {
    return view('auth.register-organisasi');
})->middleware('guest')->name('register.organisasi.form');

// Rute untuk menampilkan Daftar Kampanye (Program Sosial)
Route::get('/campaigns', function () {
    return view('campaigns.index'); // Mengembalikan view index.blade.php di folder campaigns
})->name('campaigns.index');

// Nantinya akan menjadi Route::get('/campaigns/{id}', ...)
Route::get('/campaigns/detail', function () {
    return view('campaigns.show');
})->name('campaigns.show');

Route::get('/donations/create', function () {
    return view('donations.create');
})->name('donations.create');


// Rute untuk menampilkan Dashboard Donatur
Route::get('/dashboard/donatur', function () {
    return view('donatur.dashboard');
})->middleware(['auth', 'role:donatur']) // Memastikan pengguna sudah login DAN memiliki peran 'donatur'
  ->name('donatur.dashboard');

  // Rute untuk menampilkan Riwayat Donasi Donatur
Route::get('/donatur/history', function () {
    return view('donatur.history');
})->middleware(['auth', 'role:donatur'])
  ->name('donatur.donation_history');

// --- Rute untuk Riwayat Ulasan Donatur (membutuhkan login sebagai donatur) ---

// Rute untuk menampilkan Riwayat Ulasan Donatur
Route::get('/donatur/reviews', function () {
    return view('donatur.reviews'); // View ini akan kita buat selanjutnya
})->middleware(['auth', 'role:donatur'])
  ->name('donatur.reviews_history');

// Rute untuk menampilkan Dashboard Komunita
Route::get('/dashboard/komunitas', function () {
    return view('komunitas.dashboard'); // Menunjuk ke view komunitas.dashboard
})->middleware(['auth', 'role:komunitas'])
  ->name('komunitas.dashboard');

// Rute untuk menampilkan formulir Buat Kampanye
Route::get('/komunitas/campaigns/create', function () {
    return view('komunitas.create-campaign'); // Menunjuk ke view komunitas.create-campaign
})->middleware(['auth', 'role:komunitas'])
  ->name('komunitas.create_campaign');

// Rute untuk menampilkan halaman Program Saya
Route::get('/komunitas/my-programs', function () {
    return view('komunitas.my-programs');
})->middleware(['auth', 'role:komunitas'])
  ->name('komunitas.my_programs');

// Rute untuk menampilkan halaman Laporan Anggaran
Route::get('/komunitas/budget-report', function () {
    return view('komunitas.budget-report'); // Menunjuk ke view komunitas.budget-report
})->middleware(['auth', 'role:komunitas'])
  ->name('komunitas.budget_report');

// Rute untuk menampilkan halaman Ulasan Donatur
Route::get('/komunitas/donor-reviews', function () {
    return view('komunitas.donor-reviews'); // Menunjuk ke view komunitas.donor-reviews
})->middleware(['auth', 'role:komunitas'])
  ->name('komunitas.donor_reviews');

// Rute untuk menampilkan Dashboard Admin
Route::get('/dashboard/admin', function () {
    return view('admin.dashboard'); // Menunjuk ke view admin.dashboard
})->middleware(['auth', 'role:admin'])
  ->name('admin.dashboard');
  
// Anda juga mungkin memerlukan rute POST untuk registrasi organisasi nanti
// Route::post('/register/organisasi', [RegisterController::class, 'registerOrganisasi'])
//     ->middleware('guest')
//     ->name('register.organisasi');