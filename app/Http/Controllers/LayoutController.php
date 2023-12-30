<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Models\OwnerSubscription;

class LayoutController extends Controller
{
    public function index()
    {
        $owner_subscription = OwnerSubscription::all();

        foreach ($owner_subscription as $key => $subscription) {
            if (Carbon::now()->gt($subscription->until)) {
                $subscription->update([
                    'subscription_id' => 1,
                    'until' => ''
                ]);
            }
        }

        if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'owner') ) {
            return view('welcome-coordinator');
        } elseif (!auth()->check() || auth()->user()->role = 'renter') {
            return view('welcome-renter', [
                'fields' => Field::where('status', 'active')->limit(3)->get()
            ]);
        }
        
    }
}
