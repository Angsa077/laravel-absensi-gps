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
                                    <div class="col-md-6 space-y-2">
                                        <div class="form-group">
                                            <label for="name">Name Lengkap:</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ $karyawan->name }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ $karyawan->email }}">
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nip">NIP:</label>
                                            <input type="text" name="nip" id="nip" class="form-control"
                                                value="{{ $karyawan->nip }}">
                                            @error('nip')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nik">NIK:</label>
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                value="{{ $karyawan->nik }}">
                                            @error('nik')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 space-y-2">
                                        <div class="form-group">
                                            <label for="no_hp">No HP:</label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                value="{{ $karyawan->no_hp }}">
                                            @error('no_hp')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir:</label>
                                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                                value="{{ $karyawan->tgl_lahir }}">
                                        </div>


                                        <div class="form-group">
                                            <label for="alamat">Alamat:</label>
                                            <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ $karyawan->alamat }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <select name="roles[]" id="roles" class="form-select" multiple>
                                                @foreach ($roles as $role)
                                                    <option
                                                        {{ in_array($role->name, $karyawan->roles->pluck('name')->toArray()) ? 'selected' : '' }}
                                                        value="{{ $role->name }}">{{ $role->name }}</option>
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

@push('myscript')
    <script>
        $(function() {
            $("#formKaryawan").submit(function() {
                var name = $("#name").val();
                var email = $("#email").val();
                var nip = $("#nip").val();
                var nik = $("#nik").val();
                var no_hp = $("#no_hp").val();
                var tgl_lahir = $("#tgl_lahir").val();
                var alamat = $("#alamat").val();
                var roles = $("#roles").val();

                if (name == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Name Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#nik").focus();
                    });
                    return false;
                }

                if (email == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Email Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#email").focus();
                    });
                    return false;
                }

                if (nip == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'NIP Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#nip").focus();
                    });
                    return false;
                }

                if (nik == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'NIK Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#nik").focus();
                    });
                    return false;
                }

                if (no_hp == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'No HP Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#no_hp").focus();
                    });
                    return false;
                }

                if (tgl_lahir == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Tgl Lahir Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#tgl_lahir").focus();
                    });
                    return false;
                }

                if (alamat == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Alamat Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#alamat").focus();
                    });
                    return false;
                }

                if (roles == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Roles Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#roles").focus();
                    });
                    return false;
                }

                return true;

            });
        });
    </script>
@endpush
