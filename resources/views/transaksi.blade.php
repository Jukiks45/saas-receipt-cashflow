@extends('layouts.app')

@section('title', 'Transaksi')
@section('page_title', 'Kelola Transaksi')

@section('content')
<!-- Page Header Action Panel -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 md:mb-8">
    <div>
        <p class="text-xs text-slate-400" id="transaction-count">Total 148 transaksi harian tercatat bulan ini</p>
    </div>
    <div class="flex items-center gap-3">
        <button onclick="openUploadModal()" class="flex items-center gap-2 text-xs font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-4 py-2.5 rounded-xl shadow-sm transition-all duration-200">
            <i class="fa-solid fa-file-arrow-up text-slate-400"></i> Upload Struk
        </button>
        <button onclick="openManualModal()" class="flex items-center gap-2 text-xs font-semibold bg-primary hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl shadow-sm shadow-primary/10 hover:shadow-lg hover:shadow-primary/20 transition-all duration-200">
            <i class="fa-solid fa-plus"></i> Tambah Transaksi
        </button>
    </div>
</div>

<!-- Filters Panel -->
<div class="bg-white border border-slate-200/80 rounded-2xl p-4 mb-6 shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <!-- Search bar -->
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </div>
            <input type="text" id="searchInput" oninput="filterTransactions()" placeholder="Cari nama merchant, nominal, atau kategori..." class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
        </div>

        <!-- Filter dropdowns -->
        <div class="flex flex-wrap items-center gap-3">
            <select id="categoryFilter" onchange="filterTransactions()" class="bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-600 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                <option value="">Semua Kategori</option>
                <option value="saas-cloud">SaaS Cloud & Tools</option>
                <option value="freelance">Freelance Proyek</option>
                <option value="makanan">Makanan & Minuman</option>
                <option value="hiburan">Hiburan</option>
                <option value="utilitas">Utilitas</option>
                <option value="gaji">Gaji & Pemasukan</option>
                <option value="belanja">Belanja Modal</option>
            </select>

            <select id="paymentFilter" onchange="filterTransactions()" class="bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-600 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
                <option value="">Metode Pembayaran</option>
                <option value="kartu-kredit">Kartu Kredit</option>
                <option value="transfer">Transfer Bank</option>
                <option value="qris">QRIS</option>
                <option value="ewallet">E-Wallet</option>
            </select>

            <button onclick="resetFilters()" class="flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl px-3 py-2.5 transition-colors">
                <i class="fa-solid fa-filter text-[10px]"></i> Reset Filter
            </button>
        </div>
    </div>
</div>

<!-- EMPTY STATE -->
<div id="emptyState" class="hidden bg-white border border-slate-200/80 rounded-2xl p-12 shadow-sm text-center">
    <div class="max-w-md mx-auto">
        <div class="w-20 h-20 mx-auto mb-6 bg-slate-50 rounded-full flex items-center justify-center border-2 border-dashed border-slate-200">
            <i class="fa-solid fa-receipt text-3xl text-slate-300"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-700 mb-2">Belum Ada Transaksi</h3>
        <p class="text-sm text-slate-400 mb-8">Upload struk pertama Anda untuk mulai mencatat pengeluaran secara otomatis dengan AI.</p>
        <div class="flex items-center justify-center gap-3">
            <button onclick="openUploadModal()" class="inline-flex items-center gap-2 text-sm font-semibold bg-primary hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow-sm shadow-primary/10 hover:shadow-lg hover:shadow-primary/20 transition-all duration-200">
                <i class="fa-solid fa-file-arrow-up"></i> Upload Struk Pertama
            </button>
            <button onclick="openManualModal()" class="inline-flex items-center gap-2 text-sm font-semibold bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-5 py-3 rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-plus"></i> Tambah Manual
            </button>
        </div>
    </div>
</div>

