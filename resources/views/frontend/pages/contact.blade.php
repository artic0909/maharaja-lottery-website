@extends('frontend.layouts.app')

@section('content')

<!-- Contact Support Desk Hero Banner -->
<section class="relative bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] text-white pt-14 pb-20 lg:pt-16 lg:pb-24 overflow-hidden shadow-inner">
    <!-- Big Stylized Watermark Background -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden z-0 select-none">
        <span class="text-white font-serif font-black text-5xl sm:text-7xl md:text-8xl lg:text-9xl tracking-[0.25em] uppercase opacity-[0.045] whitespace-nowrap transform -rotate-1">
            LOTTERY SUPPORT
        </span>
    </div>
    
    <!-- Subtle Pattern & Ambient Glows -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-black/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Subtitle -->
        <div class="inline-flex items-center gap-2 mb-3">
            <span class="w-5 h-0.5 bg-[#DFB755]"></span>
            <span class="text-[#F5D77F] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                SUPPORT DESK
            </span>
            <span class="w-5 h-0.5 bg-[#DFB755]"></span>
        </div>

        <!-- Main Heading -->
        <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-serif font-black text-white tracking-wide leading-tight mb-4">
            Contact Maharaja Lottery <span class="text-[#F5D77F]">Support</span>
        </h1>

        <!-- Subtitle Description -->
        <p class="text-white/85 text-xs sm:text-sm lg:text-base max-w-2xl mx-auto font-normal leading-relaxed">
            Reach out for ticket booking guidance, result checks, claim documentation and customer support.
        </p>
    </div>
</section>

<!-- Gold Accent Bar -->
<div class="h-1.5 w-full bg-gradient-to-r from-[#B8860B] via-[#F3D068] to-[#B8860B]"></div>

