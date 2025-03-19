@extends('masterfront')

@section('contentfront')
<section id="edit-profil" class="py-5">
    <br>
    <br>
    <br>
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3">Edit Profile Anda</h2>
            <p class="text-muted">Perbarui data profil Anda dengan mudah</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <!-- Card body diberi posisi relative agar tombol absolute menyesuaikan -->
                    <div class="card-body p-4 position-relative">
                        <form action="{{ route('pelanggan.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama -->
                            <div class="form-floating mb-3">
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ old('nama', $pelanggan->nama) }}" required>
                                <label for="nama">Nama</label>
                            </div>

                            <!-- Alamat -->
                            <div class="form-floating mb-3">
                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" value="{{ old('alamat', $pelanggan->alamat) }}" required>
                                <label for="alamat">Alamat</label>
                            </div>

                            <!-- HP -->
                            <div class="form-floating mb-3">
                                <input type="text" name="hp" id="hp" class="form-control" placeholder="HP" value="{{ old('hp', $pelanggan->hp) }}" required>
                                <label for="hp">no.HP</label>
                            </div>

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email', $pelanggan->email) }}" required>
                                <label for="email">Email</label>
                            </div>

                            <!-- Password (Opsional) -->
                            <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <label for="password">Password (Opsional)</label>
                            </div>
                            <small class="text-muted mb-3 d-block">Kosongkan jika tidak ingin mengubah password.</small>

                            <!-- Foto Profil -->
                            <div class="mb-3">
                                <label for="foto_profile" class="form-label">Foto Profil</label>
                                <input type="file" name="foto_profile" id="foto_profile" class="form-control">
                                @if($pelanggan->foto_profile)
                                    <p class="mt-2">Foto Saat Ini:</p>
                                    <img src="{{ asset('storage/pelanggan/' . $pelanggan->foto_profile) }}" 
                                         alt="Foto Profil" 
                                         class="rounded img-preview">
                                @endif
                            </div>

                            <!-- Tambahan ruang agar tombol tidak menutupi konten -->
                            <div style="height: 70px;"></div>

                            <!-- Tombol aksi di pojok kanan bawah -->
                            <div class="position-absolute" style="bottom: 20px; right: 20px;">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-custom btn-simpan">✅ Simpan Perubahan</button>
                                    <a href="{{ route('pelanggan.profile') }}" class="btn btn-custom btn-kembali">Batal</a>
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
    .img-preview {
        width: 100px; /* Atur lebar */
        height: 100px; /* Atur tinggi */
        object-fit: cover; /* Pangkas gambar agar selalu pas */
        border-radius: 50%; /* Membuat gambar menjadi lingkaran (opsional) */
        border: 2px solid #ddd; /* Tambahkan border agar lebih rapi */
    }
</style>
@endsection
