<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\YajraDatatablesController;
use Illuminate\Support\Facades\Route;

Route::controller(YajraDatatablesController::class)->group(function () {
    Route::get('listRentersTable', 'renter_index');
    Route::get('listGorsTable', 'gor_index');
    Route::get('listFieldsTable', 'field_index');
    Route::get('listFieldCategoriesTable', 'field_category_index');
});

Route::controller(AjaxController::class)->group(function () {
    Route::get('ajax/all-field-schedule/{field}/read', 'all_field_schedule');
});