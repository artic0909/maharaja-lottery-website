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

<!-- Popular Services Section -->
<section class="relative bg-gradient-to-b from-[#FFFDF8] via-[#FFFBEB]/50 to-[#FEF3C7]/30 py-14 lg:py-20 overflow-hidden border-t border-amber-200/60">
    <!-- Repeating Lottery Motif Background Pattern -->
    <div class="absolute inset-0 pointer-events-none opacity-85" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    
    <!-- Subtle Golden & Wine Radial Glows for Depth -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#F59E0A]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#7F1E1D]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center mb-10 lg:mb-14">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black tracking-wider text-[#7F1E1D] uppercase drop-shadow-xs">
                POPULAR SERVICES
            </h2>
            <div class="w-20 h-1 bg-[#F59E0A] mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- Services 4-Column Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-6 xl:gap-8 max-w-7xl mx-auto">
            
            <!-- Service 1: Ticket Booking Support -->
            <div class="relative bg-gradient-to-b from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#F59E0A]/25 hover:border-[#F59E0A]/60 hover:shadow-2xl hover:shadow-red-950/40">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F59E0A] tracking-widest">01</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#FFFBEB] text-[#7F1E1D] border-2 border-[#F59E0A]/40 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-ticket-simple"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Ticket Booking Support
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Get assistance for available Kerala weekly lottery schemes and booking confirmation.
                    </p>
                </div>

                <a href="#" class="inline-flex items-center justify-center bg-[#F59E0A] hover:bg-[#EAB308] text-[#5C1110] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-amber-300/60 transform group-hover:scale-105">
                    Ticket Booking
                </a>
            </div>

            <!-- Service 2: Result Verification -->
            <div class="relative bg-gradient-to-b from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#F59E0A]/25 hover:border-[#F59E0A]/60 hover:shadow-2xl hover:shadow-red-950/40">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F59E0A] tracking-widest">02</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#FFFBEB] text-[#7F1E1D] border-2 border-[#F59E0A]/40 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-list-check"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Result Verification
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Check recent draw numbers and continue to winner status verification in a few clicks.
                    </p>
                </div>

                <a href="#" class="inline-flex items-center justify-center bg-[#F59E0A] hover:bg-[#EAB308] text-[#5C1110] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-amber-300/60 transform group-hover:scale-105">
                    Check results
                </a>
            </div>

            <!-- Service 3: Prize Claim Guidance -->
            <div class="relative bg-gradient-to-b from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#F59E0A]/25 hover:border-[#F59E0A]/60 hover:shadow-2xl hover:shadow-red-950/40">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F59E0A] tracking-widest">03</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#FFFBEB] text-[#7F1E1D] border-2 border-[#F59E0A]/40 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Prize Claim Guidance
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Understand ID, PAN, bank details and original ticket requirements before submitting a claim.
                    </p>
                </div>

                <a href="#" class="inline-flex items-center justify-center bg-[#F59E0A] hover:bg-[#EAB308] text-[#5C1110] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-amber-300/60 transform group-hover:scale-105">
                    Get support
                </a>
            </div>

            <!-- Service 4: Customer Help Desk -->
            <div class="relative bg-gradient-to-b from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#F59E0A]/25 hover:border-[#F59E0A]/60 hover:shadow-2xl hover:shadow-red-950/40">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F59E0A] tracking-widest">04</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#FFFBEB] text-[#7F1E1D] border-2 border-[#F59E0A]/40 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-headset"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Customer Help Desk
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Contact our support team for ticket, draw, claim, complaint or documentation questions.
                    </p>
                </div>

                <a href="#" class="inline-flex items-center justify-center bg-[#F59E0A] hover:bg-[#EAB308] text-[#5C1110] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-amber-300/60 transform group-hover:scale-105">
                    Contact desk
                </a>
            </div>

        </div>

    </div>
</section>

