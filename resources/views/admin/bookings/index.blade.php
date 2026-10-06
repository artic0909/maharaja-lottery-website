@extends('admin.layouts.app')

@section('title', 'Bookings & Payment Verification')
@section('page_title', 'Bookings & Payment Management')

@section('content')
<div class="space-y-6 sm:space-y-8">

    <!-- Workspace Header & Action Alerts -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[11px] font-black uppercase tracking-widest text-[#DFB755] block mb-0.5">
                LOTTERY AUDIT DESK
            </span>
            <h1 class="text-2xl sm:text-3xl font-serif font-black text-white tracking-tight">
                Bookings &amp; Payment Records
            </h1>
            <p class="text-xs text-stone-400 mt-1">
                Verify customer UPI/bank transactions, check payment screenshots, and approve bookings to publish live results to the frontend.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/15 border border-emerald-500/40 rounded-2xl p-4 flex items-center gap-3 text-emerald-300 text-xs font-bold shadow-lg animate-in fade-in duration-200">
            <i class="fa-solid fa-circle-check text-emerald-400 text-base shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-500/15 border border-rose-500/40 rounded-2xl p-4 flex items-center gap-3 text-rose-300 text-xs font-bold shadow-lg">
            <i class="fa-solid fa-circle-exclamation text-rose-400 text-base shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Bulk Actions Sticky Floating Bar (Shows when 1+ checkboxes selected) -->
    <div id="bulk-action-bar" class="hidden bg-[#040A1A]/95 border-2 border-[#DFB755] rounded-2xl p-3 sm:p-4 shadow-2xl backdrop-blur-md sticky top-4 z-40 flex flex-col sm:flex-row items-center justify-between gap-3 animate-in fade-in slide-in-from-top-4 duration-200">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#DFB755]/20 text-[#DFB755] flex items-center justify-center text-sm font-bold">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <div>
                <span class="text-xs font-bold text-white"><span id="selected-count" class="font-black text-[#DFB755]">0</span> items selected</span>
                <span class="text-[10px] text-stone-400 block">Apply action to all selected bookings</span>
            </div>
        </div>

        <div class="flex items-center gap-2 flex-wrap justify-end">
            <!-- Bulk Approve -->
            <form id="bulk-approve-form" action="{{ route('admin.bookings.bulk_approve') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="refs" id="bulk-approve-refs">
                <button type="button" onclick="submitBulkApprove()" 
                    class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 transition shadow-md">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Bulk Approve</span>
                </button>
            </form>

            <!-- Bulk Delete -->
            <form id="bulk-delete-form" action="{{ route('admin.bookings.bulk_delete') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="refs" id="bulk-delete-refs">
                <button type="button" onclick="submitBulkDelete()" 
                    class="px-3.5 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs flex items-center gap-1.5 transition shadow-md">
                    <i class="fa-solid fa-trash-can"></i>
                    <span>Bulk Delete</span>
                </button>
            </form>

            <!-- Deselect All -->
            <button type="button" onclick="deselectAllBookings()" class="px-3 py-2 rounded-xl bg-white/10 hover:bg-white/15 text-stone-300 text-xs font-bold transition">
                Deselect All
            </button>
        </div>
    </div>

    <!-- Main Bookings Table Card -->
    <div class="bg-[#071533]/90 rounded-3xl border border-[#DFB755]/25 shadow-2xl overflow-hidden">
        
        <!-- Search & Filter Bar Header -->
        <div class="p-5 sm:p-6 pb-4 border-b border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Quick Status Filter Pills -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.bookings.index', ['status' => 'all', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'all' ? 'bg-[#DFB755] text-[#071533] shadow-sm font-black' : 'bg-white/5 hover:bg-white/10 text-stone-300' }}">
                    <span>All Bookings</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $statusFilter === 'all' ? 'bg-[#071533] text-[#DFB755]' : 'bg-white/10 text-stone-300' }}">{{ $stats['total'] }}</span>
                </a>

                <a href="{{ route('admin.bookings.index', ['status' => 'Pending', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'pending' ? 'bg-amber-500 text-stone-900 font-black shadow-sm' : 'bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                    <i class="fa-solid fa-clock text-[10px]"></i>
                    <span>Pending Verification</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-amber-400/20 text-amber-200">{{ $stats['pending'] }}</span>
                </a>

                <a href="{{ route('admin.bookings.index', ['status' => 'Approved', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'approved' ? 'bg-emerald-500 text-white font-black shadow-sm' : 'bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' }}">
                    <i class="fa-solid fa-check text-[10px]"></i>
                    <span>Payment Received (Approved)</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-emerald-400/20 text-emerald-200">{{ $stats['approved'] }}</span>
                </a>

                <a href="{{ route('admin.bookings.index', ['status' => 'Rejected', 'q' => request('q')]) }}" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $statusFilter === 'rejected' ? 'bg-rose-500 text-white font-black shadow-sm' : 'bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30' }}">
                    <i class="fa-solid fa-ban text-[10px]"></i>
                    <span>Rejected</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-rose-400/20 text-rose-200">{{ $stats['rejected'] }}</span>
                </a>
            </div>

            <!-- Search Form -->
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex items-center gap-2">
                <input type="hidden" name="status" value="{{ $statusFilter }}">
                <div class="relative w-full sm:w-64">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Search Ref, Phone, Ticket..." 
                        class="w-full bg-[#040A1A] border border-white/20 rounded-xl px-3.5 py-2 pl-9 text-xs text-white placeholder-stone-400 focus:outline-none focus:border-[#DFB755]">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-stone-400 text-xs"></i>
                </div>
                <button type="submit" class="px-3 py-2 bg-[#DFB755] text-[#071533] font-bold text-xs rounded-xl hover:bg-[#F3D068] transition">
                    Filter
                </button>
                @if(!empty($search))
                    <a href="{{ route('admin.bookings.index', ['status' => $statusFilter]) }}" class="px-2.5 py-2 bg-white/10 hover:bg-white/15 text-stone-300 text-xs rounded-xl transition" title="Clear Search">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </form>

        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-stone-300">
                <thead class="bg-[#0B193E] text-[11px] uppercase font-black text-[#DFB755] tracking-wider border-b border-[#DFB755]/30">
                    <tr>
                        <!-- Multi-Selector Master Checkbox -->
                        <th scope="col" class="py-4 px-3 sm:px-4 text-center w-10">
                            <input type="checkbox" id="select-all-bookings" onchange="toggleSelectAll(this)" 
                                class="w-4 h-4 rounded bg-[#040A1A] border border-white/40 text-[#DFB755] focus:ring-0 cursor-pointer accent-[#DFB755]" title="Select All Bookings">
                        </th>
                        <th scope="col" class="py-4 px-4">BOOKING REF / DATE</th>
                        <th scope="col" class="py-4 px-4">CUSTOMER</th>
                        <th scope="col" class="py-4 px-4">BOOKED TICKETS</th>
                        <th scope="col" class="py-4 px-4">AMOUNT</th>
                        <th scope="col" class="py-4 px-4">PAYMENT / UTR</th>
                        <th scope="col" class="py-4 px-4">APPROVAL STATUS</th>
                        <th scope="col" class="py-4 px-4">RESULT / DRAW STATUS</th>
                        <th scope="col" class="py-4 px-4 text-right pr-6">ADMIN ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 font-sans">
                    @forelse($bookings as $b)
                        <tr class="hover:bg-white/[0.04] transition duration-150 group" id="row-{{ $b['booking_ref'] }}">
                            
                            <!-- 0. Individual Row Selector Checkbox -->
                            <td class="py-4 px-3 sm:px-4 align-top text-center">
                                <input type="checkbox" value="{{ $b['booking_ref'] }}" onchange="updateBulkToolbar()" 
                                    class="booking-row-checkbox w-4 h-4 rounded bg-[#040A1A] border border-white/40 text-[#DFB755] focus:ring-0 cursor-pointer accent-[#DFB755]">
                            </td>

                            <!-- 1. Booking Ref & Date -->
                            <td class="py-4 px-4 align-top whitespace-nowrap">
                                <span class="font-mono font-black text-white text-xs block select-all">
                                    {{ $b['booking_ref'] }}
                                </span>
                                <span class="text-[10px] text-stone-400 font-mono block mt-0.5">
                                    <i class="fa-regular fa-calendar text-[10px] mr-1"></i>{{ date('d M Y, h:i A', strtotime($b['booked_at'])) }}
                                </span>
                            </td>

                            <!-- 2. Customer -->
                            <td class="py-4 px-4 align-top">
                                <div class="font-bold text-white text-xs">{{ $b['customer_name'] }}</div>
                                <div class="text-[11px] font-mono text-[#F3D068] mt-0.5 flex items-center gap-1">
                                    <i class="fa-solid fa-phone text-[10px]"></i>
                                    <a href="tel:{{ $b['customer_mobile'] }}" class="hover:underline">{{ $b['customer_mobile'] }}</a>
                                </div>
                                @if(!empty($b['customer_state']))
                                    <div class="text-[10px] text-stone-400">{{ $b['customer_city'] ? $b['customer_city'].', ' : '' }}{{ $b['customer_state'] }}</div>
                                @endif
                            </td>

                            <!-- 3. Booked Tickets -->
                            <td class="py-4 px-4 align-top">
                                <div class="flex items-center gap-1.5 mb-1.5">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-[#DFB755]/15 text-[#F3D068] border border-[#DFB755]/30 text-[10px] font-black">
                                        <i class="fa-solid fa-ticket text-[9px]"></i>
                                        {{ $b['ticket_count'] }} Tickets
                                    </span>
                                </div>
                                <div class="flex flex-wrap gap-1 max-w-xs">
                                    @foreach($b['tickets'] as $ticket)
                                        <span class="inline-block px-2 py-0.5 rounded bg-white/5 border border-white/10 text-white font-mono font-bold text-[11px] select-all">
                                            {{ $ticket }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>

                            <!-- 4. Amount -->
                            <td class="py-4 px-4 align-top whitespace-nowrap">
                                <span class="font-mono font-black text-white text-sm block">
                                    ₹{{ number_format($b['total_amount']) }}
                                </span>
                                <span class="text-[10px] text-stone-400 block">{{ $b['payment_method'] ?? 'UPI / QR' }}</span>
                            </td>

                            <!-- 5. Payment / UTR & Attachment indicator -->
                            <td class="py-4 px-4 align-top">
                                @if(!empty($b['utr_number']))
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-mono text-emerald-300 font-bold text-xs select-all bg-emerald-500/10 px-2 py-1 rounded border border-emerald-500/20">
                                            {{ $b['utr_number'] }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-stone-400 text-xs italic block">Direct</span>
                                @endif

                                @if(!empty($b['receipt_image']))
                                    <button type="button" onclick="openDetailsModal({{ json_encode($b) }})" 
                                        class="mt-1 inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-cyan-500/15 text-cyan-300 border border-cyan-500/30 text-[10px] font-bold hover:bg-cyan-500/25 transition">
                                        <i class="fa-regular fa-image text-[9px]"></i> Receipt Attached
                                    </button>
                                @endif
                            </td>

                            <!-- 6. Approval Status -->
                            <td class="py-4 px-4 align-top whitespace-nowrap">
                                @if($b['status'] === 'Approved')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Payment Received (Approved)
                                    </span>
                                    @if(!empty($b['approved_at']))
                                        <span class="block text-[9px] text-stone-400 font-mono mt-0.5">Approved: {{ date('d M, h:i A', strtotime($b['approved_at'])) }}</span>
                                    @endif
                                @elseif($b['status'] === 'Rejected')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-rose-500/15 text-rose-300 border border-rose-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                        Rejected
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-500/15 text-amber-300 border border-amber-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                        Pending Admin Approval
                                    </span>
                                    <span class="block text-[10px] text-amber-400/80 mt-0.5 font-medium">Result hidden from user</span>
                                @endif
                            </td>

                            <!-- 7. Result Status -->
                            <td class="py-4 px-4 align-top">
                                @if($b['status'] === 'Approved')
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#0B193E] border border-[#DFB755]/40 text-[#F3D068] font-bold text-xs">
                                        <i class="fa-solid fa-trophy text-[10px]"></i>
                                        <span>{{ $b['result_status'] ?? 'Active in Live Draw' }}</span>
                                    </div>
                                    @if(!empty($b['prize_amount']))
                                        <div class="text-[11px] font-black text-emerald-400 mt-1">Prize: {{ $b['prize_amount'] }}</div>
                                    @endif
                                @else
                                    <span class="text-stone-400 text-xs italic">Locked (Awaiting Approval)</span>
                                @endif
                            </td>

                            <!-- 8. Admin Actions (Approve, View Details & Receipt, Set Result, Reject, Delete) -->
                            <td class="py-4 px-4 align-top text-right pr-6 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    
                                    @if($b['status'] !== 'Approved')
                                        <!-- Approve Button (Payment Received) -->
                                        <form action="{{ route('admin.bookings.approve', $b['booking_ref']) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                onclick="return confirm('Confirm payment received for {{ $b['booking_ref'] }} (₹{{ $b['total_amount'] }}) and approve frontend result access?')"
                                                class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 transition shadow-sm" title="Approve Booking & Confirm Payment">
                                                <i class="fa-solid fa-check"></i>
                                                <span>Approve</span>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- View Details & Payment Attachment Icon -->
                                    <button type="button" onclick="openDetailsModal({{ json_encode($b) }})" 
                                        class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/15 text-cyan-300 hover:text-cyan-200 border border-cyan-500/30 text-xs font-bold transition flex items-center gap-1" title="View Full Booking & Payment Proof">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <!-- Update Result / Prize Modal Trigger -->
                                    <button type="button" onclick="openResultModal('{{ $b['booking_ref'] }}', '{{ addslashes($b['customer_name']) }}', '{{ addslashes($b['result_status'] ?? 'Active in Live Draw') }}', '{{ addslashes($b['prize_amount'] ?? '') }}')" 
                                        class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-[#DFB755] border border-[#DFB755]/30 font-bold text-xs transition" title="Set Winner / Draw Result">
                                        <i class="fa-solid fa-award"></i>
                                    </button>

                                    @if($b['status'] !== 'Rejected')
                                        <!-- Reject Button -->
                                        <form action="{{ route('admin.bookings.reject', $b['booking_ref']) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                onclick="return confirm('Are you sure you want to reject booking {{ $b['booking_ref'] }}?')"
                                                class="px-2.5 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs font-bold transition" title="Reject Payment">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.bookings.delete', $b['booking_ref']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                            onclick="return confirm('Delete booking {{ $b['booking_ref'] }} completely?')"
                                            class="px-2 py-1.5 rounded-xl bg-white/5 hover:bg-rose-500/20 text-stone-400 hover:text-rose-300 text-xs transition" title="Delete Record">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-12 text-stone-400">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-xl mx-auto mb-3 text-stone-400">
                                    <i class="fa-regular fa-folder-open"></i>
                                </div>
                                <h4 class="text-base font-bold text-white mb-1">No Bookings Found</h4>
                                <p class="text-xs text-stone-400">No ticket booking records match your current filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer Summary -->
        <div class="p-4 bg-[#040A1A]/80 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-stone-400">
            <span>Showing {{ count($bookings) }} of {{ $stats['total'] }} total booking records</span>
            <span class="text-stone-400 font-mono text-[11px]">Maharaja Verification Directorate &bull; Strict Approval Policy</span>
        </div>

    </div>

</div>

<!-- 1. VIEW ALL DETAILS & PAYMENT ATTACHMENT MODAL (Fully Responsive) -->
<div id="details-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-sm hidden overflow-y-auto p-3 sm:p-4 md:p-6 justify-center items-start sm:items-center">
    <div class="bg-[#071533] border border-[#DFB755]/40 rounded-2xl sm:rounded-3xl max-w-2xl w-full shadow-2xl my-auto max-h-[92vh] flex flex-col overflow-hidden animate-in zoom-in-95 duration-150">
        
        <!-- Fixed Modal Header -->
        <div class="flex items-center justify-between border-b border-white/10 p-4 sm:p-5 bg-[#071533] shrink-0">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-cyan-500/15 border border-cyan-500/30 text-cyan-300 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div class="min-w-0">
                    <span class="text-[9px] uppercase tracking-widest text-[#DFB755] font-black block">BOOKING DOSSIER</span>
                    <h3 class="text-sm sm:text-lg font-serif font-black text-white flex items-center gap-2 truncate">
                        <span id="detail-ref" class="truncate">BK...</span>
                        <button type="button" onclick="copyDetailRef()" class="text-stone-400 hover:text-white text-xs shrink-0" title="Copy Reference">
                            <i class="fa-regular fa-copy"></i>
                        </button>
                    </h3>
                    <p class="text-[10px] text-stone-400 font-mono" id="detail-date">-</p>
                </div>
            </div>
            <button type="button" onclick="closeDetailsModal()" class="text-stone-400 hover:text-white text-lg p-1.5 rounded-lg hover:bg-white/10 transition shrink-0">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Scrollable Modal Body -->
        <div class="p-4 sm:p-6 space-y-4 overflow-y-auto flex-1 overscroll-contain">
            
            <!-- 2 Columns Grid: Customer + Payment details -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                
                <!-- Customer Box -->
                <div class="bg-black/40 rounded-xl sm:rounded-2xl p-3.5 sm:p-4 border border-white/10 space-y-2">
                    <span class="text-[10px] font-bold text-[#DFB755] uppercase tracking-wider block">Customer Information</span>
                    <div>
                        <span class="text-[10px] text-stone-400 block">Name</span>
                        <span class="text-xs sm:text-sm font-bold text-white block truncate" id="detail-name">-</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-stone-400 block">Mobile Number</span>
                        <span class="text-xs font-mono font-bold text-[#F3D068] block truncate" id="detail-mobile">-</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-stone-400 block">Location / State</span>
                        <span class="text-xs text-stone-300 block truncate" id="detail-location">-</span>
                    </div>
                </div>

                <!-- Payment & Amount Box -->
                <div class="bg-black/40 rounded-xl sm:rounded-2xl p-3.5 sm:p-4 border border-white/10 space-y-2">
                    <span class="text-[10px] font-bold text-[#DFB755] uppercase tracking-wider block">Payment Verification</span>
                    <div>
                        <span class="text-[10px] text-stone-400 block">Total Amount</span>
                        <span class="text-sm sm:text-base font-serif font-black text-emerald-400 block" id="detail-amount">₹ 0</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-stone-400 block">UPI Transaction ID / UTR</span>
                        <span class="text-xs font-mono font-bold text-cyan-300 select-all bg-white/5 px-2 py-0.5 rounded border border-white/10 inline-block break-all" id="detail-utr">-</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-stone-400 block mb-0.5">Current Status</span>
                        <span id="detail-status-badge">-</span>
                    </div>
                </div>

            </div>

            <!-- Booked Tickets Row -->
            <div class="bg-black/40 rounded-xl sm:rounded-2xl p-3.5 sm:p-4 border border-white/10 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-[#DFB755] uppercase tracking-wider">Booked Lottery Numbers</span>
                    <span class="text-[10px] font-mono text-stone-300" id="detail-ticket-count">0 Tickets</span>
                </div>
                <div class="flex flex-wrap gap-1.5 max-h-28 sm:max-h-36 overflow-y-auto pr-1" id="detail-tickets-container">
                    <!-- Injected via JS -->
                </div>
            </div>

            <!-- Payment Attachment / Screenshot Section -->
            <div class="bg-black/40 rounded-xl sm:rounded-2xl p-3.5 sm:p-4 border border-white/10 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-[#DFB755] uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-regular fa-image"></i> Payment Attachment / Ticket Certificate
                    </span>
                    <span class="text-[10px] text-stone-400" id="detail-attachment-label">Proof verification</span>
                </div>

                <!-- Image View / Fallback Slip -->
                <div id="detail-attachment-preview" class="rounded-xl overflow-hidden bg-[#040A1A] border border-white/15 p-2 sm:p-3 text-center">
                    <!-- Injected via JS -->
                </div>
            </div>

        </div>

        <!-- Fixed Modal Footer Quick Actions -->
        <div class="flex flex-wrap items-center justify-between gap-3 p-3.5 sm:p-4 border-t border-white/10 bg-[#040A1A] shrink-0">
            <span class="text-[10px] text-stone-400 font-mono hidden sm:inline-block">Maharaja Directorate Console</span>
            
            <div class="flex items-center gap-2 w-full sm:w-auto justify-end" id="detail-modal-actions">
                <!-- Injected via JS -->
            </div>
        </div>

    </div>
</div>

<!-- 2. RESULT STATUS & PRIZE MODAL (Fully Responsive) -->
<div id="result-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-sm hidden overflow-y-auto p-3 sm:p-4 md:p-6 justify-center items-start sm:items-center">
    <div class="bg-[#071533] border border-[#DFB755]/40 rounded-2xl sm:rounded-3xl max-w-lg w-full shadow-2xl my-auto max-h-[92vh] flex flex-col overflow-hidden animate-in zoom-in-95 duration-150">
        
        <div class="flex items-center justify-between border-b border-white/10 p-4 sm:p-5 bg-[#071533] shrink-0">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755] flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm sm:text-base font-serif font-black text-white truncate">Set Lottery Draw Result</h3>
                    <p class="text-[10px] text-stone-400 truncate" id="modal-customer-info">Ref: BK...</p>
                </div>
            </div>
            <button type="button" onclick="closeResultModal()" class="text-stone-400 hover:text-white text-lg p-1.5 rounded-lg hover:bg-white/10 transition shrink-0">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="result-form" method="POST" action="" class="flex flex-col flex-1 overflow-hidden">
            @csrf
            <div class="p-4 sm:p-6 space-y-4 overflow-y-auto flex-1">
                <div>
                    <label class="block text-[11px] font-bold text-stone-300 uppercase tracking-wider mb-1.5">
                        Draw / Winning Result Status
                    </label>
                    <select name="result_status" id="modal-result-status" class="w-full bg-[#040A1A] border border-white/20 rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#DFB755]">
                        <option value="Active in Live Draw">Active in Live Draw (Draw Scheduled)</option>
                        <option value="1st Prize Winner">★ 1st Prize Winner ★</option>
                        <option value="2nd Prize Winner">★ 2nd Prize Winner ★</option>
                        <option value="3rd Prize Winner">★ 3rd Prize Winner ★</option>
                        <option value="Consolation Prize Winner">Consolation Prize Winner</option>
                        <option value="Better Luck Next Time">Draw Completed - Better Luck Next Time</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-stone-300 uppercase tracking-wider mb-1.5">
                        Prize Amount / Description (Optional)
                    </label>
                    <input type="text" name="prize_amount" id="modal-prize-amount" placeholder="e.g. INR 50 Lakhs / INR 10 Lakhs" 
                        class="w-full bg-[#040A1A] border border-white/20 rounded-xl px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#DFB755]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-stone-300 uppercase tracking-wider mb-1.5">
                        Admin Verification Notes (Optional)
                    </label>
                    <textarea name="admin_notes" id="modal-admin-notes" rows="2" placeholder="Official remarks from verification desk" 
                        class="w-full bg-[#040A1A] border border-white/20 rounded-xl px-3.5 py-2 text-xs text-white focus:outline-none focus:border-[#DFB755]"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 p-3.5 sm:p-4 border-t border-white/10 bg-[#040A1A] shrink-0">
                <button type="button" onclick="closeResultModal()" class="px-4 py-2 rounded-xl bg-white/10 text-stone-300 font-bold text-xs hover:bg-white/15 transition">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] font-black text-xs hover:scale-105 transition shadow-md">
                    Update Result Status
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 3. ZOOM IMAGE PREVIEW MODAL (Responsive) -->
<div id="image-zoom-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-3 sm:p-6 cursor-pointer" onclick="closeZoomModal()">
    <div class="max-w-4xl max-h-[92vh] w-full flex flex-col items-center justify-center">
        <img id="zoomed-image" src="" alt="Payment Receipt" class="max-w-full max-h-[82vh] rounded-2xl object-contain shadow-2xl border border-white/20">
        <p class="text-center text-xs text-stone-300 mt-3 font-medium bg-black/60 px-3 py-1 rounded-full border border-white/10">Click anywhere to close full preview</p>
    </div>
</div>

@push('scripts')
<script>
    // Multi-select and bulk actions logic
    function getSelectedCheckboxes() {
        return Array.from(document.querySelectorAll('.booking-row-checkbox:checked'));
    }

    function toggleSelectAll(master) {
        const checkboxes = document.querySelectorAll('.booking-row-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = master.checked;
        });
        updateBulkToolbar();
    }

    function deselectAllBookings() {
        const master = document.getElementById('select-all-bookings');
        if (master) master.checked = false;
        const checkboxes = document.querySelectorAll('.booking-row-checkbox');
        checkboxes.forEach(cb => cb.checked = false);
        updateBulkToolbar();
    }

    function updateBulkToolbar() {
        const selected = getSelectedCheckboxes();
        const bar = document.getElementById('bulk-action-bar');
        const countSpan = document.getElementById('selected-count');
        const master = document.getElementById('select-all-bookings');
        const allCheckboxes = document.querySelectorAll('.booking-row-checkbox');

        if (countSpan) countSpan.textContent = selected.length;

        if (master && allCheckboxes.length > 0) {
            master.checked = selected.length === allCheckboxes.length;
        }

        if (selected.length > 0) {
            bar.classList.remove('hidden');
            bar.classList.add('flex');
        } else {
            bar.classList.add('hidden');
            bar.classList.remove('flex');
        }
    }

    function submitBulkDelete() {
        const selected = getSelectedCheckboxes();
        if (selected.length === 0) {
            alert('Please select at least one booking to delete.');
            return;
        }

        if (!confirm('Are you sure you want to permanently delete ' + selected.length + ' selected booking(s)?')) {
            return;
        }

        const refs = selected.map(cb => cb.value);
        document.getElementById('bulk-delete-refs').value = refs.join(',');
        document.getElementById('bulk-delete-form').submit();
    }

    function submitBulkApprove() {
        const selected = getSelectedCheckboxes();
        if (selected.length === 0) {
            alert('Please select at least one booking to approve.');
            return;
        }

        if (!confirm('Confirm payment received and approve ' + selected.length + ' selected booking(s)?')) {
            return;
        }

        const refs = selected.map(cb => cb.value);
        document.getElementById('bulk-approve-refs').value = refs.join(',');
        document.getElementById('bulk-approve-form').submit();
    }

    // View Details Modal Logic
    let currentModalRef = '';

    function openDetailsModal(booking) {
        currentModalRef = booking.booking_ref;
        document.getElementById('detail-ref').innerText = booking.booking_ref;
        document.getElementById('detail-date').innerText = "Booked on: " + (booking.booked_at || "N/A");
        document.getElementById('detail-name').innerText = booking.customer_name || "Customer";
        document.getElementById('detail-mobile').innerText = booking.customer_mobile || "N/A";
        
        const loc = (booking.customer_city ? booking.customer_city + ', ' : '') + (booking.customer_state || 'India');
        document.getElementById('detail-location').innerText = loc;
        document.getElementById('detail-amount').innerText = "₹ " + Number(booking.total_amount || 0).toLocaleString();
        document.getElementById('detail-utr').innerText = booking.utr_number || "Direct (Pending UTR)";
        document.getElementById('detail-ticket-count').innerText = (booking.ticket_count || booking.tickets.length) + " Tickets";

        // Render tickets
        const container = document.getElementById('detail-tickets-container');
        container.innerHTML = '';
        if (booking.tickets && booking.tickets.length > 0) {
            booking.tickets.forEach(t => {
                const pill = document.createElement('span');
                pill.className = "px-2.5 py-1 rounded-lg bg-[#040A1A] border border-white/20 text-white font-mono font-bold text-xs select-all flex items-center gap-1";
                pill.innerHTML = '<i class="fa-solid fa-ticket text-[#DFB755] text-[10px]"></i> ' + t;
                container.appendChild(pill);
            });
        } else {
            container.innerHTML = '<span class="text-stone-400 text-xs italic">No tickets listed</span>';
        }

        // Status badge
        const badgeSpan = document.getElementById('detail-status-badge');
        if (booking.status === 'Approved') {
            badgeSpan.innerHTML = '<span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30"><i class="fa-solid fa-check mr-1"></i> Payment Received (Approved)</span>';
        } else if (booking.status === 'Rejected') {
            badgeSpan.innerHTML = '<span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30"><i class="fa-solid fa-ban mr-1"></i> Rejected</span>';
        } else {
            badgeSpan.innerHTML = '<span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30"><i class="fa-solid fa-clock mr-1"></i> Pending Approval</span>';
        }

        // Payment Attachment / Screenshot preview
        // Payment Attachment / Screenshot & Certificate Preview
        const attachmentPreview = document.getElementById('detail-attachment-preview');
        const attachmentLabel = document.getElementById('detail-attachment-label');

        if (booking.receipt_image && booking.receipt_image.trim() !== '' && !booking.receipt_image.includes('ticket_')) {
            attachmentLabel.innerText = "Uploaded Screenshot & Payment Slip";
            const imgUrl = "{{ asset('') }}" + booking.receipt_image.replace(/^\/+/, '');
            attachmentPreview.innerHTML = `
                <div class="space-y-2">
                    <div class="relative group cursor-pointer" onclick="zoomImage('${imgUrl}')">
                        <img src="${imgUrl}" alt="Receipt Screenshot" class="max-h-64 mx-auto rounded-xl object-contain border border-white/20 shadow-lg group-hover:opacity-90 transition">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-xl flex items-center justify-center text-white text-xs font-bold gap-1.5">
                            <i class="fa-solid fa-magnifying-glass-plus"></i> Click to Zoom Fullscreen
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 pt-1">
                        <a href="${imgUrl}" download="Receipt_${booking.booking_ref}.png" class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-stone-300 text-xs font-bold transition flex items-center gap-1">
                            <i class="fa-solid fa-download text-[10px]"></i> Download Receipt
                        </a>
                        <button type="button" onclick="renderDynamicCertificate(currentBookingData)" class="px-3 py-1 rounded-lg bg-cyan-600/30 hover:bg-cyan-600/50 text-cyan-200 border border-cyan-500/40 text-xs font-bold transition flex items-center gap-1">
                            <i class="fa-solid fa-ticket text-[10px]"></i> View Generated Ticket Certificate
                        </button>
                    </div>
                </div>
            `;
        } else {
            attachmentLabel.innerText = "Official Maharaja Ticket Certificate";
            attachmentPreview.innerHTML = `
                <div class="flex items-center justify-center p-6 text-stone-400 text-xs">
                    <i class="fa-solid fa-spinner fa-spin text-lg mr-2 text-[#DFB755]"></i> Rendering High-Resolution Ticket Image...
                </div>
            `;
            renderDynamicCertificate(booking);
        }

        // Action Buttons inside Modal
        const actionsContainer = document.getElementById('detail-modal-actions');
        let actionsHtml = `<button type="button" onclick="closeDetailsModal()" class="px-3.5 py-2 rounded-xl bg-white/10 text-stone-300 font-bold text-xs hover:bg-white/15 transition">Close</button>`;

        if (booking.status !== 'Approved') {
            actionsHtml += `
                <form action="{{ url('/admin/bookings') }}/${booking.booking_ref}/approve" method="POST" class="inline">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" onclick="return confirm('Confirm payment and approve booking?')" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-check"></i> Approve Payment
                    </button>
                </form>
            `;
        }

        actionsContainer.innerHTML = actionsHtml;

        const modal = document.getElementById('details-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    let currentBookingData = null;

    // High-Resolution 100% Proportional Canvas Generator for Admin View
    function renderDynamicCertificate(booking) {
        currentBookingData = booking;
        const canvas = document.getElementById('admin-ticket-render-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const W = 1024;
        const H = 682;

        const baseImg = new Image();
        baseImg.crossOrigin = 'anonymous';
        baseImg.src = '{{ asset("img/ticket_template_clean.jpg") }}?v=' + Date.now();

        baseImg.onload = function() {
            ctx.clearRect(0, 0, W, H);
            ctx.drawImage(baseImg, 0, 0, W, H);

            const rightCenterX = 830; // Center of right ticket card

            // 1. CUSTOMER NAME
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText('CUSTOMER NAME', rightCenterX, 86);

            ctx.fillStyle = '#071533';
            ctx.font = '900 22px "Times New Roman", Georgia, serif';
            ctx.fillText((booking.customer_name || 'CUSTOMER').toUpperCase(), rightCenterX, 112);

            // 2. BOOKING NUMBER (Big & Bold)
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.fillText('BOOKING NUMBER', rightCenterX, 138);

            ctx.fillStyle = '#0B193E';
            ctx.font = '900 17px monospace';
            ctx.fillText(booking.booking_ref || 'BK2026', rightCenterX, 160);

            // 3. TICKET NUMBER
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.fillText('TICKET NUMBER', rightCenterX, 188);

            const tickets = (booking.tickets && booking.tickets.length > 0) ? booking.tickets : ['MH100001'];
            ctx.fillStyle = '#071533';
            
            let dateTopY = 285;
            
            if (tickets.length === 1) {
                ctx.font = '900 26px monospace';
                ctx.fillText(tickets[0], rightCenterX, 222);
                dateTopY = 270;
            } else if (tickets.length === 2) {
                ctx.font = '900 21px monospace';
                ctx.fillText(tickets[0], rightCenterX, 216);
                ctx.fillText(tickets[1], rightCenterX, 240);
                dateTopY = 282;
            } else if (tickets.length === 3) {
                ctx.font = '900 18px monospace';
                ctx.fillText(tickets[0], rightCenterX, 212);
                ctx.fillText(tickets[1], rightCenterX, 234);
                ctx.fillText(tickets[2], rightCenterX, 256);
                dateTopY = 292;
            } else if (tickets.length <= 5) {
                ctx.font = '900 15px monospace';
                let tY = 210;
                tickets.forEach(ticket => {
                    ctx.fillText(ticket, rightCenterX, tY);
                    tY += 17;
                });
                dateTopY = Math.max(298, tY + 6);
            } else {
                // > 5 tickets: 2 columns
                ctx.font = '900 13px monospace';
                const mid = Math.ceil(tickets.length / 2);
                let tY1 = 208;
                for (let i = 0; i < mid; i++) {
                    ctx.fillText(tickets[i], rightCenterX - 55, tY1);
                    tY1 += 15;
                }
                let tY2 = 208;
                for (let i = mid; i < tickets.length; i++) {
                    ctx.fillText(tickets[i], rightCenterX + 55, tY2);
                    tY2 += 15;
                }
                dateTopY = Math.max(290, Math.max(tY1, tY2) + 6);
            }

            // 4. DATE Box
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.fillText('DATE', rightCenterX, dateTopY);

            ctx.fillStyle = '#FFF5F6';
            ctx.beginPath();
            ctx.roundRect(710, dateTopY + 6, 240, 36, 10);
            ctx.fill();
            ctx.lineWidth = 2.5;
            ctx.strokeStyle = '#BE123C';
            ctx.stroke();

            ctx.fillStyle = '#BE123C';
            ctx.font = '900 18px monospace';
            const dateStr = booking.booked_at ? new Date(booking.booked_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).replace(/ /g, '/') : '{{ date("d/M/Y") }}';
            ctx.fillText(dateStr, rightCenterX, dateTopY + 30);

            // 5. TODAY LIVE Badge
            const liveTopY = dateTopY + 52;
            ctx.fillStyle = '#ECFDF5';
            ctx.beginPath();
            ctx.roundRect(710, liveTopY, 240, 52, 12);
            ctx.fill();
            ctx.lineWidth = 3;
            ctx.strokeStyle = '#059669';
            ctx.stroke();

            ctx.fillStyle = '#047857';
            ctx.font = '900 23px sans-serif';
            ctx.fillText('★ TODAY LIVE ★', rightCenterX, liveTopY + 34);

            // Output data URL to preview image
            const imgData = canvas.toDataURL('image/png');
            const attachmentPreview = document.getElementById('detail-attachment-preview');
            attachmentPreview.innerHTML = `
                <div class="space-y-2.5">
                    <div class="relative group cursor-pointer" onclick="zoomImage('${imgData}')">
                        <img src="${imgData}" alt="Ticket Certificate" class="max-h-64 mx-auto rounded-xl object-contain border border-[#DFB755]/30 shadow-2xl group-hover:scale-[1.01] transition">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-xl flex items-center justify-center text-white text-xs font-bold gap-1.5">
                            <i class="fa-solid fa-magnifying-glass-plus"></i> Click to Zoom Fullscreen
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 pt-1">
                        <button type="button" onclick="zoomImage('${imgData}')" class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/15 text-stone-300 text-xs font-bold transition flex items-center gap-1.5">
                            <i class="fa-solid fa-expand text-[10px]"></i> Zoom Fullscreen
                        </button>
                        <a href="${imgData}" download="Maharaja_Ticket_${booking.booking_ref}.png" class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-[#C59B27] to-[#F3D068] text-[#071533] font-black text-xs transition flex items-center gap-1.5 shadow-md">
                            <i class="fa-solid fa-download text-[10px]"></i> Download Certificate (PNG)
                        </a>
                    </div>
                </div>
            `;
        };

        if (baseImg.complete) {
            baseImg.onload();
        }
    }

    function closeDetailsModal() {
        const modal = document.getElementById('details-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function copyDetailRef() {
        if (currentModalRef) {
            navigator.clipboard.writeText(currentModalRef);
            alert('Copied Booking Reference: ' + currentModalRef);
        }
    }

    // Zoom Image Logic
    function zoomImage(url) {
        const modal = document.getElementById('image-zoom-modal');
        document.getElementById('zoomed-image').src = url;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeZoomModal() {
        const modal = document.getElementById('image-zoom-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Result Modal Logic
    function openResultModal(ref, customerName, currentStatus, currentPrize) {
        const modal = document.getElementById('result-modal');
        const form = document.getElementById('result-form');
        const customerInfo = document.getElementById('modal-customer-info');
        const statusSelect = document.getElementById('modal-result-status');
        const prizeInput = document.getElementById('modal-prize-amount');

        form.action = "{{ url('/admin/bookings') }}/" + ref + "/update-result";
        customerInfo.innerText = "Ref: " + ref + " (" + customerName + ")";
        statusSelect.value = currentStatus || "Active in Live Draw";
        prizeInput.value = currentPrize || "";

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeResultModal() {
        const modal = document.getElementById('result-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
<canvas id="admin-ticket-render-canvas" width="1024" height="682" class="hidden"></canvas>
@endpush
@endsection
