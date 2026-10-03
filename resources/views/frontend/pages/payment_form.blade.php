@extends('frontend.layouts.app')

@section('content')
<!-- Hero / Header Stepper Section -->
<section class="relative bg-gradient-to-br from-[#7F1D1D] via-[#851624] to-[#550C16] text-white pt-10 pb-16 lg:pt-14 lg:pb-20 overflow-hidden shadow-inner">
    <!-- Stylized Watermark Background -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden z-0 select-none">
        <span class="text-white font-serif font-black text-6xl sm:text-8xl md:text-9xl tracking-[0.25em] uppercase opacity-[0.035] whitespace-nowrap">
            MAHARAJA LOTTERY
        </span>
    </div>
    
    <!-- Pattern Overlay -->
    <div class="absolute inset-0 pointer-events-none opacity-15" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Header Content (8 cols) -->
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2">
                    <i class="fa-solid fa-user-shield text-[#F59E0A] text-xs"></i>
                    <span class="text-[#F59E0A] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        CUSTOMER REGISTRATION
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-serif font-bold text-white tracking-tight leading-[1.15]">
                    Enter Your Booking Details
                </h1>

                <p class="text-white/85 text-xs sm:text-sm lg:text-base max-w-2xl font-normal leading-relaxed">
                    Provide accurate recipient information for lottery certificate issuance, SMS ticket dispatch, and prize claim authorization.
                </p>
            </div>

            <!-- Right Steps Stack (4 cols) -->
            <div class="lg:col-span-4 space-y-3">
                <!-- Step 01 (Completed) -->
                <a href="{{ route('ticket.booking', ['selected' => implode(',', $selectedTickets)]) }}" class="bg-white/5 hover:bg-white/10 backdrop-blur-xs rounded-2xl p-4 border border-white/15 flex items-center gap-4 transition group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 border border-emerald-400/40 flex items-center justify-center font-serif font-bold text-lg text-emerald-300 shrink-0">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-emerald-300 block">STEP ONE</span>
                        <h4 class="text-base font-semibold text-white/90 group-hover:text-amber-200 transition">Select tickets</h4>
                    </div>
                </a>

                <!-- Step 02 (Active) -->
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-4 border-2 border-white/80 shadow-lg flex items-center gap-4 transition transform hover:scale-[1.01]">
                    <div class="w-12 h-12 rounded-xl bg-white/20 border border-white/40 flex items-center justify-center font-serif font-black text-xl text-amber-300 shrink-0">
                        02
                    </div>
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-amber-200 block">STEP TWO</span>
                        <h4 class="text-base font-bold text-white">Your details</h4>
                    </div>
                </div>

                <!-- Step 03 (Inactive) -->
                <div class="bg-white/5 backdrop-blur-xs rounded-2xl p-4 border border-white/10 flex items-center gap-4 opacity-75">
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

