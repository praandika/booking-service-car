@extends('layouts.admin')
@section('title',$title)
@section('dash-title',$title)

@section('content')
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
                        @if($o->status == 'dikerjakan')
                            <a href="{{ route('admin.work-order-finishing',$o->id) }}" class="btn-aksi-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai"> <i class="typcn typcn-tick"></i></a>
                        @elseif($o->status == 'selesai')
                            <a href="https://wa.me/{{ $o->user->phone }}?text=Halo%20{{ str_replace(' ', '%20', $o->user->name); }}%20{{ $o->service }}%20mobil%20{{ $o->brand }}%20{{ $o->type }}%20Anda%20sudah%20selesai%20dikerjakan" class="btn-aksi-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Pesan" target="_blank"> <i class="typcn typcn-location-arrow-outline"></i></a>
                            <a href="" class="btn-aksi-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Nota"> <i class="typcn typcn-printer"></i></a>
                        @else
                            <a href="{{ url('member/booking-reschedule',$o->id) }}" class="btn-aksi-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Jadwal Ulang"> <i class="typcn typcn-arrow-sync"></i></a>
                            <a href="{{ url('admin/work-order-form',$o->id) }}" class="btn-aksi-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Kerjakan"> <i class="typcn typcn-spanner"></i></a>
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