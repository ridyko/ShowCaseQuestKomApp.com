@extends('layouts.app')
@section('title', 'Portofolio Interaktif')
@section('description', 'Jelajahi koleksi aplikasi terbaik dari questkomputer.com')

@section('content')
{{-- HERO --}}
<section class="min-h-[85vh] flex items-center justify-center text-center px-4 pt-24 pb-16">
    <div class="max-w-4xl mx-auto">
        <div class="inline-flex items-center gap-2 bg-brand/10 border border-brand/20 text-brand text-[10px] font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-8 animate-fadeup shadow-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-brand animate-ping"></span> Live Preview Platform
        </div>
        <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-[1.1] mb-6 animate-fadeup delay-1 text-slate-900">
            Coba Aplikasi<br>
            <span class="gradient-text">Sebelum Anda Beli</span>
        </h1>
        <p class="text-slate-500 text-base sm:text-lg max-w-2xl mx-auto mb-12 animate-fadeup delay-2 leading-relaxed">
            Eksplorasi katalog produk aplikasi terbaik dari <strong class="text-slate-800 font-semibold">questkomputer.com</strong> melalui demo interaktif secara langsung.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 mb-16 animate-fadeup delay-2">
            <a href="#gallery" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-bold px-7 py-3.5 rounded-xl text-xs uppercase tracking-wider transition shadow-lg shadow-brand/20">
                <i class="fas fa-th-large text-[10px]"></i> Jelajahi Galeri
            </a>
            <a href="{{ route('login') }}" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold px-7 py-3.5 rounded-xl text-xs uppercase tracking-wider transition shadow-sm">
                <i class="fas fa-sign-in-alt text-[10px]"></i> Masuk Admin
            </a>
        </div>
        <div class="inline-flex items-center gap-6 sm:gap-12 bg-white border border-slate-200 rounded-2xl px-8 py-5 shadow-sm animate-fadeup delay-3">
            <div class="text-center">
                <span class="block text-2xl font-display font-black text-slate-900" data-count="{{ $applications->total() }}">0</span>
                <span class="text-slate-400 text-[9px] font-bold uppercase tracking-wider mt-1 block">Aplikasi</span>
            </div>
            <div class="w-px h-8 bg-slate-200"></div>
            <div class="text-center">
                <span class="block text-2xl font-display font-black text-slate-900" data-count="{{ $categories->count() }}">0</span>
                <span class="text-slate-400 text-[9px] font-bold uppercase tracking-wider mt-1 block">Kategori</span>
            </div>
            <div class="w-px h-8 bg-slate-200"></div>
            <div class="text-center">
                <span class="block text-2xl font-display font-black text-slate-900" data-count="{{ $applications->sum('view_count') ?? 0 }}">0</span>
                <span class="text-slate-400 text-[9px] font-bold uppercase tracking-wider mt-1 block">Total Views</span>
            </div>
        </div>
    </div>
</section>

