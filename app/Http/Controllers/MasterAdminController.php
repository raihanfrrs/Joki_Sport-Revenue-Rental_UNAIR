<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterAdminController extends Controller
{
    public function renter_index()
    {
        return view('pages.admin.data-master.renter.index');
    }

    public function owner_index()
    {
        return view('pages.admin.data-master.owner.index');
    }

    public function gor_index()
    {
        return view('pages.admin.data-master.gor.index');
    }

    public function field_index()
    {
        return view('pages.admin.data-master.field.index');
    }
}
