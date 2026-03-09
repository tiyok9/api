<?php

Route::controller(\App\Http\Controllers\UserController::class)
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/',  'getData')->name('index');
        Route::get('/{id}',  'getUserById')->name('getUserById');
        Route::post('/store',  'store')->name('store');
        Route::patch('/update/{id}',  'update')->name('update');
        Route::delete('/delete/{id}',  'destroy')->name('destroy');
    });
