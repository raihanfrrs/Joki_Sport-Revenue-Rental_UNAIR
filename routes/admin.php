<?php

use App\Http\Controllers\MasterAdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cekUserLogin:admin']], function () {

    Route::controller(MasterAdminController::class)->group(function () {
        Route::get('data-master/renter', 'renter_index')->name('data.master.renter');

        Route::get('data-master/owner', 'owner_index')->name('data.master.owner');

        Route::get('data-master/gor', 'gor_index')->name('data.master.gor');

        Route::get('data-master/field', 'field_index')->name('data.master.field');
    });

});