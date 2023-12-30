<form action="{{ route('data.master.renter.update', $renter->slug) }}" method="POST" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework">
    @csrf
    @method('PATCH')
    <div class="col-12 col-md-6 fv-plugins-icon-container">
        <label class="form-label" for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $renter->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6 fv-plugins-icon-container">
        <label class="form-label" for="phone">Nomor Telepon</label>
        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $renter->phone) }}" required>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-12">
        <label class="form-label" for="email">Alamat Surel</label>
        <input type="email" id="email" name="email" class="form-control @error('emails') is-invalid @enderror" value="{{ old('email', $renter->user->email) }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Kirim</button>
        <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">
            Batal
        </button>
    </div>
</form>