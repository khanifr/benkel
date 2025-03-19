@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-car"></i> Edit Kendaraan</h3>
                        <div class="ml-auto">
                            <a href="{{ route('kendaraan.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kendaraan.update', $kendaraan->nopol) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nopol"><i class="fas fa-car"></i> No. Polisi</label>
                                <input type="text" name="nopol" class="form-control" id="nopol"
                                    value="{{ $kendaraan->nopol }}" required>
                            </div>

                            <div class="form-group">
                                <label for="merek"><i class="fas fa-cogs"></i> Merek</label>
                                <input type="text" name="merek" class="form-control" id="merek"
                                    value="{{ $kendaraan->merek }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tipe"><i class="fas fa-info-circle"></i> Tipe</label>
                                <input type="text" name="tipe" class="form-control" id="tipe" value="{{ $kendaraan->tipe }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="transmisi"><i class="fas fa-cogs"></i> Transmisi</label>
                                <select name="transmisi" class="form-control" id="transmisi" required>
                                    <option value="" disabled selected>Pilih Transmisi</option>
                                    <option value="manual" {{ $kendaraan->transmisi == 'manual' ? 'selected' : '' }}>Manual
                                    </option>
                                    <option value="matic" {{ $kendaraan->transmisi == 'matic' ? 'selected' : '' }}>Matic
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kapasitas"><i class="fas fa-users"></i> Kapasitas</label>
                                <input type="number" name="kapasitas" class="form-control" id="kapasitas"
                                    value="{{ $kendaraan->kapasitas }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun"><i class="fas fa-calendar-alt"></i> Tahun</label>
                                <input type="number" name="tahun" class="form-control" id="tahun"
                                    value="{{ $kendaraan->tahun }}" required>
                            </div>

                            <div class="form-group">
                                <label for="id_pelanggan"><i class="fas fa-user"></i> Pelanggan</label>
                                <select name="id_pelanggan" class="form-control" id="id_pelanggan" required>
                                    @foreach($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->ktp }}" {{ $kendaraan->id_pelanggan == $pelanggan->ktp ? 'selected' : '' }}>
                                            {{ $pelanggan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar">Foto Kendaraan</label>
                                    <input type="file" name="gambar" class="form-control">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                                </div>
                            </div>
                        
                            <!-- Preview Gambar -->
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <label>Foto Saat Ini</label><br>
                                    @if($kendaraan->gambar)
                                        <img src="{{ asset('storage/' . $kendaraan->gambar) }}" 
                                            class="img-thumbnail" width="150" height="150" alt="Foto Kendaraan">
                                    @else
                                        <p class="text-muted">Tidak ada foto</p>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection