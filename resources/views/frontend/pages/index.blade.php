@extends('frontend.layouts.app')

@section('content')
<style>
    @keyframes marquee-scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    .marquee-track {
        display: flex;
        width: max-content;
        animation: marquee-scroll 28s linear infinite;
    }
    .marquee-container:hover .marquee-track {
        animation-play-state: paused;
    }
</style>

<!-- Hero Section & Current Sessions Container -->
<section class="relative min-h-[calc(100dvh-75px)] flex flex-col justify-between bg-zinc-900 overflow-hidden">
    <!-- Background Image with Lowest Darkness Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/slide-1.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-95">
        <!-- Minimal subtle darkness overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/55 via-black/30 to-black/10"></div>
    </div>

    <!-- Main Hero Content -->
    <div class="container mx-auto px-4 lg:px-8 relative z-10 w-full flex-1 flex items-center py-6 lg:py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center w-full">
            
            <!-- Left Content (7 cols on lg) -->
            <div class="text-white max-w-2xl lg:col-span-7 drop-shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-[#EAB308] animate-pulse"></span>
                    <span class="text-[#FBBF24] font-bold text-xs tracking-widest uppercase bg-black/40 px-2 py-0.5 rounded-sm backdrop-blur-xs">Trusted Maharaja Lottery Assistance</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-5xl xl:text-[54px] font-serif mb-4 lg:mb-5 leading-[1.15] text-white drop-shadow-md">
                    Maharaja Lottery<br>
                    <span class="text-white">Tickets, Results &</span><br>
                    <span class="text-[#FBBF24]">Support</span>
                </h2>
                
                <p class="text-white text-sm md:text-base mb-6 max-w-xl leading-relaxed drop-shadow-sm bg-black/25 p-3 rounded-lg backdrop-blur-xs border border-white/10">
                    Explore current ticket availability, follow verified draw updates and receive clear guidance for winner verification and prize claims.
                </p>
                
                <div class="flex flex-wrap items-center gap-3 sm:gap-4 mb-6">
                    <a href="#" class="bg-[#991B1B] hover:bg-[#7F1D1D] text-white px-5 py-2.5 sm:py-3 rounded-md font-semibold text-sm transition flex items-center gap-2 shadow-lg shadow-red-950/40 border border-red-400/30 group">
                        Book Tickets 
                        <i class="fa-solid fa-arrow-right-long text-xs group-hover:translate-x-1 transition-transform text-[#FBBF24]"></i>
                    </a>
                    <a href="#" class="bg-black/30 backdrop-blur-xs border border-white/80 hover:bg-white/20 text-white px-5 py-2.5 sm:py-3 rounded-md font-semibold text-sm transition flex items-center gap-2 shadow-sm">
                        View Results
                    </a>
                    <a href="#" class="text-white hover:text-[#25D366] transition flex items-center gap-2 font-medium text-xs sm:text-sm px-2 py-1 rounded-md bg-black/30 backdrop-blur-xs underline underline-offset-4 decoration-white/40">
                        <i class="fa-brands fa-whatsapp text-base sm:text-lg text-[#25D366]"></i> Get WhatsApp Assistance
                    </a>
                </div>
                
                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-xs sm:text-sm text-white font-medium">
                    <div class="flex items-center gap-1.5 bg-black/35 px-2.5 py-1 rounded-md backdrop-blur-xs">
                        <i class="fa-solid fa-check text-[#EAB308] text-xs"></i> Transparent booking support
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/35 px-2.5 py-1 rounded-md backdrop-blur-xs">
                        <i class="fa-solid fa-check text-[#EAB308] text-xs"></i> Verified result references
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/35 px-2.5 py-1 rounded-md backdrop-blur-xs">
                        <i class="fa-solid fa-check text-[#EAB308] text-xs"></i> Step-by-step claim guidance
                    </div>
                </div>
            </div>

            <!-- Right Content (5 cols on lg) -->
            <div class="hidden lg:flex justify-center items-center lg:col-span-5">
                <div class="relative w-80 xl:w-96 h-56 xl:h-64 bg-linear-to-br from-[#7F1D1D]/95 via-[#991B1B]/95 to-[#450A0A]/95 backdrop-blur-xs rounded-xl border-[4px] border-[#EAB308] shadow-2xl p-6 flex flex-col justify-center items-center text-center transform hover:scale-[1.02] transition-transform duration-300">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 rounded-lg"></div>
                    <i class="fa-solid fa-crown text-5xl xl:text-6xl text-[#FBBF24] mb-3 drop-shadow-md"></i>
                    <h3 class="text-2xl xl:text-3xl font-black text-white uppercase tracking-widest drop-shadow-md">Maharaja</h3>
                    <h4 class="text-lg xl:text-xl font-bold text-[#FDE047] uppercase tracking-wider mt-0.5 drop-shadow-md">State Lottery</h4>
                    <p class="text-white/90 text-xs mt-2.5 font-medium">Verified & Trusted Support</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Current Sessions (Auto Smooth Scrolling Bar) -->
    <div class="relative z-20 container mx-auto px-4 lg:px-8 pb-3 lg:pb-5">
        <div class="bg-white rounded-xl shadow-[0_8px_30px_rgba(0,0,0,0.18)] flex flex-col md:flex-row overflow-hidden border border-amber-500/20 p-1.5 gap-1.5">
            
            <!-- Left Banner with Right Arrow Pointer -->
            <div class="bg-linear-to-br from-[#7F1D1D] to-[#991B1B] text-white px-4 py-2.5 md:w-48 shrink-0 flex items-center gap-3 rounded-lg relative overflow-visible z-20 shadow-xs">
                <!-- Arrow Tip Pointing Right -->
                <div class="hidden md:block absolute top-1/2 -translate-y-1/2 -right-2 w-0 h-0 border-y-[7px] border-y-transparent border-l-[8px] border-l-[#991B1B] z-30"></div>
                
                <div class="bg-white/15 p-2 rounded-lg backdrop-blur-sm shrink-0 flex items-center justify-center border border-amber-400/30">
                    <i class="fa-solid fa-ticket text-lg text-[#FBBF24]"></i>
                </div>
                <div class="leading-tight">
                    <p class="text-[#FDE047] text-[9px] font-bold uppercase tracking-wider">Live Lottery</p>
                    <h4 class="text-sm md:text-base font-bold text-white">Current<br class="hidden md:block"> Sessions</h4>
                </div>
            </div>

            <!-- Auto Scrolling Smooth Marquee Container -->
            <div class="flex-1 overflow-hidden marquee-container relative flex items-center">
                <div class="marquee-track flex items-center gap-2 py-0.5">
                    
                    <!-- Loop 1: Items 01 - 07 -->
                    <!-- Card 01 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            01
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Samrudhi - Sunday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Samrudhi - Sunday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 02 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            02
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Bhagyathara - Monday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Bhagyathara - Monday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 03 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            03
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Sthree Sakthi - Tuesday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Sthree Sakthi - Tuesday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 04 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            04
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Dhanalekshmi - Wednesday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Dhanalekshmi - Wednesday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 05 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            05
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Karunya Plus - Thursday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Karunya Plus - Thursday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 06 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            06
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Suvarna - Friday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Suvarna - Friday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 07 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            07
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Karunya - Saturday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Karunya - Saturday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>


                    <!-- Loop 2: (Identical Duplicate for continuous infinite smooth loop) -->
                    <!-- Card 01 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            01
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Samrudhi - Sunday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Samrudhi - Sunday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 02 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            02
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Bhagyathara - Monday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Bhagyathara - Monday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 03 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            03
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Sthree Sakthi - Tuesday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Sthree Sakthi - Tuesday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 04 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            04
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Dhanalekshmi - Wednesday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Dhanalekshmi - Wednesday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 05 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            05
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Karunya Plus - Thursday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Karunya Plus - Thursday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 06 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            06
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Suvarna - Friday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Suvarna - Friday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                    <!-- Card 07 -->
                    <div class="bg-white rounded-lg border border-gray-200/80 shadow-2xs hover:shadow-xs hover:border-[#991B1B]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0">
                        <div class="bg-[#fcedf2] text-[#991B1B] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#991B1B] group-hover:text-white transition shrink-0">
                            07
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[8px] font-bold text-gray-400 uppercase tracking-wide truncate group-hover:text-[#991B1B] transition">Karunya - Saturday</p>
                            <div class="flex items-center justify-between gap-1">
                                <h5 class="font-bold text-gray-900 text-xs truncate group-hover:text-[#991B1B] transition">Karunya - Saturday</h5>
                                <i class="fa-solid fa-arrow-right text-[9px] text-[#D97706] shrink-0"></i>
                            </div>
                            <p class="text-[10px] font-medium text-gray-500"><span class="text-[#991B1B] font-bold">₹50</span> per ticket</p>
                        </div>
                    </div>

                </div>
            </div>
    </div>
</section>

<!-- About / Information & Management System Section -->
<section class="relative bg-gradient-to-r from-gray-50 via-white to-gray-100 py-12 lg:py-16 overflow-hidden border-t border-gray-200/60">
    <!-- Subtle Background Geometric Shape Accent -->
    <div class="absolute inset-0 opacity-40 pointer-events-none bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-amber-500/5 to-transparent pointer-events-none"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Text Content (7 cols on lg) -->
            <div class="lg:col-span-7">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-serif font-black tracking-wider text-[#7F1D1D] mb-2 drop-shadow-xs">
                    MAHARAJA
                </h2>
                
                <h3 class="italic text-[#991B1B] text-lg sm:text-xl lg:text-2xl font-medium tracking-wide mb-6">
                    Lottery Information & Management System
                </h3>
                
                <p class="text-[#7F1D1D] font-bold text-sm sm:text-base lg:text-[17px] leading-relaxed max-w-2xl">
                    MAHARAJA - Lottery Information & Management System is a digital tool for Digital Transformation in State Lotteries Department. MAHARAJA is a Web enabled Cloud Based open solution for supply chain management activities of the lottery department. This provides end to end solution to the agents and public.
                </p>

                <div class="mt-6 flex flex-wrap items-center gap-4">
                    <a href="#" class="inline-flex items-center gap-2 bg-[#991B1B] hover:bg-[#7F1D1D] text-white px-5 py-2.5 rounded-md font-semibold text-xs sm:text-sm transition shadow-md shadow-red-950/20 border border-red-500/30 group">
                        Learn More 
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform text-[#FBBF24]"></i>
                    </a>
                    <a href="tel:8743978796" class="inline-flex items-center gap-2 text-[#7F1D1D] hover:text-[#991B1B] font-bold text-xs sm:text-sm px-3 py-2 transition">
                        <i class="fa-solid fa-phone text-[#D97706]"></i> Agent Support Desk
                    </a>
                </div>
            </div>

            <!-- Right Image Content (5 cols on lg) -->
            <div class="lg:col-span-5 flex justify-center lg:justify-end items-center">
                <div class="relative group">
                    <img src="{{ asset('img/agent-bg.png') }}" alt="Maharaja Lottery Agent & System" class="w-auto max-h-[320px] sm:max-h-[380px] lg:max-h-[440px] object-contain drop-shadow-xl transition-transform duration-500 group-hover:scale-105">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Welcome / State Lotteries Overview Section -->
<section class="relative bg-cover bg-center py-16 lg:py-24 text-white overflow-hidden shadow-inner" style="background-image: url('{{ asset('img/kerala-lottery-bg.jpg') }}');">
    <!-- Overlay for optimal contrast and readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-sky-950/50 to-slate-900/40 pointer-events-none"></div>
    <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            
            <!-- Left Info Content (7 cols on lg) -->
            <div class="lg:col-span-7 space-y-4">
                <div>
                    <span class="block text-sm sm:text-base font-medium text-white/90 tracking-wider font-sans">
                        Welcome To
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-serif font-bold text-white tracking-wide mt-1 drop-shadow-md">
                        Kerala State Lotteries
                    </h2>
                </div>

                <div class="border-l-[3px] border-white/80 pl-4 sm:pl-6 py-1 my-6">
                    <p class="text-xs sm:text-sm lg:text-[15px] leading-relaxed text-white/95 font-normal drop-shadow-sm max-w-2xl">
                        Kerala, the Gods own country, added another first to its cap in 1967, when a Department was setup in the Government sector for the first time in India for the conduct of paper Lotteries . It was late Shri. P. K. Kunju Sahib, who envisaged this idea for the generation of revenue through the sale of lotteries and for providing a stable source of income to the poor and needy belonging to the marginalized section of society.
                    </p>
                </div>

                <div class="pt-2">
                    <a href="#" class="inline-flex items-center justify-center px-6 py-2.5 border-2 border-[#F59E0B] text-white font-medium text-xs sm:text-sm hover:bg-[#F59E0B] hover:text-slate-950 transition-all duration-300 shadow-md backdrop-blur-xs bg-black/25">
                        Read More
                    </a>
                </div>
            </div>

            <!-- Right Officials / Dignitaries Grid (5 cols on lg) -->
            <div class="lg:col-span-5 flex flex-col items-center justify-center">
                <div class="w-full max-w-md space-y-6">
                    
                    <!-- Top / Chief Minister & Minister for Finance -->
                    <div class="flex flex-col items-center text-center group">
                        <div class="bg-white p-1 rounded-xl shadow-2xl border border-white/60 w-28 h-32 sm:w-32 sm:h-36 overflow-hidden transform transition duration-300 group-hover:scale-105 group-hover:shadow-amber-400/20">
                            <img src="{{ asset('img/satheesan.jpg') }}" alt="Shri. V D Satheesan" class="w-full h-full object-cover object-top rounded-lg">
                        </div>
                        <h4 class="mt-2.5 text-xs sm:text-sm font-bold text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] tracking-wide">
                            Shri. V D Satheesan
                        </h4>
                        <p class="text-[11px] sm:text-xs text-amber-200 font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] max-w-[240px]">
                            Hon'ble Chief Minister &amp; Minister for Finance
                        </p>
                    </div>

                    <!-- Bottom Row / Secretary & Director -->
                    <div class="grid grid-cols-2 gap-4 sm:gap-6 pt-1">
                        
                        <!-- Secretary -->
                        <div class="flex flex-col items-center text-center group">
                            <div class="bg-white p-1 rounded-xl shadow-2xl border border-white/60 w-28 h-32 sm:w-32 sm:h-36 overflow-hidden transform transition duration-300 group-hover:scale-105 group-hover:shadow-amber-400/20">
                                <img src="{{ asset('img/jyothilal.jpg') }}" alt="Shri. K R Jyothilal IAS" class="w-full h-full object-cover object-top rounded-lg">
                            </div>
                            <h4 class="mt-2.5 text-xs sm:text-sm font-bold text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] tracking-wide">
                                Shri. K R Jyothilal IAS
                            </h4>
                            <p class="text-[11px] sm:text-xs text-amber-200 font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] max-w-[190px]">
                                Addl.Chief Secretary, Taxes Department
                            </p>
                        </div>

                        <!-- Director -->
                        <div class="flex flex-col items-center text-center group">
                            <div class="bg-white p-1 rounded-xl shadow-2xl border border-white/60 w-28 h-32 sm:w-32 sm:h-36 overflow-hidden transform transition duration-300 group-hover:scale-105 group-hover:shadow-amber-400/20">
                                <img src="{{ asset('img/anju.jpg') }}" alt="Anju K. S. IAS" class="w-full h-full object-cover object-top rounded-lg">
                            </div>
                            <h4 class="mt-2.5 text-xs sm:text-sm font-bold text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] tracking-wide">
                                Anju K. S. IAS
                            </h4>
                            <p class="text-[11px] sm:text-xs text-amber-200 font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] max-w-[190px]">
                                Director, Lotteries Department
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
