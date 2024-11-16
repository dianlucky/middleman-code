<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Room;

/**
 * @method Room[]|null all()
 * @method Room|null get(int|string $id)
 * @method Room|null update(int|string $id, array $data)
 * @method Room|null create(array $data)
 * @method Room|null delete(int|string $id)
 */
class RoomAdminRepository extends Repository
{
    public static string $STATUS_ONGOING = 'ongoing';
    public static string $STATUS_CANCELED = 'canceled';
    public static string $STATUS_DONE = 'done';
    public static string $ROLE_SELLER = 'penjual';
    public static string $ROLE_BUYER = 'pembeli';

    /**
     * @return Room[]|null
     */
    public function all(): ?array
    {
        return parent::accessAll(fn() => Room::get());
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function get(int|string $id): ?Room
    {
        return parent::accessGet(fn() => Room::findOrFail($id));
    }

    /**
     * @param int|string $id
     * @param array $data
     * @return Room|null
     */
    public function update(int|string $id, array $data): ?Room
    {
        $model = Room::findOrFail($id);

        return parent::mutateUpdate(function() use ($data, $model) {
            if (isset($data['room_name'])) $model->name = $data['room_name'];
            if (isset($data['room_password'])) $model->password = $data['room_password'];
            if (isset($data['room_status'])) $model->status = $data['room_status'];
            $model->save();

            return $model;
        });
    }

    /**
     * @param array $data
     * @return Room|null
     */
    public function create(array $data): ?Room
    {
        $owner = User::findOrFail($data['owner_id']);
        $inviter = User::findOrFail($data['inviter_id']);
        $admin = User::findOrFail($data['admin_id']);

        return parent::mutateCreate(function() use ($data, $owner, $inviter, $admin) {
            $model = new Room();
            $model->id = $model->generateRoomId();
            $model->name = $data['room_name'];
            $model->password = $data['room_password'];
            $model->status = $data['room_status'] ?? self::$STATUS_ONGOING;
            $model->owner()->associate($owner);
            $model->role_user1 = $data['owner_role'];
            $model->inviter()->associate($inviter);
            $model->role_user2 = $data['owner_role'] === self::$ROLE_SELLER ? self::$ROLE_BUYER : self::$ROLE_SELLER;
            $model->admin()->associate($admin);
            $model->save();

            return $model;
        });
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function delete(int|string $id): ?Room
    {
        $model = Room::findOrFail($id);

        return parent::mutateDelete(function() use ($model) {
            $model->delete();

            return $model;
        });
    }
}
