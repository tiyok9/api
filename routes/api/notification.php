<?php

use App\Http\Controllers\NotificationController;

Route::controller(NotificationController::class)
    ->middleware(['auth:api'])

    ->group(function () {
        Route::get('/notifications/unread',  'unread')
        ->name('notifications.unread');
        Route::post('/notifications/read/{id}', 'markAsRead')
            ->name('notifications.read');
        Route::post('/notifications/read-all',  'markAllRead')
            ->name('notifications.readAll');
});
