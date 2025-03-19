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
                <img src="img/dinoco.png" alt="BMW Logo" width="40" class="me-2">
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
                    <a class="nav-link text-light" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#models">Models</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#galery">Galery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#mechanic">Mechanic</a>
                </li>
            </ul>
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
                        <a class="nav-link" href="#mechanic">Booking</a>
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