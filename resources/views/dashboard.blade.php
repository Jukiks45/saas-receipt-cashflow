@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Ringkasan Dashboard')

@section('content')
<!-- Welcome Alert banner / Aesthetic detail -->
<div class="mb-6 md:mb-8 bg-gradient-to-r from-primary/10 via-blue-500/5 to-transparent border border-primary/15 rounded-2xl p-4 md:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
    <div>
        <h2 class="text-base md:text-lg font-bold text-slate-800">Selamat datang kembali, Budi Wijaya! 👋</h2>
        <p class="text-xs md:text-sm text-slate-500 mt-1">Sistem AI memprediksi arus kas Anda akan tetap positif selama 30 hari ke depan dengan tingkat akurasi 94%.</p>
    </div>
    <div class="flex items-center gap-2">
        <span class="text-xs font-semibold text-primary bg-white border border-primary/20 rounded-xl px-3 py-1.5 shadow-sm">
            <i class="fa-solid fa-wand-magic-sparkles mr-1.5 animate-pulse"></i> AI Insight Aktif
        </span>
    </div>
</div>

<!-- 5 Summary Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 md:gap-6 mb-6 md:mb-8">
    <!-- Card 1: Total Pemasukan -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-premium hover:border-primary/20 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-medium text-slate-400">Total Pemasukan</span>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-100 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-arrow-trend-up text-sm"></i>
            </div>
        </div>
        <div>
            <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-800 group-hover:text-primary transition-colors">Rp 24.800.000</h3>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="inline-flex items-center gap-0.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg">
                    <i class="fa-solid fa-caret-up"></i> +12.4%
                </span>
                <span class="text-[10px] text-slate-400">vs bulan lalu</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Pengeluaran -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-premium hover:border-primary/20 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-medium text-slate-400">Total Pengeluaran</span>
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-100 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-arrow-trend-down text-sm"></i>
            </div>
        </div>
        <div>
            <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-800">Rp 12.450.000</h3>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="inline-flex items-center gap-0.5 text-xs font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-lg">
                    <i class="fa-solid fa-caret-down"></i> -8.2%
                </span>
                <span class="text-[10px] text-slate-400">vs bulan lalu</span>
            </div>
        </div>
    </div>

    <!-- Card 3: Saldo Bersih -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-premium hover:border-primary/20 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-medium text-slate-400">Saldo</span>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-100 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-scale-balanced text-sm"></i>
            </div>
        </div>
        <div>
            <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-800">Rp 12.350.000</h3>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="inline-flex items-center gap-0.5 text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-lg">
                    <i class="fa-solid fa-caret-up"></i> +32.1%
                </span>
                <span class="text-[10px] text-slate-400">Arus kas stabil</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Total Transaksi -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-premium hover:border-primary/20 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-medium text-slate-400">Total Transaksi</span>
            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center group-hover:bg-slate-100 group-hover:scale-105 transition-all duration-300">
                <i class="fa-solid fa-receipt text-sm"></i>
            </div>
        </div>
        <div>
            <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-800">148 Transaksi</h3>
            <div class="flex items-center gap-1.5 mt-2">
                <span class="inline-flex items-center gap-0.5 text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-lg">
                    <i class="fa-solid fa-plus text-[10px]"></i> 15 Hari ini
                </span>
                <span class="text-[10px] text-slate-400">Frekuensi tinggi</span>
            </div>
        </div>
    </div>

    <!-- Card 5: AI Health Score -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-premium hover:border-primary/20 transition-all duration-300 group relative overflow-hidden">
        <!-- Background Glow -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-emerald-400/10 to-blue-400/10 rounded-full blur-2xl"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-medium text-slate-400">AI Health Score</span>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-50 to-blue-50 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-all duration-300">
                    <i class="fa-solid fa-brain text-sm"></i>
                </div>
            </div>
            <div class="flex items-end gap-3">
                <div>
                    <h3 class="text-3xl md:text-4xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-blue-600">92%</h3>
                    <div class="flex items-center gap-1.5 mt-2">
                        <span class="inline-flex items-center gap-0.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg">
                            <i class="fa-solid fa-caret-up"></i> Sehat
                        </span>
                        <span class="text-[10px] text-slate-400">Skor finansial</span>
                    </div>
                </div>
                <!-- Mini Circular Progress -->
                <div class="ml-auto relative w-12 h-12">
                    <svg class="w-12 h-12 -rotate-90" viewBox="0 0 36 36">
                        <circle cx="18" cy="18" r="15.5" fill="none" stroke="#E2E8F0" stroke-width="3"></circle>
                        <circle cx="18" cy="18" r="15.5" fill="none" stroke="url(#healthGradient)" stroke-width="3" stroke-dasharray="97.4" stroke-dashoffset="7.8" stroke-linecap="round"></circle>
                        <defs>
                            <linearGradient id="healthGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#10B981"></stop>
                                <stop offset="100%" stop-color="#2563EB"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="grid grid-cols-1 gap-6 mb-6 md:mb-8">
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h3 class="text-sm md:text-base font-bold text-slate-800">Laporan Arus Kas</h3>
                <p class="text-xs text-slate-400 mt-0.5">Analisis bulanan pemasukan versus pengeluaran</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="flex items-center gap-1 text-xs text-slate-500 bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5">
                    <i class="fa-regular fa-calendar-days text-[11px] text-slate-400"></i> Jan - Jun 2026
                </span>
                <button class="text-xs font-medium text-primary hover:bg-primary/5 border border-primary/20 rounded-xl px-3 py-1.5 transition-colors">
                    <i class="fa-solid fa-download mr-1"></i> Ekspor PDF
                </button>
            </div>
        </div>

        <div class="relative w-full h-[300px] md:h-[350px]">
            <canvas id="cashFlowChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Transactions Table Section -->
