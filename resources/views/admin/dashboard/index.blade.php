@extends('admin.layouts.app')

@section('title', 'Master Dashboard')
@section('page_title', 'Overview')

@section('content')
<div class="space-y-6">

    <!-- Top Greeting & Quick Action Banner -->
    <div class="bg-gradient-to-r from-[#0B193E] via-[#071533] to-[#040A1A] rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl relative overflow-hidden">
        <!-- Subtle Motif Overlay -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:12px_12px] pointer-events-none"></div>
        <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] text-[11px] font-bold uppercase tracking-wider">
                    <i class="fa-solid fa-crown text-xs"></i>
                    <span>Maharaja Directorate Control Center</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-white tracking-tight">
                    Welcome back, <span class="text-[#F3D068]">Master Admin</span>
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl leading-relaxed">
                    Here is your real-time lottery summary for ticket reservations, UPI payment verifications, and active draw schemes.
                </p>
            </div>

            <!-- Quick Action Shortcut Buttons -->
            <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
                <a href="{{ route('ticket.booking') }}" target="_blank" 
                    class="bg-gradient-to-r from-[#16A34A] to-[#15803D] hover:from-[#15803D] hover:to-[#166534] text-white px-4 py-2.5 rounded-xl font-bold text-xs shadow-md shadow-emerald-950/30 border border-emerald-400/30 flex items-center gap-2 transition transform hover:scale-105">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Test New Booking</span>
                </a>
                <a href="{{ route('winnerlist') }}" target="_blank" 
                    class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] px-4 py-2.5 rounded-xl font-black text-xs shadow-md shadow-gold-500/20 border border-[#FFE8A2]/80 flex items-center gap-2 transition transform hover:scale-105">
                    <i class="fa-solid fa-trophy text-xs text-[#071533]"></i>
                    <span>Publish Results</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Key Performance Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- Card 1: Total Gross Revenue -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/30 shadow-lg relative overflow-hidden group hover:border-[#DFB755] transition-all">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        GROSS REVENUE
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-[#F3D068]">
                        {{ $metrics['total_revenue'] }}
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755] flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                <span class="text-emerald-400 font-bold flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> {{ $metrics['revenue_growth'] }}
                </span>
                <span class="text-stone-400 text-[11px]">vs last week</span>
            </div>
        </div>

        <!-- Card 2: Tickets Sold Today -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/30 shadow-lg relative overflow-hidden group hover:border-[#DFB755] transition-all">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        TICKETS SOLD TODAY
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-white">
                        {{ number_format($metrics['tickets_sold_today']) }}
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/15 border border-emerald-400/30 text-emerald-400 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-ticket"></i>
                </div>
            </div>
            <!-- Progress Bar -->
            <div class="mt-4 pt-3 border-t border-white/5 space-y-1.5">
                <div class="flex justify-between text-[11px] text-stone-400">
                    <span>Target: {{ number_format($metrics['tickets_target']) }}</span>
                    <span class="text-emerald-400 font-bold">74%</span>
                </div>
                <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-300 rounded-full" style="width: 74%"></div>
                </div>
            </div>
        </div>

        <!-- Card 3: Pending UPI Verifications -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-amber-500/40 shadow-lg relative overflow-hidden group hover:border-amber-400 transition-all">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-amber-300 block mb-1">
                        PENDING VERIFICATIONS
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-white flex items-center gap-2">
                        <span>{{ $metrics['pending_verifications'] }}</span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-ping"></span>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 border border-amber-400/40 text-amber-300 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                <a href="#recent-bookings-section" class="text-[#F3D068] hover:underline font-semibold flex items-center gap-1">
                    <span>Review UTR receipts</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
                <span class="text-stone-400 text-[11px]">Immediate Action</span>
            </div>
        </div>

        <!-- Card 4: Active Draw Schemes -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/30 shadow-lg relative overflow-hidden group hover:border-[#DFB755] transition-all">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        ACTIVE LOTTERIES
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-white">
                        {{ $metrics['active_draws'] }} Draws
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-[#0F2356] border border-[#DFB755]/30 text-[#DFB755] flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-award"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                <span class="text-stone-300 font-semibold">1st Prize Pool:</span>
                <span class="text-[#DFB755] font-bold">{{ $metrics['prizes_distributed'] }}</span>
            </div>
        </div>

    </div>

    <!-- Active Draw Countdown & Quick Overview Row -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Live Draw Banner (8 cols) -->
        <div class="lg:col-span-8 bg-gradient-to-br from-[#0B193E] to-[#071533] rounded-3xl p-6 border border-[#DFB755]/30 shadow-xl flex flex-col justify-between space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-[#040A1A] border border-[#DFB755]/40 flex items-center justify-center text-[#F3D068] text-lg shrink-0">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <div>
                        <span class="text-[9px] uppercase font-extrabold tracking-widest text-[#DFB755] block">NEXT SCHEDULED DRAW</span>
                        <h4 class="text-lg sm:text-xl font-serif font-black text-white">Samrudhi Sunday Jackpot (SM-104)</h4>
                    </div>
                </div>

                <div class="inline-flex items-center gap-2 bg-emerald-500/15 border border-emerald-400/30 px-3 py-1.5 rounded-full text-xs text-emerald-300 font-bold self-start sm:self-auto">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Live Booking Open</span>
                </div>
            </div>

            <!-- Countdown Timer Blocks -->
            <div class="grid grid-cols-4 gap-2 sm:gap-4 text-center">
                <div class="bg-[#040A1A]/80 border border-[#DFB755]/20 rounded-2xl p-3 sm:p-4">
                    <span id="countdown-days" class="block text-xl sm:text-3xl font-black font-mono text-[#F3D068]">02</span>
                    <span class="text-[9px] sm:text-[10px] uppercase font-bold text-stone-400 tracking-wider">Days</span>
                </div>
                <div class="bg-[#040A1A]/80 border border-[#DFB755]/20 rounded-2xl p-3 sm:p-4">
                    <span id="countdown-hours" class="block text-xl sm:text-3xl font-black font-mono text-[#F3D068]">14</span>
                    <span class="text-[9px] sm:text-[10px] uppercase font-bold text-stone-400 tracking-wider">Hours</span>
                </div>
                <div class="bg-[#040A1A]/80 border border-[#DFB755]/20 rounded-2xl p-3 sm:p-4">
                    <span id="countdown-mins" class="block text-xl sm:text-3xl font-black font-mono text-[#F3D068]">38</span>
                    <span class="text-[9px] sm:text-[10px] uppercase font-bold text-stone-400 tracking-wider">Mins</span>
                </div>
                <div class="bg-[#040A1A]/80 border border-[#DFB755]/20 rounded-2xl p-3 sm:p-4">
                    <span id="countdown-secs" class="block text-xl sm:text-3xl font-black font-mono text-emerald-400">45</span>
                    <span class="text-[9px] sm:text-[10px] uppercase font-bold text-stone-400 tracking-wider">Secs</span>
                </div>
            </div>

            <!-- Draw Highlights Footer -->
            <div class="flex flex-wrap items-center justify-between gap-4 pt-2 text-xs text-stone-300">
                <div class="flex items-center gap-4">
                    <span><strong class="text-white">Draw Time:</strong> Sunday 3:00 PM IST</span>
                    <span><strong class="text-white">Ticket Price:</strong> ₹50</span>
                </div>
                <div class="text-[#DFB755] font-bold">
                    1st Prize: INR 1 Crore Guaranteed
                </div>
            </div>
        </div>

        <!-- Weekly Draw Schedule Summary (4 cols) -->
        <div id="draw-schedules-section" class="lg:col-span-4 bg-[#071533]/90 rounded-3xl p-6 border border-[#DFB755]/30 shadow-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-white/10 mb-4">
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-calendar-days text-[#DFB755]"></i>
                        <span>Weekly Draw Calendar</span>
                    </h4>
                    <span class="text-[10px] font-bold text-[#DFB755] bg-[#DFB755]/10 px-2 py-0.5 rounded">4 Draws</span>
                </div>

                <div class="space-y-3">
                    @foreach($drawSchedules as $draw)
                        <div class="bg-[#040A1A]/70 rounded-xl p-3 border border-white/5 flex items-center justify-between hover:border-[#DFB755]/30 transition">
                            <div class="min-w-0">
                                <h5 class="text-xs font-bold text-white truncate">{{ $draw['name'] }}</h5>
                                <p class="text-[10px] text-stone-400">{{ $draw['draw_date'] }} • {{ $draw['jackpot'] }}</p>
                            </div>
                            <span class="px-2 py-1 rounded-md text-[10px] font-bold {{ $draw['status'] === 'Open' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-white/10 text-stone-300' }}">
                                {{ $draw['status'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-4 mt-4 border-t border-white/10 text-center">
                <button type="button" onclick="alert('Draw schedule manager opened.')" class="w-full bg-white/5 hover:bg-white/10 text-xs font-bold text-stone-300 hover:text-[#DFB755] py-2 rounded-xl border border-white/10 transition">
                    + Add New Draw Scheme
                </button>
            </div>
        </div>

    </div>

    <!-- Recent Ticket Bookings & Payment Submissions Section -->
    <div id="recent-bookings-section" class="bg-[#071533]/90 rounded-3xl border border-[#DFB755]/30 shadow-xl overflow-hidden">
        
        <!-- Table Header & Controls Bar -->
        <div class="p-5 sm:p-6 border-b border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-[10px] uppercase font-extrabold tracking-widest text-[#DFB755]">TRANSACTION DESK</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#DFB755]"></span>
                </div>
                <h3 class="text-lg sm:text-xl font-serif font-black text-white">
                    Recent Ticket Orders &amp; UPI Submissions
                </h3>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-2">
                <button type="button" onclick="filterBookings('all')" id="tab-all" class="px-3 py-1.5 rounded-xl bg-[#DFB755] text-[#071533] font-black text-xs transition shadow-sm">
                    All ({{ count($recentBookings) }})
                </button>
                <button type="button" onclick="filterBookings('pending')" id="tab-pending" class="px-3 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-amber-300 font-bold text-xs border border-amber-500/30 transition">
                    Pending Verification
                </button>
                <button type="button" onclick="filterBookings('verified')" id="tab-verified" class="px-3 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-emerald-300 font-bold text-xs border border-emerald-500/30 transition">
                    Verified
                </button>
            </div>
        </div>

        <!-- Bookings Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-stone-300 divide-y divide-white/10" id="bookings-table">
                <thead class="bg-[#040A1A]/80 text-[10px] uppercase font-bold text-stone-400 tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 sm:px-6">Booking ID</th>
                        <th class="py-3.5 px-4">Customer Details</th>
                        <th class="py-3.5 px-4">Selected Tickets</th>
                        <th class="py-3.5 px-4">Amount</th>
                        <th class="py-3.5 px-4">UPI UTR ID</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 font-sans">
                    @foreach($recentBookings as $index => $b)
                        <tr class="booking-row hover:bg-white/5 transition" data-status="{{ $b['status'] }}" id="row-{{ $b['id'] }}">
                            
                            <!-- Booking ID & Time -->
                            <td class="py-4 px-4 sm:px-6 whitespace-nowrap">
                                <span class="font-mono font-black text-white block">{{ $b['id'] }}</span>
                                <span class="text-[10px] text-stone-400">{{ $b['created_at'] }}</span>
                            </td>

                            <!-- Customer Info -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="font-bold text-white block">{{ $b['customer_name'] }}</span>
                                <span class="text-[11px] font-mono text-stone-400">{{ $b['customer_mobile'] }}</span>
                                <span class="text-[10px] text-stone-500 block truncate max-w-[150px]">{{ $b['customer_city'] }}</span>
                            </td>

                            <!-- Tickets -->
                            <td class="py-4 px-4">
                                <div class="flex flex-wrap gap-1 max-w-[180px]">
                                    @foreach($b['tickets'] as $t)
                                        <span class="px-1.5 py-0.5 rounded bg-[#040A1A] border border-[#DFB755]/30 text-white font-mono text-[10px] font-bold">
                                            {{ $t }}
                                        </span>
                                    @endforeach
                                </div>
                                <span class="text-[10px] text-stone-400 mt-1 block">{{ count($b['tickets']) }} Ticket{{ count($b['tickets']) > 1 ? 's' : '' }}</span>
                            </td>

                            <!-- Amount -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="text-sm font-black text-[#F3D068] font-mono">₹{{ $b['amount'] }}</span>
                                <span class="text-[10px] text-stone-400 block">{{ $b['payment_method'] }}</span>
                            </td>

                            <!-- UTR & Copy -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <span class="font-mono text-xs font-bold text-white select-all">{{ $b['utr'] }}</span>
                                    <button type="button" onclick="copyText('{{ $b['utr'] }}')" title="Copy UTR" class="text-stone-400 hover:text-[#DFB755] transition p-1">
                                        <i class="fa-regular fa-copy text-[11px]"></i>
                                    </button>
                                </div>
                            </td>

                            <!-- Status Badge -->
                            <td class="py-4 px-4 whitespace-nowrap" id="status-cell-{{ $b['id'] }}">
                                @if($b['status'] === 'verified')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 font-bold text-[11px] border border-emerald-500/30">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i> Verified
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-300 font-bold text-[11px] border border-amber-500/30 animate-pulse">
                                        <i class="fa-solid fa-clock text-[10px]"></i> Pending Approval
                                    </span>
                                @endif
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-4 px-4 whitespace-nowrap text-right space-x-1.5" id="action-cell-{{ $b['id'] }}">
                                @if($b['status'] === 'pending')
                                    <button type="button" onclick="approveBooking('{{ $b['id'] }}')" 
                                        class="px-2.5 py-1.5 rounded-lg bg-[#DFB755] hover:bg-[#F3D068] text-[#071533] font-black text-xs transition shadow-xs">
                                        Approve
                                    </button>
                                @else
                                    <button type="button" onclick="alert('Ticket certificate is already issued and verified.')"
                                        class="px-2.5 py-1.5 rounded-lg bg-white/10 hover:bg-white/15 text-stone-300 text-xs font-semibold transition">
                                        View Certificate
                                    </button>
                                @endif

                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $b['customer_mobile']) }}?text={{ urlencode('Hello ' . $b['customer_name'] . ', your Maharaja Lottery booking ' . $b['id'] . ' has been approved.') }}" 
                                    target="_blank" title="Send WhatsApp Message"
                                    class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#25D366]/20 hover:bg-[#25D366] text-[#25D366] hover:text-white transition">
                                    <i class="fa-brands fa-whatsapp text-xs"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="p-4 bg-[#040A1A]/80 border-t border-white/10 flex items-center justify-between text-xs text-stone-400">
            <span>Showing recent {{ count($recentBookings) }} customer transactions</span>
            <span class="text-stone-400 font-mono">Live WebSocket synced</span>
        </div>

    </div>

</div>

<!-- Interactive JavaScript Controls -->
@push('scripts')
<script>
    // Live Countdown Timer logic for upcoming Sunday Draw
    function startCountdown() {
        let sec = 45;
        let min = 38;
        let hr = 14;
        let days = 2;

        setInterval(() => {
            if (sec > 0) {
                sec--;
            } else {
                sec = 59;
                if (min > 0) {
                    min--;
                } else {
                    min = 59;
                    if (hr > 0) hr--;
                }
            }

            const secEl = document.getElementById('countdown-secs');
            const minEl = document.getElementById('countdown-mins');
            const hrEl = document.getElementById('countdown-hours');

            if (secEl) secEl.textContent = sec < 10 ? '0' + sec : sec;
            if (minEl) minEl.textContent = min < 10 ? '0' + min : min;
            if (hrEl) hrEl.textContent = hr < 10 ? '0' + hr : hr;
        }, 1000);
    }
    startCountdown();

    // Filter Table by Status
    function filterBookings(status) {
        const rows = document.querySelectorAll('.booking-row');
        const tabAll = document.getElementById('tab-all');
        const tabPending = document.getElementById('tab-pending');
        const tabVerified = document.getElementById('tab-verified');

        [tabAll, tabPending, tabVerified].forEach(btn => {
            btn.className = "px-3 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-stone-300 font-bold text-xs border border-white/10 transition";
        });

        if (status === 'all') {
            tabAll.className = "px-3 py-1.5 rounded-xl bg-[#DFB755] text-[#071533] font-black text-xs transition shadow-sm";
            rows.forEach(r => r.style.display = '');
        } else if (status === 'pending') {
            tabPending.className = "px-3 py-1.5 rounded-xl bg-amber-400 text-[#071533] font-black text-xs transition shadow-sm";
            rows.forEach(r => {
                r.style.display = r.getAttribute('data-status') === 'pending' ? '' : 'none';
            });
        } else if (status === 'verified') {
            tabVerified.className = "px-3 py-1.5 rounded-xl bg-emerald-500 text-white font-black text-xs transition shadow-sm";
            rows.forEach(r => {
                r.style.display = r.getAttribute('data-status') === 'verified' ? '' : 'none';
            });
        }
    }

    // Approve booking live simulation
    function approveBooking(bookingId) {
        const row = document.getElementById('row-' + bookingId);
        const statusCell = document.getElementById('status-cell-' + bookingId);
        const actionCell = document.getElementById('action-cell-' + bookingId);

        if (row && statusCell) {
            row.setAttribute('data-status', 'verified');
            statusCell.innerHTML = `
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 font-bold text-[11px] border border-emerald-500/30">
                    <i class="fa-solid fa-circle-check text-[10px]"></i> Verified
                </span>
            `;
            actionCell.innerHTML = `
                <button type="button" onclick="alert('Ticket certificate issued.')" class="px-2.5 py-1.5 rounded-lg bg-white/10 hover:bg-white/15 text-stone-300 text-xs font-semibold transition">
                    View Certificate
                </button>
            `;
            alert('Booking ' + bookingId + ' has been successfully approved and verified! Certificate sent.');
        }
    }

    // Copy text helper
    function copyText(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Copied UTR: ' + text);
        }).catch(() => {
            alert('UTR: ' + text);
        });
    }
</script>
@endpush
@endsection
