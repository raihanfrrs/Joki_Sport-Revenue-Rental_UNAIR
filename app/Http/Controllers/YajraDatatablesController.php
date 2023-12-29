<?php

namespace App\Http\Controllers;

use App\Models\Gor;
use App\Models\Field;
use App\Models\Renter;
use App\Models\TempCart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\FieldCategory;
use App\Models\Owner;
use App\Models\SubscriptionTransaction;
use Illuminate\Support\Facades\DB;
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

    public function history_order_index()
    {
        return DataTables::of(Transaction::where('renter_id', auth()->user()->renter->id)
                                        ->get())
        ->addColumn('gor', function ($model) {
            return view('components.datatables.history-order.gor-column', compact('model'))->render();
        })
        ->addColumn('field', function ($model) {
            return view('components.datatables.history-order.field-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.history-order.created-at-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.datatables.history-order.grand-total-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.history-order.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.history-order.action-column', compact('model'))->render();
        })
        ->rawColumns(['gor', 'field', 'created_at', 'grand_total', 'status', 'action'])
        ->make(true);
    }

    public function history_order_waiting()
    {
        return DataTables::of(TempCart::select(DB::raw('max(gor_id) as gor_id'), 'field_id', DB::raw('MAX(created_at) as created_at'), DB::raw('MAX(subtotal) as subtotal'))
                                                            ->where('renter_id', auth()->user()->renter->id)
                                                            ->groupBy('field_id')
                                                            ->get())
        ->addColumn('gor', function ($model) {
            return view('components.datatables.payment-waiting.gor-column', compact('model'))->render();
        })
        ->addColumn('field', function ($model) {
            return view('components.datatables.payment-waiting.field-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.payment-waiting.created-at-column', compact('model'))->render();
        })
        ->addColumn('grand_total', function ($model) {
            return view('components.datatables.payment-waiting.grand-total-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.payment-waiting.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.payment-waiting.action-column', compact('model'))->render();
        })
        ->rawColumns(['gor', 'field', 'created_at', 'grand_total', 'status', 'action'])
        ->make(true);
    }

    public function reporting_field_order()
    {
        return DataTables::of(Transaction::orderBy('created_at', 'DESC')->get())
        ->addColumn('gor', function ($model) {
            return view('components.datatables.reporting-field.gor-column', compact('model'))->render();
        })
        ->addColumn('field', function ($model) {
            return view('components.datatables.reporting-field.field-column', compact('model'))->render();
        })
        ->addColumn('renter', function ($model) {
            return view('components.datatables.reporting-field.renter-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.reporting-field.created-at-column', compact('model'))->render();
        })
        ->addColumn('total', function ($model) {
            return view('components.datatables.reporting-field.grand-total-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.reporting-field.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.reporting-field.action-column', compact('model'))->render();
        })
        ->rawColumns(['gor', 'field', 'renter', 'created_at', 'total', 'status', 'action'])
        ->make(true);
    }

    public function history_subscription_order()
    {
        return DataTables::of(SubscriptionTransaction::where('owner_id', auth()->user()->owner->id)
                                        ->get())
        ->addColumn('name', function ($model) {
            return view('components.datatables.history-subscription-order.name-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.history-subscription-order.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.history-subscription-order.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.history-subscription-order.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'created_at', 'status', 'action'])
        ->make(true);
    }

    public function master_renter_index()
    {
        return DataTables::of(Renter::all())
        ->addColumn('name', function ($model) {
            return view('components.datatables.admin-master-renter.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.datatables.admin-master-renter.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.datatables.admin-master-renter.phone-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.admin-master-renter.created-at-column', compact('model'))->render();
        })
        ->addColumn('total_order', function ($model) {
            return view('components.datatables.admin-master-renter.total-order-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.admin-master-renter.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.admin-master-renter.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'username', 'email', 'phone', 'created_at', 'total_order', 'status', 'action'])
        ->make(true);
    }

    public function master_owner_index()
    {
        return DataTables::of(Owner::all())
        ->addColumn('name', function ($model) {
            return view('components.datatables.admin-master-owner.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.datatables.admin-master-owner.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.datatables.admin-master-owner.phone-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.admin-master-owner.created-at-column', compact('model'))->render();
        })
        ->addColumn('total_gor', function ($model) {
            return view('components.datatables.admin-master-owner.total-gor-column', compact('model'))->render();
        })
        ->addColumn('subscription', function ($model) {
            return view('components.datatables.admin-master-owner.subscription-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.admin-master-owner.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.admin-master-owner.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'username', 'email', 'phone', 'created_at', 'total_gor', 'subscription', 'status', 'action'])
        ->make(true);
    }

    public function master_gor_index()
    {
        return DataTables::of(Gor::all())
        ->addColumn('name', function ($model) {
            return view('components.datatables.admin-master-gor.name-column', compact('model'))->render();
        })
        ->addColumn('owner', function ($model) {
            return view('components.datatables.admin-master-gor.owner-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.datatables.admin-master-gor.price-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.datatables.admin-master-gor.address-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.admin-master-gor.created-at-column', compact('model'))->render();
        })
        ->addColumn('total_field', function ($model) {
            return view('components.datatables.admin-master-gor.total-field-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.admin-master-gor.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.admin-master-gor.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'owner', 'price', 'address', 'created_at', 'total_field', 'status', 'action'])
        ->make(true);
    }

    public function master_field_index()
    {
        return DataTables::of(Field::all())
        ->addColumn('name', function ($model) {
            return view('components.datatables.admin-master-field.name-column', compact('model'))->render();
        })
        ->addColumn('gor', function ($model) {
            return view('components.datatables.admin-master-field.gor-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.datatables.admin-master-field.category-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.datatables.admin-master-field.price-column', compact('model'))->render();
        })
        ->addColumn('description', function ($model) {
            return view('components.datatables.admin-master-field.description-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.datatables.admin-master-field.created-at-column', compact('model'))->render();
        })
        ->addColumn('total_order', function ($model) {
            return view('components.datatables.admin-master-field.total-order-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.datatables.admin-master-field.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.datatables.admin-master-field.action-column', compact('model'))->render();
        })
        ->rawColumns(['name', 'gor', 'category', 'price', 'description', 'created_at', 'status', 'action'])
        ->make(true);
    }
}