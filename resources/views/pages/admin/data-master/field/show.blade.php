@extends('layouts.coordinator')

@section('section-coordinator')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{ $field->getFirstMediaUrl('field_image') }}" alt="Card image cap">
                <div class="card-body">
                <h5 class="card-title">{{ $field->name }}</h5>
                <p class="card-text">{{ $field->description }}.</p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">Kategori: <span style="float: right">{{ $field->field_category->name }}</span></li>
                <div id="field-counter" data-slug="{{ $field->slug }}"></div>
                </ul>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Jadwal Penyewaan Lapangan</h5>

                <div class="d-flex align-items-start">
                    @php
                        $hariIni = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd');
                        $awalMinggu = \Carbon\Carbon::now()->startOfWeek();
                        $tanggalMingguIni = [];

                        for ($i = 0; $i <= 6; $i++) {
                            $tanggalMingguIni[] = $awalMinggu->copy()->addDays($i)->toDateString();
                        }
                    @endphp

                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($tanggalMingguIni as $tanggal)
                            @php
                                $namaHari = \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('dddd');
                            @endphp
                            <button class="nav-link mb-3 {{ $hariIni == $namaHari ? 'active' : '' }}" id="button-field-schedule" data-date="{{ $tanggal }}" data-day="{{ strtolower($namaHari) }}" data-bs-toggle="pill" data-bs-target="#day-section" type="button" role="tab" aria-controls="day-section" aria-selected="{{ $hariIni == $namaHari ? 'true' : 'false' }}">
                                {{ $namaHari }}
                            </button>
                        @endforeach
                    </div>
                    <div class="tab-content pt-0" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="day-section" role="tabpanel" aria-labelledby="day-section">
                            <div id="data-field-schedule"></div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection