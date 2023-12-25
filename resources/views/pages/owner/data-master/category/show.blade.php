@extends('layouts.coordinator')

@section('section-coordinator')

<div class="container-xxl flex-grow-1 container-p-y">
    <span class="text-muted fw-light">Kategori / Rincian</span>

    <div class="row mt-4">
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