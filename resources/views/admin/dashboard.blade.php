@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5 flex items-center gap-4 hover:-translate-y-1 transition">
        <div class="w-12 h-12 bg-brand/10 text-brand rounded-xl flex items-center justify-center text-lg flex-shrink-0">
            <i class="fas fa-th-large"></i>
        </div>
        <div>
            <p class="text-2xl font-black">{{ $stats['total_apps'] }}</p>
            <p class="text-white/40 text-xs uppercase tracking-wide">Total Aplikasi</p>
        </div>
    </div>
    <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5 flex items-center gap-4 hover:-translate-y-1 transition">
        <div class="w-12 h-12 bg-green-500/10 text-green-400 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <p class="text-2xl font-black">{{ $stats['published_apps'] }}</p>
            <p class="text-white/40 text-xs uppercase tracking-wide">Terpublikasi</p>
        </div>
    </div>
    <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5 flex items-center gap-4 hover:-translate-y-1 transition">
        <div class="w-12 h-12 bg-cyan-500/10 text-cyan-400 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
            <i class="fas fa-eye"></i>
        </div>
        <div>
            <p class="text-2xl font-black">{{ number_format($stats['total_views']) }}</p>
            <p class="text-white/40 text-xs uppercase tracking-wide">Total Views</p>
        </div>
    </div>
    <div class="bg-[#161b27] border border-white/7 rounded-2xl p-5 flex items-center gap-4 hover:-translate-y-1 transition">
        <div class="w-12 h-12 bg-yellow-500/10 text-yellow-400 rounded-xl flex items-center justify-center text-lg flex-shrink-0">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <p class="text-2xl font-black">{{ $stats['total_users'] }}</p>
            <p class="text-white/40 text-xs uppercase tracking-wide">Pengguna</p>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
    <div class="lg:col-span-2 bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-white/5 flex items-center gap-2.5">
            <i class="fas fa-chart-area text-brand text-sm"></i>
            <h3 class="font-semibold text-sm">Kunjungan 7 Hari Terakhir</h3>
        </div>
        <div class="p-5"><canvas id="visitChart" height="200"></canvas></div>
    </div>
    <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-white/5 flex items-center gap-2.5">
            <i class="fas fa-mobile-alt text-brand text-sm"></i>
            <h3 class="font-semibold text-sm">Perangkat</h3>
        </div>
        <div class="p-5"><canvas id="deviceChart" height="200"></canvas></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    {{-- Top Apps --}}
    <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-white/5 flex items-center gap-2.5">
            <i class="fas fa-trophy text-yellow-400 text-sm"></i>
            <h3 class="font-semibold text-sm">Aplikasi Terpopuler</h3>
        </div>
        <div class="p-4 space-y-2">
            @forelse($topApps as $i => $app)
            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/3 transition">
                <span class="text-brand font-black text-base w-6 text-center">#{{ $i + 1 }}</span>
                <div class="w-9 h-9 rounded-lg overflow-hidden bg-brand/20 flex items-center justify-center text-sm font-bold flex-shrink-0">
                    @if($app->logo_url)
                        <img src="{{ $app->logo_url }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='{{ substr($app->name,0,1) }}'">
                    @else
                        {{ substr($app->name, 0, 1) }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-sm truncate">{{ $app->name }}</p>
                    <p class="text-white/30 text-xs truncate">{{ $app->slug }}.{{ config('app.domain') }}</p>
                </div>
                <span class="text-white/40 text-xs whitespace-nowrap"><i class="fas fa-eye mr-1"></i>{{ number_format($app->view_count) }}</span>
            </div>
            @empty
            <p class="text-center text-white/30 text-sm py-8">Belum ada data</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Apps --}}
    <div class="bg-[#161b27] border border-white/7 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-white/5 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <i class="fas fa-clock text-brand text-sm"></i>
                <h3 class="font-semibold text-sm">Aplikasi Terbaru</h3>
            </div>
            <a href="{{ route('admin.applications.create') }}" class="flex items-center gap-1.5 bg-brand hover:bg-brand-dark text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div class="p-4 space-y-2">
            @forelse($recentApps as $app)
            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/3 transition">
                <div class="w-9 h-9 rounded-lg overflow-hidden bg-brand/20 flex items-center justify-center text-sm font-bold flex-shrink-0">
                    @if($app->logo_url)
                        <img src="{{ $app->logo_url }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='{{ substr($app->name,0,1) }}'">
                    @else
                        {{ substr($app->name, 0, 1) }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-sm truncate">{{ $app->name }}</p>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $app->status === 'published' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                            {{ ucfirst($app->status) }}
                        </span>
                        <span class="text-white/30 text-xs">{{ $app->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.applications.edit', $app) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 hover:bg-brand text-white/50 hover:text-white text-xs transition">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
            @empty
            <p class="text-center text-white/30 text-sm py-8">Belum ada aplikasi</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const visitData = @json($recentVisits);
new Chart(document.getElementById('visitChart'), {
    type: 'line',
    data: {
        labels: visitData.length ? visitData.map(d => new Date(d.date).toLocaleDateString('id-ID',{weekday:'short',day:'numeric'})) : ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
        datasets: [{ label:'Kunjungan', data: visitData.length ? visitData.map(d=>d.visits) : [0,0,0,0,0,0,0],
            borderColor:'#6366f1', backgroundColor:'rgba(99,102,241,.08)', fill:true, tension:.4, borderWidth:2, pointRadius:4, pointBackgroundColor:'#6366f1' }]
    },
    options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
        scales:{ y:{beginAtZero:true,grid:{color:'rgba(255,255,255,.05)'},ticks:{color:'#64748b'}}, x:{grid:{display:false},ticks:{color:'#64748b'}} } }
});
const dd = @json($deviceStats);
new Chart(document.getElementById('deviceChart'), {
    type:'doughnut',
    data:{ labels:Object.keys(dd).length?Object.keys(dd).map(k=>k.charAt(0).toUpperCase()+k.slice(1)):['Desktop','Mobile','Tablet'],
        datasets:[{data:Object.values(dd).length?Object.values(dd):[0,0,0], backgroundColor:['#6366f1','#06b6d4','#f59e0b'], borderWidth:0}] },
    options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'bottom',labels:{color:'#64748b',padding:14,font:{size:12}}}}, cutout:'65%' }
});
</script>
@endpush
