<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Izin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $hariIni = date("Y-m-d");

        $rekabAbsensi = Absensi::selectRaw('COUNT(user_id) as jmlHadir, COALESCE(SUM(IF(TIME(created_at) > "07:00", 1, 0)), 0) as jmlTerlambat')
        ->whereDate('created_at', $hariIni)
        ->first();

        $rekabIzin = Izin::selectRaw('SUM(IF(status="i", 1,0)) as jmlIzin, SUM(IF(status="s",1,0)) as jmlSakit')
        ->whereDate('created_at', $hariIni)
        ->first();

        return view('admin.index', compact('rekabAbsensi'));
    }
}
