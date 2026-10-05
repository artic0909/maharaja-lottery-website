<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Maharaja Lottery</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;900&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#040A1A] font-sans antialiased text-stone-200 min-h-screen flex items-center justify-center p-4 relative overflow-x-hidden selection:bg-[#DFB755] selection:text-[#040A1A]">

    <!-- Background Atmospheric Glows & Watermark -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden select-none">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#DFB755]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-[#0F2356]/40 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.03] flex items-center justify-center">
            <span class="font-serif font-black text-7xl md:text-9xl tracking-[0.3em] uppercase text-white whitespace-nowrap">
                MAHARAJA
            </span>
        </div>
        <div class="absolute inset-0 opacity-10" style="background-image: url('{{ asset('img/lottery-pattern.svg') }}'); background-repeat: repeat; background-size: 140px 140px;"></div>
    </div>

    <!-- Login Container -->
    <div class="relative w-full max-w-md z-10 my-8">
        
        <!-- Brand Header Card -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[#0B193E] to-[#040A1A] border-2 border-[#DFB755] text-[#F3D068] text-2xl shadow-xl shadow-gold-500/10 mb-3 group transform hover:scale-105 transition-transform">
                <i class="fa-solid fa-crown drop-shadow-md"></i>
            </div>
            <h1 class="text-2xl sm:text-3xl font-serif font-black text-white tracking-wide">
                MAHARAJA LOTTERY
            </h1>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#DFB755] mt-1">
                Admin Control Portal
            </p>
        </div>

        <!-- Main Login Box -->
        <div class="bg-[#071533]/90 backdrop-blur-xl rounded-3xl border border-[#DFB755]/30 shadow-2xl p-6 sm:p-8 space-y-5">
            
            <div class="border-b border-[#DFB755]/15 pb-4">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-[#DFB755] text-sm"></i>
                    <span>Master Admin Sign In</span>
                </h2>
                <p class="text-xs text-stone-400 mt-0.5">
                    Enter authorized credentials to manage lotteries and bookings.
                </p>
            </div>

            <!-- Validation Errors Alert -->
            @if($errors->any())
                <div class="bg-rose-500/10 border border-rose-500/30 rounded-xl p-3.5 text-rose-300 text-xs flex items-start gap-2.5">
                    <i class="fa-solid fa-circle-exclamation text-sm shrink-0 mt-0.5"></i>
                    <div>
                        <span class="font-bold block">Authentication Failed</span>
                        <ul class="list-disc list-inside mt-0.5 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-sky-500/10 border border-sky-500/30 rounded-xl p-3 text-sky-300 text-xs flex items-center gap-2">
                    <i class="fa-solid fa-info-circle text-sm"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4" id="admin-login-form">
                @csrf
                
                <!-- Email Address -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                        Admin Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#DFB755]/70 text-xs">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <input type="email" name="email" id="email" required autofocus
                            value="{{ old('email') }}"
                            placeholder="name@example.com"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-[#040A1A]/80 border border-stone-700/80 text-sm text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-bold text-stone-300 uppercase tracking-wider">
                            Password
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#DFB755]/70 text-xs">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password" id="password" required
                            value=""
                            placeholder="••••••••"
                            class="w-full pl-10 pr-10 py-3 rounded-xl bg-[#040A1A]/80 border border-stone-700/80 text-sm text-white placeholder-stone-500 focus:outline-none focus:ring-2 focus:ring-[#DFB755]/40 focus:border-[#DFB755] transition font-mono">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-stone-400 hover:text-[#DFB755] transition text-xs">
                            <i id="password-toggle-icon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Info -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-stone-300">
                        <input type="checkbox" name="remember" value="1"
                            class="w-4 h-4 rounded bg-[#040A1A] border-stone-700 text-[#DFB755] focus:ring-0 focus:ring-offset-0 cursor-pointer accent-[#DFB755]">
                        <span>Keep me signed in</span>
                    </label>
                    <span class="text-stone-400 text-[11px]">System Guard v2.4</span>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-[#C59B27] via-[#F3D068] to-[#C59B27] hover:from-[#B3891F] hover:via-[#E2BF56] hover:to-[#B3891F] text-[#071533] py-3.5 px-6 rounded-xl font-black text-sm tracking-wide shadow-lg shadow-gold-500/20 hover:shadow-xl transition-all duration-200 transform hover:scale-[1.01] flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket text-xs"></i>
                        <span>Sign In to Admin Portal</span>
                    </button>
                </div>
            </form>

            <!-- Footer Return Link -->
            <div class="text-center pt-2 border-t border-[#DFB755]/10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-stone-400 hover:text-[#DFB755] transition">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Return to Public Website</span>
                </a>
            </div>

        </div>

        <p class="text-center text-[11px] text-stone-500 mt-6">
            &copy; {{ date('Y') }} Maharaja Lottery Directorate. All administrative sessions are encrypted and logged.
        </p>

    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('password-toggle-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
