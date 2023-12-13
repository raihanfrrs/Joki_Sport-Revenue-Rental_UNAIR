<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        if (auth()->check() && (auth()->user()->level == 'admin' || auth()->user()->level == 'owner') ) {
            return view('welcome-coordinator');
        } elseif (!auth()->check() || auth()->user()->level = 'renter') {
            return view('welcome-renter');
        }
        
    }
}
