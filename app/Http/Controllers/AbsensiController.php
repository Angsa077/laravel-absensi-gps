<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\LokasiKantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function create()
    {
        $tgl_absensi = date('Y-m-d');
        $user_id = Auth::user()->id;
        $cek = DB::table('absensis')->whereDate('created_at', $tgl_absensi)->where('user_id', $user_id)->count();
        $lokasi_kantor = LokasiKantor::where('id', 1)->first();
        return view('absensi.create', compact('cek', 'lokasi_kantor'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->nip;
        $tgl_absensi = date('Y-m-d');

        // Lokasi User
        $lokasi = $request->lokasi;
        $lokasiUser = explode(',', $lokasi);
        $latitudeUser = $lokasiUser[0];
        $longitudeUser = $lokasiUser[1];

        // Lokasi Kantor
        $lokasi_kantor = LokasiKantor::where('id', 1)->first();
        $loktor = explode(',', $lokasi_kantor->lokasi);
        $latitudeKantor = $loktor[0];
        $longitudeKantor = $loktor[1];

        $jarak = $this->distance($latitudeKantor, $longitudeKantor, $latitudeUser, $longitudeUser); // menghitung jarak kantor dan user satuan meter
        $radius = round($jarak['meters']); // digenapkan dengan fungsi round

        $image = $request->image;
        $folderPathMasuk = "public/uploads/absensi/foto_masuk/";
        $folderPathKeluar = "public/uploads/absensi/foto_keluar/";
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileNameMasuk = $user_name . "-" . $tgl_absensi . "-masuk"  . ".png";
        $fileNameKeluar = $user_name . "-" . $tgl_absensi . "-keluar"  . ".png";
        $fileMasuk = $folderPathMasuk . $fileNameMasuk;
        $fileKeluar = $folderPathKeluar . $fileNameKeluar;
        $cek = DB::table('absensis')->whereDate('created_at', $tgl_absensi)->where('user_id', $user_id)->count();

        if ($radius > $lokasi_kantor->radius) {
            echo "error|Maaf Anda Berada Diluar Radius . Jarak Anda " . $radius . " Meter Dari Kantor!|radius";
        } else {
            if ($cek > 0) {
                $absensi = Absensi::whereDate('created_at', $tgl_absensi)->where('user_id', $user_id)->first();
                $simpan = $absensi->update([
                    'foto_keluar' => $fileNameKeluar,
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
                    'foto_masuk' => $fileNameMasuk,
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

    // Menghitung jarak kantor dan user
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}
