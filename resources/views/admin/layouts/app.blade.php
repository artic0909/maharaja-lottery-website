<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Maharaja Lottery Directorate</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Hide scrollbars for sidebar and modals */
        .no-scrollbar::-webkit-scrollbar,
        #admin-sidebar::-webkit-scrollbar,
        #admin-sidebar *::-webkit-scrollbar,
        #details-modal::-webkit-scrollbar,
        #details-modal *::-webkit-scrollbar,
        #result-modal::-webkit-scrollbar,
        #result-modal *::-webkit-scrollbar,
        #image-zoom-modal::-webkit-scrollbar,
        #image-zoom-modal *::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        .no-scrollbar,
        #admin-sidebar,
        #admin-sidebar *,
        #details-modal,
        #details-modal *,
        #result-modal,
        #result-modal *,
        #image-zoom-modal,
        #image-zoom-modal * {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#040A1A] font-sans antialiased text-stone-200 min-h-screen flex flex-col selection:bg-[#DFB755] selection:text-[#040A1A]">

    <!-- Global App Layout Grid -->
    <div class="flex h-screen overflow-hidden bg-[#040A1A]">
        
        <!-- Sidebar Navigation -->
        @include('admin.includes.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-y-auto overflow-x-hidden min-w-0 bg-[#061026]">
            
            <!-- Top Admin Header -->
            <header class="sticky top-0 z-30 bg-[#071533]/95 backdrop-blur-md border-b border-[#DFB755]/20 shadow-md">
                <div class="px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4">
                    
                    <!-- Left: Mobile Toggle & Breadcrumbs -->
                    <div class="flex items-center gap-3">
                        <button type="button" id="admin-sidebar-toggle" class="lg:hidden w-9 h-9 rounded-xl bg-white/10 text-[#DFB755] border border-[#DFB755]/30 flex items-center justify-center hover:bg-white/20 transition">
                            <i class="fa-solid fa-bars text-sm"></i>
                        </button>
                        
                        <div class="hidden sm:flex items-center gap-2 text-xs font-semibold">
                            <span class="text-stone-400">Portal</span>
                            <span class="text-[#DFB755]/50">/</span>
                            <span class="text-[#DFB755] uppercase tracking-wider font-bold">@yield('page_title', 'Dashboard')</span>
                        </div>
                    </div>

                    <!-- Center / Live Status -->
                    

                    <!-- Right Actions & Admin Profile -->
                    <div class="flex items-center gap-3 sm:gap-4">
                        
                 

                   

                        <!-- Admin User Dropdown Trigger -->
                        <div class="relative" id="user-dropdown-container">
                            <button type="button" onclick="toggleUserDropdown()" class="flex items-center gap-2.5 px-3 py-1.5 rounded-full bg-[#040A1A] hover:bg-white/5 border border-[#DFB755]/30 transition group shadow-sm">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[#DFB755] to-[#C59B27] text-[#040A1A] font-black flex items-center justify-center text-xs shadow-sm">
                                    <i class="fa-solid fa-user text-[11px]"></i>
                                </div>
                                <div class="text-left pr-1 leading-none">
                                    <span class="text-[8px] uppercase tracking-widest text-[#DFB755] font-extrabold block">ADMINISTRATOR</span>
                                    <h4 class="text-xs font-bold text-white group-hover:text-[#F3D068] transition truncate">
                                        {{ auth()->user()->name ?? 'admin' }}
                                    </h4>
                                </div>
                                <i class="fa-solid fa-chevron-down text-[9px] text-stone-400 group-hover:text-white transition"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-[#071533] rounded-2xl border border-[#DFB755]/30 shadow-2xl py-2 z-50 divide-y divide-white/10">
                                <div class="px-4 py-2.5">
                                    <p class="text-xs font-bold text-white">{{ auth()->user()->name ?? 'Master Admin' }}</p>
                                    <p class="text-[11px] font-mono text-stone-400 truncate">{{ auth()->user()->email ?? 'admin@mail.com' }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-stone-300 hover:text-white hover:bg-white/10 transition">
                                        <i class="fa-solid fa-gauge-high text-xs text-[#DFB755]"></i>
                                        <span>Dashboard</span>
                                    </a>
                                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-stone-300 hover:text-white hover:bg-white/10 transition">
                                        <i class="fa-solid fa-gear text-xs text-[#DFB755]"></i>
                                        <span>Settings &amp; Profile</span>
                                    </a>
                                    <a href="{{ route('ticket.booking') }}" target="_blank" class="flex items-center gap-2.5 px-4 py-2 text-xs text-stone-300 hover:text-white hover:bg-white/10 transition">
                                        <i class="fa-solid fa-ticket text-xs text-[#DFB755]"></i>
                                        <span>Live Ticket Board</span>
                                    </a>
                                </div>
                                <div class="py-1">
                                    <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition text-left font-semibold">
                                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                                            <span>Sign Out</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </header>

            <!-- Uniform Royal Admin Flash Message Banner -->
            @if(session('success'))
                <div id="global-flash-success" class="m-4 sm:m-6 mb-0 bg-gradient-to-r from-emerald-950/80 via-emerald-900/60 to-[#071533] border border-emerald-400/50 rounded-2xl p-4 text-emerald-300 text-xs flex items-center justify-between shadow-xl animate-in fade-in slide-in-from-top-3 duration-300">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-circle-check text-sm"></i>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase tracking-widest text-[#DFB755] font-black block">Success Notification</span>
                            <span class="font-bold text-white text-xs sm:text-[13px]">{{ session('success') }}</span>
                        </div>
                    </div>
                    <button type="button" onclick="this.closest('#global-flash-success').remove()" class="w-7 h-7 rounded-lg bg-white/10 hover:bg-white/20 text-emerald-300 hover:text-white flex items-center justify-center text-xs transition">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div id="global-flash-error" class="m-4 sm:m-6 mb-0 bg-gradient-to-r from-rose-950/80 via-rose-900/60 to-[#071533] border border-rose-400/50 rounded-2xl p-4 text-rose-300 text-xs flex items-center justify-between shadow-xl animate-in fade-in slide-in-from-top-3 duration-300">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-rose-500/20 text-rose-400 border border-rose-500/30 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase tracking-widest text-rose-400 font-black block">System Alert</span>
                            <span class="font-bold text-white text-xs sm:text-[13px]">{{ session('error') }}</span>
                        </div>
                    </div>
                    <button type="button" onclick="this.closest('#global-flash-error').remove()" class="w-7 h-7 rounded-lg bg-white/10 hover:bg-white/20 text-rose-300 hover:text-white flex items-center justify-center text-xs transition">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            <!-- Main Page Content Body -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            <!-- Admin Footer -->
            <footer class="bg-[#040A1A]/80 border-t border-white/5 py-4 px-4 sm:px-8 text-center text-xs text-stone-500 flex flex-col sm:flex-row items-center justify-between gap-2">
                <div>
                    &copy; {{ date('Y') }} Maharaja Lottery Directorate. Government Regulated System.
                </div>
                <div class="flex items-center gap-4 text-[11px]">
                    <span class="text-stone-400 font-mono">Server Status: <span class="text-emerald-400 font-bold">Optimal</span></span>
                    <span class="text-stone-400">Portal v2.4</span>
                </div>
            </footer>

        </div>
    </div>

    <!-- Custom Royal Admin Confirmation Modal -->
    <div id="admin-confirm-modal" class="fixed inset-0 z-[100] bg-black/85 backdrop-blur-sm hidden items-center justify-center p-4 transition-all duration-200">
        <div class="bg-[#071533] border border-[#DFB755]/40 rounded-3xl max-w-md w-full shadow-2xl overflow-hidden animate-in zoom-in-95 duration-150 relative">
            <!-- Top decorative gold bar -->
            <div id="confirm-modal-accent" class="h-1.5 w-full bg-gradient-to-r from-rose-600 via-[#DFB755] to-rose-600"></div>

            <div class="p-6 text-center space-y-4">
                <!-- Icon Container -->
                <div id="confirm-modal-icon-wrap" class="w-14 h-14 rounded-2xl mx-auto flex items-center justify-center text-2xl shadow-lg bg-rose-500/15 border border-rose-500/30 text-rose-400">
                    <i id="confirm-modal-icon" class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <!-- Title & Message -->
                <div>
                    <span id="confirm-modal-badge" class="text-[9px] uppercase tracking-widest font-black text-[#DFB755] block mb-1">Confirmation Required</span>
                    <h3 id="confirm-modal-title" class="text-lg font-serif font-black text-white">Are you sure?</h3>
                    <p id="confirm-modal-message" class="text-xs text-stone-300 mt-2 leading-relaxed">Please confirm your action to proceed.</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" id="confirm-modal-cancel" class="flex-1 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/15 text-stone-300 font-bold text-xs transition">
                        Cancel
                    </button>
                    <button type="button" id="confirm-modal-ok" class="flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-500 hover:to-rose-600 text-white font-black text-xs shadow-lg transition transform hover:scale-[1.02]">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Royal Admin Toast Notification -->
    <div id="admin-toast" class="fixed bottom-6 right-6 z-[110] hidden items-center gap-3 bg-[#071533] border border-[#DFB755]/40 rounded-2xl py-3 px-4 shadow-2xl text-xs font-bold animate-in slide-in-from-bottom-5 duration-200">
        <div id="admin-toast-icon" class="w-7 h-7 rounded-xl flex items-center justify-center text-sm bg-emerald-500/20 text-emerald-400 shrink-0">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <span id="admin-toast-text" class="text-white">Action successful</span>
    </div>

    <!-- Dropdown / Mobile Sidebar & Custom Modal Script -->
    <script>
        function toggleUserDropdown() {
            const menu = document.getElementById('user-dropdown-menu');
            menu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const container = document.getElementById('user-dropdown-container');
            const menu = document.getElementById('user-dropdown-menu');
            if (container && !container.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('admin-sidebar-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        const sidebarBackdrop = document.getElementById('admin-sidebar-backdrop');
        
        if (sidebarToggle && sidebar && sidebarBackdrop) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarBackdrop.classList.toggle('hidden');
            });
            sidebarBackdrop.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarBackdrop.classList.add('hidden');
            });
        }

        // --- CUSTOM ROYAL CONFIRMATION & TOAST SYSTEM ---
        window.adminConfirm = function(options) {
            return new Promise((resolve) => {
                const modal = document.getElementById('admin-confirm-modal');
                const titleEl = document.getElementById('confirm-modal-title');
                const msgEl = document.getElementById('confirm-modal-message');
                const iconWrap = document.getElementById('confirm-modal-icon-wrap');
                const iconEl = document.getElementById('confirm-modal-icon');
                const accentEl = document.getElementById('confirm-modal-accent');
                const badgeEl = document.getElementById('confirm-modal-badge');
                const okBtn = document.getElementById('confirm-modal-ok');
                const cancelBtn = document.getElementById('confirm-modal-cancel');

                if (typeof options === 'string') {
                    options = { message: options };
                }

                const title = options.title || 'Confirm Action';
                const message = options.message || 'Are you sure you want to proceed?';
                const type = options.type || 'danger'; // 'danger', 'success', 'warning', 'info'
                const confirmText = options.confirmText || (type === 'danger' ? 'Delete' : (type === 'success' ? 'Approve' : 'Confirm'));
                const cancelText = options.cancelText || 'Cancel';
                const badge = options.badge || (type === 'danger' ? 'Permanent Action' : (type === 'success' ? 'Verification Action' : 'Action Confirmation'));

                titleEl.textContent = title;
                msgEl.innerHTML = message;
                badgeEl.textContent = badge;
                okBtn.textContent = confirmText;
                cancelBtn.textContent = cancelText;

                // Configure appearance based on action type
                if (type === 'danger') {
                    accentEl.className = "h-1.5 w-full bg-gradient-to-r from-rose-600 via-rose-500 to-rose-600";
                    iconWrap.className = "w-14 h-14 rounded-2xl mx-auto flex items-center justify-center text-2xl shadow-lg bg-rose-500/15 border border-rose-500/30 text-rose-400";
                    iconEl.className = options.icon || "fa-solid fa-trash-can";
                    okBtn.className = "flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-500 hover:to-rose-600 text-white font-black text-xs shadow-lg transition transform hover:scale-[1.02]";
                } else if (type === 'success') {
                    accentEl.className = "h-1.5 w-full bg-gradient-to-r from-emerald-500 via-[#DFB755] to-emerald-500";
                    iconWrap.className = "w-14 h-14 rounded-2xl mx-auto flex items-center justify-center text-2xl shadow-lg bg-emerald-500/15 border border-emerald-500/30 text-emerald-400";
                    iconEl.className = options.icon || "fa-solid fa-circle-check";
                    okBtn.className = "flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 text-white font-black text-xs shadow-lg transition transform hover:scale-[1.02]";
                } else {
                    accentEl.className = "h-1.5 w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27]";
                    iconWrap.className = "w-14 h-14 rounded-2xl mx-auto flex items-center justify-center text-2xl shadow-lg bg-[#DFB755]/15 border border-[#DFB755]/30 text-[#DFB755]";
                    iconEl.className = options.icon || "fa-solid fa-circle-question";
                    okBtn.className = "flex-1 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] text-[#071533] font-black text-xs shadow-lg transition transform hover:scale-[1.02]";
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                function cleanup() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    okBtn.onclick = null;
                    cancelBtn.onclick = null;
                    modal.onclick = null;
                    document.removeEventListener('keydown', handleKey);
                }

                function handleKey(e) {
                    if (e.key === 'Escape') {
                        cleanup();
                        resolve(false);
                    }
                }

                okBtn.onclick = function() {
                    cleanup();
                    resolve(true);
                };

                cancelBtn.onclick = function() {
                    cleanup();
                    resolve(false);
                };

                modal.onclick = function(e) {
                    if (e.target === modal) {
                        cleanup();
                        resolve(false);
                    }
                };

                document.addEventListener('keydown', handleKey);
            });
        };

        window.adminToast = function(message, type = 'success') {
            const toast = document.getElementById('admin-toast');
            const toastText = document.getElementById('admin-toast-text');
            const toastIconWrap = document.getElementById('admin-toast-icon');
            if (!toast) return;

            toastText.textContent = message;
            if (type === 'error' || type === 'danger') {
                toastIconWrap.className = "w-7 h-7 rounded-xl flex items-center justify-center text-sm bg-rose-500/20 text-rose-400 shrink-0";
                toastIconWrap.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i>';
            } else if (type === 'warning') {
                toastIconWrap.className = "w-7 h-7 rounded-xl flex items-center justify-center text-sm bg-amber-500/20 text-amber-400 shrink-0";
                toastIconWrap.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>';
            } else {
                toastIconWrap.className = "w-7 h-7 rounded-xl flex items-center justify-center text-sm bg-emerald-500/20 text-emerald-400 shrink-0";
                toastIconWrap.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
            }

            toast.classList.remove('hidden');
            toast.classList.add('flex');
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 3500);
        };

        // Intercept all elements with data-confirm
        document.addEventListener('click', async function(e) {
            const target = e.target.closest('[data-confirm]');
            if (!target) return;
            e.preventDefault();
            e.stopPropagation();

            const msg = target.getAttribute('data-confirm');
            const title = target.getAttribute('data-confirm-title') || 'Confirm Action';
            const type = target.getAttribute('data-confirm-type') || 'danger';
            const btnText = target.getAttribute('data-confirm-btn') || 'Confirm';
            const icon = target.getAttribute('data-confirm-icon') || '';

            const confirmed = await window.adminConfirm({
                title: title,
                message: msg,
                type: type,
                confirmText: btnText,
                icon: icon
            });

            if (confirmed) {
                if (target.tagName === 'BUTTON' && target.type === 'submit' && target.form) {
                    target.form.submit();
                } else if (target.tagName === 'A') {
                    window.location.href = target.href;
                }
            }
        }, true);
    </script>
    @stack('scripts')
</body>
</html>

