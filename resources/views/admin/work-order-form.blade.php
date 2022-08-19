@extends('layouts.admin')
@section('title','Kerjakan Service Booking')
@section('dash-title','Kerjakan Service Booking')

@section('content')
@foreach($data as $o)
<form action="{{ route('admin.work-order-store',$o->id) }}" method="post">
    @csrf
    <div class="kolom">
        <div class="row">
            <div class="col-md-4">
                <label for="">Nama</label>
                <h5>{{ $o->user->name }}</h5>
            </div>
            <div class="col-md-4">
                <label for="">Layanan</label>
                <h5>{{ $o->service }}</h5>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Keluhan</label>
                <h5>{{ $o->complaint }}</h5>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4 form-group">
                <label for="">Mobil</label>
                <h5>{{ $o->brand }} | {{ $o->type }} | {{ $o->color }} | {{ $o->year }} | {{ $o->transmition }}</h5>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Plat No</label>
                <h5>{{ $o->plate_no }}</h5>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Tanggal/Waktu Booking</label>
                <h5>{{ Carbon\Carbon::parse($date)->translatedFormat('d F Y') }} | {{ $o->time }}</h5>
            </div>
        </div>
    </div>
    @endforeach

    <div class="kolom">
        <div class="row">
            <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="">Nomor Rangka</label>
                <input type="text" name="frame_no" class="form-control" placeholder="Masukkan Nomor Rangka">
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="">Teknisi</label>
                <select name="employee" class="form-control" required>
                    <option value="">Pilih Teknisi</option>
                    @forelse($emp as $e)
                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                    @empty
                    <option value="">Tidak ada teknisi</option>
                    @endforelse
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 form-group mt-3 mt-md-0" style="text-align: right;">
            <button type="submit" class="btn btn-primary"><i class="typcn typcn-spanner"></i> Kerjakan</button>
        </div>
    </div>
</form>
@endsection
