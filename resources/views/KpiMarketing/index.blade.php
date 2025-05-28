@extends('layouts.app')

@section('title', 'Rekap KPI Marketing')

@section('content')
<h1 class="mb-4 text-center text-[#ac1754] text-2xl font-bold">KPI Marketing</h1>

<table class="table table-bordered table-striped w-full">
    @include('KpiMarketing.table-header')

    <tbody>
        @foreach ($soal1 as $kpi)
        @include('KpiMarketing.table-row', ['kpi' => $kpi])
        @endforeach
    </tbody>
</table>
@endsection