<!-- Transactions Table List (Grouped by Date) -->
<div id="transactionTable" class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="text-left text-xs font-semibold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                    <th class="py-4 px-6 w-32">Waktu</th>
                    <th class="py-4 px-6">Merchant / Penerima</th>
                    <th class="py-4 px-6">Kategori</th>
                    <th class="py-4 px-6">Nominal</th>
                    <th class="py-4 px-6">Metode</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="transactionBody" class="divide-y divide-slate-100/60">
                <!-- GROUP 1: HARI INI -->
                <tr class="bg-slate-50/60 text-[11px] font-bold text-slate-500 date-group">
                    <td colspan="6" class="py-2.5 px-6 border-y border-slate-100">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide">HARI INI &bull; Senin, 06 Jul 2026</span>
                            <span class="text-slate-400 font-medium" id="todayTotal">Total Pengeluaran: <strong class="text-rose-600 font-bold">Rp 1.450.000</strong></span>
                        </div>
                    </td>
                </tr>
                <!-- Row 1 - Transaction from Upload Struk (OCR Result) -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="makanan" data-payment="qris" data-search="kopi nusantara coffee minuman">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">15:45 WIB</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-[11px] border border-amber-100 relative">
                            <i class="fa-solid fa-camera text-[10px]"></i>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-500 rounded-full flex items-center justify-center"><i class="fa-solid fa-check text-white" style="font-size: 6px;"></i></span>
                        </div>
                        Kopi Nusantara
                        <span class="text-[10px] bg-emerald-50 text-emerald-600 px-1.5 py-0.5 rounded font-medium">OCR</span>
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-amber-50 text-amber-700 border border-amber-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">Makanan & Minuman</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 45.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-[10px] font-semibold">QRIS</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="saas-cloud" data-payment="kartu-kredit" data-search="amazon web services aws cloud">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">14:30 WIB</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-[11px] border border-orange-100">AWS</div>
                        Amazon Web Services
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">SaaS Cloud</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 1.450.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded text-[10px] font-semibold">Kartu Kredit</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>

                <!-- GROUP 2: KEMARIN -->
                <tr class="bg-slate-50/60 text-[11px] font-bold text-slate-500 date-group">
                    <td colspan="6" class="py-2.5 px-6 border-y border-slate-100">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide">KEMARIN &bull; Minggu, 05 Jul 2026</span>
                            <span class="text-slate-400 font-medium">Saldo Harian: <strong class="text-emerald-600 font-bold">+Rp 14.314.000</strong></span>
                        </div>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="freelance" data-payment="transfer" data-search="saas work freelance proyek">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">10:15 WIB</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-[11px] border border-emerald-100">SW</div>
                        SaaS Work Freelance
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">Proyek Freelance</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-emerald-600 whitespace-nowrap">+ Rp 14.500.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded text-[10px] font-semibold">Transfer Bank</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Row 4 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="hiburan" data-payment="ewallet" data-search="netflix subscription hiburan film">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">08:00 WIB</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center font-bold text-[11px] border border-red-100">NF</div>
                        Netflix Subscription
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-violet-50 text-violet-700 border border-violet-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">Hiburan</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 186.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-purple-50 text-purple-700 px-2 py-0.5 rounded text-[10px] font-semibold">E-Wallet</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>

                <!-- GROUP 3: LEBIH LAMA -->
                <tr class="bg-slate-50/60 text-[11px] font-bold text-slate-500 date-group">
                    <td colspan="6" class="py-2.5 px-6 border-y border-slate-100">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide">JUMAT &bull; 03 Jul 2026</span>
                            <span class="text-slate-400 font-medium">Total Pengeluaran: <strong class="text-rose-600 font-bold">Rp 810.000</strong></span>
                        </div>
                    </td>
                </tr>
                <!-- Row 5 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="makanan" data-payment="qris" data-search="coffee shop jakarta minuman kopi">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">17:45 WIB</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-[11px] border border-rose-100">CF</div>
                        Coffee Shop Jakarta
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-amber-50 text-amber-700 border border-amber-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">Makanan & Minuman</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 95.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-[10px] font-semibold">QRIS</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Row 6 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="saas-cloud" data-payment="kartu-kredit" data-search="adobe creative cloud design">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">11:20 WIB</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-[11px] border border-indigo-100">AD</div>
                        Adobe Creative Cloud
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">SaaS Design</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 715.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded text-[10px] font-semibold">Kartu Kredit</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>

                <!-- GROUP 4: AKHIR JUNI -->
                <tr class="bg-slate-50/60 text-[11px] font-bold text-slate-500 date-group">
                    <td colspan="6" class="py-2.5 px-6 border-y border-slate-100">
                        <div class="flex items-center justify-between">
                            <span class="tracking-wide">LALU &bull; Akhir Juni 2026</span>
                            <span class="text-slate-400 font-medium">Rekap Akhir Bulan</span>
                        </div>
                    </td>
                </tr>
                <!-- Row 7 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="belanja" data-payment="transfer" data-search="tokopedia seller ad modal">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">30 Jun 15:10</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center font-bold text-[11px] border border-green-100">TP</div>
                        Tokopedia Seller Ad
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-rose-50 text-rose-700 border border-rose-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">Belanja Modal</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 4.200.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded text-[10px] font-semibold">Transfer Bank</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Row 8 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="gaji" data-payment="transfer" data-search="gaji bulanan pt tech">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">28 Jun 09:00</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-[11px] border border-blue-100">TC</div>
                        Gaji Bulanan PT Tech
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">Gaji Utama</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-emerald-600 whitespace-nowrap">+ Rp 22.000.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded text-[10px] font-semibold">Transfer Bank</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Row 9 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="utilitas" data-payment="transfer" data-search="tagihan listrik pln">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">25 Jun 10:30</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-[11px] border border-amber-100">PLN</div>
                        Tagihan Listrik PLN
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-slate-100 text-slate-700 border border-slate-200 px-2.5 py-1 rounded-lg font-medium text-[11px]">Utilitas</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 1.150.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded text-[10px] font-semibold">Transfer Bank</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Row 10 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="makanan" data-payment="qris" data-search="grab food delivery">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">22 Jun 19:15</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-[11px] border border-emerald-100">GR</div>
                        Grab Food Delivery
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-amber-50 text-amber-700 border border-amber-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">Makanan & Minuman</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 145.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-[10px] font-semibold">QRIS</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
                <!-- Row 11 -->
                <tr class="hover:bg-slate-50/30 transition-colors duration-150 transaction-row" data-category="saas-cloud" data-payment="kartu-kredit" data-search="figma professional design">
                    <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap font-medium">20 Jun 16:00</td>
                    <td class="py-4 px-6 text-xs font-bold text-slate-800 whitespace-nowrap flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-[11px] border border-purple-100">FG</div>
                        Figma Professional
                    </td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-lg font-medium text-[11px]">SaaS Design</span>
                    </td>
                    <td class="py-4 px-6 text-xs font-bold text-rose-600 whitespace-nowrap">- Rp 240.000</td>
                    <td class="py-4 px-6 text-xs whitespace-nowrap">
                        <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded text-[10px] font-semibold">Kartu Kredit</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-1.5 text-slate-400 hover:text-primary hover:bg-slate-50 rounded-lg transition-all" title="Edit"><i class="fa-solid fa-pen text-xs"></i></button>
                            <button class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-slate-50 rounded-lg transition-all" title="Hapus"><i class="fa-solid fa-trash text-xs"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    <div class="px-6 py-4 flex items-center justify-between border-t border-slate-100 text-xs">
        <span class="text-slate-400" id="paginationInfo">Menampilkan 1-11 dari 11 transaksi</span>
        <div class="flex gap-2">
            <button class="px-3 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 rounded-lg font-medium disabled:opacity-50 transition-colors" disabled>Sebelumnya</button>
            <button class="px-3 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 rounded-lg font-medium transition-colors">Selanjutnya</button>
        </div>
    </div>
