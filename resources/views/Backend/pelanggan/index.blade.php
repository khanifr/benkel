@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0 text-dark">Pelanggan</h2>
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus"></i> Tambah Pelanggan
                    </a>
                </div>

                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #111c43; color: white;">
                        <h4 class="mb-0">Daftar Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pelangganTable" class="table table-hover table-bordered table-striped w-100">
                                <thead style="color: dark;">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>KTP</th>
                                        <th>Alamat</th>
                                        <th>No. HP</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pelanggans as $index => $pelanggan)
                                        <tr class="animate__animated animate__fadeIn">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                <img src="{{ $pelanggan->foto_profile ? asset('storage/pelanggan/' . 
                                                $pelanggan->foto_profile) : asset('img/default-user.png') }}"
                                                    alt="Foto" class="rounded-circle shadow" width="60" height="60">
                                            </td>
                                            <td>{{ $pelanggan->nama }}</td>
                                            <td>{{ $pelanggan->email }}</td>
                                            <td>{{ $pelanggan->ktp }}</td>
                                            <td>{{ $pelanggan->alamat }}</td>
                                            <td>{{ $pelanggan->hp }}</td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('pelanggan.edit', $pelanggan->ktp) }}"
                                                    class="btn btn-warning btn-sm btn-icon">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button class="btn btn-danger btn-sm btn-icon delete-btn"
                                                    data-url="{{ route('pelanggan.destroy', $pelanggan->ktp) }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer" style="; color: dark;">
                        <small>Total Pelanggan: {{ $pelanggans->count() }}</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#pelangganTable').DataTable({
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

            // SweetAlert Toast untuk Notifikasi Sukses
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
        });
    </script>
@endpush