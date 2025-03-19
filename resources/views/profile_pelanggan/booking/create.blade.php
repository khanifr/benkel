@extends('masterfront')

@section('contentfront')
<section id="buat-booking" class="py-5">
    <br>
            <br>
            <br>
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3">Buat Booking</h2>
            <p class="text-muted">Isi data booking Anda dengan mudah</p>
        </div>
        
        <div class="row justify-content-center">
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <!-- Gunakan posisi relative agar tombol absolute bisa diposisikan dalam card -->
                    <div class="card-body p-4 position-relative">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('booking.pelanggan.store') }}" method="POST">
                            @csrf

                            <!-- Tanggal Booking -->
                            <div class="form-floating mb-3">
                                <input type="date" name="tanggal_booking" id="tanggal_booking" class="form-control" placeholder="Tanggal Booking" value="{{ old('tanggal_booking') }}" min="{{ date('Y-m-d') }}" required>
                                <label for="tanggal_booking">Tanggal Booking</label>
                            </div>                            

                            <!-- Tanggal Penanganan (menunggu konfirmasi admin) -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Tanggal Penanganan <small class="text-muted">(Menunggu konfirmasi admin)</small>
                                </label>
                                <p class="form-control-plaintext">Menunggu konfirmasi admin</p>
                                <input type="hidden" name="tanggal_penanganan" value="">
                            </div>

                            <!-- Jam Booking (menunggu konfirmasi admin) -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Jam Booking <small class="text-muted">(Menunggu konfirmasi admin)</small>
                                </label>
                                <p class="form-control-plaintext">Menunggu konfirmasi admin</p>
                                <input type="hidden" name="jam_booking" value="">
                            </div>

                            <!-- Kendaraan -->
                            @if(isset($selectedKendaraan))
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="kendaraan" value="{{ $selectedKendaraan->tipe }} - {{ $selectedKendaraan->nopol }}" disabled>
                                    <label for="kendaraan">Kendaraan</label>
                                    <input type="hidden" name="nopol" value="{{ $selectedKendaraan->nopol }}">
                                </div>
                            @else
                            <div class="form-floating mb-3">
                                <select name="nopol" id="kendaraan" class="form-select" required>
                                    <option value="" selected>Pilih Kendaraan Anda</option>
                                    @foreach($kendaraanList as $kendaraan)
                                        <option value="{{ $kendaraan->nopol }}" 
                                            @if(in_array($kendaraan->nopol, $kendaraanDibooking)) disabled @endif>
                                            {{ $kendaraan->tipe }} - {{ $kendaraan->nopol }}
                                            @if(in_array($kendaraan->nopol, $kendaraanDibooking)) (Sudah Dibooking) @endif
                                        </option>
                                    @endforeach
                                </select>
                                <label for="kendaraan">Kendaraan</label>
                            </div>                            
                            @endif

                            @if($sudahDibooking)
                                <div class="alert alert-warning">
                                    Kendaraan ini sudah memiliki booking yang sedang berlangsung. Silakan selesaikan booking sebelumnya sebelum membuat yang baru.
                                </div>
                            @endif

                            <!-- Keluhan -->
                            <div class="form-floating mb-3">
                                <textarea name="keluhan" id="keluhan" class="form-control" placeholder="Keluhan" style="height: 100px;" required>{{ old('keluhan') }}</textarea>
                                <label for="keluhan">Keluhan</label>
                            </div>

                            <!-- Tambahan ruang agar tombol tidak menutupi konten -->
                            <div style="height: 70px;"></div>

                            <!-- Tombol aksi di pojok kanan bawah -->
                            <div class="position-absolute" style="bottom: 20px; right: 20px;">
                                <div class="d-flex gap-1">
                                    <button type="submit" class="btn btn-custom btn-simpan">✅ Buat Booking</button>
                                    <a href="{{ route('booking.pelanggan.index') }}" ></a>
                                    <button type="button" class="btn btn-custom btn-simpan" onclick="history.back()">Kembali</button>
                                </div>
                            </div>                          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom CSS untuk tombol -->
<style>
    .btn-custom {
        background-color: #fff !important;
        color: #000 !important;
        border: 1px solid #000;
        transition: background-color 0.3s, color 0.3s;
    }
    .btn-simpan:hover {
        background-color: #000 !important;
        color: #fff !important;
    }
    .btn-kembali:hover {
        background-color: #e0e0e0 !important;
        color: #000 !important;
    }
</style>
@endsection
