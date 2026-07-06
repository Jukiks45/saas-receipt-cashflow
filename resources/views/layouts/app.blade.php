<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | AI Smart Finance</title>
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Tailwind Configuration for Custom Theme -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#2563EB',
                        background: '#F8FAFC',
                        card: '#FFFFFF',
                        text: '#1E293B',
                        border: '#E2E8F0',
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#2563eb', // Match primary color
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    boxShadow: {
                        'premium': '0 4px 20px -2px rgba(0, 0, 0, 0.05), 0 2px 8px -1px rgba(0, 0, 0, 0.03)',
                        'hover-card': '0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02)',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
        }
        /* Custom scrollbar for modern appearance */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F8FAFC;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
    </style>
</head>
<body class="h-full bg-background antialiased text-text selection:bg-primary/20 selection:text-primary">

    @if(request()->routeIs('login') || request()->routeIs('register'))
        <!-- Auth Layout -->
        <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-slate-50 relative overflow-hidden">
            <!-- Background Gradients for Aesthetics -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
            
            <div class="relative z-10">
                @yield('content')
            </div>
        </div>
    @else
        <!-- Main Application Layout -->
        <div class="min-h-screen flex">
            <!-- Mobile Sidebar Overlay -->
            <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden lg:hidden transition-all duration-300"></div>

            <!-- Left Fixed Sidebar -->
            <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-slate-950 text-slate-300 border-r border-slate-900 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
                @include('partials.sidebar')
            </aside>

            <!-- Main Panel Container -->
            <div class="flex-1 flex flex-col min-h-screen lg:pl-64">
                <!-- Top Navbar (Dashboard Header) -->
                @include('partials.navbar')

                <!-- Main Content Area -->
                <main class="flex-grow p-4 md:p-6 lg:p-8 max-w-[1600px] w-full mx-auto">
                    @yield('content')
                </main>

                <!-- Footer (Optional / Clean details) -->
                <footer class="py-6 px-4 md:px-8 border-t border-slate-100 bg-white/50 text-center text-xs text-slate-400">
                    <p>&copy; {{ date('Y') }} AI Smart Finance Automation System. All rights reserved.</p>
                </footer>
            </div>
        </div>

        <!-- Mobile Drawer JavaScript -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                const toggleBtn = document.getElementById('mobile-menu-btn');
                const closeBtn = document.getElementById('close-sidebar-btn');

                function toggleSidebar() {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                    // Prevent body scroll when menu is open on mobile
                    if (!overlay.classList.contains('hidden')) {
                        document.body.classList.add('overflow-hidden');
                    } else {
                        document.body.classList.remove('overflow-hidden');
                    }
                }

                if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
                if (overlay) overlay.addEventListener('click', toggleSidebar);
                if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            });
        </script>
    @endif

</body>
</html>
