<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conversation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'room_id',
        'user_sender_id',
        'user_receiver_id',
        'message',
    ];

    /**
     * @var array
     */
    protected $appends = ['sender_role', 'receiver_role'];

    /**
     * @var array
     */
    protected $with = ['room', 'sender', 'receiver'];

    /**
     * @return string|null
     */
    public function getSenderRoleAttribute(): ?string
    {
        $room = $this->room;

        if ($this->user_sender_id == $room->user_id1) {
            return $room->role_user1;
        } elseif ($this->user_sender_id == $room->user_id2) {
            return $room->role_user2;
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getReceiverRoleAttribute(): ?string
    {
        $room = $this->room;

        if ($this->user_receiver_id == $room->user_id1) {
            return $room->role_user1;
        } elseif ($this->user_receiver_id == $room->user_id2) {
            return $room->role_user2;
        }

        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_receiver_id');
    }
}
