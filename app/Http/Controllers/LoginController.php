<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoginRenter;

class LoginController extends Controller
{
    public function login_renter()
    {
        return view('pages.auth.renter.login');
    }

    public function login_renter_process(StoreLoginRenter $request)
    {
        $kredensial = $request->only('email', 'password');

        $checkUser = User::where('email', $request->email)
                            ->whereIn('role', ['owner', 'renter'])
                            ->first();

        if (empty($checkUser)) {
            return back()->withErrors([
                'email' => 'Email atau password salah!'
            ])->onlyInput('email');
        }

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();

            Auth::user();

            activity()->causedBy(Auth::user())->log("Berhasil login");

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!'
        ])->onlyInput('email');
    }

    public function login_coordinator()
    {
        return view('pages.auth.coordinator.login');
    }

    public function login_coordinator_process(StoreLoginAdmin $request)
    {
        $kredensial = $request->only('email', 'password');

        $checkUser = User::where('email', $request->email)
                            ->where('role', 'admin')
                            ->first();

        if (empty($checkUser)) {
            return back()->withErrors([
                'email' => 'Email atau password salah!'
            ])->onlyInput('email');
        }

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();

            Auth::user();

            activity()->causedBy(Auth::user())->log("Berhasil login");

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!'
        ])->onlyInput('email');
    }
}
