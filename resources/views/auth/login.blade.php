@extends('layouts.app', ['title' => 'Login - E-Absensi'])

@section('content')
    @php $hideBottomNav = true; @endphp
    <div class="login-form mt-1">
        <div class="section">
            <img src="{{ asset('assets/img/login/login.png') }}" alt="image" class="form-image">
        </div>
        <div class="section mt-1">
            <h1>E-Absensi</h1>
            <h4>Silahkan login</h4>
        </div>
        <div class="section mt-1 mb-5">

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group boxed">
                    @error('email')
                        <div class="alert alert-outline-danger mb-1">{{ $message }}</div>
                    @enderror
                    <div class="input-wrapper">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address"
                            value="{{ old('email') }}">
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
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-links mt-1 d-flex justify-content-end">
                    <div><a href="/forgot-password" class="text-muted">Forgot Password?</a></div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg">LOGIN</button>
                </div>

            </form>
        </div>
    </div>
@endsection