<!-- Main Form Section -->
<section class="bg-[#FAFAFA] py-10 lg:py-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <form action="{{ route('qr.show') }}" method="POST" id="customer-form">
            @csrf
            <input type="hidden" name="tickets" value="{{ implode(',', $selectedTickets) }}">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- Left Column: Customer Information (7-8 cols) -->
                <div class="lg:col-span-7 xl:col-span-8 bg-white rounded-3xl shadow-sm border border-stone-200/80 p-6 sm:p-10 space-y-6">
                    
                    <!-- Form Header -->
                    <div class="flex items-start gap-4 pb-4 border-b border-stone-100">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-[#7F1D1D] text-xl shrink-0">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div>
                            <span class="text-[#7F1D1D] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest block mb-0.5">
                                CUSTOMER INFORMATION
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-serif font-black text-stone-900 tracking-tight">
                                Tell us who is booking
                            </h2>
                            <p class="text-stone-500 text-xs sm:text-sm mt-0.5">
                                All fields are required. Use details that match your payment account.
                            </p>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="space-y-4">
                        
                        <!-- Full Name -->
                        <div class="space-y-1.5">
                            <label for="full_name" class="block text-xs font-bold text-stone-700">
                                Full name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <input type="text" name="full_name" id="full_name" required placeholder="Enter your full name"
                                    value="{{ session('customer_name', '') }}"
                                    class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#7F1D1D]/20 focus:border-[#7F1D1D] transition">
                            </div>
                        </div>

                        <!-- 2 Columns: Email & Mobile -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-xs font-bold text-stone-700">
                                    Email address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <input type="email" name="email" id="email" required placeholder="name@example.com"
                                        value="{{ session('customer_email', '') }}"
                                        class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#7F1D1D]/20 focus:border-[#7F1D1D] transition">
                                </div>
                            </div>

                            <!-- Mobile -->
                            <div class="space-y-1.5">
                                <label for="mobile" class="block text-xs font-bold text-stone-700">
                                    Mobile number
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <input type="tel" name="mobile" id="mobile" required pattern="[0-9]{10}" maxlength="10" placeholder="10-digit mobile number"
                                        value="{{ session('customer_mobile', '') }}"
                                        class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#7F1D1D]/20 focus:border-[#7F1D1D] transition">
                                </div>
                            </div>
                        </div>

                        <!-- 2 Columns: State & City -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- State -->
                            <div class="space-y-1.5">
                                <label for="state" class="block text-xs font-bold text-stone-700">
                                    State
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-landmark"></i>
                                    </div>
                                    <select name="state" id="state" required
                                        class="w-full pl-9 pr-8 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#7F1D1D]/20 focus:border-[#7F1D1D] transition appearance-none">
                                        <option value="" disabled {{ session('customer_state') ? '' : 'selected' }}>Choose State</option>
                                        @foreach($indianStates as $st)
                                            <option value="{{ $st }}" {{ (session('customer_state') == $st || $st === 'Kerala') ? 'selected' : '' }}>
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
                                    City
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 text-xs">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <input type="text" name="city" id="city" required placeholder="Enter your city"
                                        value="{{ session('customer_city', '') }}"
                                        class="w-full pl-9 pr-4 py-3 rounded-xl bg-stone-50 border border-stone-200 text-sm text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#7F1D1D]/20 focus:border-[#7F1D1D] transition">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Privacy / Security Note -->
                    <div class="bg-stone-50 border border-stone-200/80 rounded-2xl p-4 flex items-start gap-3">
                        <div class="text-[#7F1D1D] text-base mt-0.5 shrink-0">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="text-xs text-stone-600">
                            <span class="font-bold text-stone-800 block">Your information is protected</span>
                            Details are used only to process this booking and provide ticket support.
                        </div>
                    </div>

                    <!-- Submit CTA Button -->
                    <div>
                        <button type="submit" 
                            class="w-full bg-[#7F1D1D] hover:bg-[#601211] text-white py-4 px-6 rounded-2xl font-bold text-sm sm:text-base shadow-lg shadow-red-950/20 hover:shadow-xl transition-all duration-200 transform hover:scale-[1.01] flex items-center justify-center gap-2">
                            <span>Continue to payment review</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </div>

                </div>

                <!-- Right Column: Booking Summary Card (4-5 cols) -->
                <div class="lg:col-span-5 xl:col-span-4 sticky top-24">
                    <div class="bg-[#601211] rounded-3xl shadow-xl overflow-hidden border border-red-900/40 text-white">
                        
                        <!-- Header -->
                        <div class="p-6 bg-gradient-to-b from-[#7F1D1D] to-[#601211] border-b border-red-800/60 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-[#FBBF24] text-lg shrink-0">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold tracking-widest text-amber-300 block">BOOKING SUMMARY</span>
                                <h3 class="text-lg font-serif font-black text-white">Your selection</h3>
                            </div>
                        </div>

                        <!-- Card Body (White Content) -->
                        <div class="bg-white p-6 text-stone-800 space-y-5">
                            
                            <!-- Active Draw Item -->
                            <div class="bg-stone-50 rounded-2xl p-4 border border-stone-200/80 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-7 h-7 rounded-lg bg-rose-100 text-[#7F1D1D] flex items-center justify-center text-xs shrink-0 font-bold">
                                        <i class="fa-solid fa-ticket-simple"></i>
                                    </div>
                                    <div class="truncate">
                                        <h5 class="text-xs font-bold text-stone-900 truncate">Samrudhi - Every Sunday</h5>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-[#7F1D1D] shrink-0">
                                    {{ count($selectedTickets) }} x INR 50
                                </span>
                            </div>

                            <!-- Selected Tickets Badges -->
                            <div>
                                <span class="text-[11px] font-bold text-stone-500 uppercase tracking-wider block mb-2">
                                    Selected Ticket Numbers ({{ count($selectedTickets) }})
                                </span>
                                <div class="flex flex-wrap gap-1.5 max-h-36 overflow-y-auto pr-1">
                                    @foreach($selectedTickets as $t)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-stone-100 text-stone-800 font-mono text-xs font-bold border border-stone-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#7F1D1D]"></span>
                                            {{ $t }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <hr class="border-stone-100">

                            <!-- Total Summary Row -->
                            <div class="space-y-2">
                                <div class="flex justify-between text-xs text-stone-600 font-medium">
                                    <span>Total tickets</span>
                                    <span class="font-bold text-stone-900">{{ count($selectedTickets) }}</span>
                                </div>
                                <div class="flex justify-between items-baseline pt-1">
                                    <span class="text-sm font-bold text-stone-800">Total amount</span>
                                    <span class="text-2xl font-serif font-black text-[#7F1D1D]">
                                        INR {{ count($selectedTickets) * 50 }}
                                    </span>
                                </div>
                            </div>

                            <!-- Change Selected Tickets Link -->
                            <div class="pt-2 text-center">
                                <a href="{{ route('ticket.booking', ['selected' => implode(',', $selectedTickets)]) }}" 
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-[#7F1D1D] hover:text-[#550C16] hover:underline transition">
                                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                                    <span>Change selected tickets</span>
                                </a>
                            </div>

                        </div>

                        <!-- Footer Note -->
                        <div class="p-4 bg-[#550C16] text-amber-200/90 text-[11px] text-center font-medium flex items-center justify-center gap-2">
                            <i class="fa-solid fa-clock text-amber-400 text-xs"></i>
                            <span>Tickets are reserved after this form is submitted successfully.</span>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
</section>
@endsection
