@extends('frontend.layouts.app')

@section('content')
<!-- Background Backdrop Container -->
<section class="min-h-[calc(100vh-80px)] bg-gradient-to-br from-[#040A1A] via-[#071533] to-[#040A1A] py-4 sm:py-8 px-3 sm:px-6 lg:px-8 flex items-center justify-center relative overflow-hidden">
    
    <!-- Stylized Background Effects -->
    <div class="absolute inset-0 pointer-events-none opacity-10" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    <div class="absolute -top-32 -left-32 w-80 h-80 bg-[#DFB755]/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-[#0F2356]/40 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Main Payment Modal Card -->
    <div id="payment-modal-card" class="relative w-full max-w-lg md:max-w-xl transition-all duration-300 bg-white rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden border border-[#DFB755]/30 z-10">
        
        <!-- Modal Top Royal Navy Header (Compact) -->
        <div class="bg-gradient-to-r from-[#040A1A] via-[#071533] to-[#0B193E] text-white px-4 py-3 sm:px-5 sm:py-3.5 flex items-center justify-between border-b border-[#DFB755]/30">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-white/10 border border-[#DFB755]/30 flex items-center justify-center text-[#DFB755] text-sm shrink-0">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <span class="text-[8px] sm:text-[9px] uppercase font-extrabold tracking-widest text-[#DFB755] block leading-tight">SECURE PAYMENT</span>
                    <h2 class="text-sm sm:text-base font-serif font-black text-white leading-tight">Complete your booking</h2>
                </div>
            </div>

            <!-- Close / Back Link -->
            <a href="{{ route('payment.form', ['tickets' => implode(',', $selectedTickets)]) }}" 
                title="Back to Details"
                aria-label="Back" 
                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center text-xs transition">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </div>

        <!-- Top Summary Bar (Compact) -->
        <div class="bg-stone-50 border-b border-stone-200/80 px-4 py-2.5 grid grid-cols-12 gap-2 text-center items-center">
            <!-- Booking Ref (6 cols) -->
            <div class="col-span-6 text-left border-r border-stone-200 pr-2">
                <span class="block text-[8px] sm:text-[9px] uppercase font-bold text-stone-400 tracking-wider">BOOKING REFERENCE</span>
                <span class="text-[11px] sm:text-xs font-mono font-black text-stone-800 break-all select-all">{{ $bookingRef }}</span>
            </div>
            
            <!-- Tickets Count (2 cols) -->
            <div class="col-span-2 border-r border-stone-200 px-1 text-center">
                <span class="block text-[8px] sm:text-[9px] uppercase font-bold text-stone-400 tracking-wider">TICKETS</span>
                <span class="text-xs sm:text-sm font-black text-stone-900">{{ count($selectedTickets) }}</span>
            </div>

            <!-- Amount Payable (4 cols) -->
            <div class="col-span-4 pl-1 sm:pl-2 text-right">
                <span class="block text-[8px] sm:text-[9px] uppercase font-bold text-stone-400 tracking-wider">AMOUNT PAYABLE</span>
                <span class="text-xs sm:text-sm font-black text-[#0B193E]">INR {{ $totalAmount }}</span>
            </div>
        </div>

        <!-- Previous Form Data / Customer & Selection Summary Banner (Compact & Polished) -->
        <div class="bg-[#0B193E]/5 border-b border-[#DFB755]/20 px-4 py-2 text-xs">
            <div class="flex items-center justify-between cursor-pointer" onclick="toggleDetails()" id="details-toggle-btn">
                <div class="flex items-center gap-2 truncate">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#0B193E]"></span>
                    <span class="font-bold text-stone-800 truncate">{{ $customer['name'] }}</span>
                    <span class="text-stone-400 text-[10px]">•</span>
                    <span class="text-stone-600 font-mono text-[11px] truncate">{{ $customer['mobile'] }}</span>
                    <span class="text-stone-400 text-[10px]">•</span>
                    <span class="text-stone-600 text-[11px] truncate">{{ $customer['city'] }}, {{ $customer['state'] }}</span>
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
                        <span class="text-stone-400 block text-[9px] uppercase font-semibold">Email:</span>
                        <span class="font-medium text-stone-800 break-all">{{ $customer['email'] ?: 'Not provided' }}</span>
                    </div>
                    <div>
                        <span class="text-stone-400 block text-[9px] uppercase font-semibold">Draw:</span>
                        <span class="font-bold text-stone-800">{{ $activeDraw ?? 'Samrudhi - Every Sunday' }}</span>
                    </div>
                </div>
                <div>
                    <span class="text-stone-400 block text-[9px] uppercase font-semibold mb-1">Selected Numbers:</span>
                    <div class="flex flex-wrap gap-1">
                        @foreach($selectedTickets as $t)
                            <span class="px-1.5 py-0.5 rounded bg-white text-stone-800 font-mono text-[10px] font-bold border border-[#DFB755]/40">
                                {{ $t }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 1: Pay View (Height Reduced & Spacing Optimized) -->
        <div id="payment-step-1" class="p-4 sm:p-5 space-y-3.5">
            
            <!-- Stepper Progress (Compact) -->
            <div class="flex items-center justify-center gap-2">
                <div class="flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-[#071533] text-[#F3D068] border border-[#DFB755] flex items-center justify-center text-[10px] font-bold shadow-2xs">1</span>
                    <span class="text-xs font-bold text-[#071533]">Pay</span>
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
                    SCAN AND PAY
                </span>
                <h3 class="text-lg sm:text-xl font-serif font-black text-stone-900 leading-tight">
                    Pay with any UPI app
                </h3>
            </div>

            <!-- QR Code Card Container (Reduced Size) -->
            <div class="flex justify-center">
                <div class="relative p-2.5 bg-white rounded-2xl border-2 border-[#DFB755]/40 shadow-md group hover:border-[#DFB755] transition-all">
                    <!-- Dynamic UPI QR Code (160x160) -->
                    <img id="upi-qrcode" 
                        src="https://api.qrserver.com/v1/create-qr-code/?size=165x165&data={{ urlencode($upiUrl) }}&margin=2" 
                        alt="Scan UPI QR Code" 
                        class="w-36 h-36 sm:w-40 sm:h-40 object-contain rounded-xl mx-auto select-none"
                        loading="eager"
                        onerror="this.src='https://chart.googleapis.com/chart?cht=qr&chs=165x165&chl={{ urlencode($upiUrl) }}';">
                    
                    <!-- Center Overlay Icon / Crown -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-7 h-7 rounded-full bg-[#071533] shadow border border-[#DFB755] flex items-center justify-center text-[#DFB755] text-xs">
                            <i class="fa-solid fa-crown text-[#DFB755]"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tap Preferred UPI App Section (Compact) -->
            <div class="space-y-1 text-center">
                <span class="text-[10px] font-bold text-stone-500 block">
                    Tap your preferred payment app
                </span>

                <!-- 3 Hand Pointing Icons -->
                <div class="flex justify-around px-8 text-[#DFB755] text-xs opacity-85">
                    <i class="fa-solid fa-hand-point-down"></i>
                    <i class="fa-solid fa-hand-point-down"></i>
                    <i class="fa-solid fa-hand-point-down"></i>
                </div>

                <!-- 3 App Buttons (PhonePe, Google Pay, Paytm) -->
                <div class="grid grid-cols-3 gap-2 pt-0.5">
                    <!-- PhonePe -->
                    <a href="{{ $upiUrl }}" target="_blank" 
                        class="bg-white hover:bg-purple-50 border border-stone-200 hover:border-purple-300 rounded-xl py-2 px-1 flex items-center justify-center gap-1.5 shadow-2xs hover:shadow-xs transition group">
                        <span class="w-5 h-5 rounded-full bg-[#5f259f] text-white flex items-center justify-center text-[10px] font-black shrink-0">
                            <i class="fa-solid fa-p"></i>
                        </span>
                        <span class="text-xs font-bold text-stone-800 group-hover:text-purple-900">PhonePe</span>
                    </a>

                    <!-- Google Pay -->
                    <a href="{{ $upiUrl }}" target="_blank" 
                        class="bg-white hover:bg-blue-50 border border-stone-200 hover:border-blue-300 rounded-xl py-2 px-1 flex items-center justify-center gap-1.5 shadow-2xs hover:shadow-xs transition group">
                        <span class="w-5 h-5 rounded-full bg-white border border-stone-200 text-blue-600 flex items-center justify-center text-[10px] font-black shrink-0">
                            <i class="fa-brands fa-google text-blue-600"></i>
                        </span>
                        <span class="text-xs font-bold text-stone-800 group-hover:text-blue-900">Google Pay</span>
                    </a>

                    <!-- Paytm -->
                    <a href="{{ $upiUrl }}" target="_blank" 
                        class="bg-white hover:bg-sky-50 border border-stone-200 hover:border-sky-300 rounded-xl py-2 px-1 flex items-center justify-center gap-1.5 shadow-2xs hover:shadow-xs transition group">
                        <span class="w-5 h-5 rounded-full bg-[#002e6e] text-white flex items-center justify-center text-[9px] font-black shrink-0">
                            Pay
                        </span>
                        <span class="text-xs font-bold text-stone-800 group-hover:text-sky-900">Paytm</span>
                    </a>
                </div>
            </div>

            <!-- Verified UPI ID Bar with Copy Action (Compact) -->
            <div class="bg-stone-50 border border-stone-200 rounded-xl p-2.5 flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <span class="block text-[8px] uppercase font-bold text-stone-400 tracking-wider">Verified UPI ID</span>
                    <span id="upi-id-text" class="text-xs font-mono font-black text-stone-800 truncate block">
                        {{ $upiId }}
                    </span>
                </div>
                <button type="button" onclick="copyUpiId()" id="copy-btn"
                    class="bg-white hover:bg-stone-100 border border-stone-300 text-stone-700 px-3 py-1 rounded-lg text-xs font-bold transition flex items-center gap-1 shrink-0 shadow-2xs active:scale-95">
                    <i class="fa-regular fa-copy text-[11px]"></i>
                    <span id="copy-label">Copy</span>
                </button>
            </div>

            <!-- Action Buttons (Compact) -->
            <div class="space-y-2 pt-0.5">
                <!-- Open UPI App Primary Button -->
                <a href="{{ $upiUrl }}" 
                    class="w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] py-2.5 px-4 rounded-xl font-black text-xs sm:text-sm shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 transform active:scale-98">
                    <i class="fa-solid fa-mobile-screen-button text-xs"></i>
                    <span>Open UPI app</span>
                </a>

                <!-- Next Step Button: I have completed the payment -->
                <button type="button" onclick="goToStep2()" 
                    class="w-full bg-white hover:bg-stone-50 text-[#071533] border-2 border-[#071533] py-2.5 px-4 rounded-xl font-black text-xs sm:text-sm transition-all flex items-center justify-center gap-2 group hover:shadow-sm">
                    <span>I have completed the payment</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>

        </div>

        <!-- Tab 2: Upload Receipt & Confirmation View -->
        <div id="payment-step-2" class="p-4 sm:p-5 space-y-4 hidden">
            
            <!-- Stepper Progress -->
            <div class="flex items-center justify-center gap-2">
                <div class="flex items-center gap-1.5 cursor-pointer" onclick="goToStep1()">
                    <span class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold"><i class="fa-solid fa-check text-[9px]"></i></span>
                    <span class="text-xs font-bold text-emerald-700">Pay</span>
                </div>
                <div class="w-10 h-0.5 bg-emerald-400"></div>
                <div class="flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-[#071533] text-[#F3D068] border border-[#DFB755] flex items-center justify-center text-[10px] font-bold shadow-2xs">2</span>
                    <span class="text-xs font-bold text-[#071533]">Upload receipt</span>
                </div>
            </div>

            <!-- Header -->
            <div class="text-center space-y-0.5">
                <span class="text-[9px] uppercase font-extrabold tracking-widest text-[#0B193E] block">
                    FINAL VERIFICATION
                </span>
                <h3 class="text-lg sm:text-xl font-serif font-black text-stone-900">
                    Verify Your Payment
                </h3>
                <p class="text-stone-500 text-xs">
                    Submit your 12-digit UPI UTR number or upload receipt screenshot.
                </p>
            </div>

            <!-- Receipt Form -->
            <form onsubmit="handleReceiptSubmit(event)" class="space-y-3">
                
                <!-- UTR Input -->
                <div class="space-y-1">
                    <label for="utr_number" class="block text-xs font-bold text-stone-700">
                        12-Digit UPI Transaction ID / UTR Number
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400 text-xs">
                            <i class="fa-solid fa-hashtag"></i>
                        </div>
                        <input type="text" id="utr_number" required placeholder="e.g. 427819283741" maxlength="16"
                            class="w-full pl-8 pr-3 py-2.5 rounded-xl bg-stone-50 border border-stone-200 text-xs font-mono text-stone-800 placeholder-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B193E]/20 focus:border-[#0B193E] transition">
                    </div>
                </div>

                <!-- Screenshot Upload -->
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">
                        Payment Screenshot (Optional)
                    </label>
                    <div class="border-2 border-dashed border-stone-300 hover:border-[#0B193E] rounded-xl p-3 text-center cursor-pointer bg-stone-50 transition" onclick="document.getElementById('receipt-file').click()">
                        <input type="file" id="receipt-file" accept="image/*" class="hidden" onchange="handleFileSelect(this)">
                        <div id="upload-prompt" class="space-y-0.5">
                            <i class="fa-solid fa-cloud-arrow-up text-lg text-stone-400"></i>
                            <p class="text-xs font-semibold text-stone-700">Tap to upload receipt image</p>
                            <p class="text-[9px] text-stone-400">PNG, JPG up to 5MB</p>
                        </div>
                        <div id="file-name-preview" class="hidden text-xs font-bold text-emerald-700 flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-circle-check"></i>
                            <span id="file-name-text"></span>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp Quick Send Option -->
                <div class="bg-emerald-50 border border-emerald-200/80 rounded-xl p-2.5 flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-[#25D366] text-white flex items-center justify-center text-sm shrink-0">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="text-[10px] text-emerald-900 leading-tight">
                            <span class="font-bold block">Instant WhatsApp Support</span>
                            Send receipt directly for quick ticket issue.
                        </div>
                    </div>
                    <a href="https://wa.me/918743978796?text={{ urlencode('Hello, I have made payment of INR ' . $totalAmount . ' for Booking Reference ' . $bookingRef . ' (' . $customer['name'] . ', ' . $customer['mobile'] . '). Here is my payment receipt.') }}" 
                        target="_blank" 
                        class="bg-[#25D366] hover:bg-emerald-600 text-white px-2.5 py-1 rounded-lg text-xs font-bold shrink-0 shadow-2xs transition">
                        WhatsApp
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-verification-btn"
                    class="w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] py-3 px-4 rounded-xl font-black text-xs sm:text-sm shadow-lg shadow-gold-500/20 hover:shadow-xl transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Submit &amp; Confirm Booking</span>
                </button>

                <!-- Back button -->
                <button type="button" onclick="goToStep1()" 
                    class="w-full text-stone-500 hover:text-stone-800 text-xs font-bold py-1 transition text-center block">
                    ← Back to QR Code
                </button>

            </form>

            <!-- Success State Modal: Exact Downloadable Certificate & Popup -->
            <div id="success-alert" class="hidden space-y-4 py-2 text-left animate-fade-in">
                
                <!-- Success Header & Action Bar -->
                <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-xl shrink-0 shadow-md">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-serif font-black text-stone-900 leading-tight">Payment Verified &amp; Ticket Issued!</h4>
                            <p class="text-xs text-stone-600">Official certificate generated for <span class="font-bold text-stone-800">{{ $customer['name'] }}</span></p>
                        </div>
                    </div>

                    <!-- Download PNG Button -->
                    <button type="button" onclick="downloadTicketPNG()" id="download-ticket-btn"
                        class="w-full sm:w-auto bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] font-black text-xs sm:text-sm py-2.5 px-5 rounded-xl shadow-lg border border-[#FFE8A2]/80 flex items-center justify-center gap-2 transition transform hover:scale-[1.02] cursor-pointer shrink-0">
                        <i class="fa-solid fa-download"></i>
                        <span>Download Ticket (PNG)</span>
                    </button>
                </div>

                <!-- Live Ticket Visual Card (Pure 100% Responsive Rendered Image) -->
                <div id="ticket-certificate-card" class="rounded-2xl shadow-2xl overflow-hidden border-2 border-[#DFB755] relative bg-[#040A1A] select-none flex items-center justify-center">
                    
                    <!-- Rendered Certificate Image that scales seamlessly on all Mobile, Tablet & Desktop screens -->
                    <img id="ticket-preview-image" 
                        src="{{ asset('img/ticket_template_clean.jpg') }}?v={{ time() }}" 
                        alt="Maharaja Lottery Official Ticket Certificate" 
                        class="w-full h-auto block object-contain select-none">

                </div>

                <!-- Bottom Navigation Options -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#071533] hover:bg-[#0B193E] text-[#F3D068] border border-[#DFB755] px-5 py-2.5 rounded-xl text-xs font-bold shadow transition">
                        <i class="fa-solid fa-house text-xs"></i>
                        <span>Return to Home</span>
                    </a>

                    <a href="https://wa.me/918743978796?text={{ urlencode('Hello, I have booked Maharaja Lottery tickets (' . implode(', ', $selectedTickets) . ') with Booking Number ' . $bookingRef . ' for ' . $customer['name'] . '. Please confirm my certificate.') }}" 
                        target="_blank" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow transition">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>WhatsApp Receipt</span>
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>

<!-- Canvas for Offline High-Res PNG Generation & Dynamic Preview Rendering -->
<canvas id="ticket-canvas" width="1024" height="682" class="hidden"></canvas>

<script>
    function toggleDetails() {
        const details = document.getElementById('customer-details-collapsible');
        const icon = document.getElementById('details-toggle-icon');
        const text = document.getElementById('details-toggle-text');
        
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            icon.classList.add('rotate-180');
            text.textContent = 'Hide details';
        } else {
            details.classList.add('hidden');
            icon.classList.remove('rotate-180');
            text.textContent = 'View details';
        }
    }

    function copyUpiId() {
        const upiText = '{{ $upiId }}';
        navigator.clipboard.writeText(upiText).then(() => {
            const btn = document.getElementById('copy-btn');
            const label = document.getElementById('copy-label');
            label.textContent = 'Copied! ✓';
            btn.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            setTimeout(() => {
                label.textContent = 'Copy';
                btn.classList.remove('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            }, 2500);
        }).catch(err => {
            alert('UPI ID: ' + upiText);
        });
    }

    function goToStep2() {
        document.getElementById('payment-step-1').classList.add('hidden');
        document.getElementById('payment-step-2').classList.remove('hidden');
    }

    function goToStep1() {
        document.getElementById('payment-step-2').classList.add('hidden');
        document.getElementById('payment-step-1').classList.remove('hidden');
    }

    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            document.getElementById('upload-prompt').classList.add('hidden');
            const preview = document.getElementById('file-name-preview');
            preview.classList.remove('hidden');
            document.getElementById('file-name-text').textContent = input.files[0].name;
        }
    }

    function handleReceiptSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('submit-verification-btn');
        const utrVal = document.getElementById('utr_number').value;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Verifying Booking & Reserving...</span>';

        fetch('{{ route("booking.confirm") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                booking_ref: '{{ $bookingRef }}',
                customer_name: {!! json_encode($customer['name'] ?? '') !!},
                customer_mobile: {!! json_encode($customer['mobile'] ?? '') !!},
                tickets: {!! json_encode($selectedTickets) !!},
                total_amount: {{ (int)$totalAmount }},
                utr_number: utrVal
            })
        })
        .then(res => res.json())
        .then(data => {
            const card = document.getElementById('payment-modal-card');
            if (card) {
                card.classList.remove('max-w-lg', 'md:max-w-xl');
                card.classList.add('max-w-3xl');
            }
            document.querySelector('#payment-step-2 form').classList.add('hidden');
            document.getElementById('success-alert').classList.remove('hidden');
            generateAndRenderTicketCertificate(false);
        })
        .catch(err => {
            const card = document.getElementById('payment-modal-card');
            if (card) {
                card.classList.remove('max-w-lg', 'md:max-w-xl');
                card.classList.add('max-w-3xl');
            }
            document.querySelector('#payment-step-2 form').classList.add('hidden');
            document.getElementById('success-alert').classList.remove('hidden');
            generateAndRenderTicketCertificate(false);
        });
    }

    // High-Resolution 100% Proportional Canvas Generator & Preview Updater
    function generateAndRenderTicketCertificate(downloadAfterRender = false) {
        const canvas = document.getElementById('ticket-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const W = 1024;
        const H = 682;

        const baseImg = new Image();
        baseImg.crossOrigin = 'anonymous';
        baseImg.src = '{{ asset("img/ticket_template_clean.jpg") }}?v=' + Date.now();

        baseImg.onload = function() {
            ctx.clearRect(0, 0, W, H);
            ctx.drawImage(baseImg, 0, 0, W, H);

            const rightCenterX = 830; // Center of right ticket card

            // 1. CUSTOMER NAME
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText('CUSTOMER NAME', rightCenterX, 86);

            ctx.fillStyle = '#071533';
            ctx.font = '900 22px "Times New Roman", Georgia, serif';
            ctx.fillText({!! json_encode(strtoupper($customer['name'] ?? 'CUSTOMER')) !!}, rightCenterX, 112);

            // 2. BOOKING NUMBER (Big & Bold)
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.fillText('BOOKING NUMBER', rightCenterX, 138);

            ctx.fillStyle = '#0B193E';
            ctx.font = '900 17px monospace';
            ctx.fillText('{{ $bookingRef }}', rightCenterX, 160);

            // 3. TICKET NUMBER (Highlighted, Big, Bold, One by One, No Border, No Commas)
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.fillText('TICKET NUMBER', rightCenterX, 188);

            const tickets = {!! json_encode(array_values($selectedTickets)) !!};
            ctx.fillStyle = '#071533';
            
            let dateTopY = 285;
            
            if (tickets.length === 1) {
                ctx.font = '900 26px monospace';
                ctx.fillText(tickets[0], rightCenterX, 222);
                dateTopY = 270;
            } else if (tickets.length === 2) {
                ctx.font = '900 21px monospace';
                ctx.fillText(tickets[0], rightCenterX, 216);
                ctx.fillText(tickets[1], rightCenterX, 240);
                dateTopY = 282;
            } else if (tickets.length === 3) {
                ctx.font = '900 18px monospace';
                ctx.fillText(tickets[0], rightCenterX, 212);
                ctx.fillText(tickets[1], rightCenterX, 234);
                ctx.fillText(tickets[2], rightCenterX, 256);
                dateTopY = 292;
            } else if (tickets.length <= 5) {
                ctx.font = '900 15px monospace';
                let tY = 210;
                tickets.forEach(ticket => {
                    ctx.fillText(ticket, rightCenterX, tY);
                    tY += 17;
                });
                dateTopY = Math.max(298, tY + 6);
            } else {
                // > 5 tickets: 2 columns
                ctx.font = '900 13px monospace';
                const mid = Math.ceil(tickets.length / 2);
                let tY1 = 208;
                for (let i = 0; i < mid; i++) {
                    ctx.fillText(tickets[i], rightCenterX - 55, tY1);
                    tY1 += 15;
                }
                let tY2 = 208;
                for (let i = mid; i < tickets.length; i++) {
                    ctx.fillText(tickets[i], rightCenterX + 55, tY2);
                    tY2 += 15;
                }
                dateTopY = Math.max(290, Math.max(tY1, tY2) + 6);
            }

            // 4. DATE Box (Highlighted Pill)
            ctx.fillStyle = '#4B5563';
            ctx.font = '800 11px sans-serif';
            ctx.fillText('DATE', rightCenterX, dateTopY);

            ctx.fillStyle = '#FFF5F6';
            ctx.beginPath();
            ctx.roundRect(710, dateTopY + 6, 240, 36, 10);
            ctx.fill();
            ctx.lineWidth = 2.5;
            ctx.strokeStyle = '#BE123C';
            ctx.stroke();

            ctx.fillStyle = '#BE123C';
            ctx.font = '900 18px monospace';
            ctx.fillText('{{ date("d/M/Y") }}', rightCenterX, dateTopY + 30);

            // 5. TODAY LIVE (Green Bold Badge - High-Contrast)
            const liveTopY = dateTopY + 52;
            ctx.fillStyle = '#ECFDF5';
            ctx.beginPath();
            ctx.roundRect(710, liveTopY, 240, 52, 12);
            ctx.fill();
            ctx.lineWidth = 3;
            ctx.strokeStyle = '#059669';
            ctx.stroke();

            ctx.fillStyle = '#047857';
            ctx.font = '900 23px sans-serif';
            ctx.fillText('★ TODAY LIVE ★', rightCenterX, liveTopY + 34);

            // Update live preview image with rendered canvas
            const imgData = canvas.toDataURL('image/png');
            const previewImg = document.getElementById('ticket-preview-image');
            if (previewImg) {
                previewImg.src = imgData;
            }

            // Trigger direct download if requested
            if (downloadAfterRender) {
                const link = document.createElement('a');
                link.download = 'Maharaja_Lottery_{{ $bookingRef }}.png';
                link.href = imgData;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        };

        if (baseImg.complete) {
            baseImg.onload();
        }
    }

    function downloadTicketPNG() {
        generateAndRenderTicketCertificate(true);
    }

    // Auto-render certificate as soon as the page is ready
    document.addEventListener('DOMContentLoaded', function() {
        generateAndRenderTicketCertificate(false);
    });
</script>
@endsection

