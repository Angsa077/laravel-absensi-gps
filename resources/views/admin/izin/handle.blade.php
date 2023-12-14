@extends('layouts.admin.app', ['title' => 'Data Izin / Sakit - E-Absensi'])

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    {{-- Page Title --}}
                    <h2 class="page-title">
                        Data Izin / Sakit
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
                            <form action="{{ route('izin.handle') }}" method="GET" class="mb-3">
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

                            {{-- Data Izin / Sakit Table --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Tanggal</th>
                                            <th>NIP</th>
                                            <th>Nama Karyawan</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Status Approve</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($izin as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->status == 'i' ? 'Izin' : 'Sakit' }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>
                                                    @if ($item->status_approved == 1)
                                                        <span class="badge text-white bg-success">Disetujui</span>
                                                    @elseif ($item->status_approved == 2)
                                                        <span class="badge text-white bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge text-white bg-warning">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status_approved == 0)
                                                        <a href="#" class="btn btn-sm btn-primary" id="approve"
                                                            id_handleizin="{{ $item->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-external-link"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                                <path d="M11 13l9 -9" />
                                                                <path d="M15 4h5v5" />
                                                            </svg>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('izin.cancel', $item->id) }}"
                                                            class="btn btn-sm btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-square-rounded-x"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M10 10l4 4m0 -4l-4 4" />
                                                                <path
                                                                    d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                            </svg>
                                                            Batalkan
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No Data Izin found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="mt-2">
                                {{ $izin->links('vendor.pagination.bootstrap-5') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-handleizin" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izin / Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('izin.approved') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_handleizin_form" id="id_handleizin_form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="status_approved" id="status_approved" class="form-select">
                                        <option value="1">Disetujui</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary w-100" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 14l11 -11" />
                                            <path
                                                d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                        </svg>
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#approve").click(function(e) {
                e.preventDefault();
                var id_handleizin = $(this).attr('id_handleizin');
                $("#id_handleizin_form").val(id_handleizin);
                $("#modal-handleizin").modal('show');
            })
        });
    </script>
@endpush
