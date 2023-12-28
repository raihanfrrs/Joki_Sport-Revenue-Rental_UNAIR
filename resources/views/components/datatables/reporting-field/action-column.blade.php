<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="{{ route('reporting.sales.invoice', $model->id) }}" target="_blank" class="dropdown-item">Lihat</a>
        <form action="{{ route('reporting.sales.invoice.update.status', $model->id) }}" method="post">
            @csrf
            @method('PATCH')
        <button type="submit" class="dropdown-item">{{ $model->status == 'pending' ? 'Konfirmasi' : 'Pending' }}</button>
        </form>
    </div>
</div>