@extends('layouts.admin.app', ['title' => 'Lokasi Kantor - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Lokasi Kantor
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">
                    {{-- content --}}
                    <div class="card">
                        <div class="card-body">

                            {{-- Alert Message --}}
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @elseif (Session::get('error'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Form Laporan --}}
                            <form action="{{ route('lokasi.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi:</label>
                                            <input type="text" name="lokasi" id="lokasi" class="form-control"
                                                value="{{ $lokasi_kantor->lokasi }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="radius">Radius:</label>
                                            <input type="text" name="radius" id="radius" class="form-control"
                                                value="{{ $lokasi_kantor->radius }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
