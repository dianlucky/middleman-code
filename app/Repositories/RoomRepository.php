<?php

namespace App\Repositories;

use App\Models\Room;

/**
 * @method Room[]|null all()
 * @method Room|null get(int|string $id)
 * @method Room|null update(int|string $id, array $data)
 * @method Room|null create(array $data)
 * @method Room|null delete(int|string $id)
 */
class RoomRepository extends RoomAdminRepository
{
    /**
     * @param int|string $id
     * @return Room[]|null
     */
    public function all(int|string $id = 0)
    {
        if (! $id) {
            return parent::accessAll(
                fn() => Room::where(function ($query) {
                    $query->where('status', '=', self::$STATUS_ONGOING)
                            ->orWhere('user_id1', '=', $this->getUser()->id)
                            ->orWhere('user_id2', '=', $this->getUser()->id);
                })->get()
            );
        } else {
            return parent::accessAll(
                fn() => Room::where(function ($query) {
                    $query->where('status', '=', self::$STATUS_ONGOING)
                            ->where('id', 'like', '%'.$id.'%')
                            ->orWhere('user_id1', '=', $this->getUser()->id)
                            ->orWhere('user_id2', '=', $this->getUser()->id);
                })->get()
            );
        }
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function get(int|string $id): ?Room
    {
        return parent::accessGet(
            fn() => Room::where(function ($query) use ($id) {
                $query->where('status', '=', self::$STATUS_ONGOING)
                ->orWhere('user_id1', '=', $this->getUser()->id)
                ->orWhere('user_id2', '=', $this->getUser()->id)
                ->where('id', '=', $id);
            })->firstOrFail()
        );
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function join(int|string $id): ?Room
    {
        $room = parent::accessGet(
            fn() => Room::where([
                ['status', '=', self::$STATUS_ONGOING],
                ['user_id2', '=', $this->getUser()->id],
                ['status_user2', '=', self::$INVITER_STATUS_LEAVED],
                ['id', '=', $id],
            ])->firstOrFail()
        );

        return parent::update($room->id, ['inviter_status' => self::$INVITER_STATUS_JOINED]);
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function leave(int|string $id): ?Room
    {
        $room = parent::accessGet(
            fn() => Room::where([
                ['status', '=', self::$STATUS_ONGOING],
                ['user_id2', '=', $this->getUser()->id],
                ['status_user2', '=', self::$INVITER_STATUS_JOINED],
                ['id', '=', $id],
            ])->firstOrFail()
        );

        return parent::update($room->id, ['inviter_status' => self::$INVITER_STATUS_LEAVED]);
    }

    /**
     * @param int|string $id
     * @param array $data
     * @return Room|null
     */
    public function update(int|string $id, array $data): ?Room
    {
        return parent::update($this->get($id)->id, $data);
    }

    /**
     * Go into existed room.
     *
     * @param array $data
     * @return Room|null
     */
    public function create(array $data): ?Room
    {
        $data['owner_id'] = $this->getUser()->id;

        return parent::create($data);
    }

    /**
     * Go outfrom existed room.
     *
     * @param int|string $id
     * @return Room|null
     */
    public function delete(int|string $id): ?Room
    {
        return parent::delete($this->get($id)->id);
    }
}
