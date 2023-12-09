<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function create()
    {
        $tgl_absensi = date("Y-m-d");
        $user_id = Auth::user()->id;
        $cek = DB::table('absensis')->whereDate('created_at', $tgl_absensi)->where('user_id', $user_id)->count();
        return view('absensi.create', compact('cek'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->nip;
        $tgl_absensi = date("Y-m-d");
        $lokasi = $request->lokasi;
        $image = $request->image;
        $folderPathMasuk = "public/uploads/absensi/foto_masuk/";
        $folderPathKeluar = "public/uploads/absensi/foto_keluar/";
        $formatName = $user_name . "-" . $tgl_absensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $fileMasuk = $folderPathMasuk . $fileName;
        $fileKeluar = $folderPathKeluar . $fileName;
        $cek = DB::table('absensis')->whereDate('created_at', $tgl_absensi)->where('user_id', $user_id)->count();

        if ($cek > 0) {
            $absensi = Absensi::whereDate('created_at', $tgl_absensi)->where('user_id', $user_id)->first();
            $simpan = $absensi->update([
                'foto_keluar' => $fileName,
                'lokasi_keluar' => $lokasi,
            ]);

            if ($simpan) {
                Storage::put($fileKeluar, $image_base64);
                echo "success|Terimakasih, Hati Hati Di Jalan|out";
            } else {
                echo "error|Maaf Absen Gagal, Silahkan Hubungi Pihak IT!|out";
            }
        } else {
            $absensi = new Absensi([
                'user_id' => $user_id,
                'foto_masuk' => $fileName,
                'lokasi_masuk' => $lokasi,
            ]);
            $simpan = $absensi->save();

            if ($simpan) {
                Storage::put($fileMasuk, $image_base64);
                echo "success|Terimakasih, Selamat Bekerja|in";
            } else {
                echo "error|Maaf Absen Gagal, Silahkan Hubungi Pihak IT!|in";
            }
        }
    }
}
