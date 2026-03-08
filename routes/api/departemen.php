<?php

Route::controller(\App\Http\Controllers\DepartemenController::class)
    ->prefix('departemen')
    ->name('departemen.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::post('/store',  'store')->name('store');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
