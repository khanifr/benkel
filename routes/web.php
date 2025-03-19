<?php

// pelangganz
use App\Http\Controllers\ProfilePelangganController;
use App\Http\Controllers\PelangganKendaraanController;
use App\Http\Controllers\BookingPelangganController;
use App\Http\Controllers\RiwayatPelangganController;
use App\Http\Controllers\PelangganAuthController;


// admin
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\JasaServisController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DashboardController;
use App\Models\Kendaraan;
use App\Models\Karyawan;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PelangganLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('pelanggan.register');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [PelangganLoginController::class, 'showLoginForm'])
    ->name('pelanggan.login');

Route::post('/login', [PelangganLoginController::class, 'login']);

Route::post('/pelanggan/logout', [PelangganLoginController::class, 'logout'])
    ->name('pelanggan.logout');

Route::middleware('pelanggan')->group(function () {
    Route::get('/pelanggan/dashboard', function () {
        return view('dashboard.index');
    })->name('pelanggan.dashboard');
});

Route::get('/', function () {
    $karyawans = Karyawan::all(); // Ambil semua data dari tabel karyawans
    return view('welcome', compact('karyawans')); // Kirim ke view
})->name("welcome");

Route::get('/unggulan', function () {
    return view('unggulan');
})->name("unggulan");
Route::get('/layanan', action: function () {
    return view('layanan');
})->name("layanan");
Route::get("/maps", function () {
    return view("maps");
})->name("maps");
Route::get("/about", function () {
    return view("about");
})->name("about");



// pelangganz
// Rute untuk halaman riwayat pelanggan
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/invoice', [RiwayatPelangganController::class, 'index'])->name('riwayat.pelanggan.index');
    Route::get('/invoice/{id}', [RiwayatPelangganController::class, 'show'])->name('riwayat.show');
});
// Group route yang memerlukan autentikasi pelanggan
Route::middleware(['auth:pelanggan'])->group(function () {
    // Route Profile pelanggan (dari code 1)
    Route::get('/pelanggan/profile', [ProfilePelangganController::class, 'profile'])->name('pelanggan.profile');
    Route::get('/pelanggan/profile/edit', [ProfilePelangganController::class, 'editProfile'])->name('pelanggan.profile.edit');
    Route::put('/pelanggan/profile/update', [ProfilePelangganController::class, 'updateProfile'])->name('pelanggan.profile.update');

    // Route untuk halaman riwayat/invoice (dari code 2)
    Route::get('/invoice', [RiwayatPelangganController::class, 'index'])->name('riwayat.pelanggan.index');
    Route::get('/invoice/{id}', [RiwayatPelangganController::class, 'show'])->name('riwayat.show');

    // Route untuk halaman booking pelanggan
    Route::get('/bookingpelanggan', [BookingPelangganController::class, 'index'])->name('booking.pelanggan.index');
    Route::get('/bookingpelanggan/create/{nopol?}', [BookingPelangganController::class, 'create'])->name('booking.pelanggan.create');
    Route::post('/bookingpelanggan', [BookingPelangganController::class, 'store'])->name('booking.pelanggan.store');
    Route::get('/bookingpelanggan/edit/{id}', [BookingPelangganController::class, 'edit'])->name('booking.pelanggan.edit');
    Route::put('/bookingpelanggan/update/{id}', [BookingPelangganController::class, 'update'])->name('booking.pelanggan.update');
    Route::delete('/bookingpelanggan/{id}', [BookingPelangganController::class, 'destroy'])->name('booking.pelanggan.destroy');


    // Route untuk pelanggan yang ingin mengelola kendaraan dan melihat profil
    // (Perhatikan bahwa nama route disesuaikan agar tidak terjadi konflik dengan route profile di atas)
    Route::get('/profil', [PelangganAuthController::class, 'showProfile'])->name('pelanggan.profile.show');
    Route::get('/pelanggan/profile/create', [PelangganKendaraanController::class, 'create'])->name('pelanggan.profile.create');
    Route::post('/profil/kendaraan/store', [PelangganKendaraanController::class, 'store'])->name('pelanggan.kendaraan.store');
    Route::get('/profil/kendaraan/edit/{nopol}', [PelangganKendaraanController::class, 'edit'])->name('pelanggan.kendaraan.edit');
    Route::put('/profil/kendaraan/update/{nopol}', [PelangganKendaraanController::class, 'update'])->name('pelanggan.kendaraan.update');
    Route::delete('/profil/kendaraan/{id}', [PelangganKendaraanController::class, 'destroy_pelanggan'])->name('pelanggan.kendaraan.destroy');
    Route::delete('/pelanggan/kendaraan/delete/{nopol}', [PelangganKendaraanController::class, 'delete'])
        ->name('pelanggan.kendaraan.delete');

    // routes riwayat
    Route::get('/pelanggan/riwayat', [RiwayatPelangganController::class, 'index'])->name('pelanggan.riwayat');
    Route::get('/pelanggan/riwayat/{id}', [RiwayatPelangganController::class, 'show'])->name('pelanggan.riwayat.show');
});



//ADMINNNNNNNNNN  
//Riwayad
Route::get('/riwayat/create/{id}', [RiwayatController::class, 'create1'])->name('riwayats.create1');
Route::post('/riwayat/store', [RiwayatController::class, 'store'])->name('riwayats.store');
Route::post('/riwayat/store', [RiwayatController::class, 'store1'])->name('riwayats.store');


//BOoking
Route::resource('booking', BookingController::class)->middleware('auth');
Route::put('/booking/{no_urut}', [BookingController::class, 'update'])->name('booking.update');
Route::get('/cek-jadwal', [BookingController::class, 'cekJadwal']);
Route::get('/check-availability', [BookingController::class, 'checkAvailability']);
Route::get('/get-kendaraan', [BookingController::class, 'getKendaraanByPelanggan']);
Route::patch('/booking/{id}/update-status/{status}', [BookingController::class, 'updateStatus'])->name('booking.update_status');
Route::get('/booking/antrian-by-jam', [BookingController::class, 'getAntrianByJam']);


//jaservsis
Route::resource('jasa_servis', JasaServisController::class)->middleware('auth');


//Sperpat
Route::resource('sparepart', SparepartController::class)->middleware('auth');


//Karyawan
Route::resource('karyawan', KaryawanController::class)->middleware('auth');


//Kendaraan
Route::resource('kendaraan', KendaraanController::class)->middleware('auth');
Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index')->middleware('auth');


//Pelanggan
Route::resource('pelanggan', PelangganController::class)->middleware('auth');
Route::put('/pelanggan/{pelanggan:ktp}', [PelangganController::class, 'update'])->name('pelanggan.update');


//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Riwayat
Route::get('/api/kendaraan-by-pelanggan/{ktp}', function ($ktp) {
    return Kendaraan::where('id_pelanggan', $ktp)->get();
});
Route::resource('riwayat', RiwayatController::class)->middleware(middleware: 'auth');
Route::post('/riwayat/{id}/selesai', [RiwayatController::class, 'updateStatusToSelesai'])->name('riwayat.selesai');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__ . '/auth.php';

Route::get('/admin', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/admin', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');




