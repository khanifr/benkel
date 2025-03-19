@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-user-plus"></i> Tambah Karyawan</h3>
                        <div class="ml-auto">
                            <a href="{{ route('karyawan.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nama"><i class="fas fa-user"></i> Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="hp"><i class="fas fa-phone"></i> Telepon</label>
                                <input type="text" name="hp" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="foto"><i class="fas fa-image"></i> Foto</label>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection