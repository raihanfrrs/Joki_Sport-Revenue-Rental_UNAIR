<?php

namespace App\Http\Controllers;

use App\Models\OwnerSubscription;
use App\Models\Subscription;
use App\Models\SubscriptionTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerSubscriptionController extends Controller
{
    public function subscription_pricing_index()
    {
        return view('pages.owner.subscription.index', [
            'subscriptions' => Subscription::all()
        ]);
    }

    public function subscription_payment(Subscription $subscription)
    {
        return view('pages.owner.subscription.payment', compact('subscription'));
    }

    public function subscription_payment_store(Request $request, Subscription $subscription)
    {
        if (OwnerSubscription::where('subscription_id', 2)->where('status', 'active')->count() > 0 
                || SubscriptionTransaction::where('owner_id', auth()->user()->owner->id)->where('status', 'pending')->count() > 0) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Tidak dapat membeli paket langganan!'
            ]);
        } else {
            $subscription_transaction = SubscriptionTransaction::create([
                'owner_id' => auth()->user()->owner->id,
                'subscription_id' => $subscription->id
            ]);
    
            if ($request->hasFile('subscription_image')) {
                $subscription_transaction->addMediaFromRequest('subscription_image')->toMediaCollection('subscription_image');
            }
    
            return redirect()->route('subscription.payment.invoice', $subscription_transaction)->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Pembayaran Berhasil!'
            ]);
        }
    }

    public function subscription_payment_invoice(SubscriptionTransaction $subscription_transaction)
    {
        return view('pages.owner.subscription.invoice', [
            'subscription_transaction' => $subscription_transaction,
            'admin' => User::where('role', 'admin')->first()
        ]);
    }
}