<!-- Main Contact Section & Cards -->
<section class="relative bg-gradient-to-b from-slate-50 via-white to-slate-100 py-10 lg:py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        
        <!-- 3 Contact Cards Row (Floating Overlap) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 -mt-16 sm:-mt-20 relative z-20 mb-12">
            
            <!-- Card 1: WhatsApp Support -->
            <div class="bg-white rounded-2xl p-6 sm:p-7 shadow-xl border border-slate-200/90 flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-300 group hover:border-[#16A34A]/50 hover:shadow-2xl">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-[#16A34A] transition-colors">
                            WhatsApp Support
                        </h3>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#16A34A] flex items-center justify-center text-xl shadow-2xs group-hover:scale-110 transition-transform">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                    </div>
                    <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed mb-6 font-normal min-h-[38px]">
                        Fastest way to ask about current ticket availability and result verification.
                    </p>
                </div>
                
                <a href="https://wa.me/918743978796" target="_blank" class="inline-flex items-center justify-center gap-2 bg-[#16A34A] hover:bg-[#15803D] text-white py-2.5 sm:py-3 px-4 rounded-xl font-bold text-xs sm:text-sm text-center transition-all duration-300 shadow-md shadow-emerald-900/10">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    Chat Now
                </a>
            </div>

            <!-- Card 2: Phone Support -->
            <div class="bg-white rounded-2xl p-6 sm:p-7 shadow-xl border border-slate-200/90 flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-300 group hover:border-[#0B193E]/50 hover:shadow-2xl">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-[#0B193E] transition-colors">
                            Phone Support
                        </h3>
                        <div class="w-10 h-10 rounded-xl bg-[#e6eef9] text-[#0B193E] flex items-center justify-center text-lg shadow-2xs group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>
                    <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed mb-6 font-normal min-h-[38px]">
                        Call for urgent booking or prize claim assistance.
                    </p>
                </div>
                
                <a href="tel:8743978796" class="inline-flex items-center justify-center gap-2 bg-[#0B193E] hover:bg-[#071533] text-white py-2.5 sm:py-3 px-4 rounded-xl font-bold text-xs sm:text-sm text-center transition-all duration-300 shadow-md shadow-black/15 border border-[#DFB755]/30">
                    <i class="fa-solid fa-phone text-xs text-[#DFB755]"></i>
                    8743978796
                </a>
            </div>

            <!-- Card 3: Email Desk -->
            <div class="bg-white rounded-2xl p-6 sm:p-7 shadow-xl border border-slate-200/90 flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-300 group hover:border-[#0B193E]/50 hover:shadow-2xl">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-[#0B193E] transition-colors">
                            Email Desk
                        </h3>
                        <div class="w-10 h-10 rounded-xl bg-[#e6eef9] text-[#0B193E] flex items-center justify-center text-lg shadow-2xs group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>
                    <p class="text-xs sm:text-[13px] text-slate-500 leading-relaxed mb-6 font-normal min-h-[38px]">
                        Use email for documents and official communication copies.
                    </p>
                </div>
                
                <a href="mailto:support@keralalotteriesgov.com" class="inline-flex items-center justify-center gap-2 border-2 border-[#0B193E] text-[#0B193E] hover:bg-[#0B193E] hover:text-white py-2.5 sm:py-2.5 px-4 rounded-xl font-bold text-xs sm:text-sm text-center transition-all duration-300">
                    <i class="fa-solid fa-envelope text-xs"></i>
                    support@keralalotteriesgov.com
                </a>
            </div>

        </div>

        <!-- Send A Message Form Container -->
        <div class="max-w-4xl mx-auto bg-white rounded-2xl p-6 sm:p-10 lg:p-12 shadow-xl border border-slate-200/90">
            
            <!-- Form Title -->
            <div class="text-center mb-8 sm:mb-10">
                <h2 class="text-2xl sm:text-3xl font-serif font-black tracking-wider text-[#0B193E] uppercase">
                    SEND A MESSAGE
                </h2>
                <div class="w-16 h-1 bg-[#DFB755] mx-auto mt-2.5 rounded-full"></div>
            </div>

            <!-- Form -->
            <form action="#" method="POST" class="space-y-6">
                @csrf
                
                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-[#0B193E] uppercase tracking-wider mb-2">
                        Full Name
                    </label>
                    <input type="text" id="name" name="name" required placeholder="Enter your full name" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#0B193E] focus:ring-2 focus:ring-[#0B193E]/20 outline-none text-sm text-slate-800 placeholder-slate-400 bg-slate-50/50 transition">
                </div>

                <!-- Mobile Number -->
                <div>
                    <label for="mobile" class="block text-xs font-bold text-[#0B193E] uppercase tracking-wider mb-2">
                        Mobile Number
                    </label>
                    <input type="tel" id="mobile" name="mobile" required placeholder="Enter 10 digit mobile number" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#0B193E] focus:ring-2 focus:ring-[#0B193E]/20 outline-none text-sm text-slate-800 placeholder-slate-400 bg-slate-50/50 transition">
                </div>

                <!-- Subject Select -->
                <div>
                    <label for="subject" class="block text-xs font-bold text-[#0B193E] uppercase tracking-wider mb-2">
                        Subject
                    </label>
                    <select id="subject" name="subject" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#0B193E] focus:ring-2 focus:ring-[#0B193E]/20 outline-none text-sm text-slate-800 bg-slate-50/50 transition cursor-pointer">
                        <option value="">Select an option</option>
                        <option value="Ticket Booking Inquiry">Ticket Booking Inquiry</option>
                        <option value="Result Verification Assistance">Result Verification Assistance</option>
                        <option value="Prize Claim Guidance">Prize Claim Guidance</option>
                        <option value="Complaint or Feedback">Complaint or Feedback</option>
                        <option value="Other Query">Other Query</option>
                    </select>
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-xs font-bold text-[#0B193E] uppercase tracking-wider mb-2">
                        Message
                    </label>
                    <textarea id="message" name="message" rows="5" required placeholder="Write your message here..." class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-[#0B193E] focus:ring-2 focus:ring-[#0B193E]/20 outline-none text-sm text-slate-800 placeholder-slate-400 bg-slate-50/50 transition resize-y"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] py-3.5 sm:py-4 rounded-xl font-black text-sm sm:text-base tracking-wide shadow-lg shadow-black/15 transition-all duration-300 transform hover:scale-[1.008] border border-[#FFE8A2]">
                        Send Message
                    </button>
                </div>

            </form>

        </div>

    </div>
</section>

@endsection
