<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">

    <title>@yield('title')</title>

    @stack('before-css')

    <!-- vendor css -->
    <link href="{{ asset('admin/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/azia.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <style>
        .btn-aksi-success{
            color: #0b7a1e;
            font-weight: bold;
            font-size: 20px;
        }

        .btn-aksi-primary{
            color: #0b147a;
            font-weight: bold;
            font-size: 20px;
        }

        .btn-aksi-danger{
            color: #7a0b0b;
            font-weight: bold;
            font-size: 20px;
        }

        .btn-aksi-warning{
            color: #7a6c0b;
            font-weight: bold;
            font-size: 20px;
        }

        .btn-aksi-secondary{
            color: #383835;
            font-weight: bold;
            font-size: 20px;
        }
    </style>

    @stack('after-css')
</head>

<body>
    
    <div class="az-header"> <!-- HEADER -->
        <div class="container">
            <div class="az-header-left">
                <a href="{{ route('home') }}" class="az-logo"><span></span> <img src="{{ asset('img/Motohid-HD-b.png') }}" width="150px"></a>
                <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
            </div><!-- az-header-left -->
            <div class="az-header-menu">
                <div class="az-header-menu-header">
                    <a href="index.html" class="az-logo"><span></span><img src="{{ asset('img/Motohid-HD-b.png') }}" width="150px"></a>
                    <a href="" class="close">&times;</a>
                </div><!-- az-header-menu-header -->
                
                @include('component.menu')

            </div><!-- az-header-menu -->

            <div class="az-header-right">
                <div class="dropdown az-profile-menu">
                    <a href="" class="az-img-user"><img src="{{ asset('img/logo.png') }}" alt=""></a>
                    <div class="dropdown-menu">
                        <div class="az-dropdown-header d-sm-none">
                            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                        </div>
                        <div class="az-header-profile">
                            <div class="az-img-user">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                            </div><!-- az-img-user -->
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->access == 'admin' ? 'Motohid Admin' : 'Motohid Member'}}</span>
                        </div><!-- az-header-profile -->
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Keluar</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                        </form>
                    </div><!-- dropdown-menu -->
                </div>
            </div><!-- az-header-right -->
        </div><!-- container -->
    </div><!-- az-header -->

    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">@yield('dash-title')</h2>
                        <p class="az-dashboard-text">Sistem Booking Motohid</p>
                    </div>
                    <div class="az-content-header-right">
                        <div class="media">
                            <div class="media-body">
                            <label>Hari</label>
                            <h6>{{ Carbon\Carbon::parse($date)->translatedFormat('l') }}</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                            <label>Tanggal</label>
                            <h6>{{ Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                            <label>Waktu</label>
                            <h6 id="time"></h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div>
                </div>
                <!-- Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <div class="az-footer ht-40"> <!-- FOOTER -->
        <div class="container ht-100p pd-t-0-f">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">&copy; 2022</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sistem Booking Motohid</span>
        </div><!-- container -->
    </div><!-- az-footer -->

    @stack('before-script')
    <script src="{{ asset('admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('admin/lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('admin/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admin/lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/lib/peity/jquery.peity.min.js') }}"></script>

    <script src="{{ asset('admin/js/azia.js') }}"></script>
    <script src="{{ asset('admin/js/chart.flot.sampledata.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    
    <!-- SweetAlert -->
    @include('sweetalert::alert')

    <script>
        $(document).ready(function() {
            var interval = setInterval(function() {
                var momentNow = moment();
                $('#time').html(momentNow.format('HH:mm:ss'));
            }, 100);
        });
    </script>

    <!-- Tooltip -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    @stack('after-script')
</body>

</html>