{{-- GALLERY & SYMMETRICAL GRID --}}
<section class="py-20 px-4 border-t border-slate-100 bg-slate-50/50" id="gallery">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <span class="text-brand text-[10px] font-bold uppercase tracking-wider"><i class="fas fa-cube mr-2"></i>Katalog Utama</span>
                <h2 class="font-display text-3xl sm:text-4xl font-black text-slate-900 mt-2">Semua <span class="text-slate-400 font-normal">Aplikasi</span></h2>
            </div>

            {{-- Filter & Search Form --}}
            <form action="{{ route('home') }}" method="GET" id="filterForm" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <div class="flex items-center gap-2.5 bg-white border border-slate-200 rounded-xl px-4 py-2.5 w-full sm:w-72 shadow-sm focus-within:border-brand transition">
                    <i class="fas fa-search text-slate-400 text-xs"></i>
                    <input type="text" name="search" id="searchInput" placeholder="Cari aplikasi..."
                        value="{{ request('search') }}"
                        class="flex-1 bg-transparent text-slate-800 text-xs outline-none placeholder-slate-400 font-medium">
                    @if(request('search'))
                    <a href="{{ route('home') }}" class="text-slate-400 hover:text-slate-900 transition text-xs"><i class="fas fa-times"></i></a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Category Filters --}}
        <div class="flex flex-wrap gap-2 mb-10">
            <a href="{{ route('home') }}" class="filter-chip {{ !request('category') ? 'active' : '' }} flex items-center gap-2 text-xs font-bold uppercase tracking-wider px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 shadow-sm">
                <i class="fas fa-globe text-[10px]"></i> Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat->slug]) }}"
                class="filter-chip {{ request('category') === $cat->slug ? 'active' : '' }} flex items-center gap-2 text-xs font-bold uppercase tracking-wider px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 shadow-sm">
                <i class="fas {{ $cat->icon }} text-[10px]"></i> {{ $cat->name }}
                <span class="text-[10px] opacity-60 font-semibold bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded-md ml-1">{{ $cat->applications_count }}</span>
            </a>
            @endforeach
        </div>

        {{-- Symmetrical Grid --}}
        @if($applications->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($applications as $app)
            <div class="bg-white border border-slate-200/60 rounded-2xl overflow-hidden card-hover p-6 flex flex-col justify-between shadow-sm relative group">
                @if($app->is_featured)
                <div class="absolute top-0 left-0 right-0 h-[3px] bg-brand"></div>
                @endif
                
                {{-- TOP SECTION --}}
                <div>
                    <div class="flex items-start justify-between mb-4">
                        {{-- Icon/Logo --}}
                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-50 border border-slate-100 flex items-center justify-center font-display font-black text-lg shadow-sm"
                             style="color:{{ $app->category?->color ?? '#4f46e5' }}">
                            @if($app->logo_url)
                                <img src="{{ $app->logo_url }}" alt="{{ $app->name }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='{{ substr($app->name,0,1) }}'">
                            @else
                                <span>{{ substr($app->name, 0, 1) }}</span>
                            @endif
                        </div>

                        {{-- Metadata badges --}}
                        <div class="flex items-center gap-1.5">
                            @if($app->category)
                            <span class="text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full" 
                                  style="background:{{ $app->category->color }}12; color:{{ $app->category->color }}">
                                {{ $app->category->name }}
                            </span>
                            @endif
                            @if($app->is_featured)
                            <span class="w-6 h-6 bg-brand/10 text-brand rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-star text-[9px]"></i>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Title & Tagline --}}
                    <h3 class="font-display font-black text-slate-900 text-base leading-tight mb-1 group-hover:text-brand transition duration-200">
                        {{ $app->name }}
                    </h3>
                    <p class="text-slate-400 text-xs font-semibold mb-3">
                        {{ $app->tagline }}
                    </p>

                    <p class="text-slate-500 text-xs leading-relaxed mb-4 line-clamp-2">
                        {{ $app->description }}
                    </p>

                    {{-- Tech stack --}}
                    @if($app->tech_stack)
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @foreach(array_slice($app->tech_stack, 0, 3) as $tech)
                        <span class="text-[9px] bg-slate-50 border border-slate-100 px-2 py-0.5 rounded text-slate-500 font-semibold">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- BOTTOM ACTION SECTION --}}
                <div class="flex items-center justify-between pt-4 border-t border-slate-50 mt-auto">
                    <span class="text-slate-400 text-[10px] font-medium"><i class="fas fa-eye mr-1.5"></i>{{ number_format($app->view_count) }}</span>
                    <a href="{{ route('app.show', $app->slug) }}"
                        class="flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-slate-500 group-hover:text-brand transition duration-200">
                        Detail <i class="fas fa-arrow-right text-[9px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @if($applications->hasPages())
        <div class="flex justify-center mt-12">
            {{ $applications->links() }}
        </div>
        @endif

        @else
        <div class="text-center py-24 bg-white border border-slate-200 rounded-2xl shadow-sm">
            <i class="fas fa-search text-4xl text-slate-300 mb-4 block"></i>
            <h3 class="font-display font-bold text-lg text-slate-900 mb-2">Tidak ada aplikasi ditemukan</h3>
            <p class="text-slate-400 text-xs mb-6">Coba ubah filter pencarian Anda</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-brand text-white text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-xl transition shadow-md shadow-brand/10">
                <i class="fas fa-redo text-[9px]"></i> Reset Filter
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
