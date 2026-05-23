@extends('layouts.app')
@section('title', 'Portofolio Interaktif')
@section('description', 'Jelajahi koleksi aplikasi terbaik dari questkomputer.com')

@section('content')
{{-- HERO --}}
<section class="min-h-[85vh] flex items-center justify-center text-center px-4 pt-28 pb-16">
    <div class="max-w-4xl mx-auto">
        <div class="inline-flex items-center gap-2 bg-stone-100 border border-stone-200 text-stone-700 text-[10px] font-bold uppercase tracking-wider px-4 py-2 rounded-full mb-8 animate-fadeup">
            <span class="w-1.5 h-1.5 rounded-full bg-stone-900 animate-ping"></span> Live Preview Platform
        </div>
        <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-[1.1] mb-6 animate-fadeup delay-1">
            Coba Aplikasi<br>
            <span class="gradient-text">Sebelum Anda Beli</span>
        </h1>
        <p class="text-stone-500 text-base sm:text-lg max-w-2xl mx-auto mb-12 animate-fadeup delay-2 leading-relaxed">
            Eksplorasi katalog produk aplikasi terbaik dari <strong class="text-stone-800 font-semibold">questkomputer.com</strong> melalui demo interaktif secara langsung.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 mb-16 animate-fadeup delay-2">
            <a href="#gallery" class="flex items-center gap-2 bg-stone-900 hover:bg-black text-[#FAF8F5] font-bold px-7 py-3.5 rounded-xl text-xs uppercase tracking-wider transition shadow-md">
                <i class="fas fa-th-large text-[10px]"></i> Jelajahi Galeri
            </a>
            <a href="{{ route('login') }}" class="flex items-center gap-2 bg-white border border-stone-200 hover:bg-stone-50 text-stone-800 font-bold px-7 py-3.5 rounded-xl text-xs uppercase tracking-wider transition shadow-sm">
                <i class="fas fa-sign-in-alt text-[10px]"></i> Masuk Admin
            </a>
        </div>
        <div class="inline-flex items-center gap-6 sm:gap-12 bg-white border border-stone-200 rounded-2xl px-8 py-5 shadow-sm animate-fadeup delay-3">
            <div class="text-center">
                <span class="block text-2xl font-display font-black text-stone-900" data-count="{{ $applications->total() }}">0</span>
                <span class="text-stone-400 text-[9px] font-bold uppercase tracking-wider mt-1 block">Aplikasi</span>
            </div>
            <div class="w-px h-8 bg-stone-200"></div>
            <div class="text-center">
                <span class="block text-2xl font-display font-black text-stone-900" data-count="{{ $categories->count() }}">0</span>
                <span class="text-stone-400 text-[9px] font-bold uppercase tracking-wider mt-1 block">Kategori</span>
            </div>
            <div class="w-px h-8 bg-stone-200"></div>
            <div class="text-center">
                <span class="block text-2xl font-display font-black text-stone-900" data-count="{{ $applications->sum('view_count') ?? 0 }}">0</span>
                <span class="text-stone-400 text-[9px] font-bold uppercase tracking-wider mt-1 block">Total Views</span>
            </div>
        </div>
    </div>
</section>

