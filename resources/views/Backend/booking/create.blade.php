@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card shadow-lg border-0">
                <div style="background-color: #111c43; color: white;" class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-calendar-plus"></i> Buat Booking Baru</h3>
                    <div class="ml-auto">
                        <a href="{{ route('booking.index') }}" class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi Kesalahan!</strong> Periksa kembali inputan Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        <!-- Row 1: NIK Pelanggan & Tanggal Booking -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik"><i class="fas fa-user"></i> Pilih NIK Pelanggan</label>
                                    <select name="nik" id="nik" class="form-control" required>
                                        <option value="">-- Pilih Pelanggan --</option>
                                        @foreach($pelanggans as $pelanggan)
                                            <option value="{{ $pelanggan->ktp }}">
                                                {{ $pelanggan->ktp }} - {{ $pelanggan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_booking"><i class="fas fa-calendar-alt"></i> Tanggal Booking</label>
                                    <input type="date" name="tanggal_booking" id="tanggal_booking" class="form-control" min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Jam Booking & Tanggal & Jam Penanganan -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="jam_booking"><i class="fas fa-clock"></i> Jam Booking</label>
                                 <select name="jam_booking" id="jam_booking" class="form-control" required>
                                    <option value="">-- Pilih Jam --</option>
                                    @for ($i = 8; $i <= 16; $i++)
                                        <option value="{{ $i }}:00 - {{ $i + 1 }}:00">
                                            {{ $i }}:00 - {{ $i + 1 }}:00
                                        </option>
                                    @endfor
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                            <div class="form-group">
                               <label for="tanggal_penanganan"><i class="fas fa-tools"></i> Tanggal & Jam Penanganan</label>
                               <input type="datetime-local" name="tanggal_penanganan" id="tanggal_penanganan" class="form-control" min="{{ date('Y-m-d\TH:i') }}">
                            </div>
                         </div>                         
                        </div>

                        <!-- Row 3: Pilih Kendaraan (Nopol) & Merek -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="nopol"><i class="fas fa-car"></i> Pilih Kendaraan (Nopol)</label>
                                 <select name="nopol" id="nopol" class="form-control" required>
                                    <option value="">-- Pilih Kendaraan --</option>
                                    @foreach($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->nopol }}"
                                            data-merek="{{ $kendaraan->merek }}"
                                            data-tipe="{{ $kendaraan->tipe }}"
                                            data-transmisi="{{ $kendaraan->transmisi }}"
                                            data-kapasitas="{{ $kendaraan->kapasitas }}"
                                            data-tahun="{{ $kendaraan->tahun }}">
                                            {{ $kendaraan->nopol }} - {{ $kendaraan->merek }}
                                        </option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="merek"><i class="fas fa-tag"></i> Merek</label>
                                 <input type="text" id="merek" name="merek" class="form-control" readonly>
                              </div>
                           </div>
                        </div>

                        <!-- Row 4: Tipe & Transmisi -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="tipe"><i class="fas fa-car-side"></i> Tipe</label>
                                 <input type="text" id="tipe" name="tipe" class="form-control" readonly>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="transmisi"><i class="fas fa-cogs"></i> Transmisi</label>
                                 <input type="text" id="transmisi" name="transmisi" class="form-control" readonly>
                              </div>
                           </div>
                        </div>

                        <!-- Row 5: Kapasitas & Tahun -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="kapasitas"><i class="fas fa-users"></i> Kapasitas</label>
                                 <input type="number" id="kapasitas" name="kapasitas" class="form-control" readonly>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="tahun"><i class="fas fa-calendar"></i> Tahun</label>
                                 <input type="text" id="tahun" name="tahun" class="form-control" readonly>
                              </div>
                           </div>
                        </div>

                        <!-- Row 6: Nomor Antrian & Status (berjejer) -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="no_antrian_per_hari"><i class="fas fa-list-ol"></i> Nomor Antrian</label>
                                 <input type="text" id="no_antrian_per_hari" class="form-control" readonly>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="status"><i class="fas fa-info-circle"></i> Status</label>
                                 <select name="status" id="status" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                    <option value="Dikonfirmasi">Dikonfirmasi</option>
                                    <option value="Menunggu Sparepart">Menunggu Sparepart</option>
                                    <option value="Dalam Antrian">Dalam Antrian</option>
                                    <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                                    <option value="Siap Diambil">Siap Diambil</option>
                                    <option value="Selesai & Diambil">Selesai & Diambil</option>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <!-- Row 7: Keluhan (paling bawah) -->
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="keluhan"><i class="fas fa-comment-dots"></i> Keluhan</label>
                                 <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
                              </div>
                           </div>
                        </div>

                        <div class="d-flex justify-content-end">
                           <button type="submit" class="btn btn-success">
                              <i class="fas fa-save"></i> Simpan Booking
                           </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       document.getElementById('nik').addEventListener('change', function () {
    let idPelanggan = this.value;
    let kendaraanDropdown = document.getElementById('nopol');
    kendaraanDropdown.innerHTML = '<option value="">-- Pilih Kendaraan --</option>';

    if (idPelanggan) {
        fetch(`/get-kendaraan?id_pelanggan=${idPelanggan}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Ada Kendaraan',
                        text: 'Pelanggan ini tidak memiliki kendaraan!',
                    });
                }

                data.forEach(kendaraan => {
                    let option = document.createElement('option');
                    option.value = kendaraan.nopol;
                    option.text = `${kendaraan.nopol} - ${kendaraan.merek}`;
                    option.setAttribute('data-merek', kendaraan.merek);
                    option.setAttribute('data-tipe', kendaraan.tipe);
                    option.setAttribute('data-transmisi', kendaraan.transmisi);
                    option.setAttribute('data-kapasitas', kendaraan.kapasitas);
                    option.setAttribute('data-tahun', kendaraan.tahun);
                    kendaraanDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan dalam mengambil data kendaraan.',
                });
            });
    }
});

        document.getElementById('nopol').addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];

            document.getElementById('merek').value = selectedOption.getAttribute('data-merek') || '';
            document.getElementById('tipe').value = selectedOption.getAttribute('data-tipe') || '';
            document.getElementById('transmisi').value = selectedOption.getAttribute('data-transmisi') || '';
            document.getElementById('kapasitas').value = selectedOption.getAttribute('data-kapasitas') || '';
            document.getElementById('tahun').value = selectedOption.getAttribute('data-tahun') || '';
        });

        $(document).ready(function() {
        $('#jam_booking').change(function() {
            var tanggal = $('#tanggal_booking').val();
            var jam = $(this).val();
            
            if (tanggal && jam) {
                $.ajax({
                    url: '/check-availability',
                    type: 'GET',
                    data: { tanggal_booking: tanggal, jam_booking: jam },

                    error: function(xhr, status, error) {
                        console.error("Error pengecekan: " + error);
                    }
                });
            }
        });
    });

//     $(document).ready(function() {
//     $('#jam_booking').change(function() {
//         var tanggal = $('#tanggal_booking').val();
//         var jam = $(this).val();
        
//         if (tanggal && jam) {
//             $.ajax({
//                 url: '/check-availability',
//                 type: 'GET',
//                 data: { tanggal_booking: tanggal, jam_booking: jam },
//                 success: function(response) {
//                     if (response.exists) {
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Oops...',
//                             text: 'Jam ini sudah dibooking! Silakan pilih jam lain.'
//                         });
//                         $('#jam_booking').val(''); // Reset pilihan jam
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.error("Error pengecekan: " + error);
//                 }
//             });
//         }
//     });
// });
$(document).ready(function() {
        $('#tanggal_booking, #jam_booking').on('change', function() {
            let tanggal_booking = $('#tanggal_booking').val();
            let jam_booking = $('#jam_booking').val();

            if (tanggal_booking && jam_booking) {
                $.ajax({
                    url: "{{ url('/booking/antrian-by-jam') }}",
                    type: "GET",
                    data: {
                        tanggal_booking: tanggal_booking,
                        jam_booking: jam_booking
                    },
                    success: function(response) {
                        if (response.no_antrian_per_hari !== null) {
                            $('#no_antrian_per_hari').val(response.no_antrian_per_hari);
                        } else {
                            $('#no_antrian_per_hari').val('Belum ada antrian di jam ini');
                        }
                    }
                });
            }
        });
    });
    </script>
@endsection