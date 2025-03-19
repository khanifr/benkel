@extends('masterfront')

@section('contentfront')

<!-- CSS Custom -->
<style>
    /* Custom Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/bmw-about.jpg');
        background-size: cover;
        background-position: center;
        height: 80vh;
        color: white;
        text-align: center;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        animation: fadeIn 1.5s ease-in-out;
    }

    .hero h1 {
        font-size: 4.5rem;
        font-weight: bold;
        text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.6);
        animation: slideUp 1s ease-in-out;
    }

    .hero p {
        font-size: 1.8rem;
        text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.6);
        margin-top: 20px;
        animation: slideUp 1.5s ease-in-out;
    }

    /* About Section */
    .about-section {
        background: #f8f9fa;
        padding: 100px 0;
    }

    .about-section img {
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .about-section img:hover {
        transform: scale(1.05);
    }

    .about-section h2 {
        font-size: 3rem;
        font-weight: bold;
        color: #111c43;
        margin-bottom: 20px;
        animation: fadeIn 1.5s ease-in-out;
    }

    .about-section p {
        font-size: 1.2rem;
        color: #6c757d;
        line-height: 1.8;
        animation: fadeIn 2s ease-in-out;
    }

    /* Visi & Misi Section */
    .visi-misi {
        background: linear-gradient(to right, #111c43, #0d1c2e);
        color: white;
        padding: 100px 0;
    }

    .visi-misi i {
        font-size: 3rem;
        color: #ffc107;
        margin-bottom: 15px;
        animation: float 3s ease-in-out infinite;
    }

    .visi-misi h3 {
        font-weight: bold;
        font-size: 2.2rem;
        margin-bottom: 20px;
    }

    .visi-misi ul {
        list-style: none;
        padding-left: 0;
    }

    .visi-misi ul li {
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    /* Team Section */
    .team-section {
        padding: 100px 0;
        background: #f8f9fa;
    }

    .team-section h2 {
        font-size: 3rem;
        font-weight: bold;
        color: #111c43;
        margin-bottom: 40px;
        text-align: center;
    }

    .team-section .card {
        border: none;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .team-section .card:hover {
        transform: translateY(-10px);
    }

    .team-section .card img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 0 auto;
        border: 4px solid #111c43;
    }

    .team-section .card-title {
        color: #111c43;
        font-weight: bold;
        font-size: 1.5rem;
    }

    .team-section .card-text {
        color: #6c757d;
        font-size: 1.1rem;
    }

    /* Location Section */
    .location-section {
        padding: 100px 0;
        background: linear-gradient(to right, #111c43, #0d1c2e);
        color: white;
    }

    .location-section h2 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .location-section p {
        font-size: 1.2rem;
        text-align: center;
        margin-bottom: 40px;
    }

    .location-section iframe {
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    /* Contact Section */
    .contact-section {
        padding: 100px 0;
        background: #f8f9fa;
    }

    .contact-section h2 {
        font-size: 3rem;
        font-weight: bold;
        color: #111c43;
        margin-bottom: 30px;
        text-align: center;
    }

    .contact-section .form-control {
        border-radius: 10px;
        padding: 15px;
        font-size: 1.1rem;
        border: 2px solid #111c43;
    }

    .contact-section .btn-primary {
        background-color: #111c43;
        border: none;
        color: white;
        font-weight: bold;
        padding: 12px 25px;
        font-size: 1.2rem;
        transition: background-color 0.3s ease-in-out;
    }

    .contact-section .btn-primary:hover {
        background-color: #0d1c2e;
    }
</style>

<!-- Hero Section -->
<div class="hero">
    <h1 class="fw-bold">Tentang Kami</h1>
    <p>Dinoco - Keunggulan dalam Perawatan dan Perbaikan Kendaraan</p>
</div>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Siapa Kami?</h2>
                <p class="lead">
                    Dinoco adalah bengkel profesional yang berlokasi di Yogyakarta, Indonesia. Kami telah melayani pelanggan selama lebih dari 10 tahun, menyediakan perawatan dan perbaikan untuk berbagai jenis kendaraan dengan standar tertinggi. Dengan tim mekanik berpengalaman dan teknologi terbaru, kami memastikan kendaraan Anda selalu dalam kondisi prima.
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/about.png') }}" class="img-fluid rounded" alt="Tentang Bengkel">
            </div>            
        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section class="visi-misi">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 mb-4">
                <i class="fas fa-eye fa-3x"></i>
                <h3>Visi</h3>
                <p class="lead">Menjadi bengkel terbaik di Indonesia, memberikan pelayanan premium dan solusi terpercaya untuk semua jenis kendaraan Anda.</p>
            </div>
            <div class="col-md-6">
                <i class="fas fa-bullseye fa-3x"></i>
                <h3>Misi</h3>
                <ul class="lead">
                    <li>- Menyediakan layanan perawatan dan perbaikan dengan teknologi terkini.</li>
                    <li>- Memberikan pengalaman servis yang memuaskan dan transparan.</li>
                    <li>- Mengutamakan kualitas dan keamanan dalam setiap layanan.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
{{-- <section class="team-section">
    <div class="container">
        <h2>Tim Profesional Kami</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center p-4">
                    <img src="https://source.unsplash.com/150x150/?man,portrait" class="card-img-top" alt="CEO">
                    <div class="card-body">
                        <h5 class="card-title">Andi Wijaya</h5>
                        <p class="card-text">CEO & Founder</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center p-4">
                    <img src="https://source.unsplash.com/150x150/?woman,portrait" class="card-img-top" alt="Manager">
                    <div class="card-body">
                        <h5 class="card-title">Siti Rahma</h5>
                        <p class="card-text">Manager Operasional</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center p-4">
                    <img src="https://source.unsplash.com/150x150/?mechanic" class="card-img-top" alt="Lead Mechanic">
                    <div class="card-body">
                        <h5 class="card-title">Budi Santoso</h5>
                        <p class="card-text">Lead Mechanic</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- Location Section -->
{{-- <section class="location-section">
    <div class="container">
        <h2>Lokasi Kami</h2>
        <p class="lead">Kunjungi Bengkel BMW Premium di **Jakarta, Indonesia** untuk layanan terbaik!</p>
        <div class="ratio ratio-16x9">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613506864!3d-6.194741395493231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e839560a52ab!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1739773632344!5m2!1sen!2sus"
                allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section> --}}

<!-- Contact Section -->
{{-- <section class="contact-section">
    <div class="container">
        <h2>Hubungi Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Pesan" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section> --}}

@endsection