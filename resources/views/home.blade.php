@extends('layouts.app')
@section('title', 'Portofolio Interaktif')
@section('description', 'Jelajahi koleksi aplikasi terbaik dari questkomputer.com')

@section('content')
{{-- HERO --}}
<section class="min-h-screen flex items-center justify-center text-center px-4 pt-16">
    <div class="max-w-4xl mx-auto">
        <div class="inline-flex items-center gap-2 bg-brand/10 border border-brand/20 text-brand text-xs font-bold px-4 py-2 rounded-full mb-8 animate-fadeup">
            <i class="fas fa-rocket"></i> Live Preview Platform
        </div>
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black leading-tight mb-6 animate-fadeup delay-1">
            Coba Aplikasi<br>
            <span class="gradient-text">Sebelum Anda Beli</span>
        </h1>
        <p class="text-white/50 text-lg sm:text-xl max-w-2xl mx-auto mb-10 animate-fadeup delay-2">
            Eksplorasi koleksi aplikasi terbaik dari <strong class="text-white/80">questkomputer.com</strong> melalui demo interaktif langsung.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 mb-16 animate-fadeup delay-2">
            <a href="#gallery" class="flex items-center gap-2.5 bg-brand hover:bg-brand-dark text-white font-bold px-8 py-4 rounded-2xl text-base transition shadow-xl shadow-brand/30">
                <i class="fas fa-th-large"></i> Jelajahi Galeri
            </a>
            <a href="{{ route('login') }}" class="flex items-center gap-2.5 bg-white/5 border border-white/10 hover:bg-white/10 text-white font-bold px-8 py-4 rounded-2xl text-base transition">
                <i class="fas fa-sign-in-alt"></i> Masuk Admin
            </a>
        </div>
        <div class="inline-flex items-center gap-10 sm:gap-16 bg-white/3 border border-white/7 rounded-2xl px-8 sm:px-12 py-6 animate-fadeup delay-3">
            <div class="text-center">
                <span class="block text-3xl font-black" data-count="{{ $applications->total() }}">0</span>
                <span class="text-white/40 text-xs uppercase tracking-widest mt-1 block">Aplikasi</span>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="text-center">
                <span class="block text-3xl font-black" data-count="{{ $categories->count() }}">0</span>
                <span class="text-white/40 text-xs uppercase tracking-widest mt-1 block">Kategori</span>
            </div>
            <div class="w-px h-10 bg-white/10"></div>
            <div class="text-center">
                <span class="block text-3xl font-black" data-count="{{ $applications->sum('view_count') ?? 0 }}">0</span>
                <span class="text-white/40 text-xs uppercase tracking-widest mt-1 block">Total Views</span>
            </div>
        </div>
        <div class="mt-12 animate-fadeup delay-3">
            <a href="#gallery" class="text-white/30 hover:text-white/60 transition flex flex-col items-center gap-2 text-sm">
                Scroll <i class="fas fa-chevron-down animate-bounce"></i>
            </a>
        </div>
    </div>
</section>

