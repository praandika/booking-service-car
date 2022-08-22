@extends('layouts.app')
@section('content')

@push('after-css')
    <style>
        .btn-booking {
            font-family: "Raleway", sans-serif;
            text-transform: uppercase;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 10px 28px;
            transition: 0.5s;
            margin-top: 10px;
            border: 2px solid #cc1616;
            color: #000;
            background: transparent;
            margin-top: 20px;
            margin-bottom: 20px;
            }

            .btn-booking:hover {
            background: #cc1616;
            border: 2px solid #cc1616;
            color: #fff;
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

        h5{
            font-weight: bold;
        }

        label{
            color: #c2c2c2;
        }

    </style>
@endpush

<div class="container">
    <div class="section-title">
        <span>Booking Form</span>
        <h2>Booking Form</h2>
    </div>

    <div class="row" data-aos="fade-up">
        <div class="col-lg-12">
            <form action="{{ route('member.store-booking') }}" method="POST">
                @csrf
                <input type="hidden" name="estimation" value="{{ $estimation }}">
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" required>
                <input type="hidden" class="form-control" name="service" value="{{ $layanan }}" required>
                <input type="hidden" name="paket" value="{{ $paket }}">
                <input type="hidden" class="form-control" name="date" value="{{ $tanggal }}" required>
                <input type="hidden" class="form-control" name="time" value="{{ $waktu }}" required>

                <div class="row">
                    <div class="col-md-4">
                        <label for="">Nama</label>
                        <h5>{{ Auth::user()->name }}</h5>
                    </div>
                    <div class="col-md-4">
                        <label for="">Email</label>
                        <h5>{{ Auth::user()->email }}</h5>
                    </div>
                    <div class="col-md-4">
                        <label for="">Layanan</label>
                        <h5>{{ $layanan }} | {{ $paket }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="">Tanggal</label>
                        <h5>{{ $tanggal }}</h5>
                    </div>
                    <div class="col-md-4">
                        <label for="">Waktu</label>
                        <h5>{{ $waktu }}</h5>
                    </div>
                    <div class="col-md-4">
                        <label for="">Estimasi</label>
                        <h5>Rp {{ number_format($estimation, 0, ',', '.')}}</h5>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Whatsapp/HP</label>
                        @if($phone == '')
                        <div class="inputGroup" style="position: relative;">
                            <span style="font-weight: bold; position: absolute; top: 7px; margin-left: 5px;">+62</span>
                            <input style="text-indent: 25px;" type="number" class="form-control" name="phone" placeholder="81xxxxxx" required autofocus>
                        </div>
                        @else
                            <input type="text" class="form-control" name="phone" value="{{ $phone }}" required readonly>
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Brand Mobil</label>
                        <input type="text" class="form-control" name="brand" placeholder="Cth: Toyota" required @if($phone) autofocus @endif>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <label for="">Tipe Mobil</label>
                        <input type="text" class="form-control" name="type" placeholder="Cth: Avanza" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Plat No</label>
                        <input type="text" class="form-control" name="plate_no" placeholder="DK xxxx XY" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <label for="">Warna Mobil</label>
                        <input type="text" class="form-control" name="color" placeholder="Cth: Biru"
                            required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Tahun Mobil</label>
                        <input type="text" class="form-control" name="year" placeholder="Cth: 2022" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <label for="">Transmisi</label>
                        <select name="transmition" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="AT">Automatic</option>
                            <option value="MT">Manual</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <label for="">Mau Dijemput?</label>
                        <select name="facility" class="form-control" required>
                            @if($jemput == 1)
                            <option value="jemput" selected>Ya</option>
                            @else
                            <option value="">Pilih</option>
                            <option value="datang">Tidak</option>
                            <option value="jemput">Ya</option>
                            @endif
                        </select>
                    </div>
                    
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <label for="">Keluhan</label>
                        <input type="text" class="form-control" name="complaint" placeholder="Ada keluhan apa aja? sini curhat">
                    </div>
                </div>
                
                <div class="text-center"><button type="submit" class="btn-booking">Booking Sekarang</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
