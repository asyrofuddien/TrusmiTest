<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpiMarketingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/soal1', [KpiMarketingController::class, 'soal1'])->name('soal1');
Route::get('/soal2', [KpiMarketingController::class, 'soal2'])->name('soal2');
