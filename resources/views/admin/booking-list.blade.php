@extends('layouts.admin')
@section('title','Karyawan')
@section('dash-title','Karyawan')

@section('content')
<div class="row" style="margin-top: 20px;">
    <h4 class="dekor-judul"><i class="typcn typcn-info-large"></i> Service Dikerjakan</h4>
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
                    <th>Aksi</th>
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