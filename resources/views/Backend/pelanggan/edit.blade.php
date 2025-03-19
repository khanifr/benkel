@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div style="background-color: #111c43; color: white;"
                    class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-car"></i> Edit Pelanggan</h3>
                    <div class="ml-auto">
                        <a href="{{ route('pelanggan.index') }}"
                            class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body">
                        <form action="{{ route('pelanggan.update', $pelanggan->ktp) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Nama -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $pelanggan->nama }}"
                                            required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $pelanggan->email }}" required>
                                    </div>
                                </div>

                                <!-- KTP -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ktp">Nomor KTP</label>
                                        <input type="text" name="ktp" class="form-control" value="{{ $pelanggan->ktp }}"
                                            readonly>
                                    </div>
                                </div>

                                <!-- No HP -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hp">Nomor HP</label>
                                        <input type="text" name="hp" class="form-control" value="{{ $pelanggan->hp }}"
                                            required>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="3"
                                            required>{{ $pelanggan->alamat }}</textarea>
                                    </div>
                                </div>

                                <!-- Foto Profil -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_profile">Foto Profil</label>
                                        <input type="file" name="foto_profile" class="form-control">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                    </div>
                                </div>

                                <!-- Preview Foto Profil -->
                                <div class="col-md-6">
                                    <div class="form-group text-center">
                                        <label>Foto Saat Ini</label><br>
                                        <img src="{{ asset('storage/pelanggan/' . $pelanggan->foto_profile) }}"
                                            class="rounded-circle" width="100" height="100" alt="Foto Profil">

                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection