@extends('masterfront')

@section('contentfront')

<style>
    .history-btn:hover {
        background-color: yellow !important;
        color: black !important;
        border-color: yellow !important;
    }
</style>

<!-- Hero Section -->
<section id="home" class="hero-section"
    style="background-image: url('img/2.png'); no-repeat center center; background-size: cover; backdrop-filter: blur(50px);">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="display-4 text-white">
                    Experience the Ultimate Workshop Performance
                    {{-- Rasakan Perfoma Bengkel Terbaik --}}
                </h1>
                <p class="lead text-white">Temukan Perbaikan dan Inovasi Terbaru.</p>
                {{-- <a href="#models" class="btn btn-outline-light btn-lg mt-3">Explore Models</a> --}}

                @auth('pelanggan')
                <a href="{{ route('pelanggan.riwayat') }}" class="btn btn-outline-light btn-lg mt-3 history-btn">History Service</a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Layanan Kami Section -->
<section id="layanan" class="layanan-section py-5" style="background-color: #f8f9fa;">
    <div class="container text-center">
        <h2 class="mb-5">Service</h2>
        <div class="row justify-content-center">
            <div class="col-md-4 col-12 mb-4">
                <i class="fas fa-wrench fa-4x mb-3"></i>
                <p class="mt-2">Vehicle Services.</p>
                <a href="{{ route("layanan") }}" class="btn btn-outline-dark mt-2">Lihat Lainnya</a>
            </div>
            <div class="col-md-4 col-12 mb-4">
                <i class="fas fa-cogs fa-4x mb-3"></i>
                <p class="mt-2">Machine Repair.</p>
                <a href="{{ route("layanan") }}" class="btn btn-outline-dark mt-2">Lihat Lainnya</a>
            </div>
            <div class="col-md-4 col-12">
                <i class="fas fa-tachometer-alt fa-4x mb-3"></i>
                <p class="mt-2">Tire Replacement.</p>
                <a href="{{ route("layanan") }}" class="btn btn-outline-dark mt-2">Lihat Lainnya</a>
            </div>
        </div>
    </div>
</section>

<!-- Unggulan -->
<section class="hero-section2" style=" background-image: url('img/1.png'); no-repeat center center;">
    <div class="container hero-overlay text-white text-start">
        <h1 class="fw-bold">Our Flagship</h1>
        <p class="fs-5">Keunggulan dalam Setiap Layanan, Kepercayaan dalam Setiap Perbaikan</p>
        <a href="{{ route("unggulan") }}" class="btn btn-outline-light px-4 py-2">Lihat Lainnya</a>
    </div>
</section>

<!-- Mechanics Section -->
{{-- <div class="container py-5">
    <h2 class="text-center mb-5" style="color: #111c43; letter-spacing: 1px;">
        Our Mechanic
    </h2>
    <div class="row g-4 justify-content-center">
        @foreach($karyawans as $karyawan)
            <div class="col-lg-4 col-md-6">
                <div class="mechanic text-center">
                    <div class="mechanic-img">
                        @if($karyawan->foto)
                            <img src="{{ asset('storage/' . $karyawan->foto) }}" alt="{{ $karyawan->nama }}"
                                class="rounded-circle mechanic-photo">
                        @else
                            <img src="{{ asset('img/yanto.jpg') }}" alt="Default Mekanik" class="rounded-circle mechanic-photo">
                        @endif
                    </div>
                    <div class="mechanic-info">
                        <h5 class="mt-3 text-dark fw-bold">{{ $karyawan->nama }}</h5>
                        <div class="mechanic-line"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
</div> --}}



<!-- Gallery Section -->
{{-- <section id="gallery" class="gallery-section py-5">
    <div class="container">
        <h2 class="text-center text-white mb-5">Gallery</h2>

        <div id="bmwCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#bmwCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#bmwCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#bmwCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#bmwCarousel" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#bmwCarousel" data-bs-slide-to="4"></button>
            </div>

            <!-- Slide Images -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/1.png" class="d-block w-100 rounded shadow" alt="BMW 1">
                </div>
                <div class="carousel-item">
                    <img src="img/about.png" class="d-block w-100 rounded shadow" alt="BMW 2">
                </div>
                <div class="carousel-item">
                    <img src="img/3.jpeg" class="d-block w-100 rounded shadow" alt="BMW 3">
                </div>
                <div class="carousel-item">
                    <img src="img/4.jpg" class="d-block w-100 rounded shadow" alt="BMW 4">
                </div>
                <div class="carousel-item">
                    <img src="img/2.png" class="d-block w-100 rounded shadow" alt="BMW 5">
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#bmwCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bmwCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section> --}}

<!-- About Section -->
<section id="about" class="about-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">About</h2>
        <div class="row align-items-center">
            <div class="col-md-6 col-12 order-md-1 order-2">
                <div class="about-text py-3 text-md-start">
                    <p class="lead">Dinoco adalah penyedia layanan perbaikan dan perawatan kendaraan yang terpercaya. Didirikan dengan komitmen terhadap kualitas, bengkel kami memiliki sejarah panjang dalam keahlian dan keunggulan di industri otomotif.</p>
                    <p>Misi kami adalah memberikan layanan perbaikan dan perawatan kendaraan terbaik melalui teknologi terkini, keahlian profesional, dan praktik yang berkelanjutan.</p>
                    <a href="{{ route("about") }}" class="btn btn-primary mt-3">Lihat Lebih Banyak</a>
                </div>
            </div>
            <div class="col-md-6 col-12 order-md-2 order-1 text-center">
                <div class="about-image">
                    <img src="img/about.png" class="img-fluid rounded shadow" alt="BMW Factory">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section - BMW Theme -->
<!-- <section id="contact" class="contact-section py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <h2 class="text-center mb-5">Contact Us</h2>
        <div class="row align-items-center">
            
            <div class="col-md-6 col-12">
                <div class="p-4 rounded shadow-lg bg-white">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6 col-12 mt-4 mt-md-0">
                <div class="rounded shadow-lg overflow-hidden position-relative">
                    <div class="position-absolute top-50 start-50 translate-middle text-center text-white p-3"
                        style="background: rgba(0, 114, 206, 0.7); border-radius: 8px;">
                        <p class="mb-0">Lokasi Kami</p>
                    </div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.923391999499!2d107.6101573153735!3d-6.897895769411822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64a3c3f7a3f%3A0x4e1f3b9f5f8f8f8f!2sAnip%20Garage!5e0!3m2!1sid!2sid!4v1621234567890!5m2!1sid!2sid"
                        width="100%" height="435" style="border: 0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section> -->


@endsection