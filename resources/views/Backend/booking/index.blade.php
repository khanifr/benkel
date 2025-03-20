@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0 text-dark">Booking</h2>
                    <a href="{{ route('booking.create') }}" class="btn btn-primary btn-lg ms-3">
                        <i class="fas fa-plus"></i> Create New Booking
                    </a>
                   
                </div>                

                {{-- Menghapus alert bootstrap dan menggantinya dengan SweetAlert untuk notifikasi --}}
                {{-- Jika ada pesan sukses atau error, notifikasi akan muncul sebagai toast --}}

                <div class="card shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #111c43; color: white;">
                        <h4 class="mb-0">Booking List</h4>
                        <div class="d-flex align-items-center">
                            <form method="GET" action="{{ route('booking.index') }}" class="d-flex align-items-center">
                                <label for="tanggal" class="mb-0 me-2 fw-bold">Pilih Tanggal:</label>
                                <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal', now()->toDateString()) }}" class="form-control form-control-sm w-auto me-2" onchange="this.form.submit()">
                            </form>
                        </div>
                    </div>       

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="bookingTable" class="table table-hover table-bordered table-striped w-100">
                                <thead style="color: dark;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK & Nama Pelanggan</th>
                                        <th>Tgl.Booking</th>
                                        <th>Jam Kedatangan</th>
                                        <th>Tgl.Penanganan</th>
                                        <th>Keluhan</th>
                                        <th>No.Antrian</th>
                                        <th>No.Pol</th>
                                        <th>Merek</th>
                                        <th>Tipe</th>
                                        <th>Transmisi</th>
                                     
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $index => $booking)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{$booking->nik}} - {{ $booking->pelanggan->nama ?? '-' }}</td>
                                        <td>{{ $booking->tanggal_booking }}</td>
                                        <td>{{ $booking->jam_booking }}</td>
                                        <td>{{ $booking->tanggal_penanganan }}</td>
                                        <td>{{ $booking->keluhan }}</td>
                                        <td>{{ $booking->no_antrian_per_hari }}</td>
                                        <td>{{ $booking->nopol }}</td>
                                        <td>{{ $booking->merek }}</td>
                                        <td>{{ $booking->tipe }} - {{ $booking->kapasitas }}</td>
                                        <td>{{ $booking->transmisi }}</td>
                                    
                                        <td>{{ $booking->tahun }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('booking.show', $booking->no_urut) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('booking.edit', $booking->no_urut) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-btn" data-url="{{ route('booking.destroy', $booking->no_urut) }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            @if ($booking->status == 'Siap Diambil')
                                            <a href="{{ route('riwayats.create1', $booking->no_urut) }}" class="btn btn-success">
                                                Buat Riwayat
                                            </a>
                                        @endif
                                            {{-- Dropdown untuk mengubah status --}}
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Ubah Status
                                                </button>
                                                <div class="dropdown-menu">
                                                    @foreach(['Menunggu', 'Dibatalkan', 'Dikonfirmasi', 'Menunggu Sparepart', 'Dalam Antrian', 'Sedang Dikerjakan', 'Siap Diambil', 'Selesai & Diambil'] as $status)
                                                        <a class="dropdown-item update-status" href="#" data-url="{{ route('booking.update_status', ['id' => $booking->no_urut, 'status' => $status]) }}">
                                                            {{ $status }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer" style="color: dark;">
                        <small>Total Booking: {{ $bookings->count() }}</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
<style>
    /* Tambahkan CSS ini untuk memastikan scrolling lebih baik */
.table-responsive {
    overflow-x: auto; /* Pastikan tabel bisa di-scroll horizontal */
    white-space: nowrap; /* Hindari pemecahan teks */
}

</style>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables dengan pengaturan tambahan
            $('#bookingTable').DataTable({
                "scrollX": false, // Matikan scroll horizontal bawaan DataTables
                "autoWidth": false, // Mencegah DataTables mengubah lebar kolom otomatis
                "language": {
                    "lengthMenu": "Tampilkan data _MENU_",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Page _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "search": "Cari:",
                    "paginate": {
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });
    
            // SweetAlert Toast untuk Notifikasi
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
    
            @if(session('success'))
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            @endif
    
            @if(session('error'))
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
    
            // Konfirmasi Perubahan Status
            $('.update-status').on('click', function (e) {
                e.preventDefault();
                let url = $(this).data('url');
    
                Swal.fire({
                    title: 'Konfirmasi Perubahan Status',
                    text: "Apakah Anda yakin ingin mengubah status booking ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'PATCH',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                Swal.fire('Berhasil!', 'Status telah diperbarui.', 'success')
                                    .then(() => location.reload());
                            },
                            error: function (xhr) {
                                let errorMessage = "Terjadi kesalahan, coba lagi.";
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    errorMessage = xhr.responseJSON.error;
                                }
                                Swal.fire('Gagal!', errorMessage, 'error');
                            }
                        });
                    }
                });
            });
    
            // Saat tombol "Buat Riwayat" ditekan
            $('.create-history').on('click', function (e) {
                e.preventDefault();
                let url = $(this).data('url');
    
                Swal.fire({
                    title: 'Konfirmasi Buat Riwayat',
                    text: "Apakah Anda yakin ingin menyimpan riwayat ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function (response) {
                                Swal.fire('Berhasil!', 'Riwayat telah disimpan.', 'success')
                                    .then(() => location.reload());
                            },
                            error: function (xhr) {
                                let errorMessage = "Terjadi kesalahan, coba lagi.";
                                if (xhr.responseJSON && xhr.responseJSON.error) {
                                    errorMessage = xhr.responseJSON.error;
                                }
                                Swal.fire('Gagal!', errorMessage, 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
    
@endpush
