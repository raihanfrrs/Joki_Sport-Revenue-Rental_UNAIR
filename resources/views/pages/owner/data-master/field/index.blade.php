@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Lapangan</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listFieldsTable">
          <thead>
            <tr>
                <th></th>
                <th class="text-center">Lapangan</th>
                <th class="text-center">Gor</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Deskripsi</th>
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
          <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Form Tambah Lapangan</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
          <form action="{{ route('master.field') }}" method="POST" class="add-new-user pt-0" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="name">Nama Lapangan <sup class="text-danger">*Required</sup></label>
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
            <div class="mb-3">
                <label for="defaultSelect" class="form-label">Pilih Gor <sup class="text-danger">*Required</sup></label>
                <select id="defaultSelect" class="form-select" name="gor_id">
                  <option>Pilih Gor</option>
                  @foreach ($gors as $gor)
                    <option value="{{ $gor->id }}" class="text-capitalize" {{ old('gor_id') == $gor->id ? 'selected' : '' }}>{{ $gor->name }}</option>
                  @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="defaultSelect" class="form-label">Pilih Kategori Lapangan <sup class="text-danger">*Required</sup></label>
                <select id="defaultSelect" class="form-select" name="field_category_id">
                  <option>Pilih Kategori Lapangan</option>
                  @foreach ($field_categories as $field_category)
                    <option value="{{ $field_category->id }}" class="text-capitalize" {{ old('field_category_id') == $field_category->id ? 'selected' : '' }}>{{ $field_category->name }}</option>
                  @endforeach
                </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="description">Deskripsi <sup class="text-danger">*Required</sup></label>
              <textarea class="form-control" name="description" id="description" cols="10" rows="10">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="field_image">Foto Lapangan <sup class="text-danger">*Required</sup></label>
                <input
                  type="file"
                  class="form-control"
                  id="field_image"
                  name="field_image"
                  required />
                  @error('field_image')
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