@extends('frontend.layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[600px] lg:min-h-[700px] flex items-center pt-10 pb-32 lg:pb-40 bg-gray-900 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/slide-1.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 via-gray-900/70 to-transparent"></div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Content -->
            <div class="text-white max-w-2xl">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2 h-2 rounded-full bg-[#dca424]"></span>
                    <span class="text-[#dca424] font-bold text-sm tracking-widest uppercase">Trusted Maharaja Lottery Assistance</span>
                </div>
                
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-serif mb-6 leading-tight text-white">
                    Maharaja Lottery<br>
                    <span class="text-white">Tickets, Results &</span><br>
                    <span class="text-[#dca424]">Support</span>
                </h2>
                
                <p class="text-gray-200 text-base md:text-lg mb-8 max-w-lg leading-relaxed">
                    Explore current ticket availability, follow verified draw updates and receive clear guidance for winner verification and prize claims.
                </p>
                
                <div class="flex flex-wrap items-center gap-4 mb-10">
                    <a href="#" class="bg-[#931c4b] hover:bg-[#7a163e] text-white px-6 py-3.5 rounded-md font-semibold transition flex items-center gap-2 shadow-lg group">
                        Book Tickets 
                        <i class="fa-solid fa-arrow-right-long text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#" class="border border-white hover:bg-white/10 text-white px-6 py-3.5 rounded-md font-semibold transition flex items-center gap-2">
                        View Results
                    </a>
                    <a href="#" class="text-white hover:text-[#25D366] transition flex items-center gap-2 font-medium px-2 underline underline-offset-4 decoration-white/50">
                        <i class="fa-brands fa-whatsapp text-lg"></i> Get WhatsApp Assistance
                    </a>
                </div>
                
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-gray-300">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-[#dca424]"></i> Transparent booking support
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-[#dca424]"></i> Verified result references
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-[#dca424]"></i> Step-by-step claim guidance
                    </div>
                </div>
            </div>

            <!-- Right Content (Card) -->
            <div class="hidden lg:flex justify-center items-center">
                <div class="relative w-96 h-64 bg-[#931c4b] rounded-xl border-[6px] border-[#dca424] shadow-2xl p-6 flex flex-col justify-center items-center text-center transform rotate-2 hover:rotate-0 transition-transform duration-500">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 rounded-lg"></div>
                    <i class="fa-solid fa-crown text-6xl text-[#dca424] mb-4 drop-shadow-md"></i>
                    <h3 class="text-3xl font-black text-white uppercase tracking-widest drop-shadow-md">Maharaja</h3>
                    <h4 class="text-xl font-bold text-[#dca424] uppercase tracking-wider mt-1 drop-shadow-md">State Lottery</h4>
                    <p class="text-white/80 text-sm mt-3 font-medium">Verified & Trusted</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Current Sessions (Below Section) -->
<section class="relative z-20 -mt-16 md:-mt-20 container mx-auto px-4 lg:px-8 mb-20">
    <div class="bg-white rounded-xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.3)] flex flex-col md:flex-row overflow-hidden border border-gray-100">
        
        <!-- Left Banner -->
        <div class="bg-[#931c4b] text-white p-6 md:w-56 shrink-0 flex md:flex-col items-center md:items-start justify-center md:justify-center gap-4 relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 opacity-10">
                <i class="fa-solid fa-ticket text-6xl"></i>
            </div>
            <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm z-10">
                <i class="fa-solid fa-ticket-simple text-2xl text-[#dca424]"></i>
            </div>
            <div class="z-10">
                <p class="text-[#dca424] text-xs font-bold uppercase tracking-wider mb-1">Live Lottery</p>
                <h4 class="text-xl md:text-2xl font-bold leading-tight">Current<br class="hidden md:block"> Sessions</h4>
            </div>
        </div>

        <!-- Scrollable Cards -->
        <div class="flex-1 overflow-x-auto py-4 px-2 hide-scroll">
            <div class="flex items-center min-w-max">
                
                <!-- Session 1 -->
                <div class="group px-4 md:px-6 py-2 border-r border-gray-100 last:border-0 hover:bg-gray-50 transition cursor-pointer min-w-[280px]">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-[#931c4b] transition">Samrudhi - Every Sunday</p>
                        <i class="fa-solid fa-arrow-right text-gray-300 text-xs group-hover:text-[#dca424] transition"></i>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-rose-50 text-[#931c4b] w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg group-hover:bg-[#931c4b] group-hover:text-white transition">
                            01
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 text-base group-hover:text-[#931c4b] transition">Samrudhi - Every Sunday</h5>
                            <p class="text-sm font-medium text-gray-500 mt-0.5"><span class="text-[#931c4b] font-bold">₹50</span> <span class="text-xs">per ticket</span></p>
                        </div>
                    </div>
                </div>

                <!-- Session 2 -->
                <div class="group px-4 md:px-6 py-2 border-r border-gray-100 last:border-0 hover:bg-gray-50 transition cursor-pointer min-w-[280px]">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-[#931c4b] transition">Bhagyathara - Every Monday</p>
                        <i class="fa-solid fa-arrow-right text-gray-300 text-xs group-hover:text-[#dca424] transition"></i>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-rose-50 text-[#931c4b] w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg group-hover:bg-[#931c4b] group-hover:text-white transition">
                            02
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 text-base group-hover:text-[#931c4b] transition">Bhagyathara - Every Monday</h5>
                            <p class="text-sm font-medium text-gray-500 mt-0.5"><span class="text-[#931c4b] font-bold">₹50</span> <span class="text-xs">per ticket</span></p>
                        </div>
                    </div>
                </div>

                <!-- Session 3 -->
                <div class="group px-4 md:px-6 py-2 border-r border-gray-100 last:border-0 hover:bg-gray-50 transition cursor-pointer min-w-[280px]">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-[#931c4b] transition">Sthree Sakthi - Every Tuesday</p>
                        <i class="fa-solid fa-arrow-right text-gray-300 text-xs group-hover:text-[#dca424] transition"></i>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-rose-50 text-[#931c4b] w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg group-hover:bg-[#931c4b] group-hover:text-white transition">
                            03
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 text-base group-hover:text-[#931c4b] transition">Sthree Sakthi - Every Tuesday</h5>
                            <p class="text-sm font-medium text-gray-500 mt-0.5"><span class="text-[#931c4b] font-bold">₹50</span> <span class="text-xs">per ticket</span></p>
                        </div>
                    </div>
                </div>

                <!-- Session 4 -->
                <div class="group px-4 md:px-6 py-2 border-r border-gray-100 last:border-0 hover:bg-gray-50 transition cursor-pointer min-w-[280px]">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-[#931c4b] transition">Dhanalekshmi - Wednesday</p>
                        <i class="fa-solid fa-arrow-right text-gray-300 text-xs group-hover:text-[#dca424] transition"></i>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-rose-50 text-[#931c4b] w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg group-hover:bg-[#931c4b] group-hover:text-white transition">
                            04
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 text-base group-hover:text-[#931c4b] transition">Dhanalekshmi - Wednesday</h5>
                            <p class="text-sm font-medium text-gray-500 mt-0.5"><span class="text-[#931c4b] font-bold">₹50</span> <span class="text-xs">per ticket</span></p>
                        </div>
                    </div>
                </div>

                <!-- Session 5 -->
                <div class="group px-4 md:px-6 py-2 border-r border-gray-100 last:border-0 hover:bg-gray-50 transition cursor-pointer min-w-[280px]">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider group-hover:text-[#931c4b] transition">Karunya Plus - Thursday</p>
                        <i class="fa-solid fa-arrow-right text-gray-300 text-xs group-hover:text-[#dca424] transition"></i>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="bg-rose-50 text-[#931c4b] w-10 h-10 rounded-lg flex items-center justify-center font-bold text-lg group-hover:bg-[#931c4b] group-hover:text-white transition">
                            05
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 text-base group-hover:text-[#931c4b] transition">Karunya Plus - Thursday</h5>
                            <p class="text-sm font-medium text-gray-500 mt-0.5"><span class="text-[#931c4b] font-bold">₹50</span> <span class="text-xs">per ticket</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
