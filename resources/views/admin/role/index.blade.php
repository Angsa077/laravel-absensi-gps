@extends('layouts.admin.app', ['title' => 'Roles - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Data Roles
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
                            {{-- Search Form --}}
                            <form action="{{ route('role.index') }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control"
                                        placeholder="Search by role name" value="{{ request('q') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>

                            {{-- Roles Table --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Role Name</th>
                                            <th>Permissions</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @foreach ($role->permissions as $permission)
                                                        <span class="badge badge-primary shadow border-0 ms-2 mb-2">
                                                            {{ $permission->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('role.edit', $role->id) }}"
                                                        class="btn btn-success btn-sm me-2">
                                                        <i class="fa fa-pencil-alt me-1"></i> EDIT
                                                    </a>
                                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i> DELETE
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No roles found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            {{ $roles->links() }}

                            <div class="mt-3 text-end">
                                <a href="{{ route('role.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus me-1"></i> Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