<div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-sm md:text-base font-bold text-slate-800">Transaksi Terakhir</h3>
            <p class="text-xs text-slate-400 mt-0.5">Daftar transaksi terbaru yang diproses oleh sistem</p>
        </div>
        <a href="{{ route('transaksi') }}" class="text-xs font-semibold text-primary hover:text-primary-700 flex items-center gap-1 group transition-colors">
            Lihat Semua <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform"></i>
        </a>
    </div>

    <!-- Responsive Table Container -->
    <div class="overflow-x-auto -mx-5 md:-mx-6">
        <div class="inline-block min-w-full align-middle px-5 md:px-6">
            <table class="min-w-full divide-y divide-slate-100">
                <thead>
                    <tr class="text-left text-xs font-semibold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                        <th class="py-3 px-4 rounded-l-xl">Tanggal</th>
                        <th class="py-3 px-4">Merchant / Pengirim</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Nominal</th>
                        <th class="py-3 px-4 rounded-r-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/80">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="py-3.5 px-4 text-xs font-medium text-slate-500 whitespace-nowrap">06 Jul 2026</td>
                        <td class="py-3.5 px-4 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-[11px] border border-orange-100">
                                AWS
                            </div>
                            Amazon Web Services
                        </td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2 py-1 rounded-lg font-medium">SaaS Cloud</span>
                        </td>
                        <td class="py-3.5 px-4 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 1.450.000</td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/10">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Berhasil
                            </span>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="py-3.5 px-4 text-xs font-medium text-slate-500 whitespace-nowrap">05 Jul 2026</td>
                        <td class="py-3.5 px-4 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-[11px] border border-blue-100">
                                SW
                            </div>
                            SaaS Work Inc
                        </td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-1 rounded-lg font-medium">Proyek Freelance</span>
                        </td>
                        <td class="py-3.5 px-4 text-xs font-bold text-emerald-600 whitespace-nowrap">+ Rp 14.500.000</td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/10">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Berhasil
                            </span>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="py-3.5 px-4 text-xs font-medium text-slate-500 whitespace-nowrap">04 Jul 2026</td>
                        <td class="py-3.5 px-4 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-[11px] border border-red-100">
                                NF
                            </div>
                            Netflix Subscription
                        </td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="bg-violet-50 text-violet-700 border border-violet-100 px-2 py-1 rounded-lg font-medium">Hiburan</span>
                        </td>
                        <td class="py-3.5 px-4 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 186.000</td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/10">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Berhasil
                            </span>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="py-3.5 px-4 text-xs font-medium text-slate-500 whitespace-nowrap">03 Jul 2026</td>
                        <td class="py-3.5 px-4 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-[11px] border border-rose-100">
                                CF
                            </div>
                            Coffee Shop Jakarta
                        </td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="bg-amber-50 text-amber-700 border border-amber-100 px-2 py-1 rounded-lg font-medium">Makanan & Minuman</span>
                        </td>
                        <td class="py-3.5 px-4 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 95.000</td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 ring-1 ring-amber-600/10">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span> Pending
                            </span>
                        </td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="py-3.5 px-4 text-xs font-medium text-slate-500 whitespace-nowrap">02 Jul 2026</td>
                        <td class="py-3.5 px-4 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-[11px] border border-indigo-100">
                                AD
                            </div>
                            Adobe Creative Cloud
                        </td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2 py-1 rounded-lg font-medium">SaaS Design</span>
                        </td>
                        <td class="py-3.5 px-4 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 715.000</td>
                        <td class="py-3.5 px-4 text-xs whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 ring-1 ring-rose-600/10">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span> Gagal
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('cashFlowChart').getContext('2d');

        // Linear Gradient for background fills
        const incomeGradient = ctx.createLinearGradient(0, 0, 0, 300);
        incomeGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)'); // Emerald fade
        incomeGradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

        const expenseGradient = ctx.createLinearGradient(0, 0, 0, 300);
        expenseGradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)'); // Primary Blue fade
        expenseGradient.addColorStop(1, 'rgba(37, 99, 235, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: [15600000, 18200000, 17800000, 22400000, 21900000, 24800000],
                        borderColor: '#10B981',
                        borderWidth: 2.5,
                        backgroundColor: incomeGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#10B981',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#10B981',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2,
                    },
                    {
                        label: 'Pengeluaran',
                        data: [10200000, 11400000, 9800000, 14200000, 13100000, 12450000],
                        borderColor: '#2563EB',
                        borderWidth: 2.5,
                        backgroundColor: expenseGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#2563EB',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#2563EB',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Poppins',
                                size: 12
                            },
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        padding: 12,
                        backgroundColor: '#1E293B',
                        titleFont: {
                            family: 'Poppins',
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Poppins',
                            size: 12
                        },
                        cornerRadius: 12,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Poppins',
                                size: 11
                            },
                            color: '#64748B'
                        }
                    },
                    y: {
                        grid: {
                            color: '#E2E8F0',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            font: {
                                family: 'Poppins',
                                size: 11
                            },
                            color: '#64748B',
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + 'jt';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
