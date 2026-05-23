@extends('layouts.admin')
@section('title', 'Kelola Aplikasi')
@section('page-title', 'Kelola Aplikasi')

@section('content')
<div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
    <div class="px-6 py-5 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center justify-between">
        <div>
            <h2 class="font-display font-black text-stone-900 text-sm uppercase tracking-wider">Daftar Aplikasi</h2>
            <p class="text-stone-500 text-xs font-bold mt-0.5">Total {{ $applications->total() }} aplikasi</p>
        </div>
        <a href="{{ route('admin.applications.create') }}" class="flex items-center gap-1.5 bg-[#86EFAC] border-2 border-stone-900 hover:bg-[#4ADE80] text-stone-900 text-xs font-black px-5 py-2.5 rounded-xl transition shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)]">
            <i class="fas fa-plus text-[10px]"></i> Tambah Aplikasi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b-2 border-stone-900 bg-stone-50/50">
                    <th class="px-6 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider">Aplikasi</th>
                    <th class="px-4 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider hidden md:table-cell">Subdomain</th>
                    <th class="px-4 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider hidden lg:table-cell">Kategori</th>
                    <th class="px-4 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3.5 text-left text-xs font-black text-stone-700 uppercase tracking-wider hidden sm:table-cell">Views</th>
                    <th class="px-4 py-3.5 text-right text-xs font-black text-stone-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-stone-100">
                @forelse($applications as $app)
                <tr class="hover:bg-stone-50/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-stone-900 bg-[#FAF3E0] flex items-center justify-center font-black text-sm shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] flex-shrink-0"
                                 style="color:{{ $app->category?->color ?? '#1c1917' }}">
                                @if($app->logo_url)
                                    <img src="{{ $app->logo_url }}" class="w-full h-full object-cover" alt="{{ $app->name }}"
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                    <span style="display:none">{{ substr($app->name,0,1) }}</span>
                                @else
                                    {{ substr($app->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="font-black text-sm text-stone-900">{{ $app->name }}</p>
                                <p class="text-stone-400 text-xs font-bold">v{{ $app->version }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 hidden md:table-cell">
                        <a href="{{ $app->subdomain_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-stone-900 hover:text-stone-700 text-xs font-black transition underline decoration-2">
                            {{ $app->slug }}.{{ config('app.domain') }}
                            <i class="fas fa-external-link-alt text-[9px]"></i>
                        </a>
                    </td>
                    <td class="px-4 py-4 text-stone-600 text-xs font-bold hidden lg:table-cell">
                        @if($app->category)
                        <span class="px-2.5 py-1 rounded-full border border-stone-900/10" style="background: {{ $app->category->color }}12; color: {{ $app->category->color }}">
                            {{ $app->category->name }}
                        </span>
                        @else
                        —
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <span class="text-[9px] font-black uppercase px-2.5 py-1 rounded-full border border-stone-900"
                              style="background: {{ $app->status === 'published' ? '#86EFAC' : '#FDE047' }}">
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-stone-500 text-xs font-bold hidden sm:table-cell">{{ number_format($app->view_count) }}</td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.applications.edit', $app) }}"
                                class="w-8 h-8 flex items-center justify-center rounded-xl border-2 border-stone-900 bg-white hover:bg-[#FDE047] text-stone-900 text-xs transition shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)]">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.applications.destroy', $app) }}" method="POST"
                                onsubmit="return confirm('Hapus aplikasi {{ addslashes($app->name) }}?')">
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
                    <td colspan="6" class="text-center py-16 text-stone-400 font-bold">
                        <i class="fas fa-box-open text-4xl opacity-20 block mb-3 text-stone-900"></i>
                        Belum ada aplikasi.
                        <a href="{{ route('admin.applications.create') }}" class="text-stone-900 hover:underline ml-1">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($applications->hasPages())
    <div class="px-6 py-4 border-t-2 border-stone-900 bg-stone-50/30">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
