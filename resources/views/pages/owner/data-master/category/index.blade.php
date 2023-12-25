@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Kategori Lapangan</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listFieldCategoriesTable">
          <thead>
            <tr>
                <th></th>
                <th scope="col" class="text-center">Kategori</th>
                <th scope="col" class="text-center">Total Lapangan</th>
                <th scope="col" class="text-center">Aksi</th>
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
          <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Form Kategori Lapangan</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
          <form action="{{ route('master.category') }}" method="POST" class="add-new-user pt-0">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="name">Nama Kategori</label>
              <input
                type="text"
                class="form-control"
                placeholder="John Doe"
                aria-label="John Doe"
                id="name"
                name="name"
                value="{{ old('name') }}" />
                @error('name')
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