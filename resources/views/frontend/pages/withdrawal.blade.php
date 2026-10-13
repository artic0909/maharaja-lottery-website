@extends('frontend.layouts.app')

@section('content')
<section class="min-h-[calc(100vh-80px)] bg-gradient-to-br from-[#040A1A] via-[#071533] to-[#040A1A] py-8 sm:py-12 px-3 sm:px-6 lg:px-8 flex items-center justify-center relative overflow-hidden">
    
    <!-- Ambient Background Lighting -->
    <div class="absolute inset-0 pointer-events-none opacity-10" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-80 h-80 bg-[#DFB755]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-[#0F2356]/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative w-full max-w-xl bg-gradient-to-b from-[#071533] via-[#0B193E] to-[#040A1A] rounded-3xl border-2 border-[#DFB755]/50 shadow-[0_0_50px_rgba(223,183,85,0.2)] overflow-hidden text-white z-10">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-[#040A1A] via-[#071533] to-[#0B193E] px-5 py-4 border-b border-[#DFB755]/30 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/10 border border-[#DFB755]/40 flex items-center justify-center text-[#F3D068] text-base shrink-0 shadow-md">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black tracking-widest text-[#DFB755] block">PRIZE DISBURSEMENT DESK</span>
                    <h1 class="text-base sm:text-lg font-serif font-black text-white leading-tight">Bank Account Withdrawal</h1>
                </div>
            </div>

            <a href="{{ route('winnerlist') }}" 
                class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-stone-300 hover:text-white flex items-center justify-center text-xs transition" 
                title="Back to Winner Desk">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        <!-- Winner Prize Highlight (Centered & Big Size) -->
        <div class="bg-black/50 border-b border-[#DFB755]/30 p-5 sm:p-6 text-center">
            <div class="max-w-md mx-auto bg-gradient-to-b from-white/[0.08] to-white/[0.02] border border-[#DFB755]/40 rounded-2xl p-4 sm:p-5 shadow-2xl backdrop-blur-md space-y-1 relative overflow-hidden">
                <!-- Subtle Top Accent Glow -->
                <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-48 h-20 bg-emerald-500/20 rounded-full blur-2xl pointer-events-none"></div>

                <span class="text-[10px] sm:text-xs uppercase font-extrabold text-[#DFB755] tracking-widest block">
                    ★ Total Winning Prize ★
                </span>

                <div class="text-3xl sm:text-4xl md:text-5xl font-mono font-black text-emerald-300 drop-shadow-[0_0_18px_rgba(52,211,153,0.7)] tracking-tight leading-tight break-words py-0.5">
                    {{ $prizeAmount }}
                </div>

                @if(!empty($calc['winning_formatted']) && $calc['winning_formatted'] !== $prizeAmount)
                    <span class="text-xs sm:text-sm text-stone-300 font-mono font-medium block">
                        ({{ $calc['winning_formatted'] }})
                    </span>
                @endif
            </div>
        </div>

        <!-- Withdrawal Form -->
        <form action="{{ route('withdrawal.submit') }}" method="POST" id="withdrawal-form" class="p-5 sm:p-7 space-y-4">
            @csrf
            
            <input type="hidden" name="booking_ref" value="{{ $bookingRef }}">
            <input type="hidden" name="prize_amount" value="{{ $prizeAmount }}">

            <!-- Name Input -->
            <div class="space-y-1.5">
                <label for="customer_name" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                    Full Name (As per Bank Account) <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                        <i class="fa-solid fa-user text-xs"></i>
                    </div>
                    <input type="text" 
                        name="customer_name" 
                        id="customer_name" 
                        required
                        value="{{ old('customer_name', $customerName) }}" 
                        placeholder="Enter full name"
                        class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 rounded-xl text-white placeholder-stone-500 text-sm focus:outline-none focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] transition">
                </div>
                @error('customer_name')
                    <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number Input -->
            <div class="space-y-1.5">
                <label for="customer_phone" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                    Phone Number <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                        <i class="fa-solid fa-phone text-xs"></i>
                    </div>
                    <input type="tel" 
                        name="customer_phone" 
                        id="customer_phone" 
                        required
                        value="{{ old('customer_phone', $customerPhone) }}" 
                        placeholder="e.g. 9876543210"
                        class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 rounded-xl text-white placeholder-stone-500 text-sm font-mono focus:outline-none focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] transition">
                </div>
                @error('customer_phone')
                    <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bank Account Number -->
            <div class="space-y-1.5">
                <label for="account_number" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                    Bank Account Number <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                        <i class="fa-solid fa-credit-card text-xs"></i>
                    </div>
                    <input type="text" 
                        name="account_number" 
                        id="account_number" 
                        required
                        value="{{ old('account_number') }}" 
                        placeholder="Enter account number"
                        autocomplete="off"
                        class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 rounded-xl text-white placeholder-stone-500 text-sm font-mono tracking-wider focus:outline-none focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] transition">
                </div>
                @error('account_number')
                    <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bank Name -->
            <div class="space-y-1.5">
                <label for="bank_name" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                    Bank Name <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                        <i class="fa-solid fa-building-columns text-xs"></i>
                    </div>
                    <input type="text" 
                        name="bank_name" 
                        id="bank_name" 
                        required
                        value="{{ old('bank_name', $bankName ?? '') }}" 
                        placeholder="Enter bank name (e.g. State Bank of India, HDFC Bank)"
                        autocomplete="off"
                        class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 rounded-xl text-white placeholder-stone-500 text-sm focus:outline-none focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] transition">
                </div>
                @error('bank_name')
                    <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- IFSC Code -->
            <div class="space-y-1.5">
                <label for="ifsc_code" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                    IFSC Code <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                        <i class="fa-solid fa-hashtag text-xs"></i>
                    </div>
                    <input type="text" 
                        name="ifsc_code" 
                        id="ifsc_code" 
                        required
                        maxlength="15"
                        value="{{ old('ifsc_code') }}" 
                        placeholder="e.g. HDFC0001234 / SBIN0001234"
                        style="text-transform: uppercase;"
                        class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/20 rounded-xl text-white placeholder-stone-500 text-sm font-mono tracking-wider focus:outline-none focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] transition">
                </div>
                @error('ifsc_code')
                    <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" 
                    id="submit-withdrawal-btn"
                    class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:to-[#16A34A] text-white font-black text-sm uppercase tracking-wider shadow-xl shadow-emerald-950/60 hover:scale-[1.02] transform transition flex items-center justify-center gap-2 cursor-pointer border border-emerald-300/40">
                    <i class="fa-solid fa-arrow-right-to-bracket text-sm text-yellow-300"></i>
                    <span>Withdrawal Process</span>
                </button>
            </div>

        </form>

    </div>
</section>

@push('scripts')
<script>
    document.getElementById('ifsc_code').addEventListener('input', function(e) {
        this.value = this.value.toUpperCase();
    });
</script>
@endpush
@endsection
