<?php

namespace App\Http\Controllers;

use App\Models\DetailField;
use App\Models\DetailTransaction;
use App\Models\Field;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AjaxController extends Controller
{
    public function all_field_schedule(Field $field, Request $request)
    {
        $today = Carbon::now()->locale('id')->isoFormat('dddd');
        $date = $request->search != 'default' ? $request->search : now()->format('Y-m-d');
        $booked = DetailTransaction::where('field_id', $field->id)->where('date', $date)->get(['detail_field_id']);

        return view('components.data-ajax.data-field-schedule', [
            'schedules' => DetailField::where('field_id', $field->id)->get(),
            'booked' => $booked
        ]);
    }
}
