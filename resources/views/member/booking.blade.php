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
            border: 2px solid #000;
            color: #fff;
            background: #cc1616;
            }

            .btn-booking:hover {
            background: #fff;
            border: 2px solid #fff;
            color: #cc1616;
        }
    </style>
@endpush

<section id="services" class="services">
    <div class="container">

        <div class="section-title">
            <span>Pilih Layanan</span>
            <h2>Pilih Layanan</h2>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="icon-box">
                    <div class="icon"><i class="bx bxs-cog"></i></div>
                    <h4><a href="">Servis Mesin</a></h4>
                    <p>Teknisi handal siap untuk memperbaiki segala masalah mesin mobil Anda</p>
                    <form action="{{ route('member.goto-paket') }}" method="GET">
                        @csrf
                        @if($jemput == 1)
                        <input type="hidden" name="jemput" value="1">
                        @endif
                        <input type="hidden" value="Service Mesin" name="layanan">
                        <button class="btn-booking">Booking</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up"
                data-aos-delay="150">
                <div class="icon-box">
                    <div class="icon"><i class="bx bx-car"></i></div>
                    <h4><a href="">Body Repair</a></h4>
                    <p>Memperbaiki body mobil Anda dari lecet ringan hingga berat</p>
                    <form action="{{ route('member.goto-paket') }}" method="GET">
                        @csrf
                        @if($jemput == 1)
                        <input type="hidden" name="jemput" value="1">
                        @endif
                        <input type="hidden" value="Body Repair" name="layanan">
                        <button class="btn-booking">Booking</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
