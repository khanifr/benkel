@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-history"></i> Detail Riwayat Servis</h3>
                        <div class="ml-auto">
                            <a href="{{ route('riwayat.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>Tanggal Servis:</strong> {{ $riwayat->tanggal }}</p>
                        <p><strong>Pelanggan:</strong> {{ $riwayat->pelanggan->nama }}</p>
                        <p><strong>Kendaraan:</strong> {{ $riwayat->kendaraan->nopol }} - {{ $riwayat->kendaraan->merk }}
                        </p>
                        <p><strong>Keluhan:</strong> {{ $riwayat->keluhan }}</p>
                        <p><strong>Penanganan:</strong> {{ $riwayat->penanganan ?? 'Belum ada' }}</p>
                        <p><strong>Catatan:</strong> {{ $riwayat->catatan ?? 'Tidak ada' }}</p>
                        <p><strong>Karyawan yang Menangani:</strong> {{ $riwayat->karyawan->nama }}</p>
                        <p><strong>Jasa Servis:</strong> {{ $riwayat->jasaServis->nama_jasa }}</p>
                        <p><strong>Sparepart Digunakan:</strong> {{ $riwayat->sparepart->nama_sparepart ?? 'Tidak ada' }}
                        </p>
                        <p><strong>Status:</strong>
                            @if($riwayat->status == 'proses')
                                <span class="badge bg-warning">Proses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection