@extends('frontend.layouts.app')

@section('content')

<!-- About Hero Banner -->
<section class="relative bg-gradient-to-br from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] text-white pt-14 pb-20 lg:pt-16 lg:pb-24 overflow-hidden shadow-inner">
    <!-- Big Stylized Watermark Background -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden z-0 select-none">
        <span class="text-white font-serif font-black text-5xl sm:text-7xl md:text-8xl lg:text-9xl tracking-[0.25em] uppercase opacity-[0.045] whitespace-nowrap transform -rotate-1">
            MAHARAJA LOTTERIES
        </span>
    </div>
    
    <!-- Subtle Pattern & Ambient Glows -->
    <div class="absolute inset-0 pointer-events-none opacity-20" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#F59E0A]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-black/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <!-- Subtitle -->
        <div class="inline-flex items-center gap-2 mb-3">
            <span class="w-5 h-0.5 bg-[#F59E0A]"></span>
            <span class="text-[#F59E0A] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                ABOUT US
            </span>
            <span class="w-5 h-0.5 bg-[#F59E0A]"></span>
        </div>

        <!-- Main Heading -->
        <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-serif font-black text-white tracking-wide leading-tight mb-4">
            About Maharaja State <span class="text-[#F59E0A]">Lotteries</span>
        </h1>

        <!-- Subtitle Description -->
        <p class="text-white/85 text-xs sm:text-sm lg:text-base max-w-2xl mx-auto font-normal leading-relaxed">
            Pioneering digital transformation in state lotteries with integrity, security, and public trust since 1967.
        </p>
    </div>
</section>

<!-- Gold Accent Bar -->
<div class="h-1.5 w-full bg-[#F59E0A]"></div>

<!-- Story & Overview Section -->
<section class="relative bg-white py-14 lg:py-20 overflow-hidden border-b border-stone-200">
    <!-- Subtle Watermark -->
    <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#7F1E1D_1.5px,transparent_1.5px)] [background-size:18px_18px] pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            
            <!-- Left Text Content (7 cols) -->
            <div class="lg:col-span-7 space-y-5">
                <div class="inline-flex items-center gap-2">
                    <span class="w-4 h-0.5 bg-[#7F1E1D]"></span>
                    <span class="text-[#7F1E1D] font-extrabold text-xs uppercase tracking-widest font-sans">
                        OUR HERITAGE &amp; MISSION
                    </span>
                </div>

                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-stone-900 tracking-wide leading-snug">
                    Empowering Lives Through Transparent &amp; Secure State Lotteries
                </h2>

                <div class="space-y-4 text-stone-600 text-xs sm:text-sm leading-relaxed font-normal">
                    <p>
                        Established as a model initiative in the government sector, the Lotteries Department has set standard benchmarks in India for the conduct of paper lotteries. Conceived for the generation of non-tax revenue and for providing a stable source of income to thousands of agents and vendors, Maharaja Lotteries remains committed to social welfare.
                    </p>
                    <p>
                        Through the <strong class="text-stone-900">Lottery Information &amp; Management System (LOTIS)</strong>, the department has embraced modern cloud-enabled solutions to manage end-to-end supply chain activities, real-time ticket verifications, and transparent live draw broadcasts.
                    </p>
                </div>

                <!-- 2 Key Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-stone-50 border border-stone-200">
                        <div class="w-10 h-10 rounded-lg bg-rose-50 text-[#7F1E1D] flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-stone-900 text-xs sm:text-sm">Social Welfare</h4>
                            <p class="text-[11px] sm:text-xs text-stone-500 mt-0.5">Directly supporting public healthcare, pension funds, and community welfare programs.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-xl bg-stone-50 border border-stone-200">
                        <div class="w-10 h-10 rounded-lg bg-rose-50 text-[#7F1E1D] flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-shield-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-stone-900 text-xs sm:text-sm">100% Genuine Draws</h4>
                            <p class="text-[11px] sm:text-xs text-stone-500 mt-0.5">Government supervised draw machines with open public and media inspection.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Visual Image / Card (5 cols) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative group">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="{{ asset('img/agent-bg.png') }}" alt="Maharaja Lottery Agent & System" class="w-auto max-h-[380px] sm:max-h-[420px] object-contain drop-shadow-xl transition-transform duration-500 group-hover:scale-105">
                    </div>
                    
                    <!-- Decorative Badge -->
                    <div class="absolute -bottom-4 -left-4 bg-gradient-to-br from-[#7F1E1D] to-[#991B1B] text-white p-4 rounded-2xl shadow-xl border border-[#F59E0A]/40 flex items-center gap-3">
                        <i class="fa-solid fa-award text-2xl text-[#F59E0A]"></i>
                        <div>
                            <span class="block text-xs font-black uppercase tracking-wider text-[#F59E0A]">TRUSTED SINCE</span>
                            <span class="text-sm font-bold text-white">1967 (55+ Years)</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Core Pillars (3 Pillars) -->
