@extends('layouts.renter')

@section('section-renter')

@php
    $hariIni = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd');
    $awalMinggu = \Carbon\Carbon::now()->startOfWeek();
    $tanggalMingguIni = [];

    for ($i = 0; $i <= 6; $i++) {
        $tanggalMingguIni[] = $awalMinggu->copy()->addDays($i)->toDateString();
    }
@endphp
<div id="field-counter" data-slug="{{ $field->slug }}"></div>
<section>
    <div class="container">
        <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title">
                        <h2>Isi Form Booking Lapangan <small>Diharapkan semua form terisi dengan benar.</small></h2>
                   </div>

                   <div class="row">
                        <form action="{{ route('booking.field.form.store', $field->slug) }}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Gor</label>
                                    <input type="text" class="form-control" value="{{ $field->gor->name }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Nama Lapangan</label>
                                    <input type="text" class="form-control" value="{{ $field->name }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Harga Sewa</label>
                                    <input type="text" class="form-control" value="@rupiah($field->gor->price)" disabled>
                                </div>

                                <ul class="nav nav-pills">
                                    @foreach ($tanggalMingguIni as $tanggal)
                                        @php
                                            $namaHari = \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('dddd');
                                        @endphp
                                        <li class="{{ $hariIni == $namaHari ? 'active' : '' }}">
                                            <a href="#day-section" id="button-field-schedule" data-date="{{ $tanggal }}" data-day="{{ strtolower($namaHari) }}" data-toggle="pill" role="tab" aria-controls="day-section" aria-selected="{{ $hariIni == $namaHari ? 'true' : 'false' }}">
                                                {{ $namaHari }}
                                            </a>
                                        </li>                                        
                                    @endforeach
                                </ul>
                                
                                <div class="tab-content" style="margin-top: 1rem">
                                    <div class="tab-pane active" id="day-section" role="tabpanel" aria-labelledby="day-section">
                                        <div id="data-field-schedule"></div>
                                    </div>
                                </div>

                                <div style="margin-top: 2rem">
                                    <button type="submit" class="btn btn-success">Booking Sekarang!</button>
                                    <button type="button" class="btn btn-danger" id="button-cancel-booking-field" data-id="{{ $field->id }}">Batal</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->renter->name }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->renter->phone }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Alamat Surel</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                </div>

                                <div id="data-temp-date"></div>

                            </div>
                        </form>
                   </div>
              </div>
        </div>
</section>
@endsection