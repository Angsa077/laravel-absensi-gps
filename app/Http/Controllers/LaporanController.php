<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function absensi()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $tahunSkrng = date('Y');
        $karyawan = User::select('id', 'name')->orderBy('name')->get();
        return view('admin.laporan.absensi', compact('namaBulan', 'tahunSkrng', 'karyawan'));
    }

    public function cetakabsensi(Request $request)
    {
        $user_id = $request->user_id;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $karyawan = User::where('id', $user_id)->first();
        $absensi = Absensi::where('user_id', $user_id)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at')
            ->get();

        if (isset($_POST['exportexcel'])) {
            // Fungsi header dengan mengirimkan data raw ke excel
            header("Content-type: application/vnd-ms-excel");
            // Mendefinisikan nama file ekspor "report-rekap-absensi-".$time.".xls"
            header("Content-Disposition: attachment; filename=Report-Absensi-Karyawan-" . $karyawan->name . "-" . $bulan . "-" . $tahun . ".xls");
            return view('admin.laporan.cetakabsensiexcel', compact('user_id', 'namaBulan', 'bulan', 'tahun', 'karyawan', 'absensi'));
        }

        return view('admin.laporan.cetakabsensi', compact('user_id', 'namaBulan', 'bulan', 'tahun', 'karyawan', 'absensi'));
    }

    public function rekapabsensi()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $tahunSkrng = date('Y');
        return view('admin.laporan.rekapabsensi', compact('namaBulan', 'tahunSkrng'));
    }

    public function cetakrekapabsensi(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $absensi = Absensi::selectRaw('users.nip, users.name,
        MAX(IF(DAY(absensis.created_at) = 1, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_1,
        MAX(IF(DAY(absensis.created_at) = 2, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_2,
        MAX(IF(DAY(absensis.created_at) = 3, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_3,
        MAX(IF(DAY(absensis.created_at) = 4, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_4,
        MAX(IF(DAY(absensis.created_at) = 5, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_5,
        MAX(IF(DAY(absensis.created_at) = 6, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_6,
        MAX(IF(DAY(absensis.created_at) = 7, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_7,
        MAX(IF(DAY(absensis.created_at) = 8, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_8,
        MAX(IF(DAY(absensis.created_at) = 9, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_9,
        MAX(IF(DAY(absensis.created_at) = 10, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_10,
        MAX(IF(DAY(absensis.created_at) = 11, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_11,
        MAX(IF(DAY(absensis.created_at) = 12, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_12,
        MAX(IF(DAY(absensis.created_at) = 13, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_13,
        MAX(IF(DAY(absensis.created_at) = 14, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_14,
        MAX(IF(DAY(absensis.created_at) = 15, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_15,
        MAX(IF(DAY(absensis.created_at) = 16, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_16,
        MAX(IF(DAY(absensis.created_at) = 17, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_17,
        MAX(IF(DAY(absensis.created_at) = 18, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_18,
        MAX(IF(DAY(absensis.created_at) = 19, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_19,
        MAX(IF(DAY(absensis.created_at) = 20, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_20,
        MAX(IF(DAY(absensis.created_at) = 21, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_21,
        MAX(IF(DAY(absensis.created_at) = 22, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_22,
        MAX(IF(DAY(absensis.created_at) = 23, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_23,
        MAX(IF(DAY(absensis.created_at) = 24, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_24,
        MAX(IF(DAY(absensis.created_at) = 25, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_25,
        MAX(IF(DAY(absensis.created_at) = 26, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_26,
        MAX(IF(DAY(absensis.created_at) = 27, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_27,
        MAX(IF(DAY(absensis.created_at) = 28, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_28,
        MAX(IF(DAY(absensis.created_at) = 29, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_29,
        MAX(IF(DAY(absensis.created_at) = 30, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_30,
        MAX(IF(DAY(absensis.created_at) = 31, CONCAT(TIME_FORMAT(absensis.created_at, "%H:%i:%s"), "-", IFNULL(TIME_FORMAT(absensis.updated_at, "%H:%i:%s"), "00:00:00")), "")) as tgl_31')
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->whereMonth('absensis.created_at', $bulan)
            ->whereYear('absensis.created_at', $tahun)
            ->groupBy('users.nip', 'users.name')
            ->get();

        if (isset($_POST['exportexcel'])) {
            // Fungsi header dengan mengirimkan data raw ke excel
            header("Content-type: application/vnd-ms-excel");
            // Mendefinisikan nama file ekspor "report-rekap-absensi-".$time.".xls"
            header("Content-Disposition: attachment; filename=Report-Rekap-Absensi-Karyawan-" . $bulan . "-" . $tahun . ".xls");
        }

        return view('admin.laporan.cetakrekapabsensi', compact('bulan', 'tahun', 'namaBulan', 'absensi'));
    }
}
