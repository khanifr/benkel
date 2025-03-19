@include('navbar')

<!-- Product Section -->
<!-- Our Flagship Bengkel Section -->
<header class="bg-primary text-white text-center py-5">
    <div class="container">
        <br>
        <br>
        <br>
        <h1>Welcome to Our Flagship</h1>
        <p class="lead">Experience innovation and excellence</p>
    </div>
</header>

<section id="our-flagship-bengkel" class="py-5 bg-white">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="display-4">Our Flagship Bengkel</h2>
                <p class="lead">Discover our top-notch workshops designed to meet all your automotive needs.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('img/about.png') }}" class="card-img-top" alt="Bengkel 1">
                    <div class="card-body">
                        <h5 class="card-title">Bengkel Utama</h5>
                        <p class="card-text">Our main workshop equipped with state-of-the-art tools and experienced
                            technicians to handle all types of repairs and maintenance.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('img/about.png') }}" class="card-img-top" alt="Bengkel 2">
                    <div class="card-body">
                        <h5 class="card-title">Bengkel Khusus Mobil Sport</h5>
                        <p class="card-text">A specialized workshop for sports cars, offering premium services to keep
                            your high-performance vehicle in top condition.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('img/about.png') }}" class="card-img-top" alt="Bengkel 3">
                    <div class="card-body">
                        <h5 class="card-title">Bengkel Elektrik</h5>
                        <p class="card-text">Our electric vehicle workshop focuses on the latest technology to service
                            and maintain electric and hybrid cars.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="gallery" class="gallery-section py-5" style="background-color: #0d1c2e; color: white;">
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
                    <img src="img/gtr1.jpeg" class="d-block w-100 rounded shadow" alt="BMW 1">
                </div>
                <div class="carousel-item">
                    <img src="img/porche2.jpg" class="d-block w-100 rounded shadow" alt="BMW 2">
                </div>
                <div class="carousel-item">
                    <img src="img/camaro.jpg" class="d-block w-100 rounded shadow" alt="BMW 3">
                </div>
                <div class="carousel-item">
                    <img src="img/bmw7.jpeg" class="d-block w-100 rounded shadow" alt="BMW 4">
                </div>
                <div class="carousel-item">
                    <img src="img/pop.jpg" class="d-block w-100 rounded shadow" alt="BMW 5">
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
</section>

<section id="faq" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Pertanyaan yang Sering Diajukan</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Berapa jam operasional Anda?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Kami buka dari pukul 08.00 hingga 20.00 setiap hari.</div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Apakah Anda menyediakan layanan darurat?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Ya, kami menyediakan layanan darurat 24/7. Silakan hubungi kami untuk bantuan mendesak.</div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Metode pembayaran apa saja yang diterima?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Kami menerima pembayaran tunai, kartu kredit/debit, serta pembayaran digital seperti e-wallet dan transfer bank.</div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        Apakah saya perlu membuat janji temu?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Janji temu disarankan tetapi tidak wajib. Kami juga menerima pelanggan yang datang langsung.</div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        Apakah layanan yang diberikan memiliki garansi?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Ya, kami memberikan garansi untuk semua layanan. Durasi garansi tergantung pada jenis layanan yang diberikan.</div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                        Berapa lama waktu yang dibutuhkan untuk satu layanan?
                    </button>
                </h2>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Waktu pengerjaan bervariasi tergantung jenis layanan. Sebagian besar layanan selesai dalam 1 hingga 2 jam.</div>
                </div>
            </div>
        </div>
    </div>
</section>




{{-- <section id="contact" class="py-5 bg-white">
    <div class="container text-center">
        <h2>Contact Us</h2>
        <p>Have questions? Reach out to us!</p>
        <form>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Your Name">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Your Email">
            </div>
            <div class="mb-3">
                <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</section> --}}

@include('footer')
