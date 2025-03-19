@extends('masterfront')

@section('contentfront')

<br>
<br>

<div class="container my-5">
    <h2 class="mb-4">Daftar Booking Anda</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($bookings->count() > 0)
        <div class="row">
            @foreach($bookings as $booking)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary fw-bold">No. Antrian: {{ $booking->no_antrian_per_hari }}</h5>
                            <p class="mb-2"><i class="bi bi-calendar-check"></i> <strong>Tanggal Booking:</strong> {{ $booking->tanggal_booking }}</p>
                            <p class="mb-2"><i class="bi bi-clock-history"></i> <strong>Tanggal Penanganan:</strong> 
                                @if($booking->tanggal_penanganan)
                                    {{ $booking->tanggal_penanganan }}
                                @else
                                    <span class="text-warning">Menunggu konfirmasi</span>
                                @endif
                            </p>
                            <p class="mb-2"><i class="bi bi-clock"></i> <strong>Jam Kedatangan:</strong> 
                                @if($booking->jam_booking)
                                    {{ $booking->jam_booking }}
                                @else
                                    <span class="text-warning">Menunggu konfirmasi</span>
                                @endif
                            </p>
                            <p class="mb-2"><i class="bi bi-car-front-fill"></i> <strong>Nomor Polisi:</strong> {{ $booking->nopol }}</p>
                            <p class="mb-2"><i class="bi bi-exclamation-triangle"></i> <strong>Keluhan:</strong> {{ $booking->keluhan }}</p>
                            <p class="mb-3"><i class="bi bi-info-circle"></i> <strong>Status:</strong> 
                                <span class="badge {{ $booking->status_class }} px-3 py-2 fs-6">{{ $booking->status }}</span>
                            </p>
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('booking.pelanggan.destroy', $booking->no_urut) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" onclick="return confirm('Apakah anda yakin ingin membatalkan booking ini?')">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Anda belum membuat booking.
        </div>
    @endif
    <br><br><br><br><br><br><br> 
    <div class="text-center mt-4">
        <a href="{{ route('booking.pelanggan.create') }}" class="btn btn-lg btn-success rounded-pill shadow">Buat Booking Baru</a>
    </div>
    <br><br><br><br><br><br>
</div>
@endsection