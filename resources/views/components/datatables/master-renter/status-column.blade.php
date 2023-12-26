@if ($model->banned_renter->count() == 0)
    <span class="badge bg-success d-flex justify-content-center">Aktif</span>
@else
    <span class="badge bg-danger d-flex justify-content-center">Tidak Aktif</span>
@endif