</div>

<!-- ========== MODAL: UPLOAD STRUK ========== -->
<div id="uploadModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeUploadModal()"></div>
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Upload Struk Belanja</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Sistem akan membaca struk Anda menggunakan AI</p>
                </div>
                <button onclick="closeUploadModal()" class="w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-600 transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-6">
                <!-- Step Indicator -->
                <div class="flex items-center gap-2 mb-2" id="stepIndicator">
                    <div class="flex items-center gap-1.5">
                        <div class="step-dot active w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">1</div>
                        <span class="text-xs font-medium text-slate-600">Upload</span>
                    </div>
                    <div class="h-px w-12 bg-slate-200 step-line"></div>
                    <div class="flex items-center gap-1.5">
                        <div class="step-dot w-8 h-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xs font-bold">2</div>
                        <span class="text-xs font-medium text-slate-400">OCR & AI</span>
                    </div>
                    <div class="h-px w-12 bg-slate-200 step-line"></div>
                    <div class="flex items-center gap-1.5">
                        <div class="step-dot w-8 h-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xs font-bold">3</div>
                        <span class="text-xs font-medium text-slate-400">Konfirmasi</span>
                    </div>
                </div>

                <!-- STEP 1: Upload Area -->
                <div id="uploadStep">
                    <!-- Drag & Drop Zone -->
                    <div id="dropZone" class="relative border-2 border-dashed border-slate-200 rounded-2xl p-10 text-center hover:border-primary/50 hover:bg-primary/5 transition-all duration-300 cursor-pointer group">
                        <input type="file" id="fileInput" accept="image/*,.pdf" class="absolute inset-0 opacity-0 cursor-pointer" onchange="handleFileUpload(this.files)">
                        <div class="space-y-4">
                            <div class="w-16 h-16 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100 group-hover:bg-primary/10 group-hover:border-primary/20 transition-all">
                                <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-300 group-hover:text-primary transition-colors"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700">Drag & drop file struk di sini</p>
                                <p class="text-xs text-slate-400 mt-1">atau klik untuk memilih file</p>
                            </div>
                            <div class="flex items-center justify-center gap-4 text-[10px] text-slate-400">
                                <span><i class="fa-regular fa-image mr-1"></i> JPG, PNG</span>
                                <span><i class="fa-regular fa-file-pdf mr-1"></i> PDF</span>
                                <span><i class="fa-solid fa-maximize mr-1"></i> Maks 5MB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div id="uploadError" class="hidden mt-4 p-4 bg-rose-50 border border-rose-100 rounded-xl flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-100 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-circle-exclamation text-rose-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-rose-700">Format Tidak Didukung</p>
                            <p class="text-xs text-rose-500 mt-0.5">Upload gagal. Silakan gunakan format JPG, PNG, atau PDF dengan ukuran maksimal 5MB.</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button onclick="closeUploadModal()" class="text-xs font-semibold text-slate-600 bg-slate-50 hover:bg-slate-100 border border-slate-200 px-5 py-2.5 rounded-xl transition-all">Batal</button>
                        <button onclick="simulateOCR()" class="text-xs font-semibold text-primary bg-primary/5 hover:bg-primary/10 border border-primary/20 px-5 py-2.5 rounded-xl transition-all" id="uploadNextBtn" disabled>Pilih File Terlebih Dahulu</button>
                    </div>
                </div>

                <!-- STEP 2: OCR Processing & Result -->
                <div id="ocrStep" class="hidden">
                    <!-- Loading State -->
                    <div id="ocrLoading" class="text-center py-8">
                        <div class="w-16 h-16 mx-auto mb-4 relative">
                            <div class="absolute inset-0 rounded-full border-4 border-slate-100"></div>
                            <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-primary animate-spin"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fa-solid fa-brain text-xl text-primary animate-pulse"></i>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-slate-700">🤖 AI sedang menganalisis struk...</p>
                        <p class="text-xs text-slate-400 mt-1">Memproses OCR dan mengklasifikasikan transaksi</p>
                        <div class="max-w-xs mx-auto mt-4 space-y-2 text-left">
                            <div class="flex items-center gap-2 text-xs text-slate-400" id="ocrStatus1">
                                <div class="w-4 h-4 rounded-full border-2 border-slate-200 flex items-center justify-center">
                                    <div class="w-2 h-2 rounded-full bg-slate-200"></div>
                                </div>
                                Memindai teks dari gambar struk...
                            </div>
                            <div class="flex items-center gap-2 text-xs text-slate-400" id="ocrStatus2">
                                <div class="w-4 h-4 rounded-full border-2 border-slate-200 flex items-center justify-center">
                                    <div class="w-2 h-2 rounded-full bg-slate-200"></div>
                                </div>
                                Mengekstrak merchant & nominal...
                            </div>
                            <div class="flex items-center gap-2 text-xs text-slate-400" id="ocrStatus3">
                                <div class="w-4 h-4 rounded-full border-2 border-slate-200 flex items-center justify-center">
                                    <div class="w-2 h-2 rounded-full bg-slate-200"></div>
                                </div>
                                Mengklasifikasikan kategori dengan AI...
                            </div>
                        </div>
                    </div>

                    <!-- Preview & Result -->
                    <div id="ocrResult" class="hidden space-y-4">
                        <!-- Preview Image -->
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-semibold text-slate-600"><i class="fa-regular fa-image mr-1.5"></i> Preview Struk</span>
                                <span class="text-[10px] bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-full font-medium">✓ Upload Berhasil</span>
                            </div>
                            <div id="imagePreview" class="bg-white rounded-lg border border-slate-100 p-2 max-h-48 overflow-hidden flex items-center justify-center">
                                <!-- Image preview will be inserted here -->
                            </div>
                        </div>

                        <!-- OCR Result -->
                        <div class="bg-emerald-50/50 border border-emerald-100 rounded-xl p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <i class="fa-solid fa-check text-emerald-600" style="font-size: 10px;"></i>
                                </div>
                                <span class="text-xs font-semibold text-emerald-700">✓ OCR Selesai</span>
                                <span class="text-[10px] text-emerald-500">| AI Classification Complete</span>
                            </div>

                            <!-- AI Classified Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Merchant</label>
                                    <input type="text" id="ocrMerchant" value="Kopi Nusantara" class="w-full mt-1 bg-white border border-slate-200 text-xs rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                </div>
                                <div>
                                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Tanggal</label>
                                    <input type="date" id="ocrDate" value="2026-07-06" class="w-full mt-1 bg-white border border-slate-200 text-xs rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                </div>
                                <div>
                                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Nominal (Rp)</label>
                                    <input type="text" id="ocrAmount" value="45.000" class="w-full mt-1 bg-white border border-slate-200 text-xs rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                </div>
                                <div>
                                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">
                                        <i class="fa-solid fa-wand-magic-sparkles text-primary mr-1"></i>
                                        Kategori (AI)
                                    </label>
                                    <select id="ocrCategory" class="w-full mt-1 bg-white border border-primary/30 text-xs rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                        <option value="makanan" selected>🍽️ Makanan & Minuman</option>
                                        <option value="saas-cloud">☁️ SaaS Cloud & Tools</option>
                                        <option value="freelance">💼 Freelance Proyek</option>
                                        <option value="hiburan">🎬 Hiburan</option>
                                        <option value="utilitas">💡 Utilitas</option>
                                        <option value="gaji">💰 Gaji & Pemasukan</option>
                                        <option value="belanja">🛒 Belanja Modal</option>
                                        <option value="transport">🚗 Transportasi</option>
                                        <option value="kesehatan">🏥 Kesehatan</option>
                                        <option value="pendidikan">📚 Pendidikan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Metode Pembayaran</label>
                                    <select id="ocrPayment" class="w-full mt-1 bg-white border border-slate-200 text-xs rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                        <option value="qris" selected>QRIS</option>
                                        <option value="kartu-kredit">Kartu Kredit</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="ewallet">E-Wallet</option>
                                        <option value="tunai">Tunai</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Tipe</label>
                                    <select id="ocrType" class="w-full mt-1 bg-white border border-slate-200 text-xs rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                                        <option value="expense" selected>Pengeluaran</option>
                                        <option value="income">Pemasukan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- AI Confidence -->
                            <div class="mt-3 flex items-center gap-2 text-[10px] text-slate-400 bg-white/50 rounded-lg px-3 py-2">
                                <i class="fa-solid fa-microchip text-primary"></i>
                                <span>AI Confidence: <strong class="text-emerald-600">96%</strong></span>
                                <span class="text-slate-300">|</span>
                                <span>OCR Accuracy: <strong class="text-emerald-600">98%</strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-4">
                        <button onclick="resetUpload()" class="text-xs font-semibold text-slate-600 bg-slate-50 hover:bg-slate-100 border border-slate-200 px-5 py-2.5 rounded-xl transition-all">Upload Ulang</button>
                        <button onclick="saveTransaction()" class="text-xs font-semibold text-white bg-primary hover:bg-blue-700 px-5 py-2.5 rounded-xl shadow-sm shadow-primary/10 hover:shadow-lg hover:shadow-primary/20 transition-all duration-200">
                            <i class="fa-solid fa-check mr-1"></i> Simpan Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL: TAMBAH TRANSAKSI MANUAL ========== -->
