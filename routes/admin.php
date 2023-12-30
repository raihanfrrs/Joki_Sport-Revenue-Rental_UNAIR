<?php

use App\Http\Controllers\AdminReportingController;
use App\Http\Controllers\MasterAdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:admin']], function () {

    Route::controller(MasterAdminController::class)->group(function () {
        Route::get('data-master/renter', 'renter_index')->name('data.master.renter');
        Route::patch('data-master/renter/{renter}/status', 'renter_update_status')->name('data.master.renter.update.status');
        Route::get('data-master/renter/{renter}', 'renter_show')->name('data.master.renter.show');
        Route::patch('data-master/renter/{renter}', 'renter_update')->name('data.master.renter.update');
        Route::patch('data-master/renter/{renter}/password', 'renter_update_password')->name('data.master.renter.update.password');
        Route::delete('data-master/renter/{renter}', 'renter_destroy')->name('data.master.renter.destroy');

        Route::get('data-master/owner', 'owner_index')->name('data.master.owner');
        Route::patch('data-master/owner/{owner}/status', 'owner_update_status')->name('data.master.owner.update.status');
        Route::get('data-master/owner/{owner}', 'owner_show')->name('data.master.owner.show');
        Route::patch('data-master/owner/{owner}', 'owner_update')->name('data.master.owner.update');
        Route::patch('data-master/owner/{owner}/password', 'owner_update_password')->name('data.master.owner.update.password');
        Route::delete('data-master/owner/{owner}', 'owner_destroy')->name('data.master.owner.destroy');

        Route::get('data-master/gor', 'gor_index')->name('data.master.gor');
        Route::patch('data-master/gor/{gor}/status', 'gor_update_status')->name('data.master.gor.update.status');
        Route::get('data-master/gor/{gor}/edit', 'gor_edit')->name('data.master.gor.edit');
        Route::get('data-master/gor/{gor}', 'gor_show')->name('data.master.gor.show');
        Route::patch('data-master/gor/{gor}', 'gor_update')->name('data.master.gor.update');
        Route::delete('data-master/gor/{gor}', 'gor_destroy')->name('data.master.gor.destroy');

        Route::get('data-master/field', 'field_index')->name('data.master.field');
        Route::patch('data-master/field/{field}/status', 'field_update_status')->name('data.master.field.update.status');
        Route::get('data-master/field/{field}/edit', 'field_edit')->name('data.master.field.edit');
        Route::get('data-master/field/{field}', 'field_show')->name('data.master.field.show');
        Route::patch('data-master/field/{field}', 'field_update')->name('data.master.field.update');
        Route::delete('data-master/field/{field}', 'field_destroy')->name('data.master.field.destroy');
    });

    Route::controller(AdminReportingController::class)->group(function () {
        Route::get('admin-reporting/subscription', 'subscription_index')->name('admin.reporting.subscription');
        Route::get('admin-reporting/subscription/{subscription_transaction}/invoice', 'subscription_invoice')->name('admin.reporting.subscription.invoice');
        Route::get('admin-reporting/subscription/{subscription_transaction}/invoice', 'subscription_invoice')->name('admin.reporting.subscription.invoice');
        Route::patch('admin-reporting/subscription/{subscription_transaction}/status', 'subscription_update_status')->name('admin.reporting.update.status');
    });
});