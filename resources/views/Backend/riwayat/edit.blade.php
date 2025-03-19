@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-history"></i> Edit Riwayat</h3>
                        <div class="ml-auto">
                            <a href="{{ route('riwayat.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('riwayat.update', $riwayat->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tanggal"><i class="fas fa-calendar-alt"></i> Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal"
                                    value="{{ $riwayat->tanggal }}" required>
                            </div>

                            <div class="form-group">
                                <label for="keluhan"><i class="fas fa-exclamation-circle"></i> Keluhan</label>
                                <textarea name="keluhan" class="form-control" id="keluhan"
                                    required>{{ $riwayat->keluhan }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="penanganan"><i class="fas fa-tools"></i> Penanganan</label>
                                <textarea name="penanganan" class="form-control" id="penanganan"
                                    required>{{ $riwayat->penanganan }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="catatan"><i class="fas fa-sticky-note"></i> Catatan</label>
                                <textarea name="catatan" class="form-control"
                                    id="catatan">{{ $riwayat->catatan }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="id_karyawan"><i class="fas fa-user"></i> Karyawan</label>
                                <select name="id_karyawan" class="form-control" id="id_karyawan" required>
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" @selected($karyawan->id == $riwayat->id_karyawan)>
                                            {{ $karyawan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nopol"><i class="fas fa-car"></i> Kendaraan</label>
                                <select name="nopol" class="form-control" id="nopol" required>
                                    @foreach ($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->nopol }}" @selected($kendaraan->nopol == $riwayat->nopol)>
                                            {{ $kendaraan->nopol }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_jasa"><i class="fas fa-wrench"></i> Jasa Servis</label>
                                <select name="id_jasa" class="form-control" id="id_jasa" required>
                                    @foreach ($jasaServis as $jasa)
                                        <option value="{{ $jasa->id }}" @selected($jasa->id == $riwayat->id_jasa)>
                                            {{ $jasa->jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kode_sparepart"><i class="fas fa-cogs"></i> Sparepart</label>
                                <select name="kode_sparepart" class="form-control" id="kode_sparepart" required>
                                    @foreach ($spareparts as $sparepart)
                                        <option value="{{ $sparepart->kode }}"
                                            @selected($sparepart->kode == $riwayat->kode_sparepart)>
                                            {{ $sparepart->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ktp_pelanggan"><i class="fas fa-id-card"></i> Pelanggan</label>
                                <select name="ktp_pelanggan" class="form-control" id="ktp_pelanggan" required>
                                    @foreach ($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->ktp }}"
                                            @selected($pelanggan->ktp == $riwayat->ktp_pelanggan)>
                                            {{ $pelanggan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status"><i class="fas fa-tasks"></i> Status</label>
                                <input type="text" name="status" class="form-control" id="status"
                                    value="{{ $riwayat->status }}" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection