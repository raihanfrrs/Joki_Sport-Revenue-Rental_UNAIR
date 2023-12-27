@extends('layouts.renter')

@section('section-renter')
<section>
    <div class="container">
        <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title">
                        <h2>Daftar Riwayat Pembayaran Anda<small>Seluruh pembayaran anda masuk ke tabel dibawah ini.</small></h2>
                   </div>

                   <div class="row">
                        <div class="col-md-12">
                            <table id="listHistoryOrderTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gor</th>
                                        <th>Lapangan</th>
                                        <th>Tgl. Pembayaran</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                   </div>
              </div>
        </div>
</section>
@endsection