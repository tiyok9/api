<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Broadcasting\PrivateChannel;

class NotificationUser extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;
    public $user;

    public function __construct($message,$user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    public function via()
    {
        return ['database','broadcast'];
    }

    public function toArray()
    {
        return [
            'message' => $this->message
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message
        ]);
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('notifications.' . $this->user);
    }
}
