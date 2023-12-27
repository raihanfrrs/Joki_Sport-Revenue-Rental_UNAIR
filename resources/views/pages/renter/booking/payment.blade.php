@extends('layouts.renter')

@section('section-renter')
<section>
    <div class="container">
        <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title">
                        <h2>Ada Pembayaran Yang Menunggu Anda<small>Segera melakukan pembayaran sebelum waktu habis.</small></h2>
                   </div>

                   <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div>
                                        <h4>Sport Venue Rental 
                                            <small style="float: right;" class="text-muted">Tanggal Pemesanan: <b>{{ \Carbon\Carbon::parse($field->temp_cart->first()->created_at)->locale('id_ID')->isoFormat('D MMMM Y H:mm:ss') }}</b></small>
                                            <small style="float: right;" class="text-muted">Tanggal Kadaluarsa: <b class="text-danger">{{ \Carbon\Carbon::parse($field->temp_cart->first()->due)->locale('id_ID')->isoFormat('D MMMM Y H:mm:ss') }}</b></small>
                                        </h4>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Identitas Diri:</b>
                                            <p style="margin-top: 1rem;margin-bottom: 0;">{{ $field->temp_cart->first()->renter->name }}</p>
                                            <p style="margin-bottom: 0;">{{ $field->temp_cart->first()->renter->phone }}</p>
                                            <p>{{ $field->temp_cart->first()->renter->user->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Lapangan:</b>
                                            <p style="margin-top: 1rem;margin-bottom: 0;">{{ $field->temp_cart->first()->field->name }}</p>
                                            <p style="margin-bottom: 0;">{{ $field->temp_cart->first()->field->gor->name }}</p>
                                            <p style="margin-bottom: 0;">{{ $field->temp_cart->first()->field->gor->address }}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div>
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Jam</th>
                                                    <th class="text-center">Hari</th>
                                                    <th class="text-center">Tanggal</th>
                                                    <th class="text-center">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($field->temp_cart as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $item->detail_field->time_field->start }} - {{ $item->detail_field->time_field->end }}</td>
                                                    <td class="text-center">{{ $item->day_name }}</td>
                                                    <td class="text-center">{{ $item->date }}</td>
                                                    <td class="text-center">@rupiah($item->gor->price)</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" class="text-right">Total</td>
                                                    <td class="text-center"><b>@rupiah($field->temp_cart->count() * $field->gor->price)</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div>
                                        <p style="color: black;"><b>Tata Cara Transfer: </b></p>
                                        <ol>
                                            <li>Gunakan Mobile Banking / mesin ATM.</li>
                                            <li>Isi nominal sesuai dengan total pembayaran yang tertera.</li>
                                            <li>Isi catatan dengan format: nama_lengkap.</li>
                                            <li>Screenshot / Foto bukti pembayaran.</li>
                                            <li>Masukkan bukti pembayaran dibawah ini.</li>
                                        </ol>
                                        <hr>
                                        <form action="{{ route('payment.field.waiting.store', $field->slug) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <label for="image">Screenshot / Foto bukti pembayaran <sup style="color: red" id="caption-due-date-payment" data-id="{{ $field->slug }}">*Sisa {{ \Carbon\Carbon::parse($field->temp_cart->first()->due)->isPast()
                                                ? 0
                                                : max(0, \Carbon\Carbon::parse($field->temp_cart->first()->due)->diffInMinutes(\Carbon\Carbon::now())) }} Menit Lagi.</sup></label>
                                            <input type="file" name="transaction_image" id="photo" class="form-control" onchange="previewImageProperty()" required>
                                            <img class="img-preview img-responsive" style="margin-top: 1rem">
                                            <button type="submit" class="btn btn-primary btn-md" style="width: 100%;margin-top: 1rem">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
              </div>
        </div>
</section>
@endsection