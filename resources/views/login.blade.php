@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <!-- Brand Logo / Name -->
    <div class="flex justify-center">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-primary to-blue-400 flex items-center justify-center text-white shadow-lg shadow-primary/20">
            <i class="fa-solid fa-brain text-xl"></i>
        </div>
    </div>
    <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-slate-800">
        AI Smart Finance
    </h2>
    <p class="mt-1.5 text-center text-xs text-slate-400">
        Kelola arus kas secara otomatis dengan kecerdasan buatan.
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">

    @if (session('success'))
        <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-xs px-4 py-3 space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white py-8 px-4 border border-slate-200/80 shadow-premium rounded-2xl sm:px-10">
        <form class="space-y-5" action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-500 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-regular fa-envelope text-xs"></i>
                    </span>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                </div>
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold text-slate-500">Kata Sandi</label>
                    <a href="#" class="text-[10px] font-semibold text-primary hover:text-blue-700 transition-colors">Lupa sandi?</a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                    <input id="password" name="password" type="password" required placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                </div>
            </div>

            <!-- Remember me checkbox -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary/20">
                    <label for="remember-me" class="ml-2 block text-xs text-slate-500">Ingat perangkat saya</label>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-xs font-semibold text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-primary/15 transition-all duration-200">
                    Masuk ke Dashboard
                </button>
            </div>
        </form>
    </div>
    
    <!-- Link to Register -->
    <p class="mt-6 text-center text-xs text-slate-500">
        Belum memiliki akun?
        <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-blue-700 transition-colors">Daftar secara gratis</a>.
    </p>
</div>
@endsection
