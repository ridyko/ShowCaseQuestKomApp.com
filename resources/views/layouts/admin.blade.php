<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Showcase</title>
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #FDF6E2; color: #1C1917; }
        .font-display { font-family: 'Outfit', sans-serif; }
        .sidebar-link { 
            display:flex; 
            align-items:center; 
            gap:10px; 
            padding:12px 14px; 
            border-radius:12px; 
            font-size:.875rem; 
            font-weight:800; 
            color:#44403c; 
            border: 2px solid transparent; 
            transition: all .15s ease; 
            margin-bottom:6px; 
        }
        .sidebar-link:hover { background:#FAF3E0; color:#1c1917; border-color:#1c1917; }
        .sidebar-link.active { 
            background:#FDE047; 
            color:#1c1917; 
            border-color:#1c1917; 
            box-shadow: 3px 3px 0px 0px rgba(28,25,23,1); 
            transform: translate(-1px, -1px);
        }
        .sidebar-link.logout { color:#dc2626; }
        .sidebar-link.logout:hover { background:#fef2f2; border-color:#dc2626; }
        #adminSidebar { transition: transform .3s ease; }
        .dot-pattern { background-size: 16px 16px; background-image: radial-gradient(rgba(28, 25, 23, 0.07) 1.5px, transparent 1.5px); }
    </style>
    @stack('styles')
</head>
<body class="text-stone-900 bg-[#FDF6E2] dot-pattern min-h-screen flex antialiased">

{{-- Overlay --}}
<div id="overlay" class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm z-30 hidden" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="adminSidebar" class="fixed top-0 left-0 h-full w-64 bg-white border-r-2 border-stone-900 z-40 flex flex-col -translate-x-full lg:translate-x-0">
    {{-- Logo --}}
    <div class="p-5 border-b-2 border-stone-900">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
            <div class="w-8 h-8 bg-[#FDE047] border-2 border-stone-900 rounded-xl flex items-center justify-center text-stone-900 text-xs font-black shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                <i class="fas fa-cube"></i>
            </div>
            <span class="font-display font-black text-base tracking-tight text-stone-900 uppercase">Showcase<span class="text-stone-500 font-bold">.admin</span></span>
        </a>
    </div>

    {{-- User --}}
    <div class="p-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl border-2 border-stone-900 bg-[#FDE047] flex items-center justify-center text-sm font-black text-stone-900 shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] flex-shrink-0">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="min-w-0">
                <p class="font-black text-sm text-stone-900 truncate">{{ auth()->user()->name }}</p>
                <p class="text-stone-500 text-[10px] font-black uppercase tracking-wider">{{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 p-3 overflow-y-auto">
        <p class="text-stone-400 text-[9px] font-black uppercase tracking-wider px-2 py-3">Menu Utama</p>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt w-4 text-center"></i> Dashboard
        </a>
        <a href="{{ route('admin.applications.index') }}" class="sidebar-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <i class="fas fa-th-large w-4 text-center"></i> Aplikasi
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags w-4 text-center"></i> Kategori
        </a>

        <p class="text-stone-400 text-[9px] font-black uppercase tracking-wider px-2 py-3 mt-2">Lainnya</p>
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="fas fa-globe w-4 text-center"></i> Lihat Website
        </a>
    </nav>

    {{-- Logout --}}
    <div class="p-3 border-t-2 border-stone-900">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link logout w-full border-2 border-transparent bg-transparent cursor-pointer font-[inherit]">
                <i class="fas fa-sign-out-alt w-4 text-center"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
    {{-- Topbar --}}
    <header class="sticky top-0 z-20 bg-white/95 backdrop-blur border-b-2 border-stone-900 px-4 sm:px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="hamburgerBtn" onclick="openSidebar()" class="lg:hidden w-9 h-9 flex items-center justify-center bg-white border-2 border-stone-900 rounded-xl text-stone-850 hover:bg-stone-50 transition shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="font-display font-black text-xl text-stone-900 uppercase">@yield('page-title', 'Dashboard')</h1>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-xs font-black uppercase tracking-wider text-stone-900 border-2 border-stone-900 hover:bg-stone-50 px-4 py-2 rounded-xl transition shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
            <i class="fas fa-external-link-alt text-[10px]"></i>
            <span class="hidden sm:inline">Lihat Web</span>
        </a>
    </header>

    {{-- Flash --}}
    @if(session('success'))
    <div class="mx-4 sm:mx-8 mt-6 flex items-center gap-3 bg-[#86EFAC] border-2 border-stone-900 text-stone-900 px-4 py-3.5 rounded-xl text-xs font-bold shadow-[3px_3px_0px_0px_rgba(28,25,23,1)]">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto font-black">&times;</button>
    </div>
    @endif
    @if(session('error'))
    <div class="mx-4 sm:mx-8 mt-6 flex items-center gap-3 bg-[#F87171] border-2 border-stone-900 text-stone-900 px-4 py-3.5 rounded-xl text-xs font-bold shadow-[3px_3px_0px_0px_rgba(28,25,23,1)]">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto font-black">&times;</button>
    </div>
    @endif

    {{-- Content --}}
    <main class="flex-1 p-4 sm:p-8">
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script>
function openSidebar() {
    document.getElementById('adminSidebar').classList.remove('-translate-x-full');
    document.getElementById('overlay').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('adminSidebar').classList.add('-translate-x-full');
    document.getElementById('overlay').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>
@stack('scripts')
</body>
</html>
