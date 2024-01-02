<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        {{-- <a href="" target="_blank" class="dropdown-item">Lihat</a> --}}
        <form action="{{ route('master.renter.update.status', $model->slug) }}" method="post">
            @csrf
            @method('PATCH')
        <button type="submit" class="dropdown-item">{{ $model->banned_renter->count() == 0 ? 'Nonaktifkan' : 'Aktifkan' }}</button>
        </form>
    </div>
</div>