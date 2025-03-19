@extends('masterfront')

@section('contentfront')

<style>
    .profile-img {
    width: 140px;
    height: 140px;
    object-fit: cover;
}

</style>

<div class="container mt-5">
    <br>
    <br>
    <div class="row justify-content-center"> 
        <div class="col-md-10">
            <h2 class="">Profile Anda</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-header text-white bg-gradient" style="background: linear-gradient(135deg, #0056b3, #003580);">
                            <h4 class="text-center mb-0">Profil Pelanggan</h4>
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ asset('storage/pelanggan/' . $pelanggan->foto_profile) ?: asset('default-profile.png') }}" 
                                    alt="Foto Profil" 
                                    class="profile-img rounded-circle border border-4 border-light shadow-sm mb-3"
                                    style="cursor: pointer; width: 150px; height: 150px; object-fit: cover;"
                                    data-bs-toggle="modal" data-bs-target="#profileModal">
                            
                             
                            </div>
                            <h5 class="fw-bold text-dark">{{ $pelanggan->nama }}</h5>
                            <p class="text-muted mb-2">{{ $pelanggan->email }}</p>
                            <hr class="mx-auto w-50">
                            <p class="mb-2"><i class="fas fa-id-card me-2 text-primary"></i> <strong>{{ $pelanggan->ktp }}</strong></p>
                            <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-danger"></i> {{ $pelanggan->alamat }}</p>
                            <p class="mb-2"><i class="fas fa-phone me-2 text-success"></i> {{ $pelanggan->hp }}</p>
                        </div>
                        <div class="card-footer text-center bg-light py-3">
                            <a href="{{ route('pelanggan.profile.edit') }}" class="btn btn-light shadow-sm px-4 ms-2" 
                            style="color: black; border: 1px solid black; transition: 0.3s;"
                            onmouseover="this.style.backgroundColor='black'; this.style.color='white';" 
                            onmouseout="this.style.backgroundColor='white'; this.style.color='black';">
                             <i class="fas fa-edit me-2"></i> Edit Profil
                         </a>
                         <a href="{{ route('pelanggan.riwayat') }}" class="btn btn-light shadow-sm px-4" 
                            style="color: black; border: 1px solid black; transition: 0.3s;"
                            onmouseover="this.style.backgroundColor='black'; this.style.color='white';" 
                            onmouseout="this.style.backgroundColor='white'; this.style.color='black';">
                            <i class="fas fa-history me-2"></i> Lihat Riwayat Servis
                        </a>
                        </div>
                    </div>                    
                </div>
                <!-- Modal Bootstrap -->
<!-- Modal Bootstrap dengan Gambar Lebih Besar dan Terpusat -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Tambahkan modal-lg -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <img src="{{ asset('storage/pelanggan/' . $pelanggan->foto_profile) ?: asset('default-profile.png') }}" 
                    alt="Foto Profil" 
                    class="img-fluid rounded shadow" 
                    style="max-width: 100%; max-height: 80vh;">
            </div>
        </div>
    </div>
</div>

                
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-header text-white bg-gradient" style="background: linear-gradient(135deg, #0056b3, #003580);">
                            <h4 class="text-center mb-0">Kendaraan Saya</h4>
                        </div>
                        <div class="card-body p-4">
                            @if(isset($kendaraans) && $kendaraans->count() > 0)
                                <div class="row">
                                    @foreach($kendaraans as $kendaraan)
                                        <div class="col-md-6 mb-4">
                                            <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                                                <img src="{{ asset('storage/' . $kendaraan->gambar ?: 'default-vehicle.png') }}" 
                                                     class="card-img-top" style="height: 160px; object-fit: cover; border-bottom: 4px solid #ffc107;">
                                                <div class="card-body text-center">
                                                    <h6 class="fw-bold text-dark">{{ $kendaraan->tipe }} - {{ $kendaraan->nopol }}</h6>
                                                    <p class="mb-2 text-muted">
                                                        <strong class="text-primary">Merek:</strong> {{ $kendaraan->merek }}<br>
                                                        <strong class="text-success">Transmisi:</strong> {{ $kendaraan->transmisi }}<br>
                                                        <strong class="text-danger">Tahun:</strong> {{ $kendaraan->tahun }}
                                                    </p>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <!-- Tombol Edit -->
                                                        <form action="{{ route('pelanggan.kendaraan.edit', ['nopol' => $kendaraan->nopol]) }}" method="GET">
                                                            <button type="submit" class="btn btn-light btn-sm shadow-sm px-4" 
                                                                    style="color: black; border: 1px solid black; transition: 0.3s;"
                                                                    onmouseover="this.style.backgroundColor='black'; this.style.color='white';" 
                                                                    onmouseout="this.style.backgroundColor='white'; this.style.color='black';">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button>
                                                        </form>
                                                    
                                                        <!-- Tombol Booking -->
                                                        @if($kendaraan->sudahDibooking)
                                                            <button class="btn btn-secondary btn-sm shadow-sm px-4" disabled>
                                                                <i class="fas fa-calendar-alt"></i> Sudah Dibooking
                                                            </button>
                                                        @else
                                                        <form action="{{ route('booking.pelanggan.create', ['nopol' => $kendaraan->nopol]) }}" method="GET">
                                                            <button type="submit" class="btn btn-light btn-sm shadow-sm px-4" 
                                                                    style="color: black; border: 1px solid black; transition: 0.3s;"
                                                                    onmouseover="this.style.backgroundColor='#28a745'; this.style.color='white'; this.style.borderColor='#218838';" 
                                                                    onmouseout="this.style.backgroundColor='white'; this.style.color='black'; this.style.borderColor='black';">
                                                                <i class="fas fa-calendar-alt"></i> Booking
                                                            </button>
                                                        </form>
                                                        
                                                        @endif
                                                    
                                                        <!-- Tombol Delete -->
                                                        <form id="delete-form-{{ $kendaraan->nopol }}" action="{{ route('pelanggan.kendaraan.delete', ['nopol' => $kendaraan->nopol]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            
                                                            <button type="button" class="btn btn-light btn-sm shadow-sm px-4 delete-btn" 
                                                            data-nopol="{{ $kendaraan->nopol }}" 
                                                            style="color: black; border: 1px solid black; transition: 0.3s;"
                                                            onmouseover="this.style.backgroundColor='#d9534f'; this.style.color='white'; this.style.borderColor='#d43f3a';" 
                                                            onmouseout="this.style.backgroundColor='white'; this.style.color='black'; this.style.borderColor='black';">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                    
                                                        </form>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info text-center p-3 rounded-3 shadow-sm">
                                    <i class="fas fa-info-circle"></i> Anda belum memiliki kendaraan.
                                </div>
                            @endif
                        </div>
                        <div class="card-footer text-center bg-light py-3">
                            <a href="{{ route('pelanggan.profile.create') }}" class="btn btn-light shadow-sm px-4" 
                               style="color: black; border: 1px solid black; transition: 0.3s;"
                               onmouseover="this.style.backgroundColor='black'; this.style.color='white';" 
                               onmouseout="this.style.backgroundColor='white'; this.style.color='black';">
                                <i class="fas fa-plus me-2"></i> Tambah Kendaraan
                            </a>

                            
                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Pilih semua tombol dengan class "delete-btn"
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let nopol = this.getAttribute("data-nopol");
                Swal.fire({
                    title: "Hapus Kendaraan?",
                    text: "Apakah Anda yakin ingin menghapus kendaraan ini? Tindakan ini tidak bisa dibatalkan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${nopol}`).submit();
                    }
                });
            });
        });
    });
    </script>
    