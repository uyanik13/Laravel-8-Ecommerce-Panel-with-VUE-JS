<?php

namespace App\Events;


use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class NewMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $otherUserId;

  /**
   * Create a new event instance.
   *
   * @param Message $message
   */
    public function __construct(Message $message)
    {
        
        $this->message = $message;
       
        //$this->message = json_encode($message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        
        return new PrivateChannel ('messages.' . $this->message->to);
    }

    public function broadcastAs()
    {
      return 'new.message';
    }

    public function broadcastWith()
    {
        $this->message->load('fromContact');

        return ["message" => $this->message];
    }
}
