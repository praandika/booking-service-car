<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Nota</title>

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
        <h2 class="judul">NOTA</h2>
    </center>

    @foreach($data as $o)
    <table class="referensi">
        <tr>
            <th>Referensi</th>
            <td>: {{ $ref }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>: {{ Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Status Service</th>
            <td>: {{ ucwords($o->status) }}</td>
        </tr>
    </table>


    <div class="row">
        <div class="col">
            <h4>Info Bengkel</h4>
            <div class="garis"></div>
            <h3>Motohid Car Repair</h3>
            <table class="info">
                <tr>
                    <td>Telp</td>
                    <td>: 0333-558912</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: motohidcar.repair@gmail.com</td>
                </tr>
            </table>
        </div>

        <div class="col right">
            <h4>Tagihan Untuk</h4>
            <div class="garis"></div>
            <h3>{{ $o->user->name }}</h3>
            <table class="info">
                <tr>
                    <td>Telp</td>
                    <td>: {{ $o->user->phone }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{ $o->user->email }}</td>
                </tr>
            </table>
        </div>
    </div>

    <table class="data">
        <thead>
            <tr class="data">
                <th>No</th>
                <th>Tanggal / Waktu Booking</th>
                <th>Service</th>
                <th>Mobil</th>
                <th>Estimasi Biaya</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            <tr class="data">
                <td>{{ $no++ }}</td>
                <td>{{ $o->date }} | {{ $o->time }}</td>
                <td>{{ $o->service }} | {{ $o->package }}</td>
                <td>{{ $o->brand }} | {{ $o->type }} | {{ $o->plate_no }}</td>
                <td style="width: 150px; text-align: right;">Rp {{ number_format($o->estimation, 0, ',', '.')}}</td>
            </tr>
            <tr class="total">
                <th colspan="3"></th>
                <th class="nominal">Jumlah Tertagih</th>
                <th class="nominal">Rp {{ number_format($o->estimation, 0, ',', '.')}},-</th>
            </tr>
        </tbody>
    </table>
    @endforeach

    <br>
    <hr>
    <div class="footer">
        <p>&copy; Motohid Car Repair</p>
    </div>
</body>

</html>
