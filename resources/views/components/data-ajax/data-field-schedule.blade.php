@foreach ($schedules as $schedule)
@php
    $tanggalDanWaktu = $date . ' ' . $schedule->time_field->start;
    $tanggalDanWaktuObj = new DateTime($tanggalDanWaktu);
    $tanggalDanWaktuFormatted = $tanggalDanWaktuObj->format('Y-m-d H:i:s');
@endphp
    <button type="button" id="button-schedule-value-id" data-id="{{ $schedule->id }}" data-date="{{ $date }}" data-day-name="{{ $dayName }}" class="btn {{ $booked->contains('detail_field_id', $schedule->id) || \Carbon\Carbon::now() > $tanggalDanWaktuFormatted ? 'btn-secondary' : 'btn-outline-secondary' }} m-2" {{ $booked->contains('detail_field_id', $schedule->id) || \Carbon\Carbon::now() > $tanggalDanWaktuFormatted ? 'disabled' : '' }}>
        {{ $schedule->time_field->start }} - {{ $schedule->time_field->end }}
    </button>
@endforeach