@extends('layouts.admin.app', ['title' => 'Tambah Karyawan - E-Absensi'])

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
                            <form method="POST" action="{{ route('karyawan.store') }}" id="formKaryawan">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Lengkap:</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nip">NIP:</label>
                                            <input type="text" name="nip" id="nip" class="form-control"
                                                value="{{ old('nip') }}" placeholder="NIP" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK:</label>
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                value="{{ old('nik') }}" placeholder="NIK" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp">No HP:</label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                value="{{ old('no_hp') }}" placeholder="No HP" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir:</label>
                                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control"
                                                value="{{ old('tgl_lahir') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat:</label>
                                            <textarea name="alamat" id="alamat" class="form-control"
                                                placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="roles">Roles:</label>
                                            <select name="roles[]" id="roles" class="form-control" multiple required>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#formKaryawan").submit(function(e) {
            e.preventDefault();
    
            var name = $("#name").val();
            var email = $("#email").val();
            var nip = $("#nip").val();
            var nik = $("#nik").val();
            var no_hp = $("#no_hp").val();
            var tgl_lahir = $("#tgl_lahir").val();
            var alamat = $("#alamat").val();
            var roles = $("#roles").val();
    
            // Basic validation - Check if required fields are not empty
            if (name.trim() === "" || email.trim() === "" || nip.trim() === "" || nik.trim() === "" ||
                no_hp.trim() === "" || tgl_lahir.trim() === "" || alamat.trim() === "" || roles === null) {
    
                Swal.fire({
                    title: "Oops!",
                    text: "Please fill in all required fields!",
                    icon: "error",
                });
    
            } else {
                // If all required fields are filled, you can submit the form
                this.submit();
            }
        });
    </script>
@endsection
