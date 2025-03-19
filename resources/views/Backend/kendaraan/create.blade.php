@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-car"></i> Add New Kendaraan</h3>
                        <div class="ml-auto">
                            <a href="{{ route('kendaraan.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi Kesalahan!</strong> Periksa kembali inputan Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="id_pelanggan"><i class="fas fa-user"></i> Pelanggan</label>
                                <select name="id_pelanggan" class="form-control" id="id_pelanggan" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->ktp }}">{{ $pelanggan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nopol"><i class="fas fa-car"></i> No. Polisi</label>
                                <input type="text" name="nopol" class="form-control" id="nopol" required>
                            </div>

                            <div class="form-group">
                                <label for="merek"><i class="fas fa-cogs"></i> Merek</label>
                                <input type="text" name="merek" class="form-control" id="merek" required>
                            </div>

                            <div class="form-group">
                                <label for="tipe"><i class="fas fa-info-circle"></i> Tipe</label>
                                <input type="text" name="tipe" class="form-control" id="tipe" required>
                            </div>

                            <div class="form-group">
                                <label for="transmisi"><i class="fas fa-exchange-alt"></i> Transmisi</label>
                                <select name="transmisi" class="form-control" id="transmisi" required>
                                    <option value="" disabled selected>Pilih Transmisi</option>
                                    <option value="manual">Manual</option>
                                    <option value="matic">Matic</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kapasitas"><i class="fas fa-users"></i> Kapasitas</label>
                                <input type="number" name="kapasitas" class="form-control" id="kapasitas" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun"><i class="fas fa-calendar-alt"></i> Tahun</label>
                                <input type="number" name="tahun" class="form-control" id="tahun" required>
                            </div>

                            <div class="form-group">
                                <label for="gambar"><i class="fas fa-image"></i> Upload Gambar Kendaraan</label>
                                <input type="file" name="gambar" class="form-control-file" id="gambar">
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