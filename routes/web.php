<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PendaftaranEkstraController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Staff
// Halaman Kelola Staff
Route::prefix('staff/user')->group(function () {
    Route::get('/indexStaff', [StaffController::class, 'indexStaff'])->name('staff.user.indexStaff');
    Route::post('/storeStaff', [StaffController::class, 'storeStaff'])->name('staff.user.storeStaff');
    Route::put('/updateStaff/{staff}', [StaffController::class, 'updateStaff'])->name('staff.user.updateStaff');
    Route::delete('/destroyStaff/{user}', [StaffController::class, 'destroyStaff'])->name('staff.user.destroyStaff');
});

// Halaman Kelola Guru
Route::prefix('staff/user')->group(function () {
    Route::get('/indexGuru', [GuruController::class, 'indexGuru'])->name('staff.user.indexGuru');
    Route::post('/storeGuru', [GuruController::class, 'storeGuru'])->name('staff.user.storeGuru');
    Route::put('/updateGuru/{guru}', [GuruController::class, 'updateGuru'])->name('staff.user.updateGuru');
    Route::delete('/destroyGuru/{user}', [GuruController::class, 'destroyGuru'])->name('staff.user.destroyGuru');
});

// Halaman Kelola Siswa
Route::prefix('staff/user')->group(function () {
    Route::get('/indexSiswa', [SiswaController::class, 'indexSiswa'])->name('staff.user.indexSiswa');
    Route::post('/storeSiswa', [SiswaController::class, 'storeSiswa'])->name('staff.user.storeSiswa');
    Route::put('/updateSiswa/{siswa}', [SiswaController::class, 'updateSiswa'])->name('staff.user.updateSiswa');
    Route::delete('/destroySiswa/{user}', [SiswaController::class, 'destroySiswa'])->name('staff.user.destroySiswa');
});


// Halaman Kelola Mapel
Route::prefix('staff/mapel')->name('staff.mapel.')->group(function () {
    Route::get('/', [MapelController::class, 'indexMapel'])->name('index');
    Route::get('/create', [MapelController::class, 'createMapel'])->name('create');
    Route::post('/', [MapelController::class, 'storeMapel'])->name('store');
    Route::delete('/{mapel}', [MapelController::class, 'destroyMapel'])->name('destroy');
    Route::put('/{mapel}', [MapelController::class, 'updateMapel'])->name('update');
});

// Halaman Kelola Kelas
Route::prefix('staff/kelas')->name('staff.kelas.')->group(function () {
    Route::get('/', [KelasController::class, 'indexKelas'])->name('index');
    Route::get('/create', [KelasController::class, 'createKelas'])->name('create');
    Route::post('/', [KelasController::class, 'storeKelas'])->name('store');
    Route::delete('/{kelas}', [KelasController::class, 'destroyKelas'])->name('destroy');
    Route::put('/{kelas}', [KelasController::class, 'updateKelas'])->name('update');
    Route::post('/{kelas}/add-member', [KelasController::class, 'addMember'])->name('addMember');
});

// Halaman Kelola Jadwal
Route::prefix('staff/jadwal')->name('staff.jadwal.')->group(function () {
    Route::get('/', [JadwalController::class, 'indexJadwal'])->name('index');
    Route::post('/', [JadwalController::class, 'storeJadwal'])->name('store');
    Route::delete('/{jadwal}', [JadwalController::class, 'destroyJadwal'])->name('destroy');
    Route::put('/{jadwal}', [JadwalController::class, 'updateJadwal'])->name('update');
});


// Halaman Kelola Prestasi
Route::prefix('staff/prestasi')->name('staff.prestasi.')->group(function () {
    Route::get('/', [PrestasiController::class, 'indexPrestasi'])->name('index');
    Route::post('/', [PrestasiController::class, 'storePrestasi'])->name('store');
    Route::delete('/{prestasi}', [PrestasiController::class, 'destroyPrestasi'])->name('destroy');
    Route::put('/{prestasi}', [PrestasiController::class, 'updatePrestasi'])->name('update');
    Route::get('/view-pdf/{id}', [PrestasiController::class, 'viewPDF'])->name('showBukti');
    Route::put('/{prestasi}', [PrestasiController::class, 'validatePrestasi'])->name('validate');
});

