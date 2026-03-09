<?php


use App\Http\Controllers\KaryawanController;

Route::controller(KaryawanController::class)
    ->prefix('karyawan')
    ->middleware(['auth:api'])

    ->name('karyawan.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::get('/{id}',  'getKaryawanById')->name('getKaryawanById');
        Route::post('/store',  'store')->name('store');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
