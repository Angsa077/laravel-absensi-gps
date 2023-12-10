@extends('layouts.app', ['title' => 'Profile - E-Absensi'])

@section('header')
    {{-- App Header --}}
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Profile</div>
        <div class="right"></div>
    </div>
    {{-- App Header --}}
@endsection

@section('content')
    @php $hideBottomNav = true; @endphp

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

    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 px-5">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="name" class="form-label">NAMA LENGKAP : </label>
                        <input type="text" id="name" class="form-control form-control-sm"
                            value="{{ strtoupper($user->name) }}" disabled>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="nip" class="form-label">NIP : </label>
                        <input type="text" id="nip" class="form-control form-control-sm"
                            value="{{ strtoupper($user->nip) }}" disabled>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="nik" class="form-label">NIK : </label>
                        <input type="text" id="nik" class="form-control form-control-sm"
                            value="{{ strtoupper($user->nik) }}" disabled>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="tgl_lahir" class="form-label">TANGGAL LAHIR :</label>
                        <input type="date" id="tgl_lahir" class="form-control form-control-sm"
                            value="{{ $user->tgl_lahir }}" disabled>
                    </div>
                </div>
            </div>

            <div class="col-md-6 px-5">
                <div class="form-group boxed">
                    @error('email')
                        <div class="alert alert-outline-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="input-wrapper">
                        <label for="email" class="form-label">EMAIL : </label>
                        <input type="text" id="email" name="email" class="form-control form-control-sm"
                            value="{{ strtoupper($user->email) }}" autocomplete="off">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    @error('password')
                        <div class="alert alert-outline-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="input-wrapper">
                        <label for="password" class="form-label">PASSWORD : </label>
                        <input type="password" id="password" name="password" class="form-control form-control-sm"
                            placeholder="**********" autocomplete="off">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    @error('no_hp')
                        <div class="alert alert-outline-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="input-wrapper">
                        <label for="no_hp" class="form-label">NO HP : </label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control form-control-sm"
                            value="{{ $user->no_hp }}" placeholder="WAJIB MELENGKAPI NO HP" autocomplete="off">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    @error('alamat')
                        <div class="alert alert-outline-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="input-wrapper">
                        <label for="alamat" class="form-label">ALAMAT :</label>
                        <input type="text" id="alamat" name="alamat" class="form-control form-control-sm"
                            value="{{ strtoupper($user->alamat) }}" placeholder="WAJIB MELENGKAPI ALAMAT"
                            autocomplete="off">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
            </div>

            <div class="custom-file-upload" id="fileUpload1">
                @error('profile_photo_path')
                    <div class="alert alert-outline-danger mb-1">{{ $message }}</div>
                @enderror
                <input type="file" name="profile_photo_path" id="fileuploadInput">
                <label for="fileuploadInput">
                    <span>
                        <strong>
                            <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                                aria-label="cloud upload outline"></ion-icon>
                            <i>Tap to Upload</i>
                        </strong>
                    </span>
                </label>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block">
                        <ion-icon name="refresh-outline"></ion-icon>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
