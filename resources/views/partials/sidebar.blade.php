<!-- Sidebar Header -->
<div class="h-16 flex items-center justify-between px-6 border-b border-slate-900 flex-shrink-0">
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-primary to-blue-400 flex items-center justify-center text-white shadow-md shadow-primary/20">
            <i class="fa-solid fa-brain text-sm"></i>
        </div>
        <span class="font-bold text-base tracking-tight text-white">SmartFinance</span>
    </div>
    
    <!-- Mobile Close Button -->
    <button id="close-sidebar-btn" class="lg:hidden text-slate-400 hover:text-white focus:outline-none transition-colors">
        <i class="fa-solid fa-xmark text-lg"></i>
    </button>
</div>

<!-- AI Quick Status (Extra Visual Aesthetics) -->
<div class="px-4 py-3 mx-3 my-4 bg-slate-900/60 border border-slate-800/80 rounded-xl flex items-center justify-between">
    <div class="flex items-center gap-2.5">
        <div class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
        </div>
        <div class="text-xs">
            <p class="font-medium text-slate-200">AI Engine</p>
            <p class="text-slate-500 text-[10px]">Optimal & Active</p>
        </div>
    </div>
    <span class="text-[10px] bg-primary/20 text-primary-400 border border-primary/30 px-2 py-0.5 rounded-full font-medium">v1.2</span>
</div>

<!-- Sidebar Menu -->
<div class="flex-1 px-4 py-3 space-y-7 overflow-y-auto">
    <div>
        <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 block mb-3">Menu Utama</span>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-primary text-white shadow-lg shadow-primary/10' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-100' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-chart-pie w-5 text-center transition-transform group-hover:scale-110 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}"></i>
                        <span>Dashboard</span>
                    </div>
                    @if(request()->routeIs('dashboard'))
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('transaksi') ? 'bg-primary text-white shadow-lg shadow-primary/10' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-100' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-wallet w-5 text-center transition-transform group-hover:scale-110 {{ request()->routeIs('transaksi') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}"></i>
                        <span>Transaksi</span>
                    </div>
                    @if(request()->routeIs('transaksi'))
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('analisis') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('analisis') ? 'bg-primary text-white shadow-lg shadow-primary/10' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-100' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-chart-line w-5 text-center transition-transform group-hover:scale-110 {{ request()->routeIs('analisis') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}"></i>
                        <span>Analisis</span>
                    </div>
                    @if(request()->routeIs('analisis'))
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('pengaturan') }}" class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('pengaturan') ? 'bg-primary text-white shadow-lg shadow-primary/10' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-100' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-sliders w-5 text-center transition-transform group-hover:scale-110 {{ request()->routeIs('pengaturan') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}"></i>
                        <span>Pengaturan</span>
                    </div>
                    @if(request()->routeIs('pengaturan'))
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    @endif
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Sidebar Footer (User Info & Logout Shortcut) -->
<div class="p-4 border-t border-slate-900 flex items-center justify-between gap-3 bg-slate-950 flex-shrink-0">
    <div class="flex items-center gap-3 min-w-0">
        <div class="relative">
            <img class="w-9 h-9 rounded-full object-cover border-2 border-slate-800" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=100" alt="Avatar User">
            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-slate-950"></span>
        </div>
        <div class="text-left min-w-0">
            <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name ?? 'Pengguna' }}</p>
            <p class="text-[10px] text-slate-500 truncate">{{ auth()->user()->email ?? '' }}</p>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="text-slate-500 hover:text-rose-400 transition-colors p-1.5 rounded-lg hover:bg-slate-900" title="Keluar">
            <i class="fa-solid fa-right-from-bracket text-sm"></i>
        </button>
    </form>
</div>
