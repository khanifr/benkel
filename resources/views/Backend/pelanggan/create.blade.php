@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-user-plus"></i> Tambah Pelanggan</h3>
                        <div class="ml-auto">
                            <a href="{{ route('pelanggan.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="ktp"><i class="fas fa-id-card"></i> KTP</label>
                                <input type="text" name="ktp" class="form-control" id="ktp" required>
                            </div>

                            <div class="form-group">
                                <label for="nama"><i class="fas fa-user"></i> Name</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat"><i class="fas fa-map-marker-alt"></i> Address</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" required>
                            </div>

                            <div class="form-group">
                                <label for="hp"><i class="fas fa-phone"></i> Phone</label>
                                <input type="text" name="hp" class="form-control" id="hp" required>
                            </div>

                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>

                            <div class="form-group">
                                <label for="foto_profil"><i class="fas fa-image"></i> Foto Profil</label>
                                <input type="file" name="foto_profile" class="form-control-file" id="foto_profile">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection