@extends('layouts.coordinator')

@section('section-auth')
<div class="container">
        
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="" class="logo d-flex align-items-center w-auto">
                        <span class="d-none d-lg-block">Sport Venue</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login untuk Melanjutkan</h5>
                        <p class="text-center small">Masukkan email dan password untuk login</p>
                    </div>

                    <form action="{{ route('login.coordinator.process') }}" class="row g-3 needs-validation" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" name="email" class="form-control" id="email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                    </form>

                    </div>
                </div>

                </div>
            </div>
        </div>

    </section>

</div>
@endsection