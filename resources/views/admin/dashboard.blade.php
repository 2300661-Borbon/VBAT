@extends('admin-app')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header Section --}}
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-black">Dashboard Overview</h1>
        <p class="text-gray-500">Welcome to VBAT Admin. Monitor platform performance and user engagement.</p>
    </header>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-bold text-black mb-6">Total Users</h3>
                    <p class="text-4xl font-bold tracking-tight text-black">6</p>
                </div>
                <span class="text-gray-400"><i class="fas fa-users text-xl"></i></span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-sm font-bold text-black mb-6">Active Users</h3>
                    <p class="text-4xl font-bold tracking-tight text-black">4</p>
                </div>
                <span class="text-gray-400"><i class="fas fa-book-open text-xl"></i></span>
            </div>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Chart Section --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <div class="mb-6">
                <h3 class="font-bold text-black text-lg">Weekly Activity</h3>
                <p class="text-xs text-gray-500">Student engagement and VR session trends</p>
            </div>
            <div class="h-80 w-full">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        {{-- Top Rated Scenes Section --}}
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="font-bold text-black text-lg mb-1">Top Viewed VR Scenes</h3>
            <p class="text-xs text-gray-500 mb-6">Most visited historical experiences this month</p>
            
            <div class="space-y-6">
                @php
                    $scenes = [
                        ['name' => 'The Battle of Batangas (1896)', 'visits' => '10',  'status' => 'active'],
                        ['name' => 'Japanede Atrocities (1945)', 'visits' => '10',  'status' => 'active'],
                        ['name' => 'The Sublian (1988)', 'visits' => '10',  'status' => 'active'],
                    ];
                @endphp

                @foreach($scenes as $index => $scene)
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 flex items-center justify-center bg-gray-900 border border-gray-700 text-white text-xs font-bold rounded-full">
                                {{ $index + 1 }}
                            </span>
                            <div>
                                <p class="text-xs font-bold text-black">{{ $scene['name'] }}</p>
                                <p class="text-[10px] text-gray-500">{{ $scene['visits'] }} visits</p>
                            </div>
                        </div>
                        <span class="{{ $scene['status'] === 'active' ? 'bg-green-100 text-green-700 px-2 py-0.5 rounded text-[10px] font-bold' : 'bg-gray-100 text-gray-500 px-2 py-0.5 rounded text-[10px]' }}">
                            {{ ucfirst($scene['status']) }}
                        </span>
                    </div>
                    <div class="bg-gray-100 rounded-full h-1.5 w-full">
                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $scene['visits'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    
    const greenGradient = ctx.createLinearGradient(0, 0, 0, 400);
    greenGradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
    greenGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

    const orangeGradient = ctx.createLinearGradient(0, 0, 0, 400);
    orangeGradient.addColorStop(0, 'rgba(245, 158, 11, 0.3)');
    orangeGradient.addColorStop(1, 'rgba(245, 158, 11, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Sessions',
                data: [180, 300, 220, 280, 420, 240, 220],
                borderColor: '#10b981',
                backgroundColor: greenGradient,
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }, {
                label: 'Engagement',
                data: [100, 200, 120, 210, 310, 150, 120],
                borderColor: '#f59e0b',
                backgroundColor: orangeGradient,
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    ticks: { color: '#6b7280', stepSize: 150 }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#6b7280' }
                }
            }
        }
    });
</script>
@endsection