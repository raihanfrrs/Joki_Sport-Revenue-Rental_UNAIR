<div class="d-flex justify-content-center">
    <form action="" method="post" class="form-delete-product-{{ $model->slug }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-slug="{{ $model->slug }}" id="button-delete-product">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="javascript:;" class="text-body" id="button-trigger-modal-product" data-slug="{{ $model->slug }}" data-bs-target="#editMasterProduct" data-bs-toggle="modal"><i class="ti ti-edit ti-sm mx-2"></i></a>
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="" target="_blank" class="dropdown-item">Lihat</a>
        <form action="" method="post" id="form-change-status-product">
            @csrf
            @method('PATCH')
        <a href="javascript:;" class="dropdown-item" id="suspend-product">{{ $model->status == 'active' ? 'Nonaktifkan' : ($model->status == 'deleted' ? 'Pulihkan' : 'Aktifkan') }}</a>
        </form>
    </div>
</div>