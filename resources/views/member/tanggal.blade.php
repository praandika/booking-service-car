@extends('layouts.app')
@section('content')

@push('after-css')
<style>
    input#inputdate{
        padding: 15px 80px;
        border-radius: 0px;
        outline: none;
        border: none;
        color: #cc1616;
    }
</style>
@endpush

<section id="cta" class="cta">
    <div class="container" data-aos="zoom-in">

        <div class="text-center">
            <h3>Pilih Tanggal</h3>
            <form action="{{ route('member.goto-waktu') }}" method="GET">
                @csrf
                <input type="hidden" value="{{ $jemput }}" name="jemput">
                <input type="hidden" value="{{ $layanan }}" name="layanan">
                <input type="hidden" value="{{ $paket }}" name="paket">
                <input type="date" name="tanggal" id="inputdate" required> <br>
                <button class="cta-btn" style="background: transparent;">Booking</button>
            </form>
        </div>

    </div>
</section>

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
</script>
@endpush
@endsection
