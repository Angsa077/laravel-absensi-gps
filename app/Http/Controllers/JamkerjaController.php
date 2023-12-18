<?php

namespace App\Http\Controllers;

use App\Models\JamKerja;
use Illuminate\Http\Request;

class JamkerjaController extends Controller
{
    public function index()
    {
        $jam_kerja = JamKerja::where('id', 1)->first();
        return view('admin.jamkerja.index', compact('lokasi_kantor'));
    }
}
