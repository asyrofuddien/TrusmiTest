<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpiMarketingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kpi-marketing', [KpiMarketingController::class, 'apiIndex']);
