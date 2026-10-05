@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="space-y-6 sm:space-y-8">

    <!-- Workspace Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[11px] font-black uppercase tracking-widest text-[#DFB755] block mb-0.5">
                ADMIN WORKSPACE
            </span>
            <h1 class="text-2xl sm:text-3xl font-serif font-black text-white tracking-tight">
                Dashboard
            </h1>
        </div>

        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#040A1A] border border-[#DFB755]/30 text-xs font-semibold text-stone-300">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Live System Online</span>
            </span>
        </div>
    </div>

    <!-- 5 Key Performance Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        
        <!-- Card 1: Total Bookings -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/25 shadow-lg relative overflow-hidden group hover:border-[#DFB755]/60 transition-all">
            <!-- Decorative Soft Background Corner Blob -->
            <div class="absolute -bottom-6 -right-6 w-24 h-24 rounded-full bg-pink-500/10 blur-xl pointer-events-none group-hover:bg-pink-500/20 transition-all"></div>
            <div class="absolute -bottom-4 -right-4 w-16 h-16 rounded-full bg-white/[0.03] pointer-events-none"></div>

            <div class="relative z-10 space-y-4">
                <div class="w-10 h-10 rounded-xl bg-pink-500/15 border border-pink-500/30 text-pink-400 flex items-center justify-center text-sm shadow-inner">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        TOTAL BOOKINGS
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-white group-hover:text-[#F3D068] transition-colors">
                        {{ $metrics['total_bookings'] }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card 2: Pending Payment -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/25 shadow-lg relative overflow-hidden group hover:border-amber-400/60 transition-all">
            <!-- Decorative Soft Background Corner Blob -->
            <div class="absolute -bottom-6 -right-6 w-24 h-24 rounded-full bg-amber-500/10 blur-xl pointer-events-none group-hover:bg-amber-500/20 transition-all"></div>
            <div class="absolute -bottom-4 -right-4 w-16 h-16 rounded-full bg-white/[0.03] pointer-events-none"></div>

            <div class="relative z-10 space-y-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center text-sm shadow-inner">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        PENDING PAYMENT
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-white group-hover:text-amber-300 transition-colors">
                        {{ $metrics['pending_payment'] }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card 3: Payment Submitted -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/25 shadow-lg relative overflow-hidden group hover:border-purple-400/60 transition-all">
            <!-- Decorative Soft Background Corner Blob -->
            <div class="absolute -bottom-6 -right-6 w-24 h-24 rounded-full bg-purple-500/10 blur-xl pointer-events-none group-hover:bg-purple-500/20 transition-all"></div>
            <div class="absolute -bottom-4 -right-4 w-16 h-16 rounded-full bg-white/[0.03] pointer-events-none"></div>

            <div class="relative z-10 space-y-4">
                <div class="w-10 h-10 rounded-xl bg-purple-500/15 border border-purple-500/30 text-purple-400 flex items-center justify-center text-sm shadow-inner">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        PAYMENT SUBMITTED
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-serif font-black text-white group-hover:text-purple-300 transition-colors">
                        {{ $metrics['payment_submitted'] }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card 4: Total Verified Amount -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/25 shadow-lg relative overflow-hidden group hover:border-[#DFB755]/60 transition-all">
            <!-- Decorative Soft Background Corner Blob -->
            <div class="absolute -bottom-6 -right-6 w-24 h-24 rounded-full bg-[#DFB755]/10 blur-xl pointer-events-none group-hover:bg-[#DFB755]/20 transition-all"></div>
            <div class="absolute -bottom-4 -right-4 w-16 h-16 rounded-full bg-white/[0.03] pointer-events-none"></div>

            <div class="relative z-10 space-y-4">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755] flex items-center justify-center text-sm shadow-inner">
                    <span class="font-bold text-xs">₹</span>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        TOTAL VERIFIED AMOUNT
                    </span>
                    <h3 class="text-xl sm:text-2xl font-serif font-black text-[#F3D068]">
                        {{ $metrics['total_verified_amount'] }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card 5: Today Verified Amount -->
        <div class="bg-[#071533]/90 rounded-2xl p-5 border border-[#DFB755]/25 shadow-lg relative overflow-hidden group hover:border-emerald-400/60 transition-all">
            <!-- Decorative Soft Background Corner Blob -->
            <div class="absolute -bottom-6 -right-6 w-24 h-24 rounded-full bg-emerald-500/10 blur-xl pointer-events-none group-hover:bg-emerald-500/20 transition-all"></div>
            <div class="absolute -bottom-4 -right-4 w-16 h-16 rounded-full bg-white/[0.03] pointer-events-none"></div>

            <div class="relative z-10 space-y-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-sm shadow-inner">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400 block mb-1">
                        TODAY VERIFIED AMOUNT
                    </span>
                    <h3 class="text-xl sm:text-2xl font-serif font-black text-white group-hover:text-emerald-300 transition-colors">
                        {{ $metrics['today_verified_amount'] }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Bookings Table Container -->
    <div class="bg-[#071533]/90 rounded-3xl border border-[#DFB755]/25 shadow-2xl overflow-hidden">
        
        <!-- Table Title Header -->
        <div class="p-5 sm:p-6 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10">
            <div>
                <h2 class="text-xl sm:text-2xl font-serif font-black text-white tracking-tight">
                    Recent Bookings
                </h2>
                <p class="text-xs text-stone-400 mt-0.5">
                    Live stream of recent user ticket purchases and verification logs
                </p>
            </div>

            <!-- Quick Filter / Action Buttons -->
            <div class="flex items-center gap-2">
                <button type="button" onclick="filterTable('all')" id="btn-all" class="px-3 py-1.5 rounded-xl bg-[#DFB755] text-[#071533] font-black text-xs transition shadow-xs">
                    All ({{ count($recentBookings) }})
                </button>
                <button type="button" onclick="filterTable('Confirmed')" id="btn-confirmed" class="px-3 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-emerald-300 font-bold text-xs border border-emerald-500/30 transition">
                    Confirmed
                </button>
                <button type="button" onclick="filterTable('Profile Submitted')" id="btn-submitted" class="px-3 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-amber-300 font-bold text-xs border border-amber-500/30 transition">
                    Profile Submitted
                </button>
            </div>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-stone-300" id="recent-bookings-table">
                <thead class="bg-[#0B193E] text-[11px] uppercase font-black text-[#DFB755] tracking-wider border-b border-[#DFB755]/30">
                    <tr>
                        <th scope="col" class="py-4 px-4 sm:px-6">ID</th>
                        <th scope="col" class="py-4 px-4">NAME</th>
                        <th scope="col" class="py-4 px-4">TICKETS</th>
                        <th scope="col" class="py-4 px-4">AMOUNT</th>
                        <th scope="col" class="py-4 px-4">STATUS</th>
                        <th scope="col" class="py-4 px-4 sm:pr-6">UPDATED</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 font-sans">
                    @foreach($recentBookings as $b)
                        <tr class="table-row-item hover:bg-white/[0.04] transition duration-150" data-status="{{ $b['status'] }}">
                            
                            <!-- ID -->
                            <td class="py-4 px-4 sm:px-6 whitespace-nowrap">
                                <span class="font-mono font-bold text-white text-xs select-all">
                                    {{ $b['id'] }}
                                </span>
                            </td>

                            <!-- NAME -->
                            <td class="py-4 px-4 whitespace-nowrap font-medium text-stone-200">
                                {{ $b['name'] }}
                            </td>

                            <!-- TICKETS -->
                            <td class="py-4 px-4">
                                <span class="font-mono font-semibold text-[#F3D068]">
                                    {{ $b['tickets'] }}
                                </span>
                            </td>

                            <!-- AMOUNT -->
                            <td class="py-4 px-4 whitespace-nowrap font-mono font-bold text-white">
                                {{ $b['amount'] }}
                            </td>

                            <!-- STATUS -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($b['status'] === 'Confirmed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Confirmed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-500/15 text-[#F3D068] border border-amber-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                        Profile Submitted
                                    </span>
                                @endif
                            </td>

                            <!-- UPDATED -->
                            <td class="py-4 px-4 sm:pr-6 whitespace-nowrap font-mono text-[11px] text-stone-400">
                                {{ $b['updated'] }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer Summary -->
        <div class="p-4 bg-[#040A1A]/80 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-stone-400">
            <span>Showing recent {{ count($recentBookings) }} ticket entries</span>
            <span class="text-stone-400 font-mono text-[11px]">Maharaja Lottery Directorate Console</span>
        </div>

    </div>

</div>

@push('scripts')
<script>
    function filterTable(status) {
        const rows = document.querySelectorAll('.table-row-item');
        const btnAll = document.getElementById('btn-all');
        const btnConfirmed = document.getElementById('btn-confirmed');
        const btnSubmitted = document.getElementById('btn-submitted');

        // Reset all buttons
        [btnAll, btnConfirmed, btnSubmitted].forEach(btn => {
            btn.className = "px-3 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-stone-300 font-bold text-xs border border-white/10 transition";
        });

        if (status === 'all') {
            btnAll.className = "px-3 py-1.5 rounded-xl bg-[#DFB755] text-[#071533] font-black text-xs transition shadow-xs";
            rows.forEach(r => r.style.display = '');
        } else if (status === 'Confirmed') {
            btnConfirmed.className = "px-3 py-1.5 rounded-xl bg-emerald-500 text-white font-black text-xs transition shadow-xs";
            rows.forEach(r => {
                r.style.display = r.getAttribute('data-status') === 'Confirmed' ? '' : 'none';
            });
        } else if (status === 'Profile Submitted') {
            btnSubmitted.className = "px-3 py-1.5 rounded-xl bg-[#DFB755] text-[#071533] font-black text-xs transition shadow-xs";
            rows.forEach(r => {
                r.style.display = r.getAttribute('data-status') === 'Profile Submitted' ? '' : 'none';
            });
        }
    }
</script>
@endpush
@endsection
