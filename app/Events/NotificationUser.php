<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($message)
    {
        try {

            if (!$message) {
                Log::warning('NotificationUser: message kosong');
            }

            $this->message = $message;

            Log::info('NotificationUser event created', [
                'message' => $message
            ]);

        } catch (\Throwable $e) {

            Log::error('Error creating NotificationUser event', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

        }
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        try {

            Log::info('Broadcasting NotificationUser to channel notifications');

            return [
                new Channel('notifications')
            ];

        } catch (\Throwable $e) {

            Log::error('Error broadcasting NotificationUser', [
                'error' => $e->getMessage()
            ]);

            return [];
        }
    }

    public function broadcastAs(): string
    {
        return 'notification';
    }
}
