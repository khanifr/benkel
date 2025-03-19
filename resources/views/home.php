<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rust-eze - Bengkel Profesional</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- style -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body>

    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Logo dan Nama Brand -->
            <a class="navbar-brand" href="#">
                <img src="/img/petirr.png" alt="Anip Garage Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Rust-eze
            </a>
            <!-- Tombol Toggler untuk Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-background"></div> <!-- Elemen untuk background -->
        <div class="container">
            <h1 class="display-4">Selamat Datang di Anip Garage</h1>
            <p class="lead">Bengkel Profesional untuk Semua Kebutuhan Kendaraan Anda</p>
            <a href="#services" class="btn btn-primary btn-lg">Lihat Layanan Kami</a>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="services" class="services-section">
        <div class="container">
            <h2 class="text-center mb-5">Layanan Kami</h2>
            <div class="row g-4">
                <!-- Layanan 1: Servis Rutin -->
                <div class="col-md-4">
                    <div class="card service-card text-center p-4 h-100">
                        <div class="service-icon mb-3">
                            <i class="fas fa-tools fa-3x"></i> <!-- Ikon dari FontAwesome -->
                        </div>
                        <h3 class="card-title">Servis Rutin</h3>
                        <img src="/img/ninja.jpg" alt="">
                        <br>
                        <p class="card-text">
                            Layanan servis rutin untuk menjaga performa kendaraan Anda tetap optimal.
                        </p>
                        <a href="#" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
                <!-- Layanan 2: Perbaikan Mesin -->
                <div class="col-md-4">
                    <div class="card service-card text-center p-4 h-100">
                        <div class="service-icon mb-3">
                            <i class="fas fa-cogs fa-3x"></i> <!-- Ikon dari FontAwesome -->
                        </div>
                        <h3 class="card-title">Perbaikan Mesin</h3>
                        <img src="/img/ninja.jpg" alt="">
                        <br>
                        <p class="card-text">
                            Perbaikan mesin oleh teknisi berpengalaman dengan peralatan modern.
                        </p>
                        <a href="#" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
                <!-- Layanan 3: Ganti Oli -->
                <div class="col-md-4">
                    <div class="card service-card text-center p-4 h-100">
                        <div class="service-icon mb-3">
                            <i class="fas fa-oil-can fa-3x"></i> <!-- Ikon dari FontAwesome -->
                        </div>
                        <h3 class="card-title">Ganti Oli</h3>
                        <img src="/img/ninja.jpg" alt="">
                        <br>
                        <p class="card-text">
                            Ganti oli dengan produk terbaik untuk menjaga performa mesin kendaraan Anda.
                        </p>
                        <a href="#" class="btn btn-outline-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="text-center mb-5">Tentang Kami</h2>
            <div class="row align-items-center">
                <!-- Gambar -->
                <div class="col-md-6">
                    <div class="about-img-wrapper">
                        <img src="/img/dualimapuluh.png" class="about-img img-fluid" alt="Tentang Kami">
                        <div class="about-img-overlay">
                            <p>Lebih dari 10 Tahun Pengalaman</p>
                        </div>
                    </div>
                </div>
                <!-- Konten Teks -->
                <div class="col-md-6">
                    <div class="about-content">
                        <h3 class="about-title">Kenapa Memilih Anip Garage?</h3>
                        <p class="about-text">
                            Anip Garage adalah bengkel profesional yang telah melayani pelanggan selama lebih dari 10
                            tahun.
                            Kami menawarkan berbagai layanan untuk memastikan kendaraan Anda selalu dalam kondisi
                            terbaik.
                        </p>
                        <p class="about-text">
                            Dengan tim teknisi yang berpengalaman dan peralatan modern, kami siap memberikan solusi
                            terbaik
                            untuk semua masalah kendaraan Anda.
                        </p>
                        <ul class="about-list">
                            <li><i class="fas fa-check-circle"></i> Teknisi Bersertifikat</li>
                            <li><i class="fas fa-check-circle"></i> Peralatan Modern</li>
                            <li><i class="fas fa-check-circle"></i> Garansi Layanan</li>
                        </ul>
                        <a href="#contact" class="btn btn-primary">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Technician Section -->
    <section id="technician" class="technician-section">
        <div class="container">
            <h2 class="text-center mb-5">Tim Teknisi Kami</h2>
            <div class="row g-4">
                <!-- Teknisi 1 -->
                <div class="col-md-4">
                    <div class="card technician-card">
                        <img src="/img/mekanik.jpeg" alt="Teknisi 1" class="technician-img">
                        <div class="technician-overlay">
                            <h3 class="technician-name">John Doe</h3>
                            <p class="technician-role">Spesialis Mesin Motor</p>
                            <p class="technician-description">
                                John memiliki pengalaman lebih dari 10 tahun dalam memperbaiki mesin motor. Ia ahli
                                dalam menangani masalah mesin kompleks.
                            </p>
                            <div class="technician-skills">
                                <span class="badge bg-primary">Mesin Motor</span>
                                <span class="badge bg-primary">Tune-Up</span>
                                <span class="badge bg-primary">Perawatan Rutin</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Teknisi 2 -->
                <div class="col-md-4">
                    <div class="card technician-card">
                        <img src="/img/mekanik.jpeg" alt="Teknisi 2" class="technician-img">
                        <div class="technician-overlay">
                            <h3 class="technician-name">Jane Smith</h3>
                            <p class="technician-role">Spesialis Kelistrikan</p>
                            <p class="technician-description">
                                Jane adalah ahli dalam sistem kelistrikan kendaraan. Ia mampu mendiagnosis dan
                                memperbaiki masalah kelistrikan dengan cepat.
                            </p>
                            <div class="technician-skills">
                                <span class="badge bg-primary">Kelistrikan</span>
                                <span class="badge bg-primary">Diagnosis</span>
                                <span class="badge bg-primary">Perbaikan Cepat</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Teknisi 3 -->
                <div class="col-md-4">
                    <div class="card technician-card">
                        <img src="/img/mekanik.jpeg" alt="Teknisi 3" class="technician-img">
                        <div class="technician-overlay">
                            <h3 class="technician-name">Michael Lee</h3>
                            <p class="technician-role">Spesialis Body Repair</p>
                            <p class="technician-description">
                                Michael ahli dalam memperbaiki body kendaraan. Ia mampu mengembalikan body kendaraan
                                seperti baru setelah mengalami kerusakan.
                            </p>
                            <div class="technician-skills">
                                <span class="badge bg-primary">Body Repair</span>
                                <span class="badge bg-primary">Cat Ulang</span>
                                <span class="badge bg-primary">Denting</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="text-center mb-5">Kontak Kami</h2>
            <div class="row">
                <!-- Form Kontak (Kiri) -->
                <div class="col-md-6">
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
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>
                <!-- Peta (Kanan) -->
                <div class="col-md-6">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.923391999499!2d107.6101573153735!3d-6.897895769411822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64a3c3f7a3f%3A0x4e1f3b9f5f8f8f8f!2sAnip%20Garage!5e0!3m2!1sid!2sid!4v1621234567890!5m2!1sid!2sid"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center py-4">
        <div class="container">
            <p>&copy; 2023 Anip Garage. All Rights Reserved.</p>
            <p>
                <a href="#home" class="text-decoration-none">Home</a> |
                <a href="#services" class="text-decoration-none">Layanan</a> |
                <a href="#about" class="text-decoration-none">Tentang Kami</a> |
                <a href="#contact" class="text-decoration-none">Kontak</a>
            </p>
        </div>
    </footer>










    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>