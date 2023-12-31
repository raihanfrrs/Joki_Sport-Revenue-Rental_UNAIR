<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Field;
use App\Models\Owner;
use App\Models\Renter;
use App\Models\TempDate;
use App\Models\DetailField;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Models\Gor;
use App\Models\SubscriptionTransaction;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class AjaxController extends Controller
{
    public function all_field_schedule(Field $field, Request $request)
    {
        $date = $request->search != 'default' ? $request->search : now()->format('Y-m-d');
        $dayName = Carbon::parse($date)->locale('id')->isoFormat('dddd');
        $booked = DetailTransaction::where('field_id', $field->id)->where('date', $date)->get(['detail_field_id']);

        return view('components.data-ajax.data-field-schedule', [
            'schedules' => DetailField::where('field_id', $field->id)->get(),
            'booked' => $booked,
            'date' => $date,
            'dayName' => $dayName,
        ]);
    }

    public function all_temp_date(Field $field)
    {
        return view('components.data-ajax.data-temp-date', compact('field'));
    }

    public function all_temp_date_store(Field $field, Request $request)
    {
        DB::transaction(function () use ($request, $field) {
            if (TempDate::where('renter_id', auth()->user()->renter->id)
                        ->where('field_id', $field->id)
                        ->where('detail_field_id', $request->data['schedule_id'])
                        ->where('day_name', $request->data['schedule_name'])
                        ->where('date', $request->data['schedule_date'])
                        ->count() == 0) 
            {
                TempDate::create([
                    'renter_id' => auth()->user()->renter->id,
                    'field_id' => $field->id,
                    'detail_field_id' => $request->data['schedule_id'],
                    'day_name' => $request->data['schedule_name'],
                    'date' => $request->data['schedule_date']
                ]);

                return true;
            } else {
                return false;
            }
        });
    }

    public function all_temp_date_delete(TempDate $temp_date)
    {
        $temp_date->delete();

        return true;
    }

    public function all_temp_date_delete_all(Field $field)
    {
        return TempDate::where('renter_id', auth()->user()->renter->id)->where('field_id', $field->id)->delete();
    }

    public function due_date_payment(Field $field)
    {
        $dueDate = $field->temp_cart->first()->due;
        $now = Carbon::now();

        $sisaMenit = $now->gt($dueDate) ? 0 : max(0, $dueDate->diffInMinutes($now));

        return "*Sisa ".$sisaMenit." Menit Lagi.";
    }

    public function due_date_payment_destroy(Field $field)
    {
        $status = false;
        foreach ($field->temp_cart as $key => $temp_cart) {
            $dueDate = Carbon::parse($temp_cart->due);
            $now = Carbon::now();
    
            $sisaMenit = $now->gt($dueDate) ? 0 : max(0, $dueDate->diffInMinutes($now));
    
            if ($sisaMenit <= 0) {
                $temp_cart->delete();
                $status = true;
            }
        }

        return $status;
    }

    public function data_renter_form(Renter $renter)
    {
        return view('components.data-ajax.data-form-renter-edit', compact('renter'));
    }

    public function data_owner_form(Owner $owner)
    {
        return view('components.data-ajax.data-form-owner-edit', compact('owner'));
    }

    public function data_owner_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $owners = User::where('role', '=', 'owner')
                    ->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)
                    ->get();

        $totalOwnersCount = User::where('role', '=', 'owner')->count();

        $percentage = ($totalOwnersCount > 0) ? ($owners->count() / $totalOwnersCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $owners->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-owner-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_renter_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $renters = User::where('role', '=', 'renter')
                    ->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)
                    ->get();

        $totalRentersCount = User::where('role', '=', 'renter')->count();

        $percentage = ($totalRentersCount > 0) ? ($renters->count() / $totalRentersCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $renters->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-renter-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_field_order_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $transactions = Transaction::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->get();

        $totalTransactionsCount = Transaction::count();

        $percentage = ($totalTransactionsCount > 0) ? ($transactions->count() / $totalTransactionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $transactions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-field-order-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_subscription_order_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $subscriptions = SubscriptionTransaction::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->get();

        $totalSubscriptionsCount = Transaction::count();

        $percentage = ($totalSubscriptionsCount > 0) ? ($subscriptions->count() / $totalSubscriptionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $subscriptions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-subscription-order-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_renter_order_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $gors = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::select('renter_id')
                                    ->whereIn('gor_id', $gors)
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->groupBy('renter_id')
                                    ->get();   

        $totalTransactionsCount = Transaction::whereIn('gor_id', $gors)->count();

        $percentage = ($totalTransactionsCount > 0) ? ($transactions->count() / $totalTransactionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $transactions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-renter-order-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_renter_field_order_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $gors = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::whereIn('gor_id', $gors)
                                    ->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get();   

        $totalTransactionsCount = Transaction::whereIn('gor_id', $gors)->count();

        $percentage = ($totalTransactionsCount > 0) ? ($transactions->count() / $totalTransactionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $transactions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-renter-field-order-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_total_field_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $gors = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $fields = Field::whereIn('gor_id', $gors)
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();

        $totalFieldsCount = Field::whereIn('gor_id', $gors)->count();

        $percentage = ($totalFieldsCount > 0) ? ($fields->count() / $totalFieldsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $fields->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-total-field-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_total_gor_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $gors = Gor::where('owner_id', auth()->user()->owner->id)
                        ->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate)
                        ->get();

        $totalGorsCount = Gor::where('owner_id', auth()->user()->owner->id)->count();

        $percentage = ($totalGorsCount > 0) ? ($gors->count() / $totalGorsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $gors->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-total-gor-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }
}
