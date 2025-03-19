@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0 text-dark">Kendaraan</h2>
                    <a href="{{ route('kendaraan.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus"></i> Tambah Kendaraan
                    </a>
                </div>

                <div class="card shadow-lg">
                    <div class="card-header" style="background-color: #111c43; color: white;">
                        <h4 class="mb-0">Kendaraan List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="kendaraanTable" class="table table-hover table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Pelanggan</th>
                                        <th>Merek</th>
                                        <th>Tipe</th>
                                        <th>No. Polisi</th>
                                        <th>Transmisi</th>
                                        <th>Kapasitas</th>
                                        <th>Tahun</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kendaraans as $index => $kendaraan)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                @if($kendaraan->gambar)
                                                    <img src="{{ asset('storage/' . $kendaraan->gambar) }}" alt="Gambar Kendaraan" width="80" class="img-thumbnail gambar-kendaraan" data-src="{{ asset('storage/' . $kendaraan->gambar) }}">
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                            <td>{{ $kendaraan->pelanggan->nama }}</td>
                                            <td>{{ $kendaraan->merek }}</td>
                                            <td>{{ $kendaraan->tipe }}</td>
                                            <td>{{ $kendaraan->nopol }}</td>
                                            <td>{{ $kendaraan->transmisi }}</td>
                                            <td>{{ $kendaraan->kapasitas }} cc</td>
                                            <td>{{ $kendaraan->tahun }}</td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('kendaraan.edit', $kendaraan->nopol) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button class="btn btn-danger btn-sm delete-btn" data-url="{{ route('kendaraan.destroy', $kendaraan->nopol) }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk menampilkan gambar besar -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="modalImage" src="" class="img-fluid" alt="Gambar Kendaraan" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="color: dark;">
                    <small>Total Kendaraan: {{ $kendaraans->count() }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#kendaraanTable').DataTable({
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
        $(document).ready(function () {
            $('.gambar-kendaraan').on('click', function () {
                let src = $(this).data('src');
                $('#modalImage').attr('src', src);
                $('#imageModal').modal('show');
            });
        });
    </script>
@endpush
