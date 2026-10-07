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
                    Choose your desired ticket numbers from any lottery scheme below. You can select tickets from any category and proceed to checkout.
                </p>
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

@if(session('error'))
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="bg-amber-500/10 border border-amber-500/40 text-amber-900 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

<!-- Main Content Area: All Categories Shown Stacked One After Another -->
<section class="bg-[#F8FAFC] py-10 lg:py-16 min-h-screen pb-36">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        @foreach($categoriesWithTickets as $index => $cat)
            <!-- Category Section Container -->
            <div id="cat-{{ $cat['slug'] }}" class="bg-white rounded-3xl shadow-md border border-stone-200/90 p-5 sm:p-8 space-y-6 transition-all">
                
                <!-- Category Royal Navy Header Banner -->
                <div class="bg-gradient-to-r from-[#040A1A] via-[#071533] to-[#040A1A] rounded-2xl p-6 sm:p-8 text-white text-center shadow-lg relative overflow-hidden border border-[#DFB755]/35">
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:12px_12px] pointer-events-none"></div>
                    
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755] text-2xl mb-3 shadow-inner">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-white tracking-wide">
                        {{ $cat['name'] }}
                    </h2>
                    
                    <p class="text-[#F3D068] font-black text-sm sm:text-base mt-1 font-mono">
                        {{ $cat['price'] }} per ticket
                    </p>
                    <p class="text-stone-300 text-[11px] sm:text-xs font-mono mt-0.5">
                        Official Directorate Draw &bull; Sample Code: <span class="text-[#F3D068] font-bold">{{ $cat['sample_code'] }}</span>
                    </p>
                </div>

                <!-- 3 Prize Cards Row (Maharaja Luxury Navy & Gold) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">
                    @foreach(array_slice($cat['prizes'] ?? [], 0, 3) as $pIdx => $prize)
                        <div class="bg-[#071533] rounded-2xl p-4 shadow-sm border border-[#DFB755]/25 flex items-center gap-3.5 text-left hover:border-[#DFB755] transition">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#040A1A] font-black flex items-center justify-center text-sm shrink-0 shadow-sm">
                                {{ $pIdx + 1 }}
                            </div>
                            <div class="min-w-0">
                                <span class="block text-[9px] uppercase font-extrabold text-[#DFB755] tracking-wider">
                                    {{ $prize['label'] ?? (($pIdx + 1) . 'th') }} PRIZE
                                </span>
                                <h5 class="text-sm sm:text-base font-black text-white">{{ $prize['amount'] }}</h5>
                                <span class="inline-flex items-center gap-1 text-[10px] text-[#F3D068] mt-0.5 bg-[#040A1A] px-2 py-0.5 rounded-full border border-[#DFB755]/30">
                                    <i class="fa-solid fa-ticket-simple text-[9px] text-[#DFB755]"></i> {{ $prize['winners'] ?? '1 lucky ticket' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Control Bar: Search & Status Legend -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2 border-b border-stone-100 pb-4">
                    
                    <!-- Search Input -->
                    <div class="relative w-full sm:w-80">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                        <input type="text" onkeyup="filterSchemeTickets('{{ $cat['slug'] }}', this.value)" placeholder="Search ticket number (e.g. {{ $cat['sample_code'] }})" 
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-[#0B193E]/30 focus:border-[#0B193E] transition">
                    </div>

                    <!-- Right Controls: Status Legend & Count -->
                    <div class="flex items-center gap-4 text-xs">
                        <div class="flex items-center gap-3 text-[11px] text-stone-600">
                            <span class="flex items-center gap-1.5 font-medium">
                                <span class="w-3 h-3 rounded-sm border border-stone-300 bg-white"></span> Available
                            </span>
                            <span class="flex items-center gap-1.5 font-bold text-[#071533]">
                                <span class="w-3 h-3 rounded-sm bg-[#071533] border border-[#DFB755]"></span> Selected
                            </span>
                            <span class="flex items-center gap-1.5 text-stone-400 font-medium">
                                <span class="w-3 h-3 rounded-sm bg-stone-100 border border-stone-200 line-through"></span> Reserved
                            </span>
                        </div>

                        <!-- Ticket Count Badge -->
                        <span class="text-[#071533] font-bold text-[11px] font-mono border-l border-stone-200 pl-3">
                            {{ count($cat['tickets']) }} tickets
                        </span>
                    </div>
                </div>

                <!-- Complete Ticket Grid (11 Columns Desktop) -->
                <div class="grid grid-cols-3 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-11 xl:grid-cols-11 gap-2 sm:gap-2.5" id="grid-{{ $cat['slug'] }}">
                    @foreach($cat['tickets'] as $ticket)
                        @php
                            $isSelected = in_array($ticket['number'], $selectedTickets);
                            $isReserved = ($ticket['status'] ?? '') === 'reserved';
                        @endphp
                        
                        <button type="button" 
                            data-ticket="{{ $ticket['number'] }}"
                            data-price="{{ $ticket['price'] }}"
                            data-category="{{ $cat['slug'] }}"
                            data-category-name="{{ $cat['name'] }}"
                            data-reserved="{{ $isReserved ? 'true' : 'false' }}"
                            title="{{ $isReserved ? 'This ticket has already been acquired / reserved' : 'Click to select ticket ' . $ticket['number'] }}"
                            class="ticket-btn select-none py-2.5 px-1.5 rounded-xl text-[11px] sm:text-xs font-mono font-bold transition text-center border relative {{ $isReserved ? 'bg-stone-100 border-stone-200 text-stone-400 line-through cursor-not-allowed opacity-60' : ($isSelected ? 'bg-[#040A1A] text-[#F3D068] border-2 border-[#DFB755] ring-2 ring-[#DFB755]/40 shadow-md transform scale-[1.02] cursor-pointer' : 'bg-white hover:bg-stone-50 border-stone-200 text-stone-800 hover:border-[#DFB755] cursor-pointer') }}"
                            {{ $isReserved ? 'disabled' : '' }}>
                            
                            <span>{{ $ticket['number'] }}</span>

                            @if($isSelected)
                                <span class="selected-indicator absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#DFB755] text-[#071533] rounded-full text-[9px] flex items-center justify-center font-black shadow-xs pointer-events-none">
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

<!-- Floating Live Checkout Action Bar (Maharaja Navy & Gold) -->
<div id="checkout-dock" class="fixed bottom-0 inset-x-0 z-40 bg-[#040A1A]/95 backdrop-blur-md border-t-2 border-[#DFB755] shadow-2xl p-4 transition-all">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        
        <!-- Left: Selected Tickets Summary -->
        <div class="flex items-center gap-3 sm:gap-4 w-full sm:w-auto justify-between sm:justify-start">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] font-black flex items-center justify-center text-base shadow-sm shrink-0">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span id="selected-count" class="text-white font-black text-sm sm:text-base font-serif">
                        0 Tickets Selected
                    </span>
                    <span id="selected-pack-badge" class="hidden bg-[#DFB755]/20 text-[#F3D068] border border-[#DFB755]/40 text-[10px] font-black px-2 py-0.5 rounded-full font-sans"></span>
                    <span class="text-stone-400 text-xs hidden sm:inline">&bull;</span>
                    <span id="total-price" class="text-[#F3D068] font-black text-sm sm:text-base font-mono">
                        Total: ₹0
                    </span>
                </div>
                <p id="selected-list-preview" class="text-stone-400 text-[11px] font-mono truncate max-w-[280px] sm:max-w-md">
                    Click any ticket in a pack to select
                </p>
            </div>
        </div>

        <!-- Right: Submit Form / Continue Button -->
        <form action="{{ route('payment.form') }}" method="POST" id="booking-checkout-form" class="w-full sm:w-auto">
            @csrf
            <input type="hidden" name="tickets" id="form-tickets-input" value="">
            
            <button type="submit" id="checkout-btn" disabled
                class="w-full sm:w-auto min-w-[240px] bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] font-serif font-black text-sm py-3 px-8 rounded-xl shadow-lg border border-[#FFE8A2]/80 flex items-center justify-center gap-2 transition transform opacity-50 cursor-not-allowed">
                <span>Proceed to Customer Details</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>

    </div>
</div>

<!-- JavaScript for Single Ticket Pack Selection & Dock Updates -->
<script>
    // Selected tickets set & single active pack tracker
    window.selectedTicketsSet = new Set({!! json_encode($selectedTickets ?? []) !!});
    window.ticketPriceMap = {};
    window.selectedCategorySlug = null;
    window.selectedCategoryName = null;

    // Map all ticket prices across all schemes and detect initial pack
    function initTicketPriceMap() {
        document.querySelectorAll('.ticket-btn').forEach(btn => {
            const num = btn.getAttribute('data-ticket');
            const price = parseInt(btn.getAttribute('data-price') || '40', 10);
            const cat = btn.getAttribute('data-category');
            const catName = btn.getAttribute('data-category-name');
            if (num) window.ticketPriceMap[num] = price;

            // Detect if pre-selected
            if (num && window.selectedTicketsSet.has(num) && !window.selectedCategorySlug) {
                window.selectedCategorySlug = cat;
                window.selectedCategoryName = catName;
            }
        });
    }

    // Toggle Ticket Handler: Restrict selection to a SINGLE ticket pack at a time
    window.toggleTicket = function(btn) {
        if (!btn) return;
        const ticketNum = btn.getAttribute('data-ticket');
        const isReserved = btn.getAttribute('data-reserved') === 'true';
        const catSlug = btn.getAttribute('data-category');
        const catName = btn.getAttribute('data-category-name');
        if (isReserved || !ticketNum) return;

        // If clicking a ticket from a DIFFERENT pack, clear previous pack selection
        if (window.selectedCategorySlug && window.selectedCategorySlug !== catSlug && window.selectedTicketsSet.size > 0) {
            document.querySelectorAll('.ticket-btn').forEach(otherBtn => {
                if (otherBtn.getAttribute('data-category') !== catSlug) {
                    otherBtn.className = "ticket-btn select-none py-2.5 px-1.5 rounded-xl text-[11px] sm:text-xs font-mono font-bold transition text-center border relative bg-white hover:bg-stone-50 border-stone-200 text-stone-800 hover:border-[#DFB755] cursor-pointer";
                    const ind = otherBtn.querySelector('.selected-indicator');
                    if (ind) ind.remove();
                }
            });
            window.selectedTicketsSet.clear();
        }

        window.selectedCategorySlug = catSlug;
        window.selectedCategoryName = catName;

        if (window.selectedTicketsSet.has(ticketNum)) {
            window.selectedTicketsSet.delete(ticketNum);
            btn.className = "ticket-btn select-none py-2.5 px-1.5 rounded-xl text-[11px] sm:text-xs font-mono font-bold transition text-center border relative bg-white hover:bg-stone-50 border-stone-200 text-stone-800 hover:border-[#DFB755] cursor-pointer";
            const indicator = btn.querySelector('.selected-indicator');
            if (indicator) indicator.remove();

            if (window.selectedTicketsSet.size === 0) {
                window.selectedCategorySlug = null;
                window.selectedCategoryName = null;
            }
        } else {
            window.selectedTicketsSet.add(ticketNum);
            btn.className = "ticket-btn select-none py-2.5 px-1.5 rounded-xl text-[11px] sm:text-xs font-mono font-bold transition text-center border relative bg-[#040A1A] text-[#F3D068] border-2 border-[#DFB755] ring-2 ring-[#DFB755]/40 shadow-md transform scale-[1.02] cursor-pointer";
            if (!btn.querySelector('.selected-indicator')) {
                const badge = document.createElement('span');
                badge.className = "selected-indicator absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#DFB755] text-[#071533] rounded-full text-[9px] flex items-center justify-center font-black shadow-xs pointer-events-none";
                badge.innerHTML = '<i class="fa-solid fa-check"></i>';
                btn.appendChild(badge);
            }
        }

        window.updateCheckoutDock();
    };

    // Update Floating Checkout Dock
    window.updateCheckoutDock = function() {
        const ticketsArr = Array.from(window.selectedTicketsSet);
        const count = ticketsArr.length;
        
        let total = 0;
        ticketsArr.forEach(t => {
            total += (window.ticketPriceMap[t] || 40);
        });

        const countEl = document.getElementById('selected-count');
        const packBadge = document.getElementById('selected-pack-badge');
        const priceEl = document.getElementById('total-price');
        const previewEl = document.getElementById('selected-list-preview');
        const inputEl = document.getElementById('form-tickets-input');
        const checkoutBtn = document.getElementById('checkout-btn');

        if (countEl) countEl.textContent = count + ' Ticket' + (count === 1 ? '' : 's') + ' Selected';
        
        if (packBadge) {
            if (count > 0 && window.selectedCategoryName) {
                packBadge.textContent = window.selectedCategoryName;
                packBadge.classList.remove('hidden');
            } else {
                packBadge.classList.add('hidden');
            }
        }

        if (priceEl) priceEl.textContent = 'Total: ₹' + total.toLocaleString('en-IN');
        if (previewEl) previewEl.textContent = count > 0 ? (window.selectedCategoryName ? '[' + window.selectedCategoryName + '] ' : '') + ticketsArr.join(', ') : 'Click any ticket in a pack to select';
        if (inputEl) inputEl.value = ticketsArr.join(',');

        if (checkoutBtn) {
            if (count === 0) {
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
                checkoutBtn.classList.remove('hover:scale-[1.02]', 'cursor-pointer');
            } else {
                checkoutBtn.disabled = false;
                checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                checkoutBtn.classList.add('hover:scale-[1.02]', 'cursor-pointer');
            }
        }
    };

    // Live search within category
    window.filterSchemeTickets = function(catSlug, query) {
        const grid = document.getElementById('grid-' + catSlug);
        if (!grid) return;

        const q = (query || '').trim().toUpperCase();
        grid.querySelectorAll('.ticket-btn').forEach(btn => {
            const num = btn.getAttribute('data-ticket');
            if (!q || (num && num.includes(q))) {
                btn.style.display = '';
            } else {
                btn.style.display = 'none';
            }
        });
    };

    // Single click delegation on document to prevent double-firing
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.ticket-btn');
        if (!btn) return;
        e.preventDefault();
        window.toggleTicket(btn);
    });

    // Form submit check
    const checkoutForm = document.getElementById('booking-checkout-form');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            if (window.selectedTicketsSet.size === 0) {
                e.preventDefault();
                alert('Please select at least one ticket before proceeding.');
            }
        });
    }

    // Initialize on ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initTicketPriceMap();
            window.updateCheckoutDock();
        });
    } else {
        initTicketPriceMap();
        window.updateCheckoutDock();
    }
</script>
@endsection

