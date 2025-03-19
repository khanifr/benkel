@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0 text-dark">Jasa Servis</h2>
                    <a href="{{ route('jasa_servis.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus"></i> Tambah Jasa Servis
                    </a>
                </div>

                {{-- Menghapus notifikasi bootstrap dan menggunakan SweetAlert Toast --}}
                {{-- Jika terdapat session success atau error, notifikasi akan muncul secara otomatis --}}

                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #111c43; color: white;">
                        <h4 class="mb-0">Jasa Servis List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="jasaServisTable" class="table table-hover table-bordered table-striped w-100">
                                <thead style="color: dark;">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Harga</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jasaServis as $index => $servis)
                                        <tr class="animate__animated animate__fadeIn">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $servis->jenis }}</td>
                                            <td>{{ number_format($servis->harga, 0, ',', '.') }}</td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('jasa_servis.edit', $servis->id) }}"
                                                    class="btn btn-warning btn-sm btn-icon">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button class="btn btn-danger btn-sm btn-icon delete-btn"
                                                    data-url="{{ route('jasa_servis.destroy', $servis->id) }}">
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
                        <small>Total Jasa Servis: {{ $jasaServis->count() }}</small>
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
            $('#jasaServisTable').DataTable({
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
        });
    </script>
@endpush
