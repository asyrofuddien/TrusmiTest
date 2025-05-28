<tr>
    <td>{{ $kpi->Nama }}</td>

    {{-- Sales Section --}}
    <td>{{ $kpi->Sales_Target }}</td>
    <td>{{ $kpi->Sales_Actual }}</td>
    <td>{{ $kpi->Sales_Pencapaian }}</td>
    <td>{{ $kpi->Bobot_Sales }}</td>
    <td>{{ $kpi->Late_Sales }}</td>
    <td>{{ $kpi->Total_Bobot_Sales }}</td>

    {{-- Report Section --}}
    <td>{{ $kpi->Report_Target }}</td>
    <td>{{ $kpi->Report_Actual }}</td>
    <td>{{ $kpi->Report_Pencapaian }}</td>
    <td>{{ $kpi->Bobot_Report }}</td>
    <td>{{ $kpi->Late_Report }}</td>
    <td>{{ $kpi->Total_Bobot_Report }}</td>

    <td><strong>{{ $kpi->Total_KPI }}</strong></td>
</tr>