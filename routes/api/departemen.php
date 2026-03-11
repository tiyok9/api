<?php

Route::controller(\App\Http\Controllers\DepartemenController::class)
    ->prefix('departemen')
    ->middleware(['auth:api'])
    ->name('departemen.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::get('/{id}',  'getDepartementById')->name('getDepartementById');

        Route::post('/store',  'store')->name('store');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
