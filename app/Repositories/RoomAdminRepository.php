<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;

/**
 * @method Room[]|null all()
 * @method Room|null get(int|string $id)
 * @method Room|null update(int|string $id, array $data)
 * @method Room|null create(array $data)
 * @method Room|null delete(int|string $id)
 */
class RoomAdminRepository extends Repository
{
    public static string $USER_SUPERADMIN = 'superadmin';
    public static string $USER_ADMIN = 'admin';
    public static string $USER_MEMBER = 'member';

    public static string $ROLE_SELLER = 'penjual';
    public static string $ROLE_BUYER = 'pembeli';

    public static string $STATUS_ONGOING = 'ongoing';
    public static string $STATUS_CANCELED = 'canceled';
    public static string $STATUS_DONE = 'done';

    public static string $INVITER_STATUS_JOINED = 'joined';
    public static string $INVITER_STATUS_LEAVED = 'leaved';

    /**
     * @param int|string $id
     * @return Room[]|null
     */
    public function all(int|string $id = 0)
    {
        if (! $id) return parent::accessAll(fn() => Room::get());
        else {
            return parent::accessAll(fn() => Room::where([
                ['status', '=', self::$STATUS_ONGOING],
                ['id', 'like', '%'.$id.'%'],
            ])->get());
        }
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
            if (isset($data['room_password'])) $model->password = Hash::make($data['room_password']);
            if (isset($data['room_status'])) $model->status = $data['room_status'];
            if (isset($data['inviter_status'])) $model->status_user2 = $data['inviter_status'];
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
            $model->password = Hash::make($data['room_password']);
            $model->status = $data['room_status'] ?? self::$STATUS_ONGOING;
            $model->owner()->associate($owner);
            $model->role_user1 = $data['owner_role'];
            $model->inviter()->associate($inviter);
            $model->role_user2 = $data['owner_role'] === self::$ROLE_SELLER ? self::$ROLE_BUYER : self::$ROLE_SELLER;
            $model->status_user2 = $data['inviter_status'] ?? self::$INVITER_STATUS_LEAVED;
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
