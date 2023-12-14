<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
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

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Karyawan
    Route::resource('/admin/karyawan', KaryawanController::class);

    // Permission
    Route::get('/admin/permission', PermissionController::class)->name('permission.index');

    // Role
    Route::resource('admin/role', RoleController::class);

    // Monitoring
    Route::get('admin/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::post('admin/monitoring/getabsensi', [MonitoringController::class, 'getabsensi'])->name('monitoring.getabsensi');
    Route::post('admin/monitoring/tampilkanpeta', [MonitoringController::class, 'tampilkanpeta'])->name('monitoring.tampilkanpeta');

    // Laporan
    Route::get('admin/laporan/absensi', [LaporanController::class, 'absensi'])->name('laporan.absensi');
    Route::post('admin/laporan/cetakabsensi', [LaporanController::class, 'cetakabsensi'])->name('laporan.cetakabsensi');
    Route::get('admin/laporan/rekapabsensi', [LaporanController::class, 'rekapabsensi'])->name('laporan.rekapabsensi');
    Route::post('admin/laporan/cetakrekapabsensi', [LaporanController::class, 'cetakrekapabsensi'])->name('laporan.cetakrekapabsensi');
});
