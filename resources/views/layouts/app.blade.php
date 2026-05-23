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
                    brand: { DEFAULT: '#4f46e5', dark: '#3730a3', light: '#818cf8' },
                    surface: { DEFAULT: '#F8FAFC', card: '#FFFFFF', border: '#e2e8f0' }
                },
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    display: ['Outfit', 'sans-serif']
                }
            }
        }
    }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background: #F8FAFC; color: #0F172A; }
        .font-display { font-family: 'Outfit', sans-serif; }
        .gradient-text { background: linear-gradient(135deg, #3b82f6 0%, #4f46e5 50%, #818cf8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card-hover { transition: all .3s cubic-bezier(0.16, 1, 0.3, 1); border-color: #E2E8F0 !important; }
        .card-hover:hover { transform: translateY(-4px); border-color: #CBD5E1 !important; box-shadow: 0 20px 40px rgba(79, 70, 229, 0.04); }
        .grid-pattern { background-size: 24px 24px; background-image: linear-gradient(to right, rgba(226, 232, 240, 0.4) 1px, transparent 1px), linear-gradient(to bottom, rgba(226, 232, 240, 0.4) 1px, transparent 1px); }
        .filter-chip { transition: all .2s cubic-bezier(0.16, 1, 0.3, 1); }
        .filter-chip.active, .filter-chip:hover { background: #4f46e5 !important; color: #ffffff !important; border-color: #4f46e5 !important; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(15px); } to { opacity:1; transform:translateY(0); } }
        .animate-fadeup { animation: fadeUp .6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .delay-1 { animation-delay: .1s; opacity: 0; }
        .delay-2 { animation-delay: .2s; opacity: 0; }
        .delay-3 { animation-delay: .3s; opacity: 0; }
    </style>
    @stack('styles')
</head>
<body class="font-sans text-slate-900 bg-[#F8FAFC] min-h-screen grid-pattern antialiased">

{{-- NAVBAR --}}
<nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 h-16 bg-[#ffffff]/80 backdrop-blur-xl border-b border-slate-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-full flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-brand rounded-lg flex items-center justify-center text-sm shadow-md shadow-brand/20 text-white">
                <i class="fas fa-rocket"></i>
            </div>
            <span class="font-display font-bold text-base tracking-tight text-slate-900">Showcase<span class="text-brand font-black">.</span></span>
        </a>
        <div class="flex items-center gap-1 sm:gap-2">
            <a href="{{ route('home') }}" class="hidden sm:block text-slate-600 hover:text-brand text-xs font-semibold px-3 py-2.5 rounded-lg hover:bg-slate-50 transition">Beranda</a>
            <a href="#gallery" class="hidden sm:block text-slate-600 hover:text-brand text-xs font-semibold px-3 py-2.5 rounded-lg hover:bg-slate-50 transition">Galeri</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white text-xs font-bold px-4 py-2.5 rounded-lg transition shadow-md shadow-brand/10">
                    <i class="fas fa-tachometer-alt text-[10px]"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-2 bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-lg transition shadow-sm">
                    <i class="fas fa-sign-in-alt text-[10px]"></i> Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- FLASH --}}
@if(session('success'))
<div class="fixed top-20 right-4 z-50 max-w-sm bg-white text-slate-800 px-4 py-3.5 rounded-xl flex items-center gap-3 shadow-xl border border-slate-200" id="flash">
    <i class="fas fa-check-circle text-green-500"></i>
    <span class="text-xs font-semibold flex-1">{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100 text-sm">&times;</button>
</div>
@endif
@if(session('error'))
<div class="fixed top-20 right-4 z-50 max-w-sm bg-white text-slate-800 px-4 py-3.5 rounded-xl flex items-center gap-3 shadow-xl border border-slate-200">
    <i class="fas fa-exclamation-circle text-red-500"></i>
    <span class="text-xs font-semibold flex-1">{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100 text-sm">&times;</button>
</div>
@endif

<main class="relative z-10">@yield('content')</main>

{{-- FOOTER --}}
<footer class="relative z-10 border-t border-slate-100 bg-white mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mb-12">
            <div class="col-span-2 sm:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    <div class="w-7 h-7 bg-brand rounded-lg flex items-center justify-center text-white text-xs"><i class="fas fa-rocket"></i></div>
                    <span class="font-display font-bold text-sm tracking-tight text-slate-900">Showcase<span class="text-brand">.</span></span>
                </a>
                <p class="text-slate-500 text-xs leading-relaxed">Platform portofolio interaktif SaaS komersial dari questkomputer.com</p>
            </div>
            <div>
                <h4 class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-4">Navigasi</h4>
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block text-slate-600 hover:text-brand text-xs font-medium transition">Beranda</a>
                    <a href="#gallery" class="block text-slate-600 hover:text-brand text-xs font-medium transition">Galeri</a>
                    <a href="{{ route('login') }}" class="block text-slate-600 hover:text-brand text-xs font-medium transition">Masuk Admin</a>
                </div>
            </div>
            <div>
                <h4 class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-4">Teknologi</h4>
                <div class="space-y-2 text-slate-600 text-xs font-medium">
                    <p>Laravel 11</p><p>PHP 8.3+</p><p>MySQL</p>
                </div>
            </div>
            <div>
                <h4 class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-4">Kontak</h4>
                <a href="https://questkomputer.com" target="_blank" class="block text-slate-600 hover:text-brand text-xs font-medium transition"><i class="fas fa-globe mr-1.5 text-slate-400"></i>questkomputer.com</a>
            </div>
        </div>
        <div class="border-t border-slate-100 pt-8 text-center text-slate-400 text-[10px] font-medium tracking-wide">
            &copy; {{ date('Y') }} QUEST KOMPUTER. ALL RIGHTS RESERVED.
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
