@extends('layouts.renter')

@section('section-renter')
<section>
    <div class="container">
        <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title">
                        <h2>Daftar Riwayat Pemesanan Anda<small>Seluruh pemesanan yang belum dibayar oleh anda masuk ke tabel dibawah ini.</small></h2>
                   </div>

                   <div class="row">
                        <div class="col-md-12">
                            <table id="listHistoryOrderWaitingTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Gor</th>
                                        <th>Lapangan</th>
                                        <th>Tgl. Pemesanan</th>
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