@include('navbar')
<div class="container">
<br><br><br>
    <h1>Selamat Datang di Bengkel Kami</h1>

    @auth('pelanggan')
        <p>Halo, {{ Auth::guard('pelanggan')->user()->nama }} Selamat datang kembali.</p>
        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-primary">Dashboard</a>
    @else
        <p>Silakan daftar atau login untuk layanan lebih lanjut.</p>
        <a href="{{ route('pelanggan.login') }}" class="btn btn-success">Login</a>
        <a href="{{ route('pelanggan.register') }}" class="btn btn-warning">Daftar</a>
    @endauth

    @auth('pelanggan')
    <p>Nama: {{ Auth::guard('pelanggan')->user()->nama }}</p>
@endauth
</div>

@include('footer')
