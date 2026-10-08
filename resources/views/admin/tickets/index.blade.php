@extends('admin.layouts.app')

@section('title', 'Ticket Price Chart & Categories')
@section('page_title', 'Ticket Management')

@section('content')
<div class="space-y-8">

    <!-- Section 1: Ticket Category Creation & Edit Form -->
    <div id="form-container" class="bg-[#071533]/90 rounded-3xl border border-[#DFB755]/25 shadow-2xl p-6 sm:p-8 space-y-6 relative overflow-hidden">
        <!-- Background decorative ambient blur -->
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] text-[10px] font-bold uppercase tracking-wider mb-1">
                    <i class="fa-solid fa-crown text-[10px]"></i>
                    <span>Dynamic Category Engine</span>
                </div>
                <h2 id="form-title" class="text-xl sm:text-2xl font-serif font-black text-white tracking-tight">
                    Ticket Price Chart
                </h2>
                <p class="text-xs text-stone-400 mt-0.5">
                    Create &amp; customize ticket schemes (e.g. Maharaja 500 @ Rs.40 [MH784563], Rajshree 200 @ Rs.149 [RM352164], Rajshree 50 @ Rs.249 [VM754238]).
                </p>
            </div>
            <button type="button" onclick="resetForm()" class="text-xs text-stone-400 hover:text-[#DFB755] flex items-center gap-1.5 transition self-start sm:self-auto font-semibold">
                <i class="fa-solid fa-rotate-left text-[11px]"></i>
                <span>Reset Form</span>
            </button>
        </div>

        <form action="{{ route('admin.tickets.store') }}" method="POST" id="ticket-chart-form" class="space-y-6">
            @csrf
            <input type="hidden" id="chart_id" name="id" value="">

            <!-- Top Fields Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                
                <!-- Price -->
                <div class="space-y-1.5">
                    <label for="price" class="block text-xs font-bold text-stone-300">Price <span class="text-rose-400">*</span></label>
                    <input type="text" id="price" name="price" required placeholder="Price e.g. Rs. 40 or Rs. 149"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-white placeholder-stone-500 font-mono transition outline-none">
                </div>

                <!-- Draw Name -->
                <div class="space-y-1.5">
                    <label for="draw_name" class="block text-xs font-bold text-stone-300">Draw / Category Name <span class="text-rose-400">*</span></label>
                    <input type="text" id="draw_name" name="draw_name" required placeholder="Draw name e.g. Maharaja 500, Rajshree 200"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-white placeholder-stone-500 transition outline-none">
                </div>

                <!-- Series Prefixes -->
                <div class="space-y-1.5">
                    <label for="series_prefixes" class="block text-xs font-bold text-stone-300">Series Prefixes (e.g. MH, RM, VM)</label>
                    <input type="text" id="series_prefixes" name="series_prefixes" placeholder="e.g. MH, RM, VM or MA,MB,MC"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-white placeholder-stone-500 font-mono transition outline-none">
                </div>

                <!-- Ticket Code / Sample Pattern -->
                <div class="space-y-1.5">
                    <label for="ticket_code" class="block text-xs font-bold text-stone-300">Sample Ticket Code (e.g. MH784563)</label>
                    <input type="text" id="ticket_code" name="ticket_code" placeholder="e.g. MH784563, RM352164, VM754238"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-[#F3D068] placeholder-stone-500 font-mono font-bold transition outline-none">
                </div>

                <!-- Start Number -->
                <div class="space-y-1.5">
                    <label for="start_number" class="block text-xs font-bold text-stone-300">Start Number</label>
                    <input type="text" id="start_number" name="start_number" placeholder="Start number e.g. 100000" value="100000"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-white placeholder-stone-500 font-mono transition outline-none">
                </div>

                <!-- End Number -->
                <div class="space-y-1.5">
                    <label for="end_number" class="block text-xs font-bold text-stone-300">End Number</label>
                    <input type="text" id="end_number" name="end_number" placeholder="End number e.g. 999999" value="999999"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-white placeholder-stone-500 font-mono transition outline-none">
                </div>

                <!-- Display Limit -->
                <div class="space-y-1.5">
                    <label for="display_limit" class="block text-xs font-bold text-stone-300">Display Limit</label>
                    <input type="text" id="display_limit" name="display_limit" placeholder="Display Limit e.g. 50" value="50"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-white placeholder-stone-500 font-mono transition outline-none">
                </div>

                <!-- Position / Order -->
                <div class="space-y-1.5">
                    <label for="position" class="block text-xs font-bold text-stone-300">Position e.g. LB 1</label>
                    <input type="text" id="position" name="position" placeholder="Position e.g. LB 1" value="LB 1"
                        class="w-full bg-[#040A1A] border border-white/15 focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] rounded-xl px-4 py-2.5 text-xs text-white placeholder-stone-500 font-mono transition outline-none">
                </div>

            </div>

            <!-- Prize Breakdown Module -->
            <div class="border-t border-white/10 pt-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h3 class="text-base font-serif font-bold text-emerald-400 flex items-center gap-2">
                            <i class="fa-solid fa-trophy text-sm text-[#DFB755]"></i>
                            <span>Prize Breakdown</span>
                        </h3>
                        <p class="text-xs text-stone-400 mt-0.5">
                            Prize amount, winner count and remove control are available in the same row.
                        </p>
                    </div>

                    <button type="button" onclick="addPrizeRow()" 
                        class="bg-emerald-600 hover:bg-emerald-500 text-white px-3.5 py-1.5 rounded-xl font-bold text-xs shadow-md border border-emerald-400/30 flex items-center gap-1.5 transition self-start sm:self-auto">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Add More</span>
                    </button>
                </div>

                <!-- Prize Rows List Container -->
                <div id="prize-rows-container" class="space-y-3">
                    
                    <!-- Row 1 (1st Prize) -->
                    <div class="prize-row grid grid-cols-12 gap-2 sm:gap-3 items-center bg-[#040A1A]/80 p-2.5 rounded-2xl border border-white/10">
                        <div class="col-span-3 sm:col-span-2">
                            <span class="prize-badge w-full py-2 rounded-xl bg-[#0B193E] text-[#F3D068] font-bold text-xs border border-[#DFB755]/30 flex items-center justify-center text-center">
                                1st Prize
                            </span>
                        </div>
                        <div class="col-span-5 sm:col-span-5">
                            <input type="text" name="prize_amount[]" value="INR 50 Lakhs" placeholder="Prize amount e.g. INR 50 Lakhs"
                                class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
                        </div>
                        <div class="col-span-3 sm:col-span-4">
                            <input type="text" name="prize_winners[]" value="1 Lucky Ticket" placeholder="e.g. 1 Lucky Ticket"
                                class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
                        </div>
                        <div class="col-span-1 text-center">
                            <button type="button" onclick="removePrizeRow(this)" title="Remove Prize"
                                class="w-7 h-7 rounded-full bg-rose-500/15 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 flex items-center justify-center text-xs transition mx-auto">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Row 2 (2nd Prize) -->
                    <div class="prize-row grid grid-cols-12 gap-2 sm:gap-3 items-center bg-[#040A1A]/80 p-2.5 rounded-2xl border border-white/10">
                        <div class="col-span-3 sm:col-span-2">
                            <span class="prize-badge w-full py-2 rounded-xl bg-[#0B193E] text-[#F3D068] font-bold text-xs border border-[#DFB755]/30 flex items-center justify-center text-center">
                                2nd Prize
                            </span>
                        </div>
                        <div class="col-span-5 sm:col-span-5">
                            <input type="text" name="prize_amount[]" value="INR 10 Lakhs" placeholder="Prize amount e.g. INR 10 Lakhs"
                                class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
                        </div>
                        <div class="col-span-3 sm:col-span-4">
                            <input type="text" name="prize_winners[]" value="5 winners" placeholder="e.g. 5 winners"
                                class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
                        </div>
                        <div class="col-span-1 text-center">
                            <button type="button" onclick="removePrizeRow(this)" title="Remove Prize"
                                class="w-7 h-7 rounded-full bg-rose-500/15 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 flex items-center justify-center text-xs transition mx-auto">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Row 3 (3rd Prize) -->
                    <div class="prize-row grid grid-cols-12 gap-2 sm:gap-3 items-center bg-[#040A1A]/80 p-2.5 rounded-2xl border border-white/10">
                        <div class="col-span-3 sm:col-span-2">
                            <span class="prize-badge w-full py-2 rounded-xl bg-[#0B193E] text-[#F3D068] font-bold text-xs border border-[#DFB755]/30 flex items-center justify-center text-center">
                                3rd Prize
                            </span>
                        </div>
                        <div class="col-span-5 sm:col-span-5">
                            <input type="text" name="prize_amount[]" value="INR 2 Lakhs" placeholder="Prize amount e.g. INR 2 Lakhs"
                                class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
                        </div>
                        <div class="col-span-3 sm:col-span-4">
                            <input type="text" name="prize_winners[]" value="10 winners" placeholder="e.g. 10 winners"
                                class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
                        </div>
                        <div class="col-span-1 text-center">
                            <button type="button" onclick="removePrizeRow(this)" title="Remove Prize"
                                class="w-7 h-7 rounded-full bg-rose-500/15 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 flex items-center justify-center text-xs transition mx-auto">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Form Bottom Options & Save Button -->
            <div class="pt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-t border-white/10">
                <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" id="is_active" name="is_active" checked 
                        class="w-4 h-4 rounded border-stone-600 text-emerald-600 focus:ring-emerald-500 bg-[#040A1A]">
                    <span class="text-xs font-bold text-white">Active Scheme</span>
                </label>

                <div class="flex flex-wrap items-center gap-2.5 w-full sm:w-auto">
                    <button type="button" id="cancel-edit-btn" onclick="resetForm()" class="hidden px-4 py-3 rounded-xl bg-white/10 hover:bg-white/15 text-stone-300 font-bold text-xs transition items-center gap-1.5 border border-white/10">
                        <i class="fa-solid fa-xmark"></i>
                        <span>Cancel Edit</span>
                    </button>
                    <button type="submit" id="submit-btn"
                        class="w-full sm:w-auto min-w-[200px] bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-700 hover:from-emerald-600 hover:to-emerald-500 text-white font-black text-xs py-3 px-8 rounded-xl shadow-lg border border-emerald-400/40 flex items-center justify-center gap-2 transition transform hover:scale-[1.02]">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span id="submit-btn-text">Save Chart</span>
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!-- Section 2: Active Dynamic Categories Table -->
    <div class="bg-[#071533]/90 rounded-3xl border border-[#DFB755]/25 shadow-2xl overflow-hidden space-y-0">
        
        <div class="p-5 sm:p-6 pb-4 border-b border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-lg sm:text-xl font-serif font-black text-white">
                    Configured Ticket Categories
                </h3>
                <p class="text-xs text-stone-400 mt-0.5">
                    Live dynamic lottery categories registered in the system
                </p>
            </div>
            <span class="text-xs font-bold text-[#DFB755] bg-[#DFB755]/10 px-3 py-1 rounded-full border border-[#DFB755]/30 self-start sm:self-auto">
                {{ count($ticketCharts) }} Categories Active
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-stone-300" id="ticket-charts-table">
                <thead class="bg-[#0B193E] text-[10px] sm:text-[11px] uppercase font-black text-[#DFB755] tracking-wider border-b border-[#DFB755]/30 whitespace-nowrap">
                    <tr>
                        <th scope="col" class="py-4 px-4 sm:px-6">CATEGORY / DRAW NAME</th>
                        <th scope="col" class="py-4 px-3">PRICE</th>
                        <th scope="col" class="py-4 px-3">TICKET CODE / SERIES</th>
                        <th scope="col" class="py-4 px-3">NUMBER RANGE</th>
                        <th scope="col" class="py-4 px-3">DISPLAY</th>
                        <th scope="col" class="py-4 px-3">POSITION</th>
                        <th scope="col" class="py-4 px-4">PRIZE SETUP</th>
                        <th scope="col" class="py-4 px-3">STATUS</th>
                        <th scope="col" class="py-4 px-4 text-right sm:pr-6">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 font-sans">
                    @foreach($ticketCharts as $chart)
                        <tr class="table-chart-row hover:bg-white/[0.04] transition duration-150" id="chart-row-{{ $chart['id'] }}">
                            
                            <!-- DRAW NAME & SLUG -->
                            <td class="py-4 px-4 sm:px-6 whitespace-nowrap">
                                <span class="font-bold text-white text-xs block">
                                    {{ $chart['name'] }}
                                </span>
                                <span class="text-[10px] font-mono text-stone-400 block mt-0.5">
                                    {{ $chart['slug'] }}
                                </span>
                            </td>

                            <!-- PRICE -->
                            <td class="py-4 px-3 whitespace-nowrap font-mono font-bold text-[#F3D068] text-sm">
                                {{ $chart['price'] }}
                            </td>

                            <!-- TICKET CODE / SERIES -->
                            <td class="py-4 px-3 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-[#040A1A] border border-[#DFB755]/30 font-mono font-bold text-[#F3D068] text-xs">
                                    <i class="fa-solid fa-ticket text-[10px] text-stone-400"></i>
                                    <span>{{ $chart['code'] ?? ($chart['series'] . '000000') }}</span>
                                </span>
                                <span class="text-[10px] text-stone-400 block mt-1 font-mono">Series: {{ $chart['series'] }}</span>
                            </td>

                            <!-- NUMBER RANGE -->
                            <td class="py-4 px-3 whitespace-nowrap font-mono text-stone-300 text-[11px]">
                                {{ $chart['number_range'] }}
                            </td>

                            <!-- DISPLAY -->
                            <td class="py-4 px-3 whitespace-nowrap font-mono text-stone-300">
                                {{ $chart['display'] }}
                            </td>

                            <!-- POSITION -->
                            <td class="py-4 px-3 whitespace-nowrap font-mono font-semibold text-stone-300">
                                {{ $chart['position'] }}
                            </td>

                            <!-- PRIZE SETUP BADGES -->
                            <td class="py-4 px-4">
                                <div class="flex flex-wrap gap-1.5 max-w-[300px]">
                                    @foreach($chart['prizes'] as $p)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-[#040A1A] border border-[#DFB755]/30 text-[10px] font-bold text-stone-200">
                                            <span class="text-[#F3D068]">{{ $p['label'] }}:</span>
                                            <span>{{ $p['amount'] }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            </td>

                            <!-- STATUS -->
                            <td class="py-4 px-3 whitespace-nowrap">
                                @if($chart['status'] === 'Active')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-stone-500/15 text-stone-400 border border-stone-500/30">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- ACTIONS -->
                            <td class="py-4 px-4 sm:pr-6 whitespace-nowrap text-right space-x-1.5">
                                <button type="button" onclick="editChart({{ json_encode($chart) }})"
                                    class="px-2.5 py-1 rounded-lg bg-white/10 hover:bg-[#DFB755] hover:text-[#071533] text-stone-300 text-xs font-bold border border-white/10 transition">
                                    Edit
                                </button>

                                <form action="{{ route('admin.tickets.delete', $chart['id']) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                        data-confirm="Are you sure you want to delete scheme <strong>{{ $chart['name'] }}</strong>?"
                                        data-confirm-title="Delete Category"
                                        data-confirm-type="danger"
                                        data-confirm-btn="Delete Scheme"
                                        class="px-2.5 py-1 rounded-lg bg-rose-500/10 hover:bg-rose-500/25 text-rose-300 text-xs font-bold border border-rose-500/30 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="p-4 bg-[#040A1A]/80 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-stone-400">
            <span>Dynamic Category Registry (Maharaja 500, Rajshree 200, Rajshree 50)</span>
            <span class="font-mono text-[11px] text-stone-400">Maharaja Directorate Engine</span>
        </div>

    </div>

</div>

@push('scripts')
<script>
    // Ordinal formatting helper
    function getOrdinal(n) {
        const s = ["th", "st", "nd", "rd"],
              v = n % 100;
        return n + (s[(v - 20) % 10] || s[v] || s[0]);
    }

    // Add Dynamic Prize Row
    function addPrizeRow() {
        const container = document.getElementById('prize-rows-container');
        const count = container.querySelectorAll('.prize-row').length + 1;
        const ordinalLabel = getOrdinal(count) + ' Prize';

        const row = document.createElement('div');
        row.className = 'prize-row grid grid-cols-12 gap-2 sm:gap-3 items-center bg-[#040A1A]/80 p-2.5 rounded-2xl border border-white/10 animate-fade-in';
        row.innerHTML = `
            <div class="col-span-3 sm:col-span-2">
                <span class="prize-badge w-full py-2 rounded-xl bg-[#0B193E] text-[#F3D068] font-bold text-xs border border-[#DFB755]/30 flex items-center justify-center text-center">
                    ${ordinalLabel}
                </span>
            </div>
            <div class="col-span-5 sm:col-span-5">
                <input type="text" name="prize_amount[]" placeholder="Prize amount e.g. INR 10 Lakh"
                    class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
            </div>
            <div class="col-span-3 sm:col-span-4">
                <input type="text" name="prize_winners[]" placeholder="e.g. 5 winners"
                    class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white placeholder-stone-500 outline-none">
            </div>
            <div class="col-span-1 text-center">
                <button type="button" onclick="removePrizeRow(this)" title="Remove Prize"
                    class="w-7 h-7 rounded-full bg-rose-500/15 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 flex items-center justify-center text-xs transition mx-auto">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    // Remove Prize Row & Reindex
    function removePrizeRow(btn) {
        const container = document.getElementById('prize-rows-container');
        const rows = container.querySelectorAll('.prize-row');
        if (rows.length <= 1) {
            if (typeof window.adminToast === 'function') {
                window.adminToast('At least one prize tier is required for a lottery scheme.', 'warning');
            } else {
                alert('At least one prize tier is required for a lottery scheme.');
            }
            return;
        }
        btn.closest('.prize-row').remove();
        reindexPrizeRows();
    }

    function reindexPrizeRows() {
        const rows = document.querySelectorAll('#prize-rows-container .prize-row');
        rows.forEach((row, idx) => {
            const badge = row.querySelector('.prize-badge');
            if (badge) {
                badge.textContent = getOrdinal(idx + 1) + ' Prize';
            }
        });
    }

    // Populate Form when clicking Edit on a table row
    function editChart(chart) {
        if (typeof chart === 'string') {
            try {
                chart = JSON.parse(chart);
            } catch (e) {
                console.error("Invalid chart data", e);
                return;
            }
        }

        document.getElementById('chart_id').value = chart.id || '';
        document.getElementById('price').value = chart.price || '';
        document.getElementById('draw_name').value = chart.name || '';
        document.getElementById('series_prefixes').value = chart.series || '';
        document.getElementById('ticket_code').value = chart.code || '';
        
        if (chart.number_range && chart.number_range.includes('-')) {
            const parts = chart.number_range.split('-').map(s => s.trim());
            document.getElementById('start_number').value = parts[0] || '100000';
            document.getElementById('end_number').value = parts[1] || '999999';
        } else {
            document.getElementById('start_number').value = '100000';
            document.getElementById('end_number').value = '999999';
        }

        document.getElementById('display_limit').value = chart.display || 50;
        document.getElementById('position').value = chart.position || 'LB 1';
        document.getElementById('is_active').checked = (chart.status === 'Active');

        document.getElementById('form-title').textContent = 'Edit Category: ' + (chart.name || 'Scheme');
        document.getElementById('submit-btn-text').textContent = 'Update Category';
        
        const cancelBtn = document.getElementById('cancel-edit-btn');
        if (cancelBtn) {
            cancelBtn.classList.remove('hidden');
            cancelBtn.classList.add('inline-flex');
        }

        // Rebuild prize breakdown rows
        const container = document.getElementById('prize-rows-container');
        container.innerHTML = '';

        if (chart.prizes && chart.prizes.length > 0) {
            chart.prizes.forEach((p, index) => {
                const label = p.label ? (p.label.includes('Prize') ? p.label : p.label + ' Prize') : getOrdinal(index + 1) + ' Prize';
                const row = document.createElement('div');
                row.className = 'prize-row grid grid-cols-12 gap-2 sm:gap-3 items-center bg-[#040A1A]/80 p-2.5 rounded-2xl border border-white/10';
                row.innerHTML = `
                    <div class="col-span-3 sm:col-span-2">
                        <span class="prize-badge w-full py-2 rounded-xl bg-[#0B193E] text-[#F3D068] font-bold text-xs border border-[#DFB755]/30 flex items-center justify-center text-center">
                            ${label}
                        </span>
                    </div>
                    <div class="col-span-5 sm:col-span-5">
                        <input type="text" name="prize_amount[]" value="${p.amount || ''}" placeholder="Prize amount"
                            class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white outline-none">
                    </div>
                    <div class="col-span-3 sm:col-span-4">
                        <input type="text" name="prize_winners[]" value="${p.winners || '1 Lucky Ticket'}" placeholder="Winner description"
                            class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white outline-none">
                    </div>
                    <div class="col-span-1 text-center">
                        <button type="button" onclick="removePrizeRow(this)" title="Remove Prize"
                            class="w-7 h-7 rounded-full bg-rose-500/15 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 flex items-center justify-center text-xs transition mx-auto">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                `;
                container.appendChild(row);
            });
        } else {
            // Add at least 1 default row
            addPrizeRow();
        }

        // Scroll to form smoothly and highlight
        const formContainer = document.getElementById('form-container');
        if (formContainer) {
            formContainer.scrollIntoView({ behavior: 'smooth' });
            formContainer.classList.add('ring-2', 'ring-[#DFB755]');
            setTimeout(() => {
                formContainer.classList.remove('ring-2', 'ring-[#DFB755]');
            }, 1800);
        }

        if (typeof window.adminToast === 'function') {
            window.adminToast('Editing scheme: ' + (chart.name || ''), 'warning');
        }
    }

    // Reset Form
    function resetForm() {
        document.getElementById('ticket-chart-form').reset();
        document.getElementById('chart_id').value = '';
        document.getElementById('form-title').textContent = 'Ticket Price Chart';
        document.getElementById('submit-btn-text').textContent = 'Save Chart';
        
        const cancelBtn = document.getElementById('cancel-edit-btn');
        if (cancelBtn) {
            cancelBtn.classList.add('hidden');
            cancelBtn.classList.remove('inline-flex');
        }

        // Reset default prizes (3 tiers)
        const container = document.getElementById('prize-rows-container');
        container.innerHTML = `
            <div class="prize-row grid grid-cols-12 gap-2 sm:gap-3 items-center bg-[#040A1A]/80 p-2.5 rounded-2xl border border-white/10">
                <div class="col-span-3 sm:col-span-2">
                    <span class="prize-badge w-full py-2 rounded-xl bg-[#0B193E] text-[#F3D068] font-bold text-xs border border-[#DFB755]/30 flex items-center justify-center text-center">
                        1st Prize
                    </span>
                </div>
                <div class="col-span-5 sm:col-span-5">
                    <input type="text" name="prize_amount[]" value="INR 50 Lakhs" placeholder="e.g. INR 50 Lakhs"
                        class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white outline-none">
                </div>
                <div class="col-span-3 sm:col-span-4">
                    <input type="text" name="prize_winners[]" value="1 Lucky Ticket" placeholder="e.g. 1 Lucky Ticket"
                        class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white outline-none">
                </div>
                <div class="col-span-1 text-center">
                    <button type="button" onclick="removePrizeRow(this)" title="Remove Prize"
                        class="w-7 h-7 rounded-full bg-rose-500/15 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 flex items-center justify-center text-xs transition mx-auto">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            <div class="prize-row grid grid-cols-12 gap-2 sm:gap-3 items-center bg-[#040A1A]/80 p-2.5 rounded-2xl border border-white/10">
                <div class="col-span-3 sm:col-span-2">
                    <span class="prize-badge w-full py-2 rounded-xl bg-[#0B193E] text-[#F3D068] font-bold text-xs border border-[#DFB755]/30 flex items-center justify-center text-center">
                        2nd Prize
                    </span>
                </div>
                <div class="col-span-5 sm:col-span-5">
                    <input type="text" name="prize_amount[]" value="INR 10 Lakhs" placeholder="e.g. INR 10 Lakhs"
                        class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white outline-none">
                </div>
                <div class="col-span-3 sm:col-span-4">
                    <input type="text" name="prize_winners[]" value="5 winners" placeholder="e.g. 5 winners"
                        class="w-full bg-[#071533] border border-white/15 focus:border-[#DFB755] rounded-xl px-3 py-2 text-xs text-white outline-none">
                </div>
                <div class="col-span-1 text-center">
                    <button type="button" onclick="removePrizeRow(this)" title="Remove Prize"
                        class="w-7 h-7 rounded-full bg-rose-500/15 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 flex items-center justify-center text-xs transition mx-auto">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        `;
    }
</script>
@endpush
@endsection
