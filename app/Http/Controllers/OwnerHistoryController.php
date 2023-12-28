<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SubscriptionTransaction;

class OwnerHistoryController extends Controller
{
    public function history_subscription_index()
    {
        return view('pages.owner.history.transaction.index');
    }

    public function history_subscription_invoice(SubscriptionTransaction $subscription_transaction)
    {
        return view('pages.owner.subscription.invoice', [
            'subscription_transaction' => $subscription_transaction,
            'admin' => User::where('role', 'admin')->first()
        ]);
    }
}
