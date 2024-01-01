@extends('layouts.coordinator')

@section('section-coordinator')

<div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="row">

        <div class="col-xl-4 mb-4 col-lg-5 col-12">
            <div class="row">

                <div class="col-xl-6 col-md-3 col-6">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Pemilik</h5>
                        <small class="text-muted">Bulan Terakhir</small>
                      </div>
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                          <h4 class="mb-0" id="value-owner-analytic">0</h4>
                          <small class="" id="percent-owner-analytic">+0%</small>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-3 col-6">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Penyewa</h5>
                        <small class="text-muted">Bulan Terakhir</small>
                      </div>
                      <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                          <h4 class="mb-0" id="value-renter-analytic">0</h4>
                          <small class="text-success" id="percent-renter-analytic">+0%</small>
                        </div>
                      </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">

              <div class="col-xl-6 col-md-3 col-6">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Pemesanan</h5>
                    <small class="text-muted">Bulan Terakhir</small>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                      <h4 class="mb-0" id="value-field-order-analytic">0</h4>
                      <small class="text-success" id="percent-field-order-analytic">+0%</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-md-3 mb-4 col-6">
                <div class="card">
                  <div class="card-header pb-0">
                    <h5 class="card-title mb-0">Berlangganan</h5>
                    <small class="text-muted">Bulan Terakhir</small>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                      <h4 class="mb-0" id="value-subscription-order-analytic">0</h4>
                      <small class="text-success" id="percent-subscription-order-analytic">+0%</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-12 mb-4 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between" style="position: relative;">
                      <div class="d-flex flex-column">
                        <div class="card-title mb-auto">
                          <h5 class="mb-1 text-nowrap">Pengguna Berlangganan</h5>
                          <small>Bulan Terakhir</small>
                        </div>
                        <div class="chart-statistics">
                          <h3 class="card-title mb-1" id="value-subscription-user-count-analytic">0</h3>
                          <small class="text-success text-nowrap fw-semibold" id="percent-subscription-user-count-analytic"><i class="ti ti-chevron-up me-1"></i> +0%</small>
                        </div>
                      </div>
                      <div id="generatedLeadsChart" style="min-height: 153.8px;">
                      </div>
                    </div>
                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 309px; height: 155px;"></div></div><div class="contract-trigger"></div></div></div>
                  </div>
              </div>

              <div class="col-xl-12 mb-4 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between" style="position: relative;">
                      <div class="d-flex flex-column">
                        <div class="card-title mb-auto">
                          <h5 class="mb-1 text-nowrap">Akun</h5>
                          <small>Bulan Terakhir</small>
                        </div>
                        <div class="chart-statistics">
                          <h3 class="card-title mb-1" id="value-user-count-analytic">0</h3>
                          <small class="text-success text-nowrap fw-semibold" id="percent-user-count-analytic">+0%</small>
                        </div>
                      </div>
                      <div id="generatedUsersChart" style="min-height: 153.8px;">
                      </div>
                    </div>
                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 309px; height: 155px;"></div></div><div class="contract-trigger"></div></div></div>
                  </div>
              </div>

            </div>
        </div>

        <div class="col-xl-8 mb-4 col-md-7 col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5 class="card-title mb-0">Total Transaksi</h5>
              <small class="text-muted">Tahun Terakhir</small>
            </div>
            <div class="card-body" style="position: relative;">
              <div id="profitSubscriptionLastYear" style="min-height: 100px;"></div>
              <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                <h4 class="mb-0" id="value-total-transaction-subscription-analytic">0</h4>
                <small class="text-success" id="percent-total-transaction-subscription-analytic">+0%</small>
              </div>
              <div class="resize-triggers"><div class="expand-trigger">
                <div style="width: 167px; height: 171px;"></div></div><div class="contract-trigger"></div>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>

@endsection