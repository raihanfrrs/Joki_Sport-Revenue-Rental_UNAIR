@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('master.category.update', $category->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
    
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Ubah Identitas Kategori Lapangan</h5>
    
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Nama Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                        </div>
    
                    </div>
                </div>
            </div>
    
        </div>
    </form>
</div>
@endsection