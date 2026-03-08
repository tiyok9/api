<?php

Route::controller(\App\Http\Controllers\AbsensiController::class)
    ->prefix('absensi')
    ->name('absensi.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::post('/store',  'absen')->name('absen');
        Route::patch('/note/{id}',  'note')->name('note');
    });

