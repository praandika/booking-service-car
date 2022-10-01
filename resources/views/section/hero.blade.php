<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
        <h1>Selamat Datang di Motohid</h1>
        <h2>Melayani service mesin dan body repair mobil kesayangan Anda</h2>
        @if(Auth::check())
            <a href="{{ route('member.booking') }}" class="btn-get-started scrollto">Booking Service</a>
        @endif
    </div>
</section><!-- End Hero -->
