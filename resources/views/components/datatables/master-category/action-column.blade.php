<div class="d-flex justify-content-center">
    <form action="{{ route('master.category.destroy', $model->id) }}" method="post" class="form-delete-category-{{ $model->slug }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-slug="{{ $model->slug }}" id="button-delete-category">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="{{ route('master.category.edit', $model->id) }}" class="text-body"><i class="ti ti-edit ti-sm mx-2"></i></a>
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="{{ route('master.category.show', $model->id) }}" target="_blank" class="dropdown-item">Lihat</a>
    </div>
</div>