@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">
      <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                <div class="mb-xl-0 mb-4">
                    <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                    <span class="app-brand-text fw-bold fs-4">Sport Venue Rental</span>
                    </div>
                </div>
                <div>
                    <h4 class="fw-semibold mb-2">BERLANGGANAN #{{ $subscription_transaction->id }}</h4>
                    <div class="mb-2 pt-1">
                    <span>Tanggal Pembayaran:</span>
                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($subscription_transaction->created_at)->format('d/m/Y H:i:s') }}</span>
                    </div>
                </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                    <h6 class="mb-3">Pembelian Oleh:</h6>
                    <p class="mb-1">{{ $subscription_transaction->owner->name }}</p>
                    <p class="mb-1">{{ $subscription_transaction->owner->phone }}</p>
                    <p class="mb-1">{{ $subscription_transaction->owner->user->email }}</p>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                    <h6 class="mb-4">Rincian Berlangganan:</h6>
                    <table>
                    <tbody>
                        <tr>
                        <td class="pe-4">Nominal:</td>
                        <td><strong>@rupiah($subscription_transaction->subscription->price)</strong></td>
                        </tr>
                        <tr>
                        <td class="pe-4">Paket Langganan:</td>
                        <td>{{ $subscription_transaction->subscription->name }}</td>
                        </tr>
                        <tr>
                        <td class="pe-4">Deskripsi Paket:</td>
                        <td>{!! $subscription_transaction->subscription->description !!}</td>
                        </tr>
                        <tr>
                        <td class="pe-4">Status Pembelian:</td>
                        <td>
                            @if ($subscription_transaction->status == 'pending')
                                <span class="badge rounded-pill bg-warning bg-glow">Pending</span>
                            @elseif ($subscription_transaction->status == 'confirm')
                                <span class="badge rounded-pill bg-success bg-glow">Terkonfirmasi</span>
                            @endif
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
      <!-- /Invoice -->

        <div class="col-xl-3 col-md-4 col-12 invoice-actions">
            <div class="card">
                <div class="card-body">
                    <p class="fw-bold">Bukti Pembayaran :</p>
                    <img src="{{ $subscription_transaction->getFirstMediaUrl('subscription_image') }}" class="img-fluid" alt="">
                    @if ($subscription_transaction->status == 'pending')
                    <hr class="my-3">
                    <form action="{{ route('admin.reporting.update.status', $subscription_transaction->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-1"></i>Konfirmasi</span>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection