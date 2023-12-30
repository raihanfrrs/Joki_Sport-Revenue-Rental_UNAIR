<?php

namespace App\Http\Controllers;

use App\Models\OwnerSubscription;
use App\Models\SubscriptionTransaction;
use Illuminate\Http\Request;

class AdminReportingController extends Controller
{
    public function subscription_index()
    {
        return view('pages.admin.reporting.subscription.index');
    }

    public function subscription_invoice(SubscriptionTransaction $subscription_transaction)
    {
        return view('pages.admin.reporting.subscription.invoice', compact('subscription_transaction'));
    }

    public function subscription_update_status(SubscriptionTransaction $subscription_transaction)
    {
        OwnerSubscription::where('owner_id', $subscription_transaction->owner_id)->update([
            'subscription_id' => $subscription_transaction->subscription_id,
            'until' => $subscription_transaction->created_at->addYear()
        ]);

        $subscription_transaction->update([
            'status' => 'confirm'
        ]);

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Ubah Status Pembelian Berhasil!'
        ]);
    }
}
