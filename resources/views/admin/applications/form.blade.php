@extends('layouts.admin')
@section('title', isset($application) ? 'Edit: ' . $application->name : 'Tambah Aplikasi')
@section('page-title', isset($application) ? 'Edit Aplikasi' : 'Tambah Aplikasi Baru')

@push('styles')
<style>
.fi { width:100%; background:rgba(255,255,255,.05)!important; border:1px solid rgba(255,255,255,.1); border-radius:10px; padding:11px 14px; font-size:.875rem; color:#fff!important; outline:none; transition:border-color .2s; font-family:inherit; -webkit-text-fill-color:#fff!important; }
.fi:focus { border-color:#6366f1; background:rgba(99,102,241,.08)!important; }
.fi::placeholder { color:rgba(255,255,255,.25)!important; }
.fi:-webkit-autofill,.fi:-webkit-autofill:focus { -webkit-box-shadow:0 0 0 1000px #1a1f2e inset!important; -webkit-text-fill-color:#fff!important; }
.fi-select { width:100%; background:#161b27!important; border:1px solid rgba(255,255,255,.1); border-radius:10px; padding:11px 14px; font-size:.875rem; color:#fff!important; outline:none; transition:border-color .2s; font-family:inherit; cursor:pointer; }
.fi-select:focus { border-color:#6366f1; }
.fi-select option { background:#161b27; color:#fff; }
</style>
@endpush

@section('content')
<form action="{{ isset($application) ? route('admin.applications.update', $application) : route('admin.applications.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($application)) @method('PUT') @endif

    @if($errors->any())
    <div class="flex items-start gap-3 bg-red-900/40 border border-red-500/30 text-red-400 px-5 py-4 rounded-xl mb-6 text-sm">
        <i class="fas fa-exclamation-circle mt-0.5"></i>
        <div>
            <p class="font-semibold mb-1">Terdapat kesalahan:</p>
            <ul class="list-disc list-inside space-y-0.5 text-red-400/80">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-white/5 flex items-center gap-2.5">
                    <i class="fas fa-info-circle text-brand text-sm"></i>
                    <h3 class="font-semibold text-sm">Informasi Utama</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Nama Aplikasi *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $application->name ?? '') }}"
                            required placeholder="Nama aplikasi Anda" class="fi">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Slug (Subdomain) *</label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $application->slug ?? '') }}"
                                    required placeholder="nama-app" class="fi flex-1">
                                <span class="text-white/30 text-xs whitespace-nowrap">.{{ config('app.domain') }}</span>
                            </div>
                            <p class="text-white/25 text-xs mt-1.5">URL: <span id="slugPreview" class="text-brand">{{ $application->slug ?? 'slug' }}</span>.{{ config('app.domain') }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Versi</label>
                            <input type="text" name="version" value="{{ old('version', $application->version ?? '1.0.0') }}"
                                placeholder="1.0.0" class="fi">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $application->tagline ?? '') }}"
                            placeholder="Satu kalimat tentang aplikasi Anda" class="fi">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" placeholder="Deskripsikan aplikasi Anda..." class="fi" style="resize:vertical">{{ old('description', $application->description ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Konten / Dokumentasi</label>
                        <textarea name="content" rows="8" placeholder="Dokumentasi lengkap..." class="fi" style="resize:vertical">{{ old('content', $application->content ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Links & Tech --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
                    <div class="px-5 py-4 border-b border-white/5 flex items-center gap-2.5">
                        <i class="fas fa-link text-brand text-sm"></i>
                        <h3 class="font-semibold text-sm">Tautan</h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Demo URL</label>
                            <input type="url" name="demo_url" value="{{ old('demo_url', $application->demo_url ?? '') }}" placeholder="https://..." class="fi">
                        </div>
                        <div>
                            <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Source Code URL</label>
                            <input type="url" name="source_url" value="{{ old('source_url', $application->source_url ?? '') }}" placeholder="https://github.com/..." class="fi">
                        </div>
                        <div>
                            <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Dokumentasi URL</label>
                            <input type="url" name="documentation_url" value="{{ old('documentation_url', $application->documentation_url ?? '') }}" placeholder="https://..." class="fi">
                        </div>
                    </div>
                </div>
                <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
                    <div class="px-5 py-4 border-b border-white/5 flex items-center gap-2.5">
                        <i class="fas fa-layer-group text-brand text-sm"></i>
                        <h3 class="font-semibold text-sm">Teknis</h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Tech Stack</label>
                            <input type="text" name="tech_stack"
                                value="{{ old('tech_stack', isset($application) && $application->tech_stack ? implode(', ', $application->tech_stack) : '') }}"
                                placeholder="Laravel, PHP, MySQL, ..." class="fi">
                            <p class="text-white/25 text-xs mt-1">Pisahkan dengan koma</p>
                        </div>
                        <div>
                            <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Fitur Utama</label>
                            <input type="text" name="features"
                                value="{{ old('features', isset($application) && $application->features ? implode(', ', $application->features) : '') }}"
                                placeholder="Login, Dashboard, Report, ..." class="fi">
                            <p class="text-white/25 text-xs mt-1">Pisahkan dengan koma</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar --}}
        <div class="space-y-5">
            {{-- Pengaturan --}}
            <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
                <div class="px-5 py-4 border-b border-white/5 flex items-center gap-2.5">
                    <i class="fas fa-cog text-brand text-sm"></i>
                    <h3 class="font-semibold text-sm">Pengaturan</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Kategori</label>
                        <select name="category_id" class="fi-select">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $application->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Status *</label>
                        <select name="status" required class="fi-select">
                            <option value="draft" {{ old('status', $application->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $application->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $application->status ?? '') === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured', $application->is_featured ?? false) ? 'checked' : '' }}
                            class="w-4 h-4 accent-brand rounded">
                        <span class="text-sm text-white/60">Tandai sebagai unggulan</span>
                    </label>
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white font-semibold py-3 rounded-xl transition text-sm shadow-lg shadow-brand/20">
                        <i class="fas fa-save"></i>
                        {{ isset($application) ? 'Simpan Perubahan' : 'Simpan Aplikasi' }}
                    </button>
                    <a href="{{ route('admin.applications.index') }}" class="w-full flex items-center justify-center gap-2 bg-white/5 hover:bg-white/10 border border-white/10 text-white/60 hover:text-white font-medium py-2.5 rounded-xl transition text-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            {{-- Media --}}
            <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
                <div class="px-5 py-4 border-b border-white/5 flex items-center gap-2.5">
                    <i class="fas fa-image text-brand text-sm"></i>
                    <h3 class="font-semibold text-sm">Media</h3>
                </div>
                <div class="p-5 space-y-5">
                    <div>
                        <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Logo Aplikasi</label>
                        @if(isset($application) && $application->logo)
                        <img src="{{ asset('storage/' . $application->logo) }}" class="w-16 h-16 rounded-xl object-cover mb-3" alt="Logo">
                        @endif
                        <input type="file" name="logo" accept="image/*"
                            class="w-full text-sm text-white/50 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand/10 file:text-brand file:text-xs file:font-semibold file:cursor-pointer hover:file:bg-brand/20">
                        <p class="text-white/25 text-xs mt-1.5">Maks 2MB, format: JPG, PNG, SVG</p>
                    </div>
                    <div>
                        <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Cover Image</label>
                        @if(isset($application) && $application->cover_image)
                        <img src="{{ asset('storage/' . $application->cover_image) }}" class="w-full h-24 rounded-xl object-cover mb-3" alt="Cover">
                        @endif
                        <input type="file" name="cover_image" accept="image/*"
                            class="w-full text-sm text-white/50 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand/10 file:text-brand file:text-xs file:font-semibold file:cursor-pointer hover:file:bg-brand/20">
                        <p class="text-white/25 text-xs mt-1.5">Maks 5MB</p>
                    </div>
                    <div>
                        <label class="block text-xs text-white/40 uppercase tracking-widest mb-2">Screenshots</label>
                        @if(isset($application) && $application->screenshots->count())
                        <div class="grid grid-cols-3 gap-2 mb-3">
                            @foreach($application->screenshots as $ss)
                            <div class="relative group">
                                <img src="{{ $ss->image_url }}" class="w-full h-16 object-cover rounded-lg" alt="">
                                <form action="{{ route('admin.screenshots.destroy', $ss->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="absolute top-1 right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center text-white text-xs opacity-0 group-hover:opacity-100 transition">
                                        <i class="fas fa-times" style="font-size:.5rem;"></i>
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <input type="file" name="screenshots[]" accept="image/*" multiple
                            class="w-full text-sm text-white/50 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand/10 file:text-brand file:text-xs file:font-semibold file:cursor-pointer hover:file:bg-brand/20">
                        <p class="text-white/25 text-xs mt-1.5">Upload beberapa file sekaligus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.getElementById('name')?.addEventListener('input', function() {
    const slugField = document.getElementById('slug');
    if (!slugField.dataset.manual) {
        const slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-').trim();
        slugField.value = slug;
        document.getElementById('slugPreview').textContent = slug || 'slug';
    }
});
document.getElementById('slug')?.addEventListener('input', function() {
    this.dataset.manual = 'true';
    document.getElementById('slugPreview').textContent = this.value || 'slug';
});
</script>
@endpush
