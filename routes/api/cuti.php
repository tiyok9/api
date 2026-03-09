<?php

Route::controller(\App\Http\Controllers\CutiController::class)
    ->prefix('cuti')
    ->middleware(['auth:api'])

    ->name('cuti.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::post('/store',  'store')->name('store');
        Route::patch('/update-status/{id}',  'updateStatus')->name('update.status');
    });

