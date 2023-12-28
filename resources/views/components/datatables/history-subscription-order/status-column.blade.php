@if ($model->status == 'pending')
    <span class="badge bg-warning d-flex justify-content-center">Pending</span>
@else
    <span class="badge bg-success d-flex justify-content-center">Konfirmasi</span>
@endif