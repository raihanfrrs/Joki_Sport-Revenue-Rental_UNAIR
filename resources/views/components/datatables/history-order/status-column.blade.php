@if ($model->status == 'pending')
    <span class="badge" style="background-color: orange;"><b>Pending</b></span>
@else
    <span class="badge" style="background-color: green;"><b>Konfirmasi</b></span>
@endif