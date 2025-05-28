<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KpiMarketingController extends Controller
{
    public function soal1()
    {
        $data = DB::select("
            -- Variabel tetap
            WITH RECURSIVE vars AS (
                SELECT
                    2 AS targetKPI,
                    50 AS BobotKPI,
                    7 AS lateSales,
                    5 AS lateReport
            ),

            KPI_Count AS (
                SELECT
                    karyawan AS Nama,
                    SUM(CASE WHEN kpi = 'Sales' THEN 1 ELSE 0 END) AS Sales_Actual,
                    SUM(CASE WHEN kpi = 'Report' THEN 1 ELSE 0 END) AS Report_Actual
                FROM table_kpi_marketing
                GROUP BY karyawan
            ),

            Sales_KPI AS (
                SELECT
                    kc.Nama,
                    kc.Sales_Actual,
                    v.targetKPI AS Sales_Target,
                    ROUND(kc.Sales_Actual / NULLIF(v.targetKPI, 0)*100) AS Sales_Pencapaian,
                    v.BobotKPI AS Bobot_Sales,
                    ROUND(GREATEST(v.targetKPI - kc.Sales_Actual, 0) * v.lateSales) AS Late_Sales,
                    ROUND((v.BobotKPI * ROUND(kc.Sales_Actual / NULLIF(v.targetKPI, 0), 2)) -
                          (GREATEST(v.targetKPI - kc.Sales_Actual, 0) * v.lateSales)) AS Total_Bobot_Sales
                FROM KPI_Count kc
                CROSS JOIN vars v
            ),

            Report_KPI AS (
                SELECT
                    kc.Nama,
                    kc.Report_Actual,
                    v.targetKPI AS Report_Target,
                    ROUND(kc.Report_Actual / NULLIF(v.targetKPI, 0)*100) AS Report_Pencapaian,
                    v.BobotKPI AS Bobot_Report,
                    ROUND(GREATEST(v.targetKPI - kc.Report_Actual, 0) * v.lateReport) AS Late_Report,
                    ROUND((v.BobotKPI * ROUND(kc.Report_Actual / NULLIF(v.targetKPI, 0), 2)) -
                          (GREATEST(v.targetKPI - kc.Report_Actual, 0) * v.lateReport)) AS Total_Bobot_Report
                FROM KPI_Count kc
                CROSS JOIN vars v
            )

            -- Gabungkan hasil Sales & Report berdasarkan nama
            SELECT
            s.Nama,
            s.Sales_Target,
            s.Sales_Actual,
            s.Sales_Pencapaian,
            s.Bobot_Sales,
            s.Late_Sales,
            s.Total_Bobot_Sales,
            r.Report_Target,
            r.Report_Actual,
            r.Report_Pencapaian,
            r.Bobot_Report,
            r.Late_Report,
            r.Total_Bobot_Report,
            (s.Total_Bobot_Sales + r.Total_Bobot_Report) AS Total_KPI
        FROM Sales_KPI s
        JOIN Report_KPI r ON s.Nama = r.Nama
        ORDER BY s.Nama;
        ");

        $kpis = collect($data);

        return view('Soal1.index', compact('kpis'));
    }
    public function soal2()
    {
        $data = DB::select("
            SELECT
            COUNT(*) AS total_tasklist,
            SUM(CASE WHEN aktual <= deadline THEN 1 ELSE 0 END) AS ontime,
            SUM(CASE WHEN aktual > deadline THEN 1 ELSE 0 END) AS late,
            ROUND(SUM(CASE WHEN aktual <= deadline THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS persen_ontime,
            ROUND(SUM(CASE WHEN aktual > deadline THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS persen_late
            FROM table_kpi_marketing;
        ");

        $kpis = collect($data);

        return view('Soal2.index', compact('kpis'));
    }
}
