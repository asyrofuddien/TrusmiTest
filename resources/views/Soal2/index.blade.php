@extends('layouts.app')
@section('title', 'Rekap KPI Marketing')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="mb-8 text-center text-3xl font-bold text-[#ac1754]">KPI Marketing</h1>

    {{-- Ringkasan Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-sm text-gray-500">Total Task</div>
            <div class="text-xl font-bold text-gray-800">{{ $kpis->total_tasklist ?? 0 }}</div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg shadow text-center">
            <div class="text-sm text-green-600">Ontime</div>
            <div class="text-xl font-bold text-green-700">{{ $kpis->ontime ?? 0 }}</div>
        </div>
        <div class="bg-red-50 p-4 rounded-lg shadow text-center">
            <div class="text-sm text-red-600">Late</div>
            <div class="text-xl font-bold text-red-700">{{ $kpis->late ?? 0 }}</div>
        </div>
        <div class="bg-blue-50 p-4 rounded-lg shadow text-center">
            <div class="text-sm text-blue-600">Ontime (%)</div>
            <div class="text-xl font-bold text-blue-700">{{ $kpis->persen_ontime ?? 0 }}%</div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="w-full max-w-md mx-auto aspect-square bg-white rounded-2xl shadow-md p-4">
        <canvas id="taskChart" class="w-full h-full"></canvas>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('taskChart').getContext('2d');
    const taskChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Task KPI',
                data: @json($chartData['values']),
                backgroundColor: ['#10B981', '#EF4444'],
                borderColor: ['#059669', '#DC2626'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const total = context.chart._metasets[0].total;
                            const percent = ((value / total) * 100).toFixed(2);
                            return `${label}: ${value} (${percent}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection