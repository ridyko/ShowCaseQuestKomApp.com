@extends('layouts.app')
@section('title', $application->name)
@section('description', $application->tagline ?? Str::limit($application->description, 160))

@section('content')
<div class="pt-24">

    {{-- HERO HEADER --}}
    <div class="relative overflow-hidden border-b border-slate-100 bg-white">
        {{-- Cover Background --}}
        @if($application->cover_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $application->cover_image) }}" class="w-full h-full object-cover opacity-5" alt="">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#F8FAFC]/10"></div>
        </div>
        @else
        <div class="absolute inset-0 z-0 grid-pattern opacity-30"></div>
        @endif

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-16 sm:py-20">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-brand text-xs font-bold uppercase tracking-wider mb-10 transition">
                <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke Galeri
            </a>

            <div class="flex flex-col md:flex-row items-start gap-8 md:gap-12">
                {{-- Logo --}}
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-3xl overflow-hidden flex-shrink-0 shadow-sm border border-slate-100 bg-slate-50 flex items-center justify-center font-display font-black text-4xl shadow-inner"
                     style="color: {{ $application->category?->color ?? '#4f46e5' }}">
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
                    <span class="inline-flex items-center gap-1.5 text-[9px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full mb-4 shadow-sm"
                          style="background:{{ $application->category->color }}12; color:{{ $application->category->color }}; border: 1px solid {{ $application->category->color }}20;">
                        <i class="fas {{ $application->category->icon }} text-[9px]"></i>
                        {{ $application->category->name }}
                    </span>
                    @endif
                    <h1 class="font-display text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-none mb-3">{{ $application->name }}</h1>
                    <p class="text-slate-500 text-lg font-medium mb-5">{{ $application->tagline }}</p>
                    
                    <div class="flex flex-wrap items-center gap-4 text-slate-400 text-xs font-semibold mb-8">
                        <span><i class="fas fa-code-branch mr-1.5 text-slate-300"></i>v{{ $application->version }}</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                        <span><i class="fas fa-eye mr-1.5 text-slate-300"></i>{{ number_format($application->view_count) }} views</span>
                        @if($application->is_featured)
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                        <span class="text-brand"><i class="fas fa-star mr-1.5 text-brand"></i>Unggulan</span>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $application->subdomain_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-brand hover:bg-brand-dark text-white font-bold px-7 py-3.5 rounded-2xl transition shadow-lg shadow-brand/20 text-xs uppercase tracking-wider">
                            <i class="fas fa-rocket text-[10px]"></i> Coba Aplikasi
                        </a>
                        @if($application->demo_url)
                        <a href="{{ $application->demo_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold px-7 py-3.5 rounded-2xl transition shadow-sm text-xs uppercase tracking-wider">
                            <i class="fas fa-play-circle text-[10px]"></i> Demo
                        </a>
                        @endif
                        @if($application->source_url)
                        <a href="{{ $application->source_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold px-7 py-3.5 rounded-2xl transition shadow-sm text-xs uppercase tracking-wider">
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
                <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm">
                    <h2 class="font-display font-black text-slate-900 text-base mb-5 flex items-center gap-2.5">
                        <span class="w-1 h-4 bg-brand rounded-full"></span> Tentang Aplikasi
                    </h2>
                    <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">{{ $application->description }}</p>
                </div>
                @endif

                {{-- Screenshots --}}
                @if($application->screenshots->count() > 0)
                <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm">
                    <h2 class="font-display font-black text-slate-900 text-base mb-6 flex items-center gap-2.5">
                        <span class="w-1 h-4 bg-brand rounded-full"></span> Screenshots
                        <span class="text-slate-400 font-normal text-xs ml-1">({{ $application->screenshots->count() }})</span>
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($application->screenshots as $ss)
                        <a href="{{ $ss->image_url }}" target="_blank" class="group block rounded-2xl overflow-hidden aspect-video bg-slate-50 border border-slate-150 hover:border-brand transition duration-300 shadow-sm relative">
                            <img src="{{ $ss->image_url }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-102" alt="Screenshot" loading="lazy">
                            <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/5 transition duration-300"></div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Konten / Dokumentasi --}}
                @if($application->content)
                <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-sm">
                    <h2 class="font-display font-black text-slate-900 text-base mb-6 flex items-center gap-2.5">
                        <span class="w-1 h-4 bg-brand rounded-full"></span> Dokumentasi
                    </h2>
                    <div class="prose prose-slate prose-sm max-w-none text-slate-600 leading-relaxed whitespace-pre-line font-medium text-xs sm:text-sm">
                        {{ $application->content }}
                    </div>
                </div>
                @endif
            </div>

            {{-- RIGHT COLUMN: Sidebar Info --}}
            <div class="space-y-6">

                {{-- Tech Stack --}}
                @if($application->tech_stack && count($application->tech_stack) > 0)
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="font-display font-black text-slate-900 text-xs uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fas fa-layer-group text-slate-400 text-[10px]"></i> Tech Stack
                    </h3>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($application->tech_stack as $tech)
                        <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 bg-slate-50 border border-slate-100 text-slate-600 rounded-xl">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Fitur Utama --}}
                @if($application->features && count($application->features) > 0)
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="font-display font-black text-slate-900 text-xs uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fas fa-check-circle text-slate-400 text-[10px]"></i> Fitur Utama
                    </h3>
                    <ul class="space-y-3">
                        @foreach($application->features as $feature)
                        <li class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-600 font-medium">
                            <i class="fas fa-check text-brand text-[10px] mt-1 flex-shrink-0"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Spesifikasi Info --}}
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm space-y-4">
                    <h3 class="font-display font-black text-slate-900 text-xs uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-info-circle text-slate-400 text-[10px]"></i> Spesifikasi
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-xs sm:text-sm font-medium">
                            <span class="text-slate-400">Versi</span>
                            <span class="text-slate-800 font-bold">v{{ $application->version }}</span>
                        </div>
                        @if($application->category)
                        <div class="flex items-center justify-between text-xs sm:text-sm font-medium">
                            <span class="text-slate-400">Kategori</span>
                            <span class="font-bold" style="color:{{ $application->category->color }}">{{ $application->category->name }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between text-xs sm:text-sm font-medium">
                            <span class="text-slate-400">Total Views</span>
                            <span class="text-slate-800 font-bold">{{ number_format($application->view_count) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-xs sm:text-sm font-medium">
                            <span class="text-slate-400">Dirilis</span>
                            <span class="text-slate-800 font-bold">{{ $application->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Tautan Detail --}}
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm space-y-3">
                    <h3 class="font-display font-black text-slate-900 text-xs uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-link text-slate-400 text-[10px]"></i> Tautan Resmi
                    </h3>
                    <a href="{{ $application->subdomain_url }}" target="_blank"
                        class="flex items-center gap-3.5 p-3 rounded-2xl bg-brand/5 border border-brand/10 hover:border-brand transition group">
                        <div class="w-10 h-10 rounded-xl bg-brand flex items-center justify-center text-white text-xs shadow-sm">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-brand">Kunjungi Aplikasi</p>
                            <p class="text-xs text-slate-400 truncate">{{ $application->slug }}.{{ config('app.domain') }}</p>
                        </div>
                        <i class="fas fa-external-link-alt text-brand/50 text-xs group-hover:text-brand transition mr-1"></i>
                    </a>
                    @if($application->demo_url)
                    <a href="{{ $application->demo_url }}" target="_blank"
                        class="flex items-center justify-between p-3.5 rounded-2xl border border-slate-200 hover:border-brand text-slate-600 hover:text-brand text-xs font-semibold transition">
                        <span class="flex items-center gap-2"><i class="fas fa-play-circle text-slate-400"></i> Demo</span>
                        <i class="fas fa-external-link-alt text-slate-300 text-[10px]"></i>
                    </a>
                    @endif
                    @if($application->source_url)
                    <a href="{{ $application->source_url }}" target="_blank"
                        class="flex items-center justify-between p-3.5 rounded-2xl border border-slate-200 hover:border-brand text-slate-600 hover:text-brand text-xs font-semibold transition">
                        <span class="flex items-center gap-2"><i class="fab fa-github text-slate-400"></i> Source Code</span>
                        <i class="fas fa-external-link-alt text-slate-300 text-[10px]"></i>
                    </a>
                    @endif
                    @if($application->documentation_url)
                    <a href="{{ $application->documentation_url }}" target="_blank"
                        class="flex items-center justify-between p-3.5 rounded-2xl border border-slate-200 hover:border-brand text-slate-600 hover:text-brand text-xs font-semibold transition">
                        <span class="flex items-center gap-2"><i class="fas fa-book text-slate-400"></i> Dokumentasi</span>
                        <i class="fas fa-external-link-alt text-slate-300 text-[10px]"></i>
                    </a>
                    @endif
                </div>

                {{-- Call To Action (Hubungi Kami) --}}
                <div class="bg-gradient-to-br from-brand/5 to-transparent border border-slate-150 rounded-3xl p-6 text-center shadow-sm">
                    <div class="w-10 h-10 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-inner">
                        <i class="fas fa-shopping-cart text-brand text-sm"></i>
                    </div>
                    <p class="font-display font-black text-slate-900 text-sm mb-1">Tertarik dengan aplikasi ini?</p>
                    <p class="text-slate-400 text-xs mb-5 leading-normal">Hubungi kami untuk mendapatkan informasi lisensi dan penawaran terbaik.</p>
                    <a href="https://questkomputer.com" target="_blank"
                        class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white text-xs font-bold uppercase tracking-wider px-5 py-3.5 rounded-xl transition w-full justify-center shadow-md shadow-brand/10">
                        <i class="fas fa-headset text-[10px]"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        {{-- RELATED APPLICATIONS --}}
        @if($related->count() > 0)
        <div class="mt-16 border-t border-slate-100 pt-16">
            <h2 class="font-display font-black text-2xl text-slate-900 mb-8 flex items-center gap-3">
                <span class="w-1.5 h-6 bg-brand rounded-full"></span> Aplikasi Serupa
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $app)
                <a href="{{ route('app.show', $app->slug) }}"
                    class="bg-white border border-slate-200/80 rounded-3xl p-5 flex items-start gap-4 hover:border-brand hover:-translate-y-0.5 transition duration-300 group shadow-sm">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-display font-black text-sm flex-shrink-0 shadow-inner border border-slate-100 bg-slate-50"
                        style="color:{{ $app->category?->color ?? '#4f46e5' }}">
                        @if($app->logo_url)
                            <img src="{{ $app->logo_url }}" class="w-full h-full object-cover rounded-xl" alt="" onerror="this.parentElement.textContent='{{ substr($app->name,0,1) }}'">
                        @else
                            {{ substr($app->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="font-display font-black text-slate-900 text-sm group-hover:text-brand transition">{{ $app->name }}</p>
                        <p class="text-slate-400 text-xs mt-0.5 font-medium truncate">{{ $app->tagline }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
