@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Langganan /</span> Invoice</h4>
              <!-- Checkout Wizard -->
              <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mt-2">
                <div class="bs-stepper-content border-top">

                    <div id="checkout-confirmation" class="content fv-plugins-bootstrap5 fv-plugins-framework active dstepper-block">
                      <div class="row mb-3">
                        <div class="col-12 col-lg-8 offset-lg-2 text-center mb-3">
                          <h4 class="mt-2">Terima Kasih! 😇</h4>
                          <p>Pesanan kamu <a href="javascript:void(0)">#{{ $subscription_transaction->id }}</a> sudah dalam proses!</p>
                          <p>
                            Admin akan menghubungi anda melalui alamat surel <a href="#">{{ $subscription_transaction->owner->user->email }}</a> atau melalui nomor telepon <a href="#">{{ $subscription_transaction->owner->phone }}</a> terkait perkembangan pesanan anda. Jika selama 1-3 hari belum ada konfirmasi dari admin, silahkan untuk menunggu atau hubungi alamat surel admin <a href="#">{{ $admin->email }}</a>.
                          </p>
                          <p>
                            <span class="fw-semibold"><i class="ti ti-clock me-1"></i> Tanggal Pembayaran:</span> {{ \Carbon\Carbon::parse($subscription_transaction->created_at)->locale('id_ID')->isoFormat('D MMMM Y H:mm:ss') }}
                          </p>
                        </div>
                      </div>

                      <div class="row">
                        <!-- Confirmation items -->
                        <div class="col-xl-9 mb-3 mb-xl-0">
                          <ul class="list-group">
                            <li class="list-group-item p-4">
                              <div class="d-flex gap-3">
                                <div class="flex-shrink-0">
                                  <img src="{{ asset($subscription_transaction->subscription->image) }}" alt="google home" class="w-px-75">
                                </div>
                                <div class="flex-grow-1">
                                  <div class="row">
                                    <div class="col-md-8">
                                      <a href="javascript:void(0)" class="text-body">
                                        <p>Paket Langganan - {{ $subscription_transaction->subscription->name }}</p>
                                      </a>
                                      <div class="text-muted mb-1 d-flex flex-wrap">
                                        <span class="me-1">Masa Berlaku:</span>
                                        <a href="javascript:void(0)" class="me-3">1 Tahun</a>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="text-md-end">
                                        <div class="my-2 my-lg-4">
                                          <span class="text-primary">@rupiah($subscription_transaction->subscription->price)</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                        <!-- Confirmation total -->
                        <div class="col-xl-3">
                          <div class="border rounded p-4 pb-3">
                            <!-- Price Details -->
                            <h6>Rincian Harga</h6>
                            <dl class="row mb-0">
                              <dt class="col-6 fw-normal">Subtotal</dt>
                              <dd class="col-6 text-end">@rupiah($subscription_transaction->subscription->price)</dd>
                            </dl>
                            <hr class="mx-n4">
                            <dl class="row mb-0">
                              <dt class="col-6">Total</dt>
                              <dd class="col-6 fw-semibold text-end mb-0">@rupiah($subscription_transaction->subscription->price)</dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
@endsection