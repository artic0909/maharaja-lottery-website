@extends('frontend.layouts.app')

@section('title', 'Official Draw Desk & Ticket Result Verification')

@push('scripts')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700;900&family=Cinzel:wght@700;900&family=Outfit:wght@700;800;900&family=Playfair+Display:ital,wght@0,700;0,900;1,700;1,900&display=swap" rel="stylesheet">
@endpush

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
                        OFFICIAL DRAW DESK &bull; LIVE AUDIT
                    </span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-black text-white tracking-wide leading-tight mb-3">
                    Maharaja Lottery <span class="text-[#F5D77F]">Results</span>
                </h1>
                
                <p class="text-white/85 text-xs sm:text-sm lg:text-[15px] leading-relaxed max-w-2xl font-normal mb-6">
                    Check your booked lottery ticket result and verification status. Results are officially visible once your booking payment is verified and approved by the admin.
                </p>

                <!-- 3 Badges / Verification Points -->
                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs text-white/90 font-medium">
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-shield-halved text-[#DFB755] text-xs"></i> Admin Approved Results
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-rotate text-[#DFB755] text-xs"></i> Real-time Draw Status
                    </div>
                    <div class="flex items-center gap-1.5 bg-black/30 px-3 py-1.5 rounded-full border border-white/10 backdrop-blur-xs">
                        <i class="fa-solid fa-lock text-[#DFB755] text-xs"></i> Secure Verification
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
                                APPROVED DRAWS
                            </span>
                            <span class="text-2xl sm:text-3xl font-black text-white font-serif">{{ $totalPublished }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] uppercase tracking-wider font-extrabold text-white/60 mb-0.5">
                                VERIFIED USERS
                            </span>
                            <span class="text-2xl sm:text-3xl font-black text-white font-serif">{{ $totalPublished }}</span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-2 text-[11px] font-semibold text-[#F5D77F]/90">
                        <i class="fa-solid fa-circle-check text-emerald-400"></i>
                        <span>Admin Verified Results Online</span>
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
            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#071533] border border-[#DFB755]/40 flex items-center justify-center text-[#F3D068] text-base sm:text-lg shrink-0 shadow-sm">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div>
                <span class="block text-[10px] font-extrabold text-[#0B193E] uppercase tracking-wider font-sans mb-0.5">
                    TICKET &amp; PAYMENT VERIFICATION
                </span>
                <h3 class="text-sm sm:text-base lg:text-lg font-serif font-bold text-slate-900 tracking-wide">
                    Check your ticket &amp; draw result
                </h3>
                <p class="text-[11px] sm:text-xs text-slate-500 font-normal">
                    Enter your Ticket Number (e.g. MH100003), Booking Ref, or Mobile Number.
                </p>
            </div>
        </div>

        <!-- Right Form Input -->
        <div class="w-full lg:w-auto lg:min-w-[440px]">
            <form action="{{ route('winnerlist') }}" method="GET" class="w-full">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">
                    TICKET NUMBER / BOOKING REF / PHONE
                </label>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center border border-slate-300 rounded-xl overflow-hidden focus-within:border-[#0B193E] focus-within:ring-2 focus-within:ring-[#0B193E]/20 shadow-xs bg-white transition-all">
                    <div class="flex items-center flex-1 min-w-0">
                        <span class="pl-3.5 text-slate-400">
                            <i class="fa-solid fa-ticket-simple text-[#0B193E]"></i>
                        </span>
                        <input type="text" name="ticket_number" value="{{ $searchQuery ?? '' }}" placeholder="Example: MH100003 or 9087767656" class="w-full px-3 py-2.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 bg-transparent outline-none font-medium min-w-0 font-mono">
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] px-6 py-2.5 sm:py-3 text-xs sm:text-sm font-black flex items-center justify-center gap-1.5 transition-colors shrink-0 border-l border-[#DFB755]">
                        <span>Check Result</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Results Section -->
<section class="py-10 sm:py-14 bg-gradient-to-b from-slate-50 via-white to-slate-100 min-h-[400px]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">

        @if(!empty($searchQuery))

            @if($searchState === 'approved')
                @php
                    $resultStatusLower = strtolower($searchResult['result_status'] ?? '');
                    $isWinner = !empty($searchResult['prize_amount']) || str_contains($resultStatusLower, 'winner') || str_contains($resultStatusLower, 'prize') || str_contains($resultStatusLower, '1st') || str_contains($resultStatusLower, '2nd') || str_contains($resultStatusLower, '3rd');
                    $primaryTicket = !empty($searchResult['tickets'][0]) ? $searchResult['tickets'][0] : 'MH100002';
                    $ticketListStr = implode(', ', $searchResult['tickets'] ?? []);
                    $formattedDate = !empty($searchResult['booked_at']) ? date('d-m-Y', strtotime($searchResult['booked_at'])) : date('d-m-Y');
                    $displayDate = !empty($searchResult['booked_at']) ? date('d M Y', strtotime($searchResult['booked_at'])) : date('d M Y');
                    $prizeString = !empty($searchResult['prize_amount']) ? $searchResult['prize_amount'] : 'INR 2 Lakhs';
                    $tdsCalc = \App\Models\TdsPayment::calculateTds($prizeString, 1.0);
                @endphp

                @if($isWinner)
                    <!-- CASE 1A: PRE-CELEBRATION WINNER ANNOUNCEMENT MODAL -->
                    <div id="winner-announcement-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md flex items-center justify-center p-4 transition-all duration-500 opacity-100 scale-100">
                        <!-- Ambient Glow in Background -->
                        <div class="absolute w-96 h-96 bg-[#DFB755]/25 rounded-full blur-3xl pointer-events-none"></div>

                        <div class="relative bg-gradient-to-b from-[#071533] via-[#0B193E] to-[#040A1A] border-2 sm:border-3 border-[#DFB755] rounded-3xl p-6 sm:p-8 max-w-lg w-full text-center text-white shadow-[0_0_60px_rgba(223,183,85,0.4)] overflow-hidden space-y-5 animate-in zoom-in-95 duration-300">
                            
                            <!-- Sparkle Decorative Pattern -->
                            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:14px_14px] pointer-events-none"></div>
                            
                            <!-- Glowing Trophy Icon -->
                            <div class="relative z-10 mx-auto w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-[#C59B27] via-[#F3D068] to-[#DFB755] text-[#071533] flex items-center justify-center text-3xl sm:text-4xl shadow-xl shadow-amber-500/20 animate-bounce">
                                <i class="fa-solid fa-trophy"></i>
                            </div>

                            <!-- Header -->
                            <div class="relative z-10 space-y-1.5">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] sm:text-xs font-black uppercase tracking-widest bg-[#DFB755]/20 text-[#F3D068] border border-[#DFB755]/40">
                                    <i class="fa-solid fa-crown text-[10px]"></i>
                                    <span>Official Prize Winner Declared</span>
                                    <i class="fa-solid fa-crown text-[10px]"></i>
                                </div>
                                
                                <h3 class="text-xl sm:text-3xl font-serif font-black text-white">
                                    Congratulations,<br>
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F5D77F] via-[#FFE8A2] to-[#DFB755]">
                                        {{ $searchResult['customer_name'] }}!
                                    </span>
                                </h3>
                            </div>

                            <!-- Refined Winner Announcement Note -->
                            <div class="relative z-10 bg-black/40 border border-[#DFB755]/30 rounded-2xl p-4 sm:p-5 text-left space-y-3">
                                <div class="flex items-center justify-between pb-2 border-b border-white/10">
                                    <span class="text-[11px] uppercase tracking-wider font-bold text-stone-400">Winning Position</span>
                                    <span class="text-sm font-black text-[#F3D068] font-serif">{{ $searchResult['result_status'] ?? '3rd Prize' }}</span>
                                </div>

                                <div class="flex items-center justify-between pb-2 border-b border-white/10">
                                    <span class="text-[11px] uppercase tracking-wider font-bold text-stone-400">Winning Prize Amount</span>
                                    <span class="text-base sm:text-lg font-mono font-black text-emerald-300 drop-shadow-[0_0_8px_rgba(52,211,153,0.6)]">{{ $prizeString }}</span>
                                </div>

                                <p class="text-xs text-stone-300 leading-relaxed font-normal pt-1">
                                    You have won <strong class="text-[#F3D068] font-bold">{{ $prizeString }} ({{ $searchResult['result_status'] ?? '3rd Prize' }})</strong> in <strong>Maharaja Lottery</strong>. As per directorate claim regulations, a <strong class="text-amber-300 font-bold">1% TDS fee ({{ $tdsCalc['tds_formatted'] }})</strong> is required to be cleared with Maharaja Lottery before the prize balance is disbursed to your account.
                                </p>
                            </div>

                            <!-- Progress Bar & Auto-close Timer -->
                            <div class="relative z-10 space-y-3 pt-1">
                                <div class="w-full bg-white/10 rounded-full h-1.5 overflow-hidden">
                                    <div id="modal-progress-bar" class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#16A34A] h-full w-full transition-all duration-[3000ms] ease-linear"></div>
                                </div>

                                <div class="flex items-center justify-between text-[11px] text-stone-400">
                                    <span>Opening official certificate...</span>
                                    <span class="font-mono font-bold text-[#F3D068]"><span id="popup-timer-sec">3</span>s</span>
                                </div>

                                <button type="button" onclick="closeWinnerAnnouncementModal()" class="w-full py-3 px-6 rounded-xl bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs sm:text-sm uppercase tracking-wider shadow-lg transition-transform transform hover:scale-[1.02] flex items-center justify-center gap-2 cursor-pointer">
                                    <span>View Official Certificate Now</span>
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- CASE 1B: WINNER CELEBRATION & OFFICIAL CERTIFICATE -->
                    <div class="space-y-8 animate-in fade-in zoom-in-95 duration-300" id="winner-celebration-wrapper">
                        
                        <!-- Celebration Hero Boom Banner -->
                        <div class="relative bg-gradient-to-r from-[#040A1A] via-[#0B193E] to-[#040A1A] rounded-3xl border-2 border-[#DFB755] p-6 sm:p-10 text-center text-white shadow-[0_0_50px_rgba(223,183,85,0.25)] overflow-hidden">
                            <!-- Background Sparkles & Glows -->
                            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
                            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 bg-[#DFB755]/20 rounded-full blur-3xl pointer-events-none"></div>

                            <!-- Animated Confetti Blast Triggers & Decorative Elements -->
                            <div class="relative z-10 space-y-4 max-w-3xl mx-auto">
                                
                                <div class="inline-flex items-center gap-2 bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] px-4 sm:px-6 py-1.5 rounded-full font-black text-xs sm:text-sm uppercase tracking-widest shadow-lg animate-bounce">
                                    <i class="fa-solid fa-crown text-sm"></i>
                                    <span>Official Maharaja Lottery Winner</span>
                                    <i class="fa-solid fa-crown text-sm"></i>
                                </div>

                                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-serif font-black text-white tracking-wide leading-tight drop-shadow-md">
                                    🎉 CONGRATULATIONS! 🎉<br>
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F5D77F] via-[#FFE8A2] to-[#DFB755]">
                                        {{ $searchResult['customer_name'] }}
                                    </span>
                                </h2>

                                <div class="inline-flex flex-wrap items-center justify-center gap-3 bg-black/40 border border-[#DFB755]/40 px-5 py-2.5 rounded-2xl backdrop-blur-md">
                                    <div class="flex items-center gap-2 text-[#F3D068] font-bold text-sm sm:text-base">
                                        <i class="fa-solid fa-trophy text-[#DFB755]"></i>
                                        <span>{{ $searchResult['result_status'] }}</span>
                                    </div>
                                    @if(!empty($searchResult['prize_amount']))
                                        <span class="text-white/40 font-thin">|</span>
                                        <div class="flex items-center gap-2 text-stone-200 text-sm sm:text-base font-semibold">
                                            <span class="text-stone-300">Prize:</span>
                                            <span class="text-emerald-300 font-mono font-black text-lg sm:text-xl tracking-wide drop-shadow-[0_0_12px_rgba(52,211,153,0.7)]">{{ $searchResult['prize_amount'] }}</span>
                                        </div>
                                    @endif
                                </div>

                                <p class="text-xs sm:text-sm text-stone-300 max-w-xl mx-auto leading-relaxed">
                                    Your lottery ticket reservation <strong class="text-[#F3D068] font-mono">{{ $ticketListStr }}</strong> has been officially declared as a prize winner in the Maharaja Directorate draw!
                                </p>

                                <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                                    <!-- Withdrawal Button -->
                                    <button type="button" onclick="openTdsWithdrawalModal()" class="px-7 py-3 rounded-xl bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:to-[#16A34A] text-white text-sm font-black transition flex items-center gap-2.5 shadow-xl shadow-emerald-950/60 hover:scale-105 transform border border-emerald-300/50 cursor-pointer">
                                        <i class="fa-solid fa-wallet text-amber-300 text-base"></i>
                                        <span class="tracking-wide">Withdrawal</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- TDS 1% Clearance & Withdrawal Instruction Modal -->
                        <div id="tds-withdrawal-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden items-center justify-center p-3 sm:p-5 transition-all duration-300">
                            <!-- Background Ambient Glow -->
                            <div class="absolute w-96 h-96 bg-[#DFB755]/20 rounded-full blur-3xl pointer-events-none"></div>

                            <div class="relative bg-gradient-to-b from-[#071533] via-[#0B193E] to-[#040A1A] border-2 border-[#DFB755] rounded-3xl p-5 sm:p-7 max-w-lg w-full text-white shadow-[0_0_60px_rgba(223,183,85,0.35)] overflow-hidden space-y-4 animate-in zoom-in-95 duration-200">
                                <!-- Close Button -->
                                <button type="button" onclick="closeTdsWithdrawalModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-stone-300 hover:text-white flex items-center justify-center text-xs transition z-20 cursor-pointer">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>

                                <!-- Header Badge -->
                                <div class="text-center space-y-1.5">
                                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-[10px] sm:text-xs font-black uppercase tracking-wider bg-[#DFB755]/20 text-[#F3D068] border border-[#DFB755]/40">
                                        <i class="fa-solid fa-crown text-[11px]"></i>
                                        <span>TDS Tax Clearance Notice</span>
                                        <i class="fa-solid fa-shield-halved text-[11px]"></i>
                                    </div>
                                    
                                    <h3 class="text-lg sm:text-2xl font-serif font-black text-white">
                                        Prize Withdrawal Verification
                                    </h3>
                                </div>

                                <!-- 1% TDS Notice Explanation -->
                                <div class="bg-black/50 border border-[#DFB755]/30 rounded-2xl p-4 sm:p-5 space-y-3.5">
                                    <div class="flex items-start gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-amber-500/20 border border-amber-400/40 text-[#F3D068] flex items-center justify-center text-sm shrink-0 mt-0.5">
                                            <i class="fa-solid fa-file-invoice-dollar"></i>
                                        </div>
                                        <div class="text-xs sm:text-sm text-stone-200 leading-relaxed">
                                            <span class="font-bold text-amber-300 block mb-1 text-sm">You need to pay 1% TDS:</span>
                                            Before withdrawing your prize money from Maharaja Lottery, as per government tax regulations, you must pay a <strong class="text-[#F3D068]">1% TDS fee</strong> on the total prize amount (<strong class="text-white">{{ $prizeString }}</strong>) to Maharaja Lottery.
                                        </div>
                                    </div>

                                    <!-- Dynamic Financial Summary -->
                                    <div class="grid grid-cols-2 gap-2.5 pt-2 border-t border-white/10">
                                        <div class="bg-white/5 rounded-xl p-3 border border-white/10">
                                            <span class="block text-[10px] uppercase font-bold text-stone-400 tracking-wider">Total Prize Won</span>
                                            <span class="text-sm sm:text-base font-mono font-black text-emerald-400 block mt-0.5">{{ $prizeString }}</span>
                                            <span class="text-[10px] text-stone-400 font-mono">({{ $tdsCalc['winning_formatted'] }})</span>
                                        </div>
                                        <div class="bg-amber-500/10 rounded-xl p-3 border border-[#DFB755]/40">
                                            <span class="block text-[10px] uppercase font-bold text-amber-300 tracking-wider">1% TDS to Pay</span>
                                            <span class="text-base sm:text-xl font-mono font-black text-[#F3D068] block mt-0.5 drop-shadow-[0_0_8px_rgba(243,208,104,0.5)]">{{ $tdsCalc['tds_formatted'] }}</span>
                                            <span class="text-[10px] text-amber-200/80 font-mono">1% of Prize</span>
                                        </div>
                                    </div>

                                    <p class="text-[11px] text-stone-400 leading-normal italic">
                                        * Note: As per Directorate rules, 1% TDS ({{ $tdsCalc['tds_formatted'] }}) must be deposited to Maharaja Lottery before releasing {{ $prizeString }} to your bank account.
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="space-y-2 pt-1">
                                    <a href="{{ route('withdrawal', ['ref' => $searchResult['booking_ref'] ?? '', 'amount' => $prizeString, 'name' => $searchResult['customer_name'] ?? '', 'phone' => $searchResult['customer_mobile'] ?? '']) }}" 
                                        class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:to-[#16A34A] text-white font-black text-sm uppercase tracking-wider shadow-lg shadow-emerald-950/60 hover:scale-[1.02] transform transition flex items-center justify-center gap-2 cursor-pointer border border-emerald-300/40">
                                        <i class="fa-solid fa-building-columns text-sm text-yellow-300"></i>
                                        <span>Withdrawal</span>
                                        <i class="fa-solid fa-arrow-right text-xs"></i>
                                    </a>

                                    <button type="button" onclick="closeTdsWithdrawalModal()" class="w-full py-2 text-stone-400 hover:text-white text-xs font-semibold transition cursor-pointer">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Official Winner Certificate Preview Container -->
                        <div class="bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] rounded-3xl border-2 border-[#DFB755]/50 p-4 sm:p-8 text-white shadow-2xl space-y-6">
                            
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-widest text-[#DFB755] block">GOVERNMENT VERIFIED CERTIFICATE</span>
                                    <h3 class="text-lg sm:text-2xl font-serif font-black text-white">
                                        Official Winner Certificate
                                    </h3>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="downloadCertificate()" class="bg-[#DFB755] hover:bg-[#C59B27] text-[#071533] px-4 sm:px-5 py-2 rounded-xl font-black text-xs transition flex items-center gap-2 shadow-md">
                                        <i class="fa-solid fa-file-arrow-down text-xs"></i>
                                        <span>Download</span>
                                    </button>
                                    <button type="button" onclick="printCertificate()" class="bg-white/10 hover:bg-white/20 text-white px-3.5 py-2 rounded-xl font-bold text-xs transition flex items-center gap-1.5 border border-white/20">
                                        <i class="fa-solid fa-print text-xs"></i>
                                        <span>Print</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Responsive Canvas Container for Certificate -->
                            <div class="relative w-full max-w-4xl mx-auto rounded-2xl overflow-hidden border-2 sm:border-4 border-[#DFB755] shadow-2xl bg-[#040A1A] flex items-center justify-center p-1 sm:p-2">
                                <canvas id="winner-certificate-canvas" class="w-full h-auto rounded-xl shadow-lg cursor-pointer max-w-full block" title="Click Download button to save high resolution copy"></canvas>
                            </div>

                            <!-- Certificate Action Guidance -->
                            <!-- <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-black/40 border border-white/10 rounded-2xl p-4 text-xs">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 flex items-center justify-center text-sm shrink-0">
                                        <i class="fa-solid fa-shield-check"></i>
                                    </div>
                                    <span class="text-stone-300">
                                        Digitally signed &amp; certified by <strong>Maharaja Lotteries Directorate</strong> with Ref: <strong class="text-[#F3D068] font-mono">{{ $searchResult['booking_ref'] }}</strong>
                                    </span>
                                </div>

                                <a href="https://wa.me/918743978796?text={{ urlencode('Hello Maharaja Directorate, I have won ' . ($searchResult['result_status'] ?? '3rd Prize') . ' for Booking Ref ' . $searchResult['booking_ref'] . ' (Ticket: ' . $ticketListStr . '). Please guide me to claim my prize.') }}" 
                                    target="_blank"
                                    class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs py-2.5 px-5 rounded-xl flex items-center justify-center gap-2 transition shadow-md shrink-0">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>Contact Claim Desk</span>
                                </a>
                            </div> -->

                        </div>

                    </div>

                @else
                    <!-- CASE 1B: APPROVED BUT REGULAR ACTIVE IN LIVE DRAW -->
                    <div class="bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] rounded-3xl border-2 border-emerald-500/50 p-6 sm:p-8 text-white shadow-2xl relative overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                        <!-- Background Glow -->
                        <div class="absolute -top-24 -right-24 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
                        
                        <div class="relative z-10 space-y-6">
                            
                            <!-- Status Badge Header -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-5">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center text-xl shadow-inner shrink-0">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 mb-1">
                                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                            ADMIN APPROVED &bull; RESULT VERIFIED
                                        </span>
                                        <h2 class="text-xl sm:text-2xl font-serif font-black text-white">
                                            Booking Confirmed &amp; Live Result Active
                                        </h2>
                                    </div>
                                </div>

                                <div class="text-left sm:text-right">
                                    <span class="block text-[10px] font-bold text-stone-400 uppercase tracking-wider">BOOKING REFERENCE</span>
                                    <span class="font-mono font-black text-[#F3D068] text-sm sm:text-base select-all">{{ $searchResult['booking_ref'] }}</span>
                                </div>
                            </div>

                            <!-- Main Details Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                
                                <!-- Left: Customer Details -->
                                <div class="bg-black/30 rounded-2xl p-5 border border-white/10 space-y-3">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755] block">CUSTOMER INFORMATION</span>
                                    <div>
                                        <span class="text-xs text-stone-400 block">Ticket Holder</span>
                                        <span class="text-base font-bold text-white">{{ $searchResult['customer_name'] }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs text-stone-400 block">Registered Mobile</span>
                                        <span class="text-xs font-mono font-bold text-stone-300">{{ $searchResult['customer_mobile'] }}</span>
                                    </div>
                                    @if(!empty($searchResult['customer_state']))
                                        <div>
                                            <span class="text-xs text-stone-400 block">Location</span>
                                            <span class="text-xs text-stone-300">{{ $searchResult['customer_city'] ? $searchResult['customer_city'].', ' : '' }}{{ $searchResult['customer_state'] }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Middle: Booked Tickets -->
                                <div class="bg-black/30 rounded-2xl p-5 border border-white/10 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755]">BOOKED TICKETS</span>
                                        <span class="px-2 py-0.5 rounded-md bg-[#DFB755]/20 text-[#F3D068] text-[10px] font-black font-mono">
                                            {{ count($searchResult['tickets'] ?? []) }} Total
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-2 max-h-36 overflow-y-auto pr-1">
                                        @foreach($searchResult['tickets'] ?? [] as $t)
                                            <span class="px-3 py-1.5 rounded-xl bg-white/10 border border-white/20 text-white font-mono font-black text-xs shadow-xs hover:border-[#DFB755] transition select-all">
                                                <i class="fa-solid fa-ticket text-[10px] text-[#DFB755] mr-1"></i>{{ $t }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <span class="text-[10px] text-emerald-400 block mt-2">
                                        <i class="fa-solid fa-circle-check mr-1"></i> Permanently Reserved &amp; Registered in Directorate
                                    </span>
                                </div>

                                <!-- Right: Draw Result & Prize Status -->
                                <div class="bg-gradient-to-br from-emerald-950/40 to-black/40 rounded-2xl p-5 border border-emerald-500/30 space-y-3 flex flex-col justify-between">
                                    <div>
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-400 block">DRAW &amp; PRIZE STATUS</span>
                                        <div class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#0B193E] border border-[#DFB755]/50 text-[#F3D068] font-serif font-black text-sm">
                                            <i class="fa-solid fa-award text-[#DFB755]"></i>
                                            <span>{{ $searchResult['result_status'] ?? 'Active in Live Draw' }}</span>
                                        </div>
                                        <p class="text-[11px] text-stone-300 mt-2">
                                            Payment verified: <span class="font-mono font-bold text-white">INR {{ number_format($searchResult['total_amount'] ?? 0) }}</span> (Received).
                                        </p>
                                    </div>

                                    <div class="pt-2">
                                        <a href="https://wa.me/918743978796?text={{ urlencode('Hello Maharaja Directorate, I am checking my approved booking ' . $searchResult['booking_ref'] . ' for ticket(s) ' . $ticketListStr . '.') }}" 
                                            target="_blank"
                                            class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition shadow-md">
                                            <i class="fa-brands fa-whatsapp text-sm"></i>
                                            <span>Claim / Official Support Desk</span>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                @endif

            @elseif($searchState === 'pending')
                <!-- CASE 2: PENDING APPROVAL -> THEMED & SIMPLE -->
                <div class="bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] rounded-3xl border border-[#DFB755]/40 p-6 sm:p-8 text-white shadow-2xl relative overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                    <!-- Subtle Background Pattern & Ambient Glow -->
                    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
                    <div class="absolute -top-20 -right-20 w-72 h-72 bg-[#DFB755]/10 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10 space-y-6">
                        
                        <!-- Header: Icon, Badge & Title -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-5">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#DFB755]/15 border border-[#DFB755]/40 text-[#F3D068] flex items-center justify-center text-xl shrink-0 shadow-inner">
                                    <i class="fa-solid fa-hourglass-half animate-pulse"></i>
                                </div>
                                <div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-500/20 text-[#F3D068] border border-amber-500/40 mb-1">
                                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                                        Verification Pending
                                    </span>
                                    <h2 class="text-xl sm:text-2xl font-serif font-black text-white">
                                        Payment Under Review
                                    </h2>
                                </div>
                            </div>

                            <div class="text-left sm:text-right">
                                <span class="block text-[10px] font-bold text-stone-400 uppercase tracking-wider">BOOKING REF</span>
                                <span class="font-mono font-black text-[#F3D068] text-sm sm:text-base select-all">{{ $searchResult['booking_ref'] }}</span>
                            </div>
                        </div>

                        <!-- 3 Compact Summary Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                            <!-- Amount & UTR -->
                            <div class="bg-black/30 rounded-2xl p-4 border border-white/10 flex flex-col justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755]">AMOUNT UNDER REVIEW</span>
                                <div class="mt-2">
                                    <span class="text-xl sm:text-2xl font-black font-serif text-white">INR {{ number_format($searchResult['total_amount'] ?? 0) }}</span>
                                    @if(!empty($searchResult['utr_number']))
                                        <span class="block text-[11px] font-mono text-stone-300 mt-1">UTR: <strong class="text-[#F3D068]">{{ $searchResult['utr_number'] }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <!-- Selected Tickets -->
                            <div class="bg-black/30 rounded-2xl p-4 border border-white/10 sm:col-span-2 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#DFB755]">SELECTED TICKETS</span>
                                    <span class="px-2 py-0.5 rounded-md bg-[#DFB755]/20 text-[#F3D068] text-[10px] font-black font-mono">
                                        {{ count($searchResult['tickets'] ?? []) }} Total
                                    </span>
                                </div>
                                <div class="flex flex-wrap gap-1.5 max-h-24 overflow-y-auto pr-1">
                                    @foreach($searchResult['tickets'] ?? [] as $t)
                                        <span class="px-2.5 py-1 rounded-lg bg-white/10 border border-[#DFB755]/30 text-white font-mono font-bold text-xs shadow-xs">
                                            <i class="fa-solid fa-ticket text-[10px] text-[#DFB755] mr-1"></i>{{ $t }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Simple Footer Note & WhatsApp Action -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-1">
                            <div class="flex items-center gap-2 text-xs text-stone-300">
                                <i class="fa-regular fa-clock text-[#DFB755]"></i>
                                <span>Verification takes <strong>5–15 minutes</strong>. Results will appear here once approved.</span>
                            </div>

                            <a href="https://wa.me/918743978796?text={{ urlencode('Hello Admin, I have submitted payment for Booking Reference ' . $searchResult['booking_ref'] . ' (UTR: ' . ($searchResult['utr_number'] ?? '') . '). Please approve my booking.') }}" 
                                target="_blank"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-bold text-xs transition shadow-md shrink-0">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Fast Approval on WhatsApp</span>
                            </a>
                        </div>

                    </div>
                </div>

            @elseif($searchState === 'rejected')
                <!-- CASE 3: REJECTED -->
                <div class="bg-gradient-to-br from-[#071533] via-[#0B193E] to-[#040A1A] rounded-3xl border border-rose-500/40 p-6 sm:p-8 text-white shadow-2xl space-y-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-2xl bg-rose-500/20 border border-rose-500/40 text-rose-400 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-500/20 text-rose-300 border border-rose-500/40 mb-1">
                                Verification Unsuccessful
                            </span>
                            <h3 class="text-xl font-serif font-black text-white">Payment Not Confirmed</h3>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-stone-300 max-w-xl">
                        We could not verify the payment for Booking Reference <span class="font-mono font-bold text-[#F3D068]">{{ $searchResult['booking_ref'] }}</span>. Please reach out to support on WhatsApp for assistance.
                    </p>
                    <div class="pt-1">
                        <a href="https://wa.me/918743978796?text={{ urlencode('Hello Support, my booking reference ' . $searchResult['booking_ref'] . ' was rejected. Please assist me.') }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition shadow-md">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Contact Support Desk</span>
                        </a>
                    </div>
                </div>

            @elseif($searchState === 'not_found')
                <!-- CASE 4: NOT FOUND -->
                <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 text-center shadow-lg space-y-4 max-w-xl mx-auto">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mx-auto border border-amber-200">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 class="text-xl font-serif font-black text-slate-900">No Booking Record Found</h3>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md mx-auto">
                        No matching ticket or booking found for "<strong class="text-slate-800 font-mono">{{ $searchQuery }}</strong>". Please double check your Ticket Number (e.g. MH100014) or Booking Ref.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('ticket.booking') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] font-black text-xs sm:text-sm shadow-md transition transform hover:scale-105">
                            <i class="fa-solid fa-ticket"></i>
                            <span>Book New Ticket</span>
                        </a>
                    </div>
                </div>

            @endif

        @else
            <!-- INITIAL STATE: NO SEARCH PERFORMED YET -->
            <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 text-center shadow-md max-w-2xl mx-auto space-y-6">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#071533] to-[#0B193E] text-[#F3D068] flex items-center justify-center text-2xl mx-auto shadow-md border border-[#DFB755]/30">
                    <i class="fa-solid fa-award"></i>
                </div>

                <div class="space-y-2">
                    <span class="text-[10px] uppercase font-black tracking-widest text-[#C59B27] block">DIRECTORATE VERIFICATION PORTAL</span>
                    <h3 class="text-xl sm:text-2xl font-serif font-black text-slate-900">
                        Search Your Ticket to Check Result
                    </h3>
                </div>


            </div>
        @endif

    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<script>
    // Confetti Mega Celebration Blast
    function triggerWinnerConfettiBoom() {
        if (typeof confetti !== 'function') return;

        // Left Cannon Burst
        confetti({
            particleCount: 90,
            angle: 60,
            spread: 75,
            origin: { x: 0.05, y: 0.7 },
            colors: ['#DFB755', '#F3D068', '#16A34A', '#E11D48', '#FFFFFF', '#FFD700']
        });

        // Right Cannon Burst
        setTimeout(() => {
            confetti({
                particleCount: 90,
                angle: 120,
                spread: 75,
                origin: { x: 0.95, y: 0.7 },
                colors: ['#DFB755', '#F3D068', '#16A34A', '#E11D48', '#FFFFFF', '#FFD700']
            });
        }, 200);

        // Center Grand Explosion
        setTimeout(() => {
            confetti({
                particleCount: 140,
                spread: 120,
                origin: { x: 0.5, y: 0.45 },
                shapes: ['star', 'circle'],
                colors: ['#FFD700', '#FFA500', '#FF4500', '#22C55E', '#DFB755', '#FFFFFF']
            });
        }, 450);

        // Continuous Fireworks Cascade
        const duration = 2500;
        const end = Date.now() + duration;

        (function frame() {
            confetti({
                particleCount: 3,
                angle: 60,
                spread: 55,
                origin: { x: 0 },
                colors: ['#DFB755', '#F3D068', '#16A34A']
            });
            confetti({
                particleCount: 3,
                angle: 120,
                spread: 55,
                origin: { x: 1 },
                colors: ['#DFB755', '#F3D068', '#E11D48']
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());
    }

    // Dynamic High-Resolution Winner Certificate Generator
    function generateAndRenderCertificate() {
        const canvas = document.getElementById('winner-certificate-canvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.src = "{{ asset('img/certificate_template.jpg') }}";

        img.onload = function() {
            canvas.width = 1280;
            canvas.height = 960;
            ctx.drawImage(img, 0, 0, 1280, 960);

            const renderText = () => {
                @if(isset($searchResult) && $searchState === 'approved')
                    // 1. Draw Winner Name (Mr/Mrs -:) -> Bold Elegant Font & Rich Maroon
                    ctx.font = "italic 900 32px 'Playfair Display', 'Cinzel Decorative', Georgia, serif";
                    ctx.fillStyle = "#4A0710";
                    ctx.textAlign = "left";
                    ctx.textBaseline = "alphabetic";
                    const customerName = "{{ addslashes($searchResult['customer_name'] ?? 'Winner') }}";
                    ctx.fillText(customerName, 555, 486);

                    // 2. Draw Ticket Number(s) -> Extra Bold Dark Navy
                    ctx.font = "900 22px 'Outfit', monospace";
                    ctx.fillStyle = "#071533";
                    ctx.textAlign = "left";
                    ctx.textBaseline = "alphabetic";
                    const ticketNumbers = "{{ implode(', ', $searchResult['tickets'] ?? []) }}";
                    ctx.fillText(ticketNumbers, 505, 538);

                    // 3. Draw Date -> Extra Bold Dark Navy
                    ctx.font = "900 21px 'Outfit', sans-serif";
                    ctx.fillStyle = "#071533";
                    ctx.textAlign = "left";
                    ctx.textBaseline = "alphabetic";
                    const dateStr = "{{ !empty($searchResult['booked_at']) ? date('d-m-Y', strtotime($searchResult['booked_at'])) : date('d-m-Y') }}";
                    ctx.fillText(dateStr, 440, 580);
                @endif
            };

            if (document.fonts && document.fonts.ready) {
                document.fonts.ready.then(renderText);
            } else {
                renderText();
            }
        };
    }

    // Download HD Certificate as JPG
    function downloadCertificate() {
        const canvas = document.getElementById('winner-certificate-canvas');
        if (!canvas) return;

        const link = document.createElement('a');
        link.download = 'Maharaja_Winner_Certificate_{{ $searchResult['booking_ref'] ?? 'Winner' }}.jpg';
        link.href = canvas.toDataURL('image/jpeg', 0.95);
        link.click();
    }

    // Print Certificate
    function printCertificate() {
        const canvas = document.getElementById('winner-certificate-canvas');
        if (!canvas) return;

        const dataUrl = canvas.toDataURL('image/jpeg', 0.95);
        const win = window.open('', '_blank');
        if (!win) {
            alert('Please allow popups to print the certificate.');
            return;
        }

        win.document.title = 'Maharaja Winner Certificate';
        win.document.body.style.margin = '0';
        win.document.body.style.display = 'flex';
        win.document.body.style.alignItems = 'center';
        win.document.body.style.justifyContent = 'center';
        win.document.body.style.minHeight = '100vh';
        win.document.body.style.background = '#ffffff';

        const style = win.document.createElement('style');
        style.appendChild(win.document.createTextNode('@page { size: landscape; margin: 0; } img { max-width: 98vw; max-height: 96vh; object-fit: contain; }'));
        win.document.head.appendChild(style);

        const img = win.document.createElement('img');
        img.src = dataUrl;
        win.document.body.appendChild(img);

        setTimeout(function() {
            try {
                win.focus();
                win.print();
                win.close();
            } catch (e) {
                console.error(e);
            }
        }, 400);
    }

    // Popup Modal Timer & Transition Management
    let modalTimerId = null;
    let countdownIntervalId = null;

    function startWinnerPopupCountdown() {
        const modal = document.getElementById('winner-announcement-modal');
        const progressBar = document.getElementById('modal-progress-bar');
        const timerSecSpan = document.getElementById('popup-timer-sec');

        // Pre-render certificate in background so it's instantly crisp
        generateAndRenderCertificate();

        if (!modal) {
            triggerWinnerConfettiBoom();
            return;
        }

        // 1. Initial Confetti Boom on popup open
        setTimeout(triggerWinnerConfettiBoom, 300);

        // 2. Animate progress bar to 0% over 3000ms
        setTimeout(() => {
            if (progressBar) {
                progressBar.style.width = '0%';
            }
        }, 100);

        // 3. Countdown numbers (3 -> 2 -> 1 -> 0)
        let secondsLeft = 3;
        countdownIntervalId = setInterval(() => {
            secondsLeft--;
            if (timerSecSpan && secondsLeft >= 0) {
                timerSecSpan.innerText = secondsLeft;
            }
            if (secondsLeft <= 0) {
                clearInterval(countdownIntervalId);
            }
        }, 1000);

        // 4. Auto dismiss after 3.2s
        modalTimerId = setTimeout(() => {
            closeWinnerAnnouncementModal();
        }, 3200);
    }

    function closeWinnerAnnouncementModal() {
        const modal = document.getElementById('winner-announcement-modal');
        if (!modal) return;

        if (modalTimerId) clearTimeout(modalTimerId);
        if (countdownIntervalId) clearInterval(countdownIntervalId);

        // Smooth fade out
        modal.classList.remove('opacity-100', 'scale-100');
        modal.classList.add('opacity-0', 'scale-95', 'pointer-events-none');

        setTimeout(() => {
            modal.style.display = 'none';
        }, 500);

        // 5. Trigger second grand celebration boom & ensure certificate is ready
        setTimeout(() => {
            triggerWinnerConfettiBoom();
            generateAndRenderCertificate();
        }, 250);
    }

    // TDS Withdrawal Modal Controls
    function openTdsWithdrawalModal() {
        const modal = document.getElementById('tds-withdrawal-modal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            triggerWinnerConfettiBoom();
        }
    }

    function closeTdsWithdrawalModal() {
        const modal = document.getElementById('tds-withdrawal-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // Auto-initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($searchResult) && $searchState === 'approved' && ($isWinner ?? false))
            startWinnerPopupCountdown();
        @endif
    });
</script>
@endpush

@endsection

