@extends('layouts.app')
@section('title', 'Rekap KPI Marketing')

@section('content')
<h2 class="text-xl font-semibold mb-4 text-center">Grafik KPI Marketing</h2>

<table class="table table-bordered table-striped">
    @include('Soal1.table-header')

    <tbody>
        @foreach ($kpis as $kpi)
        @include('Soal1.table-row')
        @endforeach
    </tbody>
</table>

<div class="w-full max-w-4xl mx-auto px-4">
    <h2 class="text-xl font-semibold mb-4 text-center">Grafik KPI Marketing</h2>

    <div class="relative w-full aspect-[3/2]">
        <canvas id="kpiChart" class="w-full h-full"></canvas>
    </div>
</div>
<script>
    const ctx = document.getElementById('kpiChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                    label: 'Total Bobot Sales',
                    data: @json($chartData['sales']),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Total Bobot Report',
                    data: @json($chartData['report']),
                    backgroundColor: 'rgba(255, 206, 86, 0.7)'
                },
                {
                    label: 'Total KPI',
                    data: @json($chartData['total']),
                    backgroundColor: 'rgba(75, 192, 192, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Persentase'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nama Karyawan'
                    }
                }
            },
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false
                },
                title: {
                    display: true,
                    text: 'KPI Sales dan Report per Karyawan'
                }
            }
        }
    });
</script>
@endsection