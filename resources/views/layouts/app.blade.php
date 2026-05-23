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
                    brand: { DEFAULT: '#1c1917', dark: '#000000', light: '#78716c' },
                    surface: { DEFAULT: '#FDF6E2', card: '#FFFFFF', border: '#1c1917' }
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
        body { background: #FDF6E2; color: #1C1917; }
        .font-display { font-family: 'Outfit', sans-serif; }
        .gradient-text { background: linear-gradient(135deg, #1C1917 40%, #44403c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card-hover { transition: all .2s cubic-bezier(0.16, 1, 0.3, 1); border-color: #1c1917 !important; border-width: 2px !important; }
        .card-hover:hover { transform: translate(-3px, -3px); box-shadow: 6px 6px 0px 0px rgba(28,25,23,1); }
        .dot-pattern { background-size: 16px 16px; background-image: radial-gradient(rgba(28, 25, 23, 0.07) 1.5px, transparent 1.5px); }
        .filter-chip { transition: all .15s ease; border-width: 2px !important; border-color: #1c1917 !important; }
        .filter-chip.active, .filter-chip:hover { background: #FDE047 !important; color: #1C1917 !important; box-shadow: 3px 3px 0px 0px rgba(28,25,23,1); transform: translate(-2px, -2px); }
        @keyframes fadeUp { from { opacity:0; transform:translateY(15px); } to { opacity:1; transform:translateY(0); } }
        .animate-fadeup { animation: fadeUp .6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .delay-1 { animation-delay: .1s; opacity: 0; }
        .delay-2 { animation-delay: .2s; opacity: 0; }
        .delay-3 { animation-delay: .3s; opacity: 0; }
    </style>
    @stack('styles')
</head>
<body class="font-sans text-stone-900 bg-[#FDF6E2] min-h-screen dot-pattern antialiased">

{{-- NAVBAR --}}
<nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 bg-white border-b-2 border-stone-900 h-16 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="w-8 h-8 bg-[#FDE047] border-2 border-stone-900 rounded-xl flex items-center justify-center text-stone-900 text-xs font-black shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] transition-transform group-hover:scale-105">
                <i class="fas fa-cube"></i>
            </div>
            <span class="font-display font-black text-base tracking-tight text-stone-900 uppercase">Showcase<span class="text-stone-500 font-bold">.studio</span></span>
        </a>
        <div class="flex items-center gap-1 sm:gap-2">
            <a href="{{ route('home') }}" class="hidden sm:block text-stone-900 hover:bg-stone-100 text-xs font-black px-3.5 py-2 rounded-xl border border-transparent hover:border-stone-900 transition">Beranda</a>
            <a href="#gallery" class="hidden sm:block text-stone-900 hover:bg-stone-100 text-xs font-black px-3.5 py-2 rounded-xl border border-transparent hover:border-stone-900 transition">Galeri</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-[#86EFAC] border-2 border-stone-900 hover:bg-[#4ADE80] text-stone-900 text-xs font-black px-4 py-2.5 rounded-xl transition shadow-[3px_3px_0px_0px_rgba(28,25,23,1)]">
                    <i class="fas fa-tachometer-alt text-[10px]"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-2 bg-[#FDE047] border-2 border-stone-900 hover:bg-[#FACC15] text-stone-900 text-xs font-black px-4 py-2.5 rounded-xl transition shadow-[3px_3px_0px_0px_rgba(28,25,23,1)]">
                    <i class="fas fa-sign-in-alt text-[10px]"></i> Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>

{{-- FLASH --}}
@if(session('success'))
<div class="fixed top-24 right-4 z-50 max-w-sm bg-[#86EFAC] text-stone-900 px-4 py-3.5 border-2 border-stone-900 rounded-xl flex items-center gap-3 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]" id="flash">
    <i class="fas fa-check-circle"></i>
    <span class="text-xs font-bold flex-1">{{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100 text-sm font-black">&times;</button>
</div>
@endif
@if(session('error'))
<div class="fixed top-24 right-4 z-50 max-w-sm bg-[#F87171] text-stone-900 px-4 py-3.5 border-2 border-stone-900 rounded-xl flex items-center gap-3 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
    <i class="fas fa-exclamation-circle"></i>
    <span class="text-xs font-bold flex-1">{{ session('error') }}</span>
    <button onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100 text-sm font-black">&times;</button>
</div>
@endif

<main class="relative z-10">@yield('content')</main>

{{-- FOOTER --}}
<footer class="relative z-10 border-t-2 border-stone-900 bg-white mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mb-12">
            <div class="col-span-2 sm:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    <div class="w-7 h-7 bg-[#FDE047] border-2 border-stone-900 rounded-lg flex items-center justify-center text-stone-900 text-xs"><i class="fas fa-cube"></i></div>
                    <span class="font-display font-black text-sm tracking-tight text-stone-900 uppercase">Showcase<span class="text-stone-500 font-bold">.studio</span></span>
                </a>
                <p class="text-stone-600 text-xs leading-relaxed font-bold">Platform portofolio interaktif bold dari questkomputer.com</p>
            </div>
            <div>
                <h4 class="text-stone-500 text-[10px] font-black uppercase tracking-wider mb-4">Navigasi</h4>
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block text-stone-700 hover:text-stone-900 text-xs font-bold transition">Beranda</a>
                    <a href="#gallery" class="block text-stone-700 hover:text-stone-900 text-xs font-bold transition">Galeri</a>
                    <a href="{{ route('login') }}" class="block text-stone-700 hover:text-stone-900 text-xs font-bold transition">Masuk Admin</a>
                </div>
            </div>
            <div>
                <h4 class="text-stone-500 text-[10px] font-black uppercase tracking-wider mb-4">Teknologi</h4>
                <div class="space-y-2 text-stone-600 text-xs font-bold">
                    <p>Laravel 11</p><p>PHP 8.3+</p><p>MySQL</p>
                </div>
            </div>
            <div>
                <h4 class="text-stone-500 text-[10px] font-black uppercase tracking-wider mb-4">Kontak</h4>
                <a href="https://questkomputer.com" target="_blank" class="block text-stone-700 hover:text-stone-900 text-xs font-bold transition"><i class="fas fa-globe mr-1.5 text-stone-500"></i>questkomputer.com</a>
            </div>
        </div>
        <div class="border-t border-stone-200 pt-8 text-center text-stone-500 text-[10px] font-bold tracking-wide">
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
