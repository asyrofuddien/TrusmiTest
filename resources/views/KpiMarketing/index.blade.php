<!DOCTYPE html>
<html>

<head>
    <title>Data KPI Marketing</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px 12px;
            text-align: center;
        }

        th {
            background-color: #f53888;
            color: white;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">Data KPI Marketing</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tasklist</th>
                <th>KPI</th>
                <th>Karyawan</th>
                <th>Deadline</th>
                <th>Aktual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kpis as $kpi)
            <tr>
                <td>{{ $kpi->id }}</td>
                <td>{{ $kpi->tasklist }}</td>
                <td>{{ $kpi->kpi }}</td>
                <td>{{ $kpi->karyawan }}</td>
                <td>{{ $kpi->deadline }}</td>
                <td>{{ $kpi->aktual }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>