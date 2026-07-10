@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <!-- Brand Logo / Name -->
    <div class="flex justify-center">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-primary to-blue-400 flex items-center justify-center text-white shadow-lg shadow-primary/20">
            <i class="fa-solid fa-brain text-xl"></i>
        </div>
    </div>
    <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-slate-800">
        Daftar Akun Baru
    </h2>
    <p class="mt-1.5 text-center text-xs text-slate-400">
        Bergabunglah untuk mengotomatisasi keuangan Anda hari ini.
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">

    @if ($errors->any())
        <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-xs px-4 py-3 space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white py-8 px-4 border border-slate-200/80 shadow-premium rounded-2xl sm:px-10">
        <form class="space-y-4" action="{{ route('register.attempt') }}" method="POST">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-500 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-regular fa-user text-xs"></i>
                    </span>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus placeholder="Budi Wijaya" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-500 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-regular fa-envelope text-xs"></i>
                    </span>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-slate-500 mb-1.5">Kata Sandi Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                    <input id="password" name="password" type="password" required placeholder="Min. 8 Karakter" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-slate-500 mb-1.5">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                    <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Ulangi Kata Sandi" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                </div>
            </div>

            <!-- Terms & Conditions checkbox -->
            <div class="flex items-center">
                <input id="agree-terms" name="agree-terms" type="checkbox" required class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                <label for="agree-terms" class="ml-2 block text-xs text-slate-500">Saya menyetujui <a href="#" class="text-primary font-semibold hover:text-blue-700 transition-colors">Syarat & Ketentuan</a> sistem.</label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-xs font-semibold text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-primary/15 transition-all duration-200">
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
    
    <!-- Link to Login -->
    <p class="mt-6 text-center text-xs text-slate-500">
        Sudah memiliki akun?
        <a href="{{ route('login') }}" class="font-semibold text-primary hover:text-blue-700 transition-colors">Masuk ke Akun Anda</a>.
    </p>
</div>
@endsection
