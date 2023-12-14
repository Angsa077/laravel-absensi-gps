<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function absensi()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $tahunSkrng = date('Y');
        $karyawan = User::select('id', 'name')->orderBy('name')->get();
        return view('admin.laporan.absensi', compact('namaBulan', 'tahunSkrng', 'karyawan'));
    }

    public function cetakabsensi(Request $request)
    {
        $user_id = $request->user_id;
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $karyawan = User::where('id', $user_id)->first();
        $absensi = Absensi::where('user_id', $user_id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
        ->orderBy('created_at')
            ->get();
        return view('admin.laporan.cetakabsensi', compact('user_id', 'namaBulan', 'bulan', 'tahun', 'karyawan', 'absensi'));
    }
}
