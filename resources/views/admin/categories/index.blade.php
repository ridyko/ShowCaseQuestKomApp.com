@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

    {{-- Form --}}
    <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/5">
            <h2 class="font-bold text-base"><i class="fas fa-plus text-brand mr-2"></i>Tambah Kategori</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Nama Kategori *</label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="Contoh: Web Application"
                        class="w-full bg-white/4 border {{ $errors->has('name') ? 'border-red-500/50' : 'border-white/10' }} focus:border-brand rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 outline-none transition">
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Icon Font Awesome</label>
                    <input type="text" name="icon" value="{{ old('icon', 'fa-globe') }}" placeholder="fa-globe"
                        class="w-full bg-white/4 border border-white/10 focus:border-brand rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 outline-none transition">
                    <p class="text-white/25 text-xs mt-1.5">Contoh: fa-globe, fa-code, fa-mobile-alt</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Warna Tema</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="color" value="{{ old('color', '#6366f1') }}"
                            class="w-12 h-12 rounded-xl border border-white/10 bg-transparent cursor-pointer p-1">
                        <span class="text-white/30 text-sm">Klik kotak untuk memilih warna</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-white/40 uppercase tracking-widest mb-2">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi singkat..."
                        class="w-full bg-white/4 border border-white/10 focus:border-brand rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 outline-none transition resize-none">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-brand hover:bg-brand-dark text-white font-semibold py-3 rounded-xl transition text-sm">
                    <i class="fas fa-save"></i> Simpan Kategori
                </button>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="lg:col-span-2 bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/5">
            <h2 class="font-bold text-base">Daftar Kategori <span class="text-white/30 font-normal text-sm">({{ $categories->count() }})</span></h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest">Kategori</th>
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest hidden sm:table-cell">Slug</th>
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest">Warna</th>
                        <th class="px-4 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest hidden md:table-cell">App</th>
                        <th class="px-4 py-3.5 text-right text-xs font-semibold text-white/30 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($categories as $cat)
                    <tr class="hover:bg-white/2 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center text-sm flex-shrink-0"
                                    style="background:{{ $cat->color }}22;color:{{ $cat->color }}">
                                    <i class="fas {{ $cat->icon }}"></i>
                                </div>
                                <span class="font-semibold text-sm">{{ $cat->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-white/30 text-xs font-mono hidden sm:table-cell">{{ $cat->slug }}</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background:{{ $cat->color }}"></div>
                                <span class="text-white/30 text-xs font-mono">{{ strtoupper($cat->color) }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-white/40 text-sm hidden md:table-cell">{{ $cat->applications_count ?? 0 }}</td>
                        <td class="px-4 py-4">
                            <div class="flex justify-end">
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                    onsubmit="return confirm('Hapus kategori {{ addslashes($cat->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white text-xs transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-12 text-white/30 text-sm">
                            Belum ada kategori. Tambahkan di form sebelah kiri.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
