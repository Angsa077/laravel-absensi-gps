@extends('layouts.admin.app', ['title' => 'Edit Karyawan - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Form Karyawan
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- content --}}
                            <form method="POST" action="{{ route('karyawan.update', $karyawan->id) }}" id="formKaryawan">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name Lengkap:</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ $karyawan->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ $karyawan->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip">NIP:</label>
                                            <input type="text" name="nip" id="nip" class="form-control"
                                                value="{{ $karyawan->nip }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nik">NIK:</label>
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                value="{{ $karyawan->nik }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp">No HP:</label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                value="{{ $karyawan->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir:</label>
                                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                                value="{{ $karyawan->tgl_lahir }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat">Alamat:</label>
                                            <textarea name="alamat" id="alamat" class="form-control"
                                                rows="3">{{ $karyawan->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="roles">Roles:</label>
                                            <select name="roles[]" id="roles" class="form-control" multiple>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->name }}" {{ in_array($role->name, $karyawan->roles->pluck('name')->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
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
