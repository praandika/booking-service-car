@extends('layouts.admin')
@section('title','Dashboard')
@section('dash-title','Dashboard')

@push('after-css')
    <style>
        .dekor-judul{
            background-color: #0054b5;
            color: #ffffff;
            padding: 10px;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-12 col-lg-3">
        <div class="card card-dashboard-five">
            <div class="card-header">
                <h6 class="card-title">Booking Service</h6>
                <span class="card-text">Info jumlah booking service.</span>
            </div><!-- card-header -->
            <div class="card-body row row-sm">
                <div class="col-12 d-sm-flex align-items-center">
                    <div class="card-chart bg-primary">
                        <h5 style="color: #fff;">
                            <i class="typcn typcn-spanner"></i>
                        </h5>
                    </div>
                    <div>
                        <label>Jumlah Servis</label>
                        <h4>{{ $serviceCount }}</h4>
                    </div>
                </div><!-- col -->
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-12 col-lg-3">
        <div class="card card-dashboard-five">
            <div class="card-header">
                <h6 class="card-title">Pelanggan Booking Hari Ini</h6>
                <span class="card-text">Informasi jumlah pelanggan hari ini.</span>
            </div><!-- card-header -->
            <div class="card-body row row-sm">
                <div class="col-12 d-sm-flex align-items-center">
                    <div class="card-chart bg-danger">
                        <h5 style="color: #fff;">
                            <i class="typcn typcn-group-outline"></i>
                        </h5>
                    </div>
                    <div>
                        <label>Jumlah Pelanggan</label>
                        <h4>{{ $pelanggan }}</h4>
                    </div>
                </div><!-- col -->
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-12 col-lg-3">
        <div class="card card-dashboard-five">
            <div class="card-header">
                <h6 class="card-title">Tipe Service</h6>
                <span class="card-text">Informasi jenis servis kendaraan.</span>
            </div><!-- card-header -->
            <div class="card-body row row-sm">
                <div class="col-12 d-sm-flex align-items-center">
                    <div style="margin-right: 10px;">
                        <label style="background-color: #1f1f1f; color: #ffffff; padding: 3px; font-size: 9px; font-weight: bold;">Service Mesin</label>
                        <center>
                            <h4>{{ $svcMesin }}</h4>
                        </center>
                    </div>
                    <div>
                        <label style="background-color: #b59d00; color: #000000; padding: 3px; font-size: 9px; font-weight: bold;">Body Repair</label>
                        <center>
                            <h4>{{ $bodyRepair }}</h4>
                        </center>
                    </div>
                </div><!-- col -->
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-12 col-lg-3">
        <div class="card card-dashboard-five">
            <div class="card-header">
                <h6 class="card-title">Jadwal Ulang</h6>
                <span class="card-text">Info booking dijadwal ulang</span>
            </div><!-- card-header -->
            <div class="card-body row row-sm">
                <div class="col-12 d-sm-flex align-items-center">
                    <div class="card-chart bg-success">
                        <h5 style="color: #fff;">
                            <i class="typcn typcn-arrow-sync"></i>
                        </h5>
                    </div>
                    <div>
                        <label>Dijadwal Ulang</label>
                        <h4>{{ $reschedule }}</h4>
                    </div>
                </div><!-- col -->
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row" style="margin-top: 20px;">
    <h4 class="dekor-judul"><i class="typcn typcn-info-large"></i> Booking Service Hari Ini</h4>
    <div class="table-responsive">
        <table class="table table-hover table-bordered mg-b-0" id="TableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Service</th>
                    <th>Tanggal / Waktu</th>
                    <th>Mobil</th>
                    <th>Plat No</th>
                    <th>No. Rangka</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @forelse($data as $o)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ Carbon\Carbon::parse($o->date)->translatedFormat('d F Y') }} | {{ $o->time }}</td>
                    <td>{{ $o->service }}</td>
                    <td>{{ $o->brand }} {{ $o->type }} | {{ $o->color }} | {{ $o->year }} | {{ $o->transmition }}</td>
                    <td>{{ $o->plate_no }}</td>
                    <td>{{ $o->frame_no }}</td>
                    <td><span class="{{ ($o->status == 'tertunda') ? 'label-pending' : (($o->status == 'dikerjakan') ? 'label-progress' : 'label-success')  }}">{{ ucwords($o->status) }}</span></td>
                    <td>
                        <a href="{{ url('member/booking-reschedule',$o->id) }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Jadwal Ulang"> <i class="typcn typcn-arrow-sync"></i></a>
                        <a href="{{ url('admin/work-order-form',$o->id) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kerjakan"> <i class="typcn typcn-spanner"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data yang tersedia</td>
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
@endpush
@endsection