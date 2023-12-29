@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Daftar Penyewa</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listMasterRentersTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">Penyewa</th>
              <th class="text-center">Surel</th>
              <th class="text-center">Telepon</th>
              <th class="text-center">Tgl. Terdaftar</th>
              <th class="text-center">Jumlah Pemesanan</th>
              <th class="text-center">Status</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection