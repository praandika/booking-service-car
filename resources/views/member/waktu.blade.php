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
        }

        .btn-booking:hover {
            background: #cc1616;
            border: 2px solid #cc1616;
            color: #fff;
            
        }

        .btn-disabled{
            font-family: "Raleway", sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 1px;
            display: inline-block;
            padding: 10px 28px;
            transition: 0.5s;
            margin-top: 10px;
            border: 2px solid #242424;
            color: #cc1616;
            background: #242424;
            cursor: no-drop;
        }
    </style>
@endpush

<section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
            <span>Pilih Waktu</span>
            <h2>Pilih Waktu</h2>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-lg-4">
                <div class="info-box mb-4">
                    <i class="bx bx-time"></i>
                    <h3>09:00</h3>
                    <form action="{{ route('member.goto-form') }}" method="GET">
                        @csrf
                        <input type="hidden" value="09:00" name="waktu">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $tanggal }}" name="tanggal">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        <input type="hidden" value="{{ $paket }}" name="paket">
                        @if($time09 >= 3)
                        <a href="#" class="btn-disabled">Full Booked</a>
                        @else
                        <button class="btn-booking">Booking</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="info-box mb-4">
                    <i class="bx bx-time"></i>
                    <h3>10:00</h3>
                    <form action="{{ route('member.goto-form') }}" method="GET">
                        @csrf
                        <input type="hidden" value="10:00" name="waktu">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $tanggal }}" name="tanggal">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        <input type="hidden" value="{{ $paket }}" name="paket">
                        @if($time10 >= 3)
                        <a href="#" class="btn-disabled">Full Booked</a>
                        @else
                        <button class="btn-booking">Booking</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="info-box mb-4">
                    <i class="bx bx-time"></i>
                    <h3>11:00</h3>
                    <form action="{{ route('member.goto-form') }}" method="GET">
                        @csrf
                        <input type="hidden" value="11:00" name="waktu">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $tanggal }}" name="tanggal">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        <input type="hidden" value="{{ $paket }}" name="paket">
                        @if($time11 >= 3)
                        <a href="#" class="btn-disabled">Full Booked</a>
                        @else
                        <button class="btn-booking">Booking</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-lg-4">
                <div class="info-box mb-4">
                    <i class="bx bx-time"></i>
                    <h3>13:00</h3>
                    <form action="{{ route('member.goto-form') }}" method="GET">
                        @csrf
                        <input type="hidden" value="13:00" name="waktu">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $tanggal }}" name="tanggal">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        <input type="hidden" value="{{ $paket }}" name="paket">
                        @if($time13 >= 3)
                        <a href="#" class="btn-disabled">Full Booked</a>
                        @else
                        <button class="btn-booking">Booking</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="info-box mb-4">
                    <i class="bx bx-time"></i>
                    <h3>14:00</h3>
                    <form action="{{ route('member.goto-form') }}" method="GET">
                        @csrf
                        <input type="hidden" value="14:00" name="waktu">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $tanggal }}" name="tanggal">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        <input type="hidden" value="{{ $paket }}" name="paket">
                        @if($time14 >= 3)
                        <a href="#" class="btn-disabled">Full Booked</a>
                        @else
                        <button class="btn-booking">Booking</button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="info-box mb-4">
                    <i class="bx bx-time"></i>
                    <h3>15:00</h3>
                    <form action="{{ route('member.goto-form') }}" method="GET">
                        @csrf
                        <input type="hidden" value="15:00" name="waktu">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $tanggal }}" name="tanggal">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        <input type="hidden" value="{{ $paket }}" name="paket">
                        @if($time15 >= 3)
                        <a href="#" class="btn-disabled">Full Booked</a>
                        @else
                        <button class="btn-booking">Booking</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
