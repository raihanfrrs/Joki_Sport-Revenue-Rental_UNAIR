<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

Route::controller(LayoutController::class)->group(function () {
    Route::get('/', 'index')->name('/');
});

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login','login_renter')->name('login.renter');
        Route::post('/login','login_renter_process')->name('login.renter.process');
        Route::get('/admin-004-login', 'login_coordinator')->name('login.coordinator');
        Route::post('/admin-004','login_coordinator_process')->name('login.coordinator.process');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/registration','registration_index')->name('registration');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(LogoutController::class)->group(function () {
        Route::get('logout', 'index')->name('logout');
    });
});