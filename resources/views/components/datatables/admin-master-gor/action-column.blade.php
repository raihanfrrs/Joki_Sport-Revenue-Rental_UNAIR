<div class="d-flex justify-content-center">
    <form action="{{ route('data.master.gor.destroy', $model->slug) }}" method="post" class="form-data-master-delete-gor-{{ $model->slug }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-slug="{{ $model->slug }}" id="button-data-master-delete-gor">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="" class="text-body"><i class="ti ti-edit ti-sm mx-2"></i></a>
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="" target="_blank" class="dropdown-item">Lihat</a>
        <form action="{{ route('data.master.gor.update.status', $model->slug) }}" method="post" class="form-data-master-update-gor-status-{{ $model->slug }}">
            @csrf
            @method('PATCH')
        <button type="submit" class="dropdown-item" id="button-data-master-update-gor-status" data-slug="{{ $model->slug }}" data-name="{{ $model->name }}">{{ $model->status == 'active' ? 'Nonaktifkan' : 'Aktifkan' }}</button>
        </form>
    </div>
</div>