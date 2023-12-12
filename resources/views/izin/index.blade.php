@extends('layouts.app', ['title' => 'Data Izin / Sakit - E-Absensi'])

@section('header')
    {{-- App Header --}}
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Izin / Sakit</div>
        <div class="right"></div>
    </div>
    {{-- App Header --}}
@endsection

@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            @php
                $messageSuccess = Session::get('success');
                $messageError = Session::get('error');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messageSuccess }}
                </div>
            @elseif (Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageError }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            @foreach ($data as $item)
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ date('d-m-Y', strtotime($item->tgl_izin)) }} ({{ $item->status == 's' ? 'Sakit' : 'Izin' }})</b> <br>
                                    <small class="text-muted">{{ $item->keterangan }}</small>
                                </div>
                                @if ($item->status_approved == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($item->status_approved == 1)
                                    <span class="badge bg-success">Approved</span>
                                @elseif($item->status_approved == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>

    <div class="fab-button bottom-right" style="margin-bottom: 70px">
        <a href="{{ route('izin.create') }}" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection
