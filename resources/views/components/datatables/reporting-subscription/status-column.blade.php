@if ($model->status == 'confirm')
    <span class="badge bg-success d-flex justify-content-center">Konfirmasi</span>
@else
    <span class="badge bg-warning d-flex justify-content-center">Pending</span>
@endif