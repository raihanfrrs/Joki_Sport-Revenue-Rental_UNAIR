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
    Route::get('listReportingFieldOrder', 'reporting_field_order');
    Route::get('listHistorySubscriptionOrderTable', 'history_subscription_order');
    Route::get('listMasterRentersTable', 'master_renter_index');
    Route::get('listMasterOwnersTable', 'master_owner_index');
    Route::get('listMasterGorsTable', 'master_gor_index');
    Route::get('listMasterFieldsTable', 'master_field_index');
    Route::get('listReportingSubscriptionTable', 'reporting_subscription_index');
});

Route::controller(AjaxController::class)->group(function () {
    Route::get('ajax/all-field-schedule/{field}/read', 'all_field_schedule');
    Route::get('ajax/all-temp-date/{field}/read', 'all_temp_date');
    Route::get('ajax/all-temp-date/{field}/store', 'all_temp_date_store');
    Route::get('ajax/all-temp-date/{temp_date}/delete', 'all_temp_date_delete');
    Route::get('ajax/all-temp-date/{field}/delete-all', 'all_temp_date_delete_all');
    Route::get('ajax/due-date-payment/{field}/read', 'due_date_payment');
    Route::get('ajax/due-date-payment/{field}/destroy', 'due_date_payment_destroy');
    Route::get('ajax/data-renter-form/{renter}/read', 'data_renter_form');
    Route::get('ajax/data-owner-form/{owner}/read', 'data_owner_form');
    Route::get('ajax/owner-analytic-admin', 'data_owner_analytic_admin');
    Route::get('ajax/renter-analytic-admin', 'data_renter_analytic_admin');
    Route::get('ajax/field-order-analytic-admin', 'data_field_order_analytic_admin');
    Route::get('ajax/subscription-order-analytic-admin', 'data_subscription_order_analytic_admin');
    Route::get('ajax/renter-order-analytic-owner', 'data_renter_order_analytic_admin');
    Route::get('ajax/renter-field-order-analytic-owner', 'data_renter_field_order_analytic_admin');
    Route::get('ajax/total-gor-analytic-owner', 'data_total_gor_analytic_admin');
    Route::get('ajax/total-field-analytic-owner', 'data_total_field_analytic_admin');
});