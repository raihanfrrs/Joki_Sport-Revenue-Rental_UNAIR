<?php

use App\Http\Controllers\MasterOwnerController;
use App\Http\Controllers\OwnerHistoryController;
use App\Http\Controllers\OwnerReportingController;
use App\Http\Controllers\OwnerSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::group(['middleware' => ['cekUserLogin:owner']], function () {

        Route::controller(MasterOwnerController::class)->group(function () {
            Route::get('master/renter', 'renter_index')->name('master.renter');
            Route::get('master/renter/{renter}/edit', 'renter_edit')->name('master.renter.edit');
            Route::patch('master/renter/{renter}/status', 'renter_update_status')->name('master.renter.update.status');

            Route::get('master/gor', 'gor_index')->name('master.gor');
            Route::get('master/gor/create', 'gor_create')->name('master.gor.create');
            Route::post('master/gor', 'gor_store')->name('master.gor.store');
            Route::get('master/gor/{gor}/edit', 'gor_edit')->name('master.gor.edit');
            Route::patch('master/gor/{gor}', 'gor_update')->name('master.gor.update');
            Route::patch('master/gor/{gor}/status', 'gor_update_status')->name('master.gor.update.status');
            Route::delete('master/gor/{gor}', 'gor_destroy')->name('master.gor.destroy');
            Route::get('master/gor/{gor}', 'gor_show')->name('master.gor.show');

            Route::get('master/field', 'field_index')->name('master.field');
            Route::get('master/field/create', 'field_create')->name('master.field.create');
            Route::post('master/field', 'field_store')->name('master.field.store');
            Route::get('master/field/{field}/edit', 'field_edit')->name('master.field.edit');
            Route::patch('master/field/{field}', 'field_update')->name('master.field.update');
            Route::patch('master/field/{field}/status', 'field_update_status')->name('master.field.update.status');
            Route::delete('master/field/{field}', 'field_destroy')->name('master.field.destroy');
            Route::get('master/field/{field}', 'field_show')->name('master.field.show');

            Route::get('master/category', 'category_index')->name('master.category');
            Route::post('master/category', 'category_store')->name('master.category.store');
            Route::get('master/category/{category}/edit', 'category_edit')->name('master.category.edit');
            Route::patch('master/category/{category}', 'category_update')->name('master.category.update');
            Route::get('master/category/{category}', 'category_show')->name('master.category.show');
            Route::delete('master/category/{category}', 'category_destroy')->name('master.category.destroy');
        });

        Route::controller(OwnerReportingController::class)->group(function () {
            Route::get('reporting/sales', 'reporting_sales_index')->name('reporting.sales');
            Route::get('reporting/sales/{transaction}/invoice', 'reporting_sales_invoice')->name('reporting.sales.invoice');
            Route::patch('reporting/sales/{transaction}/invoice', 'reporting_sales_invoice_update_status')->name('reporting.sales.invoice.update.status');
            Route::get('reporting/sales/{transaction}/print', 'reporting_sales_invoice_print')->name('reporting.sales.invoice.print');
        });

        Route::controller(OwnerSubscriptionController::class)->group(function () {
            Route::get('subscription/pricing', 'subscription_pricing_index')->name('subscription.pricing');
            Route::get('subscription/{subscription}/payment', 'subscription_payment')->name('subscription.payment');
            Route::post('subscription/{subscription}/payment', 'subscription_payment_store')->name('subscription.payment.store');
            Route::get('subscription/{subscription_transaction}/invoice', 'subscription_payment_invoice')->name('subscription.payment.invoice');
        });

        Route::controller(OwnerHistoryController::class)->group(function () {
            Route::get('history/subscription', 'history_subscription_index')->name('history.subscription');
            Route::get('history/subscription/{subscription_transaction}/invoice', 'history_subscription_invoice')->name('history.subscription.invoice');
        });
    });

});