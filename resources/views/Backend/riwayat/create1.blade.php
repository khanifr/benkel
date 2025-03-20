@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
       <div class="container-fluid">
          <div class="card shadow-lg border-0">
             <div style="background-color: #111c43; color: white;" class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-history"></i> Buat Riwayat dari Booking</h3>
                <div class="ml-auto">
                   <a href="{{ route('booking.index') }}" class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                      <i class="fas fa-arrow-left"></i> Back
                   </a>
                </div>
             </div>
             @if ($errors->any())
             <div class="alert alert-danger m-3">
                <strong>Terjadi Kesalahan!</strong> Periksa kembali inputan Anda.<br><br>
                <ul>
                   @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                   @endforeach
                </ul>
             </div>
             @endif
             <div class="card-body">
                <form action="{{ route('riwayats.store') }}" method="POST">
                   @csrf
                   <!-- Hidden input untuk no_urut -->
                   <input type="hidden" name="no_urut" value="{{ $booking->no_urut }}">

                   <!-- Row 1: Tanggal & Keluhan -->
                   <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="tanggal"><i class="fas fa-calendar-alt"></i> Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ now()->toDateString() }}" readonly>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="keluhan"><i class="fas fa-comment-dots"></i> Keluhan</label>
                            <input type="text" name="keluhan" class="form-control" value="{{ $booking->keluhan }}" readonly>
                         </div>
                      </div>
                   </div>

                   <!-- Row 2: Penanganan & Catatan -->
                   <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="penanganan"><i class="fas fa-tools"></i> Penanganan</label>
                            <input type="text" name="penanganan" class="form-control" value="Penanganan standar servis">
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="catatan"><i class="fas fa-sticky-note"></i> Catatan</label>
                            <input type="text" name="catatan" class="form-control" value="Tidak ada catatan tambahan">
                         </div>
                      </div>
                   </div>

                   <!-- Row 3: Karyawan & Nomor Polisi -->
                   <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="id_karyawan"><i class="fas fa-user-tie"></i> Karyawan</label>
                            <select name="id_karyawan" class="form-control">
                               @foreach($karyawans as $karyawan)
                                  <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                               @endforeach
                            </select>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="nopol"><i class="fas fa-car"></i> Nomor Polisi</label>
                            <input type="text" name="nopol" class="form-control" value="{{ $booking->nopol }}" readonly>
                         </div>
                      </div>
                   </div>

                   <!-- Row 4: Jasa Servis & Kode Sparepart -->
                   <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="id_jasa"><i class="fas fa-concierge-bell"></i> Jasa Servis</label>
                            <select name="id_jasa" class="form-control">
                               @foreach($jasaServis as $jasa)
                                  <option value="{{ $jasa->id }}">{{ $jasa->jenis }}</option>
                               @endforeach
                            </select>
                         </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-cogs"></i> Pilih Sparepart</label>
                            <div>
                                @foreach($spareparts as $sparepart)
                                    <div class="form-check d-flex align-items-center">
                                        <input type="checkbox" name="kode_sparepart[]" value="{{ $sparepart->kode }}" class="form-check-input" id="sparepart_{{ $sparepart->kode }}">
                                        <label class="form-check-label ml-2" for="sparepart_{{ $sparepart->kode }}">
                                            {{ $sparepart->nama }}
                                            <small class="text-muted ml-2">(Tersisa: {{ $sparepart->stok }})</small>
                                        </label>
                                        <input type="number" name="jumlah_sparepart[]" class="form-control form-control-sm ml-auto" min="1" value="1" style="width: 80px;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                   </div>

                   <!-- Row 5: KTP Pelanggan & Status -->
                   <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="ktp_pelanggan"><i class="fas fa-id-card"></i> KTP Pelanggan</label>
                            <input type="text" name="ktp_pelanggan" class="form-control" value="{{ $booking->pelanggan->ktp }}" readonly>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="status"><i class="fas fa-info-circle"></i> Status</label>
                            <input type="text" name="status" class="form-control" value="Selesai & Diambil" readonly>
                         </div>
                      </div>
                   </div>

                   <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-success">
                         <i class="fas fa-save"></i> Simpan Riwayat
                      </button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
</div>
@endsection

<script>
   document.addEventListener("DOMContentLoaded", function() {
       // Ambil semua checkbox sparepart
       let checkboxes = document.querySelectorAll(".sparepart-checkbox");
   
       checkboxes.forEach(function(checkbox) {
           checkbox.addEventListener("change", function() {
               let jumlahInputDiv = document.getElementById("jumlah_" + this.value);
   
               if (this.checked) {
                   jumlahInputDiv.style.display = "block"; // Tampilkan input jumlah
               } else {
                   jumlahInputDiv.style.display = "none"; // Sembunyikan input jumlah
                   jumlahInputDiv.querySelector("input").value = "1"; // Reset nilai ke 1
               }
           });
       });
   });
   </script>