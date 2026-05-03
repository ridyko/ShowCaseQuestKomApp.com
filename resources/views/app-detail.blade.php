@extends('layouts.app')
@section('title', $application->name)
@section('description', $application->tagline ?? Str::limit($application->description, 160))

@section('content')
<div class="pt-20">

    {{-- HERO --}}
    <div class="relative overflow-hidden">
        {{-- Cover Background --}}
        @if($application->cover_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $application->cover_image) }}" class="w-full h-full object-cover opacity-10" alt="">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#0f1117]/80 to-[#0f1117]"></div>
        </div>
        @else
        <div class="absolute inset-0 z-0" style="background: radial-gradient(ellipse at top right, {{ $application->category?->color ?? '#6366f1' }}20, transparent 60%)"></div>
        @endif

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-16">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-white/40 hover:text-white text-sm mb-8 transition">
                <i class="fas fa-arrow-left"></i> Kembali ke Galeri
            </a>

            <div class="flex flex-col sm:flex-row items-start gap-8">
                {{-- Logo --}}
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-3xl overflow-hidden flex-shrink-0 shadow-2xl flex items-center justify-center font-black text-4xl"
                    style="background: {{ $application->category?->color ?? '#6366f1' }}30; color: {{ $application->category?->color ?? '#6366f1' }}">
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
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-full mb-3"
                        style="background:{{ $application->category->color }}20;color:{{ $application->category->color }}">
                        <i class="fas {{ $application->category->icon }}"></i>
                        {{ $application->category->name }}
                    </span>
                    @endif
                    <h1 class="text-4xl sm:text-5xl font-black mb-3">{{ $application->name }}</h1>
                    <p class="text-cyan-400 text-lg font-semibold mb-4">{{ $application->tagline }}</p>
                    <div class="flex flex-wrap items-center gap-4 text-white/40 text-sm mb-6">
                        <span><i class="fas fa-code-branch mr-1.5"></i>v{{ $application->version }}</span>
                        <span><i class="fas fa-eye mr-1.5"></i>{{ number_format($application->view_count) }} views</span>
                        @if($application->is_featured)
                        <span class="text-yellow-400"><i class="fas fa-star mr-1.5"></i>Unggulan</span>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $application->subdomain_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-brand hover:bg-brand-dark text-white font-bold px-6 py-3 rounded-2xl transition shadow-xl shadow-brand/30 text-sm">
                            <i class="fas fa-rocket"></i> Coba Aplikasi
                        </a>
                        @if($application->demo_url)
                        <a href="{{ $application->demo_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold px-6 py-3 rounded-2xl transition text-sm">
                            <i class="fas fa-play-circle"></i> Demo
                        </a>
                        @endif
                        @if($application->source_url)
                        <a href="{{ $application->source_url }}" target="_blank"
                            class="inline-flex items-center gap-2.5 bg-white/5 border border-white/10 hover:bg-white/10 text-white font-semibold px-6 py-3 rounded-2xl transition text-sm">
                            <i class="fab fa-github"></i> Source Code
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Deskripsi + Screenshots + Konten --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Deskripsi --}}
                @if($application->description)
                <div class="bg-[#161b27] border border-white/7 rounded-2xl p-6">
                    <h2 class="font-bold text-base mb-4 flex items-center gap-2.5">
                        <i class="fas fa-align-left text-brand text-sm"></i> Tentang Aplikasi
                    </h2>
                    <p class="text-white/60 leading-relaxed">{{ $application->description }}</p>
                </div>
                @endif

                {{-- Screenshots --}}
                @if($application->screenshots->count() > 0)
                <div class="bg-[#161b27] border border-white/7 rounded-2xl p-6">
                    <h2 class="font-bold text-base mb-5 flex items-center gap-2.5">
                        <i class="fas fa-images text-brand text-sm"></i> Screenshots
                        <span class="text-white/30 font-normal text-sm">({{ $application->screenshots->count() }})</span>
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($application->screenshots as $ss)
                        <a href="{{ $ss->image_url }}" target="_blank" class="block rounded-xl overflow-hidden aspect-video bg-black/30 hover:opacity-80 transition">
                            <img src="{{ $ss->image_url }}" class="w-full h-full object-cover" alt="Screenshot" loading="lazy">
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Konten / Dokumentasi --}}
                @if($application->content)
                <div class="bg-[#161b27] border border-white/7 rounded-2xl p-6">
                    <h2 class="font-bold text-base mb-5 flex items-center gap-2.5">
                        <i class="fas fa-book text-brand text-sm"></i> Dokumentasi
                    </h2>
                    <div class="prose prose-invert prose-sm max-w-none text-white/60 leading-relaxed whitespace-pre-line">
                        {{ $application->content }}
                    </div>
                </div>
                @endif
            </div>

            {{-- Kolom Kanan: Info Sidebar --}}
            <div class="space-y-5">

                {{-- Tech Stack --}}
                @if($application->tech_stack && count($application->tech_stack) > 0)
                <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5">
                    <h3 class="font-bold text-sm mb-4 flex items-center gap-2">
                        <i class="fas fa-layer-group text-brand text-xs"></i> Tech Stack
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($application->tech_stack as $tech)
                        <span class="text-xs font-semibold px-3 py-1.5 bg-brand/10 border border-brand/20 text-brand rounded-full">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Fitur Utama --}}
                @if($application->features && count($application->features) > 0)
                <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5">
                    <h3 class="font-bold text-sm mb-4 flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-400 text-xs"></i> Fitur Utama
                    </h3>
                    <ul class="space-y-2.5">
                        @foreach($application->features as $feature)
                        <li class="flex items-start gap-2.5 text-sm text-white/60">
                            <i class="fas fa-check text-green-400 text-xs mt-0.5 flex-shrink-0"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Info --}}
                <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5 space-y-4">
                    <h3 class="font-bold text-sm flex items-center gap-2">
                        <i class="fas fa-info-circle text-brand text-xs"></i> Informasi
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-white/40">Versi</span>
                            <span class="font-semibold">v{{ $application->version }}</span>
                        </div>
                        @if($application->category)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-white/40">Kategori</span>
                            <span class="font-semibold" style="color:{{ $application->category->color }}">{{ $application->category->name }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-white/40">Total Views</span>
                            <span class="font-semibold">{{ number_format($application->view_count) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-white/40">Dirilis</span>
                            <span class="font-semibold">{{ $application->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Tautan --}}
                <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5 space-y-3">
                    <h3 class="font-bold text-sm flex items-center gap-2">
                        <i class="fas fa-link text-brand text-xs"></i> Tautan
                    </h3>
                    <a href="{{ $application->subdomain_url }}" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-brand/10 border border-brand/20 hover:bg-brand/20 transition group">
                        <i class="fas fa-rocket text-brand text-sm"></i>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-brand">Coba Aplikasi</p>
                            <p class="text-xs text-white/30 truncate">{{ $application->slug }}.{{ config('app.domain') }}</p>
                        </div>
                        <i class="fas fa-external-link-alt text-brand/50 text-xs group-hover:text-brand transition"></i>
                    </a>
                    @if($application->demo_url)
                    <a href="{{ $application->demo_url }}" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-white/3 border border-white/7 hover:bg-white/6 transition">
                        <i class="fas fa-play-circle text-white/50 text-sm"></i>
                        <span class="text-sm text-white/60 flex-1">Demo</span>
                        <i class="fas fa-external-link-alt text-white/20 text-xs"></i>
                    </a>
                    @endif
                    @if($application->source_url)
                    <a href="{{ $application->source_url }}" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-white/3 border border-white/7 hover:bg-white/6 transition">
                        <i class="fab fa-github text-white/50 text-sm"></i>
                        <span class="text-sm text-white/60 flex-1">Source Code</span>
                        <i class="fas fa-external-link-alt text-white/20 text-xs"></i>
                    </a>
                    @endif
                    @if($application->documentation_url)
                    <a href="{{ $application->documentation_url }}" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl bg-white/3 border border-white/7 hover:bg-white/6 transition">
                        <i class="fas fa-book text-white/50 text-sm"></i>
                        <span class="text-sm text-white/60 flex-1">Dokumentasi</span>
                        <i class="fas fa-external-link-alt text-white/20 text-xs"></i>
                    </a>
                    @endif
                </div>

                {{-- CTA --}}
                <div class="bg-gradient-to-br from-brand/20 to-cyan-500/10 border border-brand/20 rounded-2xl p-5 text-center">
                    <i class="fas fa-shopping-cart text-brand text-2xl mb-3 block"></i>
                    <p class="font-bold text-sm mb-1">Tertarik dengan aplikasi ini?</p>
                    <p class="text-white/40 text-xs mb-4">Hubungi kami untuk info harga dan lisensi</p>
                    <a href="https://questkomputer.com" target="_blank"
                        class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white text-xs font-bold px-5 py-2.5 rounded-xl transition w-full justify-center">
                        <i class="fas fa-headset"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        {{-- Related Apps --}}
        @if($related->count() > 0)
        <div class="mt-16">
            <h2 class="text-xl font-black mb-6 flex items-center gap-3">
                <i class="fas fa-th-large text-brand"></i> Aplikasi Serupa
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($related as $app)
                <a href="{{ route('app.show', $app->slug) }}"
                    class="bg-[#161b27] border border-white/7 rounded-2xl p-5 flex items-start gap-4 hover:border-brand hover:-translate-y-1 transition group">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg flex-shrink-0"
                        style="background:{{ $app->category?->color ?? '#6366f1' }}20;color:{{ $app->category?->color ?? '#6366f1' }}">
                        @if($app->logo_url)
                            <img src="{{ $app->logo_url }}" class="w-full h-full object-cover rounded-xl" alt="" onerror="this.parentElement.textContent='{{ substr($app->name,0,1) }}'">
                        @else
                            {{ substr($app->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-sm group-hover:text-brand transition">{{ $app->name }}</p>
                        <p class="text-white/40 text-xs mt-0.5 truncate">{{ $app->tagline }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
