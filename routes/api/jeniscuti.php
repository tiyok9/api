<?php
Route::controller(\App\Http\Controllers\JenisCutiController::class)
    ->prefix('jenis-cuti')
    ->name('jenis-cuti.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::post('/store',  'store')->name('store');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
