@extends('layouts.app')

@section('title', 'Analisis')
@section('page_title', 'Analisis Keuangan')

@section('content')
<!-- Top Grid: Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 md:mb-8">
    <!-- Pie Chart: Pengeluaran per Kategori -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300">
        <div class="mb-4">
            <h3 class="text-sm md:text-base font-bold text-slate-800">Distribusi Pengeluaran</h3>
            <p class="text-xs text-slate-400 mt-0.5">Pembagian total pengeluaran berdasarkan kategori utama</p>
        </div>
        <div class="relative w-full h-64 flex items-center justify-center">
            <canvas id="categoryPieChart"></canvas>
        </div>
    </div>

    <!-- Bar Chart: Perbandingan Arus Kas Bulanan -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300">
        <div class="mb-4">
            <h3 class="text-sm md:text-base font-bold text-slate-800">Pemasukan vs Pengeluaran</h3>
            <p class="text-xs text-slate-400 mt-0.5">Statistik komparatif arus kas per bulan</p>
        </div>
        <div class="relative w-full h-64">
            <canvas id="comparisonBarChart"></canvas>
        </div>
    </div>
</div>

<!-- Bottom Grid: KPI & AI Insights -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Card 1: Kategori Terbesar -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kategori Terbesar</span>
                <span class="text-xs font-medium text-rose-600 bg-rose-50 px-2 py-0.5 rounded-lg border border-rose-100/50">Prioritas Tinggi</span>
            </div>
            <h4 class="text-xl font-bold text-slate-800">SaaS & Cloud Tools</h4>
            <p class="text-2xl font-bold text-rose-600 mt-1">Rp 6.840.000</p>
            <p class="text-xs text-slate-400 mt-1">Mengambil 55% dari total pengeluaran Anda.</p>
        </div>

        <div class="space-y-3 mt-6">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Rincian Lainnya</span>
            
            <!-- Item 1 -->
            <div>
                <div class="flex justify-between text-xs font-medium mb-1">
                    <span class="text-slate-600">SaaS Cloud & Tools</span>
                    <span class="text-slate-800">55%</span>
                </div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-primary h-full rounded-full" style="width: 55%"></div>
                </div>
            </div>

            <!-- Item 2 -->
            <div>
                <div class="flex justify-between text-xs font-medium mb-1">
                    <span class="text-slate-600">Belanja Modal</span>
                    <span class="text-slate-800">33%</span>
                </div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-400 h-full rounded-full" style="width: 33%"></div>
                </div>
            </div>

            <!-- Item 3 -->
            <div>
                <div class="flex justify-between text-xs font-medium mb-1">
                    <span class="text-slate-600">Lain-lain</span>
                    <span class="text-slate-800">12%</span>
                </div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-slate-300 h-full rounded-full" style="width: 12%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Pengeluaran Bulan Ini (Progress Limit) -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-premium transition-all duration-300 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Batas Anggaran</span>
                <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-100/50">Aman</span>
            </div>
            <h4 class="text-xl font-bold text-slate-800">Sisa Anggaran Belanja</h4>
            <p class="text-2xl font-bold text-primary mt-1">Rp 2.550.000</p>
            <p class="text-xs text-slate-400 mt-1">Terpakai Rp 12.450.000 dari limit Rp 15.000.000.</p>
        </div>

        <div class="flex flex-col items-center justify-center py-6">
            <!-- Circular Progress Indicator or Advanced Progress representation -->
            <div class="relative w-28 h-28 flex items-center justify-center">
                <!-- Circular graphic using SVG -->
                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                    <path class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    <path class="text-primary transition-all duration-1000 ease-out" stroke-dasharray="83, 100" stroke-width="3.2" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                </svg>
                <div class="absolute text-center">
                    <span class="text-lg font-bold text-slate-800">83%</span>
                    <span class="text-[9px] text-slate-400 block uppercase">Terpakai</span>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between text-xs text-slate-400 mb-1">
                <span>Anggaran Bulanan</span>
                <span class="font-semibold text-slate-700">Rp 15.000.000</span>
            </div>
            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                <div class="bg-primary h-full rounded-full" style="width: 83%"></div>
            </div>
        </div>
    </div>

    <!-- Card 3: Insight AI -->
    <div class="bg-gradient-to-br from-slate-900 via-slate-950 to-blue-950 border border-slate-900 rounded-2xl p-5 md:p-6 shadow-xl hover:shadow-hover-card transition-all duration-300 text-white flex flex-col justify-between relative overflow-hidden group">
        <!-- Glowing gradient effect in background -->
        <div class="absolute -right-16 -top-16 w-32 h-32 bg-primary/20 rounded-full blur-2xl group-hover:bg-primary/30 transition-all duration-500"></div>
        <div class="absolute -left-16 -bottom-16 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-5">
                <span class="text-xs font-semibold text-primary-400 bg-primary/10 border border-primary/25 px-2.5 py-1 rounded-xl flex items-center gap-1.5">
                    <i class="fa-solid fa-wand-magic-sparkles animate-pulse"></i> AI Advisor
                </span>
                <span class="text-[10px] text-slate-500">Terbaru hari ini</span>
            </div>
            
            <h4 class="text-sm font-bold text-slate-100 mb-3">Analisis Rekomendasi Keuangan:</h4>
            
            <ul class="space-y-3.5 text-xs text-slate-300">
                <li class="flex items-start gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-primary/20 text-primary-400 flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">1</span>
                    <p class="leading-relaxed">Langganan <strong class="text-slate-100">AWS Cloud</strong> naik 18% dari bulan lalu. Pertimbangkan untuk meninjau instansi tak terpakai.</p>
                </li>
                <li class="flex items-start gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-primary/20 text-primary-400 flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">2</span>
                    <p class="leading-relaxed">Pengeluaran kategori <strong class="text-slate-100">Hiburan & F&B</strong> hemat Rp 450.000 dibanding periode sebelumnya.</p>
                </li>
                <li class="flex items-start gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-primary/20 text-primary-400 flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">3</span>
                    <p class="leading-relaxed">Arus kas stabil. Direkomendasikan mengalihkan <strong class="text-slate-100">Rp 2.000.000</strong> ke tabungan berjangka.</p>
                </li>
            </ul>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-800/80 relative z-10 flex justify-between items-center">
            <span class="text-[10px] text-slate-500">Skor Kesehatan Keuangan</span>
            <span class="text-xs font-bold text-emerald-400">92/100 (Sangat Baik)</span>
        </div>
    </div>
