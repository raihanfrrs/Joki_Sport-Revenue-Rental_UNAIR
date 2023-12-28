@extends('layouts.coordinator')

@section('section-coordinator')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
          <div class="card invoice-preview-card">
            <div class="card-body">
              <div
                class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                <div class="mb-xl-0 mb-4">
                  <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                    <span class="app-brand-text fw-bold fs-4"> Sport Rental Venue </span>
                  </div>
                </div>
                <div>
                  <div class="mb-2 pt-1">
                    <span>Tanggal Pembayaran: {{ \Carbon\Carbon::parse($transaction->created_at)->locale('id_ID')->isoFormat('D MMMM Y H:mm:ss') }}</span>
                    <span class="fw-semibold"></span>
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <div class="row p-sm-3 p-0">
                <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                  <h6 class="mb-3">Invoice Kepada:</h6>
                  <p class="mb-1">{{ $transaction->renter->name }}</p>
                  <p class="mb-1">{{ $transaction->renter->phone }}</p>
                  <p class="mb-0">{{ $transaction->renter->user->email }}</p>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                  <h6 class="mb-3">Lapangan:</h6>
                  <p class="mb-1">{{ $transaction->gor->name }}</p>
                  <p class="mb-1">{{ $transaction->detail_transaction->first()->field->name }}</p>
                  <p class="mb-0">{{ $transaction->gor->address }}</p>
                </div>
              </div>
            </div>
            <div class="table-responsive border-top">
              <table class="table m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Subtotal</th>
                      </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->detail_transaction as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-nowrap">{{ $item->day_name }}</td>
                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                        <td class="text-nowrap">{{ $item->detail_field->time_field->start }} - {{ $item->detail_field->time_field->end }}</td>
                        <td class="text-nowrap">@rupiah($item->subtotal)</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="align-top px-4 py-4">
                        <p class="mb-2 mt-3">
                            <span class="ms-3 fw-semibold">Pemilik:</span>
                            <span>{{ $transaction->gor->owner->name }}</span>
                        </p>
                        <span class="ms-3">Terima kasih telah mempercayai kami.</span>
                        </td>
                        <td class="text-end pe-3 py-4">
                        <p class="mb-0 pb-3">Total:</p>
                        </td>
                        <td class="ps-2 py-4">
                        <p class="fw-semibold mb-0 pb-3">@rupiah($transaction->detail_transaction->count() * $transaction->gor->price)</p>
                        </td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions">
          <div class="card">
            <div class="card-body">
                <form action="{{ route('reporting.sales.invoice.update.status', $transaction->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button
                        type="submit"
                        class="btn btn-{{ $transaction->status == 'pending' ? 'primary' : 'danger' }} d-grid w-100 mb-2"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#sendInvoiceOffcanvas">
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                        ><i class="ti ti-send ti-xs me-1"></i>{{ $transaction->status == 'pending' ? 'Konfirmasi' : 'Pending' }}</span
                        >
                    </button>
                </form>
              <a
                class="btn btn-label-secondary d-grid w-100 mb-2"
                target="_blank"
                href="{{ route('reporting.sales.invoice.print', $transaction->id) }}">
                Print
              </a>
            </div>
          </div>
        </div>
        <!-- /Invoice Actions -->
    </div>

</div>
@endsection