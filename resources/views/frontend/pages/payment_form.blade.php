@extends('frontend.layouts.app')

@section('content')
<!-- Hero / Header Stepper Section -->
<section class="relative bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] text-white pt-10 pb-16 lg:pt-14 lg:pb-20 overflow-hidden shadow-inner border-b border-[#DFB755]/20">
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
            
            <!-- Left Header Content (8 cols) -->
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2">
                    <i class="fa-solid fa-user-shield text-[#DFB755] text-xs"></i>
                    <span class="text-[#DFB755] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        CUSTOMER REGISTRATION
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-serif font-bold text-white tracking-tight leading-[1.15]">
                    Enter Your Booking Details
                </h1>

                <p class="text-white/85 text-xs sm:text-sm lg:text-base max-w-2xl font-normal leading-relaxed">
                    Provide recipient details for lottery certificate generation, SMS ticket confirmation, and prize claim authorization.
                </p>
            </div>

            <!-- Right Steps Stack (4 cols) -->
            <div class="lg:col-span-4 space-y-3">
                <!-- Step 01 (Completed) -->
                <a href="{{ route('ticket.booking', ['selected' => implode(',', $selectedTickets)]) }}" class="bg-white/5 hover:bg-white/10 backdrop-blur-xs rounded-2xl p-3.5 sm:p-4 border border-white/15 flex items-center gap-4 transition group">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/20 border border-emerald-400/40 flex items-center justify-center font-serif font-bold text-lg text-emerald-300 shrink-0">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-emerald-300 block">STEP ONE</span>
                        <h4 class="text-sm sm:text-base font-semibold text-white/90 group-hover:text-[#F3D068] transition">Select tickets</h4>
                    </div>
                </a>

                <!-- Step 02 (Active) -->
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-3.5 sm:p-4 border-2 border-[#DFB755] shadow-lg flex items-center gap-4 transition transform hover:scale-[1.01]">
                    <div class="w-11 h-11 rounded-xl bg-[#DFB755]/20 border border-[#DFB755]/50 flex items-center justify-center font-serif font-black text-xl text-[#F3D068] shrink-0">
                        02
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-[#DFB755] block">STEP TWO</span>
                        <h4 class="text-sm sm:text-base font-bold text-white">Your details</h4>
                    </div>
                </div>

                <!-- Step 03 (Inactive) -->
                <div class="bg-white/5 backdrop-blur-xs rounded-2xl p-3.5 sm:p-4 border border-white/10 flex items-center gap-4 opacity-75">
                    <div class="w-11 h-11 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center font-serif font-bold text-lg text-white/70 shrink-0">
                        03
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-white/60 block">STEP THREE</span>
                        <h4 class="text-sm sm:text-base font-semibold text-white/90">Payment review</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Gold Accent Bar -->
<div class="h-1.5 w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27]"></div>

<!-- Main Form Section -->
<section class="bg-[#F8FAFC] py-10 lg:py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <form action="{{ route('qr.show') }}" method="POST" id="customer-form">
            @csrf
            <input type="hidden" name="tickets" value="{{ implode(',', $selectedTickets) }}">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- Left Column: Customer Information (7 cols on lg, 8 on xl) -->
                <div class="lg:col-span-7 xl:col-span-7 bg-white rounded-3xl shadow-sm border border-stone-200/90 p-6 sm:p-9 space-y-6">
                    
                    <!-- Form Header -->
                    <div class="flex items-start gap-4 pb-4 border-b border-stone-100">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#071533]/10 to-[#DFB755]/20 border border-[#DFB755]/30 flex items-center justify-center text-[#0B193E] text-xl shrink-0 shadow-2xs">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div>
                            <span class="text-[#0B193E] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest block mb-0.5">
                                CUSTOMER INFORMATION
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-serif font-black text-stone-900 tracking-tight">
                                Tell us who is booking
                            </h2>
                            <p class="text-stone-500 text-xs sm:text-sm mt-0.5">
                                All fields are required. Enter accurate recipient contact details.
                            </p>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="space-y-4">
                        
                        <!-- Full Name -->
                        <div class="space-y-1.5">
                            <label for="full_name" class="block text-xs font-bold text-stone-700">
                                Full name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <input type="text" name="full_name" id="full_name" required placeholder="Enter your full name"
                                    value="{{ session('customer_name', '') }}"
                                    class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B193E]/20 focus:border-[#0B193E] transition">
                            </div>
                        </div>

                        <!-- 2 Columns: Email & Mobile -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-xs font-bold text-stone-700">
                                    Email address <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <input type="email" name="email" id="email" required placeholder="name@example.com"
                                        value="{{ session('customer_email', '') }}"
                                        class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B193E]/20 focus:border-[#0B193E] transition">
                                </div>
                            </div>

                            <!-- Mobile -->
                            <div class="space-y-1.5">
                                <label for="mobile" class="block text-xs font-bold text-stone-700">
                                    Mobile number <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <input type="tel" name="mobile" id="mobile" required pattern="[0-9]{10}" maxlength="10" placeholder="10-digit mobile number"
                                        value="{{ session('customer_mobile', '') }}"
                                        class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B193E]/20 focus:border-[#0B193E] transition">
                                </div>
                            </div>
                        </div>

                        <!-- 2 Columns: State & City -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- State -->
                            <div class="space-y-1.5">
                                <label for="state" class="block text-xs font-bold text-stone-700">
                                    State <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-landmark"></i>
                                    </div>
                                    <select name="state" id="state" required
                                        class="w-full pl-9 pr-8 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B193E]/20 focus:border-[#0B193E] transition appearance-none cursor-pointer">
                                        <option value="" disabled {{ session('customer_state') ? '' : 'selected' }}>Choose State</option>
                                        @foreach($indianStates as $st)
                                            <option value="{{ $st }}" {{ (session('customer_state') == $st || (!session('customer_state') && $st === 'Kerala')) ? 'selected' : '' }}>
                                                {{ $st }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="space-y-1.5">
                                <label for="city" class="block text-xs font-bold text-stone-700">
                                    City <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <input type="text" name="city" id="city" required placeholder="Enter your city"
                                        value="{{ session('customer_city', '') }}"
                                        class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B193E]/20 focus:border-[#0B193E] transition">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Privacy / Security Note -->
                    <div class="bg-stone-50 border border-stone-200/80 rounded-2xl p-4 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-[#0B193E]/10 text-[#0B193E] flex items-center justify-center text-sm shrink-0">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="text-xs text-stone-600">
                            <span class="font-bold text-stone-800 block">Your information is protected</span>
                            Details are strictly encrypted and used solely for ticket registration and official winner verification.
                        </div>
                    </div>

                    <!-- Submit CTA Button -->
                    <div>
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] py-4 px-6 rounded-2xl font-black text-sm sm:text-base shadow-lg shadow-gold-500/20 hover:shadow-xl transition-all duration-200 transform hover:scale-[1.01] flex items-center justify-center gap-2.5">
                            <span>Continue to payment review</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </div>

                </div>

                <!-- Right Column: Elevated Luxury Booking Summary Card (5 cols on lg/xl) -->
                <div class="lg:col-span-5 xl:col-span-5 sticky top-24">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-stone-200/90 transition-all hover:shadow-2xl">
                        
                        <!-- Luxury Royal Navy Header with Gold Styling -->
                        <div class="p-5 sm:p-6 bg-gradient-to-br from-[#040A1A] via-[#071533] to-[#0B193E] text-white relative overflow-hidden border-b border-[#DFB755]/30">
                            <!-- Subtle Background Motif -->
                            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:10px_10px] pointer-events-none"></div>
                            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-[#DFB755]/20 rounded-full blur-2xl pointer-events-none"></div>

                            <div class="relative z-10 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-2xl bg-[#DFB755]/15 border border-[#DFB755]/40 flex items-center justify-center text-[#DFB755] text-lg shrink-0 shadow-inner">
                                        <i class="fa-solid fa-ticket-simple"></i>
                                    </div>
                                    <div>
                                        <div class="inline-flex items-center gap-1.5 text-[9px] uppercase font-extrabold tracking-widest text-[#DFB755]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#DFB755] animate-pulse"></span>
                                            BOOKING SUMMARY
                                        </div>
                                        <h3 class="text-xl font-serif font-black text-white tracking-wide">
                                            Your selection
                                        </h3>
                                    </div>
                                </div>

                                <div class="px-2.5 py-1 rounded-full bg-[#DFB755]/20 border border-[#DFB755]/30 text-[#F3D068] font-mono font-bold text-xs">
                                    {{ count($selectedTickets) }}x
                                </div>
                            </div>
                        </div>

                        <!-- Card Body Content -->
                        <div class="p-5 sm:p-6 space-y-5">
                            
                            <!-- Active Draw Ribbon Box -->
                            <div class="bg-gradient-to-br from-stone-50 to-amber-50/30 rounded-2xl p-4 border border-stone-200/80 flex items-center justify-between gap-3 shadow-2xs">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-xl bg-[#071533] text-[#DFB755] flex items-center justify-center text-sm shrink-0 shadow-xs">
                                        <i class="fa-solid fa-crown"></i>
                                    </div>
                                    <div class="truncate">
                                        <h5 class="text-xs sm:text-sm font-black text-stone-900 truncate">{{ $draw['name'] ?? 'Maharaja Lottery' }}</h5>
                                        <p class="text-[11px] text-stone-500 font-medium">Official Directorate Scheme</p>
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="inline-block px-2.5 py-1 rounded-md bg-[#0B193E]/10 text-[#0B193E] font-bold text-xs font-mono">
                                        {{ count($selectedTickets) }} Tickets
                                    </span>
                                </div>
                            </div>

                            <!-- Selected Tickets Chips Grid -->
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-extrabold text-stone-500 uppercase tracking-widest">
                                        SELECTED TICKET NUMBERS ({{ count($selectedTickets) }})
                                    </span>
                                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                        ✓ Selected
                                    </span>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 max-h-40 overflow-y-auto pr-1 py-1">
                                    @foreach($selectedTickets as $t)
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-stone-50 hover:bg-white text-stone-800 font-mono text-xs font-black border border-stone-200 shadow-2xs transition transform hover:scale-[1.03]">
                                            <span class="w-2 h-2 rounded-full bg-[#0B193E]"></span>
                                            <span>{{ $t }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Itemized Breakdown Box -->
                            <div class="bg-stone-50/80 rounded-2xl p-4 border border-stone-200 space-y-2.5">
                                
                                <div class="flex justify-between items-center text-xs text-stone-600 font-medium">
                                    <span>Tickets Subtotal ({{ count($selectedTickets) }} Tickets)</span>
                                    <span class="font-bold text-stone-900 font-mono">₹{{ number_format($draw['total_amount'] ?? (count($selectedTickets) * 40)) }}.00</span>
                                </div>

                                <div class="flex justify-between items-center text-xs text-stone-600 font-medium">
                                    <span>Instant SMS Verification &amp; PDF</span>
                                    <span class="text-emerald-700 font-bold text-[11px] bg-emerald-100/60 px-2 py-0.5 rounded-md">FREE</span>
                                </div>

                                <div class="flex justify-between items-center text-xs text-stone-600 font-medium">
                                    <span>Govt. Regulated Draw Pool</span>
                                    <span class="text-emerald-700 font-bold text-[11px] bg-emerald-100/60 px-2 py-0.5 rounded-md">INCLUDED</span>
                                </div>

                                <div class="border-t border-dashed border-stone-300 pt-2.5 flex justify-between items-baseline">
                                    <div>
                                        <span class="text-xs sm:text-sm font-black text-stone-900 block">Total Amount Payable</span>
                                        <span class="text-[10px] text-stone-400 font-medium">All taxes &amp; fees included</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-2xl sm:text-3xl font-serif font-black text-[#0B193E] tracking-tight">
                                            INR {{ number_format($draw['total_amount'] ?? (count($selectedTickets) * 40)) }}
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <!-- Change Selected Tickets Button -->
                            <div class="text-center pt-1">
                                <a href="{{ route('ticket.booking', ['selected' => implode(',', $selectedTickets)]) }}" 
                                    class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 font-bold text-xs transition border border-stone-200/80 shadow-2xs group">
                                    <i class="fa-solid fa-arrow-left text-[10px] group-hover:-translate-x-0.5 transition-transform text-[#0B193E]"></i>
                                    <span>Change selected tickets</span>
                                </a>
                            </div>

                        </div>

                        <!-- Footer Note (Secure & Certified) -->
                        <div class="p-3.5 bg-[#040A1A] text-[#DFB755] text-[11px] text-center font-medium flex items-center justify-center gap-2 border-t border-[#DFB755]/20">
                            <i class="fa-solid fa-clock text-[#F3D068] text-xs animate-pulse"></i>
                            <span>Tickets are temporarily held for 15 minutes during checkout.</span>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
</section>
@endsection