<div id="manualModal" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeManualModal()"></div>
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-6 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Tambah Transaksi Manual</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Isi detail transaksi secara manual</p>
                </div>
                <button onclick="closeManualModal()" class="w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-600 transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Nama Merchant</label>
                    <input type="text" id="manualMerchant" placeholder="Contoh: Starbucks, Grab, dll" class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Tanggal</label>
                        <input type="date" id="manualDate" value="2026-07-06" class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                    </div>
                    <div>
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Jam</label>
                        <input type="time" id="manualTime" value="12:00" class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Nominal (Rp)</label>
                    <input type="number" id="manualAmount" placeholder="0" class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                </div>
                <div>
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Kategori</label>
                    <select id="manualCategory" class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                        <option value="makanan">🍽️ Makanan & Minuman</option>
                        <option value="saas-cloud">☁️ SaaS Cloud & Tools</option>
                        <option value="freelance">💼 Freelance Proyek</option>
                        <option value="hiburan">🎬 Hiburan</option>
                        <option value="utilitas">💡 Utilitas</option>
                        <option value="gaji">💰 Gaji & Pemasukan</option>
                        <option value="belanja">🛒 Belanja Modal</option>
                        <option value="transport">🚗 Transportasi</option>
                        <option value="kesehatan">🏥 Kesehatan</option>
                        <option value="pendidikan">📚 Pendidikan</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Metode Pembayaran</label>
                        <select id="manualPayment" class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                            <option value="qris">QRIS</option>
                            <option value="kartu-kredit">Kartu Kredit</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="ewallet">E-Wallet</option>
                            <option value="tunai">Tunai</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Tipe</label>
                        <select id="manualType" class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10">
                            <option value="expense">Pengeluaran</option>
                            <option value="income">Pemasukan</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Catatan (Opsional)</label>
                    <textarea id="manualNote" rows="2" placeholder="Tambahkan catatan..." class="w-full mt-1 bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2.5 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 resize-none"></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 p-6 border-t border-slate-100">
                <button onclick="closeManualModal()" class="text-xs font-semibold text-slate-600 bg-slate-50 hover:bg-slate-100 border border-slate-200 px-5 py-2.5 rounded-xl transition-all">Batal</button>
                <button onclick="saveManualTransaction()" class="text-xs font-semibold text-white bg-primary hover:bg-blue-700 px-5 py-2.5 rounded-xl shadow-sm shadow-primary/10 hover:shadow-lg hover:shadow-primary/20 transition-all duration-200">
                    <i class="fa-solid fa-check mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========== SUCCESS TOAST ========== -->
