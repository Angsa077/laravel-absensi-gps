@extends('layouts.admin.app', ['title' => 'Karyawan - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Data Karyawan
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
                            <form action="{{ route('karyawan.index') }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control"
                                        placeholder="Search by karyawan name" value="{{ request('q') }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>

                            {{-- Karyawan Table --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NIP</th>
                                            <th>NIK</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No HP</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($karyawan as $item)
                                            @php
                                                $path = Storage::url('uploads/profile/' . $item->profile_photo_path);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->no_hp }}</td>
                                                <td>{{ $item->tgl_lahir }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    @if (empty($item->profile_photo_path))
                                                        <img src="{{ asset('assets/img/no-avatar.png') }}" alt="image"
                                                            class="image" style="width: 54px; height:54px;">
                                                    @else
                                                        <img src="{{ url($path) }}" alt="image" class="image"
                                                            style="width: 54px; height:54px;">
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('karyawan.edit', $item->id) }}"
                                                        class="btn btn-success btn-sm me-2">
                                                        <i class="fa fa-pencil-alt me-1"></i> EDIT
                                                    </a>
                                                    <form action="{{ route('karyawan.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
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
                                                <td colspan="10" class="text-center">No karyawan found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            {{ $karyawan->links() }}

                            <div class="mt-3 text-end">
                                <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
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
