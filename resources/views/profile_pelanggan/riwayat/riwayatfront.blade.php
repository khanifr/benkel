@extends('masterfront')

@section('contentfront')
<br><br><br>
<div class="container mt-4">
    <h2 class="font-weight-bold text-center text-primary">Riwayat Servis Anda</h2>
    <br>
    <div class="row justify-content-center">
        @foreach ($riwayats as $riwayat)
    <div class="col-md-3 mb-4">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate__animated animate__fadeInUp">
            <div class="card-header text-white text-center py-2" style="background: linear-gradient(135deg, #007bff, #0056b3);">
                <h6 class="mb-0 font-weight-bold">Invoice Servis</h6>
            </div>
            <div class="card-body p-3" style="background-color: #fff;">
                <h6 class="text-muted text-center">{{ date('d-m-Y', strtotime($riwayat->tanggal)) }}</h6>
                <hr>
                <p><strong>Pelanggan:</strong> {{ $riwayat->pelanggan->nama ?? '-' }}</p>
                <p>
                    <strong>Kendaraan:</strong>
                    {{ $riwayat->kendaraan->merek ?? '-' }} - 
                    {{ $riwayat->kendaraan->tipe ?? '-' }} - 
                    {{ $riwayat->kendaraan->nopol ?? '-' }} 
                </p>
                <p><strong>Keluhan:</strong> {{ $riwayat->keluhan ?? '-' }}</p>
                <p><strong>Penanganan:</strong> {{ $riwayat->penanganan ?? '-' }}</p>

                @php
                    // Decode data JSON sparepart
                    $rawSparepartData = json_decode($riwayat->kode_sparepart, true);
                    
                    // Inisialisasi array untuk menyimpan jumlah masing-masing sparepart berdasarkan kode
                    $sparepartQuantities = [];
                    
                    if (is_array($rawSparepartData)) {
                        foreach ($rawSparepartData as $item) {
                            // Jika data berupa array asosiatif dengan key 'kode'
                            if (is_array($item) && isset($item['kode'])) {
                                $kode = $item['kode'];
                                // Ambil jumlah jika ada, default 1
                                $jumlah = isset($item['jumlah']) ? $item['jumlah'] : 1;
                            } else {
                                // Jika item hanya berupa kode saja
                                $kode = $item;
                                $jumlah = 1;
                            }
                            
                            // Jika kode sudah ada, tambahkan jumlahnya
                            if (isset($sparepartQuantities[$kode])) {
                                $sparepartQuantities[$kode] += $jumlah;
                            } else {
                                $sparepartQuantities[$kode] = $jumlah;
                            }
                        }
                    }
                    
                    // Ambil daftar kode sparepart yang unik
                    $kodeSpareparts = array_keys($sparepartQuantities);
                    
                    // Ambil detail sparepart dari database
                    $sparepartDetails = \App\Models\Sparepart::whereIn('kode', $kodeSpareparts)
                                            ->get(['kode', 'nama', 'harga']);
                @endphp

                {{-- Tampilkan daftar nama sparepart beserta jumlahnya --}}
                <p><strong>Daftar Sparepart:</strong>
                    @foreach($sparepartDetails as $detail)
                        {{ $detail->nama }} ({{ $sparepartQuantities[$detail->kode] }})@if(!$loop->last), @endif
                    @endforeach
                </p>

                <h6 class="mt-2"><strong>Detail Sparepart:</strong></h6>
                <table class="table table-sm table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sparepartDetails as $detail)
                        <tr>
                            <td>{{ $detail->nama }}</td>
                            <td class="text-center">{{ $sparepartQuantities[$detail->kode] }}</td>
                            <td class="text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p><strong>Mekanik:</strong> {{ $riwayat->karyawan->nama ?? '-' }}</p>
                <p>
                    <strong>Jasa Servis:</strong>
                    {{ $riwayat->jasaServis->jenis ?? '-' }} - 
                    <span class="text-success">Rp {{ number_format($riwayat->jasaServis->harga ?? 0, 0, ',', '.') }}</span>
                </p>
                <hr>
            </div>
        </div>
    </div>
@endforeach

    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $riwayats->links() }}
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
