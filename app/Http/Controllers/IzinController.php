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

    // Handle Izin Admin Panel
    public function handle()
    {
        $izin = Izin::when(request()->q, function ($query) {
            $query->where('users.name', 'like', '%' . request()->q . '%');
        })  ->join('users', 'users.id', '=', 'izins.user_id')
            ->select('izins.*', 'users.name', 'users.nip')
            ->latest()
            ->paginate(5);

        return view('admin.izin.handle', compact('izin'));
    }

    public function approved(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_handleizin_form = $request->id_handleizin_form;
        $update = Izin::where('id', $id_handleizin_form)->update(['status_approved' => $status_approved]);

        if ($update) {
            return redirect()->route('izin.handle')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('izin.handle')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function cancel($id)
    {
        $update = Izin::where('id', $id)->update(['status_approved' => 0]);

        if ($update) {
            return redirect()->route('izin.handle')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('izin.handle')->with(['error' => 'Data Gagal Disimpan']);
        }
    }
}
