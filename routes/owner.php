<?php

use App\Http\Controllers\MasterOwnerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::group(['middleware' => ['cekUserLogin:owner']], function () {

        Route::controller(MasterOwnerController::class)->group(function () {
            Route::get('master/renter', 'renter_index')->name('master.renter');

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

            Route::get('master/category', 'category_index')->name('master.category');
            Route::post('master/category', 'category_store')->name('master.category.store');
        });
    });

});