@if ($field->temp_date->count() > 0)
<table class="table table-hover">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Hari</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Jam</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($field->temp_date as $item)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $item->day_name }}</td>
            <td class="text-center">{{ $item->date }}</td>
            <td class="text-center">{{ $item->detail_field->time_field->start }} - {{ $item->detail_field->time_field->end }}</td>
            <td class="text-center"><a href="#" id="button-delete-temp-date" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif