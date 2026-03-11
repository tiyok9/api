<?php


use App\Http\Controllers\KaryawanController;

Route::controller(KaryawanController::class)
    ->prefix('karyawan')
    ->middleware(['auth:api', \App\Http\Middleware\RoleMiddleware::class . ':admin'])

    ->name('karyawan.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::get('/{id}',  'getKaryawanById')->name('getKaryawanById');
        Route::post('/store',  'store')->name('store');
        Route::get('/export/csv',  'export')->name('export');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::patch('/update/status/{id}',  'updateStatus')->name('updateStatus');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
