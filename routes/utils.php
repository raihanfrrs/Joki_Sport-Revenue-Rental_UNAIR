<?php

use App\Http\Controllers\YajraDatatablesController;
use Illuminate\Support\Facades\Route;

Route::controller(YajraDatatablesController::class)->group(function () {
    Route::get('dataMasterRenter', 'renter_index');
    Route::get('dataMasterGor', 'gor_index');
    Route::get('dataMasterField', 'field_index');
    Route::get('dataMasterFieldCategory', 'field_category_index');
});