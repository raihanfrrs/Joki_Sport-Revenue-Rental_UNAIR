@foreach ($schedules as $schedule)
    <button type="button" class="btn {{ $booked->contains('detail_field_id', $schedule->id) ? 'btn-secondary' : 'btn-outline-secondary' }} m-2" {{ $booked->contains('detail_field_id', $schedule->id) ? 'disabled' : '' }}>
        {{ $schedule->time_field->start }} - {{ $schedule->time_field->end }}
    </button>
@endforeach