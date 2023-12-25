@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Gor</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listGorsTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">Gor</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Tgl. Terdaftar</th>
              <th class="text-center">Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasAddUser"
        aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
          <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Form Tambah Gor</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
          <form action="{{ route('master.gor') }}" method="POST" class="add-new-user pt-0" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="name">Nama Gor <sup class="text-danger">*Required</sup></label>
              <input
                type="text"
                class="form-control"
                placeholder="Gor ABCD"
                aria-label="Gor ABCD"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="price">Harga Sewa Gor <sup class="text-danger">*Required</sup></label>
              <input
                type="text"
                class="form-control"
                placeholder="100000"
                aria-label="100000"
                id="price"
                name="price"
                value="{{ old('price') }}"
                required />
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="address">Alamat Gor <sup class="text-danger">*Required</sup></label>
              <textarea class="form-control" name="address" id="address" cols="10" rows="10" required>{{ old('address') }}</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label" for="gor_image">Foto Gor <sup class="text-danger">*Required</sup></label>
              <input
                type="file"
                class="form-control"
                id="gor_image"
                name="gor_image"
                required />
                @error('gor_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Kirim</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection