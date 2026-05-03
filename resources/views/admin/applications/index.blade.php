@extends('layouts.admin')
@section('title', 'Kelola Aplikasi')
@section('page-title', 'Kelola Aplikasi')

@section('content')
<div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
    <div class="px-6 py-4 border-b border-white/5 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-base">Daftar Aplikasi</h2>
            <p class="text-white/30 text-xs mt-0.5">Total {{ $applications->total() }} aplikasi</p>
        </div>
        <a href="{{ route('admin.applications.create') }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-lg shadow-brand/20">
            <i class="fas fa-plus"></i> Tambah Aplikasi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest">Aplikasi</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest hidden md:table-cell">Subdomain</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest hidden lg:table-cell">Kategori</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest">Status</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-white/30 uppercase tracking-widest hidden sm:table-cell">Views</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-white/30 uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($applications as $app)
                <tr class="hover:bg-white/2 transition group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-brand/15 flex items-center justify-center font-bold text-sm">
                                @if($app->logo_url)
                                    <img src="{{ $app->logo_url }}" class="w-full h-full object-cover" alt="{{ $app->name }}"
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                    <span style="display:none">{{ substr($app->name,0,1) }}</span>
                                @else
                                    {{ substr($app->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-sm">{{ $app->name }}</p>
                                <p class="text-white/30 text-xs">v{{ $app->version }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 hidden md:table-cell">
                        <a href="{{ $app->subdomain_url }}" target="_blank" class="flex items-center gap-1.5 text-brand hover:text-brand-light text-xs transition">
                            {{ $app->slug }}.{{ config('app.domain') }}
                            <i class="fas fa-external-link-alt text-xs opacity-60"></i>
                        </a>
                    </td>
                    <td class="px-4 py-4 text-white/40 text-sm hidden lg:table-cell">{{ $app->category->name ?? '—' }}</td>
                    <td class="px-4 py-4">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $app->status === 'published' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-white/40 text-sm hidden sm:table-cell">{{ number_format($app->view_count) }}</td>
                    <td class="px-4 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.applications.edit', $app) }}"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-brand/10 hover:bg-brand text-brand hover:text-white text-xs transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.applications.destroy', $app) }}" method="POST"
                                onsubmit="return confirm('Hapus aplikasi {{ addslashes($app->name) }}?')">
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
                    <td colspan="6" class="text-center py-16 text-white/30">
                        <i class="fas fa-box-open text-4xl opacity-20 block mb-3"></i>
                        Belum ada aplikasi.
                        <a href="{{ route('admin.applications.create') }}" class="text-brand hover:underline ml-1">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($applications->hasPages())
    <div class="px-6 py-4 border-t border-white/5">{{ $applications->links() }}</div>
    @endif
</div>
@endsection
