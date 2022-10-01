<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Teknisi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Calibri', sans-serif;
            color: #3d3d3d;
        }

        .judul {
            color: #ad1111;
            font-size: 30px;
        }

        .referensi {
            padding: 5px 20px;
            border: 1px dashed #3d3d3d;
        }

        .referensi tr th {
            padding-right: 20px;
            text-align: left;
        }

        .info tr th,
        .info tr td {
            padding-right: 10px;
        }

        .row {
            width: 100%;
        }

        .col {
            width: 45%;
            display: inline-block;
        }

        .col h3 {
            color: #e36671;
        }

        .col h4 {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .garis {
            background-color: #929292;
            width: 80%;
            height: 2px;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        table.data {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table.data thead tr {
            background-color: #3d3d3d;
            color: #ffffff;
        }

        table.data tr.data th,
        table.data tr.data td {
            padding: 10px;
            border: 1px solid #919191;
        }

        table.data tr.total th,
        table.data tr.total td {
            padding: 10px;
        }

        table .nominal {
            text-align: right;
        }

        table tr.total {
            padding-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
        }

        .logo {
            text-align: right;
            width: 200px;
        }

    </style>
</head>

<body>
    <center>
        <h2 class="judul">Laporan</h2>
        <h4>Teknisi $teknisi</h4>
        <hr>
    </center>

    <table class="referensi">
        <tr>
            <th>Tanggal</th>
            <td>: {{ Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} - {{ Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Tipe Service</th>
            <td>: {{ $service == "semua" ? 'Semua' : $service }}</td>
        </tr>
        <tr>
            <th>Status Service</th>
            <td>: {{ $status == "semua" ? 'Semua' : ucwords($status) }}</td>
        </tr>
    </table>
    <p style="font-size: 10px; margin-top: 5px; margin-bottom: 5px;">Printed from server : {{ Carbon\Carbon::parse($date)->translatedFormat('d F Y H:i:s') }}</p>
    <table class="data">
        <thead>
            <tr class="data">
                <th>No</th>
                <th>Mobil</th>
                <th>Tanggal / Waktu</th>
                <th>Service</th>
                <th>Reward</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($data as $o)
            <tr class="data">
                <td>{{ $no++ }}</td>
                <td>{{ $o->booking->brand }} | {{ $o->booking->type }} | {{ $o->booking->plate_no }}</td>
                <td>{{ $o->booking->date }} | {{ $o->booking->time }}</td>
                <td>{{ $o->booking->service }} | {{ $o->booking->package }}</td>
                <td style="width: 120px; text-align: right;">Rp {{ ($o->booking->estimation) * 0.1 }}</td>
            </tr>
            @endforeach
            <tr class="total" style="font-weight: bold;">
                <td colspan="4" style="text-align: right;">Total Reward</td>
                <td style="text-align: right;">Rp {{ number_format($reward, 0, ',', '.')}}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <hr>
    <div class="footer">
        <p>&copy; Motohid Car Repair</p>
    </div>
</body>

</html>
