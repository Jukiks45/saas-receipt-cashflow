@extends('layouts.app')

@section('title', 'Pengaturan')
@section('page_title', 'Pengaturan Akun')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 md:space-y-8">
    <!-- Profile Card Header (Aesthetic Cover) -->
    <div class="relative bg-white border border-slate-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-premium transition-all duration-300">
        <!-- Cover Gradient -->
        <div class="h-32 md:h-40 bg-gradient-to-r from-primary via-indigo-600 to-blue-500 relative">
            <div class="absolute inset-0 bg-slate-950/10"></div>
        </div>
        
        <!-- Profile Picture & Quick Metadata -->
        <div class="px-6 pb-6 pt-0 relative flex flex-col sm:flex-row sm:items-end justify-between gap-4 -mt-10 sm:-mt-12 z-10">
            <div class="flex flex-col sm:flex-row items-center sm:items-end gap-4 text-center sm:text-left">
                <div class="relative group cursor-pointer">
                    <img class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-cover border-4 border-white shadow-md bg-white" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=150" alt="Avatar User Big">
                    <div class="absolute inset-0 bg-black/40 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <i class="fa-solid fa-camera text-white text-base"></i>
                    </div>
                </div>
                <div class="sm:mb-2">
                    <h3 class="text-lg md:text-xl font-bold text-slate-800">{{ auth()->user()->name }}</h3>
                    <p class="text-xs text-slate-400">Anggota Premium &bull; Terdaftar sejak {{ auth()->user()->created_at->translatedFormat('M Y') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:mb-2 justify-center">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/10">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Telegram Aktif
                </span>
            </div>
        </div>
    </div>

    <!-- Main Settings Form Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Navigation Tabs / Info sidebar -->
        <div class="space-y-1">
            <button class="w-full text-left px-4 py-2.5 rounded-xl text-xs font-semibold bg-primary/10 text-primary border border-primary/15 transition-all">
                <i class="fa-regular fa-user mr-2"></i> Profil Pengguna
            </button>
            <button class="w-full text-left px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all border border-transparent">
                <i class="fa-solid fa-shield-halved mr-2"></i> Keamanan & Sandi
            </button>
            <button class="w-full text-left px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all border border-transparent">
                <i class="fa-regular fa-bell mr-2"></i> Notifikasi AI
            </button>
        </div>

        <!-- Settings Inputs Panel -->
        <div class="md:col-span-2 space-y-6">
            <!-- Profile Information Details Card -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300">
                <div class="border-b border-slate-100 pb-4 mb-5">
                    <h4 class="text-sm font-bold text-slate-800">Detail Profil</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Kelola data profil utama Anda untuk verifikasi slip & struk.</p>
                </div>

                <div class="space-y-4">
                    <!-- Name Input -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                <i class="fa-regular fa-user text-xs"></i>
                            </span>
                            <input type="text" value="{{ auth()->user()->name }}" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 font-medium focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                                <i class="fa-regular fa-envelope text-xs"></i>
                            </span>
                            <input type="email" value="{{ auth()->user()->email }}" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 font-medium focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>
                    </div>

                    <!-- Telegram Number Input -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Nomor Telegram</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-sky-500">
                                <i class="fa-brands fa-telegram text-sm"></i>
                            </span>
                            <input type="text" value="+6281234567890" class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 font-medium focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">Digunakan untuk menerima notifikasi pengeluaran otomatis dari bot AI.</p>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-3 mt-6 pt-5 border-t border-slate-100">
                    <button type="button" class="text-xs font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 px-4 py-2.5 rounded-xl transition-all flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-key text-slate-400"></i> Ganti Password
                    </button>
                    <button type="button" class="text-xs font-semibold text-white bg-primary hover:bg-blue-700 px-4 py-2.5 rounded-xl shadow-sm shadow-primary/15 transition-all flex items-center justify-center gap-1.5">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </div>

            <!-- Additional Premium Automation Settings Section -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300">
                <div class="border-b border-slate-100 pb-4 mb-5">
                    <h4 class="text-sm font-bold text-slate-800">Notifikasi Automasi AI</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Atur pengiriman info keuangan melalui bot Telegram Anda.</p>
                </div>

                <div class="space-y-4">
                    <!-- Toggle 1 -->
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-700 block">Laporan Ringkasan Harian</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Kirim rekap pemasukan/pengeluaran jam 20.00 WIB.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>

                    <!-- Toggle 2 -->
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-700 block">Peringatan Anggaran (Limit Alert)</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Notifikasi instan jika pengeluaran melebihi 80% anggaran.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>

                    <!-- Toggle 3 -->
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-slate-700 block">Deteksi Anomali AI</span>
                            <span class="text-[10px] text-slate-400 block mt-0.5">Laporkan transaksi mencurigakan atau duplikasi struk secara langsung.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
