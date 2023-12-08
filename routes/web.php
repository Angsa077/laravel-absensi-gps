<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Middleware "auth"
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/absensi/create', [AbsensiController::class, 'create']);
});
