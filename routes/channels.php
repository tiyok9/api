<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::routes([
    'middleware' => ['auth:api'],
]);
Broadcast::channel('notifications.{id}', function ($user, $id) {
    return $user->id === $id;

});
