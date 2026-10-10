@extends('admin.layouts.app')

@section('title', 'TDS & Withdrawal Requests')
@section('page_title', 'TDS & Withdrawal Management')

@section('content')
<div class="space-y-6 sm:space-y-8">

    <!-- Workspace Header & Action Alerts -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[11px] font-black uppercase tracking-widest text-[#DFB755] block mb-0.5">
                TAX COMPLIANCE &amp; SETTLEMENT DESK
            </span>
            <h1 class="text-2xl sm:text-3xl font-serif font-black text-white tracking-tight">
                TDS &amp; Prize Withdrawal Requests
            </h1>
            <p class="text-xs text-stone-400 mt-1">
                Verify customer 1% TDS payments, audit bank accounts, inspect payment receipts, and release winner disbursements.
            </p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 p-4 rounded-2xl flex items-center gap-3 text-xs sm:text-sm">
            <i class="fa-solid fa-circle-check text-emerald-400 text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4 rounded-2xl flex items-center gap-3 text-xs sm:text-sm">
            <i class="fa-solid fa-circle-exclamation text-rose-400 text-base"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Metric Stat Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <!-- Total TDS Requests -->
        <div class="bg-gradient-to-br from-[#071533] to-[#040A1A] p-4 sm:p-5 rounded-2xl border border-[#DFB755]/25 shadow-xl">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400">Total Requests</span>
                <span class="w-7 h-7 rounded-lg bg-white/5 text-[#DFB755] flex items-center justify-center text-xs">
                    <i class="fa-solid fa-folder-open"></i>
                </span>
            </div>
            <div class="text-xl sm:text-2xl font-mono font-black text-white">{{ $stats['total'] }}</div>
            <span class="text-[10px] text-stone-400 mt-1 block">All-time applications</span>
        </div>

        <!-- Pending Verifications -->
        <div class="bg-gradient-to-br from-[#071533] to-[#040A1A] p-4 sm:p-5 rounded-2xl border border-amber-500/40 shadow-xl relative overflow-hidden">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] uppercase font-bold tracking-wider text-amber-300">Pending Review</span>
                <span class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center text-xs animate-pulse">
                    <i class="fa-solid fa-clock"></i>
                </span>
            </div>
            <div class="text-xl sm:text-2xl font-mono font-black text-amber-300">{{ $stats['pending'] }}</div>
            <span class="text-[10px] text-amber-200/70 mt-1 block">Requires manual audit</span>
        </div>

        <!-- Total TDS Collected -->
        <div class="bg-gradient-to-br from-[#071533] to-[#040A1A] p-4 sm:p-5 rounded-2xl border border-[#DFB755]/25 shadow-xl">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] uppercase font-bold tracking-wider text-stone-400">1% TDS Paid</span>
                <span class="w-7 h-7 rounded-lg bg-[#DFB755]/15 text-[#DFB755] flex items-center justify-center text-xs">
                    <i class="fa-solid fa-receipt"></i>
                </span>
            </div>
            <div class="text-lg sm:text-xl font-mono font-black text-[#F3D068]">₹{{ number_format($stats['total_tds']) }}</div>
            <span class="text-[10px] text-emerald-400 mt-1 block">Approved: ₹{{ number_format($stats['approved_tds']) }}</span>
        </div>

        <!-- Total Prize Amount -->
        <div class="bg-gradient-to-br from-[#071533] to-[#040A1A] p-4 sm:p-5 rounded-2xl border border-emerald-500/30 shadow-xl">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-300">Prize Claim Amount</span>
                <span class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-trophy"></i>
                </span>
            </div>
            <div class="text-lg sm:text-xl font-mono font-black text-emerald-400">₹{{ number_format($stats['total_winning']) }}</div>
            <span class="text-[10px] text-stone-400 mt-1 block">Total winning funds claimed</span>
        </div>
    </div>

    <!-- Main Table Container Card -->
    <div class="bg-[#071533]/90 rounded-3xl border border-[#DFB755]/25 shadow-2xl overflow-hidden">
        
        <!-- Filter Bar Header -->
        <div class="p-5 sm:p-6 pb-4 border-b border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Quick Status Filters -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.tds.index', ['status' => 'all', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'all' ? 'bg-[#DFB755] text-[#071533] font-black' : 'bg-white/5 hover:bg-white/10 text-stone-300' }}">
                    <span>All</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $statusFilter === 'all' ? 'bg-[#071533] text-[#DFB755]' : 'bg-white/10 text-stone-300' }}">{{ $stats['total'] }}</span>
                </a>

                <a href="{{ route('admin.tds.index', ['status' => 'pending', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'pending' ? 'bg-amber-400 text-stone-950 font-black' : 'bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                    <i class="fa-solid fa-clock text-[10px]"></i>
                    <span>Pending</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-amber-400/20 text-amber-200">{{ $stats['pending'] }}</span>
                </a>

                <a href="{{ route('admin.tds.index', ['status' => 'approved', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'approved' ? 'bg-emerald-500 text-white font-black' : 'bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' }}">
                    <i class="fa-solid fa-check text-[10px]"></i>
                    <span>Approved</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-emerald-400/20 text-emerald-200">{{ $stats['approved'] }}</span>
                </a>

                <a href="{{ route('admin.tds.index', ['status' => 'rejected', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'rejected' ? 'bg-rose-500 text-white font-black' : 'bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30' }}">
                    <i class="fa-solid fa-ban text-[10px]"></i>
                    <span>Rejected</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-rose-400/20 text-rose-200">{{ $stats['rejected'] }}</span>
                </a>
            </div>

            <!-- Search Form -->
            <form action="{{ route('admin.tds.index') }}" method="GET" class="relative min-w-[240px] sm:min-w-[280px]">
                <input type="hidden" name="status" value="{{ $statusFilter }}">
                <input type="text" 
                    name="q" 
                    value="{{ $search }}" 
                    placeholder="Search name, phone, A/C, UTR..."
                    class="w-full pl-9 pr-9 py-2 bg-white/5 border border-white/15 rounded-xl text-xs text-white placeholder-stone-400 focus:outline-none focus:border-[#DFB755] transition">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                @if(!empty($search))
                    <a href="{{ route('admin.tds.index', ['status' => $statusFilter]) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-white text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </form>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-black/30 border-b border-white/10 text-stone-400 uppercase text-[10px] tracking-wider">
                        <th class="py-3 px-4"># ID</th>
                        <th class="py-3 px-4">Customer Info</th>
                        <th class="py-3 px-4">Bank Details</th>
                        <th class="py-3 px-4">Winning Prize &amp; 1% TDS</th>
                        <th class="py-3 px-4">UTR / Ref</th>
                        <th class="py-3 px-4">Receipt Proof</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-stone-200">
                    @forelse($records as $rec)
                        <tr class="hover:bg-white/5 transition duration-150">
                            <!-- ID -->
                            <td class="py-3 px-4 font-mono font-bold text-stone-400">
                                #{{ $rec->id }}
                            </td>

                            <!-- Customer Info -->
                            <td class="py-3 px-4">
                                <div class="font-bold text-white text-sm">{{ $rec->customer_name }}</div>
                                <div class="font-mono text-stone-400 text-[11px] flex items-center gap-1.5 mt-0.5">
                                    <i class="fa-solid fa-phone text-[9px] text-[#DFB755]"></i>
                                    <span>{{ $rec->customer_phone }}</span>
                                </div>
                                @if(!empty($rec->booking_ref))
                                    <div class="text-[10px] font-mono text-stone-500 mt-0.5">
                                        Ref: {{ $rec->booking_ref }}
                                    </div>
                                @endif
                            </td>

                            <!-- Bank Details -->
                            <td class="py-3 px-4">
                                <div class="font-mono font-bold text-stone-100 flex items-center gap-1.5">
                                    <i class="fa-solid fa-credit-card text-[#DFB755] text-[10px]"></i>
                                    <span>{{ $rec->account_number }}</span>
                                </div>
                                <div class="font-mono text-[11px] text-[#F3D068] mt-0.5">
                                    IFSC: {{ $rec->ifsc_code }}
                                </div>
                                @if(!empty($rec->bank_name))
                                    <div class="text-[10px] text-stone-400 truncate max-w-[150px]">
                                        {{ $rec->bank_name }}
                                    </div>
                                @endif
                            </td>

                            <!-- Winning Prize & 1% TDS -->
                            <td class="py-3 px-4">
                                <div class="font-mono font-black text-emerald-400 text-sm">
                                    {{ $rec->winning_prize_text ?: '₹' . number_format($rec->winning_amount) }}
                                </div>
                                <div class="inline-flex items-center gap-1 text-[11px] font-bold text-[#F3D068] bg-[#DFB755]/10 px-2 py-0.5 rounded-md border border-[#DFB755]/30 mt-1">
                                    <span>1% TDS:</span>
                                    <span class="font-mono font-black">₹{{ number_format($rec->tds_amount) }}</span>
                                </div>
                            </td>

                            <!-- UTR Number -->
                            <td class="py-3 px-4 font-mono text-stone-300">
                                @if(!empty($rec->utr_number))
                                    <span class="bg-black/30 px-2 py-1 rounded border border-white/10 select-all text-[11px] font-bold">
                                        {{ $rec->utr_number }}
                                    </span>
                                @else
                                    <span class="text-stone-500 text-[10px] italic">Not provided</span>
                                @endif
                            </td>

                            <!-- Receipt Screenshot Thumbnail -->
                            <td class="py-3 px-4">
                                @if(!empty($rec->receipt_image) && file_exists(public_path($rec->receipt_image)))
                                    <button type="button" 
                                        onclick="openImageLightbox('{{ asset($rec->receipt_image) }}')" 
                                        class="group relative block w-11 h-11 rounded-lg overflow-hidden border border-[#DFB755]/40 hover:border-[#DFB755] transition shadow-sm cursor-pointer">
                                        <img src="{{ asset($rec->receipt_image) }}" alt="Receipt" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs transition">
                                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                                        </div>
                                    </button>
                                @else
                                    <span class="text-stone-500 text-[10px] italic">No file</span>
                                @endif
                            </td>

                            <!-- Status Badge -->
                            <td class="py-3 px-4">
                                @if($rec->status === 'Approved')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        <i class="fa-solid fa-circle-check text-[9px]"></i>
                                        <span>Approved</span>
                                    </span>
                                @elseif($rec->status === 'Rejected')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                        <i class="fa-solid fa-circle-xmark text-[9px]"></i>
                                        <span>Rejected</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-500/20 text-amber-300 border border-amber-500/30 animate-pulse">
                                        <i class="fa-solid fa-clock text-[9px]"></i>
                                        <span>Pending</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="py-3 px-4 text-stone-400 text-[11px] font-mono">
                                {{ $rec->created_at ? $rec->created_at->format('d M, H:i') : '-' }}
                            </td>

                            <!-- Actions -->
                            <td class="py-3 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5 justify-end">
                                    
                                    <!-- VIEW DETAILS BUTTON (OPENS MODAL) -->
                                    <button type="button" 
                                        onclick="openTdsViewModal({{ json_encode($rec) }}, '{{ $rec->receipt_image ? asset($rec->receipt_image) : '' }}')"
                                        class="px-2.5 py-1.5 rounded-lg bg-[#0B193E] hover:bg-[#12255c] text-[#F3D068] border border-[#DFB755]/40 text-xs font-bold transition flex items-center gap-1.5 shadow-sm cursor-pointer"
                                        title="View Full Details">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                        <span>View</span>
                                    </button>

                                    <!-- Quick Approve -->
                                    @if($rec->status !== 'Approved')
                                        <form action="{{ route('admin.tds.approve', $rec->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                class="w-7 h-7 rounded-lg bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center text-xs transition cursor-pointer" 
                                                title="Approve TDS">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Quick Reject -->
                                    @if($rec->status !== 'Rejected')
                                        <form action="{{ route('admin.tds.reject', $rec->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                class="w-7 h-7 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/30 flex items-center justify-center text-xs transition cursor-pointer" 
                                                title="Reject TDS">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Delete Record -->
                                    <form action="{{ route('admin.tds.destroy', $rec->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this TDS record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="w-7 h-7 rounded-lg bg-white/5 hover:bg-rose-500/20 text-stone-400 hover:text-rose-400 flex items-center justify-center text-xs transition cursor-pointer" 
                                            title="Delete Record">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center text-stone-400">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-xl text-stone-500 mx-auto mb-3">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <p class="text-sm font-bold text-white">No TDS payment requests found</p>
                                <p class="text-xs text-stone-500 mt-1">When winners submit bank details and 1% TDS payment proof, they will show up here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($records->hasPages())
            <div class="p-4 border-t border-white/10">
                {{ $records->links() }}
            </div>
        @endif

    </div>