<!-- Recent Kerala Lottery Results Section (Auto-Scrolling Marquee) -->
<section class="relative bg-gradient-to-b from-[#1C0507] via-[#26070B] to-[#150305] py-14 lg:py-20 overflow-hidden border-t border-[#7F1E1D]/50 shadow-inner">
    <!-- Subtle Ambient Glows -->
    <div class="absolute -top-24 left-1/4 w-96 h-96 bg-[#7F1E1D]/25 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-1/4 w-96 h-96 bg-[#F59E0A]/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Subtitle pill / label -->
        <div class="flex items-center gap-2 mb-2.5">
            <span class="w-5 h-0.5 bg-[#F59E0A]"></span>
            <span class="text-[#F59E0A] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                PUBLISHED DRAW RECORDS
            </span>
        </div>

        <!-- Section Heading -->
        <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-serif font-bold text-white tracking-wide">
            Recent Kerala Lottery <span class="text-[#F59E0A]">Results</span>
        </h2>
        
        <p class="text-white/70 text-xs sm:text-sm mt-2 mb-8 sm:mb-10 max-w-xl font-normal">
            Latest draws published on the official Kerala LOTIS result board.
        </p>

        @php
            $drawResults = [
                ['code' => 'SM', 'date' => 'SUNDAY - 27 SEP 2026', 'name' => 'Samrudhi', 'draw' => 'SM-74'],
                ['code' => 'BR', 'date' => 'SATURDAY - 26 SEP 2026', 'name' => 'Thiruvonam Bumper', 'draw' => 'BR-111'],
                ['code' => 'SK', 'date' => 'FRIDAY - 25 SEP 2026', 'name' => 'Suvarna Keralam', 'draw' => 'SK-71'],
                ['code' => 'KN', 'date' => 'THURSDAY - 24 SEP 2026', 'name' => 'Karunya Plus', 'draw' => 'KN-642'],
                ['code' => 'FF', 'date' => 'WEDNESDAY - 23 SEP 2026', 'name' => 'Fifty Fifty', 'draw' => 'FF-115'],
                ['code' => 'SS', 'date' => 'TUESDAY - 22 SEP 2026', 'name' => 'Sthree Sakthi', 'draw' => 'SS-438'],
                ['code' => 'W',  'date' => 'MONDAY - 21 SEP 2026', 'name' => 'Win-Win', 'draw' => 'W-792'],
                ['code' => 'NR', 'date' => 'FRIDAY - 18 SEP 2026', 'name' => 'Nirmal', 'draw' => 'NR-398'],
            ];
        @endphp

        <!-- Auto Scrolling Track Container inside container -->
        <div class="relative w-full overflow-hidden marquee-container py-3">
            <!-- Smooth Edge Fade Masks -->
            <div class="absolute left-0 top-0 bottom-0 w-8 sm:w-16 bg-gradient-to-r from-[#1C0507] to-transparent z-20 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-8 sm:w-16 bg-gradient-to-l from-[#1C0507] to-transparent z-20 pointer-events-none"></div>

            <div class="marquee-track flex gap-5 sm:gap-6">
                <!-- First Loop Set -->
                @foreach($drawResults as $res)
                    <div class="w-72 sm:w-80 shrink-0 bg-gradient-to-b from-[#380D11] via-[#2A080C] to-[#1A0406] rounded-2xl p-5 sm:p-6 border border-[#7F1E1D]/60 hover:border-[#F59E0A]/60 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                        <!-- Subtle Card Top Lighting -->
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent pointer-events-none"></div>

                        <!-- Top Row (Badge + Published) -->
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <span class="bg-[#FEF3C7] text-[#7F1E1D] font-black text-xs px-2.5 py-1 rounded-md shadow-xs tracking-wider">
                                {{ $res['code'] }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#F59E0A] bg-black/40 border border-[#F59E0A]/20 px-2.5 py-0.5 rounded-full backdrop-blur-xs">
                                <i class="fa-solid fa-circle-check text-[10px] text-[#F59E0A]"></i> Published
                            </span>
                        </div>

                        <!-- Date -->
                        <div class="text-[11px] font-bold text-white/50 tracking-wider uppercase mb-1">
                            {{ $res['date'] }}
                        </div>

                        <!-- Scheme Name -->
                        <h3 class="text-base sm:text-lg font-bold text-white tracking-wide mb-4 group-hover:text-[#F59E0A] transition-colors">
                            {{ $res['name'] }}
                        </h3>

                        <!-- Bottom Row (Draw Number) -->
                        <div class="border-t border-white/10 pt-3 flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] font-bold text-white/50 tracking-widest uppercase">
                                DRAW NUMBER
                            </span>
                            <span class="text-sm sm:text-base font-black text-[#F59E0A] tracking-wide">
                                {{ $res['draw'] }}
                            </span>
                        </div>
                    </div>
                @endforeach

                <!-- Duplicate Set for Seamless Continuous Loop -->
                @foreach($drawResults as $res)
                    <div class="w-72 sm:w-80 shrink-0 bg-gradient-to-b from-[#380D11] via-[#2A080C] to-[#1A0406] rounded-2xl p-5 sm:p-6 border border-[#7F1E1D]/60 hover:border-[#F59E0A]/60 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                        <!-- Subtle Card Top Lighting -->
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent pointer-events-none"></div>

                        <!-- Top Row (Badge + Published) -->
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <span class="bg-[#FEF3C7] text-[#7F1E1D] font-black text-xs px-2.5 py-1 rounded-md shadow-xs tracking-wider">
                                {{ $res['code'] }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#F59E0A] bg-black/40 border border-[#F59E0A]/20 px-2.5 py-0.5 rounded-full backdrop-blur-xs">
                                <i class="fa-solid fa-circle-check text-[10px] text-[#F59E0A]"></i> Published
                            </span>
                        </div>

                        <!-- Date -->
                        <div class="text-[11px] font-bold text-white/50 tracking-wider uppercase mb-1">
                            {{ $res['date'] }}
                        </div>

                        <!-- Scheme Name -->
                        <h3 class="text-base sm:text-lg font-bold text-white tracking-wide mb-4 group-hover:text-[#F59E0A] transition-colors">
                            {{ $res['name'] }}
                        </h3>

                        <!-- Bottom Row (Draw Number) -->
                        <div class="border-t border-white/10 pt-3 flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] font-bold text-white/50 tracking-widest uppercase">
                                DRAW NUMBER
                            </span>
                            <span class="text-sm sm:text-base font-black text-[#F59E0A] tracking-wide">
                                {{ $res['draw'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Weekly Draw Schedule Section -->
<section class="relative bg-gradient-to-b from-[#FFFDF8] via-stone-50 to-[#FAF5EB] py-14 lg:py-20 overflow-hidden border-t border-stone-200/80">
    <!-- Subtle Background Accents -->
    <div class="absolute inset-0 pointer-events-none opacity-40" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header Row (Title on Left, Verification Badge on Right) -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-5 h-0.5 bg-[#7F1E1D]"></span>
                    <span class="text-[#7F1E1D] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        OFFICIAL WEEKLY CALENDAR
                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-gray-900 tracking-wide">
                    Weekly Draw <span class="text-[#7F1E1D]">Schedule</span>
                </h2>
                <p class="text-gray-600 text-xs sm:text-sm mt-2 max-w-xl font-normal">
                    Plan your week with the latest Kerala State Lotteries draw calendar.
                </p>
            </div>

            <!-- Verified from LOTIS Status Pill -->
            <div class="bg-white rounded-2xl p-3 sm:px-4 sm:py-3 shadow-md border border-stone-200/80 flex items-center gap-3 shrink-0 self-start md:self-auto">
                <div class="w-7 h-7 rounded-full bg-[#7F1E1D] text-[#F59E0A] flex items-center justify-center text-xs shadow-xs">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <span class="block text-[9px] uppercase tracking-widest font-bold text-gray-400">VERIFIED FROM LOTIS</span>
                    <span class="block text-xs font-bold text-gray-800">Updated {{ now()->format('d M Y, h:i A') }}</span>
                </div>
            </div>
        </div>

        @php
            $weeklySchedules = [
                ['day' => 'SUNDAY', 'code' => 'SM', 'name' => 'Samrudhi', 'time' => '3:00 PM'],
                ['day' => 'MONDAY', 'code' => 'BT', 'name' => 'Bhagyathara', 'time' => '3:00 PM'],
                ['day' => 'TUESDAY', 'code' => 'SS', 'name' => 'Sthree-Sakthi', 'time' => '3:00 PM'],
                ['day' => 'WEDNESDAY', 'code' => 'DL', 'name' => 'Dhanalekshmi', 'time' => '3:00 PM'],
                ['day' => 'THURSDAY', 'code' => 'KN', 'name' => 'Karunya Plus', 'time' => '3:00 PM'],
                ['day' => 'FRIDAY', 'code' => 'SK', 'name' => 'Suvarna Keralam', 'time' => '3:00 PM'],
                ['day' => 'SATURDAY', 'code' => 'KR', 'name' => 'Karunya', 'time' => '3:00 PM'],
            ];
        @endphp

        <!-- 7 Days Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3 sm:gap-4 lg:gap-3.5 xl:gap-4">
            @foreach($weeklySchedules as $schedule)
                @php
                    $isToday = ($schedule['day'] === 'SATURDAY');
                @endphp

                @if($isToday)
                    <!-- Active / Today Card -->
                    <div class="relative bg-gradient-to-b from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] rounded-2xl p-4 sm:p-5 text-white shadow-xl border-2 border-[#F59E0A]/60 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
                        <!-- TODAY Pill Badge -->
                        <span class="absolute top-2.5 right-2.5 bg-[#FDE68A] text-[#5C1110] font-black text-[9px] uppercase tracking-wider px-2 py-0.5 rounded-full shadow-xs">
                            TODAY
                        </span>

                        <div>
                            <!-- Top row with code badge -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-white text-[#7F1E1D] font-black text-xs flex items-center justify-center shadow-xs">
                                    {{ $schedule['code'] }}
                                </div>
                                <span class="text-[10px] font-bold text-white/50 tracking-wider mr-12">
                                    {{ $schedule['code'] }}
                                </span>
                            </div>

                            <span class="block text-[10px] font-bold text-amber-300 tracking-wider uppercase mb-1">
                                {{ $schedule['day'] }}
                            </span>

                            <h3 class="text-sm sm:text-base font-bold text-white tracking-wide mb-6">
                                {{ $schedule['name'] }}
                            </h3>
                        </div>

                        <!-- Draw Time Footer -->
                        <div class="border-t border-white/15 pt-2.5 flex items-center gap-1.5 text-white/90">
                            <i class="fa-regular fa-clock text-xs text-[#F59E0A]"></i>
                            <div class="text-[10px] sm:text-[11px] font-semibold leading-tight">
                                <span class="text-white/60 block text-[9px]">DRAW TIME</span>
                                <span class="text-white font-bold">{{ $schedule['time'] }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Regular Card -->
                    <div class="relative bg-white rounded-2xl p-4 sm:p-5 text-gray-800 shadow-sm hover:shadow-md border border-stone-200/80 hover:border-[#7F1E1D]/40 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
                        <div>
                            <!-- Top row with code badge -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-rose-50 text-[#7F1E1D] border border-rose-100 font-black text-xs flex items-center justify-center shadow-2xs">
                                    {{ $schedule['code'] }}
                                </div>
                                <span class="text-[10px] font-bold text-gray-400 tracking-wider">
                                    {{ $schedule['code'] }}
                                </span>
                            </div>

                            <span class="block text-[10px] font-bold text-[#7F1E1D] tracking-wider uppercase mb-1">
                                {{ $schedule['day'] }}
                            </span>

                            <h3 class="text-sm sm:text-base font-bold text-gray-900 tracking-wide mb-6 group-hover:text-[#7F1E1D] transition-colors">
                                {{ $schedule['name'] }}
                            </h3>
                        </div>

                        <!-- Draw Time Footer -->
                        <div class="border-t border-gray-100 pt-2.5 flex items-center gap-1.5 text-gray-600">
                            <i class="fa-regular fa-clock text-xs text-[#7F1E1D]/70"></i>
                            <div class="text-[10px] sm:text-[11px] font-semibold leading-tight">
                                <span class="text-gray-400 block text-[9px]">DRAW TIME</span>
                                <span class="text-gray-800 font-bold">{{ $schedule['time'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Special Draw Banner (Bottom Box) -->
        <div class="mt-6 bg-gradient-to-r from-[#601211] via-[#7F1E1D] to-[#991B1B] rounded-2xl p-5 sm:p-6 lg:p-7 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 border border-[#F59E0A]/30">
            <div class="flex items-center gap-4 sm:gap-6 w-full md:w-auto">
                <!-- Big Date Number -->
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-4xl sm:text-5xl font-black text-white leading-none font-serif">
                        28
                    </span>
                    <div class="text-[10px] font-black uppercase tracking-wider text-amber-300 leading-tight">
                        <span>NOV</span><br>
                        <span>2026</span>
                    </div>
                </div>

                <div class="w-px h-12 bg-white/20 hidden sm:block"></div>

                <!-- Info -->
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="bg-[#F59E0A]/20 text-[#F59E0A] border border-[#F59E0A]/30 text-[9px] font-black uppercase px-2 py-0.5 rounded tracking-widest">
                            SPECIAL DRAW
                        </span>
                    </div>
                    <h4 class="text-base sm:text-lg lg:text-xl font-bold text-white tracking-wide">
                        Pooja Bumper <span class="text-xs sm:text-sm font-semibold text-amber-200/90 ml-1">BR-112</span>
                    </h4>
                    <p class="text-xs sm:text-[13px] text-white/80 mt-1">
                        Saturday draw scheduled at 2:00 PM at Gorky Bhavan, Near Bakery Junction, Thiruvananthapuram.
                    </p>
                </div>
            </div>

            <!-- Action Button -->
            <div class="w-full md:w-auto shrink-0 flex justify-end">
                <a href="#" class="inline-flex items-center justify-center gap-2 bg-[#FDE68A] hover:bg-[#FBBF24] text-[#5C1110] font-black text-xs sm:text-sm px-6 py-3 rounded-xl shadow-md transition-all duration-300 hover:scale-105">
                    View results
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- Our Photos & Videos (Gallery Section) -->
<section class="relative bg-gradient-to-br from-[#7F1E1D] via-[#8E1B1A] to-[#5C1110] py-14 lg:py-20 overflow-hidden text-white border-t border-[#F59E0A]/20 shadow-inner">
    <!-- Subtle Theme Texture Pattern -->
    <div class="absolute inset-0 pointer-events-none opacity-20" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    
    <!-- Ambient Glows -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#F59E0A]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-black/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header Row -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 lg:mb-12">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-5 h-0.5 bg-[#F59E0A]"></span>
                    <span class="text-[#F59E0A] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        Gallery
                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-black text-white tracking-wide">
                    Our Photos &amp; Videos
                </h2>
            </div>
            
            <p class="text-white/80 text-xs sm:text-sm max-w-xs md:text-right font-normal leading-relaxed">
                Explore our latest events, activities and memorable moments.
            </p>
        </div>

        <!-- Gallery Grid (1 Large Left Feature + 2x2 Right Grid) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-stretch">
            
            <!-- Left Large Feature Card (7 cols on lg) -->
            <div class="lg:col-span-7">
                <div class="relative w-full h-[320px] sm:h-[400px] lg:h-full min-h-[350px] rounded-2xl overflow-hidden shadow-2xl group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-1.jpg') }}" alt="Latest Kerala Lottery Event" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-black/15 pointer-events-none"></div>
                    
                    <!-- Tag Badge -->
                    <div class="absolute bottom-4 left-4 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-xs font-semibold px-4 py-1.5 rounded-full border border-white/20 shadow-md">
                            Latest Event
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right 2x2 Cards Grid (5 cols on lg) -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4 sm:gap-5">
                
                <!-- Card 1: Events -->
                <div class="relative h-44 sm:h-48 lg:h-52 rounded-2xl overflow-hidden shadow-xl group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-2.jpg') }}" alt="Lottery Events" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[11px] font-semibold px-3 py-1 rounded-full border border-white/20 shadow-sm">
                            Events
                        </span>
                    </div>
                </div>

                <!-- Card 2: Updates -->
                <div class="relative h-44 sm:h-48 lg:h-52 rounded-2xl overflow-hidden shadow-xl group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-3.jpg') }}" alt="Prize Distribution Updates" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[11px] font-semibold px-3 py-1 rounded-full border border-white/20 shadow-sm">
                            Updates
                        </span>
                    </div>
                </div>

                <!-- Card 3: Activities -->
                <div class="relative h-44 sm:h-48 lg:h-52 rounded-2xl overflow-hidden shadow-xl group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-4.jpg') }}" alt="Lottery Draw Activities" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[11px] font-semibold px-3 py-1 rounded-full border border-white/20 shadow-sm">
                            Activities
                        </span>
                    </div>
                </div>

                <!-- Card 4: Highlights -->
                <div class="relative h-44 sm:h-48 lg:h-52 rounded-2xl overflow-hidden shadow-xl group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-5.jpg') }}" alt="Ceremony Highlights" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[11px] font-semibold px-3 py-1 rounded-full border border-white/20 shadow-sm">
                            Highlights
                        </span>
                    </div>
                </div>

            </div>

        </div>

        <!-- View Full Gallery CTA Button -->
        <div class="text-center mt-10 sm:mt-12">
            <a href="#" class="inline-flex items-center justify-center gap-2 bg-[#F59E0A] hover:bg-[#FBBF24] text-[#5C1110] font-black text-xs sm:text-sm px-8 py-3.5 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                View Full Gallery
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

@endsection
