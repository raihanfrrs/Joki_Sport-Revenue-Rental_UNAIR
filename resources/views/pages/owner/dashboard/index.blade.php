@extends('layouts.coordinator')

@section('section-coordinator')

<div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="row">

        <div class="col-xl-4 mb-4 col-lg-5 col-12">
            <div class="row">

                <div class="col-xl-6 col-md-3 col-6">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Penyewa</h5>
                        <small class="text-muted">Bulan Terakhir</small>
                      </div>
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                          <h4 class="mb-0" id="value-renter-order-analytic">0</h4>
                          <small class="" id="percent-renter-order-analytic">+0%</small>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-3 col-6">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Pemesanan</h5>
                        <small class="text-muted">Bulan Terakhir</small>
                      </div>
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                          <h4 class="mb-0" id="value-renter-field-order-analytic">0</h4>
                          <small class="text-success" id="percent-renter-field-order-analytic">+0%</small>
                        </div>
                      </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">

              <div class="col-xl-6 col-md-3 col-6">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Gor</h5>
                    <small class="text-muted">Bulan Terakhir</small>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                      <h4 class="mb-0" id="value-total-gor-analytic">0</h4>
                      <small class="text-success" id="percent-total-gor-analytic">+0%</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-md-3 col-6">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Lapangan</h5>
                    <small class="text-muted">Bulan Terakhir</small>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                      <h4 class="mb-0" id="value-total-field-analytic">0</h4>
                      <small class="text-success" id="percent-total-field-analytic">+0%</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-md-3 col-6 mt-3">
                <div class="card">
                    <div class="card-body">
                      <div class="badge p-2 bg-label-success mb-2 rounded">
                        <i class="ti ti-currency-dollar ti-md"></i>
                      </div>
                      <h5 class="card-title mb-1 pt-2">Total Pendapatan</h5>
                      <small class="text-muted">Keseluruhan</small>
                      <p class="mb-2 mt-1" id="value-total-income-analytic">0</p>
                    </div>
                  </div>
              </div>

            </div>
        </div>


        <div class="col-xl-8 mb-4 col-md-7 col-12">
            <div class="card mb-3">
              <div class="card-header pb-0">
                <h5 class="card-title mb-0">Total Transaksi</h5>
                <small class="text-muted">Bulan Terakhir</small>
              </div>
              <div class="card-body" style="position: relative;">
                <div id="profitTransactionLastMonth" style="min-height: 100px;"></div>
                <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                    <h4 class="mb-0" id="value-total-transaction-field-analytic">0</h4>
                    <small class="text-success" id="percent-total-transaction-field-analytic">+0%</small>
                </div>
                <div class="resize-triggers"><div class="expand-trigger">
                  <div style="width: 167px; height: 171px;"></div></div><div class="contract-trigger"></div>
                </div>
              </div>
            </div>

            <div class="card">
                <div class="card-header pb-0">
                  <h5 class="card-title mb-0">Total Penyewa</h5>
                  <small class="text-muted">Bulan Terakhir</small>
                </div>
                <div class="card-body" style="position: relative;">
                  <div id="totalRenterLastMonth" style="min-height: 100px;"></div>
                  <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                    <h4 class="mb-0" id="value-total-transaction-renter-analytic">0</h4>
                    <small class="text-success" id="percent-total-transaction-renter-analytic">+0%</small>
                  </div>
                  <div class="resize-triggers"><div class="expand-trigger">
                    <div style="width: 167px; height: 171px;"></div></div><div class="contract-trigger"></div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-4 mb-4 col-md-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0 card-title">Pendapatan Gor</h5>
              </div>
              <div class="card-body">
                <div class="d-flex align-items-start">
                  <div class="badge rounded bg-label-success p-2 me-3 rounded">
                    <i class="ti ti-currency-dollar ti-sm"></i>
                  </div>
                  <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                    <div class="me-2">
                      <h6 class="mb-0" id="value-total-gor-income-analytic">0</h6>
                      <small class="text-muted">Pendapatan Anda</small>
                    </div>
                  </div>
                </div>
                <div id="data-gor-income"></div>
              </div>
            </div>
        </div>

        <div class="col-12 col-xl-4 mb-4 col-md-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0 card-title">Pendapatan Lapangan</h5>
              </div>
              <div class="card-body">
                <div class="d-flex align-items-start">
                  <div class="badge rounded bg-label-success p-2 me-3 rounded">
                    <i class="ti ti-currency-dollar ti-sm"></i>
                  </div>
                  <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                    <div class="me-2">
                      <h6 class="mb-0" id="value-total-field-income-analytic">0</h6>
                      <small class="text-muted">Pendapatan Anda</small>
                    </div>
                  </div>
                </div>
                <div id="data-field-income"></div>
              </div>
            </div>
        </div>
    </div>

</div>

@endsection