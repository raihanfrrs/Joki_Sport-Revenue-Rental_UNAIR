@extends('layouts.coordinator')

@section('section-auth')
<!-- /Left Text -->
<div class="d-none d-lg-flex col-lg-7 p-0">
    <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
    <img
        src="{{ asset('assets/img/illustrations/boy-stand.png') }}"
        alt="auth-login-cover"
        class="img-fluid my-5 auth-illustration"
        data-app-light-img="illustrations/boy-stand.png"
        data-app-dark-img="illustrations/boy-stand.png" />

    <img
        src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
        alt="auth-login-cover"
        class="platform-bg"
        data-app-light-img="illustrations/bg-shape-image-light.png"
        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
    </div>
</div>
<!-- /Left Text -->

<!-- Login -->
<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
    <div class="w-px-400 mx-auto">
    <h3 class="mb-1 fw-bold">Selamat Datang di Sport Venue</h3>
    <p class="mb-4">Silahkan Masuk ke Akun Anda</p>

    <form id="formAuthentication" class="mb-3" action="{{ route('login.coordinator.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="text"
                name="email"
                class="form-control"
                id="email"
                placeholder="Masukkan email anda"
                autofocus />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="input-group input-group-merge">
                <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100">Masuk</button>
    </form>

        {{-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="auth-register-cover.html">
            <span>Create an account</span>
            </a>
        </p>

        <div class="divider my-4">
            <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
            <i class="tf-icons fa-brands fa-google fs-5"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-twitter">
            <i class="tf-icons fa-brands fa-twitter fs-5"></i>
            </a>
        </div> --}}
    </div>
</div>
<!-- /Login -->
@endsection