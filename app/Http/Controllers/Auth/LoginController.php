<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Penting: Pastikan ini diimpor jika menggunakan Request di method login/logout
use Illuminate\Support\Facades\Auth; // Penting: Pastikan ini diimpor jika menggunakan Auth di method login/logout

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * Ini akan diganti setelah kita punya dashboard spesifik.
     * Untuk saat ini, kita bisa arahkan ke root atau halaman selamat datang sementara.
     * Atau, kita bisa tentukan per role.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Default redirect jika tidak ada role spesifik (seperti yang sebelumnya kita diskusikan)

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Kedua baris pemanggilan middleware ini DIHAPUS atau DIKOMENTARI
        // karena Anda mengalami error dan kita akan mengelola middleware di rute.
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

    /**
     * Menampilkan formulir login aplikasi.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Mengembalikan view login yang sudah kita buat
    }

    /**
     * Menangani permintaan login ke aplikasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Melakukan validasi input email dan password
        $this->validateLogin($request);

        // Jika otentikasi berhasil
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();

            // Logika pengalihan berdasarkan peran (role) pengguna
            if ($user->role === 'donatur') {
                return redirect()->intended('/dashboard/donatur'); // Rute ini akan dibuat nanti
            } elseif ($user->role === 'komunitas') {
                return redirect()->intended('/dashboard/komunitas'); // Rute ini akan dibuat nanti
            }
            // Jika ada peran lain (misal admin), tambahkan di sini
            // elseif ($user->role === 'admin') {
            //      return redirect()->intended('/admin/dashboard');
            // }

            return $this->sendLoginResponse($request); // Redirect default jika tidak ada role spesifik
        }

        // Jika upaya login gagal, kembali ke formulir login dengan error
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/'); // Redirect ke landing page setelah logout
    }
}