<section class="relative bg-gradient-to-b from-stone-50 via-white to-stone-100 py-14 lg:py-20 overflow-hidden border-b border-stone-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 mb-2">
                <span class="w-4 h-0.5 bg-[#7F1E1D]"></span>
                <span class="text-[#7F1E1D] font-extrabold text-xs uppercase tracking-widest font-sans">
                    OUR CORE PRINCIPLES
                </span>
                <span class="w-4 h-0.5 bg-[#7F1E1D]"></span>
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-stone-900 tracking-wide uppercase">
                The Pillars of Maharaja Lotteries
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 max-w-6xl mx-auto">
            
            <!-- Pillar 1 -->
            <div class="relative bg-white rounded-2xl p-7 text-stone-800 shadow-lg border border-stone-200/90 hover:border-[#F59E0A] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-rose-50 text-[#7F1E1D] flex items-center justify-center text-2xl shadow-2xs mb-5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <h3 class="text-lg font-bold text-stone-900 mb-2.5">
                        Digital Transformation
                    </h3>
                    <p class="text-xs sm:text-[13px] text-stone-600 leading-relaxed font-normal">
                        Empowering agents and citizens with LOTIS — our web-enabled, cloud-based platform for secure ticket supply chain and fast winner verifications.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-stone-100 flex items-center gap-1.5 text-xs font-bold text-[#7F1E1D]">
                    <span>Cloud Management</span>
                    <i class="fa-solid fa-arrow-right text-[10px] text-[#F59E0A]"></i>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="relative bg-white rounded-2xl p-7 text-stone-800 shadow-lg border border-stone-200/90 hover:border-[#F59E0A] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-rose-50 text-[#7F1E1D] flex items-center justify-center text-2xl shadow-2xs mb-5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="text-lg font-bold text-stone-900 mb-2.5">
                        Absolute Transparency
                    </h3>
                    <p class="text-xs sm:text-[13px] text-stone-600 leading-relaxed font-normal">
                        Every draw is performed live on stage under official judges, televised openly, and results are published on verified government portals.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-stone-100 flex items-center gap-1.5 text-xs font-bold text-[#7F1E1D]">
                    <span>Verified Draws</span>
                    <i class="fa-solid fa-arrow-right text-[10px] text-[#F59E0A]"></i>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="relative bg-white rounded-2xl p-7 text-stone-800 shadow-lg border border-stone-200/90 hover:border-[#F59E0A] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-rose-50 text-[#7F1E1D] flex items-center justify-center text-2xl shadow-2xs mb-5 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <h3 class="text-lg font-bold text-stone-900 mb-2.5">
                        Agent &amp; Public Support
                    </h3>
                    <p class="text-xs sm:text-[13px] text-stone-600 leading-relaxed font-normal">
                        Providing specialized helpdesks, claim guidance, prompt prize disbursements, and direct assistance to our massive network of registered agents.
                    </p>
                </div>
                <div class="pt-4 mt-4 border-t border-stone-100 flex items-center gap-1.5 text-xs font-bold text-[#7F1E1D]">
                    <span>Dedicated Support</span>
                    <i class="fa-solid fa-arrow-right text-[10px] text-[#F59E0A]"></i>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Key Statistics Section -->
<section class="relative bg-gradient-to-br from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] py-14 lg:py-16 text-white overflow-hidden shadow-inner">
    <div class="absolute inset-0 pointer-events-none opacity-20" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            
            <div class="p-4 rounded-xl bg-black/25 border border-white/10 backdrop-blur-xs">
                <span class="block text-3xl sm:text-4xl lg:text-5xl font-black text-[#F59E0A] font-serif mb-1">55+</span>
                <span class="text-xs sm:text-sm font-semibold text-white/90">Years of Heritage</span>
            </div>

            <div class="p-4 rounded-xl bg-black/25 border border-white/10 backdrop-blur-xs">
                <span class="block text-3xl sm:text-4xl lg:text-5xl font-black text-[#F59E0A] font-serif mb-1">100%</span>
                <span class="text-xs sm:text-sm font-semibold text-white/90">Transparent Live Draws</span>
            </div>

            <div class="p-4 rounded-xl bg-black/25 border border-white/10 backdrop-blur-xs">
                <span class="block text-3xl sm:text-4xl lg:text-5xl font-black text-[#F59E0A] font-serif mb-1">50K+</span>
                <span class="text-xs sm:text-sm font-semibold text-white/90">Registered Agents</span>
            </div>

            <div class="p-4 rounded-xl bg-black/25 border border-white/10 backdrop-blur-xs">
                <span class="block text-3xl sm:text-4xl lg:text-5xl font-black text-[#F59E0A] font-serif mb-1">100%</span>
                <span class="text-xs sm:text-sm font-semibold text-white/90">Secure Claim Support</span>
            </div>

        </div>
    </div>
</section>

<!-- Directorate Leadership Profiles -->
<section class="relative bg-white py-14 lg:py-20 overflow-hidden border-b border-stone-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 mb-2">
                <span class="w-4 h-0.5 bg-[#7F1E1D]"></span>
                <span class="text-[#7F1E1D] font-extrabold text-xs uppercase tracking-widest font-sans">
                    LEADERSHIP
                </span>
                <span class="w-4 h-0.5 bg-[#7F1E1D]"></span>
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-stone-900 tracking-wide uppercase">
                Directorate Leadership
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 lg:gap-8 max-w-4xl mx-auto">
            
            <!-- Leader 1 -->
            <div class="bg-stone-50 rounded-2xl p-6 text-center shadow-md border border-stone-200/90 hover:border-[#F59E0A] hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-28 h-32 mx-auto rounded-xl overflow-hidden shadow-md border-2 border-white mb-4 group-hover:scale-105 transition-transform">
                    <img src="{{ asset('img/satheesan.jpg') }}" alt="Shri. V D Satheesan" class="w-full h-full object-cover object-top">
                </div>
                <h4 class="text-sm sm:text-base font-bold text-stone-900">
                    Shri. V D Satheesan
                </h4>
                <p class="text-xs text-[#7F1E1D] font-semibold mt-1">
                    Hon'ble Chief Minister &amp; Minister for Finance
                </p>
            </div>

            <!-- Leader 2 -->
            <div class="bg-stone-50 rounded-2xl p-6 text-center shadow-md border border-stone-200/90 hover:border-[#F59E0A] hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-28 h-32 mx-auto rounded-xl overflow-hidden shadow-md border-2 border-white mb-4 group-hover:scale-105 transition-transform">
                    <img src="{{ asset('img/jyothilal.jpg') }}" alt="Shri. K R Jyothilal IAS" class="w-full h-full object-cover object-top">
                </div>
                <h4 class="text-sm sm:text-base font-bold text-stone-900">
                    Shri. K R Jyothilal IAS
                </h4>
                <p class="text-xs text-[#7F1E1D] font-semibold mt-1">
                    Addl. Chief Secretary, Taxes Department
                </p>
            </div>

            <!-- Leader 3 -->
            <div class="bg-stone-50 rounded-2xl p-6 text-center shadow-md border border-stone-200/90 hover:border-[#F59E0A] hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-28 h-32 mx-auto rounded-xl overflow-hidden shadow-md border-2 border-white mb-4 group-hover:scale-105 transition-transform">
                    <img src="{{ asset('img/anju.jpg') }}" alt="Anju K. S. IAS" class="w-full h-full object-cover object-top">
                </div>
                <h4 class="text-sm sm:text-base font-bold text-stone-900">
                    Anju K. S. IAS
                </h4>
                <p class="text-xs text-[#7F1E1D] font-semibold mt-1">
                    Director, Lotteries Department
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-12 bg-gradient-to-b from-stone-50 via-white to-stone-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        <div class="bg-gradient-to-r from-[#601211] via-[#7F1E1D] to-[#991B1B] rounded-2xl p-6 sm:p-8 lg:p-10 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 border border-[#F59E0A]/30">
            <div>
                <span class="bg-[#F59E0A]/20 text-[#F59E0A] border border-[#F59E0A]/30 text-[9px] font-black uppercase px-2.5 py-1 rounded tracking-widest inline-block mb-2">
                    ONLINE VERIFICATION &amp; BOOKING
                </span>
                <h3 class="text-xl sm:text-2xl font-serif font-bold text-white tracking-wide">
                    Need Ticket Assistance or Draw Verification?
                </h3>
                <p class="text-xs sm:text-sm text-white/80 mt-1">
                    Explore our weekly draw calendar, verified winner results, or contact our support desk.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="{{ route('winnerlist') }}" class="inline-flex items-center justify-center gap-2 bg-[#FDE68A] hover:bg-[#FBBF24] text-[#5C1110] font-black text-xs sm:text-sm px-5 py-2.5 rounded-xl shadow-md transition-all duration-300 hover:scale-105">
                    Winner List
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center gap-2 bg-black/30 hover:bg-black/40 text-white border border-white/20 font-bold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition-all duration-300">
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