{{-- GALLERY & BENTO GRID --}}
<section class="py-20 px-4 border-t border-stone-200 bg-stone-50/50" id="gallery">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <span class="text-stone-400 text-[10px] font-bold uppercase tracking-wider"><i class="fas fa-cube mr-2"></i>Katalog Utama</span>
                <h2 class="font-display text-3xl sm:text-4xl font-black text-stone-900 mt-2">Semua <span class="text-stone-500 font-normal">Aplikasi</span></h2>
            </div>

            {{-- Filter & Search Form --}}
            <form action="{{ route('home') }}" method="GET" id="filterForm" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <div class="flex items-center gap-2.5 bg-white border border-stone-200 rounded-xl px-4 py-2.5 w-full sm:w-72 shadow-sm focus-within:border-stone-900 transition">
                    <i class="fas fa-search text-stone-400 text-xs"></i>
                    <input type="text" name="search" id="searchInput" placeholder="Cari aplikasi..."
                        value="{{ request('search') }}"
                        class="flex-1 bg-transparent text-stone-800 text-xs outline-none placeholder-stone-400 font-medium">
                    @if(request('search'))
                    <a href="{{ route('home') }}" class="text-stone-400 hover:text-stone-900 transition text-xs"><i class="fas fa-times"></i></a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Category Filters --}}
        <div class="flex flex-wrap gap-2 mb-10">
            <a href="{{ route('home') }}" class="filter-chip {{ !request('category') ? 'active' : '' }} flex items-center gap-2 text-xs font-bold uppercase tracking-wider px-4 py-2.5 rounded-xl bg-white border border-stone-200 text-stone-600 shadow-sm">
                <i class="fas fa-globe text-[10px]"></i> Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat->slug]) }}"
                class="filter-chip {{ request('category') === $cat->slug ? 'active' : '' }} flex items-center gap-2 text-xs font-bold uppercase tracking-wider px-4 py-2.5 rounded-xl bg-white border border-stone-200 text-stone-600 shadow-sm">
                <i class="fas {{ $cat->icon }} text-[10px]"></i> {{ $cat->name }}
                <span class="text-[10px] opacity-60 font-semibold bg-stone-100 text-stone-700 px-1.5 py-0.5 rounded-md ml-1">{{ $cat->applications_count }}</span>
            </a>
            @endforeach
        </div>

        {{-- Bento Grid --}}
        @if($applications->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 auto-rows-[240px]">
            @foreach($applications as $app)
            @php
                // Let's create an elegant bento distribution
                // Featured apps take col-span-2 or row-span-2 to look dynamic
                $isFeatured = $app->is_featured;
                $cardClass = "bg-white border border-stone-200 rounded-3xl overflow-hidden card-hover p-6 flex flex-col justify-between shadow-sm relative ";
                
                if ($isFeatured && $loop->index % 3 == 0) {
                    $cardClass .= "md:col-span-2 md:row-span-2 p-8 md:p-10";
                } elseif ($loop->index % 5 == 1) {
                    $cardClass .= "md:col-span-2";
                }
            @endphp
            
            <div class="{{ $cardClass }}">
                {{-- TOP SECTION --}}
                <div>
                    <div class="flex items-start justify-between mb-4">
                        {{-- Icon/Logo --}}
                        <div class="w-12 h-12 md:w-16 md:h-16 rounded-2xl overflow-hidden bg-stone-50 border border-stone-200 flex items-center justify-center font-display font-black text-lg md:text-xl shadow-sm"
                             style="color:{{ $app->category?->color ?? '#1c1917' }}">
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
                            <span class="w-6 h-6 bg-amber-500/10 border border-amber-500/20 text-amber-600 rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-star text-[9px]"></i>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Title & Tagline --}}
                    <h3 class="font-display font-black text-stone-900 leading-tight mb-1.5 {{ $isFeatured && $loop->index % 3 == 0 ? 'text-2xl md:text-3xl' : 'text-base' }}">
                        {{ $app->name }}
                    </h3>
                    <p class="text-stone-500 text-xs font-medium mb-3">
                        {{ $app->tagline }}
                    </p>

                    @if($isFeatured && $loop->index % 3 == 0)
                    <p class="text-stone-400 text-xs leading-relaxed max-w-md mb-6 hidden md:block">
                        {{ Str::limit($app->description, 160) }}
                    </p>
                    @endif

                    {{-- Tech stack --}}
                    @if($app->tech_stack)
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @foreach(array_slice($app->tech_stack, 0, ($isFeatured && $loop->index % 3 == 0 ? 5 : 3)) as $tech)
                        <span class="text-[9px] bg-stone-100 border border-stone-200/50 px-2 py-0.5 rounded text-stone-500 font-semibold">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- BOTTOM ACTION SECTION --}}
                <div class="flex items-center justify-between pt-4 border-t border-stone-100 mt-auto">
                    <span class="text-stone-400 text-[10px] font-medium"><i class="fas fa-eye mr-1.5"></i>{{ number_format($app->view_count) }}</span>
                    <a href="{{ route('app.show', $app->slug) }}"
                        class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-stone-700 hover:text-stone-900 border border-stone-200 hover:border-stone-900 px-3.5 py-2 rounded-xl transition shadow-sm bg-white">
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
        <div class="text-center py-24 bg-white border border-stone-200 rounded-3xl shadow-sm">
            <i class="fas fa-search text-4xl text-stone-300 mb-4 block"></i>
            <h3 class="font-display font-bold text-lg text-stone-900 mb-2">Tidak ada aplikasi ditemukan</h3>
            <p class="text-stone-400 text-xs mb-6">Coba ubah filter pencarian Anda</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-stone-900 hover:bg-black text-[#FAF8F5] text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-xl transition shadow-md">
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
