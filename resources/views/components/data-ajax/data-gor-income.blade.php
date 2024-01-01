@foreach ($gors as $gor)
    <div class="d-flex justify-content-between mt-2 mb-0">
        <h6 >{{ $gor->name }}</h6>
        <div class="d-flex">
        <p class="me-3">@rupiah($gor->price)</p>
        </div>
    </div>
@endforeach