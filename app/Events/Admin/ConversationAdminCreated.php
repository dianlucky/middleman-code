<?php

namespace App\Events\Admin;

use App\Models\Conversation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class ConversationAdminCreated implements ShouldBroadcastNow
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
        return new Channel('conversation-admin');
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
        return 'conversation-admin.created';
    }
}