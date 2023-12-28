@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Langganan /</span> Pembayaran</h4>
    <!-- Checkout Wizard -->
    <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mt-2">
      <div class="bs-stepper-content border-top">
          <div id="checkout-cart" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row">
              <!-- Cart left -->
              <div class="col-xl-8 mb-3 mb-xl-0">

                <!-- Shopping bag -->
                <ul class="list-group mb-3">
                  <li class="list-group-item p-4">
                    <div class="d-flex gap-3">
                      <div class="flex-shrink-0 d-flex align-items-center">
                        <img src="{{ asset($subscription->image) }}" alt="{{ $subscription->slug }}" class="w-px-100">
                      </div>
                      <div class="flex-grow-1">
                        <div class="row">
                          <div class="col-md-8">
                            <p class="me-3">
                              <a href="javascript:void(0)" class="text-body">Paket Langganan - {{ $subscription->name }}</a>
                            </p>
                            <div class="text-muted mb-2 d-flex flex-wrap">
                              <span class="me-1">Masa Berlaku:</span>
                              <a href="javascript:void(0)" class="me-3">1 Tahun</a>
                            </div>
                            <span class="badge bg-label-success">Tersedia</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>

              <!-- Cart right -->
              <div class="col-xl-4">
                <form action="{{ route('subscription.payment.store', $subscription->slug) }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="border rounded p-4 mb-3 pb-3">
                    <div class="bg-lighter rounded p-3">
                        <p class="fw-semibold mb-2">Tata Cara Pembayaran</p>
                        <p class="mb-2">
                            <ol>
                                <li>Gunakan Mobile Banking / mesin ATM.</li>
                                <li>Isi nominal sesuai dengan total pembayaran yang tertera.</li>
                                <li>Isi catatan dengan format: nama_akun.</li>
                                <li>Transfer ke rekening: 
                                    <ul>
                                        <li>BCA: <b>1234567890</b></li>
                                        <li>BNI: <b>1234567890</b></li>
                                        <li>MANDIRI: <b>1234567890</b></li>
                                    </ul>
                                </li>
                                <li>Screenshot / Foto bukti pembayaran.</li>
                                <li>Masukkan bukti pembayaran dibawah ini.</li>
                            </ol>
                        </p>
                    </div>
                    <hr class="mx-n4">

                  <!-- Price Details -->
                  <h6>Rincian Harga</h6>
                  <dl class="row mb-0">
                    <dt class="col-6 fw-normal">Paket Langganan - {{ $subscription->name }}</dt>
                    <dd class="col-6 text-end">@rupiah($subscription->price)</dd>
                  </dl>

                  <hr class="mx-n4">
                  <dl class="row mb-0">
                    <dt class="col-6">Total</dt>
                    <dd class="col-6 fw-semibold text-end mb-0">@rupiah($subscription->price)</dd>
                  </dl>

                  <hr class="mx-n4">

                  <h6>Bukti Transfer</h6>
                  <div class="row g-3 mb-3">
                    <div class="col-12 col-xxl-12 col-xl-12">
                        <input type="file" class="form-control" name="subscription_image" required>
                    </div>
                  </div>
                </div>
                <div class="d-grid">
                  <button class="btn btn-primary btn-next waves-effect waves-light">Beli Sekarang</button>
                </div>
                </form>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection