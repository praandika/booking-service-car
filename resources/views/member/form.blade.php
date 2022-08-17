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
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" required>
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                            required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" name="service" value="{{ $layanan }}" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="date" value="{{ $tanggal }}"
                            required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="time" value="{{ $waktu }}"
                            required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" name="brand" placeholder="Brand Mobil Cth: Toyota" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="type" placeholder="Type Mobil Mobil Cth: Avanza"
                            required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="color" placeholder="Warna Mobil"
                            required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" name="year" placeholder="Tahun Mobil" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <select name="transmition" class="form-control" required>
                            <option value="">Pilih Transmisi</option>
                            <option value="AT">Automatic</option>
                            <option value="MT">Manual</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <select name="facility" class="form-control" required>
                            <option value="">Mau Dijemput?</option>
                            <option value="datang">Tidak</option>
                            <option value="jemput">Ya</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" name="plate_no" placeholder="Plate Nomor Kendaraan" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" value="{{ ($layanan = 'Service Mesin') ? 'Rp 250.000' : 'Rp 500.000' }}"
                            required>
                        <input type="hidden" name="estimation" value="{{ ($layanan = 'Service Mesin') ? 250000 : 500000 }}">
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="complaint" placeholder="Keluhan">
                    </div>
                </div>

                
                <div class="text-center"><button type="submit" class="btn-booking">Booking Sekarang</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
