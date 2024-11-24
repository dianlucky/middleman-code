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
        $status = $id ? self::$INVITER_STATUS_LEAVED : self::$INVITER_STATUS_JOINED;
        $statuses = [];

        if ($this->getUser()->role != self::$USER_MEMBER) $statuses = [ self::$STATUS_ONGOING, self::$STATUS_CANCELED, self::$STATUS_DONE, ];
        else $statuses = [ self::$STATUS_ONGOING, ];

        $query = Room::whereIn('status', $statuses)
            ->where(function ($query) use ($status) {
                $query
                    ->orWhere('admin_id', '=', $this->getUser()->id)
                    ->orWhere('user_id1', '=', $this->getUser()->id)
                    ->orWhere(function ($query) use ($status) {
                        $query->where('user_id2', '=', $this->getUser()->id)
                            ->where('status_user2', '=', $status);
                    });
            });

        if ($id) {
            $query->where('id', 'like', '%'.$id.'%');
        }

        return parent::accessAll(fn() => $query->get());
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function get(int|string $id): ?Room
    {
        $statuses = [];

        if ($this->getUser()->role != self::$USER_MEMBER) $statuses = [ self::$STATUS_ONGOING, self::$STATUS_CANCELED, self::$STATUS_DONE, ];
        else $statuses = [ self::$STATUS_ONGOING, ];

        return parent::accessGet(
            fn() => Room::whereIn('status', $statuses)
                ->where(function ($query) {
                    $query
                        ->orWhere('admin_id', '=', $this->getUser()->id)
                        ->orWhere('user_id1', '=', $this->getUser()->id)
                        ->orWhere(function ($query) {
                            $query->where('user_id2', '=', $this->getUser()->id)
                                  ->where('status_user2', '=', self::$INVITER_STATUS_JOINED);
                        });
                })
                ->where('id', '=', $id)
                ->firstOrFail()
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
        if ($this->getUser()->role != self::$USER_MEMBER) $data['admin_id'] = $this->getUser()->id;
        else $data['owner_id'] = $this->getUser()->id;

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
