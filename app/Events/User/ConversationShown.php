<?php

namespace App\Events\User;

use App\Models\Conversation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class ConversationShown implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $conversation;

    /**
     * @param Conversation $conversation
     * @return void
     */
    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('conversation.' . $this->conversation->user_receiver_id . '.' . $this->conversation->room_id);
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ['conversation' => $this->conversation];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'conversation.shown';
    }
}
