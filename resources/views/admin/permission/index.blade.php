@extends('layouts.admin.app', ['title' => 'Permissions - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Data Permissions
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
                            <form action="{{ route('permission.index') }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control"
                                        placeholder="Search by permission name" value="{{ request('q') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>

                            {{-- Permissions Table --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Permission Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="1" class="text-center">No permissions found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                            {{-- Pagination --}}
                            {{ $permissions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
