@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-calendar-alt"></i> Detail Booking</h3>
                        <div class="ml-auto">
                            <a href="{{ route('booking.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>No. Urut:</strong> {{ $booking->no_urut }}</p>
                        <p><strong>Nama:</strong> {{ $booking->pelanggan->nama }}</p>
                        <p><strong>NIK Pelanggan:</strong> {{ $booking->nik }}</p>
                        <p><strong>Tanggal Booking:</strong> {{ $booking->tanggal_booking }}</p>
                        <p><strong>Tanggal Penanganan:</strong> {{ $booking->tanggal_penanganan }}</p>
                        <p><strong>Kendaraan:</strong> {{ $booking->nopol }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection