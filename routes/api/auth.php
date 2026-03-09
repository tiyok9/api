<?php


Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('api.login');
Route::get('profile', [\App\Http\Controllers\AuthController::class, 'profile'])->name('api.profile');
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('api.logout');
});
