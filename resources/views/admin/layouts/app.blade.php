<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Maharaja Lottery Directorate</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#040A1A] font-sans antialiased text-stone-200 min-h-screen flex flex-col selection:bg-[#DFB755] selection:text-[#040A1A]">

    <!-- Global App Layout Grid -->
    <div class="flex h-screen overflow-hidden bg-[#040A1A]">
        
        <!-- Sidebar Navigation -->
        @include('admin.includes.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto overflow-x-hidden min-w-0 bg-[#061026]">
            
            <!-- Top Admin Header -->
            <header class="sticky top-0 z-30 bg-[#071533]/95 backdrop-blur-md border-b border-[#DFB755]/20 shadow-md">
                <div class="px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4">
                    
                    <!-- Left: Mobile Toggle & Breadcrumbs -->
                    <div class="flex items-center gap-3">
                        <button type="button" id="admin-sidebar-toggle" class="lg:hidden w-9 h-9 rounded-xl bg-white/10 text-[#DFB755] border border-[#DFB755]/30 flex items-center justify-center hover:bg-white/20 transition">
                            <i class="fa-solid fa-bars text-sm"></i>
                        </button>
                        
                        <div class="hidden sm:flex items-center gap-2 text-xs font-semibold">
                            <span class="text-stone-400">Portal</span>
                            <span class="text-[#DFB755]/50">/</span>
                            <span class="text-[#DFB755] uppercase tracking-wider font-bold">@yield('page_title', 'Dashboard')</span>
                        </div>
                    </div>

                    <!-- Center / Live Status -->
                    <div class="hidden md:flex items-center gap-2 bg-[#040A1A]/80 border border-[#DFB755]/25 px-3 py-1.5 rounded-full text-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-stone-300 font-medium">Draw Engine:</span>
                        <span class="text-[#F3D068] font-bold">Active (Samrudhi Sunday Pool)</span>
                    </div>

                    <!-- Right Actions & Admin Profile -->
                    <div class="flex items-center gap-3 sm:gap-4">
                        
                        <!-- Quick Link to Public Website -->
                        <a href="{{ route('home') }}" target="_blank" title="View Public Website" 
                            class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/15 text-stone-300 hover:text-[#DFB755] border border-white/10 flex items-center justify-center text-xs transition">
                            <i class="fa-solid fa-globe"></i>
                        </a>

                        <!-- Notification Bell (Dummy) -->
                        <button type="button" class="relative w-9 h-9 rounded-xl bg-white/5 hover:bg-white/15 text-stone-300 hover:text-[#DFB755] border border-white/10 flex items-center justify-center text-xs transition">
                            <i class="fa-solid fa-bell"></i>
                            <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-[#DFB755] text-[#071533] text-[9px] font-black flex items-center justify-center">
                                7
                            </span>
                        </button>

                        <!-- Admin User Dropdown Trigger -->
                        <div class="relative" id="user-dropdown-container">
                            <button type="button" onclick="toggleUserDropdown()" class="flex items-center gap-2.5 p-1.5 rounded-xl bg-white/5 hover:bg-white/10 border border-[#DFB755]/30 transition group">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#C59B27] to-[#F3D068] text-[#071533] font-black flex items-center justify-center text-xs shadow-sm">
                                    MA
                                </div>
                                <div class="hidden sm:block text-left pr-1 leading-tight">
                                    <h4 class="text-xs font-bold text-white group-hover:text-[#DFB755] transition truncate max-w-[120px]">
                                        {{ auth()->user()->name ?? 'Master Admin' }}
                                    </h4>
                                    <span class="text-[10px] text-[#DFB755] font-semibold">Superadmin</span>
                                </div>
                                <i class="fa-solid fa-chevron-down text-[10px] text-stone-400 group-hover:text-white transition hidden sm:block"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-[#071533] rounded-2xl border border-[#DFB755]/30 shadow-2xl py-2 z-50 divide-y divide-white/10">
                                <div class="px-4 py-2.5">
                                    <p class="text-xs font-bold text-white">{{ auth()->user()->name ?? 'Master Admin' }}</p>
                                    <p class="text-[11px] font-mono text-stone-400 truncate">{{ auth()->user()->email ?? 'admin@mail.com' }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-stone-300 hover:text-white hover:bg-white/10 transition">
                                        <i class="fa-solid fa-gauge-high text-xs text-[#DFB755]"></i>
                                        <span>Dashboard</span>
                                    </a>
                                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-stone-300 hover:text-white hover:bg-white/10 transition">
                                        <i class="fa-solid fa-gear text-xs text-[#DFB755]"></i>
                                        <span>Settings &amp; Profile</span>
                                    </a>
                                    <a href="{{ route('ticket.booking') }}" target="_blank" class="flex items-center gap-2.5 px-4 py-2 text-xs text-stone-300 hover:text-white hover:bg-white/10 transition">
                                        <i class="fa-solid fa-ticket text-xs text-[#DFB755]"></i>
                                        <span>Live Ticket Board</span>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition text-left font-semibold">
                                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                                            <span>Sign Out</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </header>

            <!-- Flash Message Banner -->
            @if(session('success'))
                <div class="m-4 sm:m-6 mb-0 bg-emerald-500/15 border border-emerald-500/40 rounded-2xl p-4 text-emerald-300 text-xs flex items-center justify-between shadow-lg">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-check text-base text-emerald-400"></i>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            <!-- Main Page Content Body -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            <!-- Admin Footer -->
            <footer class="bg-[#040A1A]/80 border-t border-white/5 py-4 px-4 sm:px-8 text-center text-xs text-stone-500 flex flex-col sm:flex-row items-center justify-between gap-2">
                <div>
                    &copy; {{ date('Y') }} Maharaja Lottery Directorate. Government Regulated System.
                </div>
                <div class="flex items-center gap-4 text-[11px]">
                    <span class="text-stone-400 font-mono">Server Status: <span class="text-emerald-400 font-bold">Optimal</span></span>
                    <span class="text-stone-400">Portal v2.4</span>
                </div>
            </footer>

        </div>
    </div>

    <!-- Dropdown / Mobile Sidebar Toggle Script -->
    <script>
        function toggleUserDropdown() {
            const menu = document.getElementById('user-dropdown-menu');
            menu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const container = document.getElementById('user-dropdown-container');
            const menu = document.getElementById('user-dropdown-menu');
            if (container && !container.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('admin-sidebar-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        const sidebarBackdrop = document.getElementById('admin-sidebar-backdrop');
        
        if (sidebarToggle && sidebar && sidebarBackdrop) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarBackdrop.classList.toggle('hidden');
            });
            sidebarBackdrop.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarBackdrop.classList.add('hidden');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
