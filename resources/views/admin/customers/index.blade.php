@extends('admin.layouts.app')

@section('title', 'Registered Customers (Unique by Email)')
@section('page_title', 'Customer Directory')

@section('content')
<div class="space-y-6 sm:space-y-8">

    <!-- Workspace Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[11px] font-black uppercase tracking-widest text-[#DFB755] block mb-0.5">
                CUSTOMER DIRECTORY &bull; UNIQUE CONTACTS
            </span>
            <h1 class="text-2xl sm:text-3xl font-serif font-black text-white tracking-tight">
                Customer Contacts &amp; History
            </h1>
            <p class="text-xs text-stone-400 mt-1">
                Dynamic customer database uniquely aggregated by email address with real-time order history, ticket counts, and total spend.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="px-3.5 py-1.5 rounded-xl bg-gradient-to-br from-[#0B193E] to-[#040A1A] text-[#F3D068] border border-[#DFB755]/40 text-xs font-black shadow-md flex items-center gap-2">
                <i class="fa-solid fa-users text-[#DFB755]"></i>
                <span>{{ $stats['total_customers'] }} Unique Customers</span>
            </span>
        </div>
    </div>

    <!-- 4 Stats Cards Row -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <!-- Total Unique Customers -->
        <div class="bg-[#071533]/90 rounded-2xl p-4 sm:p-5 border border-[#DFB755]/25 shadow-xl flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 text-[#DFB755] border border-[#DFB755]/30 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="min-w-0">
                <span class="block text-[10px] uppercase font-bold text-stone-400 tracking-wider">Unique Customers</span>
                <span class="text-xl sm:text-2xl font-black font-serif text-white">{{ number_format($stats['total_customers']) }}</span>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-[#071533]/90 rounded-2xl p-4 sm:p-5 border border-[#DFB755]/25 shadow-xl flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-blue-500/15 text-blue-400 border border-blue-500/30 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div class="min-w-0">
                <span class="block text-[10px] uppercase font-bold text-stone-400 tracking-wider">Total Bookings</span>
                <span class="text-xl sm:text-2xl font-black font-serif text-white">{{ number_format($stats['total_bookings']) }}</span>
            </div>
        </div>

        <!-- Total Tickets Purchased -->
        <div class="bg-[#071533]/90 rounded-2xl p-4 sm:p-5 border border-[#DFB755]/25 shadow-xl flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-ticket"></i>
            </div>
            <div class="min-w-0">
                <span class="block text-[10px] uppercase font-bold text-stone-400 tracking-wider">Tickets Issued</span>
                <span class="text-xl sm:text-2xl font-black font-serif text-white">{{ number_format($stats['total_tickets']) }}</span>
            </div>
        </div>

        <!-- Total Customer Spend -->
        <div class="bg-[#071533]/90 rounded-2xl p-4 sm:p-5 border border-[#DFB755]/25 shadow-xl flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#C59B27] to-[#F3D068] text-[#071533] flex items-center justify-center text-lg font-black shrink-0">
                ₹
            </div>
            <div class="min-w-0">
                <span class="block text-[10px] uppercase font-bold text-stone-400 tracking-wider">Total Revenue</span>
                <span class="text-xl sm:text-2xl font-black font-serif text-[#F3D068]">₹{{ number_format($stats['total_spent']) }}</span>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-[#071533]/90 rounded-3xl border border-[#DFB755]/25 shadow-2xl overflow-hidden">
        
        <!-- Search Header Bar -->
        <div class="p-5 sm:p-6 pb-4 border-b border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <div class="flex items-center gap-2">
                <span class="text-sm font-bold text-white">Unique Customer Directory</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-[#DFB755]/15 text-[#F3D068] border border-[#DFB755]/30">
                    {{ count($customers) }} Records
                </span>
            </div>

            <!-- Search Form -->
            <form action="{{ route('admin.customers.index') }}" method="GET" class="flex items-center gap-2">
                <div class="relative w-full sm:w-72">
                    <input type="text" name="q" value="{{ $search }}" placeholder="Search Name, Email, Phone..." 
                        class="w-full bg-[#040A1A] border border-white/20 rounded-xl px-3.5 py-2 pl-9 text-xs text-white placeholder-stone-400 focus:outline-none focus:border-[#DFB755]">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-stone-400 text-xs"></i>
                </div>
                <button type="submit" class="px-3.5 py-2 bg-[#DFB755] text-[#071533] font-bold text-xs rounded-xl hover:bg-[#F3D068] transition">
                    Search
                </button>
                @if(!empty($search))
                    <a href="{{ route('admin.customers.index') }}" class="px-2.5 py-2 bg-white/10 hover:bg-white/15 text-stone-300 text-xs rounded-xl transition" title="Clear Search">
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
                        <th scope="col" class="py-4 px-4">#</th>
                        <th scope="col" class="py-4 px-4">CUSTOMER NAME</th>
                        <th scope="col" class="py-4 px-4">UNIQUE EMAIL</th>
                        <th scope="col" class="py-4 px-4">MOBILE / LOCATION</th>
                        <th scope="col" class="py-4 px-4 text-center">BOOKINGS</th>
                        <th scope="col" class="py-4 px-4 text-center">TICKETS</th>
                        <th scope="col" class="py-4 px-4">TOTAL SPENT</th>
                        <th scope="col" class="py-4 px-4">LAST ACTIVITY</th>
                        <th scope="col" class="py-4 px-4 text-right pr-6">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 font-sans">
                    @forelse($customers as $idx => $c)
                        <tr class="hover:bg-white/[0.04] transition duration-150 group">
                            
                            <!-- Index -->
                            <td class="py-4 px-4 align-top text-stone-500 font-mono text-xs">
                                {{ $idx + 1 }}
                            </td>

                            <!-- Customer Name -->
                            <td class="py-4 px-4 align-top">
                                <div class="font-bold text-white text-xs flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-[#0B193E] border border-[#DFB755]/30 text-[#F3D068] font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ strtoupper(substr($c['customer_name'], 0, 1)) }}
                                    </div>
                                    <span class="truncate max-w-[160px]">{{ $c['customer_name'] }}</span>
                                </div>
                            </td>

                            <!-- Unique Email -->
                            <td class="py-4 px-4 align-top">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#040A1A] border border-[#DFB755]/30 text-white font-mono text-xs select-all">
                                    <i class="fa-regular fa-envelope text-[#DFB755] text-[10px]"></i>
                                    <span>{{ $c['customer_email'] }}</span>
                                </div>
                            </td>

                            <!-- Mobile & Location -->
                            <td class="py-4 px-4 align-top">
                                @if($c['customer_mobile'] !== 'N/A')
                                    <div class="text-[11px] font-mono text-[#F3D068] flex items-center gap-1">
                                        <i class="fa-solid fa-phone text-[10px]"></i>
                                        <a href="tel:{{ $c['customer_mobile'] }}" class="hover:underline">{{ $c['customer_mobile'] }}</a>
                                    </div>
                                @else
                                    <span class="text-stone-500 italic text-xs">N/A</span>
                                @endif

                                @if(!empty($c['customer_state']))
                                    <span class="block text-[10px] text-stone-400 mt-0.5">
                                        {{ $c['customer_city'] ? $c['customer_city'] . ', ' : '' }}{{ $c['customer_state'] }}
                                    </span>
                                @endif
                            </td>

                            <!-- Total Bookings -->
                            <td class="py-4 px-4 align-top text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-bold bg-blue-500/15 text-blue-300 border border-blue-500/30 font-mono">
                                    {{ $c['total_bookings'] }} Order{{ $c['total_bookings'] === 1 ? '' : 's' }}
                                </span>
                                @if($c['approved_bookings'] > 0)
                                    <span class="block text-[9px] text-emerald-400 font-medium mt-0.5">{{ $c['approved_bookings'] }} Approved</span>
                                @endif
                            </td>

                            <!-- Total Tickets -->
                            <td class="py-4 px-4 align-top text-center">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg bg-[#DFB755]/15 text-[#F3D068] border border-[#DFB755]/30 font-mono font-bold text-xs">
                                    <i class="fa-solid fa-ticket text-[10px]"></i>
                                    {{ $c['total_tickets'] }}
                                </span>
                            </td>

                            <!-- Total Spent -->
                            <td class="py-4 px-4 align-top whitespace-nowrap">
                                <span class="font-mono font-black text-white text-sm">
                                    ₹{{ number_format($c['total_spent']) }}
                                </span>
                            </td>

                            <!-- Last Activity -->
                            <td class="py-4 px-4 align-top whitespace-nowrap">
                                <span class="text-[11px] font-mono text-stone-300 block">
                                    {{ date('d M Y', strtotime($c['last_booked_at'])) }}
                                </span>
                                <span class="text-[9px] text-stone-500 font-mono block">
                                    {{ date('h:i A', strtotime($c['last_booked_at'])) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-4 align-top text-right pr-6 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    
                                    <!-- View Details Modal Trigger -->
                                    <button type="button" onclick="openCustomerModal({{ json_encode($c) }})" 
                                        class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/15 text-cyan-300 hover:text-cyan-200 border border-cyan-500/30 text-xs font-bold transition flex items-center gap-1" title="View Full Customer History">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                        <span>History</span>
                                    </button>

                                    @if($c['customer_mobile'] !== 'N/A')
                                        <!-- WhatsApp Quick Chat Button -->
                                        <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $c['customer_mobile']) }}?text={{ urlencode('Hello ' . $c['customer_name'] . ', this is Maharaja Lottery Support desk.') }}" 
                                            target="_blank"
                                            class="px-2.5 py-1.5 rounded-xl bg-emerald-600/20 hover:bg-emerald-600/40 text-emerald-300 border border-emerald-500/30 text-xs font-bold transition flex items-center gap-1" title="Chat on WhatsApp">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    @endif

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-12 text-stone-400">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center text-xl mx-auto mb-3 text-stone-400">
                                    <i class="fa-regular fa-folder-open"></i>
                                </div>
                                <h4 class="text-base font-bold text-white mb-1">No Customers Found</h4>
                                <p class="text-xs text-stone-400">No customer records match your current search query.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- CUSTOMER DETAIL HISTORY MODAL -->
<div id="customer-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-sm hidden overflow-y-auto no-scrollbar p-3 sm:p-4 md:p-6 justify-center items-start sm:items-center">
    <div class="bg-[#071533] border border-[#DFB755]/40 rounded-2xl sm:rounded-3xl max-w-2xl w-full shadow-2xl my-auto max-h-[92vh] flex flex-col overflow-hidden animate-in zoom-in-95 duration-150">
        
        <!-- Modal Top Bar -->
        <div class="flex items-center justify-between border-b border-white/10 p-4 sm:p-5 bg-[#071533] shrink-0">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755] flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm sm:text-base font-serif font-black text-white truncate" id="modal-cust-name">Customer Profile</h3>
                    <p class="text-[11px] font-mono text-[#F3D068] truncate" id="modal-cust-email">email@example.com</p>
                </div>
            </div>
            <button type="button" onclick="closeCustomerModal()" class="text-stone-400 hover:text-white text-lg p-1.5 rounded-lg hover:bg-white/10 transition shrink-0">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-4 sm:p-6 space-y-5 overflow-y-auto no-scrollbar flex-1">
            
            <!-- Quick Stats 3-box -->
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-black/40 rounded-xl p-3 border border-white/10">
                    <span class="block text-[9px] uppercase font-bold text-stone-400">Total Bookings</span>
                    <span class="text-base font-bold font-mono text-white" id="modal-cust-bookings-count">0</span>
                </div>
                <div class="bg-black/40 rounded-xl p-3 border border-white/10">
                    <span class="block text-[9px] uppercase font-bold text-stone-400">Total Tickets</span>
                    <span class="text-base font-bold font-mono text-[#F3D068]" id="modal-cust-tickets-count">0</span>
                </div>
                <div class="bg-black/40 rounded-xl p-3 border border-white/10">
                    <span class="block text-[9px] uppercase font-bold text-stone-400">Total Spend</span>
                    <span class="text-base font-bold font-mono text-emerald-400" id="modal-cust-spend">₹0</span>
                </div>
            </div>

            <!-- Customer Details Grid -->
            <div class="bg-black/30 rounded-2xl p-4 border border-white/10 space-y-2 text-xs">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755] block mb-1">CONTACT PROFILE</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <span class="text-stone-400 block text-[10px]">Mobile Phone</span>
                        <span class="font-mono font-bold text-white" id="modal-cust-mobile">-</span>
                    </div>
                    <div>
                        <span class="text-stone-400 block text-[10px]">Location</span>
                        <span class="text-stone-200" id="modal-cust-location">-</span>
                    </div>
                </div>
            </div>

            <!-- All Purchased Tickets Pill Box -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755]">ALL PURCHASED TICKETS</span>
                    <span class="text-[10px] text-stone-400 font-mono" id="modal-cust-tickets-total-label">0 tickets</span>
                </div>
                <div class="bg-black/40 rounded-2xl p-3 border border-white/10 flex flex-wrap gap-1.5 max-h-32 overflow-y-auto" id="modal-cust-tickets-container">
                    <!-- Injected via JS -->
                </div>
            </div>

            <!-- Booking Orders History List -->
            <div class="space-y-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755] block">BOOKING ORDERS HISTORY</span>
                <div class="space-y-2 max-h-48 overflow-y-auto pr-1" id="modal-cust-orders-container">
                    <!-- Injected via JS -->
                </div>
            </div>

        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-end gap-3 p-3.5 sm:p-4 border-t border-white/10 bg-[#040A1A] shrink-0">
            <button type="button" onclick="closeCustomerModal()" class="px-4 py-2 rounded-xl bg-white/10 text-stone-300 font-bold text-xs hover:bg-white/15 transition">
                Close
            </button>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function openCustomerModal(customer) {
        document.getElementById('modal-cust-name').textContent = customer.customer_name;
        document.getElementById('modal-cust-email').textContent = customer.customer_email;
        document.getElementById('modal-cust-mobile').textContent = customer.customer_mobile;
        document.getElementById('modal-cust-location').textContent = (customer.customer_city ? customer.customer_city + ', ' : '') + (customer.customer_state || 'N/A');
        document.getElementById('modal-cust-bookings-count').textContent = customer.total_bookings;
        document.getElementById('modal-cust-tickets-count').textContent = customer.total_tickets;
        document.getElementById('modal-cust-spend').textContent = '₹' + Number(customer.total_spent || 0).toLocaleString('en-IN');
        document.getElementById('modal-cust-tickets-total-label').textContent = (customer.all_tickets ? customer.all_tickets.length : 0) + ' unique numbers';

        // Render all ticket badges
        const ticketsContainer = document.getElementById('modal-cust-tickets-container');
        if (customer.all_tickets && customer.all_tickets.length > 0) {
            ticketsContainer.innerHTML = customer.all_tickets.map(t => `
                <span class="px-2 py-0.5 rounded-lg bg-white/10 border border-[#DFB755]/30 text-white font-mono font-bold text-xs select-all">
                    <i class="fa-solid fa-ticket text-[9px] text-[#DFB755] mr-1"></i>${t}
                </span>
            `).join('');
        } else {
            ticketsContainer.innerHTML = '<span class="text-stone-500 text-xs italic">No ticket numbers recorded</span>';
        }

        // Render orders history
        const ordersContainer = document.getElementById('modal-cust-orders-container');
        if (customer.bookings && customer.bookings.length > 0) {
            ordersContainer.innerHTML = customer.bookings.map(b => `
                <div class="bg-black/30 rounded-xl p-3 border border-white/10 flex items-center justify-between gap-3 text-xs">
                    <div>
                        <span class="font-mono font-bold text-[#F3D068] select-all block">${b.booking_ref}</span>
                        <span class="text-[10px] text-stone-400 font-mono">${b.booked_at ? new Date(b.booked_at).toLocaleDateString('en-GB') : ''} &bull; ${(b.tickets || []).length} tickets</span>
                    </div>
                    <div class="text-right">
                        <span class="font-mono font-bold text-white block">₹${Number(b.amount || 0).toLocaleString('en-IN')}</span>
                        <span class="text-[10px] font-bold ${b.status === 'Approved' ? 'text-emerald-400' : 'text-amber-400'}">${b.status || 'Pending'}</span>
                    </div>
                </div>
            `).join('');
        } else {
            ordersContainer.innerHTML = '<span class="text-stone-500 text-xs italic">No previous orders</span>';
        }

        const modal = document.getElementById('customer-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeCustomerModal() {
        const modal = document.getElementById('customer-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush
@endsection
