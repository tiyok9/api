<?php


Route::controller(\App\Http\Controllers\JabatanController::class)
    ->prefix('jabatan')
    ->name('jabatan.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::post('/store',  'store')->name('store');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
