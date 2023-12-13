<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registration_index()
    {
        return view('pages.auth.renter.register');
    }
}
