<header class="bg-[#7F1D1D] text-white py-1.5 md:py-2 sticky top-0 z-50 shadow-md border-b border-[#991B1B]/40">
    <div class="container mx-auto px-4 lg:px-8 flex flex-wrap justify-between items-center">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2.5 group">
            <div class="bg-white/10 p-1.5 rounded-full flex items-center justify-center border border-[#EAB308]/30 group-hover:border-[#EAB308] transition">
                <i class="fa-solid fa-crown text-lg lg:text-xl text-[#F59E0B] drop-shadow-xs"></i>
            </div>
            <div>
                <h1 class="text-xl lg:text-2xl font-black italic tracking-wide leading-none group-hover:text-amber-300 transition">MAHARAJA</h1>
                <p class="text-[9px] lg:text-[10px] font-medium tracking-wider text-amber-200/80 mt-0.5 uppercase">Lottery Information System</p>
            </div>
        </a>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-white hover:text-amber-300 focus:outline-none p-1">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Navigation -->
        <nav class="hidden md:flex items-center space-x-1">
            <a href="{{ route('home') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('home') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">Home</a>
            <a href="{{ route('about') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('about') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">About</a>
            <a href="{{ route('winnerlist') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('winnerlist') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">Winner List</a>
            <a href="{{ route('contact') }}" class="px-3 py-1 rounded-md {{ request()->routeIs('contact') ? 'bg-[#991B1B] text-amber-300 font-semibold shadow-inner' : 'hover:bg-white/10 text-gray-100 hover:text-white font-medium' }} text-xs lg:text-sm transition">Contact</a>
        </nav>

        <!-- Actions -->
        <div class="hidden md:flex items-center space-x-2.5">
            <a href="#" class="bg-linear-to-r from-[#15803D] to-[#16A34A] hover:from-[#166534] hover:to-[#15803D] text-white px-3.5 py-1.5 rounded-full font-semibold text-xs transition shadow-sm border border-emerald-400/30">
                Ticket Booking
            </a>
            <a href="#" class="bg-[#991B1B] hover:bg-[#B91C1C] text-white px-3.5 py-1.5 rounded-full font-semibold text-xs transition shadow-sm border border-rose-400/30">
                Get Status
            </a>
        </div>
    </div>
</header>
