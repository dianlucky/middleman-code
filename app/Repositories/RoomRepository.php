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
     * @return Room[]|null
     */
    public function all(): ?array
    {
        return parent::accessAll(
            fn() => Room::where(function ($query) {
                $query->where('user_id1', '=', $this->getUser()->id)
                      ->orWhere('user_id2', '=', $this->getUser()->id);
            })->get()
        );
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function get(int|string $id): ?Room
    {
        return parent::accessGet(
            fn() => Room::where(function ($query) use ($id) {
                $query->where('user_id1', '=', $this->getUser()->id)
                      ->orWhere('user_id2', '=', $this->getUser()->id)
                      ->where('id', '=', $id);
            })->firstOrFail()
        );
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
     * @param array $data
     * @return Room|null
     */
    public function create(array $data): ?Room
    {
        $data['owner_id'] = $this->getUser()->id;

        return parent::create($data);
    }

    /**
     * @param int|string $id
     * @return Room|null
     */
    public function delete(int|string $id): ?Room
    {
        return parent::delete($this->get($id)->id);
    }
}
