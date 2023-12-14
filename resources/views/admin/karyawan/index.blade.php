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

                            {{-- Search Form --}}
                            <form action="{{ route('karyawan.index') }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control"
                                        placeholder="Search by karyawan name" value="{{ request('q') }}">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                        Search
                                    </button>
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
                                                $pathDefault = Storage::url('../assets/img/avatar1.jpg');
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->no_hp }}</td>
                                                <td>{{ $item->tgl_lahir }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    @if (empty($item->profile_photo_path))
                                                        <img src="{{ url($pathDefault) }}" alt="image" class="image"
                                                            style="width: 48px; height:48px;">
                                                    @else
                                                        <img src="{{ url($path) }}" alt="image" class="image"
                                                            style="width: 48px; height:48px;">
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('karyawan.edit', $item->id) }}"
                                                        class="btn btn-primary btn-sm me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                            <path d="M16 5l3 3" />
                                                        </svg>
                                                    </a>
                                                    <form id="deleteForm{{ $item->id }}"
                                                        action="{{ route('karyawan.destroy', $item->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="confirmDelete(event, {{ $item->id }});">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" />
                                                                <path d="M14 11l0 6" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
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
                            <div class="mt-2">
                                {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                            </div>

                            <div class="mt-2 text-end">
                                <a href="{{ route('karyawan.create') }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
