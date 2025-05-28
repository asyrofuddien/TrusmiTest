@extends('layouts.app')
@section('title', 'Rekap KPI Marketing')

@section('content')
<h1 class="mb-4" style="text-align:center; color:#ac1754;">KPI Marketing</h1>

<table class="table table-bordered table-striped">
    @include('Soal2.table-header')

    <tbody>
        @foreach ($kpis as $tasklist)
        @include('Soal2.table-row')
        @endforeach
    </tbody>
</table>
@endsection