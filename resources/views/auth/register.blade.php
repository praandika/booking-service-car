@extends('layouts.auth')
@section('title','Daftar | Motohid')

@section('content')
<div class="az-signup-wrapper">
    <div class="az-column-signup-left">
        <div>
            <h1 class="az-logo"><a href="{{ route('home') }}"><img src="{{ asset('img/Motohid-HD-b.png') }}" width="150px"></a></h1>
            <h5>Bengkel Mobil Motohid</h5>
            <p>Bengkel mobil motohid (pak tauhid) (Perbaikan mobil) berlokasi di Jawa Timur, Indonesia.
                Daerah atau landmark terdekat adalah Singojuruh.
                Alamat Bengkel mobil motohid (pak tauhid) Cantuk Lor, Cantuk, Singojuruh, Kabupaten Banyuwangi, Jawa
                Timur 68464, Indonesia</p>
            <p>Address <br>
                Cantuk Lor, Cantuk, Singojuruh,
                Kabupaten Banyuwangi, Jawa Timur 68464,
                Indonesia</p>
        </div>
    </div><!-- az-column-signup-left -->
    <div class="az-column-signup">
        <h1 class="az-logo"><a href="{{ route('home') }}"><img src="{{ asset('img/Motohid-HD-b.png') }}" width="150px"></a></h1>
        <div class="az-signup-header">
            <h2>Memulai</h2>
            <h4>Ini gratis untuk mendaftar dan hanya membutuhkan waktu satu menit.</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label>Nama Depan &amp; Nama Belakang</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama depan dan nama belakang Anda" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan email Anda" name="email" value="{{ old('email') }}" required
                        autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan kata sandi Anda" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control"
                        placeholder="Konfirmasi kata sandi Anda" name="password_confirmation" required
                        autocomplete="new-password">
                </div><!-- form-group -->
                <button type="submit" class="btn btn-az-primary btn-block">Buat Akun</button>

                <hr>

                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <a href="{{ route('google.login') }}" style="text-align: center;">
                            <img src="{{ asset('img/btn_google_signin_dark_normal_web.png') }}" style="margin-left: 3em;">
                        </a>
                    </div>
                </div>
            </form>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
            <p>Sudah memiliki akun? <a href="{{ route('login') }}">Masuk</a></p>
        </div><!-- az-signin-footer -->
    </div><!-- az-column-signup -->
</div><!-- az-signup-wrapper -->
@endsection
