<?php

Route::controller(\App\Http\Controllers\DashboardController::class)
    ->prefix('dash')
    ->name('dash.')
    ->group(function () {
        Route::get('rekap',  'rekap')->name('rekap');
        Route::get('graph',  'graph')->name('graph');
        Route::get('graph-client',  'graphClient')->name('graphClient');
        });