{{-- FEATURED --}}
@if($featured->count() > 0)
<section class="py-20 px-4" id="featured">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-brand text-xs font-bold uppercase tracking-widest"><i class="fas fa-star mr-2"></i>Unggulan</span>
            <h2 class="text-3xl sm:text-4xl font-black mt-3">Aplikasi <span class="gradient-text">Terpilih</span></h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featured as $app)
            <div class="bg-[#161b27] border border-white/7 rounded-2xl p-6 card-hover flex flex-col">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 bg-brand/20 flex items-center justify-center font-black text-xl">
                        @if($app->logo_url)
                            <img src="{{ $app->logo_url }}" alt="{{ $app->name }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='{{ substr($app->name,0,1) }}'">
                        @else
                            {{ substr($app->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="min-w-0">
                        @if($app->category)
                        <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full mb-2" style="background:{{ $app->category->color }}22;color:{{ $app->category->color }}">
                            {{ $app->category->name }}
                        </span>
                        @endif
                        <h3 class="font-bold text-base leading-tight">{{ $app->name }}</h3>
                        <p class="text-cyan-400 text-sm font-medium">{{ $app->tagline }}</p>
                    </div>
                </div>
                <p class="text-white/40 text-sm leading-relaxed mb-4 flex-1">{{ Str::limit($app->description, 100) }}</p>
                @if($app->tech_stack)
                <div class="flex flex-wrap gap-1.5 mb-4">
                    @foreach(array_slice($app->tech_stack, 0, 3) as $tech)
                    <span class="text-xs bg-white/5 border border-white/10 px-2 py-1 rounded-md text-white/50">{{ $tech }}</span>
                    @endforeach
                </div>
                @endif
                <div class="flex items-center justify-between pt-4 border-t border-white/5 mt-auto">
                    <span class="text-white/30 text-xs"><i class="fas fa-eye mr-1"></i>{{ number_format($app->view_count) }}</span>
                    <div class="flex items-center gap-2">
                        <a href="{{ $app->subdomain_url }}" target="_blank" class="text-white/30 hover:text-white transition">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="{{ route('app.show', $app->slug) }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white text-xs font-semibold px-4 py-2 rounded-xl transition">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- GALLERY --}}
<section class="py-20 px-4" id="gallery">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-brand text-xs font-bold uppercase tracking-widest"><i class="fas fa-th-large mr-2"></i>Galeri</span>
            <h2 class="text-3xl sm:text-4xl font-black mt-3">Semua <span class="gradient-text">Aplikasi</span></h2>
        </div>

        {{-- Filter --}}
        <form action="{{ route('home') }}" method="GET" id="filterForm">
            <div class="flex items-center gap-3 bg-[#161b27] border border-white/7 rounded-2xl px-4 py-3 max-w-md mb-6">
                <i class="fas fa-search text-white/30 text-sm"></i>
                <input type="text" name="search" id="searchInput" placeholder="Cari aplikasi..."
                    value="{{ request('search') }}"
                    class="flex-1 bg-transparent text-white text-sm outline-none placeholder-white/30">
                @if(request('search'))
                <a href="{{ route('home') }}" class="text-white/30 hover:text-white transition"><i class="fas fa-times"></i></a>
                @endif
            </div>
            <div class="flex flex-wrap gap-2 mb-10">
                <a href="{{ route('home') }}" class="filter-chip {{ !request('category') ? 'active' : '' }} flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-full bg-white/5 border border-white/10 text-white/60">
                    <i class="fas fa-globe text-xs"></i> Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}"
                    class="filter-chip {{ request('category') === $cat->slug ? 'active' : '' }} flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-full bg-white/5 border border-white/10 text-white/60">
                    <i class="fas {{ $cat->icon }} text-xs"></i> {{ $cat->name }}
                    <span class="text-xs opacity-50">{{ $cat->applications_count }}</span>
                </a>
                @endforeach
            </div>
        </form>

        {{-- Grid --}}
        @if($applications->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($applications as $app)
            <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden card-hover flex flex-col">
                <div class="h-40 flex items-center justify-center relative" style="background: linear-gradient(135deg, {{ $app->category?->color ?? '#6366f1' }}18, {{ $app->category?->color ?? '#6366f1' }}30);">
                    <div class="w-16 h-16 rounded-2xl overflow-hidden bg-[#1a2035] flex items-center justify-center font-black text-2xl shadow-xl">
                        @if($app->logo_url)
                            <img src="{{ $app->logo_url }}" alt="{{ $app->name }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='{{ substr($app->name,0,1) }}'">
                        @else
                            <span style="color:{{ $app->category?->color ?? '#6366f1' }}">{{ substr($app->name, 0, 1) }}</span>
                        @endif
                    </div>
                    @if($app->is_featured)
                    <div class="absolute top-3 right-3 w-7 h-7 bg-yellow-500/20 border border-yellow-500/30 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                    </div>
                    @endif
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-2">
                        @if($app->category)
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="background:{{ $app->category->color }}18;color:{{ $app->category->color }}">
                            {{ $app->category->name }}
                        </span>
                        @endif
                        <span class="text-white/30 text-xs">v{{ $app->version }}</span>
                    </div>
                    <h3 class="font-bold text-base mb-1">{{ $app->name }}</h3>
                    <p class="text-cyan-400 text-sm font-medium mb-3">{{ $app->tagline }}</p>
                    @if($app->tech_stack)
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach(array_slice($app->tech_stack, 0, 3) as $tech)
                        <span class="text-xs bg-white/5 px-2 py-0.5 rounded text-white/40">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-white/5">
                        <span class="text-white/30 text-xs"><i class="fas fa-eye mr-1"></i>{{ number_format($app->view_count) }}</span>
                        <a href="{{ route('app.show', $app->slug) }}"
                            class="flex items-center gap-1.5 text-xs font-semibold text-white/60 hover:text-white border border-white/10 hover:border-white/30 px-3 py-1.5 rounded-lg transition">
                            Detail <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($applications->hasPages())
        <div class="flex justify-center mt-10">
            {{ $applications->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-20">
            <i class="fas fa-search text-5xl text-white/10 mb-4 block"></i>
            <h3 class="text-lg font-semibold mb-2">Tidak ada aplikasi ditemukan</h3>
            <p class="text-white/40 text-sm mb-6">Coba ubah filter pencarian Anda</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-brand text-white font-semibold px-6 py-3 rounded-xl text-sm transition">
                <i class="fas fa-redo"></i> Reset Filter
            </a>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
// Counter animation
document.querySelectorAll('[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count);
    if (!target) { el.textContent = '0'; return; }
    const duration = 1800;
    const start = performance.now();
    const observer = new IntersectionObserver(([entry]) => {
        if (!entry.isIntersecting) return;
        observer.disconnect();
        function tick(now) {
            const t = Math.min((now - start) / duration, 1);
            el.textContent = Math.floor(t < 1 ? target * (1 - Math.pow(1-t, 3)) : target).toLocaleString();
            if (t < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    });
    observer.observe(el);
});

// Search debounce
let timer;
document.getElementById('searchInput')?.addEventListener('input', function() {
    clearTimeout(timer);
    timer = setTimeout(() => document.getElementById('filterForm').submit(), 500);
});
</script>
@endpush
