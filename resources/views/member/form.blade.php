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

        .input-group{
            position: relative;
        }

        #otherBrand,
        #pilihBrand,
        #otherType,
        #pilihType{
            position: absolute;
            right: 0;
            background-color: #cc1616;
            color: #fff;
            font-weight: bold;
            padding: 7px;
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
                        <div class="input-group">
                        <select name="brand" id="brandSelect" class="form-control" @if($phone) autofocus @endif required>
                            <option value="Toyota">Toyota</option>
                            <option value="Daihatsu">Daihatsu</option>
                            <option value="Honda">Honda</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Mitsubishi">Mitsubishi</option>
                            <option value="Nissan">Nissan</option>
                            <option value="Wuling">Wuling</option>
                            <option value="Mazda">Mazda</option>
                            <option value="Datsun">Datsun</option>
                            <option value="Hyundai">Hyundai</option>
                        </select>
                        <input type="text" id="brandInput" class="form-control" placeholder="Cth: Toyota" @if($phone) autofocus @endif hidden>
                        <a href="#" id="otherBrand">Lainnya</a>
                        <a href="#" id="pilihBrand" hidden>Pilih Brand</a>
                        </div>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <label for="">Tipe Mobil</label>
                        <div class="input-group">
                        <select name="type" id="typeSelect" class="form-control" required>
                            <option value="Raize">Raize</option>
                            <option value="Avanza">Avanza</option>
                            <option value="Yaris">Yaris</option>
                            <option value="Veloz">Veloz</option>
                            <option value="Agya">Agya</option>
                            <option value="Calya">Calya</option>
                            <option value="Rocky">Rocky</option>
                            <option value="Ayla">Ayla</option>
                            <option value="Sigra">Sigra</option>
                            <option value="Xenia">Xenia</option>
                            <option value="Terios">Terios</option>
                            <option value="Grand Max">Grand Max</option>
                            <option value="Brio">Brio</option>
                            <option value="BR-V">BR-V</option>
                            <option value="HR-V">HR-V</option>
                            <option value="Jazz">Jazz</option>
                            <option value="Mobilio">Mobilio</option>
                            <option value="Civic">Civic</option>
                            <option value="Ertiga">Ertiga</option>
                            <option value="Baleno">Baleno</option>
                            <option value="Ignis">Ignis</option>
                            <option value="Jimny">Jimny</option>
                            <option value="APV">APV</option>
                            <option value="Carry">Carry</option>
                            <option value="Xpander">Xpander</option>
                            <option value="Pajero">Pajero</option>
                            <option value="Outlander">Outlander</option>
                            <option value="Triton">Triton</option>
                            <option value="L300">L300</option>
                            <option value="March">March</option>
                            <option value="Livina">Livina</option>
                            <option value="Magnite">Magnite</option>
                            <option value="Juke">Juke</option>
                            <option value="Serena">Serena</option>
                            <option value="Terra">Terra</option>
                            <option value="Almaz">Almaz</option>
                            <option value="Air">Air</option>
                            <option value="Cortez">Cortez</option>
                            <option value="Confero">Confero</option>
                            <option value="Formo">Formo</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="CX 5">CX 5</option>
                            <option value="CX 9">CX 9</option>
                            <option value="6">6</option>
                            <option value="CX 8">CX 8</option>
                            <option value="Go">Go</option>
                            <option value="Go Plus">Go Plus</option>
                            <option value="Cross">Cross</option>
                            <option value="Creta">Creta</option>
                            <option value="Santa Fe">Santa Fe</option>
                            <option value="Ioniq">Ioniq</option>
                            <option value="Staria">Staria</option>
                        </select>
                        <input type="text" id="typeInput" class="form-control" placeholder="Cth: Avanza" hidden>
                        <a href="#" id="otherType">Lainnya</a>
                        <a href="#" id="pilihType" hidden>Pilih Tipe</a>
                        </div>
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
                        <select name="year" id="typeSelect" class="form-control" required>
                        {{ $last= date('Y')-120 }}
                        {{ $now = date('Y') }}

                        @for ($i = $now; $i >= $last; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        </select>
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

@push('after-script')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $("#otherBrand").click(function(){
            $("#brandInput").removeAttr("hidden");
            $("#brandInput").attr({name:"brand", required:true});
            $("#brandSelect").attr("hidden","hidden");
            $("#brandSelect").removeAttr("name");
            $("#brandSelect").removeAttr("required");
            $("#otherBrand").attr("hidden","hidden");
            $("#pilihBrand").removeAttr("hidden");
        });
    </script>

    <script>
        $("#pilihBrand").click(function(){
            $("#brandSelect").removeAttr("hidden");
            $("#brandSelect").attr({name:"brand", required:true});
            $("#brandInput").attr("hidden","hidden");
            $("#brandInput").removeAttr("name");
            $("#brandInput").removeAttr("required");
            $("#pilihBrand").attr("hidden","hidden");
            $("#otherBrand").removeAttr("hidden");
        });
    </script>

    <script>
        $("#otherType").click(function(){
            $("#typeInput").removeAttr("hidden");
            $("#typeInput").attr({name:"type", required:true});
            $("#typeSelect").attr("hidden","hidden");
            $("#typeSelect").removeAttr("name");
            $("#typeSelect").removeAttr("required");
            $("#otherType").attr("hidden","hidden");
            $("#pilihType").removeAttr("hidden");
        });
    </script>

    <script>
        $("#pilihType").click(function(){
            $("#typeSelect").removeAttr("hidden");
            $("#typeSelect").attr({name:"type", required:true});
            $("#typeInput").attr("hidden","hidden");
            $("#typeInput").removeAttr("name");
            $("#typeInput").removeAttr("required");
            $("#pilihType").attr("hidden","hidden");
            $("#otherType").removeAttr("hidden");
        });
    </script>
@endpush