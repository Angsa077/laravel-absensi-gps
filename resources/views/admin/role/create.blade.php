@extends('layouts.admin.app', ['title' => 'Tambah Roles - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Form Roles
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

                            <form method="POST" action="{{ route('role.store') }}" id="formRole">
                                @csrf

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Permissions:</label>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="{{ $permission->name }}">
                                                <label class="form-check-label">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    $("#formRole").submit(function() {
        var name = $("#name").val();
        if (name.trim() === "") {
            Swal.fire({
                title: "Oops!",
                text: "Nama Tidak Boleh Kosong!",
                icon: "error",
            });
            return false;
        }

        // Check if at least one permission is selected
        var selectedPermissions = $("input[name='permissions[]']:checked").length;
        if (selectedPermissions < 1) {
            Swal.fire({
                title: "Oops!",
                text: "Pilih setidaknya satu permission!",
                icon: "error",
            });
            return false;
        }

        return true;
    });
</script>