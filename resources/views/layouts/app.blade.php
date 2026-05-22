<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Showcase') — Quest Komputer</title>
    <meta name="description" content="@yield('description', 'Platform portofolio interaktif questkomputer.com')">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    brand: { DEFAULT: '#6366f1', dark: '#4f46e5', light: '#818cf8' },
                    surface: { DEFAULT: '#0f1117', card: '#161b27', border: 'rgba(255,255,255,0.07)' }
                },
                fontFamily: { sans: ['Inter', 'sans-serif'] }
            }
        }
    }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: #0f1117; }
        .gradient-text { background: linear-gradient(135deg, #fff 30%, #6366f1); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card-hover { transition: all .3s ease; }
        .card-hover:hover { transform: translateY(-6px); border-color: #6366f1 !important; box-shadow: 0 20px 40px rgba(0,0,0,.5); }
        .orb { position: fixed; border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; background: rgba(99,102,241,.12); top: -100px; right: -100px; }
        .orb-2 { width: 400px; height: 400px; background: rgba(6,182,212,.08); bottom: -100px; left: -100px; }
        .filter-chip { transition: all .2s; }
        .filter-chip.active, .filter-chip:hover { background: #6366f1 !important; color: #fff !important; border-color: #6366f1 !important; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        .animate-fadeup { animation: fadeUp .6s ease forwards; }
        .delay-1 { animation-delay: .1s; opacity: 0; }
        .delay-2 { animation-delay: .2s; opacity: 0; }
        .delay-3 { animation-delay: .3s; opacity: 0; }
    </style>
    @stack('styles')
</head>
<body class="font-sans text-white min-h-screen">
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

{{-- NAVBAR --}}
<nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 h-16 bg-[#0f1117]/80 backdrop-blur-xl border-b border-white/5 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-full flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-brand rounded-lg flex items-center justify-center text-sm shadow-lg shadow-brand/30">
                <i class="fas fa-rocket"></i>
            </div>
            <span class="font-bold text-lg">Show<span class="text-brand">case</span></span>
        </a>
        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ route('home') }}" class="hidden sm:block text-white/60 hover:text-white text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-white/5 transition">Beranda</a>
            <a href="#gallery" class="hidden sm:block text-white/60 hover:text-white text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-white/5 transition">Galeri</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white text-sm font-semibold px-4 py-2 rounded-xl transition shadow-lg shadow-brand/20">
                    <i class="fas fa-tachometer-alt text-xs"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-2 bg-white/5 border border-white/10 hover:bg-white/10 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
                    <i class="fas fa-sign-in-alt text-xs"></i> Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- FLASH --}}
@if(session('success'))
<div class="fixed top-20 right-4 z-50 max-w-sm bg-green-900/80 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl flex items-center gap-3 backdrop-blur" id="flash">
    <i class="fas fa-check-circle"></i>
    <span class="text-sm flex-1">{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100">&times;</button>
</div>
@endif
@if(session('error'))
<div class="fixed top-20 right-4 z-50 max-w-sm bg-red-900/80 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl flex items-center gap-3 backdrop-blur">
    <i class="fas fa-exclamation-circle"></i>
    <span class="text-sm flex-1">{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100">&times;</button>
</div>
@endif

<main class="relative z-10">@yield('content')</main>

{{-- FOOTER --}}
<footer class="relative z-10 border-t border-white/5 bg-[#0b0d14] mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mb-10">
            <div class="col-span-2 sm:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-3">
                    <div class="w-7 h-7 bg-brand rounded-lg flex items-center justify-center text-xs"><i class="fas fa-rocket"></i></div>
                    <span class="font-bold">Show<span class="text-brand">case</span></span>
                </a>
                <p class="text-white/40 text-sm leading-relaxed">Platform portofolio interaktif dari questkomputer.com</p>
            </div>
            <div>
                <h4 class="text-white/50 text-xs font-semibold uppercase tracking-widest mb-4">Navigasi</h4>
                <div class="space-y-2.5">
                    <a href="{{ route('home') }}" class="block text-white/50 hover:text-white text-sm transition">Beranda</a>
                    <a href="#gallery" class="block text-white/50 hover:text-white text-sm transition">Galeri</a>
                    <a href="{{ route('login') }}" class="block text-white/50 hover:text-white text-sm transition">Masuk Admin</a>
                </div>
            </div>
            <div>
                <h4 class="text-white/50 text-xs font-semibold uppercase tracking-widest mb-4">Teknologi</h4>
                <div class="space-y-2.5 text-white/50 text-sm">
                    <p>Laravel 11</p><p>PHP 8.3+</p><p>MySQL</p>
                </div>
            </div>
            <div>
                <h4 class="text-white/50 text-xs font-semibold uppercase tracking-widest mb-4">Kontak</h4>
                <a href="https://questkomputer.com" target="_blank" class="block text-white/50 hover:text-white text-sm transition"><i class="fas fa-globe mr-1.5"></i>questkomputer.com</a>
            </div>
        </div>
        <div class="border-t border-white/5 pt-6 text-center text-white/30 text-xs">
            &copy; {{ date('Y') }} Quest Komputer. All rights reserved.
        </div>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
<script>
// Auto-dismiss flash
setTimeout(() => { document.getElementById('flash')?.remove(); }, 4000);
</script>
@stack('scripts')
</body>
</html>
