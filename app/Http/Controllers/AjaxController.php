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
use App\Models\OwnerSubscription;
use App\Models\Subscription;
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

    public function data_dashboard_subscription_user_admin()
    {   
        $subscriptionUser = OwnerSubscription::where('subscription_id', 2)->count();
        $nonSubscriptionUser = OwnerSubscription::where('subscription_id', 1)->count();

        $data = [$nonSubscriptionUser, $subscriptionUser];

        return $data;
    }

    public function data_dashboard_subscription_user_count_admin()
    {
        return OwnerSubscription::count();
    }

    public function data_subscription_user_count_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $subscriptions = OwnerSubscription::where('subscription_id', 2)
                        ->whereDate('updated_at', '>=', $startDate)
                        ->whereDate('updated_at', '<=', $endDate)
                        ->get();

        $totalSubscriptionsCount = OwnerSubscription::where('subscription_id', 2)->count();

        $percentage = ($totalSubscriptionsCount > 0) ? ($subscriptions->count() / $totalSubscriptionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $subscriptions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-subscription-user-count-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_dashboard_user_admin()
    {
        $renter = User::where('role', 'renter')->count();
        $owner = User::where('role', 'owner')->count();

        $data = [$renter, $owner];

        return $data;
    }

    public function data_dashboard_user_count_admin()
    {
        return User::where('role', '!=', 'admin')->count();
    }

    public function data_dashboard_user_count_analytic_admin()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $users = User::where('role', '!=', 'admin')
                    ->whereDate('updated_at', '>=', $startDate)
                    ->whereDate('updated_at', '<=', $endDate)
                    ->get();

        $totalUsersCount = User::where('role', '!=', 'admin')->count();

        $percentage = ($totalUsersCount > 0) ? ($users->count() / $totalUsersCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $users->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-user-count-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_dashboard_subscription_analytic_admin()
    {
        $length = 12;
        $value = 0;

        $monthlyDataSubscription = SubscriptionTransaction::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderByRaw('FIELD(month, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)')
            ->pluck('count', 'month')
            ->all();

        $processedData = array_fill(1, $length, $value);

        foreach ($monthlyDataSubscription as $month => $count) {
            $processedData[$month] = $count;
        }

        return array_values($processedData);
    }


    public function data_dashboard_transaction_analytic_owner()
    {
        $length = 4;
        $value = 0;

        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::select(
            DB::raw('WEEK(created_at, 1) as week'),
            DB::raw('COUNT(*) as count')
        )
        ->whereMonth('created_at', now()->month)
        ->whereIn('gor_id', $gor)
        ->groupBy('week')
        ->pluck('count', 'week')
        ->all();

        $processedData = array_fill(1, $length, $value);

        foreach ($transactions as $month => $count) {
            $processedData[$month] = $count;
        }

        return array_values($processedData);
    }

    public function data_dashboard_total_renter_analytic_owner()
    {
        $length = 4;
        $value = 0;

        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::select(
            DB::raw('WEEK(created_at, 1) as week'),
            DB::raw('COUNT(*) as count')
        )
        ->whereMonth('created_at', now()->month)
        ->whereIn('gor_id', $gor)
        ->groupBy('week')
        ->pluck('count', 'week')
        ->all();

        $processedData = array_fill(1, $length, $value);

        foreach ($transactions as $month => $count) {
            $processedData[$month] = $count;
        }

        return array_values($processedData);
    }

    public function data_dashboard_total_transaction_field_analytic_owner()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::whereIn('gor_id', $gor)
                    ->whereDate('updated_at', '>=', $startDate)
                    ->whereDate('updated_at', '<=', $endDate)
                    ->get();

        $totalTransactionsCount = Transaction::whereIn('gor_id', $gor)->count();

        $percentage = ($totalTransactionsCount > 0) ? ($transactions->count() / $totalTransactionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $transactions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-total-transaction-field-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_dashboard_total_transaction_renter_analytic_owner()
    {
        $startDate = Carbon::now()->subDays(30)->toDateString();
        $endDate = Carbon::now()->toDateString();

        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::whereIn('gor_id', $gor)
                    ->whereDate('updated_at', '>=', $startDate)
                    ->whereDate('updated_at', '<=', $endDate)
                    ->get();

        $totalTransactionsCount = Transaction::whereIn('gor_id', $gor)->count();

        $percentage = ($totalTransactionsCount > 0) ? ($transactions->count() / $totalTransactionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $transactions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-total-transaction-renter-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_dashboard_total_transaction_subscription_analytic_admin()
    {
        $startDate = Carbon::now()->toDateString();
        $endDate = Carbon::now()->addYear()->toDateString();

        $owner_subscriptions = OwnerSubscription::whereDate('updated_at', '>=', $startDate)
                                                ->whereDate('updated_at', '<=', $endDate)
                                                ->get();

        $totalOwnerSubscriptionsCount = OwnerSubscription::count();

        $percentage = ($totalOwnerSubscriptionsCount > 0) ? ($owner_subscriptions->count() / $totalOwnerSubscriptionsCount) * 100 : 0;

        $percentage = round($percentage);

        return [
            $owner_subscriptions->count(),
            $percentage > 0 ? "+".$percentage."%" : '-'.$percentage."%",
            'data' => [
                '#percent-total-transaction-subscription-analytic',
                $percentage > 0 ? 'text-success' : 'text-danger'
            ]
        ];
    }

    public function data_dashboard_total_income_analytic_owner()
    {
        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::select('transactions.id')->join('gors', 'transactions.gor_id', '=', 'gors.id')->whereIn('gor_id', $gor)->get();

        $detail_transactions = DetailTransaction::whereIn('transaction_id', $transactions)->sum('subtotal');

        return 'Rp' . number_format($detail_transactions, 0, ',', '.');
    }

    public function data_dashboard_total_gor_income_analytic_owner()
    {
        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::join('gors', 'transactions.gor_id', '=', 'gors.id')->whereIn('gor_id', $gor)->sum('price');

        return 'Rp' . number_format($transactions, 0, ',', '.');
    }

    public function data_gor_income()
    {
        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        return view('components.data-ajax.data-gor-income', [
            'gors' => Transaction::select('gors.name', DB::raw('SUM(gors.price) as price'))
                                ->join('gors', 'transactions.gor_id', '=', 'gors.id')
                                ->whereIn('gor_id', $gor)
                                ->groupBy('gors.id')
                                ->limit(10)
                                ->get()
        ]);
    }

    public function data_dashboard_total_field_income_analytic_owner()
    {
        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        $transactions = Transaction::join('gors', 'transactions.gor_id', '=', 'gors.id')
                                    ->join('fields', 'gors.id', '=', 'fields.gor_id')
                                    ->whereIn('transactions.gor_id', $gor)
                                    ->sum('price');

        return 'Rp' . number_format($transactions, 0, ',', '.');
    }

    public function data_field_income()
    {
        $gor = Gor::select('id')->where('owner_id', auth()->user()->owner->id)->get();

        return view('components.data-ajax.data-field-income', [
            'fields' => Transaction::select('fields.name', DB::raw('SUM(gors.price) as price'))
                                ->join('gors', 'transactions.gor_id', '=', 'gors.id')
                                ->join('fields', 'gors.id', '=', 'fields.gor_id')
                                ->whereIn('transactions.gor_id', $gor)
                                ->groupBy('fields.id')
                                ->limit(10)
                                ->get()
        ]);
    }
}