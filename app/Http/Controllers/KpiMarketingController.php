<?php

namespace App\Http\Controllers;

use App\Models\KpiMarketing;

class KpiMarketingController extends Controller
{
    public function index()
    {
        $kpis = KpiMarketing::all();
        return view('kpiMarketing.index', compact('kpis'));
    }
}
