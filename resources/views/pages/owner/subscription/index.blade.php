@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <!-- Pricing Plans -->
      <div class="pb-sm-5 pb-2 rounded-top">
        <div class="container py-2">
          <h2 class="text-center mb-2 mt-0 mt-md-4">Harga Berlangganan</h2>
          <p class="text-center">
            Tingkatkan paket berlangganan anda untuk mendapatkan banyak fitur dalam mengatur produk anda.
          </p>

          <div class="row mx-0 gy-3 px-lg-5 d-flex justify-content-center mt-4">

            @foreach ($subscriptions as $subscription)
                <div class="col-lg-4 mb-md-0 mb-4">
                    <div class="card border {{ auth()->user()->owner->owner_subscription->subscription->id == $subscription->id ? 'border-primary' : '' }} shadow-none">
                    <div class="card-body">
                        <div class="my-3 pt-2 text-center">
                        <img src="{{ asset($subscription->image) }}" alt="{{ $subscription->slug }}" height="140">
                        </div>
                        <h3 class="card-title fw-semibold text-center text-capitalize mb-1">{{ $subscription->name }}</h3>
                        <p class="text-center">{{ $subscription->slogan }}</p>
                        <div class="text-center">
                        <div class="d-flex justify-content-center">
                            <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">Rp</sup>
                            <h1 class="fw-semibold display-4 mb-0 text-primary">@rupiahwithoutrp($subscription->price)</h1>
                        </div>
                        </div>

                        {!! $subscription->description !!}

                        <a href="{{ auth()->user()->owner->owner_subscription->subscription->id == 1 ? route('subscription.payment', $subscription->slug) : '#' }}" class="btn btn-label-{{ auth()->user()->owner->owner_subscription->subscription->id == $subscription->id ? 'success' : 'primary' }} d-grid w-100 waves-effect">{{ auth()->user()->owner->owner_subscription->subscription->id == $subscription->id ? 'Paket Aktif' : 'Tingkatkan' }}</a>
                    </div>
                    </div>
                </div>
            @endforeach

          </div>
        </div>
      </div>
      <!--/ Pricing Plans -->
    </div>
</div>
@endsection