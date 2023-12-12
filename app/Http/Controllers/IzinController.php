<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = Izin::where('user_id', $user_id)->get();
        return view('izin.index', compact('data'));
    }

    public function create()
    {
        return view('izin.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $data = [
            'user_id' => $user_id,
            'tgl_izin' => $request->tgl_izin,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ];

        $simpan = Izin::create($data);

        if ($simpan) {
            return redirect()->route('izin.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('izin.index')->with(['error' => 'Data Gagal Disimpan']);
        }
    }
}
