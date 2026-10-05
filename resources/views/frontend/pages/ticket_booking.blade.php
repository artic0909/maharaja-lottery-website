@extends('frontend.layouts.app')

@section('content')
<!-- Hero / Header Section -->
<section class="relative bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] text-white pt-10 pb-12 lg:pt-14 lg:pb-16 overflow-hidden shadow-inner border-b border-[#DFB755]/20">
    <!-- Stylized Watermark Background -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden z-0 select-none">
        <span class="text-white font-serif font-black text-6xl sm:text-8xl md:text-9xl tracking-[0.25em] uppercase opacity-[0.035] whitespace-nowrap">
            MAHARAJA LOTTERY
        </span>
    </div>
    
    <!-- Pattern Overlay -->
    <div class="absolute inset-0 pointer-events-none opacity-15" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Header Content -->
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2">
                    <i class="fa-solid fa-crown text-[#DFB755] text-xs"></i>
                    <span class="text-[#DFB755] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        OFFICIAL TICKET RESERVATION DESK
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-white tracking-tight leading-[1.15]">
                    Book Your<br class="hidden sm:inline"> Maharaja Lottery Tickets
                </h1>

                <p class="text-white/85 text-xs sm:text-sm lg:text-base max-w-2xl font-normal leading-relaxed">
                    Select your lucky ticket numbers from the active lottery schemes below. You can pick tickets from multiple categories in a single order.
                </p>

                <!-- Category Quick Navigation Pills -->
                <div class="flex flex-wrap items-center gap-2.5 pt-2">
                    <span class="text-[11px] uppercase font-bold text-[#DFB755] tracking-wider block sm:inline">
                        Jump to Scheme:
                    </span>
                    @foreach($categoriesWithTickets as $cat)
                        <a href="#cat-{{ $cat['slug'] }}" 
                            class="px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-[#DFB755] hover:text-[#071533] border border-white/20 text-xs font-bold transition shadow-xs flex items-center gap-1.5">
                            <i class="fa-solid fa-ticket text-[10px]"></i>
                            <span>{{ $cat['name'] }}</span>
                            <span class="text-[10px] opacity-80">({{ $cat['price'] }})</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Right Step Progress Indicator -->
            <div class="lg:col-span-4 space-y-3">
                <!-- Step 01 (Active) -->
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 border-2 border-[#DFB755] shadow-lg flex items-center gap-4 transition transform hover:scale-[1.01]">
                    <div class="w-12 h-12 rounded-xl bg-[#DFB755]/20 border border-[#DFB755]/50 flex items-center justify-center font-serif font-black text-xl text-[#F3D068] shrink-0">
                        01
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-[#DFB755] block">STEP ONE</span>
                        <h4 class="text-base font-bold text-white">Select tickets</h4>
                    </div>
                </div>

                <!-- Step 02 (Inactive) -->
                <div class="bg-white/5 backdrop-blur-xs rounded-2xl p-4 border border-white/10 flex items-center gap-4 opacity-75">
                    <div class="w-12 h-12 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center font-serif font-bold text-lg text-white/70 shrink-0">
                        02
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-white/60 block">STEP TWO</span>
                        <h4 class="text-base font-semibold text-white/90">Your details</h4>
                    </div>
                </div>

                <!-- Step 03 (Inactive) -->
                <div class="bg-white/5 backdrop-blur-xs rounded-2xl p-4 border border-white/10 flex items-center gap-4 opacity-75">
                    <div class="w-12 h-12 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center font-serif font-bold text-lg text-white/70 shrink-0">
                        03
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-white/60 block">STEP THREE</span>
                        <h4 class="text-base font-semibold text-white/90">Payment review</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Gold Accent Bar -->
<div class="h-1.5 w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27]"></div>

<!-- Main Content Area: All Categories Shown Next by Next -->
<section class="bg-[#F8FAFC] py-10 lg:py-16 min-h-screen pb-32">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        @foreach($categoriesWithTickets as $index => $cat)
            <!-- Category Block (Next by Next) -->
            <div id="cat-{{ $cat['slug'] }}" class="bg-white rounded-3xl shadow-md border border-stone-200/90 p-5 sm:p-8 space-y-6 scroll-mt-24 transition-all">
                
                <!-- Category Royal Navy Header Banner -->
                <div class="bg-gradient-to-r from-[#040A1A] via-[#071533] to-[#040A1A] rounded-2xl p-6 sm:p-8 text-white text-center shadow-lg relative overflow-hidden border border-[#DFB755]/30">
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:12px_12px] pointer-events-none"></div>
                    
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755] text-2xl mb-3 shadow-inner">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-white tracking-wide">
                        {{ $cat['name'] }}
                    </h2>
                    
                    <p class="text-[#F3D068] font-black text-sm sm:text-base mt-1">
                        {{ $cat['price'] }} per ticket
                    </p>
                    <p class="text-white/70 text-[11px] sm:text-xs font-mono mt-0.5">
                        Official Directorate Draw &bull; Sample Code: <span class="text-white font-bold">{{ $cat['sample_code'] }}</span>
                    </p>

                    <!-- 3 Prize Tier Cards Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4 mt-6">
                        @foreach(array_slice($cat['prizes'], 0, 3) as $pIdx => $prize)
                            <div class="bg-[#0B193E]/95 backdrop-blur-sm rounded-xl p-3.5 sm:p-4 text-white shadow-sm flex items-center gap-3.5 border border-[#DFB755]/25 text-left">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] font-black flex items-center justify-center text-sm shrink-0 shadow-sm">
                                    {{ $pIdx + 1 }}
                                </div>
                                <div class="min-w-0">
                                    <span class="block text-[9px] uppercase font-extrabold text-[#DFB755] tracking-wider">
                                        {{ $prize['label'] ?? (($pIdx + 1) . 'th') }} PRIZE
                                    </span>
                                    <h5 class="text-sm sm:text-base font-extrabold text-white">{{ $prize['amount'] }}</h5>
                                    <span class="inline-flex items-center gap-1 text-[10px] text-white/70 mt-0.5">
                                        <i class="fa-solid fa-ticket-simple text-[9px] text-[#DFB755]"></i> {{ $prize['winners'] ?? '1 Lucky Ticket' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Control Bar: Search & Quick Picks for this Category -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pt-2 border-b border-stone-100 pb-4">
                    
                    <!-- Search Input -->
                    <div class="relative w-full lg:w-80">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                        <input type="text" onkeyup="searchCategoryTickets('{{ $cat['slug'] }}', this.value)" placeholder="Search ticket number (e.g. {{ $cat['sample_code'] }})" 
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-[#0B193E]/30 focus:border-[#0B193E] transition">
                    </div>

                    <!-- Right Controls: Quick Picks & Legend -->
                    <div class="flex flex-wrap items-center gap-4 text-xs">
                        
                        <!-- Quick Pick Buttons -->
                        <div class="flex items-center gap-1.5">
                            <span class="text-stone-400 text-xs font-semibold">Quick pick:</span>
                            <button type="button" onclick="quickPickCategory('{{ $cat['slug'] }}', 1)" class="w-7 h-7 rounded-lg bg-stone-100 hover:bg-[#0B193E] hover:text-white text-stone-700 font-bold text-xs flex items-center justify-center transition">1</button>
                            <button type="button" onclick="quickPickCategory('{{ $cat['slug'] }}', 3)" class="w-7 h-7 rounded-lg bg-stone-100 hover:bg-[#0B193E] hover:text-white text-stone-700 font-bold text-xs flex items-center justify-center transition">3</button>
                            <button type="button" onclick="quickPickCategory('{{ $cat['slug'] }}', 5)" class="w-7 h-7 rounded-lg bg-stone-100 hover:bg-[#0B193E] hover:text-white text-stone-700 font-bold text-xs flex items-center justify-center transition">5</button>
                            <button type="button" onclick="quickPickCategory('{{ $cat['slug'] }}', 10)" class="w-7 h-7 rounded-lg bg-stone-100 hover:bg-[#0B193E] hover:text-white text-stone-700 font-bold text-xs flex items-center justify-center transition">10</button>
                            <button type="button" onclick="clearCategorySelection('{{ $cat['slug'] }}')" class="text-rose-600 hover:text-rose-800 font-bold text-xs ml-1 transition">Clear</button>
                        </div>

                        <!-- Status Legend -->
                        <div class="flex items-center gap-3 text-[11px] text-stone-500 border-l border-stone-200 pl-4">
                            <span class="flex items-center gap-1">
                                <span class="w-2.5 h-2.5 rounded-sm border border-stone-300 bg-white"></span> Available
                            </span>
                            <span class="flex items-center gap-1 font-bold text-stone-800">
                                <span class="w-2.5 h-2.5 rounded-sm bg-[#071533] border border-[#DFB755]"></span> Selected
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="w-2.5 h-2.5 rounded-sm bg-stone-100 border border-stone-200"></span> Reserved
                            </span>
                        </div>

                        <!-- Ticket Count Badge -->
                        <span class="bg-stone-100 text-stone-600 font-bold text-[10px] px-2.5 py-1 rounded-full">
                            {{ count($cat['tickets']) }} tickets displayed
                        </span>

                    </div>
                </div>

                <!-- 8 Columns Responsive Ticket Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2 sm:gap-2.5" id="grid-{{ $cat['slug'] }}">
                    @foreach($cat['tickets'] as $ticket)
                        @php
                            $isSelected = in_array($ticket['number'], $selectedTickets);
                            $isReserved = $ticket['status'] === 'reserved';
                        @endphp
                        
                        <button type="button" 
                            data-ticket="{{ $ticket['number'] }}"
                            data-category="{{ $cat['slug'] }}"
                            data-price="{{ $ticket['price'] }}"
                            data-reserved="{{ $isReserved ? 'true' : 'false' }}"
                            onclick="toggleTicket(this)"
                            class="ticket-btn select-none py-2.5 px-2 rounded-xl text-xs font-mono font-bold transition text-center border relative {{ $isReserved ? 'bg-stone-50 border-stone-200/60 text-stone-300 cursor-not-allowed' : ($isSelected ? 'bg-[#040A1A] text-[#F3D068] border-[#DFB755] shadow-md transform scale-[1.02] ring-1 ring-[#DFB755]' : 'bg-white hover:bg-stone-50 border-stone-200 text-stone-800 hover:border-[#0B193E]') }}"
                            {{ $isReserved ? 'disabled' : '' }}>
                            
                            <span>{{ $ticket['number'] }}</span>

                            @if($isSelected)
                                <span class="selected-indicator absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#DFB755] text-[#071533] rounded-full text-[9px] flex items-center justify-center font-black shadow-xs">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            @endif
                        </button>
                    @endforeach
                </div>

            </div>
        @endforeach

    </div>
</section>

<!-- Floating Live Checkout Action Bar (Always Visible at Bottom) -->
<div id="checkout-dock" class="fixed bottom-0 inset-x-0 z-40 bg-[#040A1A]/95 backdrop-blur-md border-t-2 border-[#DFB755] shadow-2xl p-4 transition-all">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        
        <!-- Left: Selected Tickets Summary -->
        <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto justify-between sm:justify-start">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] font-black flex items-center justify-center text-base shadow-sm shrink-0">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span id="selected-count" class="text-white font-black text-sm sm:text-base font-serif">
                        {{ count($selectedTickets) }} Tickets Selected
                    </span>
                    <span class="text-stone-400 text-xs hidden sm:inline">&bull;</span>
                    <span id="total-price" class="text-[#F3D068] font-black text-sm sm:text-base font-mono">
                        Total: Calculate...
                    </span>
                </div>
                <p id="selected-list-preview" class="text-stone-400 text-[11px] font-mono truncate max-w-[280px] sm:max-w-md">
                    {{ implode(', ', $selectedTickets) }}
                </p>
            </div>
        </div>

        <!-- Right: Submit Form / Continue Button -->
        <form action="{{ route('payment.form') }}" method="POST" id="booking-checkout-form" class="w-full sm:w-auto">
            @csrf
            <input type="hidden" name="tickets" id="form-tickets-input" value="{{ implode(',', $selectedTickets) }}">
            
            <button type="submit" id="checkout-btn" 
                class="w-full sm:w-auto min-w-[240px] bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] font-serif font-black text-sm py-3 px-8 rounded-xl shadow-lg border border-[#FFE8A2]/80 flex items-center justify-center gap-2 transition transform hover:scale-[1.02]">
                <span>Proceed to Customer Details</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>

    </div>
</div>

@push('scripts')
<script>
    let selectedTicketsSet = new Set({!! json_encode($selectedTickets) !!});
    
    // Map ticket number to price
    const ticketPriceMap = {};
    document.querySelectorAll('.ticket-btn').forEach(btn => {
        const num = btn.getAttribute('data-ticket');
        const price = parseInt(btn.getAttribute('data-price') || '40', 10);
        if (num) ticketPriceMap[num] = price;
    });

    function toggleTicket(btn) {
        const ticketNum = btn.getAttribute('data-ticket');
        const isReserved = btn.getAttribute('data-reserved') === 'true';
        if (isReserved) return;

        if (selectedTicketsSet.has(ticketNum)) {
            selectedTicketsSet.delete(ticketNum);
            btn.className = "ticket-btn select-none py-2.5 px-2 rounded-xl text-xs font-mono font-bold transition text-center border relative bg-white hover:bg-stone-50 border-stone-200 text-stone-800 hover:border-[#0B193E]";
            const indicator = btn.querySelector('.selected-indicator');
            if (indicator) indicator.remove();
        } else {
            selectedTicketsSet.add(ticketNum);
            btn.className = "ticket-btn select-none py-2.5 px-2 rounded-xl text-xs font-mono font-bold transition text-center border relative bg-[#040A1A] text-[#F3D068] border-[#DFB755] shadow-md transform scale-[1.02] ring-1 ring-[#DFB755]";
            if (!btn.querySelector('.selected-indicator')) {
                const badge = document.createElement('span');
                badge.className = "selected-indicator absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#DFB755] text-[#071533] rounded-full text-[9px] flex items-center justify-center font-black shadow-xs";
                badge.innerHTML = '<i class="fa-solid fa-check"></i>';
                btn.appendChild(badge);
            }
        }

        updateCheckoutDock();
    }

    function quickPickCategory(catSlug, count) {
        const grid = document.getElementById('grid-' + catSlug);
        if (!grid) return;

        const availableButtons = Array.from(grid.querySelectorAll('.ticket-btn')).filter(btn => {
            return btn.getAttribute('data-reserved') !== 'true';
        });

        // Pick random available buttons
        const shuffled = availableButtons.sort(() => 0.5 - Math.random());
        const selectedSlice = shuffled.slice(0, count);

        selectedSlice.forEach(btn => {
            const ticketNum = btn.getAttribute('data-ticket');
            if (!selectedTicketsSet.has(ticketNum)) {
                selectedTicketsSet.add(ticketNum);
                btn.className = "ticket-btn select-none py-2.5 px-2 rounded-xl text-xs font-mono font-bold transition text-center border relative bg-[#040A1A] text-[#F3D068] border-[#DFB755] shadow-md transform scale-[1.02] ring-1 ring-[#DFB755]";
                if (!btn.querySelector('.selected-indicator')) {
                    const badge = document.createElement('span');
                    badge.className = "selected-indicator absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#DFB755] text-[#071533] rounded-full text-[9px] flex items-center justify-center font-black shadow-xs";
                    badge.innerHTML = '<i class="fa-solid fa-check"></i>';
                    btn.appendChild(badge);
                }
            }
        });

        updateCheckoutDock();
    }

    function clearCategorySelection(catSlug) {
        const grid = document.getElementById('grid-' + catSlug);
        if (!grid) return;

        grid.querySelectorAll('.ticket-btn').forEach(btn => {
            const ticketNum = btn.getAttribute('data-ticket');
            if (selectedTicketsSet.has(ticketNum)) {
                selectedTicketsSet.delete(ticketNum);
                btn.className = "ticket-btn select-none py-2.5 px-2 rounded-xl text-xs font-mono font-bold transition text-center border relative bg-white hover:bg-stone-50 border-stone-200 text-stone-800 hover:border-[#0B193E]";
                const indicator = btn.querySelector('.selected-indicator');
                if (indicator) indicator.remove();
            }
        });

        updateCheckoutDock();
    }

    function searchCategoryTickets(catSlug, query) {
        const grid = document.getElementById('grid-' + catSlug);
        if (!grid) return;

        const q = query.trim().toUpperCase();
        grid.querySelectorAll('.ticket-btn').forEach(btn => {
            const num = btn.getAttribute('data-ticket');
            if (!q || num.includes(q)) {
                btn.style.display = '';
            } else {
                btn.style.display = 'none';
            }
        });
    }

    function updateCheckoutDock() {
        const ticketsArr = Array.from(selectedTicketsSet);
        const count = ticketsArr.length;
        
        let total = 0;
        ticketsArr.forEach(t => {
            total += (ticketPriceMap[t] || 40);
        });

        const countEl = document.getElementById('selected-count');
        const priceEl = document.getElementById('total-price');
        const previewEl = document.getElementById('selected-list-preview');
        const inputEl = document.getElementById('form-tickets-input');
        const checkoutBtn = document.getElementById('checkout-btn');

        if (countEl) countEl.textContent = count + ' Ticket' + (count === 1 ? '' : 's') + ' Selected';
        if (priceEl) priceEl.textContent = 'Total: ₹' + total.toLocaleString('en-IN');
        if (previewEl) previewEl.textContent = count > 0 ? ticketsArr.join(', ') : 'No tickets selected yet';
        if (inputEl) inputEl.value = ticketsArr.join(',');

        if (checkoutBtn) {
            if (count === 0) {
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                checkoutBtn.disabled = false;
                checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    }

    // Initialize on page load
    updateCheckoutDock();
</script>
@endpush
@endsection
