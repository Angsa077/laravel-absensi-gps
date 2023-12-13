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
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Role Name:</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ $roles->name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Permissions:</label>
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
    
        <script>
            $("#formRole").submit(function() {
                var name = $("#name").val();
                if (name.trim() === "") {
                    Swal.fire({
                        title: "Oops!",
                        text: "Role Name cannot be empty!",
                        icon: "error",
                    });
                    return false;
                }
    
                // Check if at least one permission is selected
                var selectedPermissions = $("input[name='permissions[]']:checked").length;
                if (selectedPermissions < 1) {
                    Swal.fire({
                        title: "Oops!",
                        text: "Select at least one permission!",
                        icon: "error",
                    });
                    return false;
                }
    
                return true;
            });
        </script>
@endsection