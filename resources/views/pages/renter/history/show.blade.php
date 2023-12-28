@extends('layouts.renter')

@section('section-renter')
<section>
    <div class="container">
        <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title">
                        <h2>Bukti Pemesanan Lapangan Anda<small>Tunjukkan sebagai bukti apabila anda sudah melakukan pembayaran.</small></h2>
                   </div>

                   <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div>
                                        <h4>Sport Venue Rental 
                                            <small style="float: right;" class="text-muted">Tanggal Pembayaran: <b>{{ \Carbon\Carbon::parse($transaction->created_at)->locale('id_ID')->isoFormat('D MMMM Y H:mm:ss') }}</b></small>
                                        </h4>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Identitas Diri:</b>
                                            <p style="margin-top: 1rem;margin-bottom: 0;">{{ $transaction->renter->name }}</p>
                                            <p style="margin-bottom: 0;">{{ $transaction->renter->phone }}</p>
                                            <p>{{ $transaction->renter->user->email }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Lapangan:</b>
                                            <p style="margin-top: 1rem;margin-bottom: 0;">{{ $transaction->gor->field->first()->name }}</p>
                                            <p style="margin-bottom: 0;">{{ $transaction->gor->name }}</p>
                                            <p style="margin-bottom: 0;">{{ $transaction->gor->address }}</p>
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
                                                @foreach ($transaction->detail_transaction as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $item->detail_field->time_field->start }} - {{ $item->detail_field->time_field->end }}</td>
                                                    <td class="text-center">{{ $item->day_name }}</td>
                                                    <td class="text-center">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                                    <td class="text-center">@rupiah($item->transaction->gor->price)</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" class="text-right">Total</td>
                                                    <td class="text-center"><b>@rupiah($transaction->detail_transaction->count() * $transaction->gor->price)</b></td>
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
                                        <p style="color: black;"><b>Bukti Pembayaran: </b></p>
                                        <img src="{{ $transaction->getFirstMediaUrl('transaction_image') }}" class="img-responsive" style="margin-top: 1rem">
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
              </div>
        </div>
</section>
@endsection