// Halaman Kelola Pelanggaran
Route::prefix('staff/pelanggaran')->name('staff.pelanggaran.')->group(function () {
    Route::get('/', [PelanggaranController::class, 'indexPelanggaran'])->name('index');
    Route::post('/', [PelanggaranController::class, 'storePelanggaran'])->name('store');
    Route::delete('/{pelanggaran}', [PelanggaranController::class, 'destroyPelanggaran'])->name('destroy');
    Route::put('/{pelanggaran}', [PelanggaranController::class, 'updatePelanggaran'])->name('update');
});

// Halaman Kelola Ekstrakurikuler
Route::prefix('staff/ekstrakurikuler')->name('staff.ekstrakurikuler.')->group(function () {
    Route::get('/', [EkstrakurikulerController::class, 'indexStaff'])->name('index');
    Route::post('/', [EkstrakurikulerController::class, 'storeStaff'])->name('store');
    Route::put('/{ekstrakurikuler}/updateStatus', [EkstrakurikulerController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/{ekstrakurikuler}', [EkstrakurikulerController::class, 'destroyStaff'])->name('destroy');
    Route::put('/{ekstrakurikuler}', [EkstrakurikulerController::class, 'updateStaff'])->name('update');
});

Route::prefix('staff/nilai')->name('staff.nilai.')->group(function () {
    Route::get('/', [NilaiController::class, 'index'])->name('index');
    Route::get('/create', [NilaiController::class, 'create'])->name('create');
    Route::post('/', [NilaiController::class, 'store'])->name('store');
    Route::get('/{nilai}', [NilaiController::class, 'show'])->name('show');
    Route::put('/{nilai}', [NilaiController::class, 'update'])->name('update');
    Route::delete('/{nilai}', [NilaiController::class, 'destroy'])->name('destroy');
});

// Dashboard Staff
Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->middleware(['auth', 'verified', 'staff'])->name('staff.dashboard');

//================================== User Guru ============================================//

// Guru
Route::get('/guru/dashboard', function () {
    return view('guru.dashboard');
})->middleware(['auth', 'verified', 'guru'])->name('guru.dashboard');


Route::prefix('guru/ekstrakurikuler')->name('guru.ekstrakurikuler.')->group(function () {
    Route::get('/', [EkstrakurikulerController::class, 'indexGuru'])->name('index');
    Route::post('/', [EkstrakurikulerController::class, 'storeGuru'])->name('store');
    Route::put('/{ekstrakurikuler}/updateStatus', [EkstrakurikulerController::class, 'updateStatusP'])->name('updateStatusP');
    Route::delete('/{ekstrakurikuler}', [EkstrakurikulerController::class, 'destroyGuru'])->name('destroy');
    Route::put('/{ekstrakurikuler}', [EkstrakurikulerController::class, 'updateGuru'])->name('update');
    Route::put('/{id}/updateStatusTerima', [EkstrakurikulerController::class, 'updateStatusTerima'])->name('updateStatusTerima');
});

Route::prefix('guru/kelas')->name('guru.kelas.')->group(function () {
    Route::get('/', [KelasController::class, 'indexGuru'])->name('index');
});

Route::prefix('guru/jadwal')->name('guru.jadwal.')->group(function () {
    Route::get('/', [JadwalController::class, 'indexJadwal'])->name('index');
});

Route::prefix('guru/mapel')->name('guru.mapel.')->group(function () {
    Route::get('/', [MapelController::class, 'indexMapel'])->name('index');
});


Route::prefix('guru/absen')->name('guru.absen.')->group(function () {
    Route::get('/', [AbsenController::class, 'indexAbsen'])->name('index');
});



// Siswa
Route::prefix('siswa/prestasi')->name('siswa.prestasi.')->group(function () {
    Route::get('/', [PrestasiController::class, 'indexSiswa'])->name('index');
});

Route::prefix('siswa/pelanggaran')->name('siswa.pelanggaran.')->group(function () {
    Route::get('/', [PelanggaranController::class, 'indexSiswa'])->name('index');
});

Route::prefix('siswa/ekstrakulikuler')->name('siswa.ekstrakurikuler.')->group(function () {
    Route::get('/', [EkstrakurikulerController::class, 'indexSiswa'])->name('index');
    Route::post('/pendaftaran-ekstra', [PendaftaranEkstraController::class, 'store'])->name('store');
});

// ... existing code ...
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'siswa'])->name('dashboard');



// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

