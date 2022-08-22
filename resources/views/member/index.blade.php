@extends('layouts.admin')
@section('title','Member Area')
@section('dash-title','Member Area')

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-12 col-lg-4">
        <div class="card card-dashboard-five">
            <div class="card-header">
                <h6 class="card-title">Servis Terkini</h6>
                <span class="card-text">Informasi kendaraan yang sedang diservis.</span>
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

    <div class="col-md-4 col-sm-12 col-lg-4">
        <div class="card card-dashboard-five">
            <div class="card-header">
                <h6 class="card-title">Estimasi Biaya</h6>
                <span class="card-text">Informasi estimasi biaya pengerjaan.</span>
            </div><!-- card-header -->
            <div class="card-body row row-sm">
                <div class="col-12 d-sm-flex align-items-center">
                    <div class="card-chart bg-purple">
                        <h5 style="color: #fff;">
                            <i class="typcn typcn-credit-card"></i>
                        </h5>
                    </div>
                    <div>
                        <label>Estimasi Biaya</label>
                        <h4>Rp {{ number_format($estimasiBiaya, 0, ',', '.')}}</h4>
                    </div>
                </div><!-- col -->
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12 col-lg-4">
        <div class="card card-dashboard-five">
            <div class="card-header">
                <h6 class="card-title">Jadwal Ulang</h6>
                <span class="card-text">Informasi jumlah pengerjaan yang dijadwal ulang</span>
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

<div class="row" style="margin-top: 20px;">
    <div class="table-responsive">
        <table class="table table-hover table-bordered mg-b-0" id="TableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal / Waktu</th>
                    <th>Service</th>
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
                    <td>{{ $o->service }} | {{ $o->package }}</td>
                    <td>{{ $o->brand }} {{ $o->type }} | {{ $o->color }} | {{ $o->year }} | {{ $o->transmition }}</td>
                    <td>{{ $o->plate_no }}</td>
                    <td>{{ $o->frame_no }}</td>
                    <td><span class="{{ ($o->status == 'tertunda') ? 'label-pending' : (($o->status == 'dikerjakan') ? 'label-progress' : 'label-success')  }}">{{ ucwords($o->status) }}</span></td>
                    <td>
                        @if($o->status == 'tertunda')
                        <a href="{{ url('member/booking-reschedule',$o->id) }}" class="btn-aksi-primary"> <i class="typcn typcn-arrow-sync"></i> Jadwal Ulang</a>
                        @else
                        <button class="btn-aksi-secondary" disabled><i class="typcn typcn-arrow-sync"></i> {{ ucwords($o->status) }}</button>
                        @endif
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
