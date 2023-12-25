@extends('layouts.coordinator')

@section('section-coordinator')
<form action="{{ route('master.renter.update', $renter->slug) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Ubah Identitas Penyewa</h5>

                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Nama Penyewa</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $renter->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Alamat Surel</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $renter->user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $renter->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Ubah Foto Penyewa</h5>

                    <div class="row mb-3">
                        <label for="photo" class="col-sm-3 col-form-label">Foto Penyewa</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control @error('renter_image') is-invalid @enderror" id="photo" name="gor_image" onchange="previewImage()" required>
                            <div class="col-12">
                                <img src="{{ $renter->getFirstMediaUrl('renter_image') }}" class="img-preview img-fluid mt-3" />
                            </div>
                            @error('renter_image')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <button type="reset" class="btn btn-secondary">Batal</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</form>
@endsection