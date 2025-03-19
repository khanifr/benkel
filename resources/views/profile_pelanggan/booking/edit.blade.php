@extends('masterfront')

@section('contentfront')
<div class="container my-5">
    <h2>Edit Booking</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('booking.pelanggan.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
            <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" value="{{ old('tanggal_booking', $booking->tanggal_booking) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_penanganan" class="form-label">Tanggal Penanganan</label>
            <input type="date" class="form-control" id="tanggal_penanganan" name="tanggal_penanganan" value="{{ old('tanggal_penanganan', $booking->tanggal_penanganan) }}" required>
        </div>

        <div class="mb-3">
            <label for="jam_penanganan" class="form-label">Jam Penanganan</label>
            <input type="time" class="form-control" id="jam_penanganan" name="jam_penanganan" value="{{ old('jam_penanganan', $booking->jam_penanganan) }}" required>
        </div>

        <div class="mb-3">
            <label for="nopol" class="form-label">Kendaraan (Nomor Polisi)</label>
            <select class="form-select" id="nopol" name="nopol" required>
                @foreach($kendaraans as $kendaraan)
                    <option value="{{ $kendaraan->nopol }}" {{ $booking->nopol == $kendaraan->nopol ? 'selected' : '' }}>
                        {{ $kendaraan->tipe }} - {{ $kendaraan->nopol }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required>{{ old('keluhan', $booking->keluhan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
        <a href="{{ route('booking.pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection