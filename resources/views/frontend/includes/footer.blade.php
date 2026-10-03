<!-- Footer -->
<footer id="interactive-footer" class="relative bg-gradient-to-b from-white via-stone-50/70 to-stone-100 text-stone-700 border-t border-stone-200/90 overflow-hidden select-none group">
    
    <!-- 1. Interactive Mouse Spotlight Glow -->
    <div id="footer-spotlight" class="absolute pointer-events-none -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-0" style="background: radial-gradient(600px circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(245, 158, 10, 0.08), rgba(127, 30, 29, 0.04), transparent 60%);"></div>

    <!-- 2. Subtle Dotted Pattern Watermark -->
    <div class="absolute inset-0 opacity-[0.04] bg-[radial-gradient(#7F1E1D_1.5px,transparent_1.5px)] [background-size:20px_20px] pointer-events-none"></div>

    <!-- 3. Repeating Lottery Motif Watermark -->
    <div class="absolute inset-0 pointer-events-none opacity-[0.035]" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 160px 160px;"></div>

    <!-- 4. Floating Interactive Lottery Particles / Icons -->
    <div class="absolute top-6 left-12 opacity-15 pointer-events-none animate-bounce duration-[4000ms]">
        <i class="fa-solid fa-crown text-[#F59E0A] text-2xl rotate-12"></i>
    </div>
    <div class="absolute bottom-12 left-1/3 opacity-15 pointer-events-none animate-pulse duration-[3000ms]">
        <i class="fa-solid fa-star text-[#F59E0A] text-xl"></i>
    </div>
    <div class="absolute top-8 right-1/4 opacity-15 pointer-events-none animate-bounce duration-[5000ms]">
        <i class="fa-solid fa-ticket-simple text-[#7F1E1D] text-2xl -rotate-12"></i>
    </div>
    <div class="absolute bottom-16 right-12 opacity-15 pointer-events-none animate-pulse duration-[4000ms]">
        <i class="fa-solid fa-coins text-[#F59E0A] text-2xl rotate-6"></i>
    </div>

    <!-- 5. Top Interactive Glowing Border Accent -->
    <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-[#F59E0A]/40 to-transparent"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-10 items-start">
            
            <!-- Directorate Info (Left / 5-6 cols) -->
            <div class="md:col-span-5 lg:col-span-5 flex items-start gap-4 group/emblem">
                <!-- Government / Directorate Emblem Box with Interactive Hover -->
                <div class="w-13 h-13 rounded-2xl bg-white shadow-md hover:shadow-lg border border-stone-200/90 hover:border-[#F59E0A]/60 flex items-center justify-center text-[#7F1E1D] hover:text-[#F59E0A] text-xl shrink-0 mt-1 transition-all duration-300 hover:scale-105 hover:-rotate-3 group-hover/emblem:shadow-amber-500/10">
                    <i class="fa-solid fa-building-columns transition-transform duration-300"></i>
                </div>

                <div>
                    <span class="block text-[10px] font-extrabold text-[#7F1E1D] tracking-widest uppercase mb-0.5 font-sans flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0A] animate-ping"></span>
                        OFFICIAL DIRECTORATE
                    </span>
                    <h3 class="text-base sm:text-lg lg:text-xl font-serif font-bold text-stone-900 tracking-wide mb-2 transition-colors group-hover/emblem:text-[#7F1E1D]">
                        Directorate of Kerala State Lotteries
                    </h3>
                    
                    <div class="flex items-start gap-2 text-xs text-stone-600 leading-relaxed font-medium group/pin">
                        <i class="fa-solid fa-location-dot text-[#7F1E1D] text-xs mt-0.5 shrink-0 group-hover/pin:animate-bounce"></i>
                        <div>
                            <span>Vikas Bhavan P.O., Thiruvananthapuram</span><br>
                            <span class="text-[#7F1E1D] font-semibold">Kerala - 695033.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links (Middle / 3 cols) -->
            <div class="md:col-span-3 lg:col-span-3 md:border-l md:border-stone-200/90 md:pl-6 lg:pl-8">
                <h4 class="text-xs font-bold text-[#7F1E1D] uppercase tracking-wider mb-3.5 font-sans flex items-center gap-2">
                    <span class="w-2 h-0.5 bg-[#F59E0A]"></span>
                    QUICK LINKS
                </h4>
                <ul class="space-y-2 text-xs text-stone-600 font-medium">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-[#7F1E1D] transition-all duration-200 inline-flex items-center gap-1.5 hover:translate-x-1 group/link">
                            <span class="text-[#F59E0A] opacity-0 group-hover/link:opacity-100 transition-opacity text-[10px]">&rsaquo;</span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-[#7F1E1D] transition-all duration-200 inline-flex items-center gap-1.5 hover:translate-x-1 group/link">
                            <span class="text-[#F59E0A] opacity-0 group-hover/link:opacity-100 transition-opacity text-[10px]">&rsaquo;</span>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('winnerlist') }}" class="hover:text-[#7F1E1D] transition-all duration-200 inline-flex items-center gap-1.5 hover:translate-x-1 group/link">
                            <span class="text-[#F59E0A] opacity-0 group-hover/link:opacity-100 transition-opacity text-[10px]">&rsaquo;</span>
                            Winner List &amp; Results
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-[#7F1E1D] transition-all duration-200 inline-flex items-center gap-1.5 hover:translate-x-1 group/link">
                            <span class="text-[#F59E0A] opacity-0 group-hover/link:opacity-100 transition-opacity text-[10px]">&rsaquo;</span>
                            Contact &amp; Support
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support (Right / 4 cols) -->
            <div class="md:col-span-4 lg:col-span-4 md:border-l md:border-stone-200/90 md:pl-6 lg:pl-8">
                <h4 class="text-xs font-bold text-[#7F1E1D] uppercase tracking-wider mb-3.5 font-sans flex items-center gap-2">
                    <span class="w-2 h-0.5 bg-[#F59E0A]"></span>
                    SUPPORT
                </h4>
                <div class="space-y-2.5 text-xs text-stone-600 font-medium">
                    <div>
                        <a href="tel:8743978796" class="inline-flex items-center gap-2 text-stone-800 hover:text-[#7F1E1D] font-bold transition-all px-2.5 py-1 -ml-2.5 rounded-lg hover:bg-stone-100 group/item">
                            <i class="fa-solid fa-phone text-[#F59E0A] text-xs group-hover/item:rotate-12 transition-transform"></i>
                            8743978796
                        </a>
                    </div>
                    <div>
                        <a href="mailto:support@keralalotteriesgov.com" class="inline-flex items-center gap-2 text-stone-700 hover:text-[#7F1E1D] font-medium transition-all px-2.5 py-1 -ml-2.5 rounded-lg hover:bg-stone-100 group/item">
                            <i class="fa-solid fa-envelope text-[#F59E0A] text-xs group-hover/item:scale-110 transition-transform"></i>
                            support@keralalotteriesgov.com
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Copyright Bottom Bar -->
    <div class="border-t border-stone-200/90 py-4 px-4 text-center bg-stone-50/70 relative z-10">
        <p class="text-[11px] text-stone-500 font-medium">
            &copy; {{ date('Y') }} Kerala State Government Lottery. All rights reserved.
        </p>
    </div>

    <!-- Interactive Mouse Follower Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const footer = document.getElementById('interactive-footer');
            if (!footer) return;

            footer.addEventListener('mousemove', (e) => {
                const rect = footer.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                footer.style.setProperty('--mouse-x', `${x}%`);
                footer.style.setProperty('--mouse-y', `${y}%`);
            });
        });
    </script>
</footer>
