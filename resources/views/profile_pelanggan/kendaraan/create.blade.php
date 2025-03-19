@extends('masterfront')

@section('contentfront')
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
        background-color: #e0e0e0 !important; /* Sesuaikan warna hover sesuai preferensi */
        color: #000 !important;
    }
</style>

<section id="tambah-kendaraan" class="py-5">
    <br>
<br>
<br>
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3">Tambah Kendaraan</h2>
            <p class="text-muted">Isi data kendaraan Anda dengan mudah</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <!-- Card body diberi posisi relative agar tombol absolute menyesuaikan -->
                    <div class="card-body p-4 position-relative">
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('pelanggan.kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Nomor Polisi -->
                            <div class="form-floating mb-3">
                                <input type="text" name="nopol" id="nopol" class="form-control @error('nopol') is-invalid @enderror" placeholder="Nomor Polisi (Nopol)" value="{{ old('nopol') }}" required>
                                <label for="nopol">Nomor Polisi (Nopol)</label>
                                @error('nopol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Merek -->
                            <div class="form-floating mb-3">
                                <input type="text" name="merek" id="merek" class="form-control @error('merek') is-invalid @enderror" placeholder="Merek" value="{{ old('merek') }}" required>
                                <label for="merek">Merek</label>
                                @error('merek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tipe -->
                            <div class="form-floating mb-3">
                                <input type="text" name="tipe" id="tipe" class="form-control @error('tipe') is-invalid @enderror" placeholder="Tipe" value="{{ old('tipe') }}" required>
                                <label for="tipe">Tipe</label>
                                @error('tipe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Transmisi -->
                            <div class="mb-3">
                                <label for="transmisi" class="form-label">Transmisi</label>
                                <select name="transmisi" id="transmisi" class="form-select @error('transmisi') is-invalid @enderror" required>
                                    <option value="manual" {{ old('transmisi') == 'manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="matic" {{ old('transmisi') == 'matic' ? 'selected' : '' }}>Matic</option>
                                </select>
                                @error('transmisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Kapasitas Mesin -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" name="kapasitas" id="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" placeholder="Kapasitas Mesin (cc)" value="{{ old('kapasitas') }}" required>
                                        <label for="kapasitas">Kapasitas Mesin (cc)</label>
                                        @error('kapasitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Tahun Kendaraan -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" placeholder="Tahun Kendaraan" value="{{ old('tahun') }}" required>
                                        <label for="tahun">Tahun Kendaraan</label>
                                        @error('tahun')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Kendaraan -->
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Foto Kendaraan (Opsional)</label>
                                <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tambahan ruang agar tombol tidak menutupi konten -->
                            <div style="height: 70px;"></div>

                            <!-- Tombol aksi posisi absolute di pojok kanan bawah -->
                            <div class="position-absolute" style="bottom: 20px; right: 20px;">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-custom btn-simpan">✅ Simpan</button>
                                    <a href="{{ route('pelanggan.profile') }}" class="btn btn-custom btn-kembali">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
