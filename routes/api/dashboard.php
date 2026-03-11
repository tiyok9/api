<?php

Route::controller(\App\Http\Controllers\DashboardController::class)
    ->prefix('dash')
    ->name('dash.')
    ->middleware(['auth:api',\App\Http\Middleware\RoleMiddleware::class. ":".  'admin'])
    ->group(function () {
        Route::get('rekap',  'rekap')->name('rekap');
        Route::get('graph',  'graph')->name('graph');
        });
Route::controller(\App\Http\Controllers\DashboardController::class)
    ->prefix('dash')
    ->middleware(['auth:api',\App\Http\Middleware\RoleMiddleware::class. ":".  'karyawan'])
    ->name('dash.')
    ->group(function () {
        Route::get('graph-client',  'graphClient')->name('graphClient');
        });

