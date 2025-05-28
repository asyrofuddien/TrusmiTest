<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KpiMarketing;

class KpiMarketingController extends Controller
{
    public function apiIndex()
    {
        return response()->json(KpiMarketing::all());
    }
}
