@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <!-- User Sidebar -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card mb-4">
          <div class="card-body">
            <div class="user-avatar-section">
              <div class="d-flex align-items-center flex-column">
                @if ($owner->getFirstMediaUrl('owner_image'))
                    <img
                        class="img-fluid rounded mb-3 pt-1 mt-4"
                        src="{{ $owner_image->getFirstMediaUrl('owner_image') }}"
                        height="100"
                        width="100"
                        alt="{{ $owner->slug }}" />
                @else
                    <img
                        class="img-fluid rounded mb-3 pt-1 mt-4"
                        src="{{ asset('assets/img/avatars/1.png') }}"
                        height="100"
                        width="100"
                        alt="{{ $owner->image }}" />
                @endif
                <div class="user-info text-center">
                  <h4 class="mb-2">{{ $owner->name }}</h4>
                  <span class="badge bg-label-secondary mt-1">Pemilik</span>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
              <div class="d-flex align-items-start me-4 mt-3 gap-2">
                <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-checkbox ti-sm"></i></span>
                <div>
                  <p class="mb-0 fw-semibold">{{ count($owner->subscription_transaction) }}</p>
                  <small>Pembelian Paket</small>
                </div>
              </div>
            </div>
            <p class="mt-4 small text-uppercase text-muted">Rincian</p>
            <div class="info-container">
              <ul class="list-unstyled">
                <li class="mb-2">
                  <span class="fw-semibold me-1">Alamat Surel:</span>
                  <span>{{ $owner->user->email }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-semibold me-1">Nomor Telepon:</span>
                  <span>{{ $owner->phone }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-semibold me-1">Status:</span>
                  <span class="badge bg-label-success">{{ $owner->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}</span>
                </li>
              </ul>
              <div class="d-flex justify-content-center">
                <a href="javascript:;" class="btn btn-primary me-3 waves-effect waves-light" data-bs-target="#editUser" data-bs-toggle="modal" id="button-form-owner-edit" data-slug="{{ $owner->slug }}">Edit</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /User Card -->

        <div class="card mb-4">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <span class="badge bg-label-primary">{{ $owner->owner_subscription->subscription->name }}</span>
                <div class="d-flex justify-content-center">
                  <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">Rp</sup>
                  <h1 class="fw-semibold mb-0 text-primary">@rupiahwithoutrp($owner->owner_subscription->subscription->price)</h1>
                  @if ($owner->owner_subscription->subscription->slug == 'superior')
                    <sub class="h6 pricing-duration mt-auto mb-2 fw-normal text-muted">/tahun</sub>
                  @endif
                </div>
              </div>
              {!! $owner->owner_subscription->subscription->description !!}
              @if ($owner->owner_subscription->subscription->slug == 'superior')
              <div class="d-flex justify-content-between align-items-center mb-1 fw-semibold text-heading">
                <span>Sisa Hari</span>
                <span>{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($owner->owner_subscription->until) }}</span>
              </div>
              @endif
            </div>
          </div>
      </div>
      <!--/ User Sidebar -->

      <!-- User Content -->
      <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- User Pills -->
        <ul class="nav nav-pills flex-column flex-md-row mb-4">
          <li class="nav-item">
            <a class="nav-link active" href="app-user-view-security.html"><i class="ti ti-lock ti-xs me-1"></i>Security</a>
          </li>
        </ul>
        <!--/ User Pills -->

        <div class="card mb-4">
            <h5 class="card-header">Ganti Password</h5>
            <div class="card-body">
                <form action="{{ route('data.master.owner.update.password', $owner->slug) }}" id="formChangePassword" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="mb-3 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
                            <label class="form-label" for="newPassword">New Password</label>
                            <div class="input-group input-group-merge has-validation">
                            <input class="form-control" type="password" id="newPassword" name="password" placeholder="············" required>
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div><div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Ganti Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <!--/ User Content -->
    </div>

    <!-- Modal -->
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
              <h3 class="mb-2">Ubah Identitas Pemilik</h3>
              <p class="text-muted">Anda berhak mengubah apabila terdapat kesalahan pada identitas.</p>
            </div>
            <div id="data-form-owner-edit"></div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Edit User Modal -->

    <!-- /Modal -->
</div>
@endsection