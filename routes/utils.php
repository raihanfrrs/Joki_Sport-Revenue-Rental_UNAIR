<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\YajraDatatablesController;
use Illuminate\Support\Facades\Route;

Route::controller(YajraDatatablesController::class)->group(function () {
    Route::get('listRentersTable', 'renter_index');
    Route::get('listGorsTable', 'gor_index');
    Route::get('listFieldsTable', 'field_index');
    Route::get('listFieldCategoriesTable', 'field_category_index');
    Route::get('listHistoryOrderTable', 'history_order_index');
    Route::get('listHistoryOrderWaitingTable', 'history_order_waiting');
});

Route::controller(AjaxController::class)->group(function () {
    Route::get('ajax/all-field-schedule/{field}/read', 'all_field_schedule');
    Route::get('ajax/all-temp-date/{field}/read', 'all_temp_date');
    Route::get('ajax/all-temp-date/{field}/store', 'all_temp_date_store');
    Route::get('ajax/all-temp-date/{temp_date}/delete', 'all_temp_date_delete');
    Route::get('ajax/all-temp-date/{field}/delete-all', 'all_temp_date_delete_all');
    Route::get('ajax/due-date-payment/{field}/read', 'due_date_payment');
    Route::get('ajax/due-date-payment/{field}/destroy', 'due_date_payment_destroy');
});