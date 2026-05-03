<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $application->name }} — {{ config('app.name') }}</title>
    <meta name="description" content="{{ $application->tagline ?? $application->description }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subdomain.css') }}">
</head>
<body class="subdomain-body">

    <!-- Top Bar -->
    <div class="subdomain-topbar">
        <div class="topbar-inner">
            <a href="http://{{ config('app.domain') }}" class="topbar-brand" title="Kembali ke Showcase">
                <i class="fas fa-rocket"></i>
                <span>Show<span class="brand-accent">case</span></span>
            </a>
            <div class="topbar-info">
                <span class="topbar-badge">
                    <i class="fas fa-globe"></i>
                    {{ $application->slug }}.{{ config('app.domain') }}
                </span>
            </div>
            <a href="http://{{ config('app.domain') }}" class="topbar-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Galeri
            </a>
        </div>
    </div>

    <!-- App Hero -->
    <section class="app-hero" style="--theme-color: {{ $application->category?->color ?? '#6366f1' }}">
        <div class="app-hero-bg">
            <div class="app-hero-gradient"></div>
        </div>
        <div class="app-hero-content">
            <div class="app-hero-info">
                <div class="app-hero-logo">
                    <img src="{{ $application->logo_url }}" alt="{{ $application->name }}">
                </div>
                <div class="app-hero-text">
                    @if($application->category)
                    <span class="category-badge" style="--badge-color: {{ $application->category->color }}">
                        <i class="fas {{ $application->category->icon }}"></i>
                        {{ $application->category->name }}
                    </span>
                    @endif
                    <h1>{{ $application->name }}</h1>
                    <p class="app-tagline">{{ $application->tagline }}</p>
                    <div class="app-meta-row">
                        <span><i class="fas fa-tag"></i> v{{ $application->version }}</span>
                        <span><i class="fas fa-eye"></i> {{ number_format($application->view_count) }} views</span>
                        <span><i class="fas fa-calendar"></i> {{ $application->published_at?->translatedFormat('d M Y') }}</span>
                        <span><i class="fas fa-user"></i> {{ $application->user->name }}</span>
                    </div>
                </div>
            </div>
            <div class="app-hero-actions">
                @if($application->demo_url)
                <a href="{{ $application->demo_url }}" class="btn btn-primary btn-lg" target="_blank">
                    <i class="fas fa-play"></i> Live Demo
                </a>
                @endif
                @if($application->source_url)
                <a href="{{ $application->source_url }}" class="btn btn-outline btn-lg" target="_blank">
                    <i class="fab fa-github"></i> Source Code
                </a>
                @endif
                @if($application->documentation_url)
                <a href="{{ $application->documentation_url }}" class="btn btn-outline btn-lg" target="_blank">
                    <i class="fas fa-book"></i> Dokumentasi
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- App Content -->
    <div class="app-content-wrapper">
        <div class="container">
            <div class="app-layout">
                <!-- Main Content -->
                <div class="app-main">
                    <!-- Description -->
                    <div class="content-card">
                        <h2><i class="fas fa-info-circle"></i> Tentang Aplikasi</h2>
                        <p class="app-description">{{ $application->description }}</p>
                    </div>

                    <!-- Rich Content / Documentation -->
                    @if($application->content)
                    <div class="content-card">
                        <h2><i class="fas fa-file-alt"></i> Dokumentasi</h2>
                        <div class="markdown-content">
                            {!! nl2br(e($application->content)) !!}
                        </div>
                    </div>
                    @endif

                    <!-- Screenshots Gallery -->
                    @if($application->screenshots->count() > 0)
                    <div class="content-card">
                        <h2><i class="fas fa-images"></i> Screenshots</h2>
                        <div class="screenshot-gallery">
                            @foreach($application->screenshots as $screenshot)
                            <div class="screenshot-item">
                                <img src="{{ $screenshot->image_url }}" alt="{{ $screenshot->alt_text ?? $application->name }}" loading="lazy">
                                @if($screenshot->caption)
                                <span class="screenshot-caption">{{ $screenshot->caption }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Features List -->
                    @if($application->features && count($application->features) > 0)
                    <div class="content-card">
                        <h2><i class="fas fa-check-double"></i> Fitur Utama</h2>
                        <div class="features-grid">
                            @foreach($application->features as $feature)
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <aside class="app-sidebar">
                    <!-- Tech Stack -->
                    @if($application->tech_stack && count($application->tech_stack) > 0)
                    <div class="sidebar-card">
                        <h3><i class="fas fa-layer-group"></i> Tech Stack</h3>
                        <div class="tech-stack-list">
                            @foreach($application->tech_stack as $tech)
                            <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- App Info -->
                    <div class="sidebar-card">
                        <h3><i class="fas fa-info"></i> Informasi</h3>
                        <div class="info-list">
                            <div class="info-row">
                                <span class="info-label">Versi</span>
                                <span class="info-value">{{ $application->version }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Kategori</span>
                                <span class="info-value">{{ $application->category?->name ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Developer</span>
                                <span class="info-value">{{ $application->user->name }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Dipublikasi</span>
                                <span class="info-value">{{ $application->published_at?->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Dilihat</span>
                                <span class="info-value">{{ number_format($application->view_count) }}x</span>
                            </div>
                        </div>
                    </div>

                    <!-- Links -->
                    <div class="sidebar-card">
                        <h3><i class="fas fa-link"></i> Tautan</h3>
                        <div class="link-list">
                            @if($application->demo_url)
                            <a href="{{ $application->demo_url }}" target="_blank" class="link-item">
                                <i class="fas fa-play-circle"></i> Live Demo
                            </a>
                            @endif
                            @if($application->source_url)
                            <a href="{{ $application->source_url }}" target="_blank" class="link-item">
                                <i class="fab fa-github"></i> Source Code
                            </a>
                            @endif
                            @if($application->documentation_url)
                            <a href="{{ $application->documentation_url }}" target="_blank" class="link-item">
                                <i class="fas fa-book-open"></i> Dokumentasi
                            </a>
                            @endif
                            <a href="http://{{ config('app.domain') }}" class="link-item">
                                <i class="fas fa-arrow-left"></i> Kembali ke Galeri
                            </a>
                        </div>
                    </div>

                    <!-- Related Apps -->
                    @if($relatedApps->count() > 0)
                    <div class="sidebar-card">
                        <h3><i class="fas fa-th-large"></i> Aplikasi Terkait</h3>
                        <div class="related-list">
                            @foreach($relatedApps as $related)
                            <a href="{{ $related->subdomain_url }}" class="related-item">
                                <img src="{{ $related->logo_url }}" alt="{{ $related->name }}">
                                <div>
                                    <span class="related-name">{{ $related->name }}</span>
                                    <span class="related-tagline">{{ Str::limit($related->tagline, 40) }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="subdomain-footer">
        <div class="container">
            <p>Bagian dari <a href="http://{{ config('app.domain') }}"><i class="fas fa-rocket"></i> Showcase Platform</a> — Dibangun dengan Laravel 11</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
