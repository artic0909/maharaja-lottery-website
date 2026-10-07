@extends('admin.layouts.app')

@section('title', 'Admin Settings & Profile')
@section('page_title', 'Settings & Management')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#0B193E] via-[#071533] to-[#040A1A] rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#DFB755_1px,transparent_1px)] [background-size:12px_12px] pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] text-[11px] font-bold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-sliders text-xs"></i>
                    <span>System Configuration</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-serif font-black text-white">
                    Settings &amp; Profile Control
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 mt-1">
                    Manage master admin authentication, frontend hero banners, footer contact info, and social media links.
                </p>
            </div>

            <a href="{{ route('home') }}" target="_blank" 
                class="bg-white/10 hover:bg-white/20 text-[#DFB755] border border-[#DFB755]/40 px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition self-start sm:self-auto">
                <i class="fa-solid fa-eye text-xs"></i>
                <span>View Live Public Site</span>
            </a>
        </div>
    </div>

    <!-- Error Alert Display -->
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

    <!-- Settings Navigation Tabs Bar -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-white/10 hide-scroll">
        <button type="button" onclick="switchTab('profile')" id="tab-btn-profile"
            class="settings-tab-btn px-4 py-2.5 rounded-xl font-black text-xs transition flex items-center gap-2 bg-[#DFB755] text-[#071533] shadow-md shrink-0">
            <i class="fa-solid fa-user-shield"></i>
            <span>Admin Profile &amp; Password</span>
        </button>

        <button type="button" onclick="switchTab('hero')" id="tab-btn-hero"
            class="settings-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs text-stone-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition flex items-center gap-2 shrink-0">
            <i class="fa-solid fa-image"></i>
            <span>Hero Banner &amp; Content</span>
        </button>

        <button type="button" onclick="switchTab('footer')" id="tab-btn-footer"
            class="settings-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs text-stone-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition flex items-center gap-2 shrink-0">
            <i class="fa-solid fa-address-book"></i>
            <span>Footer Contacts &amp; Address</span>
        </button>

        <a href="{{ route('admin.upi.index') }}"
            class="settings-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs text-stone-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition flex items-center gap-2 shrink-0">
            <i class="fa-solid fa-qrcode text-[#DFB755]"></i>
            <span>UPI Gateways &amp; QR</span>
        </a>

        <button type="button" onclick="switchTab('social')" id="tab-btn-social"
            class="settings-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs text-stone-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition flex items-center gap-2 shrink-0">
            <i class="fa-solid fa-share-nodes"></i>
            <span>Top Bar Social Links</span>
        </button>
    </div>

    <!-- TAB 1: Admin Profile & Password Change -->
    <div id="tab-content-profile" class="settings-tab-content space-y-6">
        <div class="bg-[#071533]/90 rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl space-y-6">
            
            <div class="flex items-center gap-3 pb-4 border-b border-white/10">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-lock"></i>
                </div>
                <div>
                    <h3 class="text-lg font-serif font-black text-white">Admin Account Security &amp; Credentials</h3>
                    <p class="text-xs text-stone-400">Change your master login email and update your password.</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Admin Name -->
                    <div class="space-y-1.5">
                        <label for="admin_name" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Admin Name <span class="text-[#DFB755]">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                            <input type="text" name="name" id="admin_name" required
                                value="{{ old('name', $user->name) }}"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>

                    <!-- Admin Email -->
                    <div class="space-y-1.5">
                        <label for="admin_email" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Master Login Email <span class="text-[#DFB755]">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                            <input type="email" name="email" id="admin_email" required
                                value="{{ old('email', $user->email) }}"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>
                </div>

                <!-- Password Change Sub-section -->
                <div class="pt-4 border-t border-white/10 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-[#DFB755]">Change Password (Optional)</span>
                        <span class="text-[11px] text-stone-400">• Leave blank if you do not want to change your password</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Current Password -->
                        <div class="space-y-1.5">
                            <label for="current_password" class="block text-xs font-bold text-stone-300">Current Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-key absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                                <input type="password" name="current_password" id="current_password" placeholder="••••••••"
                                    class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-[#040A1A] border border-stone-700 text-xs text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition font-mono">
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="space-y-1.5">
                            <label for="new_password" class="block text-xs font-bold text-stone-300">New Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                                <input type="password" name="new_password" id="new_password" placeholder="Min. 8 characters"
                                    class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-[#040A1A] border border-stone-700 text-xs text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition font-mono">
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="space-y-1.5">
                            <label for="new_password_confirmation" class="block text-xs font-bold text-stone-300">Confirm New Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-shield-check absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Re-enter new password"
                                    class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-[#040A1A] border border-stone-700 text-xs text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition font-mono">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                        class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] px-6 py-3 rounded-xl font-black text-xs tracking-wide shadow-lg shadow-gold-500/20 hover:shadow-xl transition flex items-center gap-2 transform hover:scale-105">
                        <i class="fa-solid fa-check"></i>
                        <span>Save Account Profile</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- TAB 2: Hero Section & Banner Image Change -->
    <div id="tab-content-hero" class="settings-tab-content hidden space-y-6">
        <div class="bg-[#071533]/90 rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl space-y-6">
            
            <div class="flex items-center gap-3 pb-4 border-b border-white/10">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] flex items-center justify-center text-lg">
                    <i class="fa-solid fa-image"></i>
                </div>
                <div>
                    <h3 class="text-lg font-serif font-black text-white">Homepage Hero Banner &amp; Content</h3>
                    <p class="text-xs text-stone-400">Upload a custom promotional banner and customize hero headlines.</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.hero') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Current Banner Image Display & Upload -->
                <div class="space-y-3">
                    <label class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Hero Banner Graphics (Image Preview)
                    </label>
                    
                    <div class="p-4 bg-[#040A1A] rounded-2xl border border-stone-700 flex flex-col md:flex-row items-center gap-6">
                        <!-- Preview Image Container -->
                        <div class="w-full md:w-80 h-48 rounded-xl bg-[#0B193E] border-2 border-[#DFB755]/40 flex items-center justify-center overflow-hidden relative shadow-md">
                            @if(!empty($settings['hero_banner_image']) && file_exists(public_path($settings['hero_banner_image'])))
                                <img id="banner-preview" src="{{ asset($settings['hero_banner_image']) }}" alt="Hero Banner" class="w-full h-full object-cover">
                            @else
                                <div id="banner-default-view" class="text-center p-4">
                                    <i class="fa-solid fa-crown text-4xl text-[#F3D068] mb-2"></i>
                                    <p class="text-xs font-bold text-white uppercase">Maharaja Royal Banner</p>
                                    <span class="text-[10px] text-stone-400">Default Geometric Luxury Motif</span>
                                </div>
                                <img id="banner-preview" src="" alt="Hero Banner" class="w-full h-full object-cover hidden">
                            @endif
                        </div>

                        <!-- Upload Actions -->
                        <div class="space-y-3 flex-1 text-left">
                            <div class="space-y-1">
                                <h4 class="text-sm font-bold text-white">Upload New Hero Banner</h4>
                                <p class="text-xs text-stone-400">Recommended size: 1200 × 600 px. Supports JPG, PNG, WEBP up to 5MB.</p>
                            </div>

                            <input type="file" name="hero_banner_image" id="hero_banner_image" accept="image/*" class="hidden" onchange="previewBanner(this)">
                            
                            <div class="flex flex-wrap items-center gap-3 pt-1">
                                <button type="button" onclick="document.getElementById('hero_banner_image').click()" 
                                    class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-[#DFB755] border border-[#DFB755]/40 text-xs font-bold transition flex items-center gap-2">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <span>Choose New Image</span>
                                </button>

                                @if(!empty($settings['hero_banner_image']))
                                    <button type="button" onclick="document.getElementById('reset-banner-form').submit()" 
                                        class="px-3.5 py-2.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs font-bold transition flex items-center gap-1.5">
                                        <i class="fa-solid fa-trash-can"></i>
                                        <span>Reset to Default</span>
                                    </button>
                                @endif
                            </div>
                            <span id="selected-banner-filename" class="text-xs text-emerald-400 font-semibold block"></span>
                        </div>
                    </div>
                </div>

                <!-- Hero Taglines & Subtitle -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                    <!-- Title -->
                    <div class="space-y-1.5">
                        <label for="hero_title" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Hero Main Title <span class="text-[#DFB755]">*</span>
                        </label>
                        <input type="text" name="hero_title" id="hero_title" required
                            value="{{ old('hero_title', $settings['hero_title']) }}"
                            placeholder="e.g. Maharaja Lottery"
                            class="w-full px-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                    </div>

                    <!-- Subtitle -->
                    <div class="space-y-1.5">
                        <label for="hero_subtitle" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Hero Highlight Subtitle <span class="text-[#DFB755]">*</span>
                        </label>
                        <input type="text" name="hero_subtitle" id="hero_subtitle" required
                            value="{{ old('hero_subtitle', $settings['hero_subtitle']) }}"
                            placeholder="e.g. Tickets, Results & Support"
                            class="w-full px-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                    </div>
                </div>

                <!-- Hero Description -->
                <div class="space-y-1.5">
                    <label for="hero_description" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Hero Description Text <span class="text-[#DFB755]">*</span>
                    </label>
                    <textarea name="hero_description" id="hero_description" rows="3" required
                        class="w-full p-4 rounded-xl bg-[#040A1A] border border-stone-700 text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition leading-relaxed">{{ old('hero_description', $settings['hero_description']) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                        class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] px-6 py-3 rounded-xl font-black text-xs tracking-wide shadow-lg shadow-gold-500/20 hover:shadow-xl transition flex items-center gap-2 transform hover:scale-105">
                        <i class="fa-solid fa-check"></i>
                        <span>Save Hero Banner Settings</span>
                    </button>
                </div>

            </form>

            <!-- Hidden Reset Banner Form -->
            <form id="reset-banner-form" action="{{ route('admin.settings.hero.reset') }}" method="POST" class="hidden">
                @csrf
            </form>

        </div>
    </div>

    <!-- TAB 3: Footer Contact Details -->
    <div id="tab-content-footer" class="settings-tab-content hidden space-y-6">
        <div class="bg-[#071533]/90 rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl space-y-6">
            
            <div class="flex items-center gap-3 pb-4 border-b border-white/10">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] flex items-center justify-center text-lg">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <h3 class="text-lg font-serif font-black text-white">Footer Contact &amp; Directorate Address</h3>
                    <p class="text-xs text-stone-400">Update the phone numbers, support emails, and location shown in website footers.</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.footer') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Mobile Number -->
                    <div class="space-y-1.5">
                        <label for="contact_mobile" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Support Phone / Mobile <span class="text-[#DFB755]">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-phone absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                            <input type="text" name="contact_mobile" id="contact_mobile" required
                                value="{{ old('contact_mobile', $settings['contact_mobile']) }}"
                                placeholder="+91 87439 78796"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-1.5">
                        <label for="contact_email" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Official Support Email <span class="text-[#DFB755]">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-500 text-xs"></i>
                            <input type="email" name="contact_email" id="contact_email" required
                                value="{{ old('contact_email', $settings['contact_email']) }}"
                                placeholder="support@maharajalottery.com"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>
                </div>

                <!-- Office Address -->
                <div class="space-y-1.5">
                    <label for="contact_address" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Office / Directorate Physical Address <span class="text-[#DFB755]">*</span>
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-location-dot absolute left-3.5 top-4 text-stone-500 text-xs"></i>
                        <textarea name="contact_address" id="contact_address" rows="3" required
                            class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition leading-relaxed">{{ old('contact_address', $settings['contact_address']) }}</textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                        class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] px-6 py-3 rounded-xl font-black text-xs tracking-wide shadow-lg shadow-gold-500/20 hover:shadow-xl transition flex items-center gap-2 transform hover:scale-105">
                        <i class="fa-solid fa-check"></i>
                        <span>Save Footer Details</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- TAB 4: Top Bar & Social Media Links -->
    <div id="tab-content-social" class="settings-tab-content hidden space-y-6">
        <div class="bg-[#071533]/90 rounded-3xl p-6 sm:p-8 border border-[#DFB755]/30 shadow-xl space-y-6">
            
            <div class="flex items-center gap-3 pb-4 border-b border-white/10">
                <div class="w-10 h-10 rounded-xl bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#F3D068] flex items-center justify-center text-lg">
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                <div>
                    <h3 class="text-lg font-serif font-black text-white">Top Bar &amp; Social Links</h3>
                    <p class="text-xs text-stone-400">Configure direct links to WhatsApp, Facebook, Instagram, Twitter, and Telegram.</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.social') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- WhatsApp Link -->
                    <div class="space-y-1.5">
                        <label for="social_whatsapp" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            WhatsApp Link / Number URL
                        </label>
                        <div class="relative">
                            <i class="fa-brands fa-whatsapp absolute left-3.5 top-1/2 -translate-y-1/2 text-[#25D366] text-sm"></i>
                            <input type="text" name="social_whatsapp" id="social_whatsapp"
                                value="{{ old('social_whatsapp', $settings['social_whatsapp']) }}"
                                placeholder="https://wa.me/918743978796"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>

                    <!-- Facebook Link -->
                    <div class="space-y-1.5">
                        <label for="social_facebook" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Facebook Page URL
                        </label>
                        <div class="relative">
                            <i class="fa-brands fa-facebook absolute left-3.5 top-1/2 -translate-y-1/2 text-blue-500 text-sm"></i>
                            <input type="text" name="social_facebook" id="social_facebook"
                                value="{{ old('social_facebook', $settings['social_facebook']) }}"
                                placeholder="https://facebook.com/maharajalottery"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>

                    <!-- Instagram Link -->
                    <div class="space-y-1.5">
                        <label for="social_instagram" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Instagram Profile URL
                        </label>
                        <div class="relative">
                            <i class="fa-brands fa-instagram absolute left-3.5 top-1/2 -translate-y-1/2 text-pink-500 text-sm"></i>
                            <input type="text" name="social_instagram" id="social_instagram"
                                value="{{ old('social_instagram', $settings['social_instagram']) }}"
                                placeholder="https://instagram.com/maharajalottery"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>

                    <!-- Twitter / X Link -->
                    <div class="space-y-1.5">
                        <label for="social_twitter" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Twitter / X URL
                        </label>
                        <div class="relative">
                            <i class="fa-brands fa-x-twitter absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-300 text-sm"></i>
                            <input type="text" name="social_twitter" id="social_twitter"
                                value="{{ old('social_twitter', $settings['social_twitter']) }}"
                                placeholder="https://twitter.com/maharajalottery"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>

                    <!-- Telegram Link -->
                    <div class="space-y-1.5 md:col-span-2">
                        <label for="social_telegram" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Telegram Channel URL
                        </label>
                        <div class="relative">
                            <i class="fa-brands fa-telegram absolute left-3.5 top-1/2 -translate-y-1/2 text-sky-400 text-sm"></i>
                            <input type="text" name="social_telegram" id="social_telegram"
                                value="{{ old('social_telegram', $settings['social_telegram']) }}"
                                placeholder="https://t.me/maharajalottery"
                                class="w-full pl-9 pr-4 py-3 rounded-xl bg-[#040A1A] border border-stone-700 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                        class="bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] px-6 py-3 rounded-xl font-black text-xs tracking-wide shadow-lg shadow-gold-500/20 hover:shadow-xl transition flex items-center gap-2 transform hover:scale-105">
                        <i class="fa-solid fa-check"></i>
                        <span>Save Social Media Links</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.settings-tab-content').forEach(el => el.classList.add('hidden'));
        
        // Reset button states
        document.querySelectorAll('.settings-tab-btn').forEach(btn => {
            btn.className = "settings-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs text-stone-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition flex items-center gap-2 shrink-0";
        });

        // Show active tab
        const activeContent = document.getElementById('tab-content-' + tabName);
        const activeBtn = document.getElementById('tab-btn-' + tabName);

        if (activeContent) activeContent.classList.remove('hidden');
        if (activeBtn) {
            activeBtn.className = "settings-tab-btn px-4 py-2.5 rounded-xl font-black text-xs transition flex items-center gap-2 bg-[#DFB755] text-[#071533] shadow-md shrink-0";
        }
    }

    function previewBanner(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('banner-preview');
                const defaultView = document.getElementById('banner-default-view');
                if (defaultView) defaultView.classList.add('hidden');
                img.src = e.target.result;
                img.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
            document.getElementById('selected-banner-filename').textContent = 'Selected: ' . input.files[0].name;
        }
    }
</script>
@endpush
@endsection