</div>

<!-- Charts JavaScript Initialization -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // --- 1. Category Pie Chart ---
        const pieCtx = document.getElementById('categoryPieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['SaaS Cloud', 'Belanja Modal', 'Makanan & Minuman', 'Hiburan', 'Utilitas'],
                datasets: [{
                    data: [6840000, 4200000, 1079000, 1181000, 1150000],
                    backgroundColor: [
                        '#2563EB', // Blue-600 (Primary)
                        '#818CF8', // Indigo-400
                        '#F59E0B', // Amber-500
                        '#8B5CF6', // Purple-500
                        '#94A3B8'  // Slate-400
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                family: 'Poppins',
                                size: 11
                            },
                            boxWidth: 12,
                            padding: 15
                        }
                    },
                    tooltip: {
                        padding: 10,
                        backgroundColor: '#1E293B',
                        titleFont: { family: 'Poppins', size: 12 },
                        bodyFont: { family: 'Poppins', size: 11 },
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                return ' ' + context.label + ': ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });

        // --- 2. Comparison Bar Chart ---
        const barCtx = document.getElementById('comparisonBarChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: [15600000, 18200000, 17800000, 22400000, 21900000, 24800000],
                        backgroundColor: '#10B981', // Emerald-500
                        borderRadius: 6,
                        maxBarThickness: 15
                    },
                    {
                        label: 'Pengeluaran',
                        data: [10200000, 11400000, 9800000, 14200000, 13100000, 12450000],
                        backgroundColor: '#2563EB', // Blue-600
                        borderRadius: 6,
                        maxBarThickness: 15
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
                            font: { family: 'Poppins', size: 11 },
                            boxWidth: 12,
                            padding: 15
                        }
                    },
                    tooltip: {
                        padding: 10,
                        backgroundColor: '#1E293B',
                        titleFont: { family: 'Poppins', size: 12 },
                        bodyFont: { family: 'Poppins', size: 11 },
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.dataset.label + ': ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        grid: {
                            color: '#E2E8F0',
                            borderDash: [5, 5]
                        },
                        ticks: {
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
