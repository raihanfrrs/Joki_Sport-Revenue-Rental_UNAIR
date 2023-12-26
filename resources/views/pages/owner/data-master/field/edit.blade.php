@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('master.field.update', $field->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
    
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Ubah Identitas Lapangan</h5>
    
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Nama Lapangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $field->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="gor" class="col-sm-3 col-form-label">Pilih Gor</label>
                            <div class="col-sm-9">
                                <select name="gor_id" id="gor" class="form-select text-capitalize">
                                    @foreach ($gors as $gor)
                                        <option value="{{ $gor->id }}" {{ old('gor_id', $field->gor_id) == $gor->id ? 'selected' : '' }}>{{ $gor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="field_category" class="col-sm-3 col-form-label">Pilih Kategori</label>
                            <div class="col-sm-9">
                                <select name="field_category_id" id="field_category" class="form-select text-capitalize">
                                    @foreach ($field_categories as $field_category)
                                        <option value="{{ $field_category->id }}" {{ old('field_category_id', $field->field_category_id) == $field_category->id ? 'selected' : '' }}>{{ $field_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="gor" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <input id="x" value="{{ old('description', $field->description) }}" type="hidden" name="description" required>
                                <trix-editor input="x"></trix-editor>
                                @error('description')
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
                    <h5 class="card-title">Ubah Foto Lapangan</h5>
    
                        <div class="row mb-3">
                            <label for="photo" class="col-sm-3 col-form-label">Foto Lapangan</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control @error('field_image') is-invalid @enderror" id="photo" name="field_image" onchange="previewImageProperty()">
                                <div class="col-12">
                                    @if ($field->getFirstMediaUrl('field_image'))
                                        <img src="{{ $field->getFirstMediaUrl('field_image') }}" class="img-preview img-fluid mt-3" />
                                    @endif
                                </div>
                                @error('field_image')
                                    {{ $message }}
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