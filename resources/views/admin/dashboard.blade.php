@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white border-2 border-stone-900 rounded-2xl p-5 flex items-center gap-4 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] transition-all">
        <div class="w-12 h-12 bg-[#FDE047] border-2 border-stone-900 text-stone-900 rounded-xl flex items-center justify-center text-sm shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] flex-shrink-0">
            <i class="fas fa-th-large"></i>
        </div>
        <div>
            <p class="text-2xl font-display font-black text-stone-900">{{ $stats['total_apps'] }}</p>
            <p class="text-stone-500 text-[10px] font-black uppercase tracking-wider">Total Aplikasi</p>
        </div>
    </div>
    <div class="bg-white border-2 border-stone-900 rounded-2xl p-5 flex items-center gap-4 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] transition-all">
        <div class="w-12 h-12 bg-[#86EFAC] border-2 border-stone-900 text-stone-900 rounded-xl flex items-center justify-center text-sm shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] flex-shrink-0">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <p class="text-2xl font-display font-black text-stone-900">{{ $stats['published_apps'] }}</p>
            <p class="text-stone-500 text-[10px] font-black uppercase tracking-wider">Terpublikasi</p>
        </div>
    </div>
    <div class="bg-white border-2 border-stone-900 rounded-2xl p-5 flex items-center gap-4 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] transition-all">
        <div class="w-12 h-12 bg-[#93C5FD] border-2 border-stone-900 text-stone-900 rounded-xl flex items-center justify-center text-sm shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] flex-shrink-0">
            <i class="fas fa-eye"></i>
        </div>
        <div>
            <p class="text-2xl font-display font-black text-stone-900">{{ number_format($stats['total_views']) }}</p>
            <p class="text-stone-500 text-[10px] font-black uppercase tracking-wider">Total Views</p>
        </div>
    </div>
    <div class="bg-white border-2 border-stone-900 rounded-2xl p-5 flex items-center gap-4 shadow-[4px_4px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] transition-all">
        <div class="w-12 h-12 bg-[#FDBA74] border-2 border-stone-900 text-stone-900 rounded-xl flex items-center justify-center text-sm shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] flex-shrink-0">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <p class="text-2xl font-display font-black text-stone-900">{{ $stats['total_users'] }}</p>
            <p class="text-stone-500 text-[10px] font-black uppercase tracking-wider">Pengguna</p>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="lg:col-span-2 bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
        <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
            <i class="fas fa-chart-area text-stone-800 text-sm"></i>
            <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider">Kunjungan 7 Hari Terakhir</h3>
        </div>
        <div class="p-5"><canvas id="visitChart" height="200"></canvas></div>
    </div>
    <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
        <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
            <i class="fas fa-mobile-alt text-stone-800 text-sm"></i>
            <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider">Perangkat</h3>
        </div>
        <div class="p-5 flex items-center justify-center"><canvas id="deviceChart" height="200"></canvas></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Top Apps --}}
    <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
        <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center gap-2.5">
            <i class="fas fa-trophy text-amber-500 text-sm"></i>
            <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider">Aplikasi Terpopuler</h3>
        </div>
        <div class="p-4 space-y-2">
            @forelse($topApps as $i => $app)
            <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-stone-50 transition border border-transparent hover:border-stone-900/10">
                <span class="text-stone-900 font-display font-black text-base w-6 text-center">#{{ $i + 1 }}</span>
                <div class="w-9 h-9 rounded-xl overflow-hidden border-2 border-stone-900 bg-[#FAF3E0] flex items-center justify-center text-xs font-black shadow-[1px_1px_0px_0px_rgba(28,25,23,1)] flex-shrink-0"
                     style="color:{{ $app->category?->color ?? '#1c1917' }}">
                    @if($app->logo_url)
                        <img src="{{ $app->logo_url }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='{{ substr($app->name,0,1) }}'">
                    @else
                        {{ substr($app->name, 0, 1) }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-black text-sm text-stone-900 truncate">{{ $app->name }}</p>
                    <p class="text-stone-500 text-xs truncate">{{ $app->slug }}.{{ config('app.domain') }}</p>
                </div>
                <span class="text-stone-500 text-xs font-bold whitespace-nowrap"><i class="fas fa-eye mr-1.5"></i>{{ number_format($app->view_count) }}</span>
            </div>
            @empty
            <p class="text-center text-stone-400 text-sm py-8 font-bold">Belum ada data</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Apps --}}
    <div class="bg-white border-2 border-stone-900 rounded-3xl overflow-hidden shadow-[4px_4px_0px_0px_rgba(28,25,23,1)]">
        <div class="px-5 py-4 border-b-2 border-stone-900 bg-[#FAF3E0]/30 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <i class="fas fa-clock text-stone-855 text-sm"></i>
                <h3 class="font-display font-black text-stone-900 text-xs uppercase tracking-wider">Aplikasi Terbaru</h3>
            </div>
            <a href="{{ route('admin.applications.create') }}" class="flex items-center gap-1.5 bg-[#86EFAC] border-2 border-stone-900 hover:bg-[#4ADE80] text-stone-900 text-xs font-black px-3.5 py-1.5 rounded-xl transition shadow-[2px_2px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)]">
                <i class="fas fa-plus text-[9px]"></i> Tambah
            </a>
        </div>
        <div class="p-4 space-y-2">
            @forelse($recentApps as $app)
            <div class="flex items-center gap-3 p-3 rounded-2xl hover:bg-stone-50 transition border border-transparent hover:border-stone-900/10">
                <div class="w-9 h-9 rounded-xl overflow-hidden border-2 border-stone-900 bg-[#FAF3E0] flex items-center justify-center text-xs font-black shadow-[1px_1px_0px_0px_rgba(28,25,23,1)] flex-shrink-0"
                     style="color:{{ $app->category?->color ?? '#1c1917' }}">
                    @if($app->logo_url)
                        <img src="{{ $app->logo_url }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='{{ substr($app->name,0,1) }}'">
                    @else
                        {{ substr($app->name, 0, 1) }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-black text-sm text-stone-900 truncate">{{ $app->name }}</p>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="text-[9px] font-black uppercase px-2.5 py-0.5 rounded-full border border-stone-900"
                              style="background: {{ $app->status === 'published' ? '#86EFAC' : '#FDE047' }}">
                            {{ ucfirst($app->status) }}
                        </span>
                        <span class="text-stone-400 text-[10px] font-bold">{{ $app->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <a href="{{ route('admin.applications.edit', $app) }}" class="w-8 h-8 flex items-center justify-center rounded-xl border-2 border-stone-900 bg-white hover:bg-[#FDE047] text-stone-900 text-xs transition shadow-[1.5px_1.5px_0px_0px_rgba(28,25,23,1)] hover:translate-y-0.5 hover:shadow-[0px_0px_0px_0px_rgba(28,25,23,1)]">
                    <i class="fas fa-edit"></i>
                </a>
            </div>
            @empty
            <p class="text-center text-stone-400 text-sm py-8 font-bold">Belum ada aplikasi</p>
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
            borderColor:'#1C1917', backgroundColor:'rgba(253,224,71,.15)', fill:true, tension:.3, borderWidth:3, pointRadius:5, pointBackgroundColor:'#1C1917', pointBorderColor:'#1C1917' }]
    },
    options: { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
        scales:{ y:{beginAtZero:true,grid:{color:'#e7e5e4'},ticks:{color:'#44403c',font:{family:'Plus Jakarta Sans',weight:'bold'}}}, x:{grid:{display:false},ticks:{color:'#44403c',font:{family:'Plus Jakarta Sans',weight:'bold'}}} } }
});
const dd = @json($deviceStats);
new Chart(document.getElementById('deviceChart'), {
    type:'doughnut',
    data:{ labels:Object.keys(dd).length?Object.keys(dd).map(k=>k.charAt(0).toUpperCase()+k.slice(1)):['Desktop','Mobile','Tablet'],
        datasets:[{data:Object.values(dd).length?Object.values(dd):[0,0,0], backgroundColor:['#FDE047','#86EFAC','#FDBA74'], borderColor:'#1C1917', borderWidth:2}] },
    options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'bottom',labels:{color:'#1C1917',padding:14,font:{family:'Plus Jakarta Sans',size:12,weight:'bold'}}}}, cutout:'65%' }
});
</script>
@endpush
