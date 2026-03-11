<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Broadcasting\PrivateChannel;

class NotificationUser extends Notification
{
    use Queueable;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via()
    {
        return ['database', 'broadcast'];
    }

    public function toArray()
    {
        return [
            'message' => $this->message
        ];
    }

    public function toBroadcast()
    {
        return new BroadcastMessage([
            'message' => $this->message
        ]);
    }


    public function broadcastType()
    {
        return 'user.notification';
    }
}
