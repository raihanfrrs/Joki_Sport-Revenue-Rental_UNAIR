<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OwnerReportingController extends Controller
{
    public function reporting_sales_index()
    {
        return view('pages.owner.reporting.sales.index');
    }

    public function reporting_sales_invoice(Transaction $transaction)
    {
        return view('pages.owner.reporting.sales.invoice', compact('transaction'));
    }

    public function reporting_sales_invoice_update_status(Transaction $transaction)
    {
        if ($transaction->status == 'pending') {
            $transaction->update([
                'status' => 'confirm'
            ]);
        } else {
            $transaction->update([
                'status' => 'pending'
            ]);
        }

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Status Transaksi Berhasil!'
        ]);
    }

    public function reporting_sales_invoice_print(Transaction $transaction)
    {
        return view('pages.owner.reporting.sales.print', compact('transaction'));
    }
}
