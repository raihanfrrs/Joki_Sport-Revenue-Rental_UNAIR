<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Owner;
use App\Models\Renter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRegisterUser;
use App\Http\Requests\StoreRegistrationUser;
use App\Models\OwnerSubscription;

class RegisterController extends Controller
{
    public function registration_index()
    {
        return view('pages.auth.renter.register');
    }

    public function registration_store(StoreRegistrationUser $request)
    {
        if ($request->validated()) {
            DB::transaction(function () use ($request) {

                $user = User::create([
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => $request->role
                ]);

                if ($request->role == 'owner') {
                    $owner = Owner::create([
                        'user_id' => $user->id,
                        'name' => $request->nama,
                        'slug' => Str::slug($request->name)
                    ]);

                    OwnerSubscription::create([
                        'subscription_id' => 1,
                        'owner_id' => $owner->id
                    ]);
                    
                } elseif ($request->role == 'renter') {
                    Renter::create([
                        'user_id' => $user->id,
                        'name' => $request->nama,
                        'slug' => Str::slug($request->name)
                    ]);
                }
            });

            return to_route('login.renter')->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Register Berhasil!'
            ]);
        }
    }
}
