@extends('layouts.auth')
@section('title','Masuk | Motohid')

@section('content')
<div class="az-signup-wrapper">
    <div class="az-column-signup-left">
        <div>
            <h1 class="az-logo"><a href="{{ route('home') }}"><img src="{{ asset('img/Motohid-HD-b.png') }}"
                        width="150px"></a></h1>
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
        <h1 class="az-logo"><a href="{{ route('home') }}"><img src="{{ asset('img/Motohid-HD-b.png') }}"
                    width="150px"></a></h1>
        <div class="az-signup-header">
            <h2>Masuk</h2>
            <h4>Tolong masuk untuk melanjutkan</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email / Username</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan email / username Anda" name="username" value="{{ old('username') }}" required
                        autocomplete="username" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password Anda" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div><!-- form-group -->

                <button type="submit" class="btn btn-danger btn-block">Masuk</button>
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Lupa Kata Sandi?
                </a>
                @endif

                <center>
                    - Atau -
                </center>

                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <a href="{{ route('google.login') }}" class="google-btn" style="color: #ffffff;">
                            <div class="btn-group" style="position: relative; width: 250px; height: 50px; background-color: #4285f4; border: 2px solid #4285f4">
                                <img src="{{ asset('img/google-logo.png') }}">
                                <span style="text-align: center; margin-top: 12px; margin-left: 30px;">Masuk dengan Google</span>
                            </div>
                        </a>
                    </div>
                </div>
            </form>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
            <p>Tidak punya akun? <a href="{{ route('register') }}">Buat sebuah akun</a></p>
        </div><!-- az-signin-footer -->
    </div><!-- az-column-signup -->
</div><!-- az-signup-wrapper -->

@push('after-script')
    <!-- SweetAlert -->
    @include('sweetalert::alert')
@endpush

@endsection
