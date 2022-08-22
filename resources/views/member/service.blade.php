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
    </style>
@endpush

<section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
            @if($layanan == "Service Mesin")
            <span>Pilih Paket Service</span>
            <h2>Pilih Paket Service</h2>
            @else
            <span>Pilih Paket Body Repair</span>
            <h2>Pilih Paket Body Repair</h2>
            @endif
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-lg-3">
                <div class="info-box mb-4">
                    <i class="bx {{ $layanan == 'Service Mesin' ? 'bx-wrench' : 'bx-car' }}"></i>
                    <h3>{{ $layanan == 'Service Mesin' ? 'Service Berkala A' : 'Full Body Painting' }}</h3>
                    <form action="{{ route('member.goto-tanggal') }}" method="GET">
                        @csrf
                        <input type="hidden" value="{{ $layanan == 'Service Mesin' ? 'Service Berkala A' : 'Full Body Painting' }}" name="paket">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        @if($layanan == 'Service Mesin')
                        <ul style="text-align: left; margin-left: 25px;">
                            <li>Ganti Oli</li>
                            <li>Service Ringan</li>
                        </ul>
                        @endif
                        <button class="btn-booking">Booking</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="info-box mb-4">
                    <i class="bx {{ $layanan == 'Service Mesin' ? 'bx-wrench' : 'bx-car' }}"></i>
                    <h3>{{ $layanan == 'Service Mesin' ? 'Service Berkala B' : 'Cat 1 Panel' }}</h3>
                    <form action="{{ route('member.goto-tanggal') }}" method="GET">
                        @csrf
                        <input type="hidden" value="{{ $layanan == 'Service Mesin' ? 'Service Berkala B' : 'Cat 1 Panel' }}" name="paket">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        @if($layanan == 'Service Mesin')
                        <ul style="text-align: left; margin-left: 25px;">
                            <li>Ganti Oli</li>
                            <li>Service Ringan</li>
                            <li>Service (Rem, Suspensi)</li>
                        </ul>
                        @endif
                        <button class="btn-booking">Booking</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="info-box mb-4">
                    <i class="bx {{ $layanan == 'Service Mesin' ? 'bx-wrench' : 'bx-car' }}"></i>
                    <h3>{{ $layanan == 'Service Mesin' ? 'Service Berkala C' : 'Cat 2 Panel' }}</h3>
                    <form action="{{ route('member.goto-tanggal') }}" method="GET">
                        @csrf
                        <input type="hidden" value="{{ $layanan == 'Service Mesin' ? 'Service Berkala C' : 'Cat 2 Panel' }}" name="paket">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        @if($layanan == 'Service Mesin')
                        <ul style="text-align: left; margin-left: 25px;">
                            <li>Ganti Oli</li>
                            <li>Service</li>
                            <li>Tune Up</li>
                        </ul>
                        @endif
                        <button class="btn-booking">Booking</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="info-box mb-4">
                    <i class="bx {{ $layanan == 'Service Mesin' ? 'bx-wrench' : 'bx-car' }}"></i>
                    <h3>{{ $layanan == 'Service Mesin' ? 'Service Berkala D' : 'Cat 3 Panel' }}</h3>
                    <form action="{{ route('member.goto-tanggal') }}" method="GET">
                        @csrf
                        <input type="hidden" value="{{ $layanan == 'Service Mesin' ? 'Service Berkala D' : 'Cat 3 Panel' }}" name="paket">
                        <input type="hidden" value="{{ $layanan }}" name="layanan">
                        <input type="hidden" value="{{ $jemput }}" name="jemput">
                        @if($layanan == 'Service Mesin')
                        <ul style="text-align: left; margin-left: 25px;">
                            <li>Ganti Oli</li>
                            <li>Service</li>
                            <li>Tune Up</li>
                            <li>Kuras</li>
                        </ul>
                        @endif
                        <button class="btn-booking">Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
