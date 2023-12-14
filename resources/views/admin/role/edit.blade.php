@extends('layouts.admin.app', ['title' => 'Edit Roles - E-Absensi'])

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
                            <form method="POST" action="{{ route('role.update', $roles->id) }}" id="formRole">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Role Name:</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ $roles->name }}">
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label>Permissions:</label>
                                        <div class="form-group">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        {{ $roles->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
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
            $("#formRole").submit(function() {
                var name = $("#name").val();
                var permissions = $("input[name='permissions[]']:checked").length;

                if (name == "") {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Name Tidak Boleh Kosong!',
                        icon: 'warning',
                    }).then((result) => {
                        $("#name").focus();
                    });
                    return false;
                }

                if (permissions == 0) {
                    Swal.fire({
                        title: 'Warning',
                        text: 'Pilih setidaknya satu permission!',
                        icon: 'warning',
                    }).then((result) => {
                        $("input[name='permissions[]']").first().focus();
                    });
                    return false;
                }

                return true;
            });
        });
    </script>
@endpush
