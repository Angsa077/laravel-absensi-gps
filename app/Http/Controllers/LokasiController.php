<?php

namespace App\Http\Controllers;

use App\Models\LokasiKantor;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi_kantor = LokasiKantor::where('id', 1)->first();
        return view('admin.lokasi.index', compact('lokasi_kantor'));
    }

    public function update(Request $request)
    {
        $update = LokasiKantor::where('id', 1)->update([
            'lokasi' => $request->lokasi,
            'radius' => $request->radius,
        ]);

        if ($update) {
            return redirect()->back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Disimpan']);
        }
    }
}