</div>

<!-- COMPREHENSIVE VIEW DETAILS MODAL -->
<div id="tds-view-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden items-center justify-center p-3 sm:p-5 transition-all duration-300">
    <div class="relative bg-gradient-to-b from-[#071533] via-[#0B193E] to-[#040A1A] border-2 border-[#DFB755] rounded-3xl p-5 sm:p-7 max-w-2xl w-full text-white shadow-2xl overflow-y-auto max-h-[90vh] space-y-5 animate-in zoom-in-95 duration-200">
        
        <!-- Modal Top Header -->
        <div class="flex items-center justify-between pb-3 border-b border-white/15">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/40 flex items-center justify-center text-[#F3D068] text-sm shrink-0">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-bold tracking-widest text-[#DFB755] block">TDS &amp; WITHDRAWAL AUDIT</span>
                    <h2 class="text-base sm:text-lg font-serif font-black text-white" id="modal-view-title">
                        Request Details #<span id="modal-view-id"></span>
                    </h2>
                </div>
            </div>

            <button type="button" onclick="closeTdsViewModal()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-stone-300 hover:text-white flex items-center justify-center text-xs transition cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Status & Date Ribbon -->
        <div class="flex items-center justify-between bg-black/40 rounded-xl p-3 border border-white/10 text-xs">
            <div class="flex items-center gap-2">
                <span class="text-stone-400">Current Status:</span>
                <span id="modal-view-status-badge"></span>
            </div>
            <div class="text-stone-400 font-mono text-[11px]" id="modal-view-date"></div>
        </div>

        <!-- Section 1: Customer & Ticket Info -->
        <div class="space-y-2">
            <span class="text-[10px] uppercase font-bold tracking-wider text-[#DFB755] block">1. Customer Identification</span>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-white/5 rounded-2xl p-4 border border-white/10 text-xs">
                <div>
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">Customer Name:</span>
                    <span class="font-bold text-white text-sm" id="modal-view-name"></span>
                </div>
                <div>
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">Mobile Number:</span>
                    <span class="font-mono font-bold text-stone-200 text-sm" id="modal-view-phone"></span>
                </div>
                <div>
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">Booking Reference:</span>
                    <span class="font-mono font-bold text-[#F3D068]" id="modal-view-ref"></span>
                </div>
                <div>
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">UTR / Transaction ID:</span>
                    <span class="font-mono font-bold text-emerald-400" id="modal-view-utr"></span>
                </div>
            </div>
        </div>

        <!-- Section 2: Bank Settlement Details -->
        <div class="space-y-2">
            <span class="text-[10px] uppercase font-bold tracking-wider text-[#DFB755] block">2. Beneficiary Bank Account</span>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 bg-white/5 rounded-2xl p-4 border border-white/10 text-xs">
                <div>
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">Account Number:</span>
                    <span class="font-mono font-black text-white text-sm select-all" id="modal-view-account"></span>
                </div>
                <div>
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">IFSC Code:</span>
                    <span class="font-mono font-black text-[#F3D068] text-sm select-all" id="modal-view-ifsc"></span>
                </div>
                <div>
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">Bank Name:</span>
                    <span class="font-bold text-stone-200" id="modal-view-bank"></span>
                </div>
            </div>
        </div>

        <!-- Section 3: Financial Clearance Summary -->
        <div class="space-y-2">
            <span class="text-[10px] uppercase font-bold tracking-wider text-[#DFB755] block">3. Financial Clearance Amounts</span>
            <div class="grid grid-cols-2 gap-3 bg-white/5 rounded-2xl p-4 border border-white/10 text-xs">
                <div class="bg-black/30 rounded-xl p-3 border border-white/10">
                    <span class="text-stone-400 block text-[10px] uppercase font-semibold">Total Winning Prize:</span>
                    <span class="font-mono font-black text-emerald-400 text-base sm:text-lg block mt-0.5" id="modal-view-prize"></span>
                </div>
                <div class="bg-amber-500/10 rounded-xl p-3 border border-[#DFB755]/30">
                    <span class="text-amber-300 block text-[10px] uppercase font-semibold">1% TDS Amount Paid:</span>
                    <span class="font-mono font-black text-[#F3D068] text-base sm:text-lg block mt-0.5" id="modal-view-tds"></span>
                </div>
            </div>
        </div>

        <!-- Section 4: Receipt Screenshot Proof -->
        <div class="space-y-2" id="modal-view-receipt-section">
            <span class="text-[10px] uppercase font-bold tracking-wider text-[#DFB755] block">4. Payment Receipt Screenshot</span>
            <div class="bg-black/40 rounded-2xl p-4 border border-white/10 text-center space-y-3">
                <img id="modal-view-receipt-img" src="" alt="Payment Receipt" class="max-h-64 mx-auto rounded-xl object-contain border border-white/20 shadow-lg">
                <div class="flex items-center justify-center gap-3">
                    <a id="modal-view-receipt-link" href="" target="_blank" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>Open Full Image</span>
                    </a>
                    <a id="modal-view-receipt-download" href="" download class="px-4 py-2 rounded-xl bg-[#DFB755] hover:bg-[#C59B27] text-[#071533] font-bold text-xs flex items-center gap-1.5 transition">
                        <i class="fa-solid fa-download text-[10px]"></i>
                        <span>Download</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section 5: Admin Actions Form inside Modal -->
        <div class="space-y-2 pt-2 border-t border-white/15">
            <span class="text-[10px] uppercase font-bold tracking-wider text-[#DFB755] block">5. Admin Actions &amp; Verification</span>
            <div class="flex items-center gap-3">
                <!-- Approve Form -->
                <form id="modal-approve-form" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-md transition cursor-pointer">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Approve TDS &amp; Release</span>
                    </button>
                </form>

                <!-- Reject Form -->
                <form id="modal-reject-form" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-rose-600 to-rose-500 hover:from-rose-500 hover:to-rose-400 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-md transition cursor-pointer">
                        <i class="fa-solid fa-circle-xmark"></i>
                        <span>Reject TDS</span>
                    </button>
                </form>

                <!-- Close Button -->
                <button type="button" onclick="closeTdsViewModal()" class="py-2.5 px-4 rounded-xl bg-white/10 hover:bg-white/20 text-stone-300 font-bold text-xs transition cursor-pointer">
                    Close
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Image Lightbox Modal -->
<div id="image-lightbox-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-4 transition-all duration-300" onclick="closeImageLightbox()">
    <div class="relative max-w-3xl max-h-[90vh] p-2 bg-stone-900 rounded-2xl border border-[#DFB755]/50 shadow-2xl" onclick="event.stopPropagation()">
        <button type="button" onclick="closeImageLightbox()" class="absolute -top-3 -right-3 w-8 h-8 rounded-full bg-rose-600 text-white flex items-center justify-center text-xs font-bold hover:bg-rose-500 transition shadow-md">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <img id="lightbox-img" src="" alt="Proof Preview" class="max-h-[85vh] max-w-full rounded-xl object-contain">
    </div>
</div>

@push('scripts')
<script>
    function openImageLightbox(src) {
        document.getElementById('lightbox-img').src = src;
        const modal = document.getElementById('image-lightbox-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeImageLightbox() {
        const modal = document.getElementById('image-lightbox-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openTdsViewModal(data, receiptUrl) {
        document.getElementById('modal-view-id').innerText = data.id;
        document.getElementById('modal-view-name').innerText = data.customer_name || 'N/A';
        document.getElementById('modal-view-phone').innerText = data.customer_phone || 'N/A';
        document.getElementById('modal-view-ref').innerText = data.booking_ref || 'None';
        document.getElementById('modal-view-utr').innerText = data.utr_number || 'None';
        document.getElementById('modal-view-account').innerText = data.account_number || 'N/A';
        document.getElementById('modal-view-ifsc').innerText = data.ifsc_code || 'N/A';
        document.getElementById('modal-view-bank').innerText = data.bank_name || 'Not specified';
        
        const prizeText = data.winning_prize_text || ('₹' + Number(data.winning_amount).toLocaleString());
        document.getElementById('modal-view-prize').innerText = prizeText;
        document.getElementById('modal-view-tds').innerText = '₹' + Number(data.tds_amount).toLocaleString();
        
        document.getElementById('modal-view-date').innerText = 'Submitted: ' + (data.created_at ? new Date(data.created_at).toLocaleString() : 'N/A');

        // Status badge
        const badgeContainer = document.getElementById('modal-view-status-badge');
        if (data.status === 'Approved') {
            badgeContainer.innerHTML = '<span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Approved</span>';
        } else if (data.status === 'Rejected') {
            badgeContainer.innerHTML = '<span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-500/20 text-rose-300 border border-rose-500/30">Rejected</span>';
        } else {
            badgeContainer.innerHTML = '<span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-500/20 text-amber-300 border border-amber-500/30">Pending</span>';
        }

        // Receipt section
        const receiptSection = document.getElementById('modal-view-receipt-section');
        if (receiptUrl) {
            receiptSection.classList.remove('hidden');
            document.getElementById('modal-view-receipt-img').src = receiptUrl;
            document.getElementById('modal-view-receipt-link').href = receiptUrl;
            document.getElementById('modal-view-receipt-download').href = receiptUrl;
        } else {
            receiptSection.classList.add('hidden');
        }

        // Setup Actions URLs
        document.getElementById('modal-approve-form').action = "/admin/tds/" + data.id + "/approve";
        document.getElementById('modal-reject-form').action = "/admin/tds/" + data.id + "/reject";

        // Show Modal
        const modal = document.getElementById('tds-view-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeTdsViewModal() {
        const modal = document.getElementById('tds-view-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush
@endsection
