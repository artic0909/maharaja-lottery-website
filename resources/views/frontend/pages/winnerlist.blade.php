@extends('frontend.layouts.app')

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
                        OFFICIAL DRAW DESK
                    </span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-black text-white tracking-wide leading-tight mb-3">
                    Maharaja Lottery <span class="text-[#F5D77F]">Results</span>
                </h1>
                
                <p class="text-white/85 text-xs sm:text-sm lg:text-[15px] leading-relaxed max-w-2xl font-normal mb-6">
                    Review recently published winning numbers and securely check your booked ticket using its number and registered mobile.
                </p>

                <!-- 3 Badges / Verification Points -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs text-white/90 font-medium">
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-shield-halved text-[#DFB755] text-xs"></i> Verified records
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-rotate text-[#DFB755] text-xs"></i> Regularly updated
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-lock text-[#DFB755] text-xs"></i> Secure status check
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
                                PUBLISHED RECORDS
                            </span>
                            <span class="text-2xl sm:text-3xl font-black text-white font-serif">0</span>
                        </div>
                        <div>
                            <span class="block text-[9px] uppercase tracking-wider font-extrabold text-white/60 mb-0.5">
                                DRAWS REPRESENTED
                            </span>
                            <span class="text-2xl sm:text-3xl font-black text-white font-serif">0</span>
                        </div>
                    </div>

                    <!-- Awaiting Status -->
                    <div class="flex items-center gap-2 text-[11px] font-semibold text-[#F5D77F]/90">
                        <i class="fa-regular fa-folder-open text-[#DFB755]"></i>
                        <span>Awaiting verified results</span>
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
            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#e6eef9] border border-slate-200 flex items-center justify-center text-[#0B193E] text-base sm:text-lg shrink-0 shadow-2xs">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div>
                <span class="block text-[10px] font-extrabold text-[#0B193E] uppercase tracking-wider font-sans mb-0.5">
                    QUICK VERIFICATION
                </span>
                <h3 class="text-sm sm:text-base lg:text-lg font-serif font-bold text-slate-900 tracking-wide">
                    Check your ticket status
                </h3>
                <p class="text-[11px] sm:text-xs text-slate-500 font-normal">
                    Enter the ticket number printed on your booking.
                </p>
            </div>
        </div>

        <!-- Right Form Input -->
        <div class="w-full lg:w-auto lg:min-w-[400px]">
            <form action="#" method="GET" class="w-full">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">
                    TICKET NUMBER
                </label>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center border border-slate-300 rounded-xl overflow-hidden focus-within:border-[#0B193E] focus-within:ring-2 focus-within:ring-[#0B193E]/20 shadow-xs bg-white transition-all">
                    <div class="flex items-center flex-1 min-w-0">
                        <span class="pl-3.5 text-slate-400">
                            <i class="fa-solid fa-ticket-simple text-[#0B193E]"></i>
                        </span>
                        <input type="text" name="ticket_number" placeholder="Example: NR 428719" class="w-full px-3 py-2.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 bg-transparent outline-none font-medium min-w-0">
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] px-5 py-2.5 sm:py-3 text-xs sm:text-sm font-black flex items-center justify-center gap-1.5 transition-colors shrink-0 border-l border-[#DFB755]">
                        <span>Continue</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Published Archive Section -->
<section class="py-12 lg:py-16 bg-gradient-to-b from-slate-50 via-white to-slate-100 min-h-[420px]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <!-- Section Header Row -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="w-4 h-0.5 bg-[#0B193E]"></span>
                    <span class="text-[#0B193E] font-extrabold text-[10px] sm:text-[11px] uppercase tracking-widest font-sans">
                        PUBLISHED ARCHIVE
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-serif font-black text-slate-900 tracking-wide">
                    Recent Maharaja Lottery Results
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-normal mt-1">
                    Winning numbers shown below come from published draw records.
                </p>
            </div>

            <!-- Customer Result Access Button -->
            <div class="shrink-0">
                <a href="#" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 hover:border-[#0B193E] hover:text-[#0B193E] px-3.5 py-2 rounded-xl shadow-xs transition-colors">
                    <i class="fa-solid fa-user-check text-[#0B193E]"></i>
                    Customer result access
                </a>
            </div>
        </div>

        <!-- Empty State Card -->
        <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200/90 p-12 lg:p-20 text-center shadow-xs mt-6 flex flex-col items-center justify-center">
            <div class="w-16 h-16 rounded-2xl bg-[#e6eef9] text-[#0B193E] flex items-center justify-center text-2xl shadow-xs mb-4">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            
            <h3 class="text-lg sm:text-xl font-serif font-bold text-slate-900 tracking-wide mb-1.5">
                No verified results published
            </h3>
            
            <p class="text-xs sm:text-sm text-slate-500 max-w-md font-normal">
                Published draw records will appear here after verification.
            </p>
        </div>

    </div>
</section>

@endsection
