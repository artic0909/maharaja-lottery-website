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
        animation: marquee-scroll 12s linear infinite;
    }
    .marquee-container:hover .marquee-track {
        animation-play-state: paused;
    }
</style>

<!-- Hero Section & Current Sessions Container -->
<section class="relative min-h-auto lg:min-h-[calc(100dvh-75px)] flex flex-col justify-between bg-zinc-900 overflow-hidden pt-4 sm:pt-6 lg:pt-0">
    <!-- Background Image with Lowest Darkness Overlay -->
    <div class="absolute inset-0 z-0">
        @php
            $heroBanner = setting('hero_banner_image');
            $heroBannerSrc = ($heroBanner && file_exists(public_path($heroBanner))) 
                ? asset($heroBanner) 
                : asset('img/slide-1.jpg');
        @endphp
        <img src="{{ $heroBannerSrc }}" alt="Maharaja Lottery Banner" class="w-full h-full object-cover opacity-95">
        <!-- Minimal subtle darkness overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/55 via-black/30 to-black/10"></div>
    </div>

    <!-- Main Hero Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full flex-1 flex items-center py-6 lg:py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center w-full">
            
            <!-- Left Content (7 cols on lg) -->
            <div class="text-white max-w-2xl lg:col-span-7 drop-shadow-sm">
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-2 h-2 rounded-full bg-[#DFB755] animate-pulse"></span>
                    <span class="text-[#F5D77F] font-bold text-xs tracking-widest uppercase bg-black/40 px-2 py-0.5 rounded-sm backdrop-blur-xs border border-[#DFB755]/30">Trusted Maharaja Lottery Assistance</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-5xl xl:text-[54px] font-serif mb-4 lg:mb-5 leading-[1.15] text-white drop-shadow-md">
                    {{ setting('hero_title', 'Maharaja Lottery') }}<br>
                    <span class="text-[#F5D77F]">{{ setting('hero_subtitle', 'Tickets, Results & Support') }}</span>
                </h2>
                
                <p class="text-white text-xs sm:text-sm md:text-base mb-6 max-w-xl leading-relaxed drop-shadow-sm bg-black/25 p-3 rounded-lg backdrop-blur-xs border border-white/10">
                    {{ setting('hero_description', 'Explore current ticket availability, follow verified draw updates and receive clear guidance for winner verification and prize claims.') }}
                </p>
                
                <div class="flex flex-wrap items-center gap-2.5 sm:gap-4 mb-6">
                    <a href="{{ route('ticket.booking') }}" class="bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:via-[#16A34A] hover:to-[#14532D] text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-lg font-black text-xs sm:text-sm tracking-wide transition-all duration-200 flex items-center gap-2.5 shadow-xl shadow-emerald-600/40 hover:shadow-emerald-500/60 border border-emerald-300/60 hover:scale-105 transform group">
                        <i class="fa-solid fa-ticket-simple text-xs text-emerald-100 group-hover:rotate-12 transition-transform"></i>
                        <span>Book Tickets</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform text-emerald-100"></i>
                    </a>
                    <a href="{{ route('winnerlist') }}" class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] px-4 sm:px-5 py-2.5 sm:py-3 rounded-md font-black text-xs sm:text-sm transition flex items-center gap-2 shadow-md border border-[#FFE8A2]/80">
                        View Results
                    </a>
                    <a href="{{ setting('social_whatsapp', 'https://wa.me/918743978796') }}" target="_blank" class="text-white hover:text-[#25D366] transition flex items-center gap-2 font-medium text-xs sm:text-sm px-2 py-1 rounded-md bg-black/30 backdrop-blur-xs underline underline-offset-4 decoration-white/40">
                        <i class="fa-brands fa-whatsapp text-base sm:text-lg text-[#25D366]"></i> Get WhatsApp Assistance
                    </a>
                </div>
                
                <div class="flex flex-wrap items-center gap-x-4 sm:gap-x-5 gap-y-2 text-xs sm:text-sm text-white font-medium">
                    <div class="flex items-center gap-1.5 bg-black/35 px-2.5 py-1 rounded-md backdrop-blur-xs text-[11px] sm:text-xs">
                        <i class="fa-solid fa-check text-[#DFB755] text-xs"></i> Transparent booking support
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/35 px-2.5 py-1 rounded-md backdrop-blur-xs text-[11px] sm:text-xs">
                        <i class="fa-solid fa-check text-[#DFB755] text-xs"></i> Verified result references
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/35 px-2.5 py-1 rounded-md backdrop-blur-xs text-[11px] sm:text-xs">
                        <i class="fa-solid fa-check text-[#DFB755] text-xs"></i> Step-by-step claim guidance
                    </div>
                </div>
            </div>

            <!-- Right Content (5 cols on lg) -->
            <div class="hidden lg:flex justify-center items-center lg:col-span-5">
                <div class="relative w-80 xl:w-96 h-56 xl:h-64 bg-linear-to-br from-[#071533]/95 via-[#0B193E]/95 to-[#040A1A]/95 backdrop-blur-xs rounded-xl border-[4px] border-[#DFB755] shadow-2xl p-6 flex flex-col justify-center items-center text-center transform hover:scale-[1.02] transition-transform duration-300">
                    <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:12px_12px] opacity-10 rounded-lg"></div>
                    <i class="fa-solid fa-crown text-5xl xl:text-6xl text-[#F5D77F] mb-3 drop-shadow-md"></i>
                    <h3 class="text-2xl xl:text-3xl font-black text-white uppercase tracking-widest drop-shadow-md">Maharaja</h3>
                    <h4 class="text-lg xl:text-xl font-bold text-[#F5D77F] uppercase tracking-wider mt-0.5 drop-shadow-md">State Lottery</h4>
                    <p class="text-white/90 text-xs mt-2.5 font-medium">Verified &amp; Trusted Support</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Current Sessions (Auto Smooth Scrolling Bar) -->
    <div class="relative z-20 container mx-auto px-4 lg:px-8 pb-3 lg:pb-5">
        <div class="bg-white rounded-xl shadow-[0_8px_30px_rgba(0,0,0,0.18)] flex flex-col md:flex-row overflow-hidden border border-[#DFB755]/30 p-1.5 gap-1.5">
            
            <!-- Left Banner with Right Arrow Pointer -->
            <div class="bg-linear-to-br from-[#071533] to-[#0F2356] text-white px-4 py-2.5 md:w-48 shrink-0 flex items-center gap-3 rounded-lg relative overflow-visible z-20 shadow-xs">
                <!-- Arrow Tip Pointing Right -->
                <div class="hidden md:block absolute top-1/2 -translate-y-1/2 -right-2 w-0 h-0 border-y-[7px] border-y-transparent border-l-[8px] border-l-[#0F2356] z-30"></div>
                
                <div class="bg-white/15 p-2 rounded-lg backdrop-blur-sm shrink-0 flex items-center justify-center border border-[#DFB755]/30">
                    <i class="fa-solid fa-ticket text-lg text-[#F5D77F]"></i>
                </div>
                <div class="leading-tight">
                    <p class="text-[#F5D77F] text-[9px] font-bold uppercase tracking-wider">Live Lottery</p>
                    <h4 class="text-sm md:text-base font-bold text-white">Current<br class="hidden md:block"> Sessions</h4>
                </div>
            </div>

            <!-- Auto Scrolling Smooth Marquee Container -->
            <div class="flex-1 overflow-hidden marquee-container relative flex items-center">
                <div class="marquee-track flex items-center gap-2 py-0.5">
                    
                    @php
                        $priceChartCtrl = new \App\Http\Controllers\Admin\TicketPriceChartController();
                        $adminCharts = $priceChartCtrl->getCharts();
                        $activeCharts = array_filter($adminCharts, fn($c) => ($c['status'] ?? 'Active') === 'Active');
                        $chartList = !empty($activeCharts) ? array_values($activeCharts) : $adminCharts;

                        $sessions = [];
                        foreach ($chartList as $cIdx => $c) {
                            $priceText = $c['price'] ?? ('₹' . ($c['price_num'] ?? 40));
                            if (is_numeric($priceText)) {
                                $priceText = '₹' . $priceText;
                            } elseif (str_starts_with($priceText, 'Rs.')) {
                                $priceText = str_replace('Rs.', '₹', $priceText);
                            }
                            $prefix = !empty($c['series']) ? $c['series'] : (!empty($c['prefix']) ? $c['prefix'] : 'MH');
                            $sessions[] = [
                                'num' => str_pad((string)($cIdx + 1), 2, '0', STR_PAD_LEFT),
                                'name' => $c['name'] ?? 'Maharaja Lottery',
                                'prefix' => $prefix,
                                'price' => $priceText,
                            ];
                        }

                        // Fallback if empty
                        if (empty($sessions)) {
                            $sessions = [
                                ['num' => '01', 'name' => 'Maharaja 500', 'prefix' => 'MH', 'price' => '₹40'],
                                ['num' => '02', 'name' => 'Rajshree 200', 'prefix' => 'RM', 'price' => '₹149'],
                                ['num' => '03', 'name' => 'Rajshree 50', 'prefix' => 'VM', 'price' => '₹249'],
                            ];
                        }
                    @endphp

                    <!-- Loop 1 -->
                    @foreach($sessions as $sess)
                        <a href="{{ route('ticket.booking') }}" class="bg-white rounded-lg border border-slate-200 shadow-2xs hover:shadow-xs hover:border-[#0B193E]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0 no-underline text-inherit">
                            <div class="bg-[#e6eef9] text-[#0B193E] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#0B193E] group-hover:text-[#F5D77F] transition shrink-0">
                                {{ $sess['num'] }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-wide truncate group-hover:text-[#0B193E] transition">Prefix: {{ $sess['prefix'] }}</p>
                                <div class="flex items-center justify-between gap-1">
                                    <h5 class="font-bold text-slate-900 text-xs truncate group-hover:text-[#0B193E] transition">{{ $sess['name'] }}</h5>
                                    <i class="fa-solid fa-arrow-right text-[9px] text-[#DFB755] shrink-0"></i>
                                </div>
                                <p class="text-[10px] font-medium text-slate-500"><span class="text-[#0B193E] font-bold">{{ $sess['price'] }}</span> per ticket</p>
                            </div>
                        </a>
                    @endforeach

                    <!-- Loop 2 Duplicate for continuous infinite smooth loop -->
                    @foreach($sessions as $sess)
                        <a href="{{ route('ticket.booking') }}" class="bg-white rounded-lg border border-slate-200 shadow-2xs hover:shadow-xs hover:border-[#0B193E]/40 px-3 py-1.5 flex items-center gap-2.5 min-w-[245px] transition-all cursor-pointer group shrink-0 no-underline text-inherit">
                            <div class="bg-[#e6eef9] text-[#0B193E] w-7 h-7 rounded-md flex items-center justify-center font-bold text-xs group-hover:bg-[#0B193E] group-hover:text-[#F5D77F] transition shrink-0">
                                {{ $sess['num'] }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-wide truncate group-hover:text-[#0B193E] transition">Prefix: {{ $sess['prefix'] }}</p>
                                <div class="flex items-center justify-between gap-1">
                                    <h5 class="font-bold text-slate-900 text-xs truncate group-hover:text-[#0B193E] transition">{{ $sess['name'] }}</h5>
                                    <i class="fa-solid fa-arrow-right text-[9px] text-[#DFB755] shrink-0"></i>
                                </div>
                                <p class="text-[10px] font-medium text-slate-500"><span class="text-[#0B193E] font-bold">{{ $sess['price'] }}</span> per ticket</p>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<!-- About / Information & Management System Section -->
<section class="relative bg-gradient-to-r from-slate-50 via-white to-slate-100 py-10 sm:py-12 lg:py-16 overflow-hidden border-t border-slate-200/60">
    <!-- Subtle Background Geometric Shape Accent -->
    <div class="absolute inset-0 opacity-40 pointer-events-none bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-amber-500/5 to-transparent pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Text Content (7 cols on lg) -->
            <div class="lg:col-span-7">
                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-black tracking-wider text-[#0B193E] mb-2 drop-shadow-xs">
                    MAHARAJA
                </h2>
                
                <h3 class="italic text-[#14327A] text-base sm:text-xl lg:text-2xl font-medium tracking-wide mb-4 sm:mb-6">
                    Lottery Information & Management System
                </h3>
                
                <p class="text-[#0B193E] font-bold text-xs sm:text-base lg:text-[17px] leading-relaxed max-w-2xl">
                    MAHARAJA - Lottery Information & Management System is a digital tool for Digital Transformation in State Lotteries Department. MAHARAJA is a Web enabled Cloud Based open solution for supply chain management activities of the lottery department. This provides end to end solution to the agents and public.
                </p>

                <div class="mt-6 flex flex-wrap items-center gap-3 sm:gap-4">
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-2 bg-[#0B193E] hover:bg-[#071533] text-white px-4 sm:px-5 py-2.5 rounded-md font-semibold text-xs sm:text-sm transition shadow-md shadow-black/20 border border-[#DFB755]/40 group">
                        Learn More 
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform text-[#F5D77F]"></i>
                    </a>
                    <a href="tel:8743978796" class="inline-flex items-center gap-2 text-[#0B193E] hover:text-[#14327A] font-bold text-xs sm:text-sm px-3 py-2 transition">
                        <i class="fa-solid fa-phone text-[#DFB755]"></i> Agent Support Desk
                    </a>
                </div>
            </div>

            <!-- Right Image Content (5 cols on lg) -->
            <div class="lg:col-span-5 flex justify-center lg:justify-end items-center">
                <div class="relative group">
                    <img src="{{ asset('img/agent-bg.png') }}" alt="Maharaja Lottery Agent & System" class="w-auto max-h-[260px] sm:max-h-[380px] lg:max-h-[440px] object-contain drop-shadow-xl transition-transform duration-500 group-hover:scale-105">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Welcome / State Lotteries Overview Section -->
<section class="relative bg-cover bg-center py-12 sm:py-16 lg:py-24 text-white overflow-hidden shadow-inner" style="background-image: url('{{ asset('img/kerala-lottery-bg.jpg') }}');">
    <!-- Overlay for optimal contrast and readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-sky-950/60 to-slate-900/50 pointer-events-none"></div>
    <div class="absolute inset-0 bg-black/20 pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left Info Content (7 cols on lg) -->
            <div class="lg:col-span-7 space-y-4">
                <div>
                    <span class="block text-xs sm:text-base font-medium text-white/90 tracking-wider font-sans">
                        Welcome To
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-serif font-bold text-white tracking-wide mt-1 drop-shadow-md">
                        Maharaja Lotteries
                    </h2>
                </div>

                <div class="border-l-[3px] border-[#DFB755] pl-3.5 sm:pl-6 py-1 my-4 sm:my-6">
                    <p class="text-xs sm:text-sm lg:text-[15px] leading-relaxed text-white/95 font-normal drop-shadow-sm max-w-2xl">
                        Kerala, the Gods own country, added another first to its cap in 1967, when a Department was setup in the Government sector for the first time in India for the conduct of paper Lotteries . It was late Shri. P. K. Kunju Sahib, who envisaged this idea for the generation of revenue through the sale of lotteries and for providing a stable source of income to the poor and needy belonging to the marginalized section of society.
                    </p>
                </div>

                <div class="pt-2">
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center px-5 sm:px-6 py-2 sm:py-2.5 border-2 border-[#DFB755] text-white font-medium text-xs sm:text-sm hover:bg-[#DFB755] hover:text-[#071533] transition-all duration-300 shadow-md backdrop-blur-xs bg-black/25">
                        Read More
                    </a>
                </div>
            </div>

            <!-- Right Officials / Dignitaries Grid (5 cols on lg) -->
            <div class="lg:col-span-5 flex flex-col items-center justify-center mt-4 lg:mt-0">
                <div class="w-full max-w-md space-y-4 sm:space-y-6">
                    
                    <!-- Top / Chief Minister & Minister for Finance -->
                    <div class="flex flex-col items-center text-center group">
                        <div class="bg-white p-1 rounded-xl shadow-2xl border border-white/60 w-24 h-28 sm:w-32 sm:h-36 overflow-hidden transform transition duration-300 group-hover:scale-105 group-hover:shadow-amber-400/20">
                            <img src="{{ asset('img/satheesan.jpg') }}" alt="Shri. V D Satheesan" class="w-full h-full object-cover object-top rounded-lg">
                        </div>
                        <h4 class="mt-2 text-xs sm:text-sm font-bold text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] tracking-wide">
                            Shri. V D Satheesan
                        </h4>
                        <p class="text-[10px] sm:text-xs text-[#F5D77F] font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] max-w-[240px]">
                            Hon'ble Chief Minister &amp; Minister for Finance
                        </p>
                    </div>

                    <!-- Bottom Row / Secretary & Director -->
                    <div class="grid grid-cols-2 gap-3 sm:gap-6 pt-1">
                        
                        <!-- Secretary -->
                        <div class="flex flex-col items-center text-center group">
                            <div class="bg-white p-1 rounded-xl shadow-2xl border border-white/60 w-24 h-28 sm:w-32 sm:h-36 mx-auto overflow-hidden transform transition duration-300 group-hover:scale-105 group-hover:shadow-amber-400/20">
                                <img src="{{ asset('img/jyothilal.jpg') }}" alt="Shri. K R Jyothilal IAS" class="w-full h-full object-cover object-top rounded-lg">
                            </div>
                            <h4 class="mt-2 text-xs sm:text-sm font-bold text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] tracking-wide">
                                Shri. K R Jyothilal IAS
                            </h4>
                            <p class="text-[10px] sm:text-xs text-[#F5D77F] font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] max-w-[190px]">
                                Addl.Chief Secretary, Taxes Department
                            </p>
                        </div>

                        <!-- Director -->
                        <div class="flex flex-col items-center text-center group">
                            <div class="bg-white p-1 rounded-xl shadow-2xl border border-white/60 w-24 h-28 sm:w-32 sm:h-36 mx-auto overflow-hidden transform transition duration-300 group-hover:scale-105 group-hover:shadow-amber-400/20">
                                <img src="{{ asset('img/anju.jpg') }}" alt="Anju K. S. IAS" class="w-full h-full object-cover object-top rounded-lg">
                            </div>
                            <h4 class="mt-2 text-xs sm:text-sm font-bold text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] tracking-wide">
                                Anju K. S. IAS
                            </h4>
                            <p class="text-[10px] sm:text-xs text-[#F5D77F] font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] max-w-[190px]">
                                Director, Lotteries Department
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
                                Anju K. S. IAS
                            </h4>
                            <p class="text-[10px] sm:text-xs text-amber-200 font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.95)] max-w-[190px]">
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
<section class="relative bg-gradient-to-b from-white via-slate-50 to-slate-100 py-14 lg:py-20 overflow-hidden border-t border-slate-200">
    <!-- Repeating Lottery Motif Background Pattern -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    
    <!-- Subtle Golden & Royal Navy Radial Glows for Depth -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#0B193E]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center mb-10 lg:mb-14">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black tracking-wider text-[#0B193E] uppercase drop-shadow-xs">
                POPULAR SERVICES
            </h2>
            <div class="w-20 h-1 bg-[#DFB755] mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- Services 4-Column Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-6 xl:gap-8 max-w-7xl mx-auto">
            
            <!-- Service 1: Ticket Booking Support -->
            <div class="relative bg-gradient-to-b from-[#0F2356] via-[#0A193E] to-[#040A1A] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#DFB755]/30 hover:border-[#DFB755]/80 hover:shadow-2xl hover:shadow-black/50">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F5D77F] tracking-widest">01</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#040A1A] text-[#F5D77F] border-2 border-[#DFB755]/50 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-ticket-simple"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Ticket Booking Support
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Get assistance for available Maharaja weekly lottery schemes and booking confirmation.
                    </p>
                </div>

                <a href="{{ route('ticket.booking') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-[#FFE8A2]/80 transform group-hover:scale-105">
                    Ticket Booking
                </a>
            </div>

            <!-- Service 2: Result Verification -->
            <div class="relative bg-gradient-to-b from-[#0F2356] via-[#0A193E] to-[#040A1A] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#DFB755]/30 hover:border-[#DFB755]/80 hover:shadow-2xl hover:shadow-black/50">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F5D77F] tracking-widest">02</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#040A1A] text-[#F5D77F] border-2 border-[#DFB755]/50 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-list-check"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Result Verification
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Check recent draw numbers and continue to winner status verification in a few clicks.
                    </p>
                </div>

                <a href="{{ route('winnerlist') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-[#FFE8A2]/80 transform group-hover:scale-105">
                    Check results
                </a>
            </div>

            <!-- Service 3: Prize Claim Guidance -->
            <div class="relative bg-gradient-to-b from-[#0F2356] via-[#0A193E] to-[#040A1A] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#DFB755]/30 hover:border-[#DFB755]/80 hover:shadow-2xl hover:shadow-black/50">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F5D77F] tracking-widest">03</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#040A1A] text-[#F5D77F] border-2 border-[#DFB755]/50 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Prize Claim Guidance
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Understand ID, PAN, bank details and original ticket requirements before submitting a claim.
                    </p>
                </div>

                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-[#FFE8A2]/80 transform group-hover:scale-105">
                    Get support
                </a>
            </div>

            <!-- Service 4: Customer Help Desk -->
            <div class="relative bg-gradient-to-b from-[#0F2356] via-[#0A193E] to-[#040A1A] rounded-xl p-6 sm:p-7 text-white shadow-xl flex flex-col justify-between items-center text-center overflow-hidden group hover:-translate-y-1.5 transition-all duration-300 border border-[#DFB755]/30 hover:border-[#DFB755]/80 hover:shadow-2xl hover:shadow-black/50">
                <!-- Faceted Lighting Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/15 via-transparent to-black/30 pointer-events-none"></div>
                
                <!-- Number -->
                <span class="absolute top-3.5 left-4 text-xs font-black text-[#F5D77F] tracking-widest">04</span>

                <div class="w-full flex flex-col items-center">
                    <!-- Icon Circle -->
                    <div class="w-14 h-14 rounded-full bg-[#040A1A] text-[#F5D77F] border-2 border-[#DFB755]/50 flex items-center justify-center text-xl shadow-md mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-headset"></i>
                    </div>

                    <h3 class="text-base sm:text-lg font-bold text-white mb-2.5 tracking-wide">
                        Customer Help Desk
                    </h3>

                    <p class="text-xs sm:text-[13px] text-white/90 leading-relaxed mb-6 font-normal min-h-[52px]">
                        Contact our support team for ticket, draw, claim, complaint or documentation questions.
                    </p>
                </div>

                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 border border-[#FFE8A2]/80 transform group-hover:scale-105">
                    Contact desk
                </a>
            </div>

        </div>

    </div>
</section>

<!-- Recent Maharaja Lottery Results Section (Auto-Scrolling Marquee) -->
<section class="relative bg-gradient-to-b from-[#040A1A] via-[#071533] to-[#040A1A] py-14 lg:py-20 overflow-hidden border-t border-[#0F2356] shadow-inner">
    <!-- Subtle Ambient Glows -->
    <div class="absolute -top-24 left-1/4 w-96 h-96 bg-[#0F2356]/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 right-1/4 w-96 h-96 bg-[#DFB755]/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Subtitle pill / label -->
        <div class="flex items-center gap-2 mb-2.5">
            <span class="w-5 h-0.5 bg-[#DFB755]"></span>
            <span class="text-[#F5D77F] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                PUBLISHED DRAW RECORDS
            </span>
        </div>

        <!-- Section Heading -->
        <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-serif font-bold text-white tracking-wide">
            Recent Maharaja Lottery <span class="text-[#F5D77F]">Results</span>
        </h2>
        
        <p class="text-white/70 text-xs sm:text-sm mt-2 mb-8 sm:mb-10 max-w-xl font-normal">
            Latest draws published on the official Maharaja LOTIS result board.
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
            <div class="marquee-track flex gap-5 sm:gap-6">
                <!-- First Loop Set -->
                @foreach($drawResults as $res)
                    <div class="w-72 sm:w-80 shrink-0 bg-gradient-to-b from-[#0F2356] via-[#0A193E] to-[#06102B] rounded-2xl p-5 sm:p-6 border border-[#163275] hover:border-[#DFB755]/70 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                        <!-- Subtle Card Top Lighting -->
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent pointer-events-none"></div>

                        <!-- Top Row (Badge + Published) -->
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <span class="bg-[#FCF9EE] text-[#071533] font-black text-xs px-2.5 py-1 rounded-md shadow-xs tracking-wider border border-[#DFB755]/40">
                                {{ $res['code'] }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#F5D77F] bg-black/40 border border-[#DFB755]/30 px-2.5 py-0.5 rounded-full backdrop-blur-xs">
                                <i class="fa-solid fa-circle-check text-[10px] text-[#DFB755]"></i> Published
                            </span>
                        </div>

                        <!-- Date -->
                        <div class="text-[11px] font-bold text-white/50 tracking-wider uppercase mb-1">
                            {{ $res['date'] }}
                        </div>

                        <!-- Scheme Name -->
                        <h3 class="text-base sm:text-lg font-bold text-white tracking-wide mb-4 group-hover:text-[#F5D77F] transition-colors">
                            {{ $res['name'] }}
                        </h3>

                        <!-- Bottom Row (Draw Number) -->
                        <div class="border-t border-white/10 pt-3 flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] font-bold text-white/50 tracking-widest uppercase">
                                DRAW NUMBER
                            </span>
                            <span class="text-sm sm:text-base font-black text-[#F5D77F] tracking-wide">
                                {{ $res['draw'] }}
                            </span>
                        </div>
                    </div>
                @endforeach

                <!-- Duplicate Set for Seamless Continuous Loop -->
                @foreach($drawResults as $res)
                    <div class="w-72 sm:w-80 shrink-0 bg-gradient-to-b from-[#0F2356] via-[#0A193E] to-[#06102B] rounded-2xl p-5 sm:p-6 border border-[#163275] hover:border-[#DFB755]/70 shadow-xl relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                        <!-- Subtle Card Top Lighting -->
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent pointer-events-none"></div>

                        <!-- Top Row (Badge + Published) -->
                        <div class="flex items-center justify-between mb-4 relative z-10">
                            <span class="bg-[#FCF9EE] text-[#071533] font-black text-xs px-2.5 py-1 rounded-md shadow-xs tracking-wider border border-[#DFB755]/40">
                                {{ $res['code'] }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#F5D77F] bg-black/40 border border-[#DFB755]/30 px-2.5 py-0.5 rounded-full backdrop-blur-xs">
                                <i class="fa-solid fa-circle-check text-[10px] text-[#DFB755]"></i> Published
                            </span>
                        </div>

                        <!-- Date -->
                        <div class="text-[11px] font-bold text-white/50 tracking-wider uppercase mb-1">
                            {{ $res['date'] }}
                        </div>

                        <!-- Scheme Name -->
                        <h3 class="text-base sm:text-lg font-bold text-white tracking-wide mb-4 group-hover:text-[#F5D77F] transition-colors">
                            {{ $res['name'] }}
                        </h3>

                        <!-- Bottom Row (Draw Number) -->
                        <div class="border-t border-white/10 pt-3 flex items-center justify-between">
                            <span class="text-[10px] sm:text-[11px] font-bold text-white/50 tracking-widest uppercase">
                                DRAW NUMBER
                            </span>
                            <span class="text-sm sm:text-base font-black text-[#F5D77F] tracking-wide">
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
<section class="relative bg-gradient-to-b from-white via-slate-50 to-slate-100 py-14 lg:py-20 overflow-hidden border-t border-slate-200">
    <!-- Subtle Background Accents -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header Row (Title on Left, Verification Badge on Right) -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10 lg:mb-12">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-5 h-0.5 bg-[#0B193E]"></span>
                    <span class="text-[#0B193E] font-extrabold text-[11px] sm:text-xs uppercase tracking-widest font-sans">
                        OFFICIAL WEEKLY CALENDAR
                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-bold text-slate-900 tracking-wide">
                    Weekly Draw <span class="text-[#0B193E]">Schedule</span>
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm mt-2 max-w-xl font-normal">
                    Plan your week with the latest Maharaja Lotteries draw calendar.
                </p>
            </div>

            <!-- Verified from LOTIS Status Pill -->
            <div class="bg-white rounded-2xl p-3 sm:px-4 sm:py-3 shadow-md border border-slate-200 flex items-center gap-3 shrink-0 self-start md:self-auto">
                <div class="w-7 h-7 rounded-full bg-[#0B193E] text-[#F5D77F] flex items-center justify-center text-xs shadow-xs">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <span class="block text-[9px] uppercase tracking-widest font-bold text-slate-400">VERIFIED FROM LOTIS</span>
                    <span class="block text-xs font-bold text-slate-800">Updated {{ now()->format('d M Y, h:i A') }}</span>
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
                    <div class="col-span-2 sm:col-span-1 lg:col-span-1 relative bg-gradient-to-b from-[#0F2356] via-[#0A193E] to-[#040A1A] rounded-2xl p-4 sm:p-5 text-white shadow-xl border-2 border-[#DFB755] flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
                        <!-- TODAY Pill Badge -->
                        <span class="absolute top-2.5 right-2.5 bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] font-black text-[9px] uppercase tracking-wider px-2 py-0.5 rounded-full shadow-xs">
                            TODAY
                        </span>

                        <div>
                            <!-- Top row with code badge -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-white text-[#0B193E] font-black text-xs flex items-center justify-center shadow-xs">
                                    {{ $schedule['code'] }}
                                </div>
                                <span class="text-[10px] font-bold text-white/50 tracking-wider mr-12">
                                    {{ $schedule['code'] }}
                                </span>
                            </div>

                            <span class="block text-[10px] font-bold text-[#F5D77F] tracking-wider uppercase mb-1">
                                {{ $schedule['day'] }}
                            </span>

                            <h3 class="text-sm sm:text-base font-bold text-white tracking-wide mb-6">
                                {{ $schedule['name'] }}
                            </h3>
                        </div>

                        <!-- Draw Time Footer -->
                        <div class="border-t border-white/15 pt-2.5 flex items-center gap-1.5 text-white/90">
                            <i class="fa-regular fa-clock text-xs text-[#DFB755]"></i>
                            <div class="text-[10px] sm:text-[11px] font-semibold leading-tight">
                                <span class="text-white/60 block text-[9px]">DRAW TIME</span>
                                <span class="text-white font-bold">{{ $schedule['time'] }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Regular Card -->
                    <div class="relative bg-white rounded-2xl p-4 sm:p-5 text-slate-800 shadow-sm hover:shadow-md border border-slate-200 hover:border-[#0B193E]/40 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
                        <div>
                            <!-- Top row with code badge -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-[#e6eef9] text-[#0B193E] border border-slate-200 font-black text-xs flex items-center justify-center shadow-2xs">
                                    {{ $schedule['code'] }}
                                </div>
                                <span class="text-[10px] font-bold text-slate-400 tracking-wider">
                                    {{ $schedule['code'] }}
                                </span>
                            </div>

                            <span class="block text-[10px] font-bold text-[#0B193E] tracking-wider uppercase mb-1">
                                {{ $schedule['day'] }}
                            </span>

                            <h3 class="text-sm sm:text-base font-bold text-slate-900 tracking-wide mb-6 group-hover:text-[#0B193E] transition-colors">
                                {{ $schedule['name'] }}
                            </h3>
                        </div>

                        <!-- Draw Time Footer -->
                        <div class="border-t border-slate-100 pt-2.5 flex items-center gap-1.5 text-slate-600">
                            <i class="fa-regular fa-clock text-xs text-[#0B193E]/70"></i>
                            <div class="text-[10px] sm:text-[11px] font-semibold leading-tight">
                                <span class="text-slate-400 block text-[9px]">DRAW TIME</span>
                                <span class="text-slate-800 font-bold">{{ $schedule['time'] }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Special Draw Banner (Bottom Box) -->
        <div class="mt-6 bg-gradient-to-r from-[#040A1A] via-[#071533] to-[#0F2356] rounded-2xl p-5 sm:p-6 lg:p-7 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 border border-[#DFB755]/30">
            <div class="flex items-center gap-4 sm:gap-6 w-full md:w-auto">
                <!-- Big Date Number -->
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-4xl sm:text-5xl font-black text-white leading-none font-serif">
                        28
                    </span>
                    <div class="text-[10px] font-black uppercase tracking-wider text-[#F5D77F] leading-tight">
                        <span>NOV</span><br>
                        <span>2026</span>
                    </div>
                </div>

                <div class="w-px h-12 bg-white/20 hidden sm:block"></div>

                <!-- Info -->
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="bg-[#DFB755]/20 text-[#F5D77F] border border-[#DFB755]/30 text-[9px] font-black uppercase px-2 py-0.5 rounded tracking-widest">
                            SPECIAL DRAW
                        </span>
                    </div>
                    <h4 class="text-base sm:text-lg lg:text-xl font-bold text-white tracking-wide">
                        Pooja Bumper <span class="text-xs sm:text-sm font-semibold text-[#F5D77F]/90 ml-1">BR-112</span>
                    </h4>
                    <p class="text-xs sm:text-[13px] text-white/80 mt-1">
                        Saturday draw scheduled at 2:00 PM at Gorky Bhavan, Near Bakery Junction, Thiruvananthapuram.
                    </p>
                </div>
            </div>

            <!-- Action Button -->
            <div class="w-full md:w-auto shrink-0 flex justify-end">
                <a href="{{ route('winnerlist') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs sm:text-sm px-6 py-3 rounded-xl shadow-md transition-all duration-300 hover:scale-105 border border-[#FFE8A2]">
                    View results
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- Our Photos & Videos (Gallery Section) -->
<section class="relative bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] py-8 lg:py-12 overflow-hidden text-white border-t border-[#DFB755]/20 shadow-inner">
    <!-- Subtle Theme Texture Pattern -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    
    <!-- Ambient Glows -->
    <div class="absolute -top-32 -left-32 w-80 h-80 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-black/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header Row (Compact Spacing) -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-2 sm:gap-4 mb-5 lg:mb-6">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-4 h-0.5 bg-[#DFB755]"></span>
                    <span class="text-[#F5D77F] font-extrabold text-[10px] sm:text-[11px] uppercase tracking-widest font-sans">
                        Gallery
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-serif font-black text-white tracking-wide">
                    Our Photos &amp; Videos
                </h2>
            </div>
            
            <p class="text-white/80 text-xs sm:text-sm max-w-xs md:text-right font-normal leading-relaxed">
                Explore our latest events, activities and memorable moments.
            </p>
        </div>

        <!-- Gallery Grid (Compact Heights & Reduced Gaps) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 sm:gap-4 items-stretch">
            
            <!-- Left Large Feature Card (7 cols on lg) -->
            <div class="lg:col-span-7">
                <div class="relative w-full h-[220px] sm:h-[280px] lg:h-[304px] rounded-xl overflow-hidden shadow-xl group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-1.jpg') }}" alt="Latest Maharaja Lottery Event" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-black/15 pointer-events-none"></div>
                    
                    <!-- Tag Badge -->
                    <div class="absolute bottom-3 left-3 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[11px] font-semibold px-3 py-1 rounded-full border border-white/20 shadow-md">
                            Latest Event
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right 2x2 Cards Grid (5 cols on lg) -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-3 sm:gap-4">
                
                <!-- Card 1: Events -->
                <div class="relative h-[105px] sm:h-[135px] lg:h-[144px] rounded-xl overflow-hidden shadow-md group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-2.jpg') }}" alt="Lottery Events" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-2.5 left-2.5 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-full border border-white/20 shadow-sm">
                            Events
                        </span>
                    </div>
                </div>

                <!-- Card 2: Updates -->
                <div class="relative h-[105px] sm:h-[135px] lg:h-[144px] rounded-xl overflow-hidden shadow-md group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-3.jpg') }}" alt="Prize Distribution Updates" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-2.5 left-2.5 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-full border border-white/20 shadow-sm">
                            Updates
                        </span>
                    </div>
                </div>

                <!-- Card 3: Activities -->
                <div class="relative h-[105px] sm:h-[135px] lg:h-[144px] rounded-xl overflow-hidden shadow-md group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-4.jpg') }}" alt="Lottery Draw Activities" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-2.5 left-2.5 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-full border border-white/20 shadow-sm">
                            Activities
                        </span>
                    </div>
                </div>

                <!-- Card 4: Highlights -->
                <div class="relative h-[105px] sm:h-[135px] lg:h-[144px] rounded-xl overflow-hidden shadow-md group border border-white/15 bg-black/30">
                    <img src="{{ asset('img/event-5.jpg') }}" alt="Ceremony Highlights" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-2.5 left-2.5 z-10">
                        <span class="inline-flex items-center bg-black/65 backdrop-blur-md text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-full border border-white/20 shadow-sm">
                            Highlights
                        </span>
                    </div>
                </div>

            </div>

        </div>

        <!-- View Full Gallery CTA Button -->
        <div class="text-center mt-6 sm:mt-8">
            <a href="#" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs sm:text-sm px-6 py-2.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-[#FFE8A2]">
                View Full Gallery
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</section>

@endsection
