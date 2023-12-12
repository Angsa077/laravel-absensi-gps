<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriController extends Controller
{

    public function index()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $tahunSkrng = date('Y');
        return view('histori.index', compact('namaBulan', 'tahunSkrng'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $user_id = Auth::user()->id;

        $histori = Absensi::where('user_id', $user_id)
        ->whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->orderBy('created_at')
        ->get();

        return view('histori.gethistori', compact('histori'));
    }
}
