<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRegisterUser;
use App\Http\Requests\StoreRegistrationUser;
use App\Models\Owner;
use App\Models\Renter;
use App\Models\User;

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
                    Owner::create([
                        'user_id' => $user->id,
                        'name' => $request->nama
                    ]);
                } elseif ($request->role == 'renter') {
                    Renter::create([
                        'user_id' => $user->id,
                        'name' => $request->nama
                    ]);
                }
            });

            return to_route('login.renter');
        }
    }
}
