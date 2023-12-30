@extends('layouts.coordinator')

@section('section-coordinator')

<div class="container-xxl flex-grow-1 container-p-y">
    <span class="text-muted fw-light">Gor / Rincian</span>

    <div class="row mt-4">
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card">
              <img class="card-img-top" src="{{ $gor->getFirstMediaUrl('gor_image') }}" alt="Card image cap">
            </div>
        </div>

        <div class="col-sm-6 col-lg-8 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title text-capitalize">{{ $gor->name }}</h5>
                <p class="card-text">
                  {{ $gor->address }}
                </p>
                <p class="card-text"><small class="text-muted">Perubahan Terakhir {{ $gor->updated_at->diffForHumans() }}</small></p>
              </div>
            </div>
        </div>
    </div>

    <h6 class="pb-1 mb-4 text-muted text-capitalize">Daftar Lapangan dari {{ $gor->name }}</h6>

    <div class="row">
        @foreach ($fields as $field)
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="{{ $field->getFirstMediaUrl('field_image') }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{ $field->name }}</h5>
                  <p class="card-text">{{ $field->description }}.</p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Kategori: <span style="float: right">{{ $field->field_category->name }}</span></li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection