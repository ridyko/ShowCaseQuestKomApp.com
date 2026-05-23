@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

    {{-- Form --}}
    <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
        <div class="px-6 py-5 border-b-2 border-stone-900 bg-[#FAF3E0]/30">
            <h2 class="font-display font-black text-stone-900 text-sm uppercase tracking-wider"><i class="fas fa-plus mr-2"></i>Tambah Kategori</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Nama Kategori *</label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="Contoh: Web Application"
                        class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all">
                    @error('name') <p class="text-red-600 text-xs mt-1.5 font-bold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Icon Font Awesome</label>
                    <input type="text" name="icon" value="{{ old('icon', 'fa-globe') }}" placeholder="fa-globe"
                        class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all">
                    <p class="text-stone-500 text-[10px] font-bold mt-2">Contoh: fa-globe, fa-code, fa-mobile-alt</p>
                </div>
                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Warna Tema</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="color" value="{{ old('color', '#6366f1') }}"
                            class="w-12 h-12 rounded-xl border-2 border-stone-900 bg-transparent cursor-pointer p-1 shadow-[2px_2px_0px_0px_rgba(28,25,23,1)]">
                        <span class="text-stone-500 text-xs font-bold">Klik kotak untuk memilih warna</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-black text-stone-700 uppercase tracking-wider mb-2">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi singkat..."
                        class="w-full bg-white border-2 border-stone-900 focus:bg-stone-50 rounded-xl px-4 py-3 text-sm text-stone-900 placeholder-stone-400 font-bold outline-none shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] focus:translate-y-0.5 focus:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)] transition-all resize-none">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#FDE047] border-2 border-stone-900 hover:bg-[#FACC15] text-stone-900 font-black py-3 rounded-xl transition shadow-[3px_3px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[1px_1px_0px_0px_rgba(28,25,23,1)] text-xs uppercase tracking-wider">
                    <i class="fas fa-save"></i> Simpan Kategori
                </button>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="lg:col-span-2 bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
        <div class="px-6 py-5 border-b-2 border-stone-900 bg-[#FAF3E0]/30">
            <h2 class="font-display font-black text-stone-900 text-sm uppercase tracking-wider">Daftar Kategori <span class="text-stone-500 font-bold text-xs ml-1">({{ $categories->count() }})</span></h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-stone-900 bg-stone-50/50">
                        <th class="px-6 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider hidden sm:table-cell">Slug</th>
                        <th class="px-4 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider">Warna</th>
                        <th class="px-4 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider hidden md:table-cell">App</th>
                        <th class="px-4 py-3.5 text-right text-xs font-black text-stone-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-stone-100">
                    @forelse($categories as $cat)
                    <tr class="hover:bg-stone-50/55 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl border-2 border-stone-900 flex items-center justify-center text-xs shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] flex-shrink-0"
                                    style="background:{{ $cat->color }}22;color:{{ $cat->color }}">
                                    <i class="fas {{ $cat->icon }}"></i>
                                </div>
                                <span class="font-black text-sm text-stone-900">{{ $cat->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-stone-400 text-xs font-mono font-bold hidden sm:table-cell">{{ $cat->slug }}</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full border border-stone-900" style="background:{{ $cat->color }}"></div>
                                <span class="text-stone-500 text-xs font-mono font-bold">{{ strtoupper($cat->color) }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-stone-500 text-xs font-black hidden md:table-cell">{{ $cat->applications_count ?? 0 }}</td>
                        <td class="px-4 py-4">
                            <div class="flex justify-end">
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                    onsubmit="return confirm('Hapus kategori {{ addslashes($cat->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-xl border-2 border-stone-900 bg-white hover:bg-[#F87171] text-stone-900 text-xs transition shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)]">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-12 text-stone-400 font-bold text-sm">
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
