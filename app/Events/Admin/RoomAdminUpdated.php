<?php

namespace App\Events\Admin;

use App\Models\Room;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class RoomAdminUpdated implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $room;

    /**
     * @param Room $room
     * @return void
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('room-admin');
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ['room' => $this->room];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'room-admin.updated';
    }
}
