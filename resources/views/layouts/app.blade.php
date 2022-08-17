<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Motohid Car Repair</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/icon.png') }}" rel="icon">
    <link href="{{ asset('img/icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    @stack('before-css')
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @stack('after-css')
    <!-- =======================================================
  * Template Name: Day - v4.8.0
  * Template URL: https://bootstrapmade.com/day-multipurpose-html-template-for-free/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope-fill"></i><a href="mailto:contact@example.com">motohidcar.repair@gmail.com</a>
                <i class="bi bi-phone-fill phone-icon"></i> 0333-558912
            </div>
            <div class="social-links d-none d-md-block">
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- <h1 class="logo"><a href="{{ route('home') }}">Motohid</a></h1> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="{{ route('home') }}" class="logo"><img src="{{ asset('img/Motohid-HD.png') }}" alt=""
                    class="img-fluid"></a>

            <nav id="navbar" class="navbar">
                <ul>
                    @if(Route::is('member.booking') || Route::is('member.goto-tanggal') || Route::is('member.goto-waktu') || Route::is('member.goto-form'))
                    <li><a class="nav-link scrollto" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="nav-link scrollto active" href="#cta">Booking</a></li>
                    @else
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#cta">Booking</a></li>
                    <li><a class="nav-link scrollto" href="#services">Layanan</a></li>
                    <li><a class="nav-link scrollto " href="#pricing">Harga</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                    @endif
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li><a class="nav-link scrollto" href="{{ route('login') }}">Masuk</a></li>
                    @endif

                    @if (Route::has('register'))
                    <li><a class="nav-link scrollto" href="{{ route('register') }}">Daftar</a></li>
                    @endif
                    @else
                    <li class="dropdown">
                        <a href="#">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="bi bi-chevron-down"></i>
                        </a>

                        <ul>
                            <li>
                                <a class="dropdown-item" href="{{ route('member') }}">
                                    Member Area
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('hero')
    <main id="main">
        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>Motohid</h3>
                            <p>
                                Cantuk Lor, Cantuk, Singojuruh <br>
                                Banyuwangi 68464, Jawa Timur<br><br>
                                <strong>Phone:</strong> 0333-558912<br>
                                <strong>Email:</strong> motohidcar.repair@gmail.com<br>
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Tautan</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#hero">Beranda</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#cta">Booking</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#services">Layanan</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#pricing">Harga</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#about">Tentang</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#contact">Kontak</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Layanan Kami</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Service Mesin</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Body Repair</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Layanan Pick Up</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Book A Service</h4>
                        <p>Motohid Car Repair melayani service mesin dan body repair mobil kesayangan Anda. Booking service sekarang</p>
                        <button type="submit"
                            style="
                            background: #cc1616;
                            border: 0;
                            padding: 10px 24px;
                            color: #fff;
                            transition: 0.4s;
                            ">
                            Booking Sekarang
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Motohid</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/day-multipurpose-html-template-for-free/ -->
                Developed by <a href="#">SiMotohid</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    @stack('before-script')
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('after-script')
</body>

</html>
