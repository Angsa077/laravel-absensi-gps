<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        return view('admin.monitoring.index');
    }

    public function getabsensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $absensi = Absensi::select('absensis.*', 'users.name')
                        ->join('users', 'users.id', '=', 'absensis.user_id')
                        ->whereDate('absensis.created_at', $tanggal)
                        ->get();
        return view('admin.monitoring.getabsensi', compact('absensi'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $absensi = Absensi::find($id)
                        ->select('absensis.*', 'users.name')
                        ->join('users', 'users.id', '=', 'absensis.user_id')
                        ->first();
        return view('admin.monitoring.showmap', compact('absensi'));
    }
}
