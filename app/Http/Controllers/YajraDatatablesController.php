<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldCategory;
use App\Models\Gor;
use App\Models\Renter;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class YajraDatatablesController extends Controller
{
    public function renter_index()
    {
        return DataTables::of(Renter::select('renters.*')
                                    ->join('transactions', 'renters.id', '=', 'transactions.renter_id')
                                    ->join('gors', 'transactions.gor_id', '=', 'gors.id')
                                    ->join('owners', 'gors.owner_id', '=', 'owners.id')
                                    ->where('owners.id', auth()->user()->owner->id)
                                    ->groupBy('renters.id')
                                    ->get())
        ->addColumn('email', function ($model) {
            return view('components.datatables.master-renter.email-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.master-renter.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.master-renter.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.master-renter.action-column', compact('model'))->render();
        })
        ->rawColumns(['email', 'created_at', 'status', 'action'])
        ->make(true);
    }

    public function gor_index()
    {
        return DataTables::of(Gor::where('owner_id', auth()->user()->owner->id)
                                    ->get())
        ->addColumn('price', function ($model) {
            return view('components.datatables.master-gor.price-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.master-gor.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.master-gor.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.master-gor.action-column', compact('model'))->render();
        })
        ->rawColumns(['price', 'created_at', 'status', 'action'])
        ->make(true);
    }

    public function field_index()
    {
        return DataTables::of(Field::all())
        ->addColumn('gor', function ($model) {
            return view('components.datatables.master-field.gor-column', compact('model'))->render();
        })
        ->addColumn('field_category', function ($model) {
            return view('components.datatables.master-field.field-category-column', compact('model'))->render();
        })
        ->addColumn('description', function ($model) {
            return view('components.datatables.master-field.description-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.master-field.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.master-field.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.master-field.action-column', compact('model'))->render();
        })
        ->rawColumns(['gor', 'field_category', 'description', 'created_at', 'status', 'action'])
        ->make(true);
    }

    public function field_category_index()
    {
        return DataTables::of(FieldCategory::where('owner_id', auth()->user()->owner->id)
                                        ->get())
        ->addColumn('total_field', function ($model) {
            return view('components.datatables.master-category.total-field-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.master-category.action-column', compact('model'))->render();
        })
        ->rawColumns(['total_field', 'action'])
        ->make(true);
    }
}