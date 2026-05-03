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
                    brand: { DEFAULT: '#6366f1', dark: '#4f46e5' },
                }
            }
        }
    }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f1117; }
        .sidebar-link { display:flex; align-items:center; gap:10px; padding:10px 14px; border-radius:10px; font-size:.875rem; font-weight:500; color:rgba(255,255,255,.5); transition:.2s; margin-bottom:2px; }
        .sidebar-link:hover { background:rgba(255,255,255,.05); color:#fff; }
        .sidebar-link.active { background:#6366f1; color:#fff; box-shadow:0 4px 12px rgba(99,102,241,.3); }
        .sidebar-link.logout { color:#f87171; }
        .sidebar-link.logout:hover { background:rgba(239,68,68,.1); }
        #adminSidebar { transition: transform .3s ease; }
    </style>
    @stack('styles')
</head>
<body class="text-white min-h-screen flex">

{{-- Overlay --}}
<div id="overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-30 hidden" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="adminSidebar" class="fixed top-0 left-0 h-full w-64 bg-[#0b0e17] border-r border-white/5 z-40 flex flex-col -translate-x-full lg:translate-x-0">
    {{-- Logo --}}
    <div class="p-5 border-b border-white/5">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-brand rounded-lg flex items-center justify-center text-sm shadow-lg shadow-brand/30">
                <i class="fas fa-rocket"></i>
            </div>
            <span class="font-bold text-lg">Show<span class="text-brand">case</span></span>
        </a>
    </div>

    {{-- User --}}
    <div class="p-4 border-b border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-brand to-cyan-500 flex items-center justify-center text-sm font-bold flex-shrink-0">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
                <p class="text-white/40 text-xs uppercase tracking-wide">{{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 p-3 overflow-y-auto">
        <p class="text-white/25 text-xs font-semibold uppercase tracking-widest px-2 py-3">Menu Utama</p>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt w-4 text-center"></i> Dashboard
        </a>
        <a href="{{ route('admin.applications.index') }}" class="sidebar-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <i class="fas fa-th-large w-4 text-center"></i> Aplikasi
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags w-4 text-center"></i> Kategori
        </a>

        <p class="text-white/25 text-xs font-semibold uppercase tracking-widest px-2 py-3 mt-2">Lainnya</p>
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="fas fa-globe w-4 text-center"></i> Lihat Website
        </a>
    </nav>

    {{-- Logout --}}
    <div class="p-3 border-t border-white/5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link logout w-full border-0 bg-transparent cursor-pointer font-[inherit]">
                <i class="fas fa-sign-out-alt w-4 text-center"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
    {{-- Topbar --}}
    <header class="sticky top-0 z-20 bg-[#0f1117]/90 backdrop-blur border-b border-white/5 px-4 sm:px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button id="hamburgerBtn" onclick="openSidebar()" class="lg:hidden w-9 h-9 flex items-center justify-center bg-white/5 border border-white/10 rounded-lg text-white/70 hover:text-white transition">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="font-bold text-lg">@yield('page-title', 'Dashboard')</h1>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 text-sm text-white/50 hover:text-white border border-white/10 hover:border-white/20 px-4 py-2 rounded-xl transition">
            <i class="fas fa-external-link-alt text-xs"></i>
            <span class="hidden sm:inline">Lihat Web</span>
        </a>
    </header>

    {{-- Flash --}}
    @if(session('success'))
    <div class="mx-4 sm:mx-8 mt-4 flex items-center gap-3 bg-green-900/50 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl text-sm">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100">&times;</button>
    </div>
    @endif
    @if(session('error'))
    <div class="mx-4 sm:mx-8 mt-4 flex items-center gap-3 bg-red-900/50 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100">&times;</button>
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
