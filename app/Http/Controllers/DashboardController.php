<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = date('Y-m-d');
        $bulanIni = date('m');
        $tahunIni = date('Y');
        $user_id = Auth::user()->id;

        $absensiHariIni = Absensi::whereDate('created_at', $hariIni)
            ->where('user_id', $user_id)
            ->first();

        $historiBulanIni = Absensi::whereYear('created_at', $tahunIni)
            ->whereMonth('created_at', $bulanIni)
            ->orderBy('created_at')
            ->get();

        return view('dashboard.index', compact('absensiHariIni', 'historiBulanIni'));
    }
}
