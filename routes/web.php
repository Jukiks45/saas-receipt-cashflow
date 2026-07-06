<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('dashboard'))->name('dashboard');

Route::get('/transaksi', fn() => view('transaksi'))->name('transaksi');

Route::get('/analisis', fn() => view('analisis'))->name('analisis');

Route::get('/pengaturan', fn() => view('pengaturan'))->name('pengaturan');

Route::get('/login', fn() => view('login'))->name('login');

Route::get('/register', fn() => view('register'))->name('register');

