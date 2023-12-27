<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\TempCart;
use App\Models\TempDate;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookedController extends Controller
{
    public function booking_field_index(Field $field)
    {
        return view('pages.renter.booking.index', compact('field'));
    }

    public function booking_field_store(Field $field)
    {
        $temp_date = TempDate::where('renter_id', auth()->user()->renter->id)->where('field_id', $field->id)->get();

        if ($temp_date->count() == 0) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Pilih Jam Sewa Terlebih Dahulu!'
            ]);
        }
        
        $counter = 0;
        foreach ($temp_date as $key => $value) {
            if (TempCart::where('field_id', $field->id)
                        ->where('detail_field_id', $value->detail_field_id)
                        ->where('renter_id', auth()->user()->renter->id)
                        ->where('gor_id', $field->gor->id)
                        ->where('day_name', $value->day_name)
                        ->where('date', $value->date)
                        ->count() == 0) 
            {
                $counter++;
            }
        }

        if (TempCart::where('field_id', $field->id)->count() == 0) {
            if ($counter == $temp_date->count()) {
                foreach ($temp_date as $key => $value) {
                    TempCart::create([
                        'renter_id' => auth()->user()->renter->id,
                        'gor_id' => $field->gor->id,
                        'field_id' => $field->id,
                        'detail_field_id' => $value->detail_field_id,
                        'day_name' => $value->day_name,
                        'date' => $value->date,
                        'due' => Carbon::now()->addMinutes(30),
                        'subtotal' => $field->gor->price
                    ]);
        
                    TempDate::where('field_id', $value->field_id)
                            ->where('detail_field_id', $value->detail_field_id)
                            ->where('renter_id', auth()->user()->renter->id)
                            ->where('day_name', $value->day_name)
                            ->where('date', $value->date)
                            ->delete();
                }
            } else {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'error',
                    'message' => 'Pesanan Sudah ada di Keranjang!'
                ]);
            }
        } else {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Pesanan '.$field->name.' Belum Dibayar!'
            ]);
        }
        

        return redirect()->route('payment.field.waiting', $field->slug)->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Pesanan Berhasil!'
        ]);
    }

    public function history_order_index()
    {
        return view('pages.renter.history.index');
    }

    public function history_order_show(Transaction $transaction)
    {
        return view('pages.renter.history.show', compact('transaction'));
    }

    public function history_order_waiting()
    {
        return view('pages.renter.payment-waiting.index');
    }
}
