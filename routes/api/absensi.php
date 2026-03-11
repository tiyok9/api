<?php

Route::controller(\App\Http\Controllers\AbsensiController::class)
    ->prefix('absensi')
    ->middleware(['auth:api',\App\Http\Middleware\RoleMiddleware::class. ":".  'admin'])
    ->name('absensi.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::get('/export/csv',  'export')->name('export');
    });

Route::controller(\App\Http\Controllers\AbsensiController::class)
    ->prefix('absensi')
    ->middleware(['auth:api',\App\Http\Middleware\RoleMiddleware::class. ":".  'admin,karyawan'])
    ->name('absensi.')
    ->group(function () {
        Route::get('/user',  'getDataUser')->name('getDataUser');
        Route::patch('/note/{id}',  'note')->name('note');
        Route::get('/rekap',  'getRekap')->name('getRekap');

    });

Route::controller(\App\Http\Controllers\AbsensiController::class)
    ->prefix('absensi')
    ->name('absensi.')
    ->group(function () {
        Route::post('/store',  'absen')->name('absen');
    });
