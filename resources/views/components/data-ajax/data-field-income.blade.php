@foreach ($fields as $field)
    <div class="d-flex justify-content-between mt-2 mb-0">
        <h6 >{{ $field->name }}</h6>
        <div class="d-flex">
        <p class="me-3">@rupiah($field->price)</p>
        </div>
    </div>
@endforeach