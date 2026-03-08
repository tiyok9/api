<?php


use App\Http\Controllers\KaryawanController;

Route::controller(KaryawanController::class)
    ->prefix('karyawan')
    ->name('karyawan.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::post('/store',  'store')->name('store');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
