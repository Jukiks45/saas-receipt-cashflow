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
    <div class="bg-white py-8 px-4 border border-slate-200/80 shadow-premium rounded-2xl sm:px-10">
        <form class="space-y-5" action="#" method="POST" onsubmit="event.preventDefault(); window.location.href='{{ route('dashboard') }}';">
            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-500 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-regular fa-envelope text-xs"></i>
                    </span>
                    <input id="email" name="email" type="email" required placeholder="nama@email.com" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
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

            <!-- Submit Button (Direct to Dashboard for prototype) -->
            <div>
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-xs font-semibold text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-primary/15 transition-all duration-200">
                    Masuk ke Dashboard
                </button>
            </div>
        </form>

        <!-- Aesthetic Separator -->
        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="bg-white px-2 text-[10px] text-slate-400 uppercase tracking-wider">Atau masuk dengan</span>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3">
                <!-- Google Sign in -->
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-slate-200 rounded-xl bg-white text-xs font-semibold text-slate-600 shadow-sm hover:bg-slate-50 transition-colors">
                    <i class="fa-brands fa-google text-slate-400 text-sm mr-2"></i> Google
                </a>
                <!-- Github Sign in -->
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-slate-200 rounded-xl bg-white text-xs font-semibold text-slate-600 shadow-sm hover:bg-slate-50 transition-colors">
                    <i class="fa-brands fa-github text-slate-400 text-sm mr-2"></i> Github
                </a>
            </div>
        </div>
    </div>
    
    <!-- Link to Register -->
    <p class="mt-6 text-center text-xs text-slate-500">
        Belum memiliki akun?
        <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-blue-700 transition-colors">Daftar secara gratis</a>.
    </p>
</div>
@endsection
