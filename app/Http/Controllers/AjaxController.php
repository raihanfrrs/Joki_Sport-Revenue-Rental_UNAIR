<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Field;
use App\Models\DetailField;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Models\TempDate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class AjaxController extends Controller
{
    public function all_field_schedule(Field $field, Request $request)
    {
        $date = $request->search != 'default' ? $request->search : now()->format('Y-m-d');
        $dayName = Carbon::parse($date)->locale('id')->isoFormat('dddd');
        $booked = DetailTransaction::where('field_id', $field->id)->where('date', $date)->get(['detail_field_id']);

        return view('components.data-ajax.data-field-schedule', [
            'schedules' => DetailField::where('field_id', $field->id)->get(),
            'booked' => $booked,
            'date' => $date,
            'dayName' => $dayName,
        ]);
    }

    public function all_temp_date(Field $field)
    {
        return view('components.data-ajax.data-temp-date', compact('field'));
    }

    public function all_temp_date_store(Field $field, Request $request)
    {
        DB::transaction(function () use ($request, $field) {
            if (TempDate::where('renter_id', auth()->user()->renter->id)
                        ->where('field_id', $field->id)
                        ->where('detail_field_id', $request->data['schedule_id'])
                        ->where('day_name', $request->data['schedule_name'])
                        ->where('date', $request->data['schedule_date'])
                        ->count() == 0) 
            {
                TempDate::create([
                    'renter_id' => auth()->user()->renter->id,
                    'field_id' => $field->id,
                    'detail_field_id' => $request->data['schedule_id'],
                    'day_name' => $request->data['schedule_name'],
                    'date' => $request->data['schedule_date']
                ]);

                return true;
            } else {
                return false;
            }
        });
    }

    public function all_temp_date_delete(TempDate $temp_date)
    {
        $temp_date->delete();

        return true;
    }

    public function all_temp_date_delete_all(Field $field)
    {
        return TempDate::where('renter_id', auth()->user()->renter->id)->where('field_id', $field->id)->delete();
    }

    public function due_date_payment(Field $field)
    {
        $dueDate = $field->temp_cart->first()->due;
        $now = Carbon::now();

        $sisaMenit = $now->gt($dueDate) ? 0 : max(0, $dueDate->diffInMinutes($now));

        return "*Sisa ".$sisaMenit." Menit Lagi.";
    }

    public function due_date_payment_destroy(Field $field)
    {
        $status = false;
        foreach ($field->temp_cart as $key => $temp_cart) {
            $dueDate = Carbon::parse($temp_cart->due);
            $now = Carbon::now();
    
            $sisaMenit = $now->gt($dueDate) ? 0 : max(0, $dueDate->diffInMinutes($now));
    
            if ($sisaMenit <= 0) {
                $temp_cart->delete();
                $status = true;
            }
        }

        return $status;
    }
}
