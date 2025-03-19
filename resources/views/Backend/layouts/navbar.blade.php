<aside class="app-sidebar sticky" id="sidebar">
    <div class="main-sidebar-header">
        <img src="{{ asset('img/dinoco.png') }}" class="header-logo" alt="Logo">
    </div>

    <style>
        .header-logo {
            width: 100%;
            /* Atur lebar gambar sesuai dengan lebar kontainer */
            max-width: 65px;
            /* Tentukan batas maksimal lebar gambar */
            height: auto;
            /* Memastikan gambar proporsional */
            object-fit: contain;
            /* Menjaga rasio aspek gambar */
        }
    </style>


    <div class="main-sidebar" id="sidebar-scroll">
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <ul class="main-menu">
                <!-- Category: CRUD -->
                <li class="slide__category"><span class="category-name">Admin Rust-eze</span></li>

                <!-- Settings Dropdown -->
                <li class="slide">
                    <a href="#" class="side-menu__item" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-circle side-menu__icon"></i> <!-- Ikon User -->
                        <span class="side-menu__label">{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down ms-auto"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fa-solid fa-user me-2"></i> {{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="fa-solid fa-sign-out-alt me-2"></i> {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

                <!-- Dashboard -->
                <li class="slide">
                    <a href="{{ route('dashboard') }}" class="side-menu__item">
                        <i class="fa-solid fa-tachometer-alt side-menu__icon"></i> <!-- Ikon Dashboard -->
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <!-- Pelanggan -->
                <li class="slide">
                    <a href="{{ route('pelanggan.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-user side-menu__icon"></i> <!-- Ikon Pelanggan -->
                        <span class="side-menu__label">Pelanggan</span>
                    </a>
                </li>

                <!-- Kendaraan -->
                <li class="slide">
                    <a href="{{ route('kendaraan.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-motorcycle side-menu__icon"></i> <!-- Ikon Motor -->
                        <span class="side-menu__label">Kendaraan</span>
                    </a>
                </li>

                <!-- Jasa Servis -->
                <li class="slide">
                    <a href="{{ route('jasa_servis.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-tools side-menu__icon"></i> <!-- Ikon Jasa Servis -->
                        <span class="side-menu__label">Jasa Servis</span>
                    </a>
                </li>

                <!-- Booking -->
                <li class="slide">
                    <a href="{{ route('booking.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-calendar-check side-menu__icon"></i> <!-- Ikon Booking -->
                        <span class="side-menu__label">Booking</span>
                    </a>
                </li>

                <!-- Sparepart -->
                <li class="slide">
                    <a href="{{ route('sparepart.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-wrench side-menu__icon"></i> <!-- Ikon Sparepart -->
                        <span class="side-menu__label">Sparepart</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('karyawan.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-users side-menu__icon"></i> <!-- Ikon Karyawan -->
                        <span class="side-menu__label">Karyawan</span>
                    </a>
                </li>

                <!-- Karyawan -->
                <li class="slide">
                    <a href="{{ route('riwayat.index') }}" class="side-menu__item">
                        <i class="fa-solid fa-history side-menu__icon"></i> <!-- Ikon Karyawan -->
                        <span class="side-menu__label">Riwayat</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>