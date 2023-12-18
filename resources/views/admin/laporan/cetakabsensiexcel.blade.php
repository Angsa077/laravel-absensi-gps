<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .tableDataKaryawan {
            margin-top: 40px;
        }

        .tableDataKaryawan td {
            padding: 5px;
        }

        .tableAbsensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tableAbsensi tr th {
            border: 1px solid #131212;
            padding: 8px;
            background-color: #dbdbdb;
        }

        .tableAbsensi tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: 12px;
            text-align: center;
        }

        .foto {
            width: 40px;
            height: 30px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        {{-- Table Header --}}
        <table style="width: 100%">
            <tr>
                <td>
                    <span id="title">
                        LAPORAN ABSENSI KARYAWAN <br>
                        PERIODE {{ strtoupper($namaBulan[$bulan]) }} {{ $tahun }}<br>
                        PT. ANGGA SAPUTRA<br>
                    </span>
                    <span><i>Taman Angsoka Permai Blok CB No.1 Kasemen Serang Banten</i></span>
                </td>
            </tr>
        </table>

        {{-- Table Karyawan  --}}
        <table class="tableDataKaryawan">
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>{{ $karyawan->name }}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>{{ $karyawan->nip }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $karyawan->nik }}</td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <td>{{ $karyawan->no_hp }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $karyawan->alamat }}</td>
            </tr>
        </table>

        {{-- Table Absensi --}}
        <table class="tableAbsensi">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Keterangan</th>
                    <th>Jumlah Jam</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($absensi as $item)
                    @php
                        $jamTerlambat = selisih('07:00:00', $item->jam_in);
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>{{ $item->jam_in }}</td>
                        <td>{{ $item->jam_out != null ? $item->jam_out : 'Belum Absen' }}</td>
                        <td>
                            @if ($item->jam_in > '07:00')
                                Terlambat {{ $jamTerlambat }}
                            @else
                                Tepat Waktu
                            @endif
                        </td>
                        <td>
                            @if ($item->jam_out != null)
                                @php
                                    $jmlJamKerja = selisih($item->jam_in, $item->jam_out);
                                @endphp
                            @else
                                @php
                                    $jmlJamKerja =0;
                                @endphp
                            @endif
                            {{ $jmlJamKerja }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No data found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Table Footer --}}
        <table width="100%" style="margin-top: 100px">
            <tr>
                <td colspan="2" style="text-align: right">Serang, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: bottom" height="100px">
                    <u>Elsa Fadilah</u><br>
                    <i><b>HRD Manager</b></i>
                </td>
                <td style="text-align: center; vertical-align: bottom">
                    <u>Angga Saputra</u><br>
                    <i><b>Direktur Utama</b></i>
                </td>
            </tr>
        </table>

    </section>

</body>

</html>
