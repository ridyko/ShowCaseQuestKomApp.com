@extends('layouts.app')
@section('title', $application->name)
@section('description', $application->tagline ?? Str::limit($application->description, 160))

@section('content')
<div class="pt-24">

    {{-- HERO HEADER --}}
    <div class="relative overflow-hidden border-b-2 border-stone-900 bg-white">
        {{-- Cover Background --}}
        @if($application->cover_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $application->cover_image) }}" class="w-full h-full object-cover opacity-5" alt="">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#FDF6E2]/10"></div>
        </div>
        @else
        <div class="absolute inset-0 z-0 dot-pattern opacity-40"></div>
        @endif

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-stone-600 hover:text-stone-900 text-xs font-black uppercase tracking-wider mb-10 transition">
                <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke Galeri
            </a>

            <div class="flex flex-col md:flex-row items-start gap-8 md:gap-12">
                {{-- Logo --}}
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-3xl overflow-hidden flex-shrink-0 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] border-2 border-stone-900 bg-[#FAF3E0] flex items-center justify-center font-display font-black text-4xl"
                     style="color: {{ $application->category?->color ?? '#1c1917' }}">
                    @if($application->logo_url)
                        <img src="{{ $application->logo_url }}" class="w-full h-full object-cover" alt="{{ $application->name }}"
                             onerror="this.parentElement.textContent='{{ substr($application->name,0,1) }}'">
                    @else
                        {{ substr($application->name, 0, 1) }}
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    @if($application->category)
                    <span class="inline-flex items-center gap-1.5 text-[9px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full mb-4 shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] border border-stone-900"
                          style="background:{{ $application->category->color }}22; color:#1c1917;">
                        <i class="fas {{ $application->category->icon }} text-[9px]"></i>
                        {{ $application->category->name }}
                    </span>
                    @endif
                    <h1 class="font-display text-4xl sm:text-5xl font-black text-stone-900 tracking-tight leading-none mb-3 uppercase">{{ $application->name }}</h1>
                    <p class="text-stone-700 text-lg font-bold mb-5">{{ $application->tagline }}</p>
                    
                    <div class="flex flex-wrap items-center gap-4 text-stone-500 text-xs font-bold mb-8">
                        <span><i class="fas fa-code-branch mr-1.5 text-stone-700"></i>v{{ $application->version }}</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
                        <span><i class="fas fa-eye mr-1.5 text-stone-700"></i>{{ number_format($application->view_count) }} views</span>
                        @if($application->is_featured)
                        <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
                        <span class="text-stone-900 bg-[#FDE047] border border-stone-900 px-2 py-0.5 rounded shadow-[1px_1px_0px_0px_rgba(28,25,23,1)]"><i class="fas fa-star mr-1 text-stone-900"></i>Unggulan</span>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3.5">
                        <a href="{{ $application->subdomain_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-[#86EFAC] border-2 border-stone-900 hover:bg-[#4ADE80] text-stone-900 font-black px-7 py-3.5 rounded-2xl transition shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] text-xs uppercase tracking-wider hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                            <i class="fas fa-rocket text-[10px]"></i> Coba Aplikasi
                        </a>
                        @if($application->demo_url)
                        <a href="{{ $application->demo_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-white border-2 border-stone-900 hover:bg-stone-100 text-stone-900 font-black px-7 py-3.5 rounded-2xl transition shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] text-xs uppercase tracking-wider hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                            <i class="fas fa-play-circle text-[10px]"></i> Demo
                        </a>
                        @endif
                        @if($application->source_url)
                        <a href="{{ $application->source_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-white border-2 border-stone-900 hover:bg-stone-100 text-stone-900 font-black px-7 py-3.5 rounded-2xl transition shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] text-xs uppercase tracking-wider hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                            <i class="fab fa-github text-[10px]"></i> Source Code
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT GRID --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT COLUMN: Details, Screenshots & Docs --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Deskripsi --}}
                @if($application->description)
                <div class="bg-white border-2 border-stone-900 rounded-3xl p-6 sm:p-8 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
                    <h2 class="font-display font-black text-stone-900 text-base mb-5 flex items-center gap-2.5 uppercase">
                        <span class="w-1.5 h-4 bg-stone-900 rounded-full"></span> Tentang Aplikasi
                    </h2>
                    <p class="text-stone-700 text-sm leading-relaxed whitespace-pre-line font-bold">{{ $application->description }}</p>
                </div>
                @endif

                {{-- Screenshots --}}
                @if($application->screenshots->count() > 0)
                <div class="bg-white border-2 border-stone-900 rounded-3xl p-6 sm:p-8 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
                    <h2 class="font-display font-black text-stone-900 text-base mb-6 flex items-center gap-2.5 uppercase">
                        <span class="w-1.5 h-4 bg-stone-900 rounded-full"></span> Screenshots
                        <span class="text-stone-500 font-normal text-xs ml-1 font-black">({{ $application->screenshots->count() }})</span>
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($application->screenshots as $ss)
                        <a href="{{ $ss->image_url }}" target="_blank" class="group block rounded-2xl overflow-hidden aspect-video bg-stone-50 border-2 border-stone-900 shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all">
                            <img src="{{ $ss->image_url }}" class="w-full h-full object-cover" alt="Screenshot" loading="lazy">
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Konten / Dokumentasi --}}
                @if($application->content)
                <div class="bg-white border-2 border-stone-900 rounded-3xl p-6 sm:p-8 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
                    <h2 class="font-display font-black text-stone-900 text-base mb-6 flex items-center gap-2.5 uppercase">
                        <span class="w-1.5 h-4 bg-stone-900 rounded-full"></span> Dokumentasi
                    </h2>
                    <div class="prose prose-stone prose-sm max-w-none text-stone-700 leading-relaxed whitespace-pre-line font-bold text-xs sm:text-sm">
                        {{ $application->content }}
                    </div>
                </div>
                @endif
            </div>

            {{-- RIGHT COLUMN: Sidebar Info --}}
            <div class="space-y-6">

                {{-- Tech Stack --}}
                @if($application->tech_stack && count($application->tech_stack) > 0)
                <div class="bg-white border-2 border-stone-900 rounded-3xl p-6 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
                    <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fas fa-layer-group text-stone-700 text-[10px]"></i> Tech Stack
                    </h3>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($application->tech_stack as $tech)
                        <span class="text-[10px] font-black uppercase tracking-wider px-3 py-1.5 bg-stone-100 border border-stone-900 text-stone-800 rounded-xl shadow-[1px_1px_0px_0px_rgba(28,25,23,1)]">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Fitur Utama --}}
                @if($application->features && count($application->features) > 0)
                <div class="bg-white border-2 border-stone-900 rounded-3xl p-6 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
                    <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fas fa-check-circle text-stone-700 text-[10px]"></i> Fitur Utama
                    </h3>
                    <ul class="space-y-3">
                        @foreach($application->features as $feature)
                        <li class="flex items-start gap-2.5 text-xs sm:text-sm text-stone-700 font-bold">
                            <i class="fas fa-check text-stone-900 text-[10px] mt-1 flex-shrink-0"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Spesifikasi Info --}}
                <div class="bg-white border-2 border-stone-900 rounded-3xl p-6 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] space-y-4">
                    <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-info-circle text-stone-700 text-[10px]"></i> Spesifikasi
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-xs sm:text-sm font-bold">
                            <span class="text-stone-500">Versi</span>
                            <span class="text-stone-900 font-black">v{{ $application->version }}</span>
                        </div>
                        @if($application->category)
                        <div class="flex items-center justify-between text-xs sm:text-sm font-bold">
                            <span class="text-stone-500">Kategori</span>
                            <span class="font-black" style="color:{{ $application->category->color }}">{{ $application->category->name }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between text-xs sm:text-sm font-bold">
                            <span class="text-stone-500">Total Views</span>
                            <span class="text-stone-900 font-black">{{ number_format($application->view_count) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs sm:text-sm font-bold">
                            <span class="text-stone-500">Dirilis</span>
                            <span class="text-stone-900 font-black">{{ $application->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Tautan Detail --}}
                <div class="bg-white border-2 border-stone-900 rounded-3xl p-6 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] space-y-3">
                    <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-link text-stone-700 text-[10px]"></i> Tautan Resmi
                    </h3>
                    <a href="{{ $application->subdomain_url }}" target="_blank"
                        class="flex items-center gap-3.5 p-3 rounded-2xl bg-[#86EFAC] border border-stone-900 shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-stone-950 flex items-center justify-center text-stone-50 text-xs shadow-[1px_1px_0px_0px_rgba(28,25,23,1)]">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-black uppercase tracking-wider text-stone-900">Kunjungi Aplikasi</p>
                            <p class="text-xs text-stone-600 font-bold truncate">{{ $application->slug }}.{{ config('app.domain') }}</p>
                        </div>
                        <i class="fas fa-external-link-alt text-stone-900 text-xs group-hover:text-stone-950 transition mr-1"></i>
                    </a>
                    @if($application->demo_url)
                    <a href="{{ $application->demo_url }}" target="_blank"
                        class="flex items-center justify-between p-3.5 rounded-2xl border-2 border-stone-900 hover:bg-stone-100 text-stone-800 text-xs font-black shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all">
                        <span class="flex items-center gap-2"><i class="fas fa-play-circle text-stone-700"></i> Demo</span>
                        <i class="fas fa-external-link-alt text-stone-700 text-[10px]"></i>
                    </a>
                    @endif
                    @if($application->source_url)
                    <a href="{{ $application->source_url }}" target="_blank"
                        class="flex items-center justify-between p-3.5 rounded-2xl border-2 border-stone-900 hover:bg-stone-100 text-stone-800 text-xs font-black shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all">
                        <span class="flex items-center gap-2"><i class="fab fa-github text-stone-700"></i> Source Code</span>
                        <i class="fas fa-external-link-alt text-stone-700 text-[10px]"></i>
                    </a>
                    @endif
                    @if($application->documentation_url)
                    <a href="{{ $application->documentation_url }}" target="_blank"
                        class="flex items-center justify-between p-3.5 rounded-2xl border-2 border-stone-900 hover:bg-stone-100 text-stone-800 text-xs font-black shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all">
                        <span class="flex items-center gap-2"><i class="fas fa-book text-stone-700"></i> Dokumentasi</span>
                        <i class="fas fa-external-link-alt text-stone-700 text-[10px]"></i>
                    </a>
                    @endif
                </div>

                {{-- Call To Action (Hubungi Kami) --}}
                <div class="bg-[#FDE047] border-2 border-stone-900 rounded-3xl p-6 text-center shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
                    <div class="w-10 h-10 bg-white border-2 border-stone-900 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                        <i class="fas fa-shopping-cart text-stone-900 text-sm"></i>
                    </div>
                    <p class="font-display font-black text-stone-900 text-sm mb-1 uppercase">Tertarik dengan aplikasi ini?</p>
                    <p class="text-stone-800 text-xs mb-5 font-bold leading-normal">Hubungi kami untuk mendapatkan informasi lisensi dan penawaran terbaik.</p>
                    <a href="https://questkomputer.com" target="_blank"
                        class="inline-flex items-center gap-2 bg-stone-950 hover:bg-black text-[#FAF8F5] text-xs font-black uppercase tracking-wider px-5 py-3.5 rounded-xl transition w-full justify-center shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                        <i class="fas fa-headset text-[10px]"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        {{-- RELATED APPLICATIONS --}}
        @if($related->count() > 0)
        <div class="mt-16 border-t-2 border-stone-900 pt-16">
            <h2 class="font-display font-black text-2xl text-stone-900 mb-8 flex items-center gap-3 uppercase">
                <span class="w-1.5 h-6 bg-stone-900 rounded-full"></span> Aplikasi Serupa
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $app)
                <a href="{{ route('app.show', $app->slug) }}"
                    class="bg-white border-2 border-stone-900 rounded-3xl p-5 flex items-start gap-4 hover:bg-stone-100 hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] transition-all group shadow-[3px_3px_0px_0px_rgba(28,25,23,1)]">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-display font-black text-sm flex-shrink-0 shadow-[1px_1px_0px_0px_rgba(28,25,23,1)] border border-stone-900 bg-stone-50"
                        style="color:{{ $app->category?->color ?? '#1c1917' }}">
                        @if($app->logo_url)
                            <img src="{{ $app->logo_url }}" class="w-full h-full object-cover rounded-xl" alt="" onerror="this.parentElement.textContent='{{ substr($app->name,0,1) }}'">
                        @else
                            {{ substr($app->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="font-display font-black text-stone-900 text-sm group-hover:text-stone-700 transition">{{ $app->name }}</p>
                        <p class="text-stone-500 text-xs mt-0.5 font-bold truncate">{{ $app->tagline }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
