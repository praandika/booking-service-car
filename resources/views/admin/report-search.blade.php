@extends('layouts.admin')
@section('title','Cari Laporan')
@section('dash-title','Cari Laporan')

@section('content')
<form action="{{ route('admin.report-search') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-3 mt-3 mt-md-0">
            <label for="">Tanggal Awal</label>
            <input type="date" name="start" class="form-control" id="tgl" required>
        </div>
        <div class="col-md-3 mt-3 mt-md-0">
            <label for="">Tanggal Akhir</label>
            <input type="date" name="end" class="form-control" required>
        </div>
        <div class="col-md-2 mt-3 mt-md-0">
            <label for="">Tipe Service</label>
            <select name="service" id="" class="form-control">
                <option value="">Pilih Tipe Service</option>
                <option value="Service Mesin">Service Mesin</option>
                <option value="Body Repair">Body Repair</option>
            </select>
        </div>
        <div class="col-md-2 mt-3 mt-md-0" style="position: relative;">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="">Pilih Status</option>
                <option value="tertunda">Tertunda</option>
                <option value="dikerjakan">Dikerjakan</option>
                <option value="selesai">Selesai</option>
            </select>
            <button type="submit"
                style="position: absolute; bottom: 0px; right: -28px; padding: 8px 15px; border:none; background-color: green; color: #ffffff;"><i
                    class="fa fa-search"></i> </button>
            <a href="{{ route('admin.print-report') }}" style="position: absolute; bottom: 0px; right: -165px; padding: 8px 15px; border:none; background-color: blue; color: #ffffff;"><i class="far fa-file-pdf"></i> Export to PDF</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 mt-3 mt-md-0">
            <p style="font-size: 12px; color: red;">* Kosongkan Tipe Service dan Status untuk mencari semua data</p>
        </div>
    </div>
</form>

<div class="row" style="margin-top: 20px;">
    <div class="table-responsive">
        <table class="table table-hover table-bordered mg-b-0" id="TableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Tanggal / Waktu</th>
                    <th>Service</th>
                    <th>Mobil</th>
                    <th>Plat No</th>
                    <th>No. Rangka</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @forelse($data as $o)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <th>{{ $o->user->name }} | {{ $o->user->phone }}</th>
                    <td>{{ Carbon\Carbon::parse($o->date)->translatedFormat('d F Y') }} | {{ $o->time }}</td>
                    <td>{{ $o->service }}</td>
                    <td>{{ $o->brand }} {{ $o->type }} | {{ $o->color }} | {{ $o->year }} | {{ $o->transmition }}</td>
                    <td>{{ $o->plate_no }}</td>
                    <td>{{ $o->frame_no }}</td>
                    <td><span class="{{ ($o->status == 'tertunda') ? 'label-pending' : (($o->status == 'dikerjakan') ? 'label-progress' : 'label-success')  }}">{{ ucwords($o->status) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center;" id="cari" onclick="focus()"><p style="cursor: pointer;">Cari Laporan</p></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div><!-- table-responsive -->
</div>
@push('after-script')
<script>
    $(document).ready(function () {
        $('#TableData').DataTable();
    });
</script>

<script>
    function focus(){
        document.getElementById("tgl").focus();
    }
</script>
@endpush
@endsection
