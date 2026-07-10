<header class="h-16 border-b border-slate-100 bg-white/80 backdrop-blur-md sticky top-0 z-30 flex items-center justify-between px-4 md:px-6 lg:px-8">
    <!-- Left Section: Mobile Toggle & Page Title -->
    <div class="flex items-center gap-4">
        <!-- Hamburger Menu Button (Mobile Only) -->
        <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-50 rounded-xl transition-colors focus:outline-none" aria-label="Toggle Sidebar">
            <i class="fa-solid fa-bars-staggered text-lg"></i>
        </button>
        
        <!-- Dynamic Page Title -->
        <div>
            <h1 class="text-base md:text-lg font-bold text-slate-800 tracking-tight">
                @yield('page_title', 'Dashboard')
            </h1>
        </div>
    </div>

    <!-- Right Section: Search, Notifications & Profile -->
    <div class="flex items-center gap-3 md:gap-4">
        <!-- Search Input (Hidden on extra small screens) -->
        <div class="hidden sm:relative sm:block w-48 md:w-64">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </div>
            <input type="text" placeholder="Cari transaksi, analisis..." class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pl-9 pr-4 py-2 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all duration-200">
        </div>

        <!-- Notification Bell Icon (Aesthetic detail) -->
        <button class="relative p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-xl transition-all duration-200 focus:outline-none">
            <i class="fa-regular fa-bell text-base"></i>
            <span class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
        </button>

        <!-- Vertical Divider -->
        <span class="h-6 w-[1px] bg-slate-200"></span>

        <!-- User Information (Avatar & Name) -->
        <div class="flex items-center gap-3 group cursor-pointer">
            <div class="text-right hidden md:block">
                <p class="text-xs font-semibold text-slate-800 leading-tight group-hover:text-primary transition-colors">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-slate-400">{{ auth()->user()->email }}</p>
            </div>
            
            <div class="relative">
                <img class="w-8 h-8 rounded-xl object-cover ring-2 ring-slate-100 group-hover:ring-primary/20 transition-all duration-300" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=100" alt="Avatar User">
                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-white"></div>
            </div>
        </div>
    </div>
</header>
