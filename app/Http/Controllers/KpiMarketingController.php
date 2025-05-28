<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KpiMarketingController extends Controller
{
    public function index()
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
                    ROUND(kc.Sales_Actual / NULLIF(v.targetKPI, 0), 2) AS Sales_Pencapaian,
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
                    ROUND(kc.Report_Actual / NULLIF(v.targetKPI, 0), 2) AS Report_Pencapaian,
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

                -- Sales Section
                s.Sales_Target,
                s.Sales_Actual,
                CONCAT(ROUND(s.Sales_Pencapaian * 100), '%') AS Sales_Pencapaian,
                CONCAT(s.Bobot_Sales, '%') AS Bobot_Sales,
                s.Late_Sales,
                CONCAT(s.Total_Bobot_Sales, '%') AS Total_Bobot_Sales,

                -- Report Section
                r.Report_Target,
                r.Report_Actual,
                CONCAT(ROUND(r.Report_Pencapaian * 100), '%') AS Report_Pencapaian,
                CONCAT(r.Bobot_Report, '%') AS Bobot_Report,
                r.Late_Report,
                CONCAT(r.Total_Bobot_Report, '%') AS Total_Bobot_Report,

                -- Total KPI
                CONCAT(s.Total_Bobot_Sales + r.Total_Bobot_Report, '%') AS Total_KPI
            FROM Sales_KPI s
            JOIN Report_KPI r ON s.Nama = r.Nama
            ORDER BY s.Nama;
        ");
        $data2 = DB::select("
            SELECT
            COUNT(*) AS total_tasklist,
            SUM(CASE WHEN aktual <= deadline THEN 1 ELSE 0 END) AS ontime,
            SUM(CASE WHEN aktual > deadline THEN 1 ELSE 0 END) AS late,
            ROUND(SUM(CASE WHEN aktual <= deadline THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS persen_ontime,
            ROUND(SUM(CASE WHEN aktual > deadline THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS persen_late
            FROM table_kpi_marketing;
        ");

        $soal1 = collect($data);
        $soal2 = collect($data2);

        return view('KpiMarketing.index', compact('soal1', 'soal2'));
    }
}
