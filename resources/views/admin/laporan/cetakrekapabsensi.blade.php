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
            font-size: 10px;
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

<body class="A4 landscape">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        {{-- Table Header --}}
        <table style="width: 100%">
            <tr>
                <td>
                    <img src="{{ asset('assets/img/logo.png') }}" width="70" height="70" alt="Logo">
                </td>
                <td>
                    <span id="title">
                        LAPORAN REKAB ABSENSI KARYAWAN <br>
                        PERIODE {{ strtoupper($namaBulan[$bulan]) }} {{ $tahun }}<br>
                        PT. ANGGA SAPUTRA<br>
                    </span>
                    <span><i>Taman Angsoka Permai Blok CB No.1 Kasemen Serang Banten</i></span>
                </td>
            </tr>
        </table>

        {{-- Table Absensi --}}
        <table class="tableAbsensi">
            <thead>
                <tr>
                    <th rowspan="2">NIP</th>
                    <th rowspan="2">Nama Karyawan</th>
                    <th colspan="31">Tanggal</th>
                    <th rowspan="2">TH</th>
                    <th rowspan="2">TT</th>
                </tr>
                <tr>
                    @for ($i = 1; $i <= 31; $i++)
                        <th>{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $item)
                    <tr>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->name }}</td>
                        @php
                            $totalHadir = 0;
                            $totalTerlambat = 0;
                        @endphp
                        @for ($i = 1; $i <= 31; $i++)
                            <?php
                            $tgl = 'tgl_' . $i;
                            if (empty($item->$tgl)) {
                                $hadir = ['', ''];
                                $totalHadir += 0;
                            } else {
                                $hadir = explode('-', $item->$tgl);
                                $totalHadir += 1;
                                if ($hadir[0] > '07:00:00') {
                                    $totalTerlambat += 1;
                                }
                            }
                            ?>
                            <td>
                                <span style="background-color: {{ $hadir[0] > '07:00:00' ? 'red' : '' }}">
                                    {{ $hadir[0] }}</span><br>
                                <span style="background-color: {{ $hadir[1] > '16:00:00' ? 'red' : '' }}">
                                    {{ $hadir[0] }}</span>
                            </td>
                        @endfor
                        <td>{{ $totalHadir }}</td>
                        <td>{{ $totalTerlambat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Notes --}}
        <div style="margin-top: 20px; font-size: 10px;">
            <p>
                <strong>Notes:</strong>
            </p>
            <ul>
                <li><strong>TH:</strong> Total Hadir</li>
                <li><strong>TT:</strong> Total Terlambat</li>
            </ul>
        </div>

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
