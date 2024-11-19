<?php

namespace App\Repositories;

use App\Models\Conversation;
use App\Models\Room;
use App\Models\User;

/**
 * @method Conversation[]|null all()
 * @method Conversation|null get(int|string $id)
 * @method Conversation|null create(array $data)
 * @method Conversation|null update(int|string $id, array $data)
 * @method Conversation|null delete(int|string $id)
 */
class ConversationAdminRepository extends Repository
{
    /**
     * @return Conversation[]|null
     */
    public function all()
    {
        return parent::accessAll(fn() => Conversation::all());
    }

    /**
     * @param int|string $id
     * @return Conversation|null
     */
    public function get(int|string $id): ?Conversation
    {
        return parent::accessGet(fn() => Conversation::findOrFail($id));
    }

    /**
     * @param array $data
     * @return Conversation|null
     */
    public function create(array $data): ?Conversation
    {
        $room = $this->getRoomById($data['room_id']);
        $sender = $this->getUserById($data['user_sender_id']);
        $receiver = $this->getUserById($data['user_receiver_id']);

        return parent::mutateCreate(function() use ($data, $room, $sender, $receiver) {
            $conversation = new Conversation();
            $conversation->room_id = $room->id;
            $conversation->user_sender_id = $sender->id;
            $conversation->user_receiver_id = $receiver->id;
            $conversation->message = $data['message'];
            $conversation->save();

            return $conversation;
        });
    }

    /**
     * @param int|string $id
     * @param array $data
     * @return Conversation|null
     */
    public function update(int|string $id, array $data): ?Conversation
    {
        $conversation = Conversation::findOrFail($id);

        return parent::mutateUpdate(function() use ($data, $conversation) {
            if (isset($data['message'])) {
                $conversation->message = $data['message'];
            }
            $conversation->save();

            return $conversation;
        });
    }

    /**
     * @param int|string $id
     * @return Conversation|null
     */
    public function delete(int|string $id): ?Conversation
    {
        $conversation = Conversation::findOrFail($id);

        return parent::mutateDelete(function() use ($conversation) {
            $conversation->delete();

            return $conversation;
        });
    }

    /**
     * @param int|string $roomId
     * @return Room
     */
    private function getRoomById(int|string $roomId): Room
    {
        return Room::findOrFail($roomId);
    }

    /**
     * @param int|string $userId
     * @return User
     */
    private function getUserById(int|string $userId): User
    {
        return User::findOrFail($userId);
    }
}
