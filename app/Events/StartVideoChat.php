<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StartVideoChat implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $data;
    public $recipientUserId;

    public function __construct($data, $recipientUserId)
    {
        $this->data = $data;
        $this->recipientUserId = $recipientUserId;

        // Logging data and recipientUserId for debugging
        Log::info('StartVideoChat Event Constructed', [
            'data' => $this->data,
            'recipientUserId' => $this->recipientUserId,
        ]);
    }

    public function broadcastOn()
    {
        $channelName = 'presence-video-channel.' . $this->recipientUserId;

        // Logging the channel name
        Log::info('Broadcasting on channel: ' . $channelName);

        return new PresenceChannel($channelName);
    }

    public function broadcastWith()
    {
        // Logging the data to be broadcasted
        Log::info('Broadcasting with data: ', $this->data);

        return $this->data;
    }
}
