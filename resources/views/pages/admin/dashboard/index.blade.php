@extends('layouts.coordinator')

@section('section-coordinator')

<div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="row">

        <div class="col-xl-4 mb-4 col-lg-5 col-12">
            <div class="row">

                <div class="col-xl-6 col-md-3 col-6">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Pengguna</h5>
                        <small class="text-muted">Bulan Terakhir</small>
                      </div>
                      <div class="card-body">
                        <div id="profitLastMonth"></div>
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                          <h4 class="mb-0" id="value-user-analytic">0</h4>
                          <small class="" id="percent-user-analytic">+0%</small>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-3 col-6">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Keuntungan</h5>
                        <small class="text-muted">Bulan Terakhir</small>
                      </div>
                      <div class="card-body">
                        <div id="profitLastMonth"></div>
                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                          <h4 class="mb-0">0</h4>
                          <small class="text-success">+0%</small>
                        </div>
                      </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="d-flex justify-content-between">
                          <small class="d-block mb-1 text-muted">Ringkasan Pengguna</small>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-4">
                            <div class="d-flex gap-2 align-items-center mb-2">
                              <span class="badge bg-label-info p-1 rounded"
                                ><i class="ti ti-diamond"></i></span>
                              <p class="mb-0">Langganan</p>
                            </div>
                            <h5 class="mb-0 pt-1 text-nowrap">0%</h5>
                            <small class="text-muted">0</small>
                          </div>
                          <div class="col-4">
                            <div class="divider divider-vertical">
                              <div class="divider-text">
                                <span class="badge-divider-bg bg-label-secondary">VS</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-4 text-end">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                              <p class="mb-0">Gratis</p>
                              <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-diamond-off"></i></span>
                            </div>
                            <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">0%</h5>
                            <small class="text-muted">0</small>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                          <div class="progress w-100" style="height: 8px">
                            <div
                              class="progress-bar bg-info"
                              style="width: 70%"
                              role="progressbar"
                              aria-valuenow="70"
                              aria-valuemin="0"
                              aria-valuemax="100"></div>
                            <div
                              class="progress-bar bg-primary"
                              role="progressbar"
                              style="width: 30%"
                              aria-valuenow="30"
                              aria-valuemin="0"
                              aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-lg-8 mb-4 h-25">
            <div class="card h-100">
              <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                <div class="card-title mb-0">
                  <h5 class="mb-0">Laporan Pendapatan</h5>
                  <small class="text-muted">Ringkasan Pendapatan Mingguan</small>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="earningReportsId"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
                <!-- </div> -->
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                    <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                      <h1 class="mb-0">Rp. 0</h1>
                      <div class="badge rounded bg-label-success">+0%</div>
                    </div>
                    <small class="text-muted">Perbandingan pendapatan minggu ini dan minggu lalu</small>
                  </div>
                  <div class="col-12 col-md-8">
                    <div id="weeklyEarningReports"></div>
                  </div>
                </div>
              </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-4 col-md-4">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                  <h5 class="mb-0">Aktivitas Sosial</h5>
                  <small class="text-muted">Total 0 Sosial</small>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="MonthlyCampaign"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                  <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-success rounded p-2"><i class="ti ti-mail ti-sm"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Emails</h6>
                      <div class="d-flex">
                        <p class="mb-0 fw-semibold">12,346</p>
                        <p class="ms-3 text-success mb-0">0.3%</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-info rounded p-2"><i class="ti ti-link ti-sm"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Opened</h6>
                      <div class="d-flex">
                        <p class="mb-0 fw-semibold">8,734</p>
                        <p class="ms-3 text-success mb-0">2.1%</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-warning rounded p-2"><i class="ti ti-click ti-sm"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Clicked</h6>
                      <div class="d-flex">
                        <p class="mb-0 fw-semibold">967</p>
                        <p class="ms-3 text-success mb-0">1.4%</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-primary rounded p-2"><i class="ti ti-users ti-sm"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Subscribe</h6>
                      <div class="d-flex">
                        <p class="mb-0 fw-semibold">345</p>
                        <p class="ms-3 text-success mb-0">8.5k</p>
                      </div>
                    </div>
                  </li>
                  <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-secondary rounded p-2">
                      <i class="ti ti-alert-triangle ti-sm text-body"></i>
                    </div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Complaints</h6>
                      <div class="d-flex">
                        <p class="mb-0 fw-semibold">10</p>
                        <p class="ms-3 text-success mb-0">1.5%</p>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex justify-content-between align-items-center">
                    <div class="badge bg-label-danger rounded p-2"><i class="ti ti-ban ti-sm"></i></div>
                    <div class="d-flex justify-content-between w-100 flex-wrap">
                      <h6 class="mb-0 ms-3">Unsubscribe</h6>
                      <div class="d-flex">
                        <p class="mb-0 fw-semibold">86</p>
                        <p class="ms-3 text-success mb-0">0.8%</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        <div class="col-md-4 col-xl-4">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between">
                <div class="card-title m-0 me-2">
                  <h5 class="m-0 me-2">Produk Populer</h5>
                  <small class="text-muted">Total <span id="value-product-popular-analytic">0</span> Produk</small>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="popularProduct"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularProduct">
                    <a class="dropdown-item" href="javascript:void(0);" id="date-product-popular-filter" data-date="last-month">Bulan Terakhir</a>
                    <a class="dropdown-item" href="javascript:void(0);" id="date-product-popular-filter" data-date="last-year">Tahun Kemarin</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="data-product-popular-analytic"></div>
              </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-4 col-xl-4">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between pb-2 mb-1">
                <div class="card-title mb-1">
                  <h5 class="m-0 me-2">Kemajuan Campaign</h5>
                  <small class="text-muted">0 Campaign dalam Proses</small>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="salesByCountryTabs"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountryTabs">
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="nav-align-top">
                  <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link active"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-new"
                        aria-controls="navs-justified-new"
                        aria-selected="true">
                        New
                      </button>
                    </li>
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-link-preparing"
                        aria-controls="navs-justified-link-preparing"
                        aria-selected="false">
                        Preparing
                      </button>
                    </li>
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-justified-link-shipping"
                        aria-controls="navs-justified-link-shipping"
                        aria-selected="false">
                        Shipping
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content pb-0">
                    <div class="tab-pane fade show active" id="navs-justified-new" role="tabpanel">
                      <ul class="timeline timeline-advance timeline-advance mb-2 pb-1">
                        <li class="timeline-item ps-4 border-left-dashed">
                          <span class="timeline-indicator timeline-indicator-success">
                            <i class="ti ti-circle-check"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-success text-uppercase fw-semibold">sender</small>
                            </div>
                            <h6 class="mb-0">Myrtle Ullrich</h6>
                            <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA), 95959</p>
                          </div>
                        </li>
                        <li class="timeline-item ps-4 border-0">
                          <span class="timeline-indicator timeline-indicator-primary">
                            <i class="ti ti-map-pin"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-primary text-uppercase fw-semibold">Receiver</small>
                            </div>
                            <h6 class="mb-0">Barry Schowalter</h6>
                            <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118</p>
                          </div>
                        </li>
                      </ul>
                      <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                      <ul class="timeline timeline-advance mb-0">
                        <li class="timeline-item ps-4 border-left-dashed">
                          <span class="timeline-indicator timeline-indicator-success">
                            <i class="ti ti-circle-check"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-success text-uppercase fw-semibold">sender</small>
                            </div>
                            <h6 class="mb-0">Veronica Herman</h6>
                            <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA), 95492</p>
                          </div>
                        </li>
                        <li class="timeline-item ps-4 border-0">
                          <span class="timeline-indicator timeline-indicator-primary">
                            <i class="ti ti-map-pin"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-primary text-uppercase fw-semibold">Receiver</small>
                            </div>
                            <h6 class="mb-0">Helen Jacobs</h6>
                            <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA), 94043</p>
                          </div>
                        </li>
                      </ul>
                    </div>

                    <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                      <ul class="timeline timeline-advance mb-2 pb-1">
                        <li class="timeline-item ps-4 border-left-dashed">
                          <span class="timeline-indicator timeline-indicator-success">
                            <i class="ti ti-circle-check"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-success text-uppercase fw-semibold">sender</small>
                            </div>
                            <h6 class="mb-0">Barry Schowalter</h6>
                            <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118</p>
                          </div>
                        </li>
                        <li class="timeline-item ps-4 border-0 border-left-dashed">
                          <span class="timeline-indicator timeline-indicator-primary">
                            <i class="ti ti-map-pin"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-primary text-uppercase fw-semibold">Receiver</small>
                            </div>
                            <h6 class="mb-0">Myrtle Ullrich</h6>
                            <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA), 95959</p>
                          </div>
                        </li>
                      </ul>
                      <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                      <ul class="timeline timeline-advance mb-0">
                        <li class="timeline-item ps-4 border-left-dashed">
                          <span class="timeline-indicator timeline-indicator-success">
                            <i class="ti ti-circle-check"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-success text-uppercase fw-semibold">sender</small>
                            </div>
                            <h6 class="mb-0">Veronica Herman</h6>
                            <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA), 95492</p>
                          </div>
                        </li>
                        <li class="timeline-item ps-4 border-0">
                          <span class="timeline-indicator timeline-indicator-primary">
                            <i class="ti ti-map-pin"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-primary text-uppercase fw-semibold">Receiver</small>
                            </div>
                            <h6 class="mb-0">Helen Jacobs</h6>
                            <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA), 94043</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                      <ul class="timeline timeline-advance mb-2 pb-1">
                        <li class="timeline-item ps-4 border-left-dashed">
                          <span class="timeline-indicator timeline-indicator-success">
                            <i class="ti ti-circle-check"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-success text-uppercase fw-semibold">sender</small>
                            </div>
                            <h6 class="mb-0">Veronica Herman</h6>
                            <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA), 95959</p>
                          </div>
                        </li>
                        <li class="timeline-item ps-4 border-0">
                          <span class="timeline-indicator timeline-indicator-primary">
                            <i class="ti ti-map-pin"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-primary text-uppercase fw-semibold">Receiver</small>
                            </div>
                            <h6 class="mb-0">Barry Schowalter</h6>
                            <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118</p>
                          </div>
                        </li>
                      </ul>
                      <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                      <ul class="timeline timeline-advance mb-0">
                        <li class="timeline-item ps-4 border-left-dashed">
                          <span class="timeline-indicator timeline-indicator-success">
                            <i class="ti ti-circle-check"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-success text-uppercase fw-semibold">sender</small>
                            </div>
                            <h6 class="mb-0">Myrtle Ullrich</h6>
                            <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA), 95492</p>
                          </div>
                        </li>
                        <li class="timeline-item ps-4 border-0">
                          <span class="timeline-indicator timeline-indicator-primary">
                            <i class="ti ti-map-pin"></i>
                          </span>
                          <div class="timeline-event ps-0 pb-0">
                            <div class="timeline-header">
                              <small class="text-primary text-uppercase fw-semibold">Receiver</small>
                            </div>
                            <h6 class="mb-0">Helen Jacobs</h6>
                            <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA), 94043</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection