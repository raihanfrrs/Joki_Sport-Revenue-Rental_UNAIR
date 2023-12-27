<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Field;
use App\Models\TempCart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment_field_index(Field $field)
    {
        return view('pages.renter.booking.payment', compact('field'));
    }

    public function payment_field_store(Request $request, Field $field)
    {
        $temp_cart = TempCart::where('field_id', $field->id)->get();

        DB::transaction(function () use ($request, $field, $temp_cart) {
            $transaction = Transaction::create([
                'renter_id' => auth()->user()->renter->id,
                'gor_id' => $field->gor->id,
                'grand_total' => $temp_cart->sum('subtotal')
            ]);

            foreach ($temp_cart as $key => $detail_transaction) {
                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'field_id' => $field->id,
                    'detail_field_id' => $detail_transaction->detail_field_id,
                    'day_name' => $detail_transaction->day_name,
                    'date' => $detail_transaction->date,
                    'subtotal' => $detail_transaction->subtotal
                ]);

                $detail_transaction->delete();
            }

            if ($request->hasFile('transaction_image')) {
                $transaction->addMediaFromRequest('transaction_image')->toMediaCollection('transaction_image');
            }
        });

        return redirect()->intended('/')->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Pembayaran Berhasil!'
        ]);
    }
}
