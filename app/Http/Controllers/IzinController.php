<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function cekpengajuanizin(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $user_id = Auth::user()->id;
        $cek = Izin::where('user_id', $user_id)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }

    // Handle Izin Admin Panel
    public function handle(Request $request)
    {
        $query = Izin::query();
        $query->select('izins.id', 'izins.created_at', 'users.name', 'users.nip', 'izins.status', 'izins.status_approved', 'izins.keterangan');
        $query->join('users', 'izins.user_id', '=', 'users.id');
        if (!empty($request->mulai) && !empty($request->sampai)) {
            $query->whereBetween(DB::raw('DATE(izins.created_at)'), [$request->mulai, $request->sampai]);
        }
        if (!empty($request->name)) {
            $query->where('users.name', 'like', '%' . $request->name . '%' );
        }
        if (!empty($request->nip)) {
            $query->where('users.nip', $request->nip);
        }
        if (in_array($request->status_approved, ["0", "1", "2"])) {
            $query->where('izins.status_approved', $request->status_approved);
        }
        $query->orderBy('izins.created_at', 'desc');
        $izin = $query->paginate(5);
        $izin->appends($request->all());
    
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
