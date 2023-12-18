@extends('layouts.admin.app', ['title' => 'Laporan Absensi - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Laporan Absensi
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    {{-- content --}}
                    <div class="card">
                        <div class="card-body">
                            {{-- Form Laporan --}}
                            <form action="{{ route('laporan.cetakabsensi') }}" target="_blank" method="POST"
                                id="formLaporanAbsensi">
                                @csrf
                                <div class="row">
                                    <div class="col-12 space-y-3">
                                        <div class="form-group">
                                            <select name="bulan" id="bulan" class="form-select">
                                                <option value="">Bulan</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ date('m') == $i ? 'selected' : '' }}>{{ $namaBulan[$i] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="tahun" id="tahun" class="form-select">
                                                <option value="">Tahun</option>
                                                @for ($tahun = 2022; $tahun <= $tahunSkrng; $tahun++)
                                                    <option value="{{ $tahun }}"
                                                        {{ date('Y') == $tahun ? 'selected' : '' }}>{{ $tahun }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="user_id" id="user_id" class="form-select">
                                                <option value="">Pilih Karyawan</option>
                                                @foreach ($karyawan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                                @error('user_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-printer" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                    <path
                                                        d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                                </svg>
                                                Cetak
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success w-100" name="exportexcel">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-download" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 11l5 5l5 -5" />
                                                    <path d="M12 4l0 12" />
                                                </svg>
                                                Export
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('#formLaporanAbsensi').submit(function(event) {
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                var karyawan = $('#user_id').val();

                if (!bulan) {
                    Swal.fire({
                        title: "Oops!",
                        text: "Bulan Tidak Boleh Kosong!",
                        icon: "error",
                    });
                    event.preventDefault();
                } else if (!tahun) {
                    Swal.fire({
                        title: "Oops!",
                        text: "Tahun Tidak Boleh Kosong!",
                        icon: "error",
                    });
                    event.preventDefault();
                } else if (!karyawan) {
                    Swal.fire({
                        title: "Oops!",
                        text: "Karyawan Tidak Boleh Kosong!",
                        icon: "error",
                    });
                    event.preventDefault();
                }
            });
        });
    </script>
@endpush
