<?php

use App\Http\Controllers\MasterAdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:admin']], function () {

    Route::controller(MasterAdminController::class)->group(function () {
        Route::get('data-master/renter', 'renter_index')->name('data.master.renter');
        Route::patch('data-master/renter/{renter}/status', 'renter_update_status')->name('data.master.renter.update.status');
        Route::delete('data-master/renter/{renter}', 'renter_destroy')->name('data.master.renter.destroy');

        Route::get('data-master/owner', 'owner_index')->name('data.master.owner');
        Route::patch('data-master/owner/{owner}/status', 'owner_update_status')->name('data.master.owner.update.status');
        Route::delete('data-master/owner/{owner}', 'owner_destroy')->name('data.master.owner.destroy');

        Route::get('data-master/gor', 'gor_index')->name('data.master.gor');
        Route::patch('data-master/gor/{gor}/status', 'gor_update_status')->name('data.master.gor.update.status');
        Route::delete('data-master/gor/{gor}', 'gor_destroy')->name('data.master.gor.destroy');

        Route::get('data-master/field', 'field_index')->name('data.master.field');
        Route::patch('data-master/field/{field}/status', 'field_update_status')->name('data.master.field.update.status');
        Route::delete('data-master/field/{field}', 'field_destroy')->name('data.master.field.destroy');
    });

});