@extends('layouts.admin')
@section('title','Member Area | Jadwal Ulang')
@section('dash-title','Jadwal Ulang')

@push('after-css')
    <style>
        .kolom{
            border: 1px dashed #c2c2c2;
            padding: 20px;
        }

        input.form-control,
        select.form-control{
            border-radius: 0px;
        }

        input.form-control:focus,
        select.form-control:focus{
            box-shadow: none;
            border-color: #cc1616;
        }

        .active{
            background-color: #cc1616;
        }
    </style>
@endpush

@section('content')
@foreach($data as $o)
<form action="{{ route('member.update-booking',$o->id) }}" method="post">
    @csrf
    <div class="kolom">
        <div class="row">
            <div class="col-md-4">
                <label for="">Nama</label>
                <h5>{{ $o->user->name }}</h5>
            </div>
            <div class="col-md-4">
                <label for="">Email</label>
                <h5>{{ $o->user->email }}</h5>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Whatsapp/HP</label>
                <h5>{{ $o->user->phone }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="">Layanan</label>
                <h5>{{ $o->service }}</h5>
            </div>
            <div class="col-md-4">
                <label for="">Estimasi</label>
                <h5>{{ $o->estimation }}</h5>
            </div>
            <div class="col-md-4 form-group">
                <label for="">Mobil</label>
                <h5>{{ $o->brand }} | {{ $o->type }} | {{ $o->color }} | {{ $o->year }} | {{ $o->transmition }}</h5>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Plat No</label>
                <h5>{{ $o->plate_no }}</h5>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Pick Up</label>
                <h5>{{ ucwords($o->facility) }}</h5>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <label for="">Keluhan</label>
                <h5>{{ $o->complaint }}</h5>
            </div>
        </div>
    </div>

    <div class="kolom">
        <div class="row">
            <div class="col-md-3 form-group mt-3 mt-md-0">
                <label for="">Pilih Tanggal</label>
                <input type="date" name="date" id="inputdate" class="form-control" value="{{ $o->date }}">
            </div>
@endforeach
            <div class="col-md-6 form-group mt-3 mt-md-0" style="text-align: center;">
                <label for="">Pilih Waktu</label>
                <br>
                <a class="btn btn-light wkt" onclick="pilihWaktu('09:00')">09:00</a>
                <a class="btn btn-light wkt" onclick="pilihWaktu('10:00')">10:00</a>
                <a class="btn btn-light wkt" onclick="pilihWaktu('11:00')">11:00</a>
                <a class="btn btn-light wkt" onclick="pilihWaktu('13:00')">13:00</a>
                <a class="btn btn-light wkt" onclick="pilihWaktu('14:00')">14:00</a>
                <a class="btn btn-light wkt" onclick="pilihWaktu('15:00')">15:00</a>
            </div>

            <div class="col-md-3 form-group mt-3 mt-md-0">
                <label for="">Waktu</label>
                <input type="text" name="time" class="form-control" id="waktu" readonly>
            </div>
        </div>
    </div>
    

    <div class="row mt-3">
        <div class="col-md-12 form-group mt-3 mt-md-0" style="text-align: right;">
            <button type="submit" class="btn btn-primary">Jadwal Ulang</button>
        </div>
    </div>
</form>

@push('after-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(function(){
        var dtToday = new Date();
    
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        $('#inputdate').attr('min', maxDate);
    });

    function pilihWaktu($waktu){
        document.getElementById("waktu").value = $waktu;
    }
</script>
@endpush
@endsection
