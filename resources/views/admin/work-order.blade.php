@extends('layouts.admin')
@section('title','Sedang Dikerjakan')
@section('dash-title','Sedang Dikerjakan')

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
                    <th>Teknisi</th>
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
                    <th>{{ $o->booking->user->name }} | {{ $o->booking->user->phone }}</th>
                    <td>{{ Carbon\Carbon::parse($o->booking->date)->translatedFormat('d F Y') }} | {{ $o->booking->time }}</td>
                    <td>{{ $o->booking->service }} | {{ $o->booking->package }}</td>
                    <td>{{ $o->employee->name }}</td>
                    <td>{{ $o->booking->brand }} {{ $o->booking->type }} | {{ $o->booking->color }} | {{ $o->booking->year }} | {{ $o->booking->transmition }}</td>
                    <td>{{ $o->booking->plate_no }}</td>
                    <td>{{ $o->booking->frame_no }}</td>
                    <td><span class="{{ ($o->status == 'tertunda') ? 'label-pending' : (($o->status == 'dikerjakan') ? 'label-progress' : 'label-success')  }}">{{ ucwords($o->booking->status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.work-order-finishing',$o->booking->id) }}" class="btn-aksi-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai"> <i class="typcn typcn-tick"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align: center;">Tidak ada data yang tersedia</td>
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