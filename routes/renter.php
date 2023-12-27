<?php

use App\Http\Controllers\BookedController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::group(['middleware' => ['cekUserLogin:renter']], function () {

        Route::controller(BookedController::class)->group(function () {
            Route::get('booking/{field}/form', 'booking_field_index')->name('booking.field.form');
            Route::post('booking/{field}/form', 'booking_field_store')->name('booking.field.form.store');
            Route::get('history/order', 'history_order_index')->name('history.order');
            Route::get('history/{transaction}/order', 'history_order_show')->name('history.order.show');
            Route::get('history/order/waiting', 'history_order_waiting')->name('history.order.waiting');
        });

        Route::controller(PaymentController::class)->group(function () {
            Route::get('payment/{field}/waiting', 'payment_field_index')->name('payment.field.waiting');
            Route::post('payment/{field}/waiting', 'payment_field_store')->name('payment.field.waiting.store');
        });
    });

});