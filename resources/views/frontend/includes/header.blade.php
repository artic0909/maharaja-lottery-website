<header class="bg-[#7F1D1D] text-white py-2 sticky top-0 z-50 shadow-md border-b border-[#991B1B]/40">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="bg-white/10 p-1.5 rounded-full flex items-center justify-center border border-[#EAB308]/30 group-hover:border-[#EAB308] transition shrink-0">
                <i class="fa-solid fa-crown text-base sm:text-lg lg:text-xl text-[#F59E0B] drop-shadow-xs"></i>
            </div>
            <div>
                <h1 class="text-lg sm:text-xl lg:text-2xl font-black italic tracking-wide leading-none group-hover:text-amber-300 transition">MAHARAJA</h1>
                <p class="text-[8px] sm:text-[9px] lg:text-[10px] font-medium tracking-wider text-amber-200/80 mt-0.5 uppercase">Lottery Information System</p>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-1">
            <a href="{{ route('home') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('home') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">Home</a>
            <a href="{{ route('about') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('about') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">About</a>
            <a href="{{ route('winnerlist') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('winnerlist') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">Winner List</a>
            <a href="{{ route('contact') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('contact') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">Contact</a>
        </nav>

        <!-- Desktop Actions -->
        <div class="hidden md:flex items-center space-x-2.5">
            <a href="{{ route('contact') }}" class="bg-gradient-to-r from-[#15803D] to-[#16A34A] hover:from-[#166534] hover:to-[#15803D] text-white px-3.5 py-1.5 rounded-full font-semibold text-xs transition shadow-sm border border-emerald-400/30 flex items-center gap-1.5">
                <i class="fa-solid fa-ticket-simple text-[10px]"></i>
                Ticket Booking
            </a>
            <a href="{{ route('winnerlist') }}" class="bg-[#991B1B] hover:bg-[#B91C1C] text-white px-3.5 py-1.5 rounded-full font-semibold text-xs transition shadow-sm border border-rose-400/30 flex items-center gap-1.5">
                <i class="fa-solid fa-shield-check text-[10px] text-[#F59E0A]"></i>
                Get Status
            </a>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button id="mobile-menu-btn" aria-label="Toggle Navigation Menu" class="md:hidden text-white hover:text-amber-300 focus:outline-none p-2 rounded-lg hover:bg-white/10 transition">
            <i id="mobile-menu-icon" class="fa-solid fa-bars text-xl"></i>
        </button>
    </div>

        <!-- Mobile Slide-down Navigation Drawer -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#601211] border-t border-red-800/60 px-4 py-4 space-y-3 transition-all duration-300 shadow-2xl">
        <nav class="flex flex-col space-y-1">
            <a href="{{ route('home') }}" class="px-3.5 py-2.5 rounded-lg {{ request()->routeIs('home') ? 'bg-[#991B1B] text-amber-300 font-bold' : 'text-gray-100 hover:bg-white/10 hover:text-white font-medium' }} text-sm transition flex items-center justify-between">
                <span>Home</span>
                <i class="fa-solid fa-chevron-right text-xs opacity-60"></i>
            </a>
            <a href="{{ route('about') }}" class="px-3.5 py-2.5 rounded-lg {{ request()->routeIs('about') ? 'bg-[#991B1B] text-amber-300 font-bold' : 'text-gray-100 hover:bg-white/10 hover:text-white font-medium' }} text-sm transition flex items-center justify-between">
                <span>About</span>
                <i class="fa-solid fa-chevron-right text-xs opacity-60"></i>
            </a>
            <a href="{{ route('winnerlist') }}" class="px-3.5 py-2.5 rounded-lg {{ request()->routeIs('winnerlist') ? 'bg-[#991B1B] text-amber-300 font-bold' : 'text-gray-100 hover:bg-white/10 hover:text-white font-medium' }} text-sm transition flex items-center justify-between">
                <span>Winner List</span>
                <i class="fa-solid fa-chevron-right text-xs opacity-60"></i>
            </a>
            <a href="{{ route('contact') }}" class="px-3.5 py-2.5 rounded-lg {{ request()->routeIs('contact') ? 'bg-[#991B1B] text-amber-300 font-bold' : 'text-gray-100 hover:bg-white/10 hover:text-white font-medium' }} text-sm transition flex items-center justify-between">
                <span>Contact</span>
                <i class="fa-solid fa-chevron-right text-xs opacity-60"></i>
            </a>
        </nav>

        <!-- Mobile Action Buttons -->
        <div class="pt-3 border-t border-red-800/40 grid grid-cols-2 gap-2.5">
            <a href="{{ route('contact') }}" class="bg-gradient-to-r from-[#15803D] to-[#16A34A] hover:from-[#166534] hover:to-[#15803D] text-white py-2.5 px-3 rounded-xl font-bold text-xs text-center shadow-sm flex items-center justify-center gap-1.5 transition">
                <i class="fa-solid fa-ticket-simple text-[10px]"></i>
                <span class="truncate">Ticket Booking</span>
            </a>
            <a href="{{ route('winnerlist') }}" class="bg-[#991B1B] hover:bg-[#B91C1C] text-white py-2.5 px-3 rounded-xl font-bold text-xs text-center shadow-sm border border-rose-400/30 flex items-center justify-center gap-1.5 transition">
                <i class="fa-solid fa-shield-check text-[10px] text-[#F59E0A]"></i>
                <span class="truncate">Get Status</span>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('mobile-menu-icon');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    if (icon) {
                        icon.classList.toggle('fa-bars');
                        icon.classList.toggle('fa-xmark');
                    }
                });
            }
        });
    </script>
</header>
