<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Rekap KPI Marketing')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container flex">
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main content --}}
        <div class="flex-1 p-4 sm:ml-64">
            @yield('content')
        </div>
    </div>
</body>

</html>