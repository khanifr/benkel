<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinoco - Bengkel Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- style -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">


    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">


    <!-- Navbar -->
    <nav class="navbar navbar-dark fixed-top d-lg-none"
        style="background: rgba(0, 0, 0, 0.85); box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('img/dinoco.png') }}" alt="BMW Logo" width="40" class="me-2">
                <span class="fw-bold text-uppercase text-light"
                    style="letter-spacing: 3px; font-size: 1.2rem;">Dinoco</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel" style="width: 250px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-light" id="sidebarMenuLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route("about") }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route("layanan") }}">Service</a>
                </li>
                <li class="nav-item">
                    @auth('pelanggan')
                    <a class="nav-link text-light" href="{{ route("booking.pelanggan.index") }}">Booking</a>
                    @else
                    <a class="nav-link text-light" href="{{ route("pelanggan.login") }}">Booking</a>
                    @endauth
                </li>
            </ul>
            <br>
            <hr class="dropdown-divider bg-light">
            @auth('pelanggan')
            <div class="d-grid gap-3 text-center">
                <p class="text-light fw-bold">Halo, {{ Auth::guard('pelanggan')->user()->nama }}</p>
                
                <a class="dropdown-item text-light" href="{{ route('pelanggan.profile') }}"
                    style="transition: 0.3s; border-radius: 8px; background: #1A1A1A; padding: 10px;"
                    onmouseover="this.style.background='white'; this.style.color='black'"
                    onmouseout="this.style.background='#1A1A1A'; this.style.color='white'">
                    <i class="fas fa-user-circle me-2"></i> Profil
                </a>
        
                <a class="btn" href="{{ route('pelanggan.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    style="border-radius: 8px; transition: 0.3s; background: red; color: white; font-weight: 500; padding: 10px; border: 1px solid white;"
                    onmouseover="this.style.background='darkred'; this.style.color='white'"
                    onmouseout="this.style.background='red'; this.style.color='white'">
                    Logout
                </a>
        
                <form id="logout-form" action="{{ route('pelanggan.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @else
            <div class="d-grid gap-3">
                <a class="btn" href="{{ route('pelanggan.login') }}"
                    style="border-radius: 8px; transition: 0.3s; background: #111111; color: white; font-weight: 500; padding: 10px; border: 1px solid white;"
                    onmouseover="this.style.background='white'; this.style.color='black'"
                    onmouseout="this.style.background='#111111'; this.style.color='white'">
                    Login
                </a>
                <a class="btn" href="{{ route('pelanggan.register') }}"
                    style="border-radius: 8px; transition: 0.3s; background: white; color: black; font-weight: bold; padding: 10px; border: 1px solid #111111;"
                    onmouseover="this.style.background='#111111'; this.style.color='white'"
                    onmouseout="this.style.background='white'; this.style.color='black'">
                    Register
                </a>
            </div>
        @endauth
        
        
        </div>
    </div>


    

    <!-- Desktop Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top d-none d-lg-flex"
        style="background: rgba(0, 0, 0, 0.85); box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);">
        <div class="container d-flex justify-content-between align-items-center px-4">
            <div class="d-flex align-items-center">
                <a class="navbar-brand d-flex align-items-center me-4" href="#">
                    <img src="{{ asset('img/dinoco.png') }}" alt="BMW Logo" width="45" class="me-2">
                    <span class="fw-bold text-uppercase text-light"
                        style="letter-spacing: 3px; font-size: 1.2rem;"></span>
                </a>
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route("about") }}">About</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route("layanan") }}">Service</a>
                    </li>

                    <li class="nav-item me-3">
                        @auth('pelanggan')
                            <a class="nav-link" href="{{ route('booking.pelanggan.index') }}">Booking</a>
                        @else
                            <a class="nav-link" href="{{ route('pelanggan.login') }}">Booking</a>
                        @endauth
                    </li>

                    <li class="nav-item me-3">
                        @auth('pelanggan')
                            <a class="nav-link" href="{{ route('pelanggan.riwayat') }}">History Service</a>
                        @endauth
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route("maps") }}" class="nav-link text-light me-3">
                    <i class="fas fa-map-marker-alt fa-lg"></i>
                </a>
                @auth('pelanggan')
                <div class="dropdown">
                    <a href="#" class="nav-link text-light dropdown-toggle" id="userMenu" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Halo, {{ Auth::guard('pelanggan')->user()->nama }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3 shadow-lg rounded border-0"
                        aria-labelledby="userMenu"
                        style="min-width: 200px; background: #1A1A1A; border-radius: 12px; animation: fadeIn 0.3s ease-in-out; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);">
                        <li>
                            <a class="dropdown-item text-light" href="
                            {{ route('pelanggan.profile') }}
                             "
                                style="transition: 0.3s; border-radius: 8px;"
                                onmouseover="this.style.background='white'; this.style.color='black'"
                                onmouseout="this.style.background='#1A1A1A'; this.style.color='white'">
                                <i class="fas fa-user-circle me-2"></i> Profil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider bg-light"></li>
                        <li>
                            <a class="dropdown-item text-light" href="{{ route('pelanggan.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                style="transition: 0.3s; border-radius: 8px;"
                                onmouseover="this.style.background='red'; this.style.color='white'"
                                onmouseout="this.style.background='#1A1A1A'; this.style.color='white'">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('pelanggan.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
    @else
        <div class="dropdown">
                    <a href="#" class="nav-link text-light user-icon" id="userMenu" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-4 shadow-lg rounded border-0"
                        aria-labelledby="userMenu"
                        style="min-width: 320px; background: #1A1A1A; border-radius: 12px; animation: fadeIn 0.3s ease-in-out; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);">
                        <div class="text-center">
                            <h5 class="text-light mb-3 fw-bold">Welcome to Dinoco</h5>
                            <p class="text-light small">Enjoy a premium experience by logging in or signing up.</p>
                            <hr class="dropdown-divider bg-light">
                            <div class="d-grid gap-3">
                                <a class="btn" href="{{ route('pelanggan.login') }}"
                                    style="border-radius: 8px; transition: 0.3s; background: #111111; color: white; font-weight: 500; padding: 10px; border: 1px solid white;"
                                    onmouseover="this.style.background='white'; this.style.color='black'"
                                    onmouseout="this.style.background='#111111'; this.style.color='white'">
                                    Login
                                </a>
                                <a class="btn" href="{{ route('pelanggan.register') }}"
                                    style="border-radius: 8px; transition: 0.3s; background: white; color: black; font-weight: bold; padding: 10px; border: 1px solid #111111;"
                                    onmouseover="this.style.background='#111111'; this.style.color='white'"
                                    onmouseout="this.style.background='white'; this.style.color='black'">
                                    Register
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    @endauth
                
            </div>
        </div>
    </nav>




    @yield('contentfront')




<!-- Footer -->
<footer class="text-light py-5" style="background: #111111; border-top: 3px solid #0066b2;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text">Dinoco Bengkel</h5>
                <p class="small">Melayani perawatan dan perbaikan kendaraan dengan standar profesional dan teknologi
                    terkini.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-light footer-social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="#home" class="text-light text-decoration-none footer-link">Home</a></li>
                    <li><a href="#models" class="text-light text-decoration-none footer-link">About</a></li>
                    <li><a href="#about" class="text-light text-decoration-none footer-link">Service</a></li>
                    <li><a href="#about" class="text-light text-decoration-none footer-link">Booking</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text">Hubungi Kami</h5>
                <p class="small"><i class="fas fa-map-marker-alt"></i> Jl. Raya Otomotif No.99, Yogyakarta</p>
                <p class="small"><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                <p class="small"><i class="fas fa-envelope"></i> dinoco@gmail.com</p>
            </div>
        </div>
        <hr class="bg-light">
        <div class="text-center small">
            <p class="m-0">&copy; 2025 Dinoco Bengkel. All Rights Reserved.</p>
        </div>
    </div>
</footer>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="script.js"></script>


<script>
    // NAVBAR WOI
    document.getElementById("userMenu").addEventListener("click", function (event) {
        event.preventDefault();
        let dropdown = document.getElementById("userDropdown");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        } else {
            dropdown.style.display = "block";
        }
    });

    document.addEventListener("click", function (event) {
        let userMenu = document.getElementById("userMenu");
        let dropdown = document.getElementById("userDropdown");
        if (!userMenu.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
</script>

<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>


</body>

</html>