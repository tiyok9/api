<?php

Route::controller(\App\Http\Controllers\CutiController::class)
    ->prefix('cuti')
    ->middleware(['auth:api'])
    ->middleware(['auth:api',\App\Http\Middleware\RoleMiddleware::class. ":".  'admin'])
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::patch('/update-status/{id}',  'updateStatus')->name('update.status');
        Route::get('/export/csv',  'export')->name('export');
    });

Route::controller(\App\Http\Controllers\CutiController::class)
    ->prefix('cuti')
    ->middleware(['auth:api', \App\Http\Middleware\RoleMiddleware::class . ':admin,karyawan'])    ->name('cuti.')
    ->group(function () {
        Route::post('/store',  'store')->name('store');
    });

