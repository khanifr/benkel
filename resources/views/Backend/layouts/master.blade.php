<!DOCTYPE html>
<html lang="en">


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dinoco | Admin</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/jqvmap/jqvmap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* Custom Pagination */
    btn-action {
        padding: 5px 10px;
        font-size: 14px;
    }

    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: space-between;
    }

    .dataTables_wrapper .dataTables_filter {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    #pelangganTable_filter,
    #kendaraanTable_filter,
    #jasaServisTable_filter,
    #bookingTable_filter,
    #sparepartTable_filter,
    #karyawanTable_filter,
    #riwayatTable_filter,
    #pelangganTable_paginate,
    #kendaraanTable_paginate,
    #jasaServisTable_paginate,
    #bookingTable_paginate,
    #sparepartTable_paginate,
    #karyawanTable_paginate,
    #riwayatTable_paginate {
        display: flex;
        justify-content: end;
    }

    #pelangganTable_length,
    #kendaraanTable_length,
    #kendaraanTable_length,
    #jasaServisTable_length,
    #bookingTable_length,
    #sparepartTable_length,
    #karyawanTable_length,
    #riwayatTable_length {
        width: 18.5vh;
    }

    @media (max-width: 768px) {

        #pelangganTable_filter,
        #kendaraanTable_filter,
        #jasaServisTable_filter,
        #bookingTable_filter,
        #sparepartTable_filter,
        #karyawanTable_filter,
        #riwayatTable_filter {
            display: inline-block;
            width: 48%;
            /* Atur lebar sesuai kebutuhan */
            vertical-align: middle;
        }
    }
</style>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">



        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Settings Dropdown -->
                <li class="nav-item dropdown">
                    <a style="color: #1ABC9C;" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="nav-icon fa-solid fa-user-circle"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a style="color: black;" href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="nav-icon fa-solid fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="nav-icon fa-solid fa-sign-out-alt"></i> Log Out
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <aside style="background-color: #003C71;" class="main-sidebar elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('img/dinoco.png') }}" alt="DINOCO Logo" class="brand-image"
                    style="opacity: .8; max-width: 80px; height: auto;">

                <span class="brand-text"
                    style="font-size: 20px; font-weight: bold; color: white; text-transform: uppercase;">
                    DINOCO
                </span>

            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- Header Category -->
                        <li style="color: white;" class="nav-header">Admin Dinoco</li>

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Pelanggan -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('pelanggan.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>Pelanggan</p>
                            </a>
                        </li>

                        <!-- Kendaraan -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('kendaraan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-car"></i>
                                <p>Kendaraan</p>
                            </a>
                        </li>

                        <!-- Jasa Servis -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('jasa_servis.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-tools"></i>
                                <p>Jasa Servis</p>
                            </a>
                        </li>

                        <!-- Booking -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('booking.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-calendar-check"></i>
                                <p>Booking</p>
                            </a>
                        </li>

                        <!-- Sparepart -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('sparepart.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-wrench"></i>
                                <p>Sparepart</p>
                            </a>
                        </li>

                        <!-- Karyawan -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('karyawan.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-user-tie"></i>
                                <p>Karyawan</p>
                            </a>
                        </li>

                        <!-- Riwayat -->
                        <li class="nav-item">
                            <a style="color: white;" href="{{ route('riwayat.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-history"></i>
                                <p>Riwayat</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>



        <!-- Content Wrapper. Contains page content -->
        @yield('content')

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2018-2025 DINOCO.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Dinoco</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>







    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js ') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('AdminLTE/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('AdminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('AdminLTE/dist/js/pages/dashboard.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    @stack('scripts')
</body>

</html>