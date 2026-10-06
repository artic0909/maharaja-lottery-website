@extends('frontend.layouts.app')

@section('title', 'Official Draw Desk & Ticket Result Verification')

@section('content')

<!-- Official Draw Desk Banner Section -->
<section class="relative bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] text-white pt-10 pb-16 lg:pt-14 lg:pb-20 overflow-hidden shadow-inner border-b border-[#DFB755]/20">
    <!-- Subtle Background Lottery Pattern & Ambient Glows -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-black/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Heading & Description (8 cols) -->
            <div class="lg:col-span-8">
                <div class="flex items-center gap-2 mb-2.5">
                    <span class="w-5 h-0.5 bg-[#DFB755]"></span>
                    <span class="text-[#F5D77F] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        OFFICIAL DRAW DESK &bull; LIVE AUDIT
                    </span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-black text-white tracking-wide leading-tight mb-3">
                    Maharaja Lottery <span class="text-[#F5D77F]">Results</span>
                </h1>
                
                <p class="text-white/85 text-xs sm:text-sm lg:text-[15px] leading-relaxed max-w-2xl font-normal mb-6">
                    Check your booked lottery ticket result and verification status. Results are officially visible once your booking payment is verified and approved by the admin.
                </p>

                <!-- 3 Badges / Verification Points -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs text-white/90 font-medium">
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-shield-halved text-[#DFB755] text-xs"></i> Admin Approved Results
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-rotate text-[#DFB755] text-xs"></i> Real-time Draw Status
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-lock text-[#DFB755] text-xs"></i> Secure Verification
                    </div>
                </div>
            </div>

            <!-- Right Stat Box (4 cols) -->
            <div class="lg:col-span-4 flex justify-start lg:justify-end">
                <div class="w-full max-w-xs bg-black/35 backdrop-blur-md rounded-2xl p-5 border border-white/15 shadow-2xl">
                    <!-- Trophy Icon -->
                    <div class="w-10 h-10 rounded-xl bg-[#FCF9EE] text-[#071533] border border-[#DFB755]/40 flex items-center justify-center text-lg shadow-xs mb-4">
                        <i class="fa-solid fa-trophy text-[#DFB755]"></i>
                    </div>

                    <!-- Two Stats -->
                    <div class="grid grid-cols-2 gap-4 border-b border-white/10 pb-4 mb-3">
                        <div>
                            <span class="block text-[9px] uppercase tracking-wider font-extrabold text-white/60 mb-0.5">
                                APPROVED DRAWS
                            </span>
                            <span class="text-2xl sm:text-3xl font-black text-white font-serif">{{ $totalPublished }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] uppercase tracking-wider font-extrabold text-white/60 mb-0.5">
                                VERIFIED USERS
                            </span>
                            <span class="text-2xl sm:text-3xl font-black text-white font-serif">{{ $totalPublished }}</span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-2 text-[11px] font-semibold text-[#F5D77F]/90">
                        <i class="fa-solid fa-circle-check text-emerald-400"></i>
                        <span>Admin Verified Results Online</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Quick Verification Floating Search Card -->
<div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-8 sm:-mt-10">
    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-2xl border border-slate-200/90 flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-5 sm:gap-6 max-w-6xl mx-auto">
        
        <!-- Left Info -->
        <div class="flex items-center gap-3.5 sm:gap-4 w-full lg:w-auto">
            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#071533] border border-[#DFB755]/40 flex items-center justify-center text-[#F3D068] text-base sm:text-lg shrink-0 shadow-sm">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div>
                <span class="block text-[10px] font-extrabold text-[#0B193E] uppercase tracking-wider font-sans mb-0.5">
                    TICKET &amp; PAYMENT VERIFICATION
                </span>
                <h3 class="text-sm sm:text-base lg:text-lg font-serif font-bold text-slate-900 tracking-wide">
                    Check your ticket &amp; draw result
                </h3>
                <p class="text-[11px] sm:text-xs text-slate-500 font-normal">
                    Enter your Ticket Number (e.g. MH100003), Booking Ref, or Mobile Number.
                </p>
            </div>
        </div>

        <!-- Right Form Input -->
        <div class="w-full lg:w-auto lg:min-w-[440px]">
            <form action="{{ route('winnerlist') }}" method="GET" class="w-full">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">
                    TICKET NUMBER / BOOKING REF / PHONE
                </label>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center border border-slate-300 rounded-xl overflow-hidden focus-within:border-[#0B193E] focus-within:ring-2 focus-within:ring-[#0B193E]/20 shadow-xs bg-white transition-all">
                    <div class="flex items-center flex-1 min-w-0">
                        <span class="pl-3.5 text-slate-400">
                            <i class="fa-solid fa-ticket-simple text-[#0B193E]"></i>
                        </span>
                        <input type="text" name="ticket_number" value="{{ $searchQuery ?? '' }}" placeholder="Example: MH100003 or 9087767656" class="w-full px-3 py-2.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 bg-transparent outline-none font-medium min-w-0 font-mono">
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] px-6 py-2.5 sm:py-3 text-xs sm:text-sm font-black flex items-center justify-center gap-1.5 transition-colors shrink-0 border-l border-[#DFB755]">
                        <span>Check Result</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Search Result Section (Dynamic based on Admin Approval) -->
@if(!empty($searchQuery))
<div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl mt-8">

    @if($searchState === 'approved')
        <!-- CASE 1: APPROVED BY ADMIN -> FULL RESULT UNLOCKED -->
        <div class="bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] rounded-3xl border-2 border-emerald-500/50 p-6 sm:p-8 text-white shadow-2xl relative overflow-hidden animate-in fade-in zoom-in-95 duration-200">
            <!-- Background Glow -->
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 space-y-6">
                
                <!-- Status Badge Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-5">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 mb-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                ADMIN APPROVED &bull; RESULT VERIFIED
                            </span>
                            <h2 class="text-xl sm:text-2xl font-serif font-black text-white">
                                Booking Confirmed &amp; Active
                            </h2>
                        </div>
                    </div>

                    <div class="text-left sm:text-right">
                        <span class="block text-[10px] font-bold text-stone-400 uppercase tracking-wider">BOOKING REFERENCE</span>
                        <span class="font-mono font-black text-[#F3D068] text-sm sm:text-base select-all">{{ $searchResult['booking_ref'] }}</span>
                    </div>
                </div>

                <!-- Main Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Left: Customer Details -->
                    <div class="bg-black/30 rounded-2xl p-5 border border-white/10 space-y-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755] block">CUSTOMER INFORMATION</span>
                        <div>
                            <span class="text-xs text-stone-400 block">Ticket Holder</span>
                            <span class="text-base font-bold text-white">{{ $searchResult['customer_name'] }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-stone-400 block">Registered Mobile</span>
                            <span class="text-xs font-mono font-bold text-stone-300">{{ $searchResult['customer_mobile'] }}</span>
                        </div>
                        @if(!empty($searchResult['customer_state']))
                            <div>
                                <span class="text-xs text-stone-400 block">Location</span>
                                <span class="text-xs text-stone-300">{{ $searchResult['customer_city'] ? $searchResult['customer_city'].', ' : '' }}{{ $searchResult['customer_state'] }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Middle: Booked Tickets -->
                    <div class="bg-black/30 rounded-2xl p-5 border border-white/10 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755]">BOOKED TICKETS</span>
                            <span class="px-2 py-0.5 rounded-md bg-[#DFB755]/20 text-[#F3D068] text-[10px] font-black font-mono">
                                {{ count($searchResult['tickets'] ?? []) }} Total
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2 max-h-36 overflow-y-auto pr-1">
                            @foreach($searchResult['tickets'] ?? [] as $t)
                                <span class="px-3 py-1.5 rounded-xl bg-white/10 border border-white/20 text-white font-mono font-black text-xs shadow-xs hover:border-[#DFB755] transition select-all">
                                    <i class="fa-solid fa-ticket text-[10px] text-[#DFB755] mr-1"></i>{{ $t }}
                                </span>
                            @endforeach
                        </div>
                        <span class="text-[10px] text-emerald-400 block mt-2">
                            <i class="fa-solid fa-circle-check mr-1"></i> Permanently Reserved &amp; Registered in Directorate
                        </span>
                    </div>

                    <!-- Right: Draw Result & Prize Status -->
                    <div class="bg-gradient-to-br from-emerald-950/40 to-black/40 rounded-2xl p-5 border border-emerald-500/30 space-y-3 flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-400 block">DRAW &amp; PRIZE STATUS</span>
                            <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#0B193E] border border-[#DFB755]/50 text-[#F3D068] font-serif font-black text-sm">
                                <i class="fa-solid fa-award text-[#DFB755]"></i>
                                <span>{{ $searchResult['result_status'] ?? 'Active in Live Draw' }}</span>
                            </div>
                            @if(!empty($searchResult['prize_amount']))
                                <div class="mt-2 text-emerald-300 font-bold text-sm">
                                    Winning Amount: <span class="text-white font-mono font-black text-base">{{ $searchResult['prize_amount'] }}</span>
                                </div>
                            @endif
                            <p class="text-[11px] text-stone-300 mt-2">
                                Payment verified: <span class="font-mono font-bold text-white">INR {{ number_format($searchResult['total_amount'] ?? 0) }}</span> (Received).
                            </p>
                        </div>

                        <div class="pt-2">
                            <a href="https://wa.me/918743978796?text={{ urlencode('Hello Maharaja Directorate, I am checking my approved booking ' . $searchResult['booking_ref'] . ' for ticket(s) ' . implode(', ', $searchResult['tickets'] ?? []) . '.') }}" 
                                target="_blank"
                                class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition shadow-md">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Claim / Official Support Desk</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    @elseif($searchState === 'pending')
        <!-- CASE 2: PENDING APPROVAL -> RESULT LOCKED UNTIL ADMIN APPROVES -->
        <div class="bg-gradient-to-br from-[#1C1405] via-[#2A1F08] to-[#120D03] rounded-3xl border-2 border-amber-500/60 p-6 sm:p-8 text-white shadow-2xl relative overflow-hidden animate-in fade-in zoom-in-95 duration-200">
            <!-- Background Amber Glow -->
            <div class="absolute -top-20 -right-20 w-72 h-72 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 space-y-5">
                
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/20 border border-amber-500/50 text-amber-300 flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-clock-rotate-left animate-spin" style="animation-duration: 4s;"></i>
                    </div>
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-500/20 text-amber-300 border border-amber-500/40 mb-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                            PAYMENT VERIFICATION PENDING BY ADMIN
                        </div>
                        <h2 class="text-xl sm:text-2xl font-serif font-black text-white">
                            Booking Submitted &bull; Awaiting Admin Approval
                        </h2>
                        <p class="text-xs sm:text-sm text-stone-300 mt-1 max-w-2xl leading-relaxed">
                            Your payment submission (UTR / Ref: <span class="font-mono font-bold text-amber-300">{{ $searchResult['utr_number'] ?? 'Direct' }}</span>) is currently being reviewed by our Admin Verification Desk. <strong class="text-white">Draw results and official certificates become viewable on this page immediately once the Admin approves your booking.</strong>
                        </p>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-black/40 rounded-2xl p-4 border border-amber-500/20 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <span class="text-stone-400 block text-[10px] uppercase font-bold">Booking Ref</span>
                        <span class="font-mono font-bold text-white">{{ $searchResult['booking_ref'] }}</span>
                    </div>
                    <div>
                        <span class="text-stone-400 block text-[10px] uppercase font-bold">Selected Tickets</span>
                        <span class="font-mono font-bold text-amber-300">{{ implode(', ', $searchResult['tickets'] ?? []) }}</span>
                    </div>
                    <div>
                        <span class="text-stone-400 block text-[10px] uppercase font-bold">Amount Under Verification</span>
                        <span class="font-mono font-bold text-white">INR {{ number_format($searchResult['total_amount'] ?? 0) }}</span>
                    </div>
                </div>

                <!-- WhatsApp Fast Verification Helper -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                    <span class="text-xs text-stone-400 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-info text-amber-400"></i> Admin approvals usually process within 5 to 15 minutes.
                    </span>
                    <a href="https://wa.me/918743978796?text={{ urlencode('Hello Admin, I have submitted payment for Booking Reference ' . $searchResult['booking_ref'] . ' (UTR: ' . ($searchResult['utr_number'] ?? '') . '). Please approve my booking.') }}" 
                        target="_blank"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-bold text-xs transition shadow-md">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Send Receipt to Admin WhatsApp</span>
                    </a>
                </div>

            </div>
        </div>

    @elseif($searchState === 'rejected')
        <!-- CASE 3: REJECTED -->
        <div class="bg-gradient-to-br from-[#24080B] to-[#120305] rounded-3xl border border-rose-500/50 p-6 sm:p-8 text-white shadow-2xl space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div>
                    <h3 class="text-lg font-serif font-black text-rose-300">Booking / Payment Rejected</h3>
                    <p class="text-xs text-stone-300">The verification desk could not confirm the payment for this booking (Ref: {{ $searchResult['booking_ref'] }}). Please contact customer support.</p>
                </div>
            </div>
        </div>

    @elseif($searchState === 'not_found')
        <!-- CASE 4: NOT FOUND -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 text-center shadow-lg space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl mx-auto">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <h3 class="text-lg font-serif font-bold text-slate-900">No Booking Record Found</h3>
            <p class="text-xs text-slate-500 max-w-md mx-auto">
                No matching ticket or booking found for "<strong class="text-slate-800 font-mono">{{ $searchQuery }}</strong>". Please verify your ticket number or book a new ticket.
            </p>
            <div class="pt-2">
                <a href="{{ route('ticket.booking') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#0B193E] hover:bg-[#071533] text-white font-bold text-xs shadow-md transition">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Book New Ticket</span>
                </a>
            </div>
        </div>

    @endif

</div>
@endif

<!-- Published Archive Section (Displays Admin Approved Records) -->
<section class="py-12 lg:py-16 bg-gradient-to-b from-slate-50 via-white to-slate-100 min-h-[420px]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <!-- Section Header Row -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="w-4 h-0.5 bg-[#0B193E]"></span>
                    <span class="text-[#0B193E] font-extrabold text-[10px] sm:text-[11px] uppercase tracking-widest font-sans">
                        PUBLISHED DRAW ARCHIVE
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-serif font-black text-slate-900 tracking-wide">
                    Recent Maharaja Verified Results
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-normal mt-1">
                    Winning numbers and verified participant records published directly by the Directorate.
                </p>
            </div>

            <!-- Customer Result Access Button -->
            <div class="shrink-0">
                <span class="inline-flex items-center gap-2 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3.5 py-2 rounded-xl shadow-xs">
                    <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                    <span>{{ count($approvedWinners) }} Official Records Approved</span>
                </span>
            </div>
        </div>

        @if(count($approvedWinners) > 0)
            <!-- Approved Records Table View -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-[#071533] text-[10px] sm:text-[11px] uppercase font-bold text-[#F3D068] tracking-wider">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 sm:px-6">DRAW / DATE</th>
                                <th scope="col" class="py-3.5 px-4">PARTICIPANT</th>
                                <th scope="col" class="py-3.5 px-4">VERIFIED TICKETS</th>
                                <th scope="col" class="py-3.5 px-4">STATUS / RESULT</th>
                                <th scope="col" class="py-3.5 px-4 text-right pr-6">CERTIFICATE</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($approvedWinners as $win)
                                <tr class="hover:bg-slate-50/80 transition">
                                    
                                    <!-- Date -->
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-mono text-slate-700 font-bold">
                                        {{ date('d M Y', strtotime($win['booked_at'] ?? 'now')) }}
                                        <span class="block text-[10px] text-slate-400 font-normal">Maharaja Weekly Draw</span>
                                    </td>

                                    <!-- Customer -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <div class="font-bold text-slate-900">{{ $win['customer_name'] }}</div>
                                        <span class="text-[10px] text-slate-400 font-mono">{{ substr($win['customer_mobile'] ?? '', 0, 3) . '****' . substr($win['customer_mobile'] ?? '', -3) }}</span>
                                    </td>

                                    <!-- Tickets -->
                                    <td class="py-3.5 px-4">
                                        <div class="flex flex-wrap gap-1 max-w-xs">
                                            @foreach($win['tickets'] as $ticket)
                                                <span class="inline-block px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 border border-emerald-200 font-mono font-black text-[11px]">
                                                    {{ $ticket }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                            <i class="fa-solid fa-circle-check text-emerald-600 text-[10px]"></i>
                                            {{ $win['result_status'] ?? 'Active in Live Draw' }}
                                        </span>
                                        @if(!empty($win['prize_amount']))
                                            <span class="block text-[10px] font-bold text-emerald-600 mt-0.5">{{ $win['prize_amount'] }}</span>
                                        @endif
                                    </td>

                                    <!-- Action -->
                                    <td class="py-3.5 px-4 text-right pr-6 whitespace-nowrap">
                                        <a href="{{ route('winnerlist', ['ticket_number' => $win['booking_ref']]) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#0B193E] hover:bg-[#071533] text-[#F3D068] text-xs font-bold transition shadow-xs">
                                            <i class="fa-solid fa-eye text-[10px]"></i>
                                            <span>View Verification</span>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Empty State Card -->
            <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200/90 p-12 lg:p-20 text-center shadow-xs mt-6 flex flex-col items-center justify-center">
                <div class="w-16 h-16 rounded-2xl bg-[#e6eef9] text-[#0B193E] flex items-center justify-center text-2xl shadow-xs mb-4">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                
                <h3 class="text-lg sm:text-xl font-serif font-bold text-slate-900 tracking-wide mb-1.5">
                    No approved results published yet
                </h3>
                
                <p class="text-xs sm:text-sm text-slate-500 max-w-md font-normal">
                    Published draw records will appear here as soon as the Admin approves bookings and releases draw results.
                </p>
            </div>
        @endif

    </div>
</section>

@endsection
