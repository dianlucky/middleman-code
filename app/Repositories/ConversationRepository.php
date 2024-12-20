<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\Conversation;
use App\Repositories\RoomAdminRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @method Conversation[]|null all()
 * @method Conversation|null get(int|string $id)
 * @method Conversation|null create(array $data)
 * @method Conversation|null update(int|string $id, array $data)
 * @method Conversation|null delete(int|string $id)
 */
class ConversationRepository extends ConversationAdminRepository
{
    /**
     * @var Room
     */
    protected Room $room;

    /**
     * @param Room $room
     * @throws ModelNotFoundException
     * @return void
     */
    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    /**
     * @throws ModelNotFoundException
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room ?? throw new ModelNotFoundException('Room not defined.');
    }

    /**
     * @return Conversation[]|null
     */
    public function all()
    {
        $roomId = $this->getRoom()->id;
        $user = $this->getUser();

        return parent::accessAll(
            fn() => Conversation::where('room_id', '=', $roomId)
                ->when($user->role === RoomAdminRepository::$USER_ADMIN, function ($query) {
                    $query->where('is_admin_watchable', true);
                })
                ->get()
        );
    }

    /**
     * @param int|string $id
     * @return Conversation|null
     */
    public function get(int|string $id): ?Conversation
    {
        $roomId = $this->getRoom()->id;

        return parent::accessGet(
            fn() => Conversation::where([
                ['room_id', '=', $roomId],
                ['id', '=', $id],
            ])->firstOrFail()
        );
    }

    /**
     * @param array $data
     * @return Conversation|null
     */
    public function create(array $data): ?Conversation
    {
        $roomId = $this->getRoom()->id;

        $data['room_id'] = $roomId;
        $data['user_sender_id'] = $this->getUser()->id;

        return parent::create($data);
    }

    /**
     * @param int|string $id
     * @param array $data
     * @return Conversation|null
     */
    public function update(int|string $id, array $data): ?Conversation
    {
        $roomId = $this->getRoom()->id;

        $data['room_id'] = $roomId;
        $data['user_sender_id'] = $this->getUser()->id;

        return parent::update($this->get($id)->id, $data);
    }

    /**
     * @param int|string $id
     * @return Conversation|null
     */
    public function hidden(int|string $id): ?Conversation
    {
        $roomId = $this->getRoom()->id;

        return parent::update($this->get($id)->id, [ "is_admin_watchable" => false, ]);
    }

    /**
     * @param int|string $id
     * @return Conversation|null
     */
    public function shown(int|string $id): ?Conversation
    {
        $roomId = $this->getRoom()->id;

        return parent::update($this->get($id)->id, [ "is_admin_watchable" => true, ]);
    }

    /**
     * @param int|string $id
     * @return Conversation|null
     */
    public function delete(int|string $id): ?Conversation
    {
        return parent::delete($this->get($id)->id);
    }
}
