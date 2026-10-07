@extends('admin.layouts.app')

@section('title', 'UPI Gateways & QR Code Configuration')
@section('page_title', 'UPI Gateways & QR Management')

@section('content')
<div class="space-y-6 sm:space-y-8">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#0B193E] via-[#071533] to-[#040A1A] rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:12px_12px] pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] text-[11px] font-bold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-qrcode text-xs"></i>
                    <span>Payment Gateway Controls</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-serif font-black text-white">
                    UPI Gateways &amp; QR Code
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 mt-1">
                    Upload your official UPI QR code image or configure the dynamic UPI ID for instant customer checkout.
                </p>
            </div>

            <a href="{{ route('ticket.booking') }}" target="_blank" 
                class="bg-white/10 hover:bg-white/20 text-[#DFB755] border border-[#DFB755]/40 px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition self-start sm:self-auto">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                <span>Test Booking &amp; Payment</span>
            </a>
        </div>
    </div>

    <!-- Feedback Alerts -->
    @if(session('success'))
        <div class="bg-emerald-500/15 border border-emerald-500/40 rounded-2xl p-4 flex items-center gap-3 text-emerald-300 text-xs font-bold shadow-lg animate-in fade-in duration-200">
            <i class="fa-solid fa-circle-check text-emerald-400 text-base shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-rose-500/15 border border-rose-500/40 rounded-2xl p-4 text-rose-300 text-xs shadow-lg">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i class="fa-solid fa-circle-exclamation text-base"></i>
                <span>Please correct the errors below:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Form Configuration (7 cols) -->
        <div class="lg:col-span-7 bg-[#071533]/90 rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl space-y-6">
            
            <div class="flex items-center justify-between pb-4 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] flex items-center justify-center text-lg">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-serif font-black text-white">Gateway Details</h3>
                        <p class="text-xs text-stone-400">Configure your primary UPI ID and upload QR screenshot.</p>
                    </div>
                </div>

                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $settings['upi_status'] ?? 'Active' }}
                </span>
            </div>

            <form action="{{ route('admin.settings.upi') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- UPI ID (VPA) -->
                <div class="space-y-1.5">
                    <label for="upi_id" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Verified UPI ID (VPA) <span class="text-[#DFB755]">*</span>
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-at absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                        <input type="text" name="upi_id" id="upi_id" required
                            value="{{ old('upi_id', $settings['upi_id']) }}"
                            placeholder="e.g. 9288309113@mairtel or yourname@okaxis"
                            class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm font-mono text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                    </div>
                    <p class="text-[11px] text-stone-400">This UPI ID is used for PhonePe, Google Pay, and Paytm direct payment links.</p>
                </div>

                <!-- Payee / Merchant Name -->
                <div class="space-y-1.5">
                    <label for="payee_name" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Payee / Merchant Display Name <span class="text-[#DFB755]">*</span>
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-building-columns absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                        <input type="text" name="payee_name" id="payee_name" required
                            value="{{ old('payee_name', $settings['payee_name']) }}"
                            placeholder="e.g. Maharaja Lottery"
                            class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                    </div>
                </div>

                <!-- Gateway Status -->
                <div class="space-y-1.5">
                    <label for="upi_status" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Gateway Status
                    </label>
                    <select name="upi_status" id="upi_status"
                        class="w-full px-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        <option value="Active" {{ ($settings['upi_status'] ?? '') === 'Active' ? 'selected' : '' }}>Active (Accepting Payments)</option>
                        <option value="Maintenance" {{ ($settings['upi_status'] ?? '') === 'Maintenance' ? 'selected' : '' }}>Maintenance Mode</option>
                    </select>
                </div>

                <!-- QR Code Image Upload Area -->
                <div class="space-y-2 pt-2 border-t border-white/10">
                    <label class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Custom QR Code Image (Upload New Screenshot / Image)
                    </label>
                    
                    <div class="border-2 border-dashed border-[#DFB755]/40 hover:border-[#DFB755] rounded-2xl p-5 sm:p-6 text-center cursor-pointer bg-[#040A1A]/60 transition group"
                        onclick="document.getElementById('qr-file-input').click()">
                        <input type="file" name="upi_qr_image" id="qr-file-input" accept="image/png,image/jpeg,image/jpg,image/webp" class="hidden" onchange="previewQrUpload(this)">
                        
                        <div id="upload-default-prompt" class="space-y-2">
                            <div class="w-12 h-12 rounded-2xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755] flex items-center justify-center text-xl mx-auto group-hover:scale-110 transition">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <p class="text-xs font-bold text-white">Click or tap to upload custom QR Code image</p>
                            <p class="text-[10px] text-stone-400">Supported formats: PNG, JPG, JPEG, WEBP (Max: 5MB)</p>
                        </div>

                        <div id="upload-preview-container" class="hidden space-y-2">
                            <img id="upload-preview-img" src="" alt="QR Preview" class="w-36 h-36 mx-auto rounded-xl object-contain border border-[#DFB755]/50 bg-white p-2">
                            <p id="upload-preview-name" class="text-xs font-bold text-[#F3D068]"></p>
                            <span class="inline-block text-[10px] text-stone-400">Click to change selected image</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2 flex items-center justify-end gap-3">
                    <button type="submit" 
                        class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B8860B] hover:to-[#DFB755] text-[#071533] px-6 py-3 rounded-xl font-black text-xs sm:text-sm tracking-wide transition shadow-lg flex items-center gap-2 transform active:scale-98">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Save UPI &amp; QR Settings</span>
                    </button>
                </div>

            </form>

        </div>

        <!-- Right Column: Live Frontend QR Preview (5 cols) -->
        <div class="lg:col-span-5 bg-[#071533]/90 rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl space-y-6">
            
            <div class="flex items-center gap-3 pb-4 border-b border-white/10">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] flex items-center justify-center text-lg">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div>
                    <h3 class="text-lg font-serif font-black text-white">Customer Live Preview</h3>
                    <p class="text-xs text-stone-400">How the QR code appears on the checkout page.</p>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="bg-white rounded-2xl p-5 text-center space-y-4 border-2 border-[#DFB755]/40 shadow-2xl">
                
                <div class="space-y-0.5">
                    <span class="text-[9px] uppercase font-extrabold tracking-widest text-[#0B193E] block">
                        SCAN AND PAY
                    </span>
                    <h4 class="text-base font-serif font-black text-stone-900">
                        {{ $settings['payee_name'] }}
                    </h4>
                </div>

                <!-- QR Image Display -->
                <div class="flex justify-center">
                    <div class="relative p-2.5 bg-white rounded-2xl border-2 border-[#DFB755]/40 shadow-md">
                        @if(!empty($settings['upi_qr_image']) && file_exists(public_path($settings['upi_qr_image'])))
                            <img src="{{ asset($settings['upi_qr_image']) }}?v={{ time() }}" 
                                alt="Custom UPI QR" 
                                class="w-44 h-44 object-contain rounded-xl mx-auto select-none">
                        @else
                            @php
                                $sampleUpiUrl = "upi://pay?pa=" . urlencode($settings['upi_id']) . "&pn=" . urlencode($settings['payee_name']) . "&cu=INR";
                            @endphp
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode($sampleUpiUrl) }}&margin=2" 
                                alt="Dynamic UPI QR" 
                                class="w-44 h-44 object-contain rounded-xl mx-auto select-none">
                        @endif
                    </div>
                </div>

                <!-- Mode Indicator Badge -->
                <div>
                    @if(!empty($settings['upi_qr_image']) && file_exists(public_path($settings['upi_qr_image'])))
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-800 border border-emerald-300">
                            <i class="fa-solid fa-image"></i> Custom Uploaded QR Active
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase bg-blue-100 text-blue-800 border border-blue-300">
                            <i class="fa-solid fa-wand-magic-sparkles"></i> Auto Dynamic QR Active
                        </span>
                    @endif
                </div>

                <!-- UPI ID Bar -->
                <div class="bg-stone-50 border border-stone-200 rounded-xl p-2 flex items-center justify-between text-left">
                    <div class="min-w-0 pr-2">
                        <span class="block text-[8px] uppercase font-bold text-stone-400">Verified UPI ID</span>
                        <span class="text-xs font-mono font-bold text-stone-800 truncate block">{{ $settings['upi_id'] }}</span>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Active</span>
                </div>

            </div>

            @if(!empty($settings['upi_qr_image']) && file_exists(public_path($settings['upi_qr_image'])))
                <!-- Reset / Remove Custom QR Button -->
                <form action="{{ route('admin.settings.upi.reset_qr') }}" method="POST" class="pt-2">
                    @csrf
                    <button type="submit" 
                        onclick="return confirm('Are you sure you want to remove the custom QR image and revert to auto-generated dynamic QR?')"
                        class="w-full bg-rose-500/15 hover:bg-rose-500/25 text-rose-300 hover:text-rose-200 border border-rose-500/30 py-2.5 px-4 rounded-xl text-xs font-bold transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-trash-can"></i>
                        <span>Remove Custom QR (Revert to Auto Dynamic QR)</span>
                    </button>
                </form>
            @endif

        </div>

    </div>

</div>

@push('scripts')
<script>
    function previewQrUpload(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('upload-default-prompt').classList.add('hidden');
                const container = document.getElementById('upload-preview-container');
                const img = document.getElementById('upload-preview-img');
                const nameEl = document.getElementById('upload-preview-name');
                
                img.src = e.target.result;
                nameEl.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
