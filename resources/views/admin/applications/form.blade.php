@extends('layouts.admin')
@section('title', isset($application) ? 'Edit: ' . $application->name : 'Tambah Aplikasi')
@section('page-title', isset($application) ? 'Edit Aplikasi' : 'Tambah Aplikasi Baru')

@section('content')
<form action="{{ isset($application) ? route('admin.applications.update', $application) : route('admin.applications.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($application)) @method('PUT') @endif

    @if($errors->any())
    <div class="flex items-start gap-3 bg-red-100 border-2 border-stone-900 text-red-900 px-5 py-4 rounded-2xl mb-6 text-sm shadow-[3px_3px_0px_rgba(28,25,23,1)] font-bold">
        <i class="fas fa-exclamation-circle mt-0.5 text-red-600 text-lg"></i>
        <div>
            <p class="font-black text-stone-900 mb-1">Terdapat kesalahan:</p>
            <ul class="list-disc list-inside space-y-0.5 text-stone-700">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri: Informasi Utama --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_rgba(28,25,23,1)]">
                <div class="px-6 py-5 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
                    <i class="fas fa-info-circle text-stone-900 text-sm"></i>
                    <h3 class="font-display font-black text-sm uppercase tracking-wider text-stone-900">Informasi Utama</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Nama Aplikasi *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $application->name ?? '') }}"
                            required placeholder="Nama aplikasi Anda" 
                            class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Slug (Subdomain) *</label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $application->slug ?? '') }}"
                                    required placeholder="nama-app" 
                                    class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all flex-1">
                                <span class="text-stone-500 font-bold text-xs whitespace-nowrap">.{{ config('app.domain') }}</span>
                            </div>
                            <p class="text-stone-500 text-[10px] font-bold mt-2">URL: <span id="slugPreview" class="text-stone-900 underline">{{ $application->slug ?? 'slug' }}</span>.{{ config('app.domain') }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Versi</label>
                            <input type="text" name="version" value="{{ old('version', $application->version ?? '1.0.0') }}"
                                placeholder="1.0.0" 
                                class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $application->tagline ?? '') }}"
                            placeholder="Satu kalimat tentang aplikasi Anda" 
                            class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" placeholder="Deskripsikan aplikasi Anda..." 
                            class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all resize-none">{{ old('description', $application->description ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Konten / Dokumentasi</label>
                        <textarea name="content" rows="8" placeholder="Dokumentasi lengkap..." 
                            class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all resize-none">{{ old('content', $application->content ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Links & Tech --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_rgba(28,25,23,1)]">
                    <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
                        <i class="fas fa-link text-stone-900 text-sm"></i>
                        <h3 class="font-display font-black text-sm uppercase tracking-wider text-stone-900">Tautan</h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Demo URL</label>
                            <input type="url" name="demo_url" value="{{ old('demo_url', $application->demo_url ?? '') }}" placeholder="https://..." 
                                class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Source Code URL</label>
                            <input type="url" name="source_url" value="{{ old('source_url', $application->source_url ?? '') }}" placeholder="https://github.com/..." 
                                class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Dokumentasi URL</label>
                            <input type="url" name="documentation_url" value="{{ old('documentation_url', $application->documentation_url ?? '') }}" placeholder="https://..." 
                                class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                        </div>
                    </div>
                </div>
                <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_rgba(28,25,23,1)]">
                    <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
                        <i class="fas fa-layer-group text-stone-900 text-sm"></i>
                        <h3 class="font-display font-black text-sm uppercase tracking-wider text-stone-900">Teknis</h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Tech Stack</label>
                            <input type="text" name="tech_stack"
                                value="{{ old('tech_stack', isset($application) && $application->tech_stack ? implode(', ', $application->tech_stack) : '') }}"
                                placeholder="Laravel, PHP, MySQL, ..." 
                                class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                            <p class="text-stone-500 font-bold text-[10px] mt-1.5">Pisahkan dengan koma</p>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Fitur Utama</label>
                            <input type="text" name="features"
                                value="{{ old('features', isset($application) && $application->features ? implode(', ', $application->features) : '') }}"
                                placeholder="Login, Dashboard, Report, ..." 
                                class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all">
                            <p class="text-stone-500 font-bold text-[10px] mt-1.5">Pisahkan dengan koma</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Sidebar --}}
        <div class="space-y-8">
            {{-- Pengaturan --}}
            <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_rgba(28,25,23,1)]">
                <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
                    <i class="fas fa-cog text-stone-900 text-sm"></i>
                    <h3 class="font-display font-black text-sm uppercase tracking-wider text-stone-900">Pengaturan</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Kategori</label>
                        <select name="category_id" class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all cursor-pointer">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $application->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Status *</label>
                        <select name="status" required class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 font-bold outline-none shadow-[2px_2px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_rgba(28,25,23,1)] transition-all cursor-pointer">
                            <option value="draft" {{ old('status', $application->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $application->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $application->status ?? '') === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    <div class="py-2">
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured', $application->is_featured ?? false) ? 'checked' : '' }}
                                class="w-5 h-5 border-2 border-stone-900 rounded bg-white text-stone-900 checked:bg-[#FDE047] accent-[#FDE047] cursor-pointer">
                            <span class="text-sm font-black text-stone-700">Tandai sebagai unggulan</span>
                        </label>
                    </div>
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#FDE047] border-2 border-stone-900 hover:bg-[#FACC15] text-stone-900 font-black py-3 rounded-xl transition shadow-[3px_3px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[1px_1px_0px_rgba(28,25,23,1)] text-xs uppercase tracking-wider">
                        <i class="fas fa-save"></i>
                        {{ isset($application) ? 'Simpan Perubahan' : 'Simpan Aplikasi' }}
                    </button>
                    <a href="{{ route('admin.applications.index') }}" class="w-full flex items-center justify-center gap-2 bg-white border-2 border-stone-900 hover:bg-stone-50 text-stone-900 font-black py-2.5 rounded-xl transition shadow-[2px_2px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_rgba(28,25,23,1)] text-xs uppercase tracking-wider">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            {{-- Media --}}
            <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_rgba(28,25,23,1)]">
                <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
                    <i class="fas fa-image text-stone-900 text-sm"></i>
                    <h3 class="font-display font-black text-sm uppercase tracking-wider text-stone-900">Media</h3>
                </div>
                <div class="p-5 space-y-5">
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Logo Aplikasi</label>
                        @if(isset($application) && $application->logo)
                        <img src="{{ asset('storage/' . $application->logo) }}" class="w-16 h-16 rounded-xl border-2 border-stone-900 object-cover mb-3 shadow-[1.5px_1.5px_0px_rgba(28,25,23,1)]" alt="Logo">
                        @endif
                        <input type="file" name="logo" accept="image/*"
                            class="w-full text-xs font-black text-stone-800 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-2 file:border-stone-900 file:bg-[#FDE047] file:text-stone-900 file:text-xs file:font-black file:cursor-pointer hover:file:bg-[#FACC15] file:shadow-[1.5px_1.5px_0px_rgba(28,25,23,1)]">
                        <p class="text-stone-500 font-bold text-[10px] mt-2">Maks 2MB, format: JPG, PNG, SVG</p>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Cover Image</label>
                        @if(isset($application) && $application->cover_image)
                        <img src="{{ asset('storage/' . $application->cover_image) }}" class="w-full h-24 rounded-xl border-2 border-stone-900 object-cover mb-3 shadow-[2px_2px_0px_rgba(28,25,23,1)]" alt="Cover">
                        @endif
                        <input type="file" name="cover_image" accept="image/*"
                            class="w-full text-xs font-black text-stone-800 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-2 file:border-stone-900 file:bg-[#FDE047] file:text-stone-900 file:text-xs file:font-black file:cursor-pointer hover:file:bg-[#FACC15] file:shadow-[1.5px_1.5px_0px_rgba(28,25,23,1)]">
                        <p class="text-stone-500 font-bold text-[10px] mt-2">Maks 5MB</p>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Screenshots</label>
                        @if(isset($application) && $application->screenshots->count())
                        <div class="grid grid-cols-3 gap-2 mb-3">
                            @foreach($application->screenshots as $ss)
                            <div class="relative group">
                                <img src="{{ $ss->image_url }}" class="w-full h-16 object-cover rounded-lg border border-stone-900 shadow-[1px_1px_0px_rgba(28,25,23,1)]" alt="">
                                <button type="button" onclick="deleteScreenshot(event, '{{ route('admin.screenshots.destroy', $ss->id) }}')" class="absolute top-1 right-1 w-5 h-5 bg-[#EF4444] border border-stone-900 rounded-full flex items-center justify-center text-white text-xs opacity-0 group-hover:opacity-100 transition shadow-[1px_1px_0px_rgba(28,25,23,1)]">
                                    <i class="fas fa-times" style="font-size:.5rem;"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <input type="file" name="screenshots[]" accept="image/*" multiple
                            class="w-full text-xs font-black text-stone-800 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-2 file:border-stone-900 file:bg-[#FDE047] file:text-stone-900 file:text-xs file:font-black file:cursor-pointer hover:file:bg-[#FACC15] file:shadow-[1.5px_1.5px_0px_rgba(28,25,23,1)]">
                        <p class="text-stone-500 font-bold text-[10px] mt-2">Upload beberapa file sekaligus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="deleteScreenshotForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
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

function deleteScreenshot(event, actionUrl) {
    event.preventDefault();
    if (confirm('Apakah Anda yakin ingin menghapus screenshot ini?')) {
        const form = document.getElementById('deleteScreenshotForm');
        form.action = actionUrl;
        form.submit();
    }
}
</script>
@endpush
