@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;" class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-calendar-alt"></i> Edit Booking</h3>
                        <div class="ml-auto">
                            <a href="{{ route('booking.index') }}" class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger m-3">
                            <strong>Terjadi Kesalahan!</strong> Periksa kembali inputan Anda.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('booking.update', $booking->no_urut) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Pelanggan -->
                            <div class="form-group mb-3">
                                <label for="nik"><i class="fas fa-user"></i> NIK & Nama Pelanggan</label>
                                <input type="text" name="nik" class="form-control" id="nik" 
                                    value="{{ $booking->nik }} - {{ $booking->pelanggan->nama }}" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tanggal_penanganan" class="form-label">Tanggal Booking</label>
                                <input type="date" name="tanggal_booking" id="tanggal_booking" class="form-control" 
                                       value="{{ old('tanggal_booking', $booking->tanggal_booking) }}" min="{{ date('Y-m-d') }}" required>
                            </div>                            
                            
                            <!-- Field Edit Jam Booking -->
                            <div class="col-md-6">
                              <div class="form-group">
                                 <label for="jam_booking"><i class="fas fa-clock"></i> Jam Kedatangan</label>
                                 <select name="jam_booking" id="jam_booking" class="form-control">
                                    <option value="">-- Pilih Jam --</option>
                                    @for ($i = 8; $i <= 16; $i++)
                                        @php
                                            $jamValue = $i . ':00 - ' . ($i + 1) . ':00';
                                        @endphp
                                        <option value="{{ $jamValue }}" {{ old('jam_booking', $booking->jam_booking) == $jamValue ? 'selected' : '' }}>
                                            {{ $jamValue }}
                                        </option>
                                    @endfor
                                 </select>
                              </div>
                            </div>

                             <!-- Field Edit Tanggal Penanganan -->
                             <div class="col-md-6">
                                <div class="form-group">
                                   <label for="tanggal_penanganan"><i class="fas fa-tools"></i> Tanggal & Jam Penanganan</label>
                                   <input type="datetime-local" name="tanggal_penanganan" id="tanggal_penanganan" class="form-control" min="{{ date('Y-m-d\TH:i') }}">
                                </div>
                             </div>                             
                            

                            <!-- Field Edit Status -->
                            <div class="form-group mb-3">
                                <label for="status"><i class="fas fa-info-circle"></i> Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Menunggu" {{ $booking->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Dibatalkan" {{ $booking->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    <option value="Dikonfirmasi" {{ $booking->status == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                                    <option value="Menunggu Sparepart" {{ $booking->status == 'Menunggu Sparepart' ? 'selected' : '' }}>Menunggu Sparepart</option>
                                    <option value="Dalam Antrian" {{ $booking->status == 'Dalam Antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                                    <option value="Sedang Dikerjakan" {{ $booking->status == 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                    <option value="Siap Diambil" {{ $booking->status == 'Siap Diambil' ? 'selected' : '' }}>Siap Diambil</option>
                                    <option value="Selesai & Diambil" {{ $booking->status == 'Selesai & Diambil' ? 'selected' : '' }}>Selesai & Diambil</option>
                                </select>
                            </div>

                            <!-- Tombol Simpan Perubahan -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
