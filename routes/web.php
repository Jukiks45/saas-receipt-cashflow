<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes (Belum Login)
|--------------------------------------------------------------------------
| Halaman login ditaruh di root ("/") supaya saat pertama kali membuka
| website, user langsung diarahkan ke halaman login/register.
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Sudah Login)
|--------------------------------------------------------------------------
| Semua halaman aplikasi utama dilindungi oleh middleware "auth", sehingga
| hanya bisa diakses jika user sudah login.
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::get('/transaksi', fn() => view('transaksi'))->name('transaksi');

    Route::get('/analisis', fn() => view('analisis'))->name('analisis');

    Route::get('/pengaturan', fn() => view('pengaturan'))->name('pengaturan');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
