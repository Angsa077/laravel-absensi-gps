@extends('layouts.app', ['title' => 'Dashboard - E-Absensi'])

@section('content')
    <div id="appCapsule">
        <div class="section" id="user-section">
            <div id="user-detail">
                <div class="avatar">
                    @if (!empty(Auth::user()->profile_photo_path))
                        @php
                            $path = Storage::url('uploads/profile/' . Auth::user()->profile_photo_path);
                        @endphp
                        <img src="{{ url($path) }}" alt="avatar" class="imaged" style="width: 54px; height:54px;">
                    @else
                        @php
                            $pathDefault = Storage::url('../assets/img/avatar1.jpg');
                        @endphp
                        <img src="{{ url($pathDefault) }}" alt="avatar" class="imaged" style="width: 54px; height:54px;">
                    @endif
                </div>
                <div id="user-info">
                    <h2 id="user-name">{{ Auth::user()->name }}</h2>
                    <span id="user-role">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        @can('admin.index')
                            <div class="item-menu text-center">
                                <div class="menu-icon">
                                    <a href="{{ route('admin.index') }}" class="orange" style="font-size: 32px;">
                                        <ion-icon name="server-outline"></ion-icon>
                                    </a>
                                </div>
                                <div class="menu-name">
                                    Admin
                                </div>
                            </div>
                        @endcan
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="{{ route('profile.index') }}" class="green" style="font-size: 32px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="{{ route('izin.index') }}" class="danger" style="font-size: 32px;">
                                    <ion-icon name="calendar-number"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Izin</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="{{ route('histori.index') }}" class="warning" style="font-size: 32px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>

                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="#" onclick="confirmLogout(event);" class="primary" style="font-size: 32px;">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                            <div class="menu-name">
                                Log out
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="row">
                    <div class="col-6">
                        <div class="card gradasigreen">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        @if ($absensiHariIni != null)
                                            @php
                                                $path = Storage::url('uploads/absensi/foto_masuk/' . $absensiHariIni->foto_masuk);
                                            @endphp
                                            <img src="{{ url($path) }}" alt="foto_masuk" class="imaged w48">
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Absen Masuk</h4>
                                        <span>{{ $absensiHariIni ? $absensiHariIni->jam_in : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card gradasired">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        @if ($absensiHariIni != null && $absensiHariIni->jam_out != null)
                                            @php
                                                $path = Storage::url('uploads/absensi/foto_keluar/' . $absensiHariIni->foto_keluar);
                                            @endphp
                                            <img src="{{ url($path) }}" alt="foto_keluar" class="imaged w48">
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Absen Pulang</h4>
                                        <span>{{ $absensiHariIni ? $absensiHariIni->jam_out : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="rekapabsensi">
                <h3>Rekap Absensi Bulan {{ $namaBulan[$bulanIni] }} Tahun {{ $tahunIni }}</h3>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge badge-success"
                                    style="position: absolute; top: 3px; right: 10px; font-size:0.6rem; z-index: 999">
                                    {{ $rekabAbsensi->jmlHadir ? $rekabAbsensi->jmlHadir : 0 }}</span>
                                <ion-icon name="accessibility-outline" style="font-size: 1.6rem"
                                    class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge badge-warning"
                                    style="position: absolute; top: 3px; right: 10px; font-size:0.6rem; z-index: 999">
                                    {{ $rekabIzin->jmlIzin ? $rekabIzin->jmlIzin : 0 }}</span>
                                <ion-icon name="newspaper-outline" style="font-size: 1.6rem"
                                    class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge badge-warning"
                                    style="position: absolute; top: 3px; right: 10px; font-size:0.6rem; z-index: 999">{{ $rekabIzin->jmlSakit ? $rekabIzin->jmlSakit : 0 }}</span>
                                <ion-icon name="medkit-outline" style="font-size: 1.6rem"
                                    class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                                <span class="badge badge-danger"
                                    style="position: absolute; top: 3px; right: 10px; font-size:0.6rem; z-index: 999">
                                    {{ $rekabAbsensi->jmlTerlambat ? $rekabAbsensi->jmlTerlambat : 0 }}</span>
                                <ion-icon name="alarm-outline" style="font-size: 1.6rem"
                                    class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                Bulan Ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Leaderboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($historiBulanIni as $item)
                                <li>
                                    <div class="item">
                                        <div class="icon-box bg-primary">
                                            <ion-icon name="today-outline"></ion-icon>
                                        </div>
                                        <div class="in">
                                            <div>{{ date('d-m-Y', strtotime($item->created_at)) }}</div>
                                            <span class="badge badge-success">{{ $item->jam_in }}</span>
                                            <span
                                                class="badge badge-danger">{{ $absensiHariIni != null && $item->jam_out != null ? $item->jam_out : 'Belum Absen' }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($leaderboard as $item)
                                <li>
                                    <div class="item">
                                        <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="image"
                                            class="image">
                                        <div class="in">
                                            <div>
                                                <b>{{ $item->name }}</b>
                                                <small class="text-muted">{{ $item->email }}</small>
                                            </div>
                                            <span
                                                class="badge {{ $item->jam_in < '07:00' ? 'badge-success' : 'badge-danger' }}">
                                                {{ $item->jam_in }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('alert-logout')
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
@endpush