<div id="successToast" class="fixed bottom-6 right-6 z-[70] hidden">
    <div class="bg-emerald-600 text-white rounded-xl px-5 py-3 shadow-lg shadow-emerald-600/20 flex items-center gap-3 min-w-[280px]">
        <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
            <i class="fa-solid fa-check text-sm"></i>
        </div>
        <div>
            <p class="text-sm font-semibold" id="toastTitle">Berhasil Disimpan!</p>
            <p class="text-[11px] text-emerald-100" id="toastMessage">Transaksi berhasil dicatat.</p>
        </div>
        <button onclick="hideToast()" class="ml-auto text-white/60 hover:text-white">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>
</div>

<!-- ========== JAVASCRIPT ========== -->
<script>
// ==================== MODAL CONTROLS ====================
function openUploadModal() {
    document.getElementById('uploadModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    resetUpload();
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function openManualModal() {
    document.getElementById('manualModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeManualModal() {
    document.getElementById('manualModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// ==================== DRAG & DROP UPLOAD ====================
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const uploadNextBtn = document.getElementById('uploadNextBtn');
const uploadError = document.getElementById('uploadError');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-primary', 'bg-primary/5');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('border-primary', 'bg-primary/5');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-primary', 'bg-primary/5');
    const files = e.dataTransfer.files;
    handleFileUpload(files);
});

function handleFileUpload(files) {
    if (!files || files.length === 0) return;

    const file = files[0];
    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
    const maxSize = 5 * 1024 * 1024; // 5MB

    // Show error if invalid
    if (!validTypes.includes(file.type) || file.size > maxSize) {
        uploadError.classList.remove('hidden');
        uploadNextBtn.disabled = true;
        uploadNextBtn.textContent = 'Pilih File Terlebih Dahulu';
        uploadNextBtn.className = 'text-xs font-semibold text-slate-400 bg-slate-50 border border-slate-200 px-5 py-2.5 rounded-xl cursor-not-allowed';
        return;
    }

    uploadError.classList.add('hidden');
    uploadNextBtn.disabled = false;
    uploadNextBtn.textContent = 'Proses dengan AI →';
    uploadNextBtn.className = 'text-xs font-semibold text-white bg-primary hover:bg-blue-700 px-5 py-2.5 rounded-xl shadow-sm shadow-primary/10 hover:shadow-lg hover:shadow-primary/20 transition-all duration-200 cursor-pointer';

    // Store file for preview
    window.uploadedFile = file;

    // Show preview if it's an image
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            window.uploadedImageData = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function simulateOCR() {
    // Hide upload step, show OCR step
    document.getElementById('uploadStep').classList.add('hidden');
    document.getElementById('ocrStep').classList.remove('hidden');
    document.getElementById('ocrLoading').classList.remove('hidden');
    document.getElementById('ocrResult').classList.add('hidden');

    // Update step indicators
    const dots = document.querySelectorAll('.step-dot');
    dots[0].classList.add('bg-emerald-500', 'text-white');
    dots[0].classList.remove('bg-primary', 'text-white', 'bg-slate-100', 'text-slate-400');
    dots[0].textContent = '✓';
    dots[1].classList.add('active', 'bg-primary', 'text-white');
    dots[1].classList.remove('bg-slate-100', 'text-slate-400');

    // Simulate AI processing with sequential status updates
    setTimeout(() => {
        const s1 = document.getElementById('ocrStatus1');
        s1.querySelector('div:first-child').className = 'w-4 h-4 rounded-full bg-emerald-500 flex items-center justify-center';
        s1.querySelector('div:first-child').innerHTML = '<i class="fa-solid fa-check text-white" style="font-size: 8px;"></i>';
        s1.classList.add('text-emerald-600');
        s1.classList.remove('text-slate-400');
    }, 1500);

    setTimeout(() => {
        const s2 = document.getElementById('ocrStatus2');
        s2.querySelector('div:first-child').className = 'w-4 h-4 rounded-full bg-emerald-500 flex items-center justify-center';
        s2.querySelector('div:first-child').innerHTML = '<i class="fa-solid fa-check text-white" style="font-size: 8px;"></i>';
        s2.classList.add('text-emerald-600');
        s2.classList.remove('text-slate-400');
    }, 3000);

    setTimeout(() => {
        const s3 = document.getElementById('ocrStatus3');
        s3.querySelector('div:first-child').className = 'w-4 h-4 rounded-full bg-emerald-500 flex items-center justify-center';
        s3.querySelector('div:first-child').innerHTML = '<i class="fa-solid fa-check text-white" style="font-size: 8px;"></i>';
        s3.classList.add('text-emerald-600');
        s3.classList.remove('text-slate-400');
    }, 4500);

    // Show result after "AI processing"
    setTimeout(() => {
        document.getElementById('ocrLoading').classList.add('hidden');
        document.getElementById('ocrResult').classList.remove('hidden');

        // Update step indicators
        dots[1].classList.add('bg-emerald-500', 'text-white');
        dots[1].classList.remove('bg-primary', 'text-white');
        dots[1].textContent = '✓';
        dots[2].classList.add('active', 'bg-primary', 'text-white');
        dots[2].classList.remove('bg-slate-100', 'text-slate-400');

        // Show image preview
        const previewDiv = document.getElementById('imagePreview');
        if (window.uploadedImageData) {
            previewDiv.innerHTML = `<img src="${window.uploadedImageData}" class="max-h-40 rounded-lg object-contain" alt="Preview Struk">`;
        } else {
            previewDiv.innerHTML = `
                <div class="flex items-center gap-3 text-xs text-slate-400">
                    <i class="fa-regular fa-file-pdf text-2xl text-rose-400"></i>
                    <span>${window.uploadedFile ? window.uploadedFile.name : 'struk-belanja.pdf'}</span>
                    <span class="text-emerald-500 font-medium">✓ Terupload</span>
                </div>
            `;
        }
    }, 5500);
}

function resetUpload() {
    document.getElementById('uploadStep').classList.remove('hidden');
    document.getElementById('ocrStep').classList.add('hidden');
    document.getElementById('ocrLoading').classList.add('hidden');
    document.getElementById('ocrResult').classList.add('hidden');
    uploadError.classList.add('hidden');

    window.uploadedFile = null;
    window.uploadedImageData = null;

    uploadNextBtn.disabled = true;
    uploadNextBtn.textContent = 'Pilih File Terlebih Dahulu';
    uploadNextBtn.className = 'text-xs font-semibold text-slate-400 bg-slate-50 border border-slate-200 px-5 py-2.5 rounded-xl cursor-not-allowed';

    // Reset steps
    const dots = document.querySelectorAll('.step-dot');
    dots.forEach((dot, i) => {
        dot.className = 'step-dot w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold';
        if (i === 0) {
            dot.classList.add('bg-primary', 'text-white');
            dot.textContent = '1';
        } else {
            dot.classList.add('bg-slate-100', 'text-slate-400');
            dot.textContent = i + 1;
        }
    });

    // Reset OCR statuses
    for (let i = 1; i <= 3; i++) {
        const s = document.getElementById('ocrStatus' + i);
        s.querySelector('div:first-child').className = 'w-4 h-4 rounded-full border-2 border-slate-200 flex items-center justify-center';
        s.querySelector('div:first-child').innerHTML = '<div class="w-2 h-2 rounded-full bg-slate-200"></div>';
        s.classList.add('text-slate-400');
        s.classList.remove('text-emerald-600');
    }
}

// ==================== SAVE TRANSACTION ====================
function saveTransaction() {
    const merchant = document.getElementById('ocrMerchant').value;
    const amount = document.getElementById('ocrAmount').value;

    closeUploadModal();
    showToast('Transaksi Berhasil Disimpan!', `"${merchant}" sebesar Rp ${amount} telah ditambahkan.`);

    // Reset after a moment
    setTimeout(resetUpload, 500);
}

function saveManualTransaction() {
    const merchant = document.getElementById('manualMerchant').value;
    const amount = document.getElementById('manualAmount').value;

    if (!merchant || !amount) {
        showToast('Mohon Isi Data!', 'Nama merchant dan nominal wajib diisi.');
        return;
    }

    closeManualModal();
    showToast('Transaksi Berhasil Disimpan!', `"${merchant}" sebesar Rp ${Number(amount).toLocaleString('id-ID')} telah ditambahkan.`);
}

// ==================== TOAST NOTIFICATION ====================
function showToast(title, message) {
    const toast = document.getElementById('successToast');
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastMessage').textContent = message;
    toast.classList.remove('hidden');
    toast.style.animation = 'slideInUp 0.3s ease-out';

    setTimeout(hideToast, 4000);
}

function hideToast() {
    const toast = document.getElementById('successToast');
    toast.style.animation = 'slideOutDown 0.3s ease-out';
    setTimeout(() => toast.classList.add('hidden'), 300);
}

// ==================== SEARCH & FILTER ====================
function filterTransactions() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;
    const payment = document.getElementById('paymentFilter').value;

    const rows = document.querySelectorAll('.transaction-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const searchData = (row.getAttribute('data-search') || '').toLowerCase();
        const rowCategory = row.getAttribute('data-category') || '';
        const rowPayment = row.getAttribute('data-payment') || '';

        const matchesSearch = !searchTerm || searchData.includes(searchTerm);
        const matchesCategory = !category || rowCategory === category;
        const matchesPayment = !payment || rowPayment === payment;

        if (matchesSearch && matchesCategory && matchesPayment) {
            row.classList.remove('hidden');
            visibleCount++;
        } else {
            row.classList.add('hidden');
        }
    });

    // Hide/show date groups based on visible children
    document.querySelectorAll('.date-group').forEach(group => {
        const nextRows = [];
        let sibling = group.nextElementSibling;
        while (sibling && sibling.classList.contains('transaction-row')) {
            nextRows.push(sibling);
            sibling = sibling.nextElementSibling;
        }
        const hasVisible = nextRows.some(r => !r.classList.contains('hidden'));
        group.classList.toggle('hidden', !hasVisible);
    });

    // Toggle empty state
    const table = document.getElementById('transactionTable');
    const empty = document.getElementById('emptyState');
    if (visibleCount === 0) {
        table.classList.add('hidden');
        empty.classList.remove('hidden');
    } else {
        table.classList.remove('hidden');
        empty.classList.add('hidden');
    }

    document.getElementById('paginationInfo').textContent = `Menampilkan 1-${visibleCount} dari ${visibleCount} transaksi`;
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('categoryFilter').value = '';
    document.getElementById('paymentFilter').value = '';
    filterTransactions();
}

// ==================== TOGGLE EMPTY STATE DEMO ====================
// Press 'E' key to toggle empty state for demo purposes
document.addEventListener('keydown', (e) => {
    if (e.key === 'E' && !e.ctrlKey && !e.metaKey) {
        const table = document.getElementById('transactionTable');
        const empty = document.getElementById('emptyState');
        table.classList.toggle('hidden');
        empty.classList.toggle('hidden');
    }
});

// Toast animations
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes slideInUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes slideOutDown {
        from { transform: translateY(0); opacity: 1; }
        to { transform: translateY(20px); opacity: 0; }
    }
`;
document.head.appendChild(styleSheet);
</script>
@endsection
