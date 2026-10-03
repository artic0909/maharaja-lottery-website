@extends('frontend.layouts.app')

@section('content')
<!-- Hero / Header Section -->
<section class="relative bg-gradient-to-br from-[#7F1D1D] via-[#851624] to-[#550C16] text-white pt-10 pb-16 lg:pt-14 lg:pb-20 overflow-hidden shadow-inner">
    <!-- Stylized Watermark Background -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden z-0 select-none">
        <span class="text-white font-serif font-black text-6xl sm:text-8xl md:text-9xl tracking-[0.25em] uppercase opacity-[0.035] whitespace-nowrap">
            MAHARAJA LOTTERY
        </span>
    </div>
    
    <!-- Pattern Overlay -->
    <div class="absolute inset-0 pointer-events-none opacity-15" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#F59E0A]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Header Content (8 cols) -->
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-[#F59E0A] text-xs"></i>
                    <span class="text-[#F59E0A] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        GUIDED TICKET RESERVATION
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-serif font-bold text-white tracking-tight leading-[1.15]">
                    Choose Your Kerala<br class="hidden sm:inline"> Lottery Ticket
                </h1>

                <p class="text-white/85 text-xs sm:text-sm lg:text-base max-w-2xl font-normal leading-relaxed">
                    Select an available number, review the live price and continue to the secure registration step.
                </p>

                <!-- 3 Stat Pills -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <!-- Stat 1: Active Draw -->
                    <div class="bg-white/10 hover:bg-white/15 backdrop-blur-md rounded-xl p-3 sm:p-3.5 border border-white/15 flex items-center gap-3 transition">
                        <div class="w-9 h-9 rounded-lg bg-[#5C1110]/60 border border-amber-400/30 flex items-center justify-center text-[#FBBF24] text-base shrink-0">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold tracking-wider text-amber-300">ACTIVE DRAW</span>
                            <h4 class="text-xs sm:text-sm font-bold text-white truncate">Samrudhi - Every Sunday</h4>
                        </div>
                    </div>

                    <!-- Stat 2: First Prize -->
                    <div class="bg-white/10 hover:bg-white/15 backdrop-blur-md rounded-xl p-3 sm:p-3.5 border border-white/15 flex items-center gap-3 transition">
                        <div class="w-9 h-9 rounded-lg bg-[#5C1110]/60 border border-amber-400/30 flex items-center justify-center text-[#FBBF24] text-base shrink-0">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold tracking-wider text-amber-300">FIRST PRIZE</span>
                            <h4 class="text-xs sm:text-sm font-bold text-white">INR 1 Crore</h4>
                        </div>
                    </div>

                    <!-- Stat 3: Ticket Price -->
                    <div class="bg-white/10 hover:bg-white/15 backdrop-blur-md rounded-xl p-3 sm:p-3.5 border border-white/15 flex items-center gap-3 transition">
                        <div class="w-9 h-9 rounded-lg bg-[#5C1110]/60 border border-amber-400/30 flex items-center justify-center text-[#FBBF24] text-base shrink-0">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold tracking-wider text-amber-300">TICKET PRICE</span>
                            <h4 class="text-xs sm:text-sm font-bold text-white">INR 50</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Steps Stack (4 cols) -->
            <div class="lg:col-span-4 space-y-3">
                <!-- Step 01 (Active) -->
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 border-2 border-white/80 shadow-lg flex items-center gap-4 transition transform hover:scale-[1.01]">
                    <div class="w-12 h-12 rounded-xl bg-white/20 border border-white/40 flex items-center justify-center font-serif font-black text-xl text-amber-300 shrink-0">
                        01
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-amber-200 block">STEP ONE</span>
                        <h4 class="text-base font-bold text-white">Select tickets</h4>
                    </div>
                </div>

                <!-- Step 02 (Inactive) -->
                <div class="bg-white/5 backdrop-blur-xs rounded-2xl p-4 border border-white/10 flex items-center gap-4 opacity-75 hover:opacity-90 transition">
                    <div class="w-12 h-12 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center font-serif font-bold text-lg text-white/70 shrink-0">
                        02
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-white/60 block">STEP TWO</span>
                        <h4 class="text-base font-semibold text-white/90">Your details</h4>
                    </div>
                </div>

                <!-- Step 03 (Inactive) -->
                <div class="bg-white/5 backdrop-blur-xs rounded-2xl p-4 border border-white/10 flex items-center gap-4 opacity-75 hover:opacity-90 transition">
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
<div class="h-1.5 w-full bg-gradient-to-r from-[#D97706] via-[#F59E0A] to-[#D97706]"></div>

<!-- Main Ticket Selection Section -->
<section class="bg-[#FAFAFA] py-10 lg:py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Live Availability Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <span class="text-[#7F1D1D] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest block mb-1">
                    LIVE AVAILABILITY
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-stone-900 tracking-tight">
                    Select your ticket numbers
                </h2>
                <p class="text-stone-600 text-xs sm:text-sm mt-1">
                    Tap any available number to add or remove it from your selection.
                </p>
            </div>

            <!-- Series Quick Filter -->
            <div class="flex items-center gap-2">
                <span class="text-stone-400 text-xs font-semibold">Series:</span>
                <button type="button" onclick="filterSeries('all')" id="btn-series-all" class="px-3 py-1.5 rounded-lg bg-[#7F1D1D] text-white font-bold text-xs shadow-xs transition">All</button>
                <button type="button" onclick="filterSeries('SM1000')" id="btn-series-sm" class="px-3 py-1.5 rounded-lg bg-white border border-stone-200 text-stone-700 hover:border-[#7F1D1D] font-bold text-xs shadow-2xs transition">SM-100</button>
                <button type="button" onclick="filterSeries('SM1001')" id="btn-series-sm2" class="px-3 py-1.5 rounded-lg bg-white border border-stone-200 text-stone-700 hover:border-[#7F1D1D] font-bold text-xs shadow-2xs transition">SM-101</button>
            </div>
        </div>

        <!-- Main Card Container -->
        <div class="bg-white rounded-3xl shadow-sm border border-stone-200/80 p-5 sm:p-8 space-y-6">
            
            <!-- Maroon Draw Banner -->
            <div class="bg-gradient-to-r from-[#601211] via-[#7F1D1D] to-[#601211] rounded-2xl p-6 sm:p-8 text-white text-center shadow-md relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:12px_12px] pointer-events-none"></div>
                
                <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-white/10 border border-white/20 text-[#FBBF24] text-xl mb-3">
                    <i class="fa-solid fa-ticket-simple"></i>
                </div>
                
                <h3 class="text-2xl sm:text-3xl font-serif font-black text-white tracking-wide">
                    Samrudhi - Every Sunday
                </h3>
                
                <p class="text-amber-300 font-bold text-xs sm:text-sm mt-1">
                    INR 50 per ticket
                </p>
                <p class="text-white/70 text-[11px] sm:text-xs">
                    Samrudhi - Every Sunday
                </p>

                <!-- 3 Prize Tier Cards Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4 mt-6">
                    <!-- 1st Prize -->
                    <div class="bg-white rounded-xl p-3.5 sm:p-4 text-stone-800 shadow-sm flex items-center gap-3.5 border border-stone-100 text-left">
                        <div class="w-9 h-9 rounded-lg bg-[#7F1D1D] text-white flex items-center justify-center font-bold text-sm shrink-0">
                            1
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold text-stone-400 tracking-wider">FIRST PRIZE</span>
                            <h5 class="text-xs sm:text-sm font-extrabold text-stone-900">INR 1 Crore</h5>
                            <span class="inline-flex items-center gap-1 text-[10px] text-stone-500 mt-0.5">
                                <i class="fa-solid fa-ticket-simple text-[9px] text-[#7F1D1D]"></i> 1 lucky ticket
                            </span>
                        </div>
                    </div>

                    <!-- 2nd Prize -->
                    <div class="bg-white rounded-xl p-3.5 sm:p-4 text-stone-800 shadow-sm flex items-center gap-3.5 border border-stone-100 text-left">
                        <div class="w-9 h-9 rounded-lg bg-[#7F1D1D] text-white flex items-center justify-center font-bold text-sm shrink-0">
                            2
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold text-stone-400 tracking-wider">SECOND PRIZE</span>
                            <h5 class="text-xs sm:text-sm font-extrabold text-stone-900">INR 75 Lakh</h5>
                            <span class="inline-flex items-center gap-1 text-[10px] text-stone-500 mt-0.5">
                                <i class="fa-solid fa-ticket-simple text-[9px] text-[#7F1D1D]"></i> 1 winner
                            </span>
                        </div>
                    </div>

                    <!-- 3rd Prize -->
                    <div class="bg-white rounded-xl p-3.5 sm:p-4 text-stone-800 shadow-sm flex items-center gap-3.5 border border-stone-100 text-left">
                        <div class="w-9 h-9 rounded-lg bg-[#7F1D1D] text-white flex items-center justify-center font-bold text-sm shrink-0">
                            3
                        </div>
                        <div class="min-w-0">
                            <span class="block text-[9px] uppercase font-bold text-stone-400 tracking-wider">THIRD PRIZE</span>
                            <h5 class="text-xs sm:text-sm font-extrabold text-stone-900">INR 15 Lakh</h5>
                            <span class="inline-flex items-center gap-1 text-[10px] text-stone-500 mt-0.5">
                                <i class="fa-solid fa-ticket-simple text-[9px] text-[#7F1D1D]"></i> 12 winners
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search, Quick Picks & Status Legend Bar -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pt-2 border-b border-stone-100 pb-4">
                
                <!-- Left Search Box -->
                <div class="relative w-full lg:w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                    <input type="text" id="ticket-search" placeholder="Search ticket number" 
                        class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-[#7F1D1D]/30 focus:border-[#7F1D1D] transition">
                </div>

                <!-- Quick Pick Buttons -->
                <div class="flex items-center flex-wrap gap-2 text-xs">
                    <span class="text-stone-400 text-[11px] font-medium mr-1">Quick pick:</span>
                    <button type="button" onclick="quickPick(1)" class="px-2.5 py-1 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold text-xs transition">1</button>
                    <button type="button" onclick="quickPick(3)" class="px-2.5 py-1 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold text-xs transition">3</button>
                    <button type="button" onclick="quickPick(5)" class="px-2.5 py-1 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold text-xs transition">5</button>
                    <button type="button" onclick="quickPick(10)" class="px-2.5 py-1 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold text-xs transition">10</button>
                    <button type="button" onclick="clearSelection()" class="px-2.5 py-1 rounded-lg text-rose-700 hover:bg-rose-50 font-semibold text-xs transition ml-1">Clear</button>
                </div>

                <!-- Right Legend & Count -->
                <div class="flex items-center flex-wrap gap-4 text-xs font-medium text-stone-600">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded-sm border border-stone-300 bg-white"></span>
                        <span class="text-[11px]">Available</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded-sm bg-[#7F1D1D]"></span>
                        <span class="text-[11px] font-bold text-[#7F1D1D]">Selected</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3.5 h-3.5 rounded-sm bg-stone-200"></span>
                        <span class="text-[11px] text-stone-400">Reserved</span>
                    </div>
                    <div class="text-[11px] font-bold text-stone-700 bg-stone-100 px-2.5 py-1 rounded-md">
                        {{ count($tickets) }} tickets displayed
                    </div>
                </div>

            </div>

            <!-- Lottery Tickets Grid - Complete Display Without Any Inner Scroll Container -->
            <div id="tickets-container" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-7 2xl:grid-cols-8 gap-2.5 sm:gap-3 py-2">
                @foreach($tickets as $ticket)
                    @php
                        $isSelected = in_array($ticket['number'], $selectedTickets);
                        $isReserved = $ticket['status'] === 'reserved';
                    @endphp
                    <button type="button"
                        data-ticket="{{ $ticket['number'] }}"
                        data-price="50"
                        @if($isReserved) disabled @endif
                        onclick="toggleTicket('{{ $ticket['number'] }}')"
                        class="ticket-btn select-none py-2.5 px-3 rounded-xl text-xs font-bold tracking-wider transition-all duration-150 text-center
                        @if($isReserved)
                            bg-stone-100 text-stone-300 border border-stone-200/50 cursor-not-allowed
                        @elseif($isSelected)
                            bg-[#7F1D1D] text-white border-2 border-[#7F1D1D] shadow-md transform scale-[1.02]
                        @else
                            bg-white text-stone-800 border border-stone-200 hover:border-[#7F1D1D]/60 hover:shadow-xs
                        @endif">
                        {{ $ticket['number'] }}
                    </button>
                @endforeach
            </div>

        </div>
    </div>
</section>

<!-- Hidden Form to Proceed to Payment Form -->
<form id="proceed-form" action="{{ route('payment.form') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="tickets" id="form-selected-tickets" value="{{ implode(',', $selectedTickets) }}">
</form>

<!-- Floating Bottom Bar (Appears when >= 1 ticket is selected) -->
<div id="floating-bottom-bar" class="fixed bottom-4 left-0 right-0 z-50 px-4 sm:px-6 pointer-events-none transition-all duration-300 transform translate-y-24 opacity-0">
    <div class="container mx-auto max-w-4xl pointer-events-auto">
        <div class="bg-white/95 rounded-2xl shadow-2xl border border-stone-200/90 p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 backdrop-blur-md">
            
            <!-- Left Info -->
            <div class="space-y-1 w-full sm:w-auto text-left">
                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-[#7F1D1D]/10 text-[#7F1D1D] text-[10px] font-extrabold uppercase tracking-wide">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#7F1D1D] animate-ping"></span>
                    Selected
                </div>
                <div class="text-base sm:text-lg font-black text-stone-900 flex items-center gap-2">
                    <span id="floating-count">3 Ticket</span>
                    <span class="text-stone-300">-</span>
                    <span id="floating-amount" class="text-[#7F1D1D]">INR 150</span>
                </div>
                <p id="floating-list" class="text-xs text-stone-500 font-mono font-medium truncate max-w-md">
                    SM100006, SM100007, SM100018
                </p>
            </div>

            <!-- Right Proceed Button -->
            <div class="w-full sm:w-auto flex items-center justify-end">
                <button type="button" onclick="proceedToDetails()" 
                    class="w-full sm:w-auto bg-[#7F1D1D] hover:bg-[#601211] text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-red-950/20 hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02] flex items-center justify-center gap-2">
                    <span>Proceed</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    let selectedTickets = @json($selectedTickets);
    const ticketPrice = 50;

    function renderSelection() {
        const buttons = document.querySelectorAll('.ticket-btn');
        buttons.forEach(btn => {
            const num = btn.getAttribute('data-ticket');
            if (btn.disabled) return;

            if (selectedTickets.includes(num)) {
                btn.className = "ticket-btn select-none py-2.5 px-3 rounded-xl text-xs font-bold tracking-wider transition-all duration-150 text-center bg-[#7F1D1D] text-white border-2 border-[#7F1D1D] shadow-md transform scale-[1.02]";
            } else {
                btn.className = "ticket-btn select-none py-2.5 px-3 rounded-xl text-xs font-bold tracking-wider transition-all duration-150 text-center bg-white text-stone-800 border border-stone-200 hover:border-[#7F1D1D]/60 hover:shadow-xs";
            }
        });

        const bar = document.getElementById('floating-bottom-bar');
        const countSpan = document.getElementById('floating-count');
        const amountSpan = document.getElementById('floating-amount');
        const listP = document.getElementById('floating-list');
        const formInput = document.getElementById('form-selected-tickets');

        if (selectedTickets.length > 0) {
            bar.classList.remove('translate-y-24', 'opacity-0');
            bar.classList.add('translate-y-0', 'opacity-100');
            countSpan.textContent = `${selectedTickets.length} Ticket${selectedTickets.length > 1 ? 's' : ''}`;
            amountSpan.textContent = `INR ${selectedTickets.length * ticketPrice}`;
            listP.textContent = selectedTickets.join(', ');
            formInput.value = selectedTickets.join(',');
        } else {
            bar.classList.add('translate-y-24', 'opacity-0');
            bar.classList.remove('translate-y-0', 'opacity-100');
            formInput.value = '';
        }
    }

    function toggleTicket(number) {
        const index = selectedTickets.indexOf(number);
        if (index > -1) {
            selectedTickets.splice(index, 1);
        } else {
            selectedTickets.push(number);
        }
        renderSelection();
    }

    function quickPick(count) {
        const availableButtons = Array.from(document.querySelectorAll('.ticket-btn:not([disabled])'));
        const availableNumbers = availableButtons.map(b => b.getAttribute('data-ticket'));
        
        const shuffled = availableNumbers.sort(() => 0.5 - Math.random());
        selectedTickets = shuffled.slice(0, count);
        renderSelection();
    }

    function clearSelection() {
        selectedTickets = [];
        renderSelection();
    }

    function filterSeries(series) {
        const buttons = document.querySelectorAll('.ticket-btn');
        const btnAll = document.getElementById('btn-series-all');
        const btnSm = document.getElementById('btn-series-sm');
        const btnSm2 = document.getElementById('btn-series-sm2');

        [btnAll, btnSm, btnSm2].forEach(b => {
            b.className = "px-3 py-1.5 rounded-lg bg-white border border-stone-200 text-stone-700 hover:border-[#7F1D1D] font-bold text-xs shadow-2xs transition";
        });

        if (series === 'all') {
            btnAll.className = "px-3 py-1.5 rounded-lg bg-[#7F1D1D] text-white font-bold text-xs shadow-xs transition";
            buttons.forEach(b => b.style.display = '');
        } else if (series === 'SM1000') {
            btnSm.className = "px-3 py-1.5 rounded-lg bg-[#7F1D1D] text-white font-bold text-xs shadow-xs transition";
            buttons.forEach(b => {
                const num = b.getAttribute('data-ticket');
                b.style.display = num.startsWith('SM1000') ? '' : 'none';
            });
        } else if (series === 'SM1001') {
            btnSm2.className = "px-3 py-1.5 rounded-lg bg-[#7F1D1D] text-white font-bold text-xs shadow-xs transition";
            buttons.forEach(b => {
                const num = b.getAttribute('data-ticket');
                b.style.display = num.startsWith('SM1001') ? '' : 'none';
            });
        }
    }

    function proceedToDetails() {
        if (selectedTickets.length === 0) {
            alert('Please select at least one lottery ticket to proceed.');
            return;
        }
        document.getElementById('proceed-form').submit();
    }

    // Live search filter
    document.getElementById('ticket-search').addEventListener('input', function(e) {
        const term = e.target.value.trim().toUpperCase();
        const buttons = document.querySelectorAll('.ticket-btn');
        buttons.forEach(btn => {
            const num = btn.getAttribute('data-ticket').toUpperCase();
            if (num.includes(term)) {
                btn.style.display = '';
            } else {
                btn.style.display = 'none';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        renderSelection();
    });
</script>
@endsection
