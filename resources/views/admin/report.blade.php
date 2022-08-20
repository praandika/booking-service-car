@extends('layouts.admin')
@section('title','Laporan')
@section('dash-title','Laporan')

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
        </div>
        <br>
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
                <tr>
                    <td colspan="8" style="text-align: center; cursor: pointer;" id="cari">Cari
                        Laporan</td>
                </tr>
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
    $(document).ready(function(){
        $('#cari').click(function(){
            $('#tgl').focus();
        });
    });
</script>
@endpush
@endsection
