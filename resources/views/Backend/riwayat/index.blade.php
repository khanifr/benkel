@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #111c43; color: white;">
                        <h4 class="mb-0">Riwayat dan Proses</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="riwayatTable" class="table table-hover table-bordered table-striped w-100">
                                <thead style="color: dark;">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Keluhan</th>
                                        <th>Penanganan</th>
                                        <th>Sparepart</th>
                                        <th>Catatan</th>
                                        <th>Mekanik</th>
                                        <th>Kendaraan</th>
                                        <th>Jasa Servis</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayats as $index => $riwayat)
                                        <tr class="animate__animated animate__fadeIn">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $riwayat->tanggal }}</td>
                                            <td>{{ $riwayat->pelanggan->nama ?? '-' }}</td>
                                            <td>{{ $riwayat->keluhan }}</td>
                                            <td>{{ $riwayat->penanganan }}</td>
                                            <td>
                                                @php
                                                    // Decode data sparepart dari JSON
                                                    $decodedSpareparts = json_decode($riwayat->kode_sparepart, true);
                                                    $decodedSpareparts = is_array($decodedSpareparts) ? $decodedSpareparts : [];
                                                    // Ekstrak hanya nilai 'kode' dan tetap simpan jumlahnya
                                                    $output = [];
                                                    // Query sparepart: ambil array flat kode
                                                    $sparepartCodes = array_column($decodedSpareparts, 'kode');
                                                    $sparepartsDetail = \App\Models\Sparepart::whereIn('kode', $sparepartCodes)->get()->keyBy('kode');
                                                    foreach ($decodedSpareparts as $item) {
                                                        if (is_array($item) && isset($item['kode'])) {
                                                            $kode = $item['kode'];
                                                            $jumlah = $item['jumlah'] ?? 1;
                                                        } elseif (is_string($item)) {
                                                            $kode = $item;
                                                            $jumlah = 1;
                                                        } else {
                                                            continue;
                                                        }
                                                        if (isset($sparepartsDetail[$kode])) {
                                                            $output[] = $sparepartsDetail[$kode]->nama . " (" . $jumlah . ")";
                                                        } else {
                                                            $output[] = $kode . " (" . $jumlah . ")";
                                                        }
                                                    }
                                                @endphp
                                                {{ implode(', ', $output) ?: '-' }}
                                            </td>
                                            <td>{{ $riwayat->catatan }}</td>
                                            <td>{{ $riwayat->karyawan->nama ?? '-' }}</td>
                                            <td>{{ $riwayat->kendaraan->nopol ?? '-' }}</td>
                                            <td>{{ $riwayat->jasaServis->jenis ?? '-' }}</td>
                                            <td>{{ $riwayat->status }}</td>
                                            <td class="text-center text-nowrap">
                                                <button type="button" class="btn btn-info btn-sm btn-icon" data-toggle="modal" data-target="#invoiceModal{{ $riwayat->id }}">
                                                    <i class="fas fa-file-invoice"></i> Invoice
                                                </button>
                                                <button class="btn btn-danger btn-sm btn-icon delete-btn" data-url="{{ route('riwayat.destroy', $riwayat->id) }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer" style="color: dark;">
                        <small>Total Riwayat: {{ $riwayats->count() }}</small>
                    </div>
                </div>

                <!-- Invoice Modals -->
                @foreach ($riwayats as $riwayat)
                    <div class="modal fade" id="invoiceModal{{ $riwayat->id }}" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel{{ $riwayat->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <!-- Konten yang akan di-print/convert ke PDF -->
                            <div class="modal-content" id="invoiceContent{{ $riwayat->id }}">
                                <div class="modal-header" style="border-bottom: none;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="padding: 30px;">
                                    <!-- Header Invoice -->
                                    <div class="invoice-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px;">
                                        <div class="invoice-info">
                                            <h2 style="margin: 0; font-weight: bold;">INVOICE</h2>
                                            <p style="margin: 0;">Invoice : {{ $riwayat->pelanggan->nama }}</p>
                                            <p style="margin: 0;">Tanggal: {{ $riwayat->tanggal }}</p>
                                        </div>
                                        <div class="invoice-logo">
                                            <img src="{{ asset('img/dinoco.png') }}" alt="Logo" style="max-width: 100px;">
                                        </div>
                                    </div>
                        
                                    <!-- Informasi Perusahaan & Pelanggan -->
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-6">
                                            <h4 style="margin-bottom: 10px;">Perusahaan</h4>
                                            <p style="margin: 0;">Dinoco</p>
                                            <p style="margin: 0;">Jl. Raya Otomotif No.99, Yogyakarta</p>
                                            <p style="margin: 0;">Telepon: 0123456789</p>
                                            <p style="margin: 0;">Email: dinoco@gmail.com</p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <h4 style="margin-bottom: 10px;">Pelanggan</h4>
                                            <p style="margin: 0;">Nama: {{ $riwayat->pelanggan->nama ?? '-' }}</p>
                                            <p style="margin: 0;">Alamat: {{ $riwayat->pelanggan->alamat ?? '-' }}</p>
                                            <p style="margin: 0;">Telepon: {{ $riwayat->pelanggan->hp ?? '-' }}</p>
                                            <p style="margin: 0;">Kendaraan: {{ $riwayat->kendaraan->nopol ?? '-' }}</p>
                                        </div>
                                    </div>
                        
                                    <!-- Detail Transaksi -->
                                    <div class="invoice-details" style="margin-bottom: 20px;">
                                        <h5>Detail Transaksi</h5>
                                        <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
                                            <thead>
                                                <tr style="background: #f2f2f2;">
                                                    <th style="padding: 8px;">Deskripsi</th>
                                                    <th style="padding: 8px;" class="text-right">Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Jasa Servis --}}
                                                <tr>
                                                    <td style="padding: 8px;">Jasa Servis ({{ $riwayat->jasaServis->jenis ?? '-' }})</td>
                                                    <td style="padding: 8px;" class="text-right">
                                                        Rp{{ number_format($riwayat->jasaServis->harga, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                {{-- Sparepart --}}
                                                @php
                                                    $decodedSpareparts = json_decode($riwayat->kode_sparepart, true);
                                                    $decodedSpareparts = is_array($decodedSpareparts) ? $decodedSpareparts : [];
                                                    $sparepartCodes = array_column($decodedSpareparts, 'kode');
                                                    $sparepartsDetail = \App\Models\Sparepart::whereIn('kode', $sparepartCodes)->get()->keyBy('kode');
                                                    $totalSparepartPrice = 0;
                                                @endphp
                                                @if(count($decodedSpareparts) > 0)
                                                    @foreach($decodedSpareparts as $item)
                                                        @php
                                                            if (is_array($item) && isset($item['kode'])) {
                                                                $kode = $item['kode'];
                                                                $jumlah = $item['jumlah'] ?? 1;
                                                            } elseif (is_string($item)) {
                                                                $kode = $item;
                                                                $jumlah = 1;
                                                            } else {
                                                                continue;
                                                            }
                                                            $sparepart = $sparepartsDetail->get($kode);
                                                            if ($sparepart) {
                                                                $subTotal = $sparepart->harga * $jumlah;
                                                                $totalSparepartPrice += $subTotal;
                                                            }
                                                        @endphp
                                                        @if(isset($sparepart))
                                                            <tr>
                                                                <td style="padding: 8px;">Sparepart: {{ $sparepart->nama }} ({{ $jumlah }})</td>
                                                                <td style="padding: 8px;" class="text-right">
                                                                    Rp{{ number_format($sparepart->harga * $jumlah, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="2" style="padding: 8px;">Tidak ada sparepart</td>
                                                    </tr>
                                                @endif
                                                {{-- Total Transaksi --}}
                                                @php
                                                    $total = $riwayat->jasaServis->harga + $totalSparepartPrice;
                                                @endphp
                                                <tr style="font-weight: bold;">
                                                    <td style="padding: 8px;">Total</td>
                                                    <td style="padding: 8px;" class="text-right">
                                                        Rp{{ number_format($total, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                        
                                    <!-- Footer Invoice -->
                                    <div class="invoice-footer" style="border-top: 2px solid #333; padding-top: 10px; text-align: center;">
                                        <p>Terima kasih atas kepercayaan Anda!</p>
                                        <p>Invoice ini sah tanpa tanda tangan dan cap resmi.</p>
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top: none;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-success" onclick="printInvoice({{ $riwayat->id }})">Print Invoice</button>
                                    <button type="button" class="btn btn-primary" onclick="printInvoicePDF({{ $riwayat->id }})">Export PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End Invoice Modals -->

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include html2pdf.js untuk konversi ke PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#riwayatTable').DataTable({
                "scrollX": true,
                "language": {
                    "lengthMenu": "Tampilkan data _MENU_",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Page _PAGE_ from _PAGES_ Page",
                    "infoEmpty": "Tidak ada data tersedia",
                    "search": "Cari:",
                    "paginate": {
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });

            // SweetAlert Toast untuk notifikasi Sukses dan Error
            @if(session('success'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            @endif

            @if(session('error'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "{{ session('error') }}"
                });
            @endif

            // Konfirmasi Hapus dengan SweetAlert2
            $('.delete-btn').on('click', function (e) {
                e.preventDefault();
                let url = $(this).data('url');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#fd7e14',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('<form>', {
                            'method': 'POST',
                            'action': url
                        }).append(
                            $('<input>', { 'type': 'hidden', 'name': '_token', 'value': '{{ csrf_token() }}' }),
                            $('<input>', { 'type': 'hidden', 'name': '_method', 'value': 'DELETE' })
                        ).appendTo('body').submit();
                    }
                });
            });

            // Konfirmasi untuk menyelesaikan proses dengan SweetAlert2
            $('.selesai-btn').on('click', function (e) {
                e.preventDefault();
                let url = $(this).data('url');

                Swal.fire({
                    title: 'Konfirmasi Selesai',
                    text: "Apakah Anda yakin ingin menyelesaikan proses ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#fd7e14',
                    confirmButtonText: 'Ya, selesaikan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('<form>', {
                            'method': 'POST',
                            'action': url
                        }).append(
                            $('<input>', { 'type': 'hidden', 'name': '_token', 'value': '{{ csrf_token() }}' })
                        ).appendTo('body').submit();
                    }
                });
            });
        });

        // Fungsi untuk mencetak invoice menggunakan window.print()
        function printInvoice(id) {
            var invoiceContent = document.getElementById('invoiceModal' + id).innerHTML;
            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Invoice Servis - ' + id + '</title>');
            printWindow.document.write('<link rel="stylesheet" href="{{ asset('css/app.css') }}">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }

        // Fungsi untuk mengonversi invoice ke PDF menggunakan html2pdf.js
        function printInvoicePDF(id) {
            var element = document.getElementById('invoiceModal' + id);
            var opt = {
                margin:       0.5,
                filename:     'invoice-' + id + '.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endpush
