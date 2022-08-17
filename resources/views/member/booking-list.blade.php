@extends('layouts.admin')
@section('title','Member Area')
@section('dash-title','Daftar Booking')

@section('content')
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
                <td>{{ $o->brand }} {{ $o->type }} | {{ $o->color }} | {{ $o->tahun }} | {{ $o->transmition }}</td>
                <td>{{ $o->plate_no }}</td>
                <td>{{ $o->frame_no }}</td>
                <td>{{ ucwords($o->status) }}</td>
                <td>
                    @if($o->status == 'tertunda')
                    <a href="" class="btn btn-success"> <i class="typcn typcn-arrow-sync"></i> Jadwal Ulang</a>
                    @else
                    <button class="btn btn-light"><i class="typcn typcn-arrow-sync"></i> {{ ucwords($o->status) }}</button>
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

@push('after-script')
<script>
    $(document).ready(function () {
        $('#TableData').DataTable();
    });

</script>
@endpush
@endsection
