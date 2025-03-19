@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-history"></i> Tambah Riwayat</h3>
                        <div class="ml-auto">
                            <a href="{{ route('riwayat.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('riwayat.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tanggal"><i class="fas fa-calendar"></i> Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="ktp_pelanggan"><i class="fas fa-user"></i> Pelanggan</label>
                                <select name="ktp_pelanggan" id="ktp_pelanggan" class="form-control" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach ($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->ktp }}">{{ $pelanggan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nopol"><i class="fas fa-car"></i> Kendaraan</label>
                                <select name="nopol" id="nopol" class="form-control" required>
                                    <option value="">-- Pilih Kendaraan --</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_karyawan"><i class="fas fa-user-tie"></i> Karyawan</label>
                                <select name="id_karyawan" class="form-control" required>
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_jasa"><i class="fas fa-tools"></i> Jasa Servis</label>
                                <select name="id_jasa" class="form-control" required>
                                    @foreach ($jasaServis as $jasa)
                                        <option value="{{ $jasa->id }}">{{ $jasa->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kode_sparepart"><i class="fas fa-cogs"></i> Sparepart</label>
                                <select name="kode_sparepart" class="form-control">
                                    <option value="">-- Tidak ada sparepart yang diganti --</option>
                                    @foreach ($spareparts as $sparepart)
                                        <option value="{{ $sparepart->kode }}">{{ $sparepart->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="keluhan"><i class="fas fa-comment-dots"></i> Keluhan</label>
                                <textarea name="keluhan" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="penanganan"><i class="fas fa-wrench"></i> Penanganan</label>
                                <textarea name="penanganan" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="catatan"><i class="fas fa-sticky-note"></i> Catatan</label>
                                <textarea name="catatan" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="status"><i class="fas fa-clipboard-check"></i> Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pelangganSelect = document.getElementById("ktp_pelanggan");
            const kendaraanSelect = document.getElementById("nopol");

            pelangganSelect.addEventListener("change", function () {
                const pelangganId = this.value;
                kendaraanSelect.innerHTML = '<option value="">-- Pilih Kendaraan --</option>';

                if (pelangganId) {
                    fetch(`/api/kendaraan-by-pelanggan/${pelangganId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kendaraan => {
                                let option = document.createElement("option");
                                option.value = kendaraan.nopol;
                                option.textContent = kendaraan.tipe;
                                kendaraanSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error("Error fetching kendaraan:", error));
                }
            });
        });
    </script>
@endsection