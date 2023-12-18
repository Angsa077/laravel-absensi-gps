<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Middleware "auth"
Route::group(['middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Absensi
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    // Histori
    Route::get('/histori', [HistoriController::class, 'index'])->name('histori.index');
    Route::post('/gethistori', [HistoriController::class, 'gethistori'])->name('absensi.gethistori');

    // Izin
    Route::get('/izin', [IzinController::class, 'index'])->name('izin.index');
    Route::get('/izin/create', [IzinController::class, 'create'])->name('izin.create');
    Route::post('/izin', [IzinController::class, 'store'])->name('izin.store');
    Route::post('/izin/cekpengajuanizin', [IzinController::class, 'cekpengajuanizin'])->name('izin.cekpengajuanizin');

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')
    ->middleware('permission:admin.index');

    // Karyawan
    Route::resource('/admin/karyawan', KaryawanController::class)
    ->middleware('permission:karyawan.index|karyawan.create|karyawan.edit|karyawan.delete');

    // Permission
    Route::get('/admin/permission', PermissionController::class)->name('permission.index')
    ->middleware('permission:permission.index');

    // Role
    Route::resource('admin/role', RoleController::class)
    ->middleware('permission:role.index|role.create|role.edit|role.delete');

    // Lokasi Kantor
    Route::get('/admin/lokasi', [LokasiController::class, 'index'])->name('lokasi.index')
    ->middleware('permission:lokasi.index');
    Route::post('admin/lokasi/update', [LokasiController::class, 'update'])->name('lokasi.update');

    Route::get('/admin/jamkerja', [LokasiController::class, 'index'])->name('jamkerja.index')
    ->middleware('permission:jamkerja.index');
    Route::post('admin/jamkerja/update', [LokasiController::class, 'update'])->name('jamkerja.update');

    // Monitoring
    Route::get('admin/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index')
    ->middleware('permission:monitoring.index');
    Route::post('admin/monitoring/getabsensi', [MonitoringController::class, 'getabsensi'])->name('monitoring.getabsensi');
    Route::post('admin/monitoring/tampilkanpeta', [MonitoringController::class, 'tampilkanpeta'])->name('monitoring.tampilkanpeta');

    // Laporan
    Route::get('admin/laporan/absensi', [LaporanController::class, 'absensi'])->name('laporan.absensi')
    ->middleware('permission:laporan.absensi');
    Route::post('admin/laporan/cetakabsensi', [LaporanController::class, 'cetakabsensi'])->name('laporan.cetakabsensi');

    Route::get('admin/laporan/rekapabsensi', [LaporanController::class, 'rekapabsensi'])->name('laporan.rekapabsensi')
    ->middleware('permission:laporan.rekapabsensi');
    Route::post('admin/laporan/cetakrekapabsensi', [LaporanController::class, 'cetakrekapabsensi'])->name('laporan.cetakrekapabsensi');

    // Izin Approve
    Route::get('/admin/izin', [IzinController::class, 'handle'])->name('izin.handle')
    ->middleware('permission:izin.handle');
    Route::post('/admin/izin/approved', [IzinController::class, 'approved'])->name('izin.approved');
    Route::get('/admin/izin/{id}/cancel', [IzinController::class, 'cancel'])->name('izin.cancel')
    ->middleware('permission:izin.cancel');
});
