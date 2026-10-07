<!-- Mobile Sidebar Backdrop Overlay -->
<div id="admin-sidebar-backdrop" class="fixed inset-0 bg-black/70 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity"></div>

<!-- Sidebar Container -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-[#040A1A] border-r border-[#DFB755]/20 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out shadow-2xl no-scrollbar">
    
    <!-- Top Branding & Navigation -->
    <div class="flex-1 overflow-y-auto no-scrollbar py-5 px-4 space-y-6">
        
        <!-- Logo Header -->
        <div class="flex items-center gap-3 px-2 pb-4 border-b border-[#DFB755]/15">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#0B193E] to-[#040A1A] border border-[#DFB755]/50 flex items-center justify-center text-[#F3D068] text-lg shrink-0 shadow-md">
                <i class="fa-solid fa-crown"></i>
            </div>
            <div class="min-w-0">
                <h2 class="text-base font-serif font-black text-white tracking-wider truncate">MAHARAJA</h2>
                <p class="text-[9px] uppercase font-extrabold tracking-widest text-[#DFB755]">Admin Panel</p>
            </div>
        </div>

        <!-- Navigation Section: Core Management -->
        <div class="space-y-1">
            <p class="px-3 text-[10px] uppercase font-extrabold tracking-widest text-stone-400 mb-2">
                Core Operations
            </p>

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#0B193E] text-[#F3D068] border border-[#DFB755]/40 shadow-md' : 'text-stone-300 hover:text-white hover:bg-white/5' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-gauge-high text-sm {{ request()->routeIs('admin.dashboard') ? 'text-[#DFB755]' : 'text-stone-400' }}"></i>
                    <span>Dashboard</span>
                </div>
                <span class="w-2 h-2 rounded-full bg-[#DFB755] {{ request()->routeIs('admin.dashboard') ? 'inline-block' : 'hidden' }}"></span>
            </a>

            <!-- Bookings & Payment Records (NEW) -->
            <a href="{{ route('admin.bookings.index') }}" 
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.bookings.*') ? 'bg-[#0B193E] text-[#F3D068] border border-[#DFB755]/40 shadow-md' : 'text-stone-300 hover:text-white hover:bg-white/5' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-receipt text-sm {{ request()->routeIs('admin.bookings.*') ? 'text-[#DFB755]' : 'text-stone-400 group-hover:text-[#DFB755]' }}"></i>
                    <span>Bookings &amp; Payments</span>
                </div>
                <span class="w-2 h-2 rounded-full bg-[#DFB755] {{ request()->routeIs('admin.bookings.*') ? 'inline-block' : 'hidden' }}"></span>
            </a>

            <!-- Ticket Management / Price Chart -->
            <a href="{{ route('admin.tickets.index') }}" 
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.tickets.*') ? 'bg-[#0B193E] text-[#F3D068] border border-[#DFB755]/40 shadow-md' : 'text-stone-300 hover:text-white hover:bg-white/5' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-money-check-dollar text-sm {{ request()->routeIs('admin.tickets.*') ? 'text-[#DFB755]' : 'text-stone-400 group-hover:text-[#DFB755]' }}"></i>
                    <span>Ticket Price Chart</span>
                </div>
                <span class="w-2 h-2 rounded-full bg-[#DFB755] {{ request()->routeIs('admin.tickets.*') ? 'inline-block' : 'hidden' }}"></span>
            </a>

            <!-- Live Ticket Booking Portal -->
            <!-- <a href="{{ route('ticket.booking') }}" target="_blank"
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-stone-300 hover:text-white hover:bg-white/5 transition group">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-ticket text-sm text-stone-400 group-hover:text-[#DFB755] transition"></i>
                    <span>Ticket Booking Portal</span>
                </div>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-stone-400"></i>
            </a> -->

            <!-- Winner Results Publication -->
            <a href="{{ route('winnerlist') }}" target="_blank"
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-stone-300 hover:text-white hover:bg-white/5 transition group">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-trophy text-sm text-stone-400 group-hover:text-[#DFB755] transition"></i>
                    <span>Check Results Desk</span>
                </div>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-stone-400"></i>
            </a>
        </div>

        <!-- Navigation Section: Payments & Customers -->
        <div class="space-y-1">
            <p class="px-3 text-[10px] uppercase font-extrabold tracking-widest text-stone-400 mb-2">
                Finance & Leads
            </p>

            <!-- UPI Gateways & Accounts -->
            <a href="javascript:void(0)" onclick="window.adminToast('UPI Gateway Active: paytmqr2810050501011306d15v19x7@paytm', 'success')"
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-stone-300 hover:text-white hover:bg-white/5 transition group">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-qrcode text-sm text-stone-400 group-hover:text-[#DFB755] transition"></i>
                    <span>UPI Gateways</span>
                </div>
                <span class="text-[10px] text-emerald-400 font-bold">Active</span>
            </a>

            <!-- Customer Contacts -->
            <a href="javascript:void(0)" onclick="window.adminToast('Total Registered Customers: 3,840 Active Players', 'info')"
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-stone-300 hover:text-white hover:bg-white/5 transition group">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-users text-sm text-stone-400 group-hover:text-[#DFB755] transition"></i>
                    <span>Customer List</span>
                </div>
                <span class="text-[10px] text-stone-400">3.8k</span>
            </a>



            <!-- Settings & Profile -->
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition {{ request()->routeIs('admin.settings.*') ? 'bg-[#0B193E] text-[#F3D068] border border-[#DFB755]/40 shadow-md' : 'text-stone-300 hover:text-white hover:bg-white/5' }}">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-gear text-sm {{ request()->routeIs('admin.settings.*') ? 'text-[#DFB755]' : 'text-stone-400' }}"></i>
                    <span>Profile &amp; Settings</span>
                </div>
                <span class="w-2 h-2 rounded-full bg-[#DFB755] {{ request()->routeIs('admin.settings.*') ? 'inline-block' : 'hidden' }}"></span>
            </a>
        </div>

    </div>

    <!-- Bottom User Profile Card & Sign Out Button -->
    <div class="p-4 border-t border-[#DFB755]/15 bg-[#030712]/90 space-y-3">
        <div class="flex items-center gap-3 px-1">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] font-black flex items-center justify-center text-xs shadow-sm">
                MA
            </div>
            <div class="min-w-0 flex-1">
                <h4 class="text-xs font-bold text-white truncate">Master Admin</h4>
                <p class="text-[10px] font-mono text-stone-400 truncate">admin@mail.com</p>
            </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" 
                class="w-full bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 hover:text-rose-200 border border-rose-500/30 py-2 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i>
                <span>Logout Session</span>
            </button>
        </form>
    </div>

</aside>
