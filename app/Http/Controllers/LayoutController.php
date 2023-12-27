<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'owner') ) {
            return view('welcome-coordinator');
        } elseif (!auth()->check() || auth()->user()->role = 'renter') {
            return view('welcome-renter', [
                'fields' => Field::limit(3)->get()
            ]);
        }
        
    }
}
