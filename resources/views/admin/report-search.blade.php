@extends('layouts.admin')
@section('title','Cari '.$report)
@section('dash-title','Cari '.$report)

@section('content')
<form action="{{ url('admin/report-search',$type) }}" method="post">
    @csrf
    @if($type == 'teknisi')
    <div class="row">
        <div class="col-md-3 mt-3 mt-md-0">
            <label for="">Pilih Teknisi</label>
            <select name="teknisi" id="" class="form-control">
                <option selected>{{ $teknisi }}</option>
                <option disabled>---------------------</option>
                
                @forelse($employee as $a)
                <option value="{{ $a->id }}">{{ $a->name }}</option>
                @empty
                <option disabled>Tidak ada teknisi</option>
                @endforelse
            </select>
        </div>
    </div>
    <br>
    @endif

    <div class="row">
        <div class="col-md-3 mt-3 mt-md-0">
            <label for="">Tanggal Awal</label>
            <input type="date" name="start" class="form-control" id="tgl" value="{{ $start }}" required>
        </div>
        <div class="col-md-3 mt-3 mt-md-0">
            <label for="">Tanggal Akhir</label>
            <input type="date" name="end" class="form-control" value="{{ $end }}" required>
        </div>
        <div class="col-md-2 mt-3 mt-md-0">
            <label for="">Tipe Service</label>
            <select name="service" id="" class="form-control">
                <option value="{{ $service == 'semua' ? 'semua' : $service }}">{{ $service == 'semua' ? 'All' : ucwords($service) }}</option>
                @if($service != 'semua')
                <option disabled>----------------</option>
                <option value="semua">All</option>
                @endif
                <option value="Service Mesin">Service Mesin</option>
                <option value="Body Repair">Body Repair</option>
            </select>
        </div>
        <div class="col-md-2 mt-3 mt-md-0" style="position: relative;">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="{{ $status == 'semua' ? 'semua' : $status }}">{{ $status == 'semua' ? 'All' : ucwords($status) }}</option>
                @if($status != 'semua')
                <option disabled>----------------</option>
                <option value="semua">All</option>
                @endif
                <option value="tertunda">Tertunda</option>
                <option value="dikerjakan">Dikerjakan</option>
                <option value="selesai">Selesai</option>
            </select>
            <button type="submit"
                style="position: absolute; bottom: 0px; right: -28px; padding: 8px 15px; border:none; background-color: green; color: #ffffff;"><i
                    class="fa fa-search"></i> </button>
            @if($type == 'teknisi')
            <a href="{{ url('print-report-teknisi/'.$start.'/'.$end.'/'.$service.'/'.$status.'/'.$teknisi) }}" style="position: absolute; bottom: 0px; right: -165px; padding: 8px 15px; border:none; background-color: blue; color: #ffffff;"><i class="far fa-file-pdf"></i> Export to PDF</a>
            @else
            <a href="{{ url('print-report/'.$start.'/'.$end.'/'.$service.'/'.$status.'/'.$type) }}" style="position: absolute; bottom: 0px; right: -165px; padding: 8px 15px; border:none; background-color: blue; color: #ffffff;"><i class="far fa-file-pdf"></i> Export to PDF</a>
            @endif
        </div>
    </div>
</form>

<div class="row" style="margin-top: 20px;">
    <div class="table-responsive">
        <table class="table table-hover table-bordered mg-b-0" id="TableData">
        @if($type == 'booking')
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cust / Phone</th>
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
                    <td>{{ $o->service }} | {{ $o->package }}</td>
                    <td>{{ $o->brand }} {{ $o->type }} | {{ $o->color }} | {{ $o->year }} | {{ $o->transmition }}</td>
                    <td>{{ $o->plate_no }}</td>
                    <td>{{ $o->frame_no }}</td>
                    <td><span class="{{ ($o->status == 'tertunda') ? 'label-pending' : (($o->status == 'dikerjakan') ? 'label-progress' : 'label-success')  }}">{{ ucwords($o->status) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center;" id="cari" onclick="focus()"><p style="cursor: pointer;">Tidak ada data tersedia</p></td>
                </tr>
                @endforelse
            </tbody>
        @elseif($type == 'pendapatan')
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Tanggal / Waktu</th>
                    <th>Service</th>
                    <th>Pendapatan</th>
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
                    <td>{{ $o->service }} | {{ $o->package }}</td>
                    <td>Rp {{ number_format($o->estimation, 0, ',', '.')}}</td>
                    <td><span class="{{ ($o->status == 'tertunda') ? 'label-pending' : (($o->status == 'dikerjakan') ? 'label-progress' : 'label-success')  }}">{{ ucwords($o->status) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;" id="cari" onclick="focus()"><p style="cursor: pointer;">Tidak ada data tersedia</p></td>
                </tr>
                @endforelse
            </tbody>
        @elseif($type == 'teknisi')
            <thead>
                <tr>
                    <th>No</th>
                    <th>Teknisi</th>
                    <th>Pelanggan</th>
                    <th>Mobil</th>
                    <th>Tanggal / Waktu</th>
                    <th>Service</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @forelse($data as $o)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <th>{{ $o->employee->name }}</th>
                    <th>{{ $o->booking->user->name }}</th>
                    <td>{{ $o->booking->brand }} {{ $o->booking->type }} | {{ $o->booking->color }} | {{ $o->booking->year }} | {{ $o->booking->transmition }}</td>
                    <td>{{ Carbon\Carbon::parse($o->booking->date)->translatedFormat('d F Y') }} | {{ $o->booking->time }}</td>
                    <td>{{ $o->booking->service }} | {{ $o->booking->package }}</td>
                    <td><span class="{{ ($o->booking->status == 'tertunda') ? 'label-pending' : (($o->booking->status == 'dikerjakan') ? 'label-progress' : 'label-success')  }}">{{ ucwords($o->status) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;" id="cari" onclick="focus()"><p style="cursor: pointer;">Data {{ $teknisi }} tidak tersedia</p></td>
                </tr>
                @endforelse
            </tbody>
        @else
        @endif
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
