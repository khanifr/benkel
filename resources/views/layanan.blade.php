@extends('masterfront')

@section('contentfront')

<!-- CSS -->
<style>
    .service-box {
        background: #fff;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border: 1px solid rgba(17, 28, 67, 0.2);
        padding: 20px;
        text-align: center;
    }

    .service-box:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .service-icon {
        font-size: 40px;
        color: #111c43;
        background: rgba(17, 28, 67, 0.1);
        padding: 15px;
        border-radius: 50%;
        display: inline-block;
    }

    .service-box h5 {
        color: #111c43;
        font-weight: bold;
        margin-top: 15px;
        font-size: 18px;
    }

    .service-box p {
        color: #6c757d;
        font-size: 14px;
        margin-top: 10px;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <br>
        <br>
        <br>
        <h2 class="text-uppercase" style="color: #111c43; font-weight: bold;">Layanan Bengkel Kami</h2>
        <p class="text-muted">Kami menyediakan berbagai layanan profesional untuk perawatan dan perbaikan mobil BMW Anda.</p>
    </div>
    
    <div class="row g-4">
        @php
        $services = [
            ['icon' => 'fas fa-cogs', 'title' => 'Servis Mesin', 'desc' => 'Perawatan dan perbaikan mesin.'],
            ['icon' => 'fas fa-bolt', 'title' => 'Perbaikan Kelistrikan', 'desc' => 'Diagnosa dan perbaikan kelistrikan.'],
            ['icon' => 'fas fa-wrench', 'title' => 'Tune Up', 'desc' => 'Optimasi performa mesin.'],
            ['icon' => 'fas fa-car', 'title' => 'Transmisi', 'desc' => 'Perawatan transmisi untuk kelancaran.'],
            ['icon' => 'fas fa-spray-can', 'title' => 'Body Repair', 'desc' => 'Perbaikan eksterior dan interior.'],
            ['icon' => 'fas fa-laptop-code', 'title' => 'Diagnostik', 'desc' => 'Pengecekan dengan alat diagnostik.']
        ];
        @endphp

        @foreach ($services as $service)
        <div class="col-lg-4 col-md-6">
            <div class="service-box">
                <div class="service-icon">
                    <i class="{{ $service['icon'] }}"></i>
                </div>
                <h5>{{ $service['title'] }}</h5>
                <p>{{ $service['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-lg-6">
            <h3 class="text-uppercase" style="color: #111c43; font-weight: bold;">Promo Spesial</h3>
        <p class="text-muted">Dapatkan diskon 20% untuk servis pertama Anda!</p>
        </div>
        <div class="col-lg-6">
            <h3 class="text-uppercase" style="color: #111c43; font-weight: bold;">Mengapa Memilih Kami?</h3>
            <ul class="list-unstyled text-muted">
                <li><i class="fas fa-check-circle text-success"></i> Teknisi berpengalaman dan bersertifikat</li>
                <li><i class="fas fa-check-circle text-success"></i> Peralatan canggih dan terbaru</li>
                <li><i class="fas fa-check-circle text-success"></i> Suku cadang asli dan berkualitas</li>
                <li><i class="fas fa-check-circle text-success"></i> Pelayanan cepat dan profesional</li>
            </ul>
        </div>
    </div>

    

    <dv class="text-center mt-5">
       
